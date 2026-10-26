<?php

namespace App\Http\Controllers;

use App\Models\KategoriFasilitas;
use App\Models\LaporanFasilitas;
use Illuminate\Http\Request;

class SmartResidentController extends Controller
{
    public function index()
    {
        $laporan = LaporanFasilitas::with('kategori')->latest()->get();
        return view('smartresident.index', compact('laporan'));
    }

    public function create()
    {
        $kategori = KategoriFasilitas::all();
        return view('smartresident.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_fasilitas,id',
            'nama_pelapor' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'lokasi_fasilitas' => 'required|string|max:255',
            'deskripsi_kerusakan' => 'required|string',
        ], [
            'kategori_id.required' => 'Kategori fasilitas wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'lokasi_fasilitas.required' => 'Lokasi fasilitas wajib diisi.',
            'deskripsi_kerusakan.required' => 'Deskripsi kerusakan wajib diisi.',
        ]);

        LaporanFasilitas::create([
            'kategori_id' => $request->kategori_id,
            'nama_pelapor' => $request->nama_pelapor,
            'nomor_telepon' => $request->nomor_telepon,
            'lokasi_fasilitas' => $request->lokasi_fasilitas,
            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('smartresident.index')
            ->with('success', 'Laporan kerusakan fasilitas berhasil dikirim!');
    }
}
