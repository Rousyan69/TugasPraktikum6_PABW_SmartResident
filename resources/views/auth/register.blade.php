@extends('layouts.app')

@section('content')
<div style="max-width: 480px; margin: 2rem auto; background: white; padding: 2.25rem; border-radius: 14px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
    <div style="text-align: center; margin-bottom: 2rem;">
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 52px; height: 52px; background: #eff6ff; color: var(--primary); border-radius: 12px; font-size: 1.5rem; margin-bottom: 0.75rem;">
            📝
        </div>
        <h2 style="font-size: 1.6rem; font-weight: 700; color: var(--text-dark);">Daftar Akun Baru</h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">Bergabunglah dengan SmartResident untuk melaporkan dan memantau fasilitas umum.</p>
    </div>

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                class="form-control @error('name') is-invalid @enderror" 
                placeholder="Contoh: Budi Santoso" 
                required 
                autofocus
            >
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                class="form-control @error('email') is-invalid @enderror" 
                placeholder="nama@email.com" 
                required
            >
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="Minimal 8 karakter" 
                required
            >
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                placeholder="Ulangi password di atas" 
                required
            >
            @error('password_confirmation')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.75rem; font-size: 0.95rem; margin-top: 0.5rem;">
            Daftar Sekarang
        </button>
    </form>

    <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); text-align: center;">
        <p style="font-size: 0.9rem; color: var(--text-muted);">
            Sudah memiliki akun? 
            <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection
