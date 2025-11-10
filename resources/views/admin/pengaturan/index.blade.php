<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Job Recruitment</title>
    
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
        
        body {
            background-color: var(--bg-main);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-blue);
            overflow-x: hidden;
        }

        /* === Sidebar (Sama) === */
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
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.75rem 1.2rem;
            margin-bottom: 0.3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--default-transition);
            text-decoration: none;
        }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        .sidebar .user-profile { margin-top: auto; background-color: rgba(0,0,0,0.15); padding: 1rem; border-radius: var(--default-border-radius); }
        
        /* === Main Wrapper (Sama) === */
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

        /* === Mobile Overlay (Sama) === */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1099;
        }
        .sidebar-overlay.active { display: block; }
        
        /* === Components (Sama) === */
        .main-content { padding: 2.5rem; }
        .page-header { margin-bottom: 2.5rem; }
        .card-base {
            background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03);
            transition: var(--default-transition);
        }
        /* card-base tanpa hover, cocok untuk konten statis seperti form */
        .card-base-no-hover {
            background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03);
        }

        /* === STYLE BARU UNTUK PENGATURAN === */
        .nav-tabs {
            border-bottom: 2px solid #e2e8f0; /* Beri garis bawah solid */
        }
        .nav-tabs .nav-link {
            border: none;
            color: var(--slate);
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px; /* Sejajarkan dengan border-bottom .nav-tabs */
        }
        .nav-tabs .nav-link.active {
            color: var(--orange-dark);
            border-color: var(--orange-dark);
            background-color: transparent;
        }
        
        /* Tombol Oranye Kustom */
        .btn-orange {
            background-color: var(--orange);
            color: var(--white);
            border-color: var(--orange);
            font-weight: 600;
            padding: 0.6rem 1.25rem;
            transition: var(--default-transition);
        }
        .btn-orange:hover {
            background-color: var(--orange-dark);
            border-color: var(--orange-dark);
            color: var(--white);
        }

        /* ================================== */
        /* ==   STYLE RESPONSIVE MOBILE BARU   == */
        /* ================================== */
        @media (max-width: 767.98px) {
            .main-content {
                padding: 1rem; /* Kurangi padding utama */
            }
            .page-header {
                margin-bottom: 1.5rem;
            }
            .page-header h2 {
                font-size: 1.25rem; /* Kecilkan judul utama */
            }
            .card-base-no-hover {
                padding: 1.25rem; /* Kurangi padding di kartu form */
            }

            /* --- Style untuk Scrolling Tabs on Mobile --- */
            .nav-tabs {
                flex-wrap: nowrap; /* Mencegah tabs turun ke baris baru */
                overflow-x: auto; /* Memungkinkan scroll horizontal */
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch; /* Scroll mulus di iOS */
                
                /* Sembunyikan scrollbar (opsional tapi rapi) */
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }
            .nav-tabs::-webkit-scrollbar {
                display: none; /* Chrome, Safari, Opera */
            }
            .nav-tabs .nav-link {
                white-space: nowrap; /* Jaga teks tab di satu baris */
                font-size: 0.9rem; /* Sedikit kecilkan font tab */
            }
        }
    </style>
</head>
<body>
    
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            <a class="nav-link" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
            <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
            <a class="nav-link" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            <a class="nav-link {{ Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
            <a class="nav-link active" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
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
        <div class="main-content">
            
            <div class="page-header d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 mb-0 fw-bold">Pengaturan</h2>
                    <p class="text-secondary small mb-0">Kelola profil admin dan pengaturan aplikasi Anda.</p>
                </div>
                <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                    <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
                </button>
            </div>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-profil-tab" data-bs-toggle="tab" data-bs-target="#nav-profil" type="button" role="tab" aria-controls="nav-profil" aria-selected="true">
                        <i class="bi bi-person-fill me-2"></i>Profil Admin
                    </button>
                    <button class="nav-link" id="nav-password-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-password" aria-selected="false">
                        <i class="bi bi-key-fill me-2"></i>Ubah Password
                    </button>
                    <button class="nav-link" id="nav-umum-tab" data-bs-toggle="tab" data-bs-target="#nav-umum" type="button" role="tab" aria-controls="nav-umum" aria-selected="false">
                        <i class="bi bi-sliders me-2"></i>Umum
                    </button>
                </div>
            </nav>

            <div class="tab-content mt-4" id="nav-tabContent">
                
                <div class="tab-pane fade show active" id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab">
                    <div class="card-base-no-hover">
                        <div class="row">
                            <div class="col-lg-7">
                                <h5 class="fw-semibold mb-4">Informasi Profil</h5>
                                <form action="" method="POST">
                                    @csrf
                                    @method('PUT') 
                                    
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-lg" id="nama_lengkap" name="name" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ Auth::user()->email }}">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-orange mt-3">
                                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                    <div class="card-base-no-hover">
                        <div class="row">
                            <div class="col-lg-7">
                                <h5 class="fw-semibold mb-4">Ubah Password</h5>
                                <form action="" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Password Saat Ini</label>
                                        <input type="password" class="form-control form-control-lg" id="current_password" name="current_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control form-control-lg" id="new_password_confirmation" name="new_password_confirmation" required>
                                    </div>

                                    <button type="submit" class="btn btn-orange mt-3">
                                        <i class="bi bi-key-fill me-2"></i>Ubah Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-umum" role="tabpanel" aria-labelledby="nav-umum-tab">
                    <div class="card-base-no-hover">
                        <h5 class="fw-semibold mb-4">Pengaturan Umum</h5>
                        <p class="text-muted">Pengaturan untuk seluruh aplikasi.</p>
                        
                        <div class="form-check form-switch fs-5 mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="emailNotif" checked>
                            <label class="form-check-label" for="emailNotif">Aktifkan notifikasi email untuk pendaftar baru</label>
                        </div>

                        <div class="form-check form-switch fs-5 mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="maintenanceMode">
                            <label class="form-check-label" for="maintenanceMode">Aktifkan Mode Maintenance</label>
                        </div>

                         <button type="submit" class="btn btn-orange mt-3">
                            <i class="bi bi-save me-2"></i>Simpan Pengaturan
                        </button>
                    </div>
                </div>

            </div>
            
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile Sidebar Toggle (Tetap digunakan)
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