@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.75rem; font-weight: 700;">Laporan Fasilitas Umum</h1>
        <p style="color: var(--text-muted);">Pantau status penanganan fasilitas publik di lingkungan sekitar Anda.</p>
    </div>

    <div class="grid-cards">
        @forelse ($laporan as $item)
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span style="font-size: 0.8rem; font-weight: 600; color: var(--primary); background: #eff6ff; padding: 4px 8px; border-radius: 6px;">
                        {{ $item->kategori->nama_kategori ?? 'Umum' }}
                    </span>
                    <span class="badge badge-{{ strtolower($item->status) }}">
                        {{ $item->status }}
                    </span>
                </div>
                <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem;">📍 {{ $item->lokasi_fasilitas }}</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem; line-height: 1.5;">
                    {{ $item->deskripsi_kerusakan }}
                </p>
                <div style="border-top: 1px solid var(--border-color); padding-top: 0.75rem; display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--text-muted);">
                    <span>Pelapor: <strong>{{ $item->nama_pelapor }}</strong></span>
                    <span>{{ $item->created_at->format('d M Y') }}</span>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: white; border-radius: 12px; border: 1px dashed var(--border-color);">
                <p style="color: var(--text-muted);">Belum ada laporan fasilitas yang masuk.</p>
            </div>
        @endforelse
    </div>
@endsection