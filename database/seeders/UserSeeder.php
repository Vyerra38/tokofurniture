<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@auraspace.com'],
            [
                'name' => 'Admin AuraSpace',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '081234567890',
                'address' => 'Jl. Senopati Raya No. 1, Jakarta Selatan',
            ]
        );

        // Dummy Customer 1
        User::updateOrCreate(
            ['email' => 'luna@gmail.com'],
            [
                'name' => 'Luna Stella',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => '081987654321',
                'address' => 'Jl. Lavender Pastel No. 42, Bandung',
            ]
        );

        // Dummy Customer 2
        User::updateOrCreate(
            ['email' => 'cindy@gmail.com'],
            [
                'name' => 'Cindy Cyber',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => '085612345678',
                'address' => 'Jl. Cyber Star No. 99, Surabaya',
            ]
        );
    }
}
