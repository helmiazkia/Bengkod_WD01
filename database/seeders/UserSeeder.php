<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'no_hp' => '08123456789',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        User::create([
            'nama' => 'John Doe',
            'no_hp' => '08123456788',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);
    }
}
