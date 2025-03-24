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
            'nama' => 'Helmi',
            'no_hp' => '08123456789',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        User::create([
            'nama' => 'Balqis',
            'no_hp' => '08123456788',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);
    }
}
