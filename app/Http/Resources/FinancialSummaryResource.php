<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FinancialSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
    return [
        'total_properties'             => $this->resource['total_properties'],
        'total_monthly_income'         => $this->resource['total_monthly_income'],
        'total_expected_annual_income' => $this->resource['total_expected_annual_income'],
        'total_deposits_held'          => $this->resource['total_deposits_held'],
        'contracts_expiring'           => $this->resource['contracts_expiring'],
        'properties'                   => $this->resource['properties'],
        ];
    }
}
