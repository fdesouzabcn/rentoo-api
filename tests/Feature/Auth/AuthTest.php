<?php

declare(strict_types=1);

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $this->seed(RolesAndPermissionsSeeder::class);
    // Create Passport personal access client directly (avoids interactive artisan prompt)
    \Laravel\Passport\Client::create([
        'name'          => 'Test Personal Access Client',
        'secret'        => \Illuminate\Support\Str::random(40),
        'redirect_uris' => [],
        'grant_types'   => ['personal_access'],
        'revoked'       => false,
    ]);
});

// ─────────────────────────────────────────────
// REGISTER
// ─────────────────────────────────────────────

test('a new user can register with valid data and receives token', function (): void {
    // Arrange
    $payload = [
        'name'                  => 'New Owner',
        'dni'                   => '12345678A',
        'email'                 => 'newowner@rentoo.com',
        'phone'                 => '600111222',
        'address'               => 'Carrer de Balmes, 10',
        'city'                  => 'Barcelona',
        'postal_code'           => '08007',
        'province'              => 'Barcelona',
        'password'              => 'password',
        'password_confirmation' => 'password',
    ];

    // Act
    $response = $this->postJson('/api/v1/register', $payload);

    // Assert
    $response->assertStatus(201)
             ->assertJsonStructure([
                 'data' => ['id', 'name', 'email'],
                 'token',
             ]);

    $this->assertDatabaseHas('owners', ['email' => 'newowner@rentoo.com']);
});


test('a registered user is automatically assigned the User role', function (): void {
    // Arrange
    $payload = [
        'name'                  => 'New Owner',
        'dni'                   => '12345678A',
        'email'                 => 'newowner@rentoo.com',
        'phone'                 => '600111222',
        'address'               => 'Carrer de Balmes, 10',
        'city'                  => 'Barcelona',
        'postal_code'           => '08007',
        'province'              => 'Barcelona',
        'password'              => 'password',
        'password_confirmation' => 'password',
    ];

    // Act
    $this->postJson('/api/v1/register', $payload);

    // Assert
    $user = User::where('email', 'newowner@rentoo.com')->first();
    expect($user->hasRole('User'))->toBeTrue();
});


test('register fails with missing required fields', function (): void {
    // Arrange
    $payload = []; // Empty payload

    // Act
    $response = $this->postJson('/api/v1/register', $payload);

    // Assert
    $response->assertStatus(422)
             ->assertJsonValidationErrors(['name', 'dni', 'email', 'password']);
});

test('register fails with duplicate email', function (): void {
    // Arrange
    User::factory()->create(['email' => 'duplicate@rentoo.com']);

    $payload = [
        'name'                  => 'Another Owner',
        'dni'                   => '87654321B',
        'email'                 => 'duplicate@rentoo.com', // Duplicate
        'phone'                 => '600999888',
        'address'               => 'Gran Via, 10',
        'city'                  => 'Barcelona',
        'postal_code'           => '08010',
        'province'              => 'Barcelona',
        'password'              => 'password',
        'password_confirmation' => 'password',
    ];

    // Act
    $response = $this->postJson('/api/v1/register', $payload);

    // Assert
    $response->assertStatus(422)
             ->assertJsonValidationErrors(['email']);
});


test('register fails when passwords do not match', function (): void {
    // Arrange
    $payload = [
        'name'                  => 'New Owner',
        'dni'                   => '11111111C',
        'email'                 => 'mismatch@rentoo.com',
        'phone'                 => '600111222',
        'address'               => 'Gran Via, 50',
        'city'                  => 'Barcelona',
        'postal_code'           => '08015',
        'province'              => 'Barcelona',
        'password'              => 'password',
        'password_confirmation' => 'differentpassword',
    ];

    // Act
    $response = $this->postJson('/api/v1/register', $payload);

    // Assert
    $response->assertStatus(422)
             ->assertJsonValidationErrors(['password']);
});

// ─────────────────────────────────────────────
// LOGIN
// ─────────────────────────────────────────────

test('a user can login with valid credentials and receives a token', function (): void {
    // Arrange
    $user = User::factory()->create([
        'email'    => 'owner@rentoo.com',
        'password' => bcrypt('password'),
    ]);

    $payload = [
        'email'    => 'owner@rentoo.com',
        'password' => 'password',
    ];

    // Act
    $response = $this->postJson('/api/v1/login', $payload);

    // Assert
    $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => ['id', 'name', 'email'],
                 'token',
             ]);
});


test('login fails with incorrect password', function (): void {
    // Arrange
    User::factory()->create([
        'email'    => 'owner@rentoo.com',
        'password' => bcrypt('correctpassword'),
    ]);

    $payload = [
        'email'    => 'owner@rentoo.com',
        'password' => 'wrongpassword',
    ];

    // Act
    $response = $this->postJson('/api/v1/login', $payload);

    // Assert
    $response->assertStatus(401);
});


test('login fails with non-existent email', function (): void {
    // Arrange
    $payload = [
        'email'    => 'nonexistent@rentoo.com',
        'password' => 'password',
    ];

    // Act
    $response = $this->postJson('/api/v1/login', $payload);

    // Assert
    $response->assertStatus(401)
             ->assertJson(['message' => 'Invalid credentials']);
});


test('login fails with missing credentials', function (): void {
    // Arrange
    $payload = []; // Empty payload

    // Act
    $response = $this->postJson('/api/v1/login', $payload);

    // Assert
    $response->assertStatus(422)
             ->assertJsonValidationErrors(['email', 'password']);
});


// ─────────────────────────────────────────────
// LOGOUT
// ─────────────────────────────────────────────

test('an authenticated user can logout and token is revoked', function (): void {
    // Arrange
    $user = User::factory()->create();
    $token = $user->createToken('test-token')->accessToken;

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                     ->postJson('/api/v1/logout');

    // Assert
    $response->assertStatus(200)
             ->assertJson(['message' => 'Successfully logged out']);
});

test('an unauthenticated user cannot logout', function (): void {
    // Act
    $response = $this->postJson('/api/v1/logout');

    // Assert
    $response->assertStatus(401);
});
