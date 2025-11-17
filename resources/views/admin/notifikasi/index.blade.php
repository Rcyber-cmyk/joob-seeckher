<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Admin - Job Recruitment</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === SEMUA STYLE LAMA ANDA TETAP SAMA === */
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
            --dark-blue: #0f172a; 
            --slate: #475569;
            --slate-light: #94a3b8;
            --bg-main: #f1f5f9; 
            --white: #ffffff;
            --sidebar-width: 260px;
            --default-border-radius: 1rem;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        body {
            background-color: var(--bg-main);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-blue);
            overflow-x: hidden;
        }

        /* === Sidebar (Desktop & Mobile) === */
        .sidebar {
            width: var(--sidebar-width);
            background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%);
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            transition: var(--default-transition);
        }
        .sidebar .logo { font-weight: 700; font-size: 1.8rem; text-align: center; margin-bottom: 2rem; letter-spacing: 1px; color: var(--white); }
        
        /* ========================================
         == PERUBAHAN CSS UNTUK SIDEBAR SCROLL ==
         ========================================
        */
        .sidebar .nav {
            overflow-y: auto; /* Membuat area link bisa di-scroll */
            overflow-x: hidden;
            flex-grow: 1; /* Memastikan nav mengambil sisa ruang */
        }
        .sidebar .user-profile { 
            margin-top: 1rem; /* Beri jarak dari nav */
            background-color: rgba(0,0,0,0.15); 
            padding: 0.75rem; /* PERKECIL PADDING */
            border-radius: var(--default-border-radius);
            flex-shrink: 0; /* Mencegah user-profile ikut ter-scroll */
        }
        /* ========================================
         == AKHIR PERUBAHAN CSS 
         ========================================
        */

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            /* PERUBAHAN: Jarak diperkecil */
            padding: 0.6rem 1.2rem; /* Diperkecil dari 0.75rem */
            margin-bottom: 0.2rem; /* Diperkecil dari 0.3rem */
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.9rem; /* Diperkecil dari 0.95rem */
            transition: var(--default-transition);
            text-decoration: none;
        }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        
        /* ========================================
         == CSS BARU UNTUK MEMPERKECIL PROFIL ==
         ========================================
        */
        .sidebar .user-profile .d-flex .fw-bold {
            font-size: 0.9rem; /* Perkecil nama */
        }
        .sidebar .user-profile .d-flex small {
            font-size: 0.8rem; /* Perkecil "Admin" */
        }
        .sidebar .user-profile .d-flex img {
            width: 32px; /* Perkecil avatar */
            height: 32px;
            margin-right: 0.75rem !important; /* Perkecil margin */
        }
        .sidebar .user-profile .nav-link.mt-2 {
            /* Perkecil link logout */
            margin-top: 0.5rem !important;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            margin-bottom: 0 !important;
        }
        /* ========================================
         == AKHIR PERUBAHAN CSS 
         ========================================
        */
        
        /* === Main Wrapper === */
        .main-wrapper {
            transition: var(--default-transition);
        }
        @media (min-width: 992px) {
            .main-wrapper { margin-left: var(--sidebar-width); }
        }
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,0.3); }
        }

        /* === Mobile Overlay === */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1099;
        }
        .sidebar-overlay.active { display: block; }
        
        /* === Header & Components === */
        
        /* CSS UNTUK HEADER STICKY */
        .main-content { 
            padding: 2.5rem; 
            padding-top: 0; 
        }
        .page-header { 
            margin-bottom: 0; 
            position: sticky; 
            top: 0;
            z-index: 1050; 
            background-color: var(--bg-main); 
            padding: 2.5rem; 
            border-bottom: 1px solid #e2e8f0;
        }

        .card-base {
            background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03);
            transition: var(--default-transition);
        }
        /* Style card-base biasa (tanpa hover) */
        .card-base-no-hover {
             background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03);
        }
        
        /* === CSS BARU UNTUK LIST NOTIFIKASI === */
        .notifikasi-list .list-group-item {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            transition: var(--default-transition);
        }
        .notifikasi-list .list-group-item:last-child {
            border-bottom: none;
        }
        .notifikasi-list .list-group-item:hover {
            background-color: var(--bg-main);
        }
        .notifikasi-list .notifikasi-icon {
            flex-shrink: 0;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background-color: var(--icon-bg, var(--slate));
            color: var(--icon-color, var(--white));
        }
         /* Style untuk notifikasi yang belum dibaca (contoh, bisa Anda terapkan nanti) */
        .notifikasi-list .notifikasi-unread {
            background-color: #fffbeb;
            border-left: 4px solid var(--orange);
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .notifikasi-list .notifikasi-read {
            background-color: var(--white);
            border-left: 4px solid transparent;
            margin-bottom: 0.5rem;
        }

        /* CSS untuk Stat Card Ringkasan */
        .stat-card-summary {
            background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
        }
        .stat-card-summary .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--white);
            background-image: linear-gradient(135deg, var(--color-from) 0%, var(--color-to) 100%);
            margin-right: 1rem;
        }
         .stat-card-summary h3 {
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 1.75rem;
            margin-bottom: 0;
        }
        .stat-card-summary small {
            color: var(--slate);
            font-weight: 500;
            display: block;
            margin-top: -5px;
        }
        
        /* CSS Tambahan untuk membuat item list bisa diklik */
        .notifikasi-list a.list-group-item {
            text-decoration: none;
            color: var(--dark-blue);
        }
        .notifikasi-list a.list-group-item .text-primary {
             color: var(--orange-dark) !important; /* Paksa warna oranye */
        }
        
        /* ================================== */
        /* ==   STYLE RESPONSIVE MOBILE   == */
        /* ================================== */
        @media (max-width: 767.98px) {
            .main-content {
                padding: 1.5rem; 
                padding-top: 0;
            }
            .page-header {
                padding: 1.5rem 1rem; 
                margin-bottom: 0;
            }
            .page-header h2 {
                font-size: 1.25rem;
            }
            .card-base-no-hover {
                padding: 1.25rem;
            }
            .stat-card-summary {
                padding: 1rem;
            }
            .stat-card-summary h3 {
                font-size: 1.5rem;
            }
            .stat-card-summary .icon {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column"> <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            <a class="nav-link {{ Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}"><i class="bi bi-person-check-fill"></i> Kandidat</a>
            <a class="nav-link {{ Request::routeIs('admin.perusahaan.*') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            <a class="nav-link" href="{{ route('admin.iklan.index') }}">
                <i class="bi bi-megaphone-fill"></i> Iklan
            </a>
            <a class="nav-link" href="#"><i class="bi bi-newspaper"></i> Berita</a>
            <a class="nav-link active" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
        </nav>
        <div class="user-profile">
            <div class="d-flex align-items-center text-white">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="User">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="opacity-75">Admin</small>
                </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
        </div>
    </aside>

    <main class="main-wrapper">
        
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold">Notifikasi</h2>
                <p class="text-secondary small mb-0">Semua pemberitahuan dan aktivitas terbaru.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </div>
        <div class="main-content">
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-summary h-100">
                        <div class="icon" style="--color-from: #3b82f6; --color-to: #60a5fa;"><i class="bi bi-people-fill"></i></div>
                        <div>
                            <h3>{{ $summary['Pendaftaran Pelamar']->total ?? 0 }}</h3>
                            <small>Total Pelamar Baru</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-summary h-100">
                        <div class="icon" style="--color-from: #10b981; --color-to: #34d399;"><i class="bi bi-building-fill"></i></div>
                        <div>
                            <h3>{{ $summary['Pendaftaran Perusahaan']->total ?? 0 }}</h3>
                            <small>Total Perusahaan Baru</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-summary h-100">
                        <div class="icon" style="--color-from: #8b5cf6; --color-to: #a78bfa;"><i class="bi bi-shop"></i></div>
                        <div>
                            <h3>{{ $summary['Pendaftaran UMKM']->total ?? 0 }}</h3>
                            <small>Total UMKM Baru</small>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card-base-no-hover h-100">
                        <h5 class="mb-4 fw-semibold">Lowongan Pekerjaan Terbaru</h5>
                        <ul class="list-group list-group-flush notifikasi-list">
                            
                            @forelse($recentVacancies as $lowongan)
                                <a href="{{ route('admin.lowongan.show', $lowongan->id) }}" class="list-group-item list-group-item-action d-flex align-items-start notifikasi-read">
                                    <div class="notifikasi-icon" style="--icon-bg: #f59e0b; --icon-color: #ffffff;">
                                        <i class="bi bi-briefcase-fill"></i>
                                    </div>
                                    <div class="ms-3 flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="mb-1 text-primary">{{ $lowongan->judul_lowongan }}</strong>
                                            <small class="text-muted">{{ $lowongan->created_at->diffForHumans() }}</small>
                                        </div>
                                        <span class="d-block">
                                            Diposting oleh <strong>{{ $lowongan->perusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}</strong>
                                        </span>
                                    </div>
                                </a>
                            @empty
                            <li class="list-group-item text-center text-muted py-5">
                                <i class="bi bi-briefcase fs-3 d-block mb-2"></i>
                                <span>Belum ada lowongan baru.</span>
                            </li>
                            @endforelse
                            
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card-base-no-hover h-100">
                        <h5 class="mb-4 fw-semibold">Semua Aktivitas Pendaftaran</h5>
                        
                        <ul class="list-group list-group-flush notifikasi-list">
                            
                            @forelse($allActivities as $activity)
                                @php
                                    $link = '#'; // Link default jika tidak ada user/profile
                                    if ($activity->user) {
                                        if ($activity->activity_type == 'Pendaftaran Pelamar') {
                                            $link = route('admin.pelamar.show', $activity->user->id);
                                        } 
                                        elseif ($activity->activity_type == 'Pendaftaran Perusahaan' && $activity->user->perusahaanProfile) {
                                            $link = route('admin.perusahaan.show', $activity->user->perusahaanProfile->id);
                                        } 
                                        elseif ($activity->activity_type == 'Pendaftaran UMKM' && $activity->user->umkmProfile) {
                                            // Asumsi Anda punya route 'admin.umkm.show'
                                            $link = route('admin.umkm.show', $activity->user->umkmProfile->id); 
                                        }
                                    }
                                @endphp

                                <a href="{{ $link }}" class="list-group-item list-group-item-action d-flex align-items-start notifikasi-read">
                                    
                                    @php
                                        $icon = 'bi-bell-fill';
                                        $color = '#475569'; // slate
                                        if ($activity->activity_type == 'Pendaftaran Pelamar') {
                                            $icon = 'bi-person-plus-fill';
                                            $color = '#3b82f6'; // blue
                                        } elseif ($activity->activity_type == 'Pendaftaran Perusahaan') {
                                            $icon = 'bi-building-add';
                                            $color = '#10b981'; // green
                                        } elseif ($activity->activity_type == 'Pendaftaran UMKM') {
                                            $icon = 'bi-shop';
                                            $color = '#8b5cf6'; // purple
                                        }
                                    @endphp

                                    <div class="notifikasi-icon" style="--icon-bg: {{ $color }}; --icon-color: #ffffff;">
                                        <i class="bi {{ $icon }}"></i>
                                    </div>
                                    
                                    <div class="ms-3 flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong class="mb-1">{{ $activity->activity_type }}</strong>
                                            <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                        </div>
                                        <span class="d-block">
                                            {!! $activity->description !!} 
                                        </span>
                                    </div>
                                </a>
                            @empty
                            <li class="list-group-item text-center text-muted py-5">
                                <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
                                <span>Tidak ada aktivitas untuk Anda.</span>
                            </li>
                            @endforelse
                        </ul>
                        
                        <nav class="mt-4 d-flex justify-content-center">
                            {{ $allActivities->links() }}
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile Sidebar Toggle
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggler = document.getElementById('sidebar-toggler');

            if (toggler) {
                toggler.addEventListener('click', () => {
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                });
            }
            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>