@extends('layouts.app')

@section('content')
    <div style="max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
            <div>
                <h2 style="font-size: 1.5rem; font-weight: 700;">Form Pelaporan Kerusakan</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Isi formulir berikut untuk melaporkan fasilitas umum yang memerlukan perbaikan.</p>
            </div>
        </div>

        @auth
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.85rem; color: #166534; display: flex; align-items: center; gap: 8px;">
                <span>🔒</span> Terotentikasi sebagai warga terdaftar: <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})
            </div>
        @endauth

        <form action="{{ route('smartresident.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kategori_id">Kategori Fasilitas:</label>
                <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_pelapor">Nama Pelapor:</label>
                <input 
                    type="text" 
                    id="nama_pelapor" 
                    name="nama_pelapor" 
                    class="form-control @error('nama_pelapor') is-invalid @enderror" 
                    value="{{ old('nama_pelapor', auth()->user()->name ?? '') }}" 
                    placeholder="Masukkan nama Anda" 
                    required
                >
                @error('nama_pelapor')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon / WhatsApp:</label>
                <input 
                    type="text" 
                    id="nomor_telepon" 
                    name="nomor_telepon" 
                    class="form-control @error('nomor_telepon') is-invalid @enderror" 
                    value="{{ old('nomor_telepon') }}" 
                    placeholder="Contoh: 08123456789" 
                    required
                >
                @error('nomor_telepon')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="lokasi_fasilitas">Lokasi Fasilitas:</label>
                <input 
                    type="text" 
                    id="lokasi_fasilitas" 
                    name="lokasi_fasilitas" 
                    class="form-control @error('lokasi_fasilitas') is-invalid @enderror" 
                    value="{{ old('lokasi_fasilitas') }}" 
                    placeholder="Contoh: Jl. Telekomunikasi No. 1, Dayeuhkolot" 
                    required
                >
                @error('lokasi_fasilitas')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi_kerusakan">Deskripsi Kerusakan:</label>
                <textarea 
                    name="deskripsi_kerusakan" 
                    id="deskripsi_kerusakan" 
                    class="form-control @error('deskripsi_kerusakan') is-invalid @enderror" 
                    rows="4" 
                    placeholder="Jelaskan kondisi kerusakan fasilitas secara rinci..." 
                    required
                >{{ old('deskripsi_kerusakan') }}</textarea>
                @error('deskripsi_kerusakan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; align-items: center; margin-top: 1.5rem;">
                <a href="{{ route('smartresident.index') }}" class="btn-outline" style="text-align: center; flex: 1; justify-content: center;">
                    Batal
                </a>
                <button type="submit" class="btn-primary" style="flex: 2; justify-content: center; padding: 0.75rem;">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
@endsection
