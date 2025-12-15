<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'nama_pengurus' => 'Administrator',
            'email_pengurus' => 'admin@pinvet.test',
            'password' => Hash::make('password123'),
            'level_akses' => 'admin',
            'is_active' => true,
        ]);

        // Tambah beberapa user dummy
        User::create([
            'username' => 'pengurus1',
            'nama_pengurus' => 'Budi Santoso',
            'nim_pengurus' => '1234567890',
            'email_pengurus' => 'pengurus1@pinvet.test',
            'password' => Hash::make('password123'),
            'level_akses' => 'pengurus',
            'is_active' => true,
        ]);
    }
}