<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Masukkan data kategori default secara otomatis saat migration dijalankan
        DB::table('kategori_fasilitas')->insert([
            [
                'nama_kategori' => 'Jalan & Trotoar',
                'deskripsi' => 'Kerusakan pada fasilitas jalan raya, lubang jalan, atau trotoar pejalan kaki.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Lampu Penerangan Jalan',
                'deskripsi' => 'Lampu jalan mati, mati total, atau berpotensi roboh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Saluran Air & Drainase',
                'deskripsi' => 'Drainase tersumbat, galian terbuka, atau pemicu luapan air.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Taman & Fasilitas Publik',
                'deskripsi' => 'Kerusakan pada bangku taman, tempat sampah publik, atau wahana bermain.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_fasilitas');
    }
};