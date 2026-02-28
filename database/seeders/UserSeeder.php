<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin BRT',
                'email' => 'brt@pinvet.test',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin PTI',
                'email' => 'pti@pinvet.test',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Robotika',
                'email' => 'robotika@pinvet.test',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}