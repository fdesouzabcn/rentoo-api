<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FinancialSummaryResource;
use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FinancialSummaryController extends Controller
{
    /**
     * Get the financial summary for a user.
     *
     * Returns a property-by-property financial breakdown for the given user,
     * plus top-level aggregated totals. Only active and finalized contracts are
     * included — draft contracts are excluded because they represent future
     * intent rather than real income.
     *
     * Admins can request the summary of any user.
     * Regular users can only request their own summary.
     *
     * @group Business Logic
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the user. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @response 200 scenario="success" {
     *   "data": {
     *     "total_properties": 2,
     *     "total_monthly_income": "2500.00",
     *     "total_expected_annual_income": "30000.00",
     *     "total_deposits_held": "4250.00",
     *     "contracts_expiring": 1,
     *     "properties": [
     *       {
     *         "property_id": "uuid",
     *         "property_address": "Carrer de Balmes, 100",
     *         "last_rent_amount": "1000.00",
     *         "monthly_rent": "1200.00",
     *         "total_deposits_held": "1200.00",
     *         "total_annual_costs": "1080.00",
     *         "expected_annual_income": "14400.00",
     *         "total_income_to_date": "3600.00",
     *         "profit_to_date": "3330.00",
     *         "contract_status": "active",
     *         "contract_end_date": "2027-03-01",
     *         "expiring": false,
     *         "days_until_expiry": 365
     *       }
     *     ]
     *   }
     * }
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "User not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function show(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $user = User::with(['properties.contracts'])->find($uuid);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $authUser->id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $propertySummaries     = [];
        $totalMonthlyIncome    = 0.0;
        $totalDepositsHeld     = 0.0;
        $contractsExpiring     = 0;

        foreach ($user->properties as $property) {
            $contract = $this->resolveRelevantContract($property->contracts);

            if ($contract === null) {
                continue;
            }

            $summary = $this->buildPropertySummary($property, $contract);

            $propertySummaries[] = $summary;

            if ($contract->status === Contract::STATUS_ACTIVE) {
                $totalMonthlyIncome += (float) $contract->monthly_rent;
                $totalDepositsHeld  += (float) ($contract->legal_deposit ?? 0)
                                    + (float) ($contract->additional_deposit ?? 0);
            }

            if ($summary['expiring']) {
                $contractsExpiring++;
            }
        }

        $summary = [
            'total_properties'             => count($propertySummaries),
            'total_monthly_income'         => number_format($totalMonthlyIncome, 2, '.', ''),
            'total_expected_annual_income' => number_format($totalMonthlyIncome * 12, 2, '.', ''),
            'total_deposits_held'          => number_format($totalDepositsHeld, 2, '.', ''),
            'contracts_expiring'           => $contractsExpiring,
            'properties'                   => $propertySummaries,
        ];

        return response()->json(['data' => new FinancialSummaryResource($summary)], 200);
    }


    private function buildPropertySummary(Property $property, Contract $contract): array
    {
        $today = Carbon::today();

        $depositsHeld = (float) ($contract->legal_deposit ?? 0)
                    + (float) ($contract->additional_deposit ?? 0);

        $ibi              = (float) ($property->ibi_annual_amount ?? 0);
        $community        = (float) ($property->community_fees_monthly ?? 0) * 12;
        $garbage          = (float) ($property->garbage_fees_annual ?? 0);
        $totalAnnualCosts = $ibi + $community + $garbage;

        $startDate     = Carbon::parse($contract->start_date)->startOfMonth();
        $current       = Carbon::now()->startOfMonth();
        $monthsElapsed = max(0, (int) $current->diffInMonths($startDate, false) + 1);

        $monthlyRent       = (float) $contract->monthly_rent;
        $totalIncomeToDate = $monthlyRent * $monthsElapsed;
        $proratedCosts     = $totalAnnualCosts * ($monthsElapsed / 12);
        $profitToDate      = $totalIncomeToDate - $proratedCosts;

        $endDate         = $contract->end_date;
        $expiring        = false;
        $daysUntilExpiry = null;

        if ($endDate !== null) {
            $endCarbon       = Carbon::parse($endDate);
            $daysUntilExpiry = (int) $today->diffInDays($endCarbon, false);
            $expiring        = $daysUntilExpiry >= 0 && $daysUntilExpiry <= 90;
        }

        return [
            'property_id'                => $property->id,
            'property_address'           => $property->address,
            'monthly_rent'               => number_format($monthlyRent, 2, '.', ''),
            'total_deposits_held'        => number_format($depositsHeld, 2, '.', ''),
            'total_annual_costs'         => number_format($totalAnnualCosts, 2, '.', ''),
            'expected_annual_income'     => number_format($monthlyRent * 12, 2, '.', ''),
            'total_income_to_date'       => number_format($totalIncomeToDate, 2, '.', ''),
            'profit_to_date'             => number_format($profitToDate, 2, '.', ''),
            'contract_status'            => $contract->status,
            'contract_end_date'          => $endDate ? Carbon::parse($endDate)->format('Y-m-d') : null,
            'expiring'                   => $expiring,
            'days_until_expiry'          => $daysUntilExpiry,
        ];
    }


    private function resolveRelevantContract(mixed $contracts): ?Contract
    {
        $active = $contracts->firstWhere('status', Contract::STATUS_ACTIVE);

        if ($active !== null) {
            return $active;
        }

        return $contracts
            ->where('status', Contract::STATUS_FINALIZED)
            ->sortByDesc('end_date')
            ->first();
    }

}
