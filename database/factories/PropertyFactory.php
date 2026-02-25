<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),

            // Property Address
            'address'     => fake()->streetAddress(),
            'city'        => fake()->randomElement([
                                'Barcelona',
                                'Badalona',
                                "L'Hospitalet de Llobregat",
                                'Sabadell',
                                'Terrassa',
                            ]),
            'postal_code' => $this->generateBarcelonaPostalCode(),
            'province'    => 'Barcelona',

            // Property Details
            'cadastral_reference' => $this->generateCadastralReference(),
            'surface_area'        => fake()->numberBetween(50, 150),
            'bedrooms'            => fake()->numberBetween(1, 4),
            'bathrooms'           => fake()->numberBetween(1, 2),
            'description'         => fake()->optional(0.6)->paragraph(),

            'energy_certificate_rating'  => fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G']),
            'energy_certificate_number'  => $this->generateEnergyCertificateNumber('VP'),
            'energy_certificate_expiry'  => fake()->dateTimeBetween('+1 year', '+10 years')->format('Y-m-d'),

            'habitability_certificate_number'  => $this->generateHabitabilityCertificateNumber('CHB'),
            'habitability_certificate_expiry'  => fake()->dateTimeBetween('+1 year', '+15 years')->format('Y-m-d'),

            'last_rent_amount'       => fake()->optional(0.6)->randomFloat(2, 600, 2000),
            'ibi_annual_amount'      => fake()->randomFloat(2, 300, 1500),
            'community_fees_monthly' => fake()->randomFloat(2, 50, 250),
            'garbage_fees_annual'    => fake()->randomFloat(2, 100, 300),
        ];
    }

    private function generateBarcelonaPostalCode(): string
    {
        $number = fake()->numberBetween(8001, 8999);
        return str_pad((string) $number, 5, '0', STR_PAD_LEFT);
    }

    private function generateCadastralReference(): string
    {
        $part1 = str_pad((string) fake()->numberBetween(1000000, 9999999), 7, '0', STR_PAD_LEFT);
        $part2 = fake()->lexify('??');
        $part3 = fake()->numerify('####'); // 4 digits
        $part4 = fake()->lexify('?');
        $part5 = fake()->numerify('####'); // 4 digits
        $part6 = fake()->lexify('??');

        return strtoupper($part1 . $part2 . $part3 . $part4 . $part5 . $part6);
    }

    private function generateEnergyCertificateNumber(string $prefix): string
    {
        $part1 = str_pad((string) fake()->numberBetween(1, 99), 2, '0', STR_PAD_LEFT);
        $part2 = fake()->lexify('?');
        $part3 = fake()->randomDigitNotZero();
        $part4 = fake()->lexify('???');

        return strtoupper($prefix . $part1 . $part2 . $part3 . $part4);
    }

    private function generateHabitabilityCertificateNumber(string $prefix): string
    {
        $part1 = fake()->numerify('###########'); // 11 digits

        return strtoupper($prefix . $part1);
    }
}
