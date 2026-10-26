<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Akun Utama untuk Kemudahan Pengujian Praktikum
        User::updateOrCreate(
            ['email' => 'ahmad.fauzi@example.com'],
            [
                'name' => 'Ahmad Fauzi',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Buat Minimal 5 Akun Dummy Menggunakan Faker
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => $faker->unique()->userName() . '@warga.id'],
                [
                    'name' => $faker->name(),
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
