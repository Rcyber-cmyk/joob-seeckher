<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan - {{ $lowongan->judul_lowongan }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
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
        body { background-color: var(--bg-main); font-family: 'Poppins', sans-serif; color: var(--dark-blue); overflow-x: hidden; }
        .sidebar { width: var(--sidebar-width); background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%); padding: 1.5rem 1rem; position: fixed; top: 0; left: 0; height: 100vh; z-index: 1100; display: flex; flex-direction: column; transition: var(--default-transition); }
        .sidebar .logo { font-weight: 700; font-size: 1.8rem; text-align: center; margin-bottom: 2rem; letter-spacing: 1px; color: var(--white); }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.85); padding: 0.75rem 1.2rem; margin-bottom: 0.3rem; border-radius: 0.75rem; display: flex; align-items: center; font-weight: 500; font-size: 0.95rem; transition: var(--default-transition); text-decoration: none; }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        .sidebar .user-profile { margin-top: auto; background-color: rgba(0,0,0,0.15); padding: 1rem; border-radius: var(--default-border-radius); }
        .main-wrapper { transition: var(--default-transition); }
        @media (min-width: 992px) { .main-wrapper { margin-left: var(--sidebar-width); } }
        @media (max-width: 991.98px) { .sidebar { transform: translateX(-100%); } .sidebar.active { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,0.3); } }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 1099; }
        .sidebar-overlay.active { display: block; }
        
        /* === Header & Components === */
        
        /* ========================================
         == PERUBAHAN CSS UNTUK HEADER STICKY ===
         ========================================
        */
        .main-content { 
            padding: 2.5rem; 
            padding-top: 0; /* Hapus padding atas */
        }
        
        .page-header { 
            margin-bottom: 0; /* Hapus margin-bottom */
            position: sticky; /* BUAT HEADER STICKY */
            top: 0;
            z-index: 1050; 
            background-color: var(--bg-main); 
            padding: 2.5rem; /* Pindahkan padding dari main-content ke sini */
            border-bottom: 1px solid #e2e8f0;
        }
        /* ========================================
         == AKHIR PERUBAHAN CSS 
         ========================================
        */

        .card-base {
            background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03);
            transition: var(--default-transition);
        }
        
        /* Style untuk detail */
        .detail-item {
            margin-bottom: 1.25rem;
        }
        .detail-item dt {
            font-weight: 600;
            color: var(--slate);
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }
        .detail-item dd {
            font-weight: 500;
            font-size: 1rem;
            margin-left: 0;
            color: var(--dark-blue);
        }

        /* ================================== */
        /* ==   STYLE RESPONSIVE MOBILE   == */
        /* ================================== */
        @media (max-width: 767.98px) {
            /* PERUBAHAN CSS MOBILE (HEADER STICKY) */
            .main-content {
                padding: 1.5rem; 
                padding-top: 0;
            }
            .page-header {
                padding: 1.5rem 1rem; 
                margin-bottom: 0;
            }
            /* AKHIR PERUBAHAN CSS MOBILE */
            
            .page-header h2 {
                font-size: 1.25rem;
            }
            .card-base {
                padding: 1.5rem;
            }
            /* Buat kolom info jadi full-width di mobile */
            .col-md-4 {
                margin-top: 2rem;
            }
        }

    </style>
</head>
<body>
    
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    
    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            <a class="nav-link {{ Request::routeIs('admin.perusahaan.*') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
            <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            <a class="nav-link {{ Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
            <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
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
                <h2 class="h4 mb-0 fw-bold">Detail Lowongan</h2>
                <p class="text-secondary small mb-0">{{ $lowongan->judul_lowongan }}</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </div>
        <div class="main-content">
            <div class="card-base">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="fw-bold">{{ $lowongan->judul_lowongan }}</h3>
                        <p class="fs-5 text-primary mb-4" style="color: var(--orange-dark) !important;">
                            <i class="bi bi-building"></i> 
                            {{ $lowongan->perusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}
                        </p>

                        <h5 class="fw-semibold mt-5 mb-3">Deskripsi Pekerjaan</h5>
                        <div class="deskripsi-content">
                            {!! $lowongan->deskripsi_pekerjaan !!}
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card-base" style="background-color: var(--bg-main);">
                            <h5 class="fw-semibold mb-3">Informasi Lowongan</h5>
                            <dl class="detail-item">
                                <dt>Domisili</dt>
                                <dd>{{ $lowongan->domisili ?? '-' }}</dd>
                            </dl>
                            <dl class="detail-item">
                                <dt>Tipe Pekerjaan</dt>
                                <dd>{{ $lowongan->tipe_pekerjaan ?? '-' }}</dd>
                            </dl>
                             <dl class="detail-item">
                                <dt>Pendidikan Terakhir</dt>
                                <dd>{{ $lowongan->pendidikan_terakhir ?? '-' }}</dd>
                            </dl>
                            <dl class="detail-item">
                                <dt>Pengalaman Kerja</dt>
                                <dd>{{ $lowongan->pengalaman_kerja ?? '-' }}</dd>
                            </dl>
                             <dl class="detail-item">
                                <dt>Gender</dt>
                                <dd>{{ $lowongan->gender ?? 'Semua' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.notifikasi.index') }}" class="btn btn-outline-secondary mt-4">
                    <i class="bi bi-arrow-left"></i> Kembali ke Notifikasi
                </a>
            </div>
            
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script yang sama dari halaman notifikasi
        document.addEventListener('DOMContentLoaded', function () {
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