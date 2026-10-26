<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriFasilitas extends Model
{
    use HasFactory;

    protected $table = 'kategori_fasilitas';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    public function laporan()
    {
        return $this->hasMany(LaporanFasilitas::class, 'kategori_id');
    }
}