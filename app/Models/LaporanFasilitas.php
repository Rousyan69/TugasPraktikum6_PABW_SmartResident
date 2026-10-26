<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanFasilitas extends Model
{
    use HasFactory;

    protected $table = 'laporan_fasilitas';

    protected $fillable = [
        'kategori_id',
        'nama_pelapor',
        'nomor_telepon',
        'lokasi_fasilitas',
        'deskripsi_kerusakan',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriFasilitas::class, 'kategori_id');
    }
}