<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin kullanıcısı (eğer yoksa oluştur)
        User::updateOrCreate(
            ['email' => 'admin@evahome.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'phone' => '0532 123 45 67',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Test müşteri kullanıcısı (eğer yoksa oluştur)
        User::updateOrCreate(
            ['email' => 'musteri@test.com'],
            [
                'name' => 'Test Müşteri',
                'password' => Hash::make('password'),
                'phone' => '0532 987 65 43',
                'role' => 'customer',
                'email_verified_at' => now(),
            ]
        );
    }
}
