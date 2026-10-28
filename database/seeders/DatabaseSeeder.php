<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat user jika email belum terdaftar.
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // Membuat admin jika email belum terdaftar.
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Ahmad Fateh Eydil Faiq',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}