@extends('layouts.app')

@section('content')
<div style="max-width: 460px; margin: 2rem auto; background: white; padding: 2.25rem; border-radius: 14px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
    <div style="text-align: center; margin-bottom: 2rem;">
        <div style="display: inline-flex; align-items: center; justify-content: center; width: 52px; height: 52px; background: #eff6ff; color: var(--primary); border-radius: 12px; font-size: 1.5rem; margin-bottom: 0.75rem;">
            🔐
        </div>
        <h2 style="font-size: 1.6rem; font-weight: 700; color: var(--text-dark);">Masuk ke Akun</h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.25rem;">Masukkan email dan password untuk mengakses akun Anda.</p>
    </div>

    @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
        <div class="alert-danger" style="font-size: 0.875rem;">
            Terjadi kesalahan pada input yang Anda berikan.
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

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
                autofocus
            >
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                <label for="password" style="margin-bottom: 0;">Password</label>
            </div>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="••••••••" 
                required
            >
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
            <label style="display: flex; align-items: center; gap: 8px; font-size: 0.875rem; color: var(--text-muted); cursor: pointer; font-weight: normal;">
                <input type="checkbox" name="remember" id="remember" style="accent-color: var(--primary); width: 16px; height: 16px;">
                Ingat sesi saya
            </label>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.75rem; font-size: 0.95rem;">
            Masuk
        </button>
    </form>

    <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); text-align: center;">
        <p style="font-size: 0.9rem; color: var(--text-muted);">
            Belum memiliki akun? 
            <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Daftar di sini</a>
        </p>
    </div>

    <!-- Kotak Info Pengujian Akun Dummy -->
    <div style="margin-top: 1.5rem; padding: 1rem; background: #f8fafc; border-radius: 8px; border: 1px dashed var(--border-color); font-size: 0.8rem; color: var(--text-muted);">
        <strong style="color: var(--text-dark); display: block; margin-bottom: 0.25rem;">💡 Akun Uji Coba (Seeder):</strong>
        Email: <code style="background: #e2e8f0; padding: 2px 4px; border-radius: 4px;">ahmad.fauzi@example.com</code><br>
        Password: <code style="background: #e2e8f0; padding: 2px 4px; border-radius: 4px;">password123</code>
    </div>
</div>
@endsection
