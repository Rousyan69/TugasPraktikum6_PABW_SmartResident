<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriFasilitas;
use App\Models\LaporanFasilitas;
use Faker\Factory as Faker;

class SmartResidentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategoriList = KategoriFasilitas::all();

        for ($i = 0; $i < 12; $i++) {
            $katRandom = $faker->randomElement($kategoriList);

            LaporanFasilitas::create([
                'kategori_id' => $katRandom->id,
                'nama_pelapor' => $faker->name,
                'nomor_telepon' => $faker->phoneNumber,
                'lokasi_fasilitas' => 'Jl. ' . $faker->streetName . ' No. ' . $faker->numberBetween(1, 100) . ', ' . $faker->city,
                'deskripsi_kerusakan' => 'Terjadi kerusakan pada ' . strtolower($katRandom->nama_kategori) . ' di area ini. Kondisi membutuhkan perbaikan secepatnya.',
                'status' => $faker->randomElement(['Menunggu', 'Proses', 'Selesai']),
            ]);
        }
    }
}