<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'dni'         => $this->dni,
            'phone'       => $this->phone,
            'address'     => $this->address,
            'city'        => $this->city,
            'postal_code' => $this->postal_code,
            'province'    => $this->province,
            'roles'       => $this->getRoleNames(),
            'created_at'  => $this->created_at?->toISOString(),
            'updated_at'  => $this->updated_at?->toISOString(),
        ];
    }
}
