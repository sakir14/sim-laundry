<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Administrator Laundry',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Membuat Akun Kasir
        User::create([
            'name' => 'Kasir Utama',
            'email' => 'kasir@laundry.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
        ]);
    }
}