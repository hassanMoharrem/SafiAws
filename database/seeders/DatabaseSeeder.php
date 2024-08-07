<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567891',
            'is_verified' => 1,
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'User user',
            'email' => 'user@user.com',
            'phone' => '0123456789',
            'is_verified' => 1,
            'password' => Hash::make('12345678'),
        ]);
        Admin::create([
            'name' => 'Admin-Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
