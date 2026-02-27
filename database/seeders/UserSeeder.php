<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin BRT',
            'email' => 'brt@pinvet.test',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Admin PTI',
            'email' => 'pti@pinvet.test',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Admin Robotika',
            'email' => 'robotika@pinvet.test',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
    }
}