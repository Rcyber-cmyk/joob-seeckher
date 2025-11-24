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
            --dark-blue: #0f172a; /* Diubah agar konsisten dengan view sebelumnya */
            --slate: #475569; /* Diubah agar konsisten dengan view sebelumnya */
            --light-gray: #f1f5f9; /* Diubah agar konsisten dengan view sebelumnya */
            --white: #ffffff;
            --sidebar-width: 260px;
            --default-border-radius: 0.75rem;
            --border-color: #e2e8f0;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-blue);
            overflow-x: hidden;
        }

        /* === Sidebar & Layout (DISAMAKAN) === */
        .sidebar {
            width: var(--sidebar-width);
            background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%);
            color: var(--white);
            padding: 1.5rem 1rem;
            position: fixed; top: 0; left: 0; height: 100vh;
            z-index: 1100; display: flex; flex-direction: column; 
            transition: var(--default-transition);
        }
        .sidebar.active { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,0.3); }

        .sidebar .logo { font-weight: 700; font-size: 1.8rem; text-align: center; margin-bottom: 2rem; letter-spacing: 1px; }
        
        .sidebar .nav {
            overflow-y: auto; 
            overflow-x: hidden;
            flex-grow: 1; 
        }
        .sidebar .user-profile { 
            margin-top: 1rem; 
            background-color: rgba(0,0,0,0.15); 
            padding: 0.75rem; 
            border-radius: var(--default-border-radius);
            flex-shrink: 0; 
        }

        .sidebar .nav-link { 
            color: rgba(255, 255, 255, 0.85); 
            padding: 0.6rem 1.2rem; 
            margin-bottom: 0.2rem; 
            border-radius: 0.75rem;
            display: flex; 
            align-items: center; 
            font-weight: 500; 
            font-size: 0.9rem;
            transition: var(--default-transition); 
            text-decoration: none; 
        }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        
        /* Tambahan style profil di sidebar */
        .sidebar .user-profile .d-flex .fw-bold { font-size: 0.9rem; }
        .sidebar .user-profile .d-flex small { font-size: 0.8rem; }
        .sidebar .user-profile .d-flex img { width: 32px; height: 32px; margin-right: 0.75rem !important; }
        .sidebar .user-profile .nav-link.mt-2 { margin-top: 0.5rem !important; padding: 0.5rem 0.75rem; font-size: 0.9rem; margin-bottom: 0 !important; }

        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 1099; }
        .sidebar-overlay.active { display: block; }


        .main-wrapper { padding: 2.5rem; transition: var(--default-transition); }

        @media (min-width: 992px) {
            .sidebar { transform: translateX(0); } /* Tampilkan di desktop */
            .main-wrapper { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); }
        }
        @media (max-width: 991.98px) { .main-wrapper { padding: 1.5rem; } }


        /* === Halaman Detail (Detail Content Styles) === */
        .custom-card {
            background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
            border: 1px solid var(--border-color); /* Tambahkan border konsisten */
        }
        .company-header-logo { 
            width: 80px; 
            height: 80px; 
            object-fit: cover; 
            border-radius: var(--default-border-radius); 
            border: 3px solid var(--light-gray); 
            box-shadow: 0 0 0 1px rgba(0,0,0,0.05); /* Tambahkan sedikit bayangan */
        }
        .detail-list .detail-item { 
            display: flex; 
            align-items: flex-start; 
            margin-bottom: 1.25rem; 
        }
        .detail-list .detail-icon {
            flex-shrink: 0; width: 40px; height: 40px;
            background-color: var(--light-gray); color: var(--dark-blue);
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 50%; margin-right: 1rem; font-size: 1.2rem;
        }
        .detail-list .detail-content {
            flex-grow: 1; /* Agar konten mengambil sisa ruang */
        }
        .detail-list .detail-content .label { font-weight: 600; color: var(--dark-blue); display: block; font-size: 0.9rem;}
        .detail-list .detail-content .value { color: var(--slate); font-size: 0.9rem; }
        
        .job-list-card .list-group-item {
            display: flex; justify-content: space-between; align-items: center;
            padding: 1rem 0; 
            border-bottom: 1px solid var(--border-color); /* Ubah ke variabel */
        }
        .job-list-card .list-group-item:last-child { border-bottom: none; }
        
        /* HEADER MOBILE TOGGLER */
        .page-header-container { 
            background-color: var(--light-gray); 
            padding-bottom: 1.5rem; 
            border-bottom: 1px solid var(--border-color); 
            padding-top: 2.5rem; /* Tambahkan padding atas agar tidak terlalu mepet */
        }
        @media (max-width: 991.98px) {
            .page-header-container {
                padding-top: 1.5rem;
                padding-left: 0;
                padding-right: 0;
            }
        }
    </style>
