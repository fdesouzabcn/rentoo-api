<?php

declare(strict_types=1);

use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $this->seed(RolesAndPermissionsSeeder::class);

    \Laravel\Passport\Client::create([
        'name'          => 'Test Personal Access Client',
        'secret'        => \Illuminate\Support\Str::random(40),
        'redirect_uris' => [],
        'grant_types'   => ['personal_access'],
        'revoked'       => false,
    ]);
});

// ─────────────────────────────────────────────
// GET /api/v1/users/{uuid}/financial-summary
// ─────────────────────────────────────────────

test('admin can view any users financial summary', function (): void {
    // Arrange
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $user = User::factory()->create();
    $user->assignRole('User');

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    // Assert
    $response->assertStatus(200)
             ->assertJsonStructure(financialSummaryJsonStructure());
});

test('user can view their own financial summary', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonStructure(financialSummaryJsonStructure());
});

test('user cannot view another users financial summary', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $otherUser = User::factory()->create();
    $otherUser->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $otherUser->id . '/financial-summary');

    $response->assertStatus(403);
});

test('show returns 404 for non-existent user', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $fakeUuid = '00000000-0000-0000-0000-000000000000';

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $fakeUuid . '/financial-summary');

    $response->assertStatus(404);
});

test('unauthenticated request cannot view a user financial summary', function (): void {
    $user = User::factory()->create();

    $this->getJson('/api/v1/users/' . $user->id . '/financial-summary')
         ->assertStatus(401);
});


// ─────────── Check Empty Returns ───────────

test('returns empty summary for user with no properties', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonPath('data.total_properties', 0)
             ->assertJsonPath('data.properties', []);
});

test('returns empty summary for user with properties but no relevant contracts (e.g. DRAFT only)', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);
    Contract::factory()->draft()->create(['property_id' => $property->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonPath('data.total_properties', 0)
             ->assertJsonPath('data.properties', []);
});

// ─────────── Calculation Check ───────────

test('calculates expected annual income correctly for active contract', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);

    Contract::factory()->active()->create([
        'property_id'  => $property->id,
        'monthly_rent' => 1000.00,
        'start_date'   => now()->subMonths(3)->startOfMonth(),
        'end_date'     => now()->addYear(),
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonPath('data.total_monthly_income', '1000.00')
             ->assertJsonPath('data.total_expected_annual_income', '12000.00');
});

test('calculates total deposits held correctly', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);

    Contract::factory()->active()->create([
        'property_id'        => $property->id,
        'monthly_rent'       => 1000.00,
        'legal_deposit'      => 1000.00,
        'additional_deposit' => 500.00,
        'start_date'         => now()->subMonth()->startOfMonth(),
        'end_date'           => now()->addYear(),
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonPath('data.total_deposits_held', '1500.00');
});

test('when no active contract exists, fetch latest finalized contract and calculates expected annual income correctly', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);

    Contract::factory()->finalized()->create([
        'property_id'  => $property->id,
        'monthly_rent' => 1000.00,
        'start_date'   => now()->subMonths(12)->startOfMonth(),
        'end_date'     => now()->yesterday(),
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
            ->assertJsonPath('data.total_monthly_income', '0.00')
            ->assertJsonPath('data.total_expected_annual_income', '0.00')
            ->assertJsonPath('data.total_properties', 1)               // property IS included
            ->assertJsonPath('data.properties.0.contract_status', 'finalized')
            ->assertJsonPath('data.properties.0.monthly_rent', '1000.00');
});

test('aggregates totals across multiple properties correctly', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property1 = Property::factory()->create(['owner_id' => $user->id]);
    $property2 = Property::factory()->create(['owner_id' => $user->id]);

    Contract::factory()->active()->create([
        'property_id'        => $property1->id,
        'monthly_rent'       => 1000.00,
        'legal_deposit'      => 1000.00,
        'additional_deposit' => 1000.00,
        'start_date'         => now()->subMonth()->startOfMonth(),
        'end_date'           => now()->addYear(),
    ]);

    Contract::factory()->active()->create([
        'property_id'        => $property2->id,
        'monthly_rent'       => 1500.00,
        'legal_deposit'      => 1500.00,
        'additional_deposit' => 1000.00,
        'start_date'         => now()->subMonth()->startOfMonth(),
        'end_date'           => now()->addYear(),
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonPath('data.total_properties', 2)
             ->assertJsonPath('data.total_monthly_income', '2500.00')
             ->assertJsonPath('data.total_expected_annual_income', '30000.00')
             ->assertJsonPath('data.total_deposits_held', '4500.00');
});


// ─────────── Expiration Check ───────────

test('expiration is true for contract ending within 90 days', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);

    Contract::factory()->active()->create([
        'property_id'  => $property->id,
        'monthly_rent' => 900.00,
        'start_date'   => now()->subYear()->startOfMonth(),
        'end_date'     => now()->addDays(45),
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonPath('data.contracts_expiring', 1)
             ->assertJsonPath('data.properties.0.expiring', true);
});

test('expiration is false for contract ending beyond 90 days', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);

    Contract::factory()->active()->create([
        'property_id'  => $property->id,
        'monthly_rent' => 900.00,
        'start_date'   => now()->subYear()->startOfMonth(),
        'end_date'     => now()->addDays(120), // Beyond 90 days
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonPath('data.contracts_expiring', 0)
             ->assertJsonPath('data.properties.0.expiring', false);
});

test('expiration is false when end date is null', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);

    Contract::factory()->active()->create([
        'property_id'  => $property->id,
        'monthly_rent' => 900.00,
        'start_date'   => now()->subYear()->startOfMonth(),
        'end_date'     => null, // Open-ended contract
    ]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id . '/financial-summary');

    $response->assertStatus(200)
             ->assertJsonPath('data.properties.0.expiring', false)
             ->assertJsonPath('data.properties.0.days_until_expiry', null);
});


// ─────────────────────────────────────────────
// HELPER FUNCTIONS
// ─────────────────────────────────────────────

function financialSummaryJsonStructure(): array
{
    return [
        'data' => [
            'total_properties',
            'total_monthly_income',
            'total_expected_annual_income',
            'total_deposits_held',
            'contracts_expiring',
            'properties',
        ],
    ];
}
