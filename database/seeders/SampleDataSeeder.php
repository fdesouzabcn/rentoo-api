<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    // Seed sample properties and contracts for the three test users.
    public function run(): void
    {
        $owner1 = User::where('email', 'owner1@rentoo.com')->first();
        $owner2 = User::where('email', 'owner2@rentoo.com')->first();

        if (! $owner1 || ! $owner2) {
            $this->command->warn('SampleDataSeeder: users not found — run UserSeeder first.');
            return;
        }

        // Owner 1 - (Property 1 — active contract || Property 2 — finalized contract)
        if ($owner1->properties()->count() === 0) {

            $property1 = Property::factory()->create(['owner_id' => $owner1->id]);

            Contract::factory()->active()->create([
                'property_id' => $property1->id,
                'start_date'  => now()->subMonths(6)->startOfMonth(),
                'end_date'    => now()->addMonths(6)->endOfMonth(),
            ]);

            $property2 = Property::factory()->create(['owner_id' => $owner1->id]);

            Contract::factory()->finalized()->create([
                'property_id' => $property2->id,
                'start_date'  => now()->subMonths(13)->startOfMonth(),
                'end_date'    => now()->subDay()->format('Y-m-d'),
            ]);

            $this->command->info('SampleDataSeeder: owner1 properties and contracts seeded.');
        } else {
            $this->command->info('SampleDataSeeder: owner1 already has properties — skipping.');
        }

        // Owner 2 - (Property 1 — active contract expiring within 90 days)
        if ($owner2->properties()->count() === 0) {

            $property3 = Property::factory()->create(['owner_id' => $owner2->id]);

            Contract::factory()->active()->create([
                'property_id' => $property3->id,
                'start_date'  => now()->subYear()->startOfMonth(),
                'end_date'    => now()->addDays(45)->format('Y-m-d'),
            ]);

            $this->command->info('SampleDataSeeder: owner2 property and contract seeded.');
        } else {
            $this->command->info('SampleDataSeeder: owner2 already has properties — skipping.');
        }
    }
}
