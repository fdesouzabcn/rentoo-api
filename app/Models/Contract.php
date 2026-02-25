<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, HasUuids; //, SoftDeletes;

    public const STATUS_DRAFT     = 'draft';
    public const STATUS_ACTIVE    = 'active';
    public const STATUS_FINALIZED = 'finalized';

    protected $fillable = [
        'property_id',
        'status',
        'start_date',
        'end_date',
        'monthly_rent',
        'legal_deposit',
        'additional_deposit',
        'tenant_pays_ibi',
        'tenant_pays_community_fees',
        'tenant_pays_garbage_fees',
        'irpa_value',
        'is_tensioned_area',
        'tenant1_name',
        'tenant1_dni',
        'tenant1_email',
        'tenant1_phone',
        'tenant2_name',
        'tenant2_dni',
        'tenant2_email',
        'tenant2_phone',
    ];

    protected $casts = [
        'start_date'         => 'date',
        'end_date'           => 'date',
        'monthly_rent'       => 'decimal:2',
        'legal_deposit'      => 'decimal:2',
        'additional_deposit' => 'decimal:2',
        'tenant_pays_ibi'             => 'boolean',
        'tenant_pays_community_fees'  => 'boolean',
        'tenant_pays_garbage_fees'    => 'boolean',
        'irpa_value'         => 'decimal:2',
        'is_tensioned_area'  => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function setTenant1DniAttribute(?string $value): void
    {
        $this->attributes['tenant1_dni'] = $value ? strtoupper($value) : null;
    }

    public function setTenant2DniAttribute(?string $value): void
    {
        $this->attributes['tenant2_dni'] = $value ? strtoupper($value) : null;
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isFinalized(): bool
    {
        return $this->status === self::STATUS_FINALIZED;
    }
}
