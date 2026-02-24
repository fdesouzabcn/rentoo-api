<?php

declare(strict_types=1);

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
// GET /api/v1/users
// ─────────────────────────────────────────────

test('admin can list all users', function (): void {
    // Arrange
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    User::factory()->count(3)->create()->each(fn ($u) => $u->assignRole('User'));

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/users');

    // Assert
    $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [['id', 'name', 'email', 'dni', 'phone', 'city', 'province']],
             ]);
});

test('regular user cannot list all users', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users');

    $response->assertStatus(403);
});

test('unauthenticated request cannot list users', function (): void {
    $this->getJson('/api/v1/users')
         ->assertStatus(401);
});

// ─────────────────────────────────────────────
// GET /api/v1/users/{uuid}
// ─────────────────────────────────────────────

test('admin can view any user', function (): void {
    // Arrange
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $user = User::factory()->create();
    $user->assignRole('User');

    // Act
    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id);

    // Assert
    $response->assertStatus(200)
             ->assertJsonPath('data.email', $user->email);
});

test('regular user can view their own profile', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $user->id);

    $response->assertStatus(200)
             ->assertJsonPath('data.email', $user->email);
});

test('regular user cannot view another users profile', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $otherUser = User::factory()->create();
    $otherUser->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $otherUser->id);

    $response->assertStatus(403);
});

test('show returns 404 for non-existent user', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $fakeUuid = '00000000-0000-0000-0000-000000000000';

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->getJson('/api/v1/users/' . $fakeUuid);

    $response->assertStatus(404);
});

test('unauthenticated request cannot view a user', function (): void {
    $user = User::factory()->create();

    $this->getJson('/api/v1/users/' . $user->id)
         ->assertStatus(401);
});

// ─────────────────────────────────────────────
// DELETE /api/v1/users/{uuid}  (destroy)
// ─────────────────────────────────────────────

test('admin can soft delete any user', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $user = User::factory()->create();
    $user->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/users/' . $user->id);

    $response->assertStatus(204);
    expect(User::find($user->id))->toBeNull();
    expect(User::withTrashed()->find($user->id))->not->toBeNull();      // DB check
});

test('regular user can soft delete their own account', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/users/' . $user->id);

    $response->assertStatus(204);
    expect(User::withTrashed()->find($user->id)->deleted_at)->not->toBeNull();
});

test('regular user cannot soft delete another users account', function (): void {
    $user = User::factory()->create();
    $user->assignRole('User');

    $otherUser = User::factory()->create();
    $otherUser->assignRole('User');

    $response = $this->withHeader('Authorization', 'Bearer ' . $user->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/users/' . $otherUser->id);

    $response->assertStatus(403);
    expect(User::find($otherUser->id))->not->toBeNull(); // Not deleted
});

test('delete returns 404 for non-existent user', function (): void {
    $admin = User::factory()->create();
    $admin->assignRole('Admin');

    $fakeUuid = '00000000-0000-0000-0000-000000000000';

    $response = $this->withHeader('Authorization', 'Bearer ' . $admin->createToken('t')->accessToken)
                     ->deleteJson('/api/v1/users/' . $fakeUuid);

    $response->assertStatus(404);
});

test('unauthenticated request cannot delete a user', function (): void {
    $user = User::factory()->create();

    $this->deleteJson('/api/v1/users/' . $user->id)
         ->assertStatus(401);
});