</head>
<body>
    {{-- OVERLAY MOBILE --}}
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    {{-- SIDEBAR DESKTOP & MOBILE --}}
    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column flex-grow-1"> 
            {{-- Navigasi Utama --}}
            <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            
            @php
                // Tentukan apakah ada sub-menu Perusahaan yang aktif
                // (Halaman ini adalah bagian dari Perusahaan, jadi ini pasti true)
                $isPerusahaanActive = Request::routeIs('admin.perusahaan.*') || 
                                      Request::routeIs('admin.kandidat.index') || 
                                      Request::routeIs('admin.iklan.*') ||
                                      Request::routeIs('admin.jadwalwawancara.index');
            @endphp
            
            {{-- Tombol Toggler Utama: Perusahaan (sekarang aktif) --}}
            <a class="nav-link {{ $isPerusahaanActive ? 'active' : '' }}" 
               data-bs-toggle="collapse" 
               href="#perusahaanSubmenu" 
               role="button" 
               aria-expanded="{{ $isPerusahaanActive ? 'true' : 'false' }}" 
               aria-controls="perusahaanSubmenu">
                 <i class="bi bi-building-fill"></i> Perusahaan
                 <i class="bi {{ $isPerusahaanActive ? 'bi-chevron-down' : 'bi-chevron-right' }} ms-auto" style="font-size: 0.8rem;"></i>
            </a>

            {{-- Konten Submenu --}}
            <div class="collapse {{ $isPerusahaanActive ? 'show' : '' }}" id="perusahaanSubmenu">
                {{-- Tautan List Perusahaan aktif karena ini halaman detail perusahaan --}}
                <a class="nav-link ps-5 {{ Request::routeIs('admin.perusahaan.index') || Request::routeIs('admin.perusahaan.show') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}">
                    <i class="bi bi-diagram-3-fill"></i> List Perusahaan
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}">
                    <i class="bi bi-person-check-fill"></i> Kandidat
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.iklan.*') ? 'active' : '' }}" href="{{ route('admin.iklan.index') }}">
                    <i class="bi bi-megaphone-fill"></i> Iklan Lowongan
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.jadwalwawancara.index') ? 'active' : '' }}" href="{{ route('admin.jadwalwawancara.index') }}"><i class="bi bi-calendar-check-fill"></i> Interview</a>
            </div>
            
            <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            <a class="nav-link {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>

            <a class="nav-link {{ Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
        </nav>
        
        <div class="user-profile">
            <div class="d-flex align-items-center text-white">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="Admin">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="opacity-75">Admin</small>
                </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="main-wrapper">
        {{-- Header dengan Mobile Toggler --}}
        <div class="page-header-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <button class="btn btn-link d-lg-none p-0 me-3" type="button" id="sidebar-toggler">
                    <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
                </button>
                <div>
                    <h2 class="mb-1 fw-bold">Detail Perusahaan</h2>
                    <p class="text-secondary mb-0">Informasi lengkap mengenai perusahaan terdaftar.</p>
                </div>
                <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-outline-primary ms-auto">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

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
                    <div class="detail-list mt-4 row">
                        <div class="detail-item col-md-6">
                            <div class="detail-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div class="detail-content">
                                <span class="label">Email Akun</span>
                                {{-- Mengakses email melalui relasi user --}}
                                <span class="value">{{ $perusahaan->user->email ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="detail-item col-md-6">
                            <div class="detail-icon"><i class="bi bi-telephone-fill"></i></div>
                            <div class="detail-content">
                                <span class="label">No. Telepon</span>
                                <span class="value">{{ $perusahaan->no_telp_perusahaan ?? 'Tidak dicantumkan' }}</span>
                            </div>
                        </div>
                        <div class="detail-item col-md-6">
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
                        <div class="detail-item col-md-6">
                            <div class="detail-icon"><i class="bi bi-card-heading"></i></div>
                            <div class="detail-content">
                                <span class="label">Status Akun</span>
                                <span class="value">
                                    @if ($perusahaan->is_premium)
                                        <span class="badge bg-warning text-dark">Premium</span>
                                    @else
                                        <span class="badge bg-secondary">Standar</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="detail-item col-12">
                            <div class="detail-icon"><i class="bi bi-pin-map-fill"></i></div>
                            <div class="detail-content">
                                <span class="label">Alamat Lengkap</span>
                                <span class="value">{{ $perusahaan->alamat_jalan ?? 'Tidak dicantumkan' }}, {{ $perusahaan->alamat_kota }}, {{ $perusahaan->kode_pos }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi Perusahaan --}}
                    <div class="mt-4 pt-4 border-top">
                        <h5 class="fw-bold">Tentang Perusahaan</h5>
                        <p class="text-secondary" style="text-align: justify;">
                            {{ $perusahaan->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="custom-card job-list-card">
                    <h5 class="fw-bold mb-3"><i class="bi bi-briefcase-fill me-2"></i>Lowongan Aktif ({{ $perusahaan->lowonganPekerjaan->count() }})</h5>
                    <ul class="list-group list-group-flush">
                        @forelse($perusahaan->lowonganPekerjaan->where('is_active', 1) as $lowongan)
                            <li class="list-group-item">
                                <div>
                                    <strong class="d-block">{{ $lowongan->judul_lowongan }}</strong>
                                    {{-- Menggunakan domisili (kota) dan tipe_pekerjaan dari skema DB --}}
                                    <small class="text-muted">{{ $lowongan->tipe_pekerjaan ?? 'Full-time' }} - {{ $lowongan->domisili ?? $perusahaan->alamat_kota }}</small>
                                </div>
                                {{-- Link ke detail lowongan, asumsi route: admin.lowongan.show --}}
                                <a href="{{ route('admin.lowongan.show', $lowongan->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
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
    <script>
        // === Mobile Sidebar Toggle Script ===
        document.addEventListener('DOMContentLoaded', function () {
            // Ini sudah dikodekan agar sidebar defaultnya hidden di mobile (< 992px)
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggler = document.getElementById('sidebar-toggler');

            // Tambahkan kelas 'active' pada sidebar dan overlay saat toggler diklik
            if (toggler) {
                toggler.addEventListener('click', () => {
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                });
            }
            // Hapus kelas 'active' (tutup sidebar) saat overlay diklik
            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            // Atur status tampilan sidebar default untuk desktop saat page load
            // Jika lebar > 992px, pastikan sidebar muncul
            if (window.innerWidth >= 992) {
                sidebar.style.transform = 'translateX(0)';
            }
        });
    </script>
</body>
</html>