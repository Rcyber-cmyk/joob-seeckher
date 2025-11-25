<?php
// FILE: resources/views/admin/perusahaan/jadwalwawancara.blade.php
// Kode ini sekarang mencakup Sidebar, Page Header, Konten Utama, dan fungsionalitas Search.
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Jadwal Wawancara - Job Recruitment</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === CSS UTAMA (KONSISTEN) === */
        :root {
            --orange: #f97316; --orange-dark: #ea580c; --dark-blue: #0f172a; 
            --slate: #475569; --slate-light: #94a3b8; --bg-main: #f1f5f9; 
            --white: #ffffff; --sidebar-width: 260px; --default-border-radius: 1rem;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --border-color: #e2e8f0; 
        }
        
        body { background-color: var(--bg-main); font-family: 'Poppins', sans-serif; color: var(--dark-blue); overflow-x: hidden; }
        .sidebar { width: var(--sidebar-width); background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%); padding: 1.5rem 1rem; position: fixed; top: 0; left: 0; height: 100vh; z-index: 1100; display: flex; flex-direction: column; transition: var(--default-transition); }
        .sidebar .logo { font-weight: 700; font-size: 1.8rem; text-align: center; margin-bottom: 2rem; letter-spacing: 1px; color: var(--white); }
        .sidebar .nav { overflow-y: auto; overflow-x: hidden; flex-grow: 1; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.85); padding: 0.6rem 1.2rem; margin-bottom: 0.2rem; border-radius: 0.75rem; display: flex; align-items: center; font-weight: 500; font-size: 0.9rem; transition: var(--default-transition); text-decoration: none; }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        .sidebar .user-profile { margin-top: 1rem; background-color: rgba(0,0,0,0.15); padding: 0.75rem; border-radius: var(--default-border-radius); flex-shrink: 0; }
        .sidebar .user-profile .d-flex .fw-bold { font-size: 0.9rem; }
        .sidebar .user-profile .d-flex small { font-size: 0.8rem; }
        .sidebar .user-profile .d-flex img { width: 32px; height: 32px; margin-right: 0.75rem !important; }
        .sidebar .user-profile .nav-link.mt-2 { margin-top: 0.5rem !important; padding: 0.5rem 0.75rem; font-size: 0.9rem; margin-bottom: 0 !important; }
        .main-wrapper { transition: var(--default-transition); }
        @media (min-width: 992px) { .main-wrapper { margin-left: var(--sidebar-width); } }
        @media (max-width: 991.98px) { .sidebar { transform: translateX(-100%); } .sidebar.active { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,0.3); } }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 1099; }
        .sidebar-overlay.active { display: block; }
        .main-content { padding: 2.5rem; padding-top: 0; }
        .page-header { margin-bottom: 0; position: sticky; top: 0; z-index: 1050; background-color: var(--bg-main); padding: 2.5rem; border-bottom: 1px solid var(--border-color); }
        .card-base { background-color: var(--white); border-radius: var(--default-border-radius); padding: 2rem; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03); }

        /* === NEW GROUPED TABLE STYLES (LINK) === */
        .group-header-link {
            background-color: var(--white) !important;
            border-radius: var(--default-border-radius) !important;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            text-decoration: none;
            color: inherit;
        }
        .group-header-link:hover {
            background-color: #f8fafc !important;
            text-decoration: none;
        }
        
        /* Ikon Navigasi */
        .nav-icon {
            color: var(--orange-dark);
            font-size: 1.5rem;
            margin-left: 1rem;
        }

        /* Badge Kustom */
        .badge-terjadwal { background-color: #e0f2fe; color: #0284c7; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-selesai { background-color: #d1fae5; color: #059669; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-batal { background-color: #fee2e2; color: #dc2626; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-pending { background-color: #fffbeb; color: #d97706; font-weight: 600; padding: 0.4em 0.7em; }
        
        /* Gaya khusus untuk form pencarian */
        .search-form-group .form-control {
            border-top-left-radius: 0.75rem !important;
            border-bottom-left-radius: 0.75rem !important;
        }
        .search-form-group .btn-search {
            border-top-right-radius: 0.75rem !important;
            border-bottom-right-radius: 0.75rem !important;
        }
        @media (max-width: 575.98px) {
            .search-form-group .input-group {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            .search-form-group {
                flex-direction: column;
                align-items: stretch;
            }
            .search-form-group .btn-outline-secondary {
                width: 100%;
                margin-left: 0 !important;
            }
        }

        /* === STYLE RESPONSIVE MOBILE === */
        @media (max-width: 767.98px) {
            .main-content { padding: 1.5rem; padding-top: 0; }
            .page-header { padding: 1.5rem 1rem; margin-bottom: 0; }
            
            .group-header-link {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
            }
            .group-header-link strong {
                font-size: 1.1rem;
            }
            .group-header-link .text-muted {
                font-size: 0.8rem;
            }
            .group-header-link .badge {
                margin-top: 0.5rem;
            }
            .nav-icon {
                position: absolute;
                top: 15px;
                right: 15px;
                margin-left: 0;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // === Mobile Sidebar Toggle Script (Konsisten) ===
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

            // --- Logika Collapse Menu Sidebar Perusahaan ---
            const perusahaanSubmenu = document.getElementById('perusahaanSubmenu');
            const perusahaanSubmenuIcon = document.getElementById('perusahaan-submenu-icon');
            
            if (perusahaanSubmenu && perusahaanSubmenuIcon) {
                perusahaanSubmenu.addEventListener('show.bs.collapse', function () {
                    perusahaanSubmenuIcon.classList.remove('bi-chevron-right');
                    perusahaanSubmenuIcon.classList.add('bi-chevron-down');
                });
                perusahaanSubmenu.addEventListener('hide.bs.collapse', function () {
                    perusahaanSubmenuIcon.classList.remove('bi-chevron-down');
                    perusahaanSubmenuIcon.classList.add('bi-chevron-right');
                });
                
                // Tambahkan logika untuk mengaktifkan/menonaktifkan ikon saat halaman dimuat
                if (perusahaanSubmenu.classList.contains('show')) {
                     perusahaanSubmenuIcon.classList.remove('bi-chevron-right');
                     perusahaanSubmenuIcon.classList.add('bi-chevron-down');
                }
            }
        });
    </script>
</head>
<body>
    
    {{-- START: SIDEBAR SECTION --}}
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column"> 
            <a class="nav-link" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            
            {{-- Blade PHP untuk menentukan status aktif menu dropdown --}}
            @php
                $isPerusahaanActive = 
                    \Request::routeIs('admin.perusahaan.*') || 
                    \Request::routeIs('admin.kandidat.index') || 
                    \Request::routeIs('admin.iklan.*') || 
                    \Request::routeIs('admin.jadwalwawancara.*');
                
                $chevronIcon = $isPerusahaanActive ? 'bi-chevron-down' : 'bi-chevron-right';

                // Data User untuk sidebar
                $user = Auth::user();
                $initial = substr($user->name ?? 'Admin', 0, 1); 
            @endphp
            
            {{-- Tombol Toggler Utama untuk Perusahaan --}}
            <a class="nav-link d-flex justify-content-between align-items-center {{ $isPerusahaanActive ? 'active' : '' }}" 
                data-bs-toggle="collapse" 
                href="#perusahaanSubmenu" 
                role="button" 
                aria-expanded="{{ $isPerusahaanActive ? 'true' : 'false' }}" 
                aria-controls="perusahaanSubmenu">
                <span><i class="bi bi-building-fill"></i> Perusahaan</span>
                <i class="bi {{ $chevronIcon }} ms-auto" style="font-size: 0.8rem;" id="perusahaan-submenu-icon"></i>
            </a>

            {{-- Konten Submenu Perusahaan --}}
            <div class="collapse {{ $isPerusahaanActive ? 'show' : '' }}" id="perusahaanSubmenu">
                <a class="nav-link ps-5 {{ \Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}">
                    <i class="bi bi-diagram-3-fill"></i> List Perusahaan
                </a>
                <a class="nav-link ps-5 {{ \Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}">
                    <i class="bi bi-person-check-fill"></i> Kandidat
                </a>
                <a class="nav-link ps-5 {{ \Request::routeIs('admin.iklan.index') ? 'active' : '' }}" href="{{ route('admin.iklan.index') }}">
                    <i class="bi bi-megaphone-fill"></i> Iklan Lowongan
                </a>
                <a class="nav-link ps-5 {{ \Request::routeIs('admin.jadwalwawancara.*') ? 'active' : '' }}" href="{{ route('admin.jadwalwawancara.index') }}">
                    <i class="bi bi-calendar-check-fill"></i> Jadwal Interview
                </a>
            </div>
            
            <a class="nav-link" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            <a class="nav-link {{ \Request::routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>

            <a class="nav-link {{ \Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
        </nav>
        
        {{-- START: USER PROFILE SECTION --}}
        @auth
        <div class="user-profile">
            <div class="d-flex align-items-center text-white">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ $initial }}" class="rounded-circle me-3" alt="Admin">
                <div>
                    <div class="fw-bold">{{ $user->name ?? 'Admin User' }}</div>
                    <small class="opacity-75">Admin</small> 
                </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
        @endauth
        {{-- END: USER PROFILE SECTION --}}
    </aside>
    {{-- END: SIDEBAR SECTION --}}

    <main class="main-wrapper">
        
        {{-- START: PAGE HEADER SECTION --}}
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold">Manajemen Jadwal Wawancara</h2>
                <p class="text-secondary small mb-0">Daftar semua jadwal interview dikelompokkan berdasarkan lowongan.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </div>
        {{-- END: PAGE HEADER SECTION --}}

        <div class="main-content">
            
            {{-- Alert Notifikasi --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- START: SEARCH AND FILTERING FORM --}}
            <div class="row mb-4">
                <div class="col-lg-12">
                    <form action="{{ route('admin.jadwalwawancara.index') }}" method="GET" class="d-flex shadow-sm bg-white rounded-4 p-3 border search-form-group" style="border-color: var(--border-color);">
                        <div class="input-group">
                            {{-- Input Pencarian --}}
                            <input type="text" name="q" class="form-control border-end-0 border-0" value="{{ request('q') }}" placeholder="Cari Lowongan atau Perusahaan..." aria-label="Search">
                            
                            {{-- Tombol Cari --}}
                            <button class="btn btn-search" type="submit" style="background-color: var(--orange); border-color: var(--orange-dark); color: var(--white);">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                        {{-- Tombol Reset --}}
                        @if(request('q'))
                            <a href="{{ route('admin.jadwalwawancara.index') }}" class="btn btn-outline-secondary ms-2 rounded-4">
                                <i class="bi bi-x-lg"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>
            </div>
            {{-- END: SEARCH AND FILTERING FORM --}}

            <div class="card-base p-0">
                <div class="p-4 border-bottom">
                    <h5 class="mb-0 fw-semibold">
                        Grup Lowongan Interview 
                        @if (request('q'))
                            <span class="text-secondary small ms-2">({{ $groupedJadwals->count() ?? 0 }} hasil ditemukan)</span>
                        @endif
                    </h5>
                </div>

                {{-- Konten Utama yang Dikelompokkan --}}
                <div class="p-4 pt-3">
                    {{-- Pastikan $groupedJadwals adalah variabel yang dikirim dari controller --}}
                    @forelse ($groupedJadwals ?? [] as $lowongan_id => $group)
                        @php
                            // Perbaikan: Gunakan operator null-safe (?-> di Laravel 8+) untuk mengakses properti relasi. 
                            // Karena Anda menggunakan Blade/PHP, saya tetap menggunakan pengecekan yang lebih eksplisit atau null coalescing.
                            $lowongan = $group['lowongan'] ?? null;
                            $pelamarList = $group['jadwals'] ?? [];
                            $totalPelamar = count($pelamarList);
                            
                            $judulLowongan = $lowongan->judul_lowongan ?? 'Lowongan Dihapus/Tidak Tersedia';
                            $namaPerusahaan = $lowongan->perusahaan->nama_perusahaan ?? 'Perusahaan N/A';
                            $domisili = $lowongan->domisili ?? 'Lokasi N/A';

                            // URL rute harus aman dari nilai null
                            $routeUrl = $lowongan ? route('admin.jadwalwawancara.show', $lowongan->id) : '#';
                        @endphp
                        
                        {{-- 1. HEADER GROUP LOWONGAN (Link ke Halaman Show) --}}
                        <a href="{{ $routeUrl }}" class="group-header-link mb-3 {{ $lowongan ? '' : 'disabled' }}" {{ $lowongan ? '' : 'onclick="event.preventDefault()"' }}>
                            
                            <div class="me-auto">
                                <strong class="d-block">{{ $judulLowongan }}</strong>
                                <span class="text-muted small">
                                    {{ $namaPerusahaan }} | 
                                    {{ $domisili }}
                                </span>
                            </div>
                            
                            {{-- Badge Jumlah Pelamar --}}
                            <span class="badge bg-primary rounded-pill me-3 ms-auto d-none d-sm-inline-block">{{ $totalPelamar }} Pelamar</span>

                            {{-- Ikon Navigasi --}}
                            <i class="bi bi-chevron-right nav-icon"></i>
                        </a>

                    @empty
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                            @if(request('q'))
                                <span>Tidak ada jadwal wawancara yang cocok dengan pencarian "**{{ request('q') }}**".</span>
                            @else
                                <span>Tidak ada jadwal wawancara yang tersedia.</span>
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</body>
</html>