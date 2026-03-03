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
// POST /api/v1/contracts
// ─────────────────────────────────────────────

test('authenticated user can create a contract on their own property', function (): void {
    // Arrange
    $user     = User::factory()->create();
    $user->assignRole('User');
    $property = Property::factory()->create(['owner_id' => $user->id]);

    $payload = contractPayload($property->id);

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->postJson('/api/v1/contracts', $payload);

    // Assert
    $response->assertStatus(201)
             ->assertJsonStructure(['data' => contractJsonStructure()])
             ->assertJsonPath('data.property_id', $property->id);

    $this->assertDatabaseHas('contracts', ['property_id' => $property->id]);
});

test('authenticated user can create a contract with two tenants', function (): void {
    $user     = User::factory()->create();
    $user->assignRole('User');
    $property = Property::factory()->create(['owner_id' => $user->id]);

    $contract = Contract::factory()
                ->withTwoTenants()
                ->create(['property_id' => $property->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/contracts/' . $contract->id);

    $response->assertStatus(200)
             ->assertJsonPath('data.tenant2_name', $contract->tenant2_name);
});

test('admin can create a contract on any property', function (): void {
    $admin    = User::factory()->create();
    $admin->assignRole('Admin');
    $property = Property::factory()->create();

    $payload = contractPayload($property->id);

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->postJson('/api/v1/contracts', $payload);

    $response->assertStatus(201)
             ->assertJsonPath('data.property_id', $property->id);
});

test('user cannot create a contract on another users property', function (): void {
    $user          = User::factory()->create();
    $user->assignRole('User');
    $otherProperty = Property::factory()->create();

    $payload = contractPayload($otherProperty->id);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->postJson('/api/v1/contracts', $payload);

    $response->assertStatus(403);
});

test('unauthenticated user cannot create a contract', function (): void {
    $this->postJson('/api/v1/contracts', [])->assertStatus(401);
});

test('create contract fails when required fields are missing', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->postJson('/api/v1/contracts', []);

    $response->assertStatus(422)
             ->assertJsonValidationErrors([
                 'property_id',
                 'start_date',
                 'monthly_rent',
                 'legal_deposit',
                 'tenant1_name',
                 'tenant1_dni',
                 'tenant1_email',
                 'tenant1_phone',
             ]);
});

test('create contract fails with non-existent property_id', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $payload = contractPayload('00000000-0000-0000-0000-000000000000');
    $payload['property_id'] = '00000000-0000-0000-0000-000000000000';

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->postJson('/api/v1/contracts', $payload);

    $response->assertStatus(422)
            ->assertJsonValidationErrors(['property_id']);
});

// ─────────────────────────────────────────────
// GET /api/v1/contracts
// ─────────────────────────────────────────────

