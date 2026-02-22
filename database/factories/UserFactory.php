<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'          => fake()->name(),
            'dni'           => $this->generateSpanishDNI(),
            'email'         => fake()->unique()->safeEmail(),
            'phone'         => $this->generateSpanishPhone(),
            'address'       => fake()->streetAddress(),
            'city'          => fake()->randomElement(['Barcelona', 'Badalona', 'Sabadell', 'Terrassa']),
            'postal_code'   => $this->generateBarcelonaPostalCode(),
            'province'      => 'Barcelona',
            'password'      => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    private function generateSpanishDNI(): string
    {
        $number = fake()->numberBetween(10000000, 99999999);
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $letter = $letters[fake()->numberBetween(0, 22)];
        return $number . $letter;
    }

    private function generateSpanishPhone(): string
    {
        return '+34 ' . fake()->numberBetween(600, 699) . ' '
            . fake()->numberBetween(100, 999) . ' '
            . fake()->numberBetween(100, 999);
    }

    private function generateBarcelonaPostalCode(): string
    {
        $number = fake()->numberBetween(8001, 8999);
        return str_pad((string) $number, 5, '0', STR_PAD_LEFT);
    }
}
