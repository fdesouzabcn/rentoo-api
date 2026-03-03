<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@rentoo.com'],
            [
                'name'        => 'Admin Rentoo',
                'dni'         => '00000001A',
                'phone'       => '600000001',
                'address'     => 'Carrer de Provença, 1',
                'city'        => 'Barcelona',
                'postal_code' => '08036',
                'province'    => 'Barcelona',
                'password'    => 'password',
            ]
        );

        // Regular user 1 (aka Owner 1)
        User::updateOrCreate(
            ['email' => 'owner1@rentoo.com'],
            [
                'name'        => 'Maria García',
                'dni'         => 'X1234567H',
                'phone'       => '600000002',
                'address'     => 'Carrer de Balmes, 45',
                'city'        => 'Barcelona',
                'postal_code' => '08007',
                'province'    => 'Barcelona',
                'password'    => 'password',
            ]
        );

        // Regular user 2 (aka Owner 2)
        User::updateOrCreate(
            ['email' => 'owner2@rentoo.com'],
            [
                'name'        => 'Jose Martínez',
                'dni'         => 'X2345678H',
                'phone'       => '600000003',
                'address'     => 'Avinguda Diagonal, 200',
                'city'        => 'Barcelona',
                'postal_code' => '08008',
                'province'    => 'Barcelona',
                'password'    => 'password',
            ]
        );

        $this->command->info('3 test users seeded (1 admin, 2 owners)');
    }
}
