<?php

declare(strict_types=1);

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
// POST /api/v1/properties
// ─────────────────────────────────────────────

test('authenticated user can create a property', function (): void {
    // Arrange
    $user = User::factory()->create();
    $user->assignRole('User');

    $payload = [
        'address'                         => 'Carrer de Balmes, 120',
        'city'                            => 'Barcelona',
        'postal_code'                     => '08008',
        'province'                        => 'Barcelona',
        'cadastral_reference'             => '9876543ZX9876T0001TT',
        'surface_area'                    => 85.00,
        'bedrooms'                        => 3,
        'bathrooms'                       => 2,
        'description'                     => 'Hermoso Piso en Eixample',
        'energy_certificate_rating'       => 'C',
        'energy_certificate_number'       => 'TT98765432',
        'energy_certificate_expiry'       => '2030-01-01',
        'habitability_certificate_number' => 'CHB34567891011',
        'habitability_certificate_expiry' => '2030-06-01',
    ];

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->postJson('/api/v1/properties', $payload);

    // Assert
    $response->assertStatus(201)
             ->assertJsonPath('data.city', 'Barcelona')
             ->assertJsonPath('data.owner_id', $user->id);

    $this->assertDatabaseHas('properties', [
        'city'     => 'Barcelona',
        'owner_id' => $user->id,
    ]);
});

test('admin can create a property', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $payload = [
        'address'                         => 'Carrer de Balmes, 130',
        'city'                            => 'Barcelona',
        'postal_code'                     => '08008',
        'province'                        => 'Barcelona',
        'cadastral_reference'             => '8876543ZX9876T0001TT',
        'surface_area'                    => 85.00,
        'bedrooms'                        => 3,
        'bathrooms'                       => 2,
        'description'                     => 'Hermoso Piso en Eixample',
        'energy_certificate_rating'       => 'B',
        'energy_certificate_number'       => 'TT88765432',
        'energy_certificate_expiry'       => '2030-01-01',
        'habitability_certificate_number' => 'CHB44567891011',
        'habitability_certificate_expiry' => '2030-06-01',
    ];

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->postJson('/api/v1/properties', $payload);

    $response->assertStatus(201)
             ->assertJsonPath('data.owner_id', $admin->id);
});

test('unauthenticated user cannot create a property', function (): void {
    $this->postJson('/api/v1/properties', [])
         ->assertStatus(401);
});

test('create a property fails when required fields are missing', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->postJson('/api/v1/properties', []);

    $response->assertStatus(422)
             ->assertJsonValidationErrors([
                 'address', 'city', 'postal_code', 'province',
                 'cadastral_reference', 'surface_area', 'bedrooms', 'bathrooms',
                 'energy_certificate_rating', 'energy_certificate_number',
                 'energy_certificate_expiry', 'habitability_certificate_number',
                 'habitability_certificate_expiry',
             ]);
});

// ─────────────────────────────────────────────
// GET /api/v1/properties
// ─────────────────────────────────────────────

test('admin can list all properties', function (): void {
    // Arrange
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    Property::factory()->count(2)->create(['owner_id' => $user1->id]);
    Property::factory()->count(3)->create(['owner_id' => $user2->id]);

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/properties');

    // Assert
    $response->assertStatus(200)
             ->assertJsonCount(5, 'data');
});

test('user can only list their own properties', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $otherUser = User::factory()->create();

    Property::factory()->count(2)->create(['owner_id' => $user->id]);
    Property::factory()->count(3)->create(['owner_id' => $otherUser->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/properties');

    $response->assertStatus(200)
             ->assertJsonCount(2, 'data');
});

test('unauthenticated request cannot list properties', function (): void {
    $this->getJson('/api/v1/properties')
         ->assertStatus(401);
});

// ─────────────────────────────────────────────
// GET /api/v1/properties/{uuid}
// ─────────────────────────────────────────────

test('admin can view any property', function (): void {
    // Arrange
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $property = Property::factory()->create();

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/properties/' . $property->id);

    // Assert
    $response->assertStatus(200)
             ->assertJsonPath('data.id', $property->id);
});

test('user can view their own property', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/properties/' . $property->id);

    $response->assertStatus(200)
             ->assertJsonPath('data.id', $property->id);
});

test('user cannot view another users property', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $otherProperty = Property::factory()->create();

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/properties/' . $otherProperty->id);

    $response->assertStatus(403);
});

test('show returns 404 for non-existent property', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/properties/00000000-0000-0000-0000-000000000000');

    $response->assertStatus(404);
});

