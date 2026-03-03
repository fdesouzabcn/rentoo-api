<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'api']);
        $userRole  = Role::firstOrCreate(['name' => 'User',  'guard_name' => 'api']);

        // Assign roles to the 3 seeded users created (Admin + 2 owners)
        $admin = User::where('email', 'admin@rentoo.com')->first();
        $owner1 = User::where('email', 'owner1@rentoo.com')->first();
        $owner2 = User::where('email', 'owner2@rentoo.com')->first();

        if ($admin)  $admin->assignRole($adminRole);
        if ($owner1) $owner1->assignRole($userRole);
        if ($owner2) $owner2->assignRole($userRole);

        $this->command->info('Roles created and assigned to seeded users.');
    }
}
