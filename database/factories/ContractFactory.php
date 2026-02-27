<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;


class ContractFactory extends Factory
{
    public function definition(): array
    {
        $monthlyRent       = fake()->randomFloat(2, 600, 2000);
        $legalDeposit      = $monthlyRent;
        $additionalDeposit = $monthlyRent;

        $statusWeights = [
            Contract::STATUS_DRAFT     => 70,
            Contract::STATUS_ACTIVE    => 25,
            Contract::STATUS_FINALIZED => 5,
        ];
        $status = $this->weightedRandomElement($statusWeights);

        $dates      = $this->generateContractDates($status);
        $isTensioned = fake()->boolean(50);
        $hasTenant2  = fake()->boolean(40);

        return [
            'property_id' => Property::factory(),

            'status' => $status,

            // Contract Dates
            'start_date' => $dates['start_date'],
            'end_date'   => $dates['end_date'],

            // Financial Terms
            'monthly_rent'       => $monthlyRent,
            'legal_deposit'      => $legalDeposit,
            'additional_deposit' => $additionalDeposit,

            // Expense Responsibilities (30% chance paid by tenant)
            'tenant_pays_ibi'            => fake()->boolean(30),
            'tenant_pays_community_fees' => fake()->boolean(30),
            'tenant_pays_garbage_fees'   => fake()->boolean(30),

            // Tensioned Area (50% chance) and IRPA (+5% calculation)
            'is_tensioned_area' => $isTensioned,
            'irpa_value'        => $isTensioned ? round($monthlyRent * 1.05, 2) : null,

            // Tenant 1 (Required)
            'tenant1_name'  => fake()->name(),
            'tenant1_dni'   => $this->generateSpanishDNI(),
            'tenant1_email' => fake()->unique()->safeEmail(),
            'tenant1_phone' => $this->generateSpanishPhone(),

            // Tenant 2 (Optional - 40% chance)
            'tenant2_name'  => $hasTenant2 ? fake()->name() : null,
            'tenant2_dni'   => $hasTenant2 ? $this->generateSpanishDNI() : null,
            'tenant2_email' => $hasTenant2 ? fake()->safeEmail() : null,
            'tenant2_phone' => $hasTenant2 ? $this->generateSpanishPhone() : null,
        ];
    }

    // ─────────────────────────────────────────────
    // Private helpers
    // ─────────────────────────────────────────────

    private function generateContractDates(string $status): array
    {
        return match ($status) {
            Contract::STATUS_DRAFT => [
                'start_date' => fake()->dateTimeBetween('+1 week', '+3 months'),
                'end_date'   => null,
            ],
            Contract::STATUS_ACTIVE => [
                'start_date' => fake()->dateTimeBetween('-2 years', '-1 day'),
                'end_date'   => fake()->dateTimeBetween('+1 month', '+5 years'),
            ],
            Contract::STATUS_FINALIZED => (function () {
                $startDate = fake()->dateTimeBetween('-5 years', '-2 years');
                return [
                    'start_date' => $startDate,
                    'end_date'   => fake()->dateTimeBetween($startDate, '-1 day'),
                ];
            })(),
            default => [
                'start_date' => fake()->dateTimeBetween('+1 week', '+3 months'),
                'end_date'   => null,
            ],
        };
    }

    private function weightedRandomElement(array $weights): mixed
    {
        $totalWeight = array_sum($weights);
        $random      = fake()->numberBetween(1, $totalWeight);

        $sum = 0;
        foreach ($weights as $value => $weight) {
            $sum += $weight;
            if ($random <= $sum) {
                return $value;
            }
        }

        return array_key_first($weights);
    }

    private function generateSpanishDNI(): string
    {
        $number  = fake()->numberBetween(10000000, 99999999);
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $letter  = $letters[fake()->numberBetween(0, 22)];

        return $number . $letter;
    }

    private function generateSpanishPhone(): string
    {
        return '+34 ' . fake()->numberBetween(600, 699) . ' '
            . fake()->numberBetween(100, 999) . ' '
            . fake()->numberBetween(100, 999);
    }


    // Methods for testing specific scenarios

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Contract::STATUS_DRAFT,
        ]);
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Contract::STATUS_ACTIVE,
        ]);
    }

    public function finalized(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Contract::STATUS_FINALIZED,
        ]);
    }

    public function withTwoTenants(): static
    {
        return $this->state(fn (array $attributes) => [
            'tenant2_name'  => fake()->name(),
            'tenant2_dni'   => $this->generateSpanishDNI(),
            'tenant2_email' => fake()->safeEmail(),
            'tenant2_phone' => $this->generateSpanishPhone(),
        ]);
    }

    public function inTensionedArea(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_tensioned_area' => true,
            'irpa_value'        => round($attributes['monthly_rent'] * 1.05, 2),
        ]);
    }

}