test('unauthenticated request cannot view a property', function (): void {
    $property = Property::factory()->create();

    $this->getJson('/api/v1/properties/' . $property->id)
         ->assertStatus(401);
});

// ─────────────────────────────────────────────
// PUT /api/v1/properties/{uuid}
// ─────────────────────────────────────────────

test('admin can update any property', function (): void {
    // Arrange
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $property = Property::factory()->create(['city' => 'Barcelona']);

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->putJson('/api/v1/properties/' . $property->id, [
                         'address'                         => $property->address,
                         'city'                            => 'Girona',
                         'postal_code'                     => $property->postal_code,
                         'province'                        => $property->province,
                         'cadastral_reference'             => $property->cadastral_reference,
                         'surface_area'                    => $property->surface_area,
                         'bedrooms'                        => $property->bedrooms,
                         'bathrooms'                       => $property->bathrooms,
                         'description'                     => $property->description,
                         'energy_certificate_rating'       => $property->energy_certificate_rating,
                         'energy_certificate_number'       => $property->energy_certificate_number,
                         'energy_certificate_expiry'       => $property->energy_certificate_expiry->format('Y-m-d'),
                         'habitability_certificate_number' => $property->habitability_certificate_number,
                         'habitability_certificate_expiry' => $property->habitability_certificate_expiry->format('Y-m-d'),
                     ]);

    // Assert
    $response->assertStatus(200)
             ->assertJsonPath('data.city', 'Girona');
});

test('user can update their own property', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id, 'bedrooms' => 2]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->putJson('/api/v1/properties/' . $property->id, [
                         'address'                         => $property->address,
                         'city'                            => 'Sitges',
                         'postal_code'                     => $property->postal_code,
                         'province'                        => $property->province,
                         'cadastral_reference'             => $property->cadastral_reference,
                         'surface_area'                    => $property->surface_area,
                         'bedrooms'                        => 5,
                         'bathrooms'                       => $property->bathrooms,
                         'energy_certificate_rating'       => $property->energy_certificate_rating,
                         'energy_certificate_number'       => $property->energy_certificate_number,
                         'energy_certificate_expiry'       => $property->energy_certificate_expiry->format('Y-m-d'),
                         'habitability_certificate_number' => $property->habitability_certificate_number,
                         'habitability_certificate_expiry' => $property->habitability_certificate_expiry->format('Y-m-d'),
                     ]);

    $response->assertStatus(200)
             ->assertJsonPath('data.city', 'Sitges')
             ->assertJsonPath('data.bedrooms', 5);
});

test('user cannot update another users property', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $otherProperty = Property::factory()->create();

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->putJson('/api/v1/properties/' . $otherProperty->id, [
                         'address' => 'Hacker Street',
                     ]);

    $response->assertStatus(403);
});

test('update returns 404 for non-existent property', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->putJson('/api/v1/properties/00000000-0000-0000-0000-000000000000', [
                         'city' => 'Barcelona',
                     ]);

    $response->assertStatus(404);
});

test('unauthenticated request cannot update a property', function (): void {
    $property = Property::factory()->create();

    $this->putJson('/api/v1/properties/' . $property->id, ['city' => 'Barcelona'])
         ->assertStatus(401);
});

// ─────────────────────────────────────────────
// DELETE /api/v1/properties/{uuid}
// ─────────────────────────────────────────────

test('admin can soft delete any property', function (): void {
    // Arrange
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $property = Property::factory()->create();

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/properties/' . $property->id);

    // Assert
    $response->assertStatus(204);
    expect(Property::find($property->id))->toBeNull();                       // Not in normal queries
    expect(Property::withTrashed()->find($property->id))->not->toBeNull();   // Still in DB
});

test('user can soft delete their own property', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $property = Property::factory()->create(['owner_id' => $user->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/properties/' . $property->id);

    $response->assertStatus(204);
    expect(Property::withTrashed()->find($property->id)->deleted_at)->not->toBeNull();
});

test('user cannot soft delete another users property', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $otherProperty = Property::factory()->create();

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/properties/' . $otherProperty->id);

    $response->assertStatus(403);
    expect(Property::find($otherProperty->id))->not->toBeNull(); // Not deleted
});

test('delete returns 404 for non-existent property', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/properties/00000000-0000-0000-0000-000000000000');

    $response->assertStatus(404);
});

test('unauthenticated request cannot delete a property', function (): void {
    $property = Property::factory()->create();

    $this->deleteJson('/api/v1/properties/' . $property->id)
         ->assertStatus(401);
});
