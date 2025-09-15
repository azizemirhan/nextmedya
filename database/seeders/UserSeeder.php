<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'image' => null,
            'phone' => '5551112233',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Güvenlik için daha sonra değiştirilmeli
            'remember_token' => Str::random(10),
        ]);

        // Vendor Kullanıcısı
        User::create([
            'name' => 'Vendor User',
            'username' => 'vendor',
            'image' => null,
            'phone' => '5552223344',
            'email' => 'vendor@example.com',
            'role' => 'vendor',
            'status' => 'active',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Normal User
        User::create([
            'name' => 'Normal User',
            'username' => 'user',
            'image' => null,
            'phone' => '5553334455',
            'email' => 'user@example.com',
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
