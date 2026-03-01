<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * List all contracts.
     *
     * Admins see all contracts. Regular users only see contracts
     * that belong to properties they own.
     *
     * @group Contracts
     * @authenticated
     *
     * @response 200 scenario="admin success" {
     *   "data": [{"id": "uuid", "property_id": "uuid", "status": "draft", "monthly_rent": "1200.00"}]
     * }
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function index(Request $request): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        if ($authUser->hasRole('Admin')) {
            $contracts = Contract::with('property')->get();
        } else {
            // User scope: contracts whose property is owned by the authenticated user.
            // whereHas() filters by a relationship condition without loading the data.
            // with('property') then eager-loads the property for each result.
            $contracts = Contract::with('property')
                ->whereHas('property', function ($query) use ($authUser): void {
                    $query->where('owner_id', $authUser->id);
                })
                ->get();
        }

        return response()->json(['data' => ContractResource::collection($contracts)], 200);
    }

    /**
     * Create a new contract.
     *
     * Creates a contract for a given property. Admins can create contracts
     * on any property. Regular users can only create contracts on their own properties.
     *
     * @group Contracts
     * @authenticated
     *
     * @bodyParam property_id string required UUID of the property. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     * @bodyParam status string required Contract status: draft, active, or finalized. Example: draft
     * @bodyParam start_date date required Contract start date (Y-m-d). Must be today or later. Example: 2026-03-01
     * @bodyParam end_date date optional Contract end date (Y-m-d). Must be after start_date. Example: 2027-03-01
     * @bodyParam monthly_rent number required Monthly rent amount in €. Example: 1200.00
     * @bodyParam legal_deposit number required Legal deposit amount in €. Example: 1200.00
     * @bodyParam additional_deposit number optional Additional deposit in €. Example: 1200.00
     * @bodyParam tenant_pays_ibi boolean optional Whether tenant pays IBI. Example: false
     * @bodyParam tenant_pays_community_fees boolean optional Whether tenant pays community fees. Example: false
     * @bodyParam tenant_pays_garbage_fees boolean optional Whether tenant pays garbage fees. Example: false
     * @bodyParam irpa_value number optional IRPA reference value. Example: 1260.00
     * @bodyParam is_tensioned_area boolean optional Whether property is in a tensioned housing area. Example: false
     * @bodyParam tenant1_name string required Primary tenant full name. Example: Joan Puigdemon
     * @bodyParam tenant1_dni string required Primary tenant Spanish DNI/NIE. Example: 12345678A
     * @bodyParam tenant1_email string required Primary tenant email. Example: "joan@rentoo.com"
     * @bodyParam tenant1_phone string required Primary tenant phone. Example: 600111222
     * @bodyParam tenant2_name string optional Secondary tenant full name. Example: Maria Garcia
     * @bodyParam tenant2_dni string optional Secondary tenant Spanish DNI/NIE. Example: 87654321B
     * @bodyParam tenant2_email string optional Secondary tenant email. Example: maria@rentoo.com"
     * @bodyParam tenant2_phone string optional Secondary tenant phone. Example: 600222333
     *
     * @response 201 scenario="success" {"data": {"id": "uuid", "property_id": "uuid", "status": "draft"}}
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 422 scenario="validation error" {"message": "The property_id field is required.", "errors": {}}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function store(Request $request): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $validated = $request->validate([
            'property_id'               => 'required|uuid|exists:properties,id',
            'status'                    => 'sometimes|in:draft,active,finalized',
            'start_date'                => 'required|date|after_or_equal:today',
            'end_date'                  => 'nullable|date|after:start_date',
            'monthly_rent'              => 'required|numeric|min:0|max:999999.99',
            'legal_deposit'             => 'required|numeric|min:0|max:999999.99',
            'additional_deposit'        => 'nullable|numeric|min:0|max:999999.99',
            'tenant_pays_ibi'           => 'boolean',
            'tenant_pays_community_fees'=> 'boolean',
            'tenant_pays_garbage_fees'  => 'boolean',
            'irpa_value'                => 'nullable|numeric|min:0|max:999999.99',
            'is_tensioned_area'         => 'boolean',
            'tenant1_name'              => 'required|string|max:100',
            'tenant1_dni'               => [
                                              'required',
                                              'string',
                                              'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
                                          ],
            'tenant1_email'             => 'required|email|max:100',
            'tenant1_phone'             => 'required|string|max:20',
            'tenant2_name'              => 'nullable|string|max:100',
            'tenant2_dni'               => [
                                              'nullable',
                                              'string',
                                              'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
                                          ],
            'tenant2_email'             => 'nullable|email|max:100',
            'tenant2_phone'             => 'nullable|string|max:20',
        ]);

        if (! $authUser->hasRole('Admin')) {
            $property = Property::find($validated['property_id']);

            if (! $property) {
                return response()->json(['message' => 'Property not found'], 404);
            }

            if ($property->owner_id !== $authUser->id) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

        $contract = Contract::create($validated);

        return response()->json(['data' => new ContractResource($contract)], 201);
    }

    /**
     * Show a specific contract.
     *
     * Admins can view any contract. Regular users can only view contracts
     * on properties they own.
     *
     * @group Contracts
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the contract. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @response 200 scenario="success" {"data": {"id": "uuid", "property_id": "uuid", "status": "draft"}}
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "Contract not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function show(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $contract = Contract::with('property')->find($uuid);

        if (! $contract) {
            return response()->json(['message' => 'Contract not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $contract->property->owner_id !== $authUser->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json(['data' => new ContractResource($contract)], 200);
    }

    /**
     * Update a contract.
     *
     * Full update (PUT) of a contract. Admins can update any contract.
     * Regular users can only update contracts on their own properties.
     *
     * @group Contracts
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the contract. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @bodyParam property_id string required UUID of the property. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     * @bodyParam status string required Contract status: draft, active, or finalized. Example: active
     * @bodyParam start_date date required Contract start date (Y-m-d). Example: 2026-03-01
     * @bodyParam end_date date optional Contract end date (Y-m-d). Example: 2027-03-01
     * @bodyParam monthly_rent number required Monthly rent amount in €. Example: 1400.00
     * @bodyParam legal_deposit number required Legal deposit in €. Example: 1400.00
     * @bodyParam tenant1_name string required Primary tenant full name. Example: Joan Puigdemon
     * @bodyParam tenant1_dni string required Primary tenant DNI. Example: 12345678A
     * @bodyParam tenant1_email string required Primary tenant email. Example: joan@rentoo.com
     * @bodyParam tenant1_phone string required Primary tenant phone. Example: 600111222
     *
     * @response 200 scenario="success" {"data": {"id": "uuid", "monthly_rent": "1400.00"}}
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "Contract not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function update(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $contract = Contract::with('property')->find($uuid);

        if (! $contract) {
            return response()->json(['message' => 'Contract not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $contract->property->owner_id !== $authUser->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validated = $request->validate([
            'property_id'               => 'required|uuid|exists:properties,id',
            'status'                    => 'required|in:draft,active,finalized',
            'start_date'                => 'required|date',
            'end_date'                  => 'nullable|date|after:start_date',
            'monthly_rent'              => 'required|numeric|min:0|max:999999.99',
            'legal_deposit'             => 'required|numeric|min:0|max:999999.99',
            'additional_deposit'        => 'nullable|numeric|min:0|max:999999.99',
            'tenant_pays_ibi'           => 'boolean',
            'tenant_pays_community_fees'=> 'boolean',
            'tenant_pays_garbage_fees'  => 'boolean',
            'irpa_value'                => 'nullable|numeric|min:0|max:999999.99',
            'is_tensioned_area'         => 'boolean',
            'tenant1_name'              => 'required|string|max:100',
            'tenant1_dni'               => [
                                              'required',
                                              'string',
                                              'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
                                          ],
            'tenant1_email'             => 'required|email|max:100',
            'tenant1_phone'             => 'required|string|max:20',
            'tenant2_name'              => 'nullable|string|max:100',
            'tenant2_dni'               => [
                                              'nullable',
                                              'string',
                                              'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
                                          ],
            'tenant2_email'             => 'nullable|email|max:100',
            'tenant2_phone'             => 'nullable|string|max:20',
        ]);

        $contract->update($validated);

        return response()->json(['data' => new ContractResource($contract->fresh())], 200);
    }

    /**
     * Delete a contract (soft delete).
     *
     * Soft deletes a contract. Admins can delete any contract.
     * Regular users can only delete contracts on their own properties.
     *
     * @group Contracts
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the contract. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @response 204 scenario="success"
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "Contract not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function destroy(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $contract = Contract::with('property')->find($uuid);

        if (! $contract) {
            return response()->json(['message' => 'Contract not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $contract->property->owner_id !== $authUser->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $contract->delete();

        return response()->json(null, 204);
    }
}
