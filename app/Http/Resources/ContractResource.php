<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                         => $this->id,
            'property_id'               => $this->property_id,
            'status'                    => $this->status,
            'start_date'                => $this->start_date?->format('Y-m-d'),
            'end_date'                  => $this->end_date?->format('Y-m-d'),
            'monthly_rent'              => $this->monthly_rent,
            'legal_deposit'             => $this->legal_deposit,
            'additional_deposit'        => $this->additional_deposit,
            'tenant_pays_ibi'           => $this->tenant_pays_ibi,
            'tenant_pays_community_fees'=> $this->tenant_pays_community_fees,
            'tenant_pays_garbage_fees'  => $this->tenant_pays_garbage_fees,
            'irpa_value'                => $this->irpa_value,
            'is_tensioned_area'         => $this->is_tensioned_area,
            'tenant1_name'              => $this->tenant1_name,
            'tenant1_dni'               => $this->tenant1_dni,
            'tenant1_email'             => $this->tenant1_email,
            'tenant1_phone'             => $this->tenant1_phone,
            'tenant2_name'              => $this->tenant2_name,
            'tenant2_dni'               => $this->tenant2_dni,
            'tenant2_email'             => $this->tenant2_email,
            'tenant2_phone'             => $this->tenant2_phone,
            'created_at'                => $this->created_at?->toISOString(),
            'updated_at'                => $this->updated_at?->toISOString(),
        ];
    }
}
