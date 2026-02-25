<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * List all properties.
     *
     * Returns all properties for admins. Regular users only see their own properties.
     *
     * @group Properties
     * @authenticated
     *
     * @response 200 scenario="admin success" {
     *   "data": [
     *     {
     *       "id": "uuid-here",
     *       "owner_id": "owner-uuid",
     *       "address": "Carrer de Balmes, 100",
     *       "city": "Barcelona",
     *       "bedrooms": 3,
     *       "bathrooms": 2
     *     }
     *   ]
     * }
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function index(Request $request): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        if ($authUser->hasRole('Admin')) {
            $properties = Property::all();
        } else {
            $properties = Property::where('owner_id', $authUser->id)->get();
        }

        return response()->json(['data' => PropertyResource::collection($properties)], 200);
    }

    /**
     * Create a new property.
     *
     * Creates a property and automatically assigns it to the authenticated user as owner.
     *
     * @group Properties
     * @authenticated
     *
     * @bodyParam address string required Street address. Max 250 characters. Example: Carrer de Balmes, 100
     * @bodyParam city string required City. Max 100 characters. Example: Barcelona
     * @bodyParam postal_code string required Postal code. Max 10 characters. Example: 08008
     * @bodyParam province string required Province. Max 100 characters. Example: Barcelona
     * @bodyParam cadastral_reference string required Spanish cadastral reference. Exactly 20 alphanumeric characters, must be unique. Example: 9876543ZX9876T0001TT
     * @bodyParam surface_area number required Surface area in m². Between 10 and 9999.99. Example: 85.50
     * @bodyParam bedrooms integer required Number of bedrooms. Between 0 and 255. Example: 3
     * @bodyParam bathrooms integer required Number of bathrooms. Between 0 and 255. Example: 2
     * @bodyParam description string optional Property description. Max 1000 characters. Example: Hermoso Piso en Eixample
     * @bodyParam energy_certificate_rating string required Energy rating (A–G). Example: C
     * @bodyParam energy_certificate_number string required Alphanumeric certificate number. Max 50 characters. Example: TT98765432
     * @bodyParam energy_certificate_expiry date required Expiry date, must be after today (Y-m-d). Example: 2030-01-01
     * @bodyParam habitability_certificate_number string required Alphanumeric certificate number. Max 50 characters. Example: CHB34567891011
     * @bodyParam habitability_certificate_expiry date required Expiry date, must be after today (Y-m-d). Example: 2030-06-01
     * @bodyParam last_rent_amount number optional Last rent amount in €. Max 999999.99. Example: 1200.00
     * @bodyParam ibi_annual_amount number optional Annual IBI in €. Max 999999.99. Example: 450.00
     * @bodyParam community_fees_monthly number optional Monthly community fees in €. Max 999999.99. Example: 80.00
     * @bodyParam garbage_fees_annual number optional Annual garbage fees in €. Max 999999.99. Example: 120.00
     *
     * @response 201 scenario="success" {
     *   "data": {"id": "uuid-here", "city": "Barcelona", "owner_id": "owner-uuid"}
     * }
     * @response 422 scenario="validation error" {
     *   "message": "The cadastral reference field must be 20 characters.",
     *   "errors": {"cadastral_reference": ["The cadastral reference field must be 20 characters."]}
     * }
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function store(Request $request): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $validated = $request->validate([
            'address'                         => 'required|string|max:250',
            'city'                            => 'required|string|max:100',
            'postal_code'                     => 'required|string|max:10',
            'province'                        => 'required|string|max:100',
            'cadastral_reference'             => 'required|string|max:100|regex:/^[A-Z0-9]{20}$/i|unique:properties,cadastral_reference',
            'surface_area'                    => 'required|numeric|min:10|max:9999.99',
            'bedrooms'                        => 'required|integer|min:0|max:255',
            'bathrooms'                       => 'required|integer|min:0|max:255',
            'description'                     => 'nullable|string|max:1000',
            'energy_certificate_rating'       => 'required|in:A,B,C,D,E,F,G',
            'energy_certificate_number'       => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'energy_certificate_expiry'       => 'required|date|after:today',
            'habitability_certificate_number' => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'habitability_certificate_expiry' => 'required|date|after:today',
            'last_rent_amount'                => 'nullable|numeric|min:0|max:999999.99',
            'ibi_annual_amount'               => 'nullable|numeric|min:0|max:999999.99',
            'community_fees_monthly'          => 'nullable|numeric|min:0|max:999999.99',
            'garbage_fees_annual'             => 'nullable|numeric|min:0|max:999999.99',
        ]);

        $validated['owner_id'] = $authUser->id;

        $property = Property::create($validated);

        return response()->json(['data' => new PropertyResource($property)], 201);
    }

    /**
     * Show a specific property.
     *
     * Admins can view any property. Regular users can only view their own properties.
     *
     * @group Properties
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the property. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @response 200 scenario="success" {"data": {"id": "uuid-here", "city": "Barcelona"}}
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "Property not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function show(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $property = Property::find($uuid);

        if (! $property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $property->owner_id !== $authUser->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json(['data' => new PropertyResource($property)], 200);
    }

    /**
     * Update a property.
     *
     * Full update (PUT) of a property. Admins can update any property.
     * Regular users can only update their own properties.
     *
     * @group Properties
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the property. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @bodyParam address string required Street address. Max 250 characters. Example: Carrer de Balmes, 100
     * @bodyParam city string required City. Max 100 characters. Example: Girona
     * @bodyParam postal_code string required Postal code. Max 10 characters. Example: 17001
     * @bodyParam province string required Province. Max 100 characters. Example: Girona
     * @bodyParam cadastral_reference string required Exactly 20 alphanumeric characters. Example: 9876543ZX9876T0001TT
     * @bodyParam surface_area number required Surface area in m². Between 10 and 9999.99. Example: 85.50
     * @bodyParam bedrooms integer required Number of bedrooms. Between 0 and 255. Example: 3
     * @bodyParam bathrooms integer required Number of bathrooms. Between 0 and 255. Example: 2
     * @bodyParam description string optional Property description. Max 1000 characters. Example: Renovated flat
     * @bodyParam energy_certificate_rating string required Energy rating (A–G). Example: B
     * @bodyParam energy_certificate_number string required Alphanumeric certificate number. Max 50 characters. Example: TT98765432
     * @bodyParam energy_certificate_expiry date required Expiry date (Y-m-d). Example: 2031-01-01
     * @bodyParam habitability_certificate_number string required Alphanumeric certificate number. Max 50 characters. Example: CHB34567891011
     * @bodyParam habitability_certificate_expiry date required Expiry date (Y-m-d). Example: 2031-06-01
     * @bodyParam last_rent_amount number optional Last rent amount in €. Max 999999.99. Example: 1400.00
     * @bodyParam ibi_annual_amount number optional Annual IBI in €. Max 999999.99. Example: 500.00
     * @bodyParam community_fees_monthly number optional Monthly community fees in €. Max 999999.99. Example: 90.00
     * @bodyParam garbage_fees_annual number optional Annual garbage fees in €. Max 999999.99. Example: 130.00
     *
     * @response 200 scenario="success" {"data": {"id": "uuid-here", "city": "Girona"}}
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "Property not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function update(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $property = Property::find($uuid);

        if (! $property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $property->owner_id !== $authUser->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validated = $request->validate([
            'address'                         => 'required|string|max:250',
            'city'                            => 'required|string|max:100',
            'postal_code'                     => 'required|string|max:10',
            'province'                        => 'required|string|max:100',
            'cadastral_reference'             => 'required|string|max:100|regex:/^[A-Z0-9]{20}$/i|unique:properties,cadastral_reference,' . $property->id,
            'surface_area'                    => 'required|numeric|min:10|max:9999.99',
            'bedrooms'                        => 'required|integer|min:0|max:255',
            'bathrooms'                       => 'required|integer|min:0|max:255',
            'description'                     => 'nullable|string|max:1000',
            'energy_certificate_rating'       => 'required|in:A,B,C,D,E,F,G',
            'energy_certificate_number'       => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'energy_certificate_expiry'       => 'required|date',
            'habitability_certificate_number' => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'habitability_certificate_expiry' => 'required|date',
            'last_rent_amount'                => 'nullable|numeric|min:0|max:999999.99',
            'ibi_annual_amount'               => 'nullable|numeric|min:0|max:999999.99',
            'community_fees_monthly'          => 'nullable|numeric|min:0|max:999999.99',
            'garbage_fees_annual'             => 'nullable|numeric|min:0|max:999999.99',
        ]);

        $property->update($validated);

        return response()->json(['data' => new PropertyResource($property->fresh())], 200);
    }

    /**
     * Delete a property (soft delete).
     *
     * Soft deletes a property. Fails if the property has active contracts.
     * Admins can delete any property. Regular users can only delete their own properties.
     *
     * @group Properties
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the property. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @response 204 scenario="success"
     * @response 409 scenario="has contracts" {"message": "Cannot delete property with 2 active contracts. Please delete them first."}
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "Property not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function destroy(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $property = Property::find($uuid);

        if (! $property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $property->owner_id !== $authUser->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Prevent deletion if property has contracts — mirrors MVC business logic
        $contractsCount = $property->contracts()->count();

        if ($contractsCount > 0) {
            $word = $contractsCount === 1 ? 'contract' : 'contracts';
            return response()->json([
                'message' => "Cannot delete property with {$contractsCount} active {$word}. Please delete them first.",
            ], 409);
        }

        $property->delete();

        return response()->json(null, 204);
    }
}
