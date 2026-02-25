<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                              => $this->id,
            'owner_id'                        => $this->owner_id,
            'address'                         => $this->address,
            'city'                            => $this->city,
            'postal_code'                     => $this->postal_code,
            'province'                        => $this->province,
            'cadastral_reference'             => $this->cadastral_reference,
            'surface_area'                    => $this->surface_area,
            'bedrooms'                        => $this->bedrooms,
            'bathrooms'                       => $this->bathrooms,
            'description'                     => $this->description,
            'energy_certificate_rating'       => $this->energy_certificate_rating,
            'energy_certificate_number'       => $this->energy_certificate_number,
            'energy_certificate_expiry'       => $this->energy_certificate_expiry?->format('Y-m-d'),
            'habitability_certificate_number' => $this->habitability_certificate_number,
            'habitability_certificate_expiry' => $this->habitability_certificate_expiry?->format('Y-m-d'),
            'last_rent_amount'                => $this->last_rent_amount,
            'ibi_annual_amount'               => $this->ibi_annual_amount,
            'community_fees_monthly'          => $this->community_fees_monthly,
            'garbage_fees_annual'             => $this->garbage_fees_annual,
            'created_at'                      => $this->created_at?->toISOString(),
            'updated_at'                      => $this->updated_at?->toISOString(),
        ];
    }
}
