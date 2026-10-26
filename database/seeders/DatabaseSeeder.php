<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Daftarkan UserSeeder untuk mengisi data akun dummy pengguna
        $this->call([
            UserSeeder::class,
        ]);
    }
}