test('admin can list all contracts', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $property1 = Property::factory()->create(['owner_id' => $user1->id]);
    $property2 = Property::factory()->create(['owner_id' => $user2->id]);

    Contract::factory()->count(2)->create(['property_id' => $property1->id]);
    Contract::factory()->count(3)->create(['property_id' => $property2->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/contracts');

    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

test('user can only list contracts from their own properties', function (): void {
    $user      = User::factory()->create();
    $user->assignRole('User');
    $otherUser = User::factory()->create();

    $propertyUser= Property::factory()->create(['owner_id' => $user->id]);
    $propertyOtherUser = Property::factory()->create(['owner_id' => $otherUser->id]);

    Contract::factory()->count(2)->create(['property_id' => $propertyUser->id]);
    Contract::factory()->count(3)->create(['property_id' => $propertyOtherUser->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/contracts');

    $response->assertStatus(200)
             ->assertJsonCount(2, 'data');
});

test('unauthenticated request cannot list contracts', function (): void {
    $this->getJson('/api/v1/contracts')
        ->assertStatus(401);
});

// ─────────────────────────────────────────────
// GET /api/v1/contracts/{uuid}
// ─────────────────────────────────────────────

test('admin can view any contract', function (): void {
    $admin    = User::factory()->create();
    $admin->assignRole('Admin');
    $contract = Contract::factory()->create();

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/contracts/' . $contract->id);

    $response->assertStatus(200)
            ->assertJsonPath('data.id', $contract->id);
});

test('user can view a contract from their own property', function (): void {
    $user     = User::factory()->create();
    $user->assignRole('User');
    $property = Property::factory()->create(['owner_id' => $user->id]);
    $contract = Contract::factory()->create(['property_id' => $property->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/contracts/' . $contract->id);

    $response->assertStatus(200)
             ->assertJsonPath('data.id', $contract->id);
});

test('user cannot view a contract from another users property', function (): void {
    $user     = User::factory()->create();
    $user->assignRole('User');
    $contract = Contract::factory()->create();

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/contracts/' . $contract->id);

    $response->assertStatus(403);
});

test('show returns 404 for non-existent contract', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/contracts/00000000-0000-0000-0000-000000000000');

    $response->assertStatus(404);
});

test('unauthenticated request cannot view a contract', function (): void {
    $contract = Contract::factory()->create();

    $this->getJson('/api/v1/contracts/' . $contract->id)
        ->assertStatus(401);
});

// ─────────────────────────────────────────────
// PUT /api/v1/contracts/{uuid}
// ─────────────────────────────────────────────

test('admin can update any contract', function (): void {
    $admin    = User::factory()->create();
    $admin->assignRole('Admin');
    $property = Property::factory()->create();

    $contract = Contract::factory()->create(['property_id' => $property->id, 'monthly_rent' => 1000.00]);

    $payload = updateContractPayload($contract, $property->id, ['monthly_rent' => 1500.00]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->putJson('/api/v1/contracts/' . $contract->id, $payload);

    $response->assertStatus(200)
             ->assertJsonPath('data.monthly_rent', '1500.00');
});

test('user can update a contract from their own property', function (): void {
    $user     = User::factory()->create();
    $user->assignRole('User');
    $property = Property::factory()->create(['owner_id' => $user->id]);

    $contract = Contract::factory()->create(['property_id' => $property->id, 'monthly_rent' => 1000.00]);

    $payload = updateContractPayload($contract, $property->id, ['monthly_rent' => 1200.00]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->putJson('/api/v1/contracts/' . $contract->id, $payload);

    $response->assertStatus(200)
             ->assertJsonPath('data.monthly_rent', '1200.00');
});

test('user cannot update a contract from another users property', function (): void {
    $user     = User::factory()->create();
    $user->assignRole('User');

    $contract = Contract::factory()->create();

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->putJson('/api/v1/contracts/' . $contract->id, ['monthly_rent' => 9750]);

    $response->assertStatus(403);
});

test('update returns 404 for non-existent contract', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->putJson('/api/v1/contracts/00000000-0000-0000-0000-000000000000', []);

    $response->assertStatus(404);
});

test('unauthenticated request cannot update a contract', function (): void {
    $contract = Contract::factory()->create();
    $this->putJson('/api/v1/contracts/' . $contract->id, [])
        ->assertStatus(401);
});

// ─────────────────────────────────────────────
// DELETE /api/v1/contracts/{uuid}
// ─────────────────────────────────────────────

test('admin can soft delete any contract', function (): void {
    $admin    = User::factory()->create();
    $admin->assignRole('Admin');

    $contract = Contract::factory()->create();

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/contracts/' . $contract->id);

    $response->assertStatus(204);
    expect(Contract::find($contract->id))->toBeNull();
    expect(Contract::withTrashed()->find($contract->id))->not->toBeNull();
});

test('user can soft delete a contract from their own property', function (): void {
    $user     = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);
    $contract = Contract::factory()->create(['property_id' => $property->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/contracts/' . $contract->id);

    $response->assertStatus(204);
    expect(Contract::withTrashed()->find($contract->id)->deleted_at)->not->toBeNull();
});

test('user cannot soft delete a contract from another users property', function (): void {
    $user     = User::factory()->create();
    $user->assignRole('User');

    $contract = Contract::factory()->create();

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/contracts/' . $contract->id);

    $response->assertStatus(403);
    expect(Contract::find($contract->id))->not->toBeNull();
});

test('delete returns 404 for non-existent contract', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/contracts/00000000-0000-0000-0000-000000000000');

    $response->assertStatus(404);
});

test('unauthenticated request cannot delete a contract', function (): void {
    $contract = Contract::factory()->create();
    $this->deleteJson('/api/v1/contracts/' . $contract->id)
        ->assertStatus(401);
});

// ─────────────────────────────────────────────
// HELPER FUNCTIONS
// ─────────────────────────────────────────────

// Minimal valid payload for creating a contract.
function contractPayload(string $propertyId): array
{
    return [
        'property_id'   => $propertyId,
        'status'        => 'draft',
        'start_date'    => now()->addWeek()->format('Y-m-d'),
        'monthly_rent'  => 1200.00,
        'legal_deposit' => 1200.00,
        'tenant1_name'  => 'New Tenant 1',
        'tenant1_dni'   => '87654321A',
        'tenant1_email' => 'newtenant@rentoo.com',
        'tenant1_phone' => '600333444',
    ];
}

// Full payload for updating a contract
function updateContractPayload(Contract $contract, string $propertyId, array $overrides = []): array
{
    return array_merge([
        'property_id'   => $propertyId,
        'status'        => $contract->status,
        'start_date'    => $contract->start_date->format('Y-m-d'),
        'monthly_rent'  => $contract->monthly_rent,
        'legal_deposit' => $contract->legal_deposit,
        'tenant1_name'  => $contract->tenant1_name,
        'tenant1_dni'   => $contract->tenant1_dni,
        'tenant1_email' => $contract->tenant1_email,
        'tenant1_phone' => $contract->tenant1_phone,
    ], $overrides);
}

// Expected keys in a contract response.
function contractJsonStructure(): array
{
    return [
        'id',
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
        'created_at',
        'updated_at',
    ];
}
