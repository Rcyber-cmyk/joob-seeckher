<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Perusahaan: {{ $perusahaan->nama_perusahaan }}</title>
    
    {{-- Menggunakan style yang sama dengan halaman index --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
            --dark-blue: #1e293b;
            --slate: #64748b;
            --light-gray: #f8fafc;
            --white: #ffffff;
            --sidebar-width: 260px;
            --default-border-radius: 0.75rem;
            --bs-primary-rgb: 30, 41, 59;
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-blue);
        }

        /* === Sidebar & Layout (Sama seperti halaman sebelumnya) === */
        .sidebar {
            width: var(--sidebar-width);
            background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%);
            color: var(--white);
            padding: 1.5rem 1rem;
            position: fixed; top: 0; left: 0; height: 100vh;
            z-index: 1100; display: none; flex-direction: column;
        }
        .sidebar .logo { font-weight: 700; font-size: 1.8rem; text-align: center; margin-bottom: 2rem; letter-spacing: 1px; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.8); padding: 0.75rem 1.2rem; margin-bottom: 0.25rem; border-radius: var(--default-border-radius); display: flex; align-items: center; font-weight: 500; text-decoration: none; transition: all 0.2s ease-in-out; }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.2rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        .sidebar .user-profile { margin-top: auto; padding-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.2); }
        .main-wrapper { padding: 2rem; }
        @media (min-width: 992px) {
            .sidebar { display: flex; }
            .main-wrapper { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); }
        }
        @media (max-width: 991.98px) { .main-wrapper { padding: 1.5rem; } }
        .sidebar-mobile { background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%); color: var(--white); }
        .sidebar-mobile .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }

        /* === Halaman Detail (BARU) === */
        .custom-card {
            background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
            border: none;
        }
        .company-header-logo { width: 80px; height: 80px; object-fit: cover; border-radius: var(--default-border-radius); border: 3px solid var(--light-gray); }
        .detail-list .detail-item { display: flex; align-items: flex-start; margin-bottom: 1.25rem; }
        .detail-list .detail-icon {
            flex-shrink: 0; width: 40px; height: 40px;
            background-color: var(--light-gray); color: var(--dark-blue);
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 50%; margin-right: 1rem; font-size: 1.2rem;
        }
        .detail-list .detail-content .label { font-weight: 600; color: var(--dark-blue); display: block; }
        .detail-list .detail-content .value { color: var(--slate); }
        .job-list-card .list-group-item {
            display: flex; justify-content: space-between; align-items: center;
            padding: 1rem 0; border-bottom: 1px solid #eee;
        }
        .job-list-card .list-group-item:last-child { border-bottom: none; }
    </style>
</head>
<body>
    {{-- SIDEBAR DESKTOP --}}
    <aside class="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link" href="#"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link" href="#"><i class="bi bi-people-fill"></i> Pelamar</a>
            <a class="nav-link active" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
            <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
            <a class="nav-link" href="#"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
            <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
            <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>
        </nav>
        <div class="user-profile">
             <div class="d-flex align-items-center">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="Admin">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="opacity-75">Admin</small>
                </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="main-wrapper">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1 fw-bold">Detail Perusahaan</h2>
                <p class="text-secondary mb-0">Informasi lengkap mengenai perusahaan terdaftar.</p>
            </div>
            <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </header>

        <div class="row">
            <div class="col-lg-8">
                <div class="custom-card">
                    {{-- Header Perusahaan --}}
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('storage/' . $perusahaan->logo_perusahaan) }}" alt="Logo" class="company-header-logo me-4" 
                             onerror="this.onerror=null; this.src='https://placehold.co/80x80/f8fafc/64748b?text={{ substr($perusahaan->nama_perusahaan, 0, 1) }}';">
                        <div>
                            <h3 class="fw-bold mb-1">{{ $perusahaan->nama_perusahaan }}</h3>
                            <p class="text-muted mb-0"><i class="bi bi-geo-alt-fill me-1"></i>{{ $perusahaan->alamat_kota ?? 'Lokasi tidak tersedia' }}</p>
                        </div>
                    </div>
                    <hr>
                    
                    {{-- Daftar Detail Informasi --}}
                    <div class="detail-list mt-4">
                        <div class="detail-item">
                            <div class="detail-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div class="detail-content">
                                <span class="label">Email Akun</span>
                                <span class="value">{{ $perusahaan->user->email }}</span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon"><i class="bi bi-telephone-fill"></i></div>
                            <div class="detail-content">
                                <span class="label">No. Telepon</span>
                                <span class="value">{{ $perusahaan->no_telp_perusahaan ?? 'Tidak dicantumkan' }}</span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon"><i class="bi bi-globe"></i></div>
                            <div class="detail-content">
                                <span class="label">Situs Web</span>
                                <span class="value">
                                    @if($perusahaan->situs_web)
                                        <a href="{{ $perusahaan->situs_web }}" target="_blank" rel="noopener noreferrer">{{ $perusahaan->situs_web }}</a>
                                    @else
                                        Tidak dicantumkan
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon"><i class="bi bi-pin-map-fill"></i></div>
                            <div class="detail-content">
                                <span class="label">Alamat Lengkap</span>
                                <span class="value">{{ $perusahaan->alamat_jalan ?? 'Tidak dicantumkan' }}, {{ $perusahaan->alamat_kota }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi Perusahaan --}}
                    <div class="mt-4">
                        <h5 class="fw-bold">Tentang Perusahaan</h5>
                        <p class="text-secondary" style="text-align: justify;">
                            {{ $perusahaan->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="custom-card job-list-card">
                    <h5 class="fw-bold mb-3"><i class="bi bi-briefcase-fill me-2"></i>Lowongan Aktif</h5>
                    <ul class="list-group list-group-flush">
                        @forelse($perusahaan->lowonganPekerjaan as $lowongan)
                            <li class="list-group-item">
                                <div>
                                    <strong class="d-block">{{ $lowongan->judul_lowongan }}</strong>
                                    <small class="text-muted">{{ $lowongan->tipe_pekerjaan }} - {{ $lowongan->lokasi }}</small>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-secondary">Detail</a>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted p-3">
                                Tidak ada lowongan aktif saat ini.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>