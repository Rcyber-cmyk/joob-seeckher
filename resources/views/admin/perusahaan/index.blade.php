<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perusahaan - Admin JobRec</title>
    
    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ========================================
         SEMUA STYLE DISAMAKAN DENGAN DASHBOARD
         ========================================
        */
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

        /* Style untuk card di halaman ini (bukan dari dashboard) */
        .card {
            background-color: var(--white);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        
        .table-card {
            background-color: var(--white);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .table-card .table {
            border-collapse: separate;
            border-spacing: 0 1rem;
            margin-top: -1rem;
            width: 100%;
        }

        .table-card thead th {
            border: none;
            font-weight: 600;
            color: var(--slate);
        }

        .table-card tbody tr {
            background-color: var(--white);
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            transition: var(--default-transition);
            border-radius: 0.75rem; 
        }
        .table-card tbody tr:hover {
            transform: translateY(-4px);
            box-shadow: 0 7px 14px 0 rgb(0 0 0 / 0.07), 0 3px 6px 0 rgb(0 0 0 / 0.05);
        }
        .table-card tbody td {
            border: none;
            padding: 1.25rem 1rem; 
            vertical-align: middle;
        }
        .table-card tbody td:first-child { border-top-left-radius: 0.75rem; border-bottom-left-radius: 0.75rem; }
        .table-card tbody td:last-child { border-top-right-radius: 0.75rem; border-bottom-right-radius: 0.75rem; }
        

        .pagination-container .pagination {
            flex-wrap: wrap;
            justify-content: center;
        }

        /* ================================== */
        /* ==   STYLE RESPONSIVE MOBILE BARU   == */
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
            .card .card-body {
                padding: 1rem; 
            }
            .table-card {
                padding: 0.5rem; 
            }

            /* --- STYLE TABEL RESPONSIf BARU (STACKED) --- */
            .table-card .table thead {
                display: none; 
            }
            .table-card .table tbody,
            .table-card .table tr,
            .table-card .table td {
                display: block; 
                width: 100%;
            }
            .table-card .table tr {
                margin-bottom: 1rem; 
                border-radius: var(--default-border-radius) !important;
                box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.07);
                border: 1px solid #e2e8f0; 
            }
            .table-card .table td {
                padding: 1rem 1.25rem; 
                text-align: left; 
                border: none;
                border-bottom: 1px solid #f1f5f9;
                position: relative; 
            }
            .table-card .table td:last-child {
                border-bottom: none; 
            }
            
            .table-card .table td:before {
                content: attr(data-label);
                display: block; 
                font-weight: 600;
                font-size: 0.8rem;
                color: var(--slate);
                text-transform: uppercase;
                margin-bottom: 0.25rem; 
                position: static; 
                width: 100%;
                text-align: left;
                padding-right: 0;
            }

            .table-card .table td[data-label="Aksi"] {
                text-align: right; 
            }
            .table-card .table td[data-label="Aksi"]:before {
                display: none; 
            }
        }
    </style>
</head>
<body>
    
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column"> 
            <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            
            <a class="nav-link {{ Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}"><i class="bi bi-person-check-fill"></i> Kandidat</a>
            
            <a class="nav-link active" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            <a class="nav-link" href="#"><i class="bi bi-megaphone-fill"></i> Iklan</a>
            <a class="nav-link" href="#"><i class="bi bi-newspaper"></i> Berita</a>

            <a class="nav-link {{ Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
        </nav>
        
        <div class="user-profile">
            <div class="d-flex align-items-center text-white">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="Admin">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="opacity-75">Admin</small> </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>

    <main class="main-wrapper">
        
        <header class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold">Manajemen Perusahaan</h2>
                <p class="text-secondary small mb-0">Daftar semua perusahaan yang terdaftar di sistem.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </header>

        <div class="main-content">
            {{-- FORM FILTER & SEARCH --}}
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.perusahaan.index') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="search" class="form-label"><strong>Cari Perusahaan</strong></label>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Ketik nama perusahaan..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="filter-kota" class="form-label"><strong>Filter Berdasarkan Kota</strong></label>
                                <select name="kota" id="filter-kota" class="form-select">
                                    <option value="">Semua Kota</option>
                                    @foreach($lokasi as $item)
                                        <option value="{{ $item->alamat_kota }}" @selected(request('kota') == $item->alamat_kota)>
                                            {{ $item->alamat_kota }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100" style="background-color: var(--orange-dark); border-color: var(--orange-dark);">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- TABLE PERUSAHAAN --}}
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <th>Email</th>
                                <th>Kota</th>
                                <th>No. Telepon</th>
                                <th>Tanggal Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($perusahaan as $item)
                            <tr>
                                <td data-label="Nama Perusahaan"><strong>{{ $item->nama_perusahaan }}</strong></td>
                                <td data-label="Email">{{ $item->user->email ?? 'N/A' }}</td>
                                <td data-label="Kota">{{ $item->alamat_kota ?? 'N/A' }}</td>
                                <td data-label="No. Telepon">{{ $item->no_telp_perusahaan ?? 'N/A' }}</td>
                                <td data-label="Tanggal Bergabung">{{ $item->created_at->format('d M Y') }}</td>
                                <td data-label="Aksi">
                                    <a href="{{ route('admin.perusahaan.show', $item->id) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Data perusahaan tidak ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if ($perusahaan->hasPages())
                <div class="pagination-container mt-4">
                    <div class="text-center small text-secondary mb-2">
                        Menampilkan {{ $perusahaan->firstItem() }} - {{ $perusahaan->lastItem() }} dari {{ $perusahaan->total() }} perusahaan
                    </div>
                    {{ $perusahaan->links() }}
                </div>
                @endif
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