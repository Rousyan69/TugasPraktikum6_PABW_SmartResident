<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartResident - Pelaporan Fasilitas Umum</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-main: #f8fafc;
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --danger: #ef4444;
            --danger-bg: #fef2f2;
            --danger-border: #fecaca;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-main); color: var(--text-dark); min-height: 100vh; display: flex; flex-direction: column; }

        header {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            position: sticky; top: 0; z-index: 50;
        }
        .nav-container {
            max-width: 1100px; margin: 0 auto; padding: 0.9rem 1.5rem;
            display: flex; justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 1rem;
        }
        .logo { font-size: 1.25rem; font-weight: 700; color: var(--primary); text-decoration: none; display: flex; align-items: center; gap: 8px; }
        .logo span { color: var(--text-dark); }

        .nav-actions {
            display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
        }

        .user-greeting {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.875rem; color: var(--text-muted); font-weight: 500;
            background: #f1f5f9; padding: 0.4rem 0.8rem; border-radius: 9999px;
            border: 1px solid var(--border-color);
        }
        .user-greeting strong { color: var(--text-dark); }

        .btn-primary {
            background: var(--primary); color: white; padding: 0.55rem 1.15rem;
            border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.875rem;
            transition: background 0.2s, transform 0.1s; border: none; cursor: pointer;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-primary:hover { background: var(--primary-hover); }

        .btn-outline {
            background: transparent; color: var(--text-dark); padding: 0.55rem 1.15rem;
            border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.875rem;
            border: 1px solid var(--border-color); transition: all 0.2s; cursor: pointer;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-outline:hover { background: #f8fafc; border-color: #cbd5e1; color: var(--primary); }

        .btn-danger-outline {
            background: transparent; color: var(--danger); padding: 0.5rem 0.9rem;
            border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.85rem;
            border: 1px solid var(--danger-border); transition: all 0.2s; cursor: pointer;
        }
        .btn-danger-outline:hover { background: var(--danger-bg); }

        .container { max-width: 1100px; margin: 2rem auto; padding: 0 1.5rem; flex: 1; width: 100%; }

        .alert-success {
            background: #dcfce7; color: #166534; border: 1px solid #bbf7d0;
            padding: 0.9rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; font-weight: 500;
            display: flex; align-items: center; gap: 8px;
        }

        .alert-danger {
            background: var(--danger-bg); color: #991b1b; border: 1px solid var(--danger-border);
            padding: 0.9rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; font-weight: 500;
        }

        .grid-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; }
        .card {
            background: var(--card-bg); border: 1px solid var(--border-color);
            border-radius: 12px; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.08); }

        .badge {
            display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px;
            font-size: 0.75rem; font-weight: 600; text-transform: uppercase;
        }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-proses { background: #dbeafe; color: #1e40af; }
        .badge-selesai { background: #dcfce7; color: #166534; }

        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 0.4rem; font-size: 0.9rem; }
        .form-control {
            width: 100%; padding: 0.75rem; border: 1px solid var(--border-color);
            border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s;
        }
        .form-control:focus { border-color: var(--primary); }
        .form-control.is-invalid { border-color: var(--danger); background-color: #fffaf0; }

        .invalid-feedback {
            color: var(--danger); font-size: 0.8rem; margin-top: 0.35rem; display: block; font-weight: 500;
        }

        footer {
            border-top: 1px solid var(--border-color); background: #ffffff;
            padding: 1.5rem; text-align: center; color: var(--text-muted); font-size: 0.85rem;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <a href="{{ route('smartresident.index') }}" class="logo">
                🏢 Smart<span>Resident</span>
            </a>

            <div class="nav-actions">
                @auth
                    <div class="user-greeting">
                        <span>👤</span> Halo, <strong>{{ Auth::user()->name }}</strong>
                    </div>
                    <a href="{{ route('smartresident.create') }}" class="btn-primary">
                        <span>+</span> Buat Laporan
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-danger-outline" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('smartresident.create') }}" class="btn-outline">
                        <span>+</span> Lapor Masalah
                    </a>
                    <a href="{{ route('login') }}" class="btn-outline">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </header>

    <div class="container">
        @if (session('success'))
            <div class="alert-success">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-danger">
                <span>⚠</span> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} SmartResident - Sistem Informasi Pengaduan Fasilitas Publik. Tugas Pemrograman Web.</p>
    </footer>
</body>
</html>
