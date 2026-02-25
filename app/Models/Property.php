<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Contract;
use App\Models\User;

class Property extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'owner_id',
        'address',
        'city',
        'postal_code',
        'province',
        'cadastral_reference',
        'surface_area',
        'bedrooms',
        'bathrooms',
        'description',
        'energy_certificate_rating',
        'energy_certificate_number',
        'energy_certificate_expiry',
        'habitability_certificate_number',
        'habitability_certificate_expiry',
        'last_rent_amount',
        'ibi_annual_amount',
        'community_fees_monthly',
        'garbage_fees_annual',
    ];

    protected $casts = [
        'surface_area'                    => 'decimal:2',
        'bedrooms'                        => 'integer',
        'bathrooms'                       => 'integer',
        'energy_certificate_expiry'       => 'date',
        'habitability_certificate_expiry' => 'date',
        'last_rent_amount'                => 'decimal:2',
        'ibi_annual_amount'               => 'decimal:2',
        'community_fees_monthly'          => 'decimal:2',
        'garbage_fees_annual'             => 'decimal:2',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function setCadastralReferenceAttribute(?string $value): void
    {
        $this->attributes['cadastral_reference'] = $value ? strtoupper($value) : null;
    }

    public function setEnergyCertificateNumberAttribute(?string $value): void
    {
        $this->attributes['energy_certificate_number'] = $value ? strtoupper($value) : null;
    }

    public function setHabitabilityCertificateNumberAttribute(?string $value): void
    {
        $this->attributes['habitability_certificate_number'] = $value ? strtoupper($value) : null;
    }
}
