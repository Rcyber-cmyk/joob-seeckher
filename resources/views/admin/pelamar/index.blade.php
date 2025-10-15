<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelamar - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
<<<<<<< HEAD
            --dark-blue: #1e293b;
            --slate: #475569;
            --slate-light: #94a3b8;
            --bg-main: #f8fafc;
=======
            --dark-blue: #0f172a;
            --slate: #475569;
            --bg-main: #f1f5f9;
>>>>>>> eff3c20
            --white: #ffffff;
            --sidebar-width: 260px;
            --default-border-radius: 1rem;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
<<<<<<< HEAD
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --card-shadow-hover: 0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07);
=======
>>>>>>> eff3c20
        }

        body {
            background-color: var(--bg-main);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-blue);
<<<<<<< HEAD
        }

        /* --- GAYA SIDEBAR KONSISTEN (COMPACT) --- */
        .sidebar {
            width: var(--sidebar-width);
            background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%);
            color: var(--white);
=======
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%);
>>>>>>> eff3c20
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1100;
<<<<<<< HEAD
            display: none; /* Default hide, show on desktop */
            flex-direction: column;
        }
        @media (min-width: 992px) {
            .sidebar { display: flex; }
        }
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }
        .sidebar-mobile { background-color: var(--orange); color: var(--white); }
        .sidebar-mobile .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
        .sidebar-nav .logo {
            font-weight: 700; font-size: 1.8rem; text-align: center;
            margin-bottom: 2rem; letter-spacing: 1px; color: var(--white);
            flex-shrink: 0;
        }
        .sidebar-nav .nav { flex-shrink: 0; }
        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85); padding: 0.7rem 1.2rem;
            margin-bottom: 0.3rem; border-radius: 0.75rem;
            display: flex; align-items: center;
            font-weight: 500; font-size: 0.9rem;
            transition: var(--default-transition);
        }
        .sidebar-nav .nav-link i { margin-right: 1rem; font-size: 1.2rem; }
        .sidebar-nav .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar-nav .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        .sidebar-nav .user-profile {
            margin-top: auto; background-color: rgba(0,0,0,0.15);
            padding: 1rem; border-radius: var(--default-border-radius);
            flex-shrink: 0;
            display: flex;
            align-items: center;
        }
        .sidebar-nav .user-profile small {
            opacity: 0.75;
        }

        /* --- TATA LETAK UTAMA --- */
        .main-wrapper {
            width: 100%;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
=======
            display: flex;
            flex-direction: column;
            transition: var(--default-transition);
        }

        .sidebar .logo {
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
            color: var(--white);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.75rem 1.2rem;
            margin-bottom: 0.3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            transition: var(--default-transition);
        }

        .sidebar .nav-link i {
            margin-right: 1rem;
            font-size: 1.25rem;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }

        .sidebar .nav-link.active {
            background-color: var(--white);
            color: var(--orange-dark);
            font-weight: 600;
        }

        .sidebar .user-profile {
            margin-top: auto;
            background-color: rgba(0,0,0,0.15);
            padding: 1rem;
            border-radius: var(--default-border-radius);
        }

        /* Overlay mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1099;
            transition: var(--default-transition);
        }

        .sidebar-overlay.active { display: block; }

        /* Main wrapper */
        .main-wrapper {
            transition: var(--default-transition);
        }

        @media (min-width: 992px) {
            .main-wrapper {
                margin-left: var(--sidebar-width);
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 0 0 40px rgba(0,0,0,0.3);
            }
        }

        /* Header */
        .main-header {
            background-color: var(--white);
            padding: 1.25rem 2.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .main-header .page-title h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
>>>>>>> eff3c20
        }
        @media (min-width: 992px) {
            .main-wrapper { 
                margin-left: var(--sidebar-width); 
                width: calc(100% - var(--sidebar-width)); /* <<< PERBAIKAN CSS DI SINI */
            }
        }
        
        .main-header {
            background-color: var(--white); padding: 1.25rem 2.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center; justify-content: space-between;
            flex-shrink: 0;
        }
        .main-header .page-title h2 { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.25rem; }
        .main-header .page-title p { color: var(--slate); margin-bottom: 0; }

        .main-header .page-title p {
            color: var(--slate);
            margin-bottom: 0;
        }
        
        .table-card {
             background-color: var(--white);
             border-radius: var(--default-border-radius);
             padding: 1.5rem;
             box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        /* Tombol Aksi & Filter */
        .btn-action {
            background-color: #f8f9fa;
            border: 1px solid #e2e8f0;
            color: var(--slate);
            transition: var(--default-transition);
        }
<<<<<<< HEAD

        .btn-search {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            background-color: var(--dark-blue);
            color: white;
        }
        .btn-search:hover {
            background-color: #334155;
            color: white;
=======
        .btn-action:hover {
            background-color: #e2e8f0;
            color: var(--dark-blue);
>>>>>>> eff3c20
        }
        .btn-primary-custom {
            background-color: var(--dark-blue);
            border-color: var(--dark-blue);
            color: var(--white);
        }
        .btn-primary-custom:hover {
            background-color: #1e293b;
            border-color: #1e293b;
        }

        /* ======================================================================
           CSS v2: TAMPILAN TABEL YANG LEBIH ELEGAN & TERINTEGRASI
           ====================================================================== */
        .table-custom {
            border-collapse: collapse; /* Kembali ke mode default */
            width: 100%;
        }

        .table-custom thead th {
            font-weight: 600;
<<<<<<< HEAD
            border-bottom: 2px solid #e2e8f0;
=======
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: var(--slate);
            background-color: #f8fafc; /* Latar header yang sangat terang */
            padding: 1rem 1.25rem;
            border-bottom: 2px solid #e2e8f0; /* Garis bawah header yang tegas */
>>>>>>> eff3c20
        }

        .table-custom tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9; /* Garis pemisah baris yang sangat halus */
        }

        .table-custom tbody tr {
            transition: background-color 0.2s ease-in-out;
        }

        /* Zebra Stripping */
        .table-custom tbody tr:nth-of-type(even) {
            background-color: #f8fafc; /* Warna striping yang lembut */
        }

        /* Hover Effect */
        .table-custom tbody tr:hover {
            background-color: #f0f9ff; /* Warna hover biru muda */
        }

        /* Style untuk baris yang di-checkbox */
        .table-custom tbody tr.tr-selected {
            background-color: #fff7ed; /* Warna oranye muda, sesuai tema */
            box-shadow: inset 3px 0 0 0 var(--orange); /* Indikator di sisi kiri */
        }

        .user-info { display: flex; align-items: center; }
        .user-info img { width: 40px; height: 40px; margin-right: 1rem; }
        .user-info .name { font-weight: 600; color: var(--dark-blue); margin-bottom: 0; font-size: 0.95rem; }
        .user-info .email { font-size: 0.8rem; color: var(--slate); }

        /* Menyembunyikan tombol aksi secara default */
        .action-buttons {
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            text-align: right; /* Agar tombol rata kanan */
        }

        /* Menampilkan tombol aksi saat baris di-hover */
        .table-custom tbody tr:hover .action-buttons {
            opacity: 1;
        }
        
        .progress { height: 0.5rem; background-color: #e9ecef; }

<<<<<<< HEAD
        .badge-status {
            padding: 0.4em 0.8em;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .badge-score {
            font-size: 0.85rem;
            font-weight: 700;
        }
        
        /* Modal Styles */
        .modal-header {
            background-color: var(--dark-blue);
            color: white;
        }
        .modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .detail-label {
            font-weight: 600;
            color: var(--slate);
        }
        .detail-value {
            color: var(--dark-blue);
        }
        .keahlian-badge {
            background-color: #e2e8f0;
            color: var(--dark-blue);
            font-weight: 500;
        }


        /* CSS untuk pagination kustom agar bagus */
        .table-card .pagination {
            --bs-pagination-padding-x: 0.75rem;
            --bs-pagination-padding-y: 0.375rem;
            --bs-pagination-font-size: 0.9rem;
            --bs-pagination-color: var(--slate);
            --bs-pagination-bg: transparent;
            --bs-pagination-border-width: 0;
            --bs-pagination-border-radius: 0.375rem;
            --bs-pagination-hover-color: var(--dark-blue);
            --bs-pagination-hover-bg: #e2e8f0;
            --bs-pagination-focus-color: var(--dark-blue);
            --bs-pagination-focus-bg: #e2e8f0;
            --bs-pagination-focus-box-shadow: none;
            --bs-pagination-active-color: #fff;
            --bs-pagination-active-bg: var(--dark-blue);
            --bs-pagination-disabled-color: #cbd5e1;
            --bs-pagination-disabled-bg: transparent;
        }

        .table-card .page-link {
            font-weight: 500;
        }

        .table-card .page-item.active .page-link {
            font-weight: 700;
=======
        /* Kustomisasi Modal Detail */
        .modal-profile .modal-content { border-radius: var(--default-border-radius); border: none; }
        .modal-profile-header {
            background-image: linear-gradient(135deg, var(--dark-blue) 0%, #1e293b 100%);
            color: var(--white);
            padding: 2rem;
            text-align: center;
            border-top-left-radius: var(--default-border-radius);
            border-top-right-radius: var(--default-border-radius);
>>>>>>> eff3c20
        }
        .modal-profile-header img { border: 4px solid var(--white); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .modal-profile-header h4 { margin-top: 1rem; margin-bottom: 0.25rem; }
        .modal-profile-header p { opacity: 0.8; }
        .modal-profile .modal-body { padding: 2rem; }
        .detail-section { margin-bottom: 2rem; }
        .detail-section h5 { font-weight: 600; margin-bottom: 1.25rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e2e8f0; }
        .detail-item { display: flex; align-items: flex-start; margin-bottom: 1rem; }
        .detail-item i { font-size: 1.1rem; color: var(--orange); width: 30px; margin-top: 2px; }
        .detail-item-content .label { font-size: 0.8rem; color: var(--slate); margin-bottom: 0.1rem; display: block; }
        .detail-item-content .value { font-weight: 500; color: var(--dark-blue); }
        .keahlian-badge { background-color: #f1f5f9; color: var(--slate); font-weight: 500; border-radius: 999px; padding: 0.5em 1em; }
    </style>
</head>
<body>
<<<<<<< HEAD
    <aside class="sidebar">
        <div class="sidebar-nav">
             <div class="logo">JobRec</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                <a class="nav-link {{ Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
                <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </nav>
            <div class="user-profile">
                <div class="d-flex align-items-center">
                    <img src="https://placehold.co/40x40/ffffff/f97316?text=M" class="rounded-circle me-3" alt="User">
                    <div>
                        <div class="fw-bold">Mas Admin</div>
                        <small>Admin</small>
                    </div>
                </div>
            </div>
        </div>
    </aside>

<div class="offcanvas offcanvas-start sidebar-mobile d-lg-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileSidebarLabel">JobRec Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="sidebar-nav">
            <div class="logo">JobRec</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                <a class="nav-link {{ Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
                <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </nav>
            <div class="user-profile">
                <div class="d-flex align-items-center">
                    <img src="https://placehold.co/40x40/ffffff/f97316?text=M" class="rounded-circle me-3" alt="User">
                    <div>
                        <div class="fw-bold">Mas Admin</div>
                        <small>Admin</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="main-wrapper">
        <header class="main-header">
            <div class="page-title">
                <h2>Manajemen Pelamar</h2>
                <p class="small d-none d-md-block">Kelola, filter, dan lihat data pelamar.</p>
            </div>
            <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                <i class="bi bi-list"></i>
            </button>
        </header>
        
        <main class="p-4"> 
=======

    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link active" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            <a class="nav-link" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
            <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
            <a class="nav-link" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
            <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
        </nav>
        <div class="user-profile">
            <div class="d-flex align-items-center">
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

    <div class="main-wrapper">
        <header class="main-header">
            <div class="page-title">
                <h2>Manajemen Pelamar</h2>
                <p class="small d-none d-md-block">Kelola, filter, dan lihat data pelamar.</p>
            </div>
            <button class="btn btn-light d-lg-none" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
        </header>

        <main class="p-4">
>>>>>>> eff3c20
            <form action="{{ route('admin.pelamar.index') }}" method="GET">
                @if(request('sort') === 'auto_rank')
                    <input type="hidden" name="sort" value="auto_rank">
                @endif
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div class="input-group" style="max-width: 500px; flex-grow: 1;">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn bg-white border" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="{{ request()->hasAny(['domisili', 'lulusan', 'pengalaman_kerja', 'keahlian_id']) ? 'true' : 'false' }}" aria-controls="filterCollapse"><i class="bi bi-funnel-fill me-2"></i> Filter</button>
                        <a href="{{ route('admin.pelamar.index', request('sort') === 'auto_rank' ? ['sort' => 'auto_rank'] : []) }}" class="btn btn-outline-danger">Reset</a>
                        <a href="#" class="btn btn-dark-blue"><i class="bi bi-plus-lg me-2"></i>Tambah Pelamar</a>
                    </div>
                </div>
                <div class="collapse {{ request()->hasAny(['domisili', 'lulusan', 'pengalaman_kerja', 'keahlian_id']) ? 'show' : '' }}" id="filterCollapse">
                    <div class="card card-body mb-4">
                         <div class="row g-3">
                            <div class="col-md-6 col-lg-3">
                                <label for="domisili" class="form-label small fw-bold">Domisili</label>
                                <select name="domisili" id="domisili" class="form-select">
                                    <option value="">Semua</option>
                                    @foreach($opsiDomisili as $opsi)
                                        <option value="{{ $opsi }}" {{ request('domisili') == $opsi ? 'selected' : '' }}>{{ $opsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label for="lulusan" class="form-label small fw-bold">Lulusan</label>
                                <select name="lulusan" id="lulusan" class="form-select">
                                    <option value="">Semua</option>
                                     @foreach($opsiLulusan as $opsi)
                                        <option value="{{ $opsi }}" {{ request('lulusan') == $opsi ? 'selected' : '' }}>{{ $opsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label for="pengalaman_kerja" class="form-label small fw-bold">Pengalaman</label>
                                <select name="pengalaman_kerja" id="pengalaman_kerja" class="form-select">
                                    <option value="">Semua</option>
                                    @foreach($opsiPengalaman as $opsi)
                                        <option value="{{ $opsi }}" {{ request('pengalaman_kerja') == $opsi ? 'selected' : '' }}>{{ $opsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label for="keahlian_id" class="form-label small fw-bold">Keahlian</label>
                                <select name="keahlian_id" id="keahlian_id" class="form-select">
                                    <option value="">Semua</option>
                                    @foreach($opsiKeahlian as $opsi)
                                        <option value="{{ $opsi->id }}" {{ request('keahlian_id') == $opsi->id ? 'selected' : '' }}>{{ $opsi->nama_keahlian }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-end">
                                <button class="btn btn-primary" type="submit">Terapkan Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th style="width: 5%;"><input class="form-check-input" type="checkbox" id="selectAllCheckbox"></th>
                                <th style="width: 25%;">Nama Pelamar</th>
                                @if(request('sort') === 'auto_rank')
                                <th style="width: 15%;" class="text-center">Skor Ranking</th>
                                @endif
                                <th style="width: 20%;">Kelengkapan Profil</th>
                                <th style="width: 15%;">Tgl Registrasi</th>
                                <th style="width: 10%;" class="text-center">Status</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelamar as $user)
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox" value="{{ $user->id }}"></td>
                                <td>
                                    <div class="user-info">
                                        <img src="{{ $user->profilePelamar->foto_profil ? asset('storage/' . $user->profilePelamar->foto_profil) : 'https://placehold.co/40x40/f1f5f9/1e293b?text=' . substr($user->name, 0, 1) }}" class="rounded-circle" alt="Avatar">
                                        <div>
                                            <div class="name">{{ $user->name }}</div>
                                            <div class="email">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                @if(request('sort') === 'auto_rank')
                                <td class="text-center">
                                    <span class="badge fs-6 rounded-pill text-bg-primary"><i class="bi bi-star-fill me-1"></i> {{ number_format($user->ranking_score ?? 0, 2) }}</span>
                                </td>
                                @endif
                                <td>
                                     @php
                                        $kelengkapan = $user->profilePelamar->kelengkapan_profil ?? 0;
                                        $colorClass = 'bg-danger';
                                        if ($kelengkapan >= 99) $colorClass = 'bg-success';
                                        elseif ($kelengkapan >= 70) $colorClass = 'bg-info';
                                        elseif ($kelengkapan >= 50) $colorClass = 'bg-warning';
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 small fw-bold">{{ $kelengkapan }}%</span>
                                        <div class="progress w-100" role="progressbar" aria-valuenow="{{ $kelengkapan }}" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar rounded-pill {{ $colorClass }}" style="width: {{ $kelengkapan }}%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-center"><span class="badge rounded-pill text-bg-success">Aktif</span></td>
                                <td>
<<<<<<< HEAD
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailPelamarModal{{ $user->id }}"><i class="bi bi-eye-fill me-2"></i>Lihat Detail</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-fill me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash-fill me-2"></i>Hapus</a></li>
                                        </ul>
=======
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-action" type="button" data-bs-toggle="modal" data-bs-target="#detailPelamarModal{{ $user->id }}" title="Lihat Detail"><i class="bi bi-eye-fill"></i></button>
                                        <a href="#" class="btn btn-sm btn-action" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="#" class="btn btn-sm btn-action" title="Hapus"><i class="bi bi-trash-fill text-danger"></i></a>
>>>>>>> eff3c20
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="detailPelamarModal{{ $user->id }}" tabindex="-1" aria-labelledby="detailPelamarModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailPelamarModalLabel{{ $user->id }}">Detail Profil Pelamar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($user->profilePelamar)
                                                <div class="row mb-4">
                                                    <div class="col-md-3 text-center">
                                                         <img src="{{ $user->profilePelamar->foto_profil ? asset('storage/' . $user->profilePelamar->foto_profil) : 'https://placehold.co/120x120/f1f5f9/1e293b?text=' . substr($user->name, 0, 1) }}" class="rounded-circle img-fluid mb-2" alt="Foto Profil">
                                                         <h6 class="mb-0">{{ $user->profilePelamar->nama_lengkap ?? 'Nama tidak tersedia' }}</h6>
                                                         <small class="text-muted">{{ $user->email }}</small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h4>Tentang Saya</h4>
                                                        <p class="text-muted">{{ $user->profilePelamar->tentang_saya ?? 'Belum ada deskripsi.' }}</p>
                                                    </div>
                                                </div>

                                                <hr>
                                                
                                                <h5 class="mb-3">Informasi Personal</h5>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <span class="detail-label d-block">No. Telepon</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->no_hp ?? '-' }}</span>
                                                    </div>
                                                     <div class="col-md-6 mb-2">
                                                        <span class="detail-label d-block">Domisili</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->domisili ?? '-' }}</span>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <span class="detail-label d-block">Tanggal Lahir</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->tanggal_lahir ? \Carbon\Carbon::parse($user->profilePelamar->tanggal_lahir)->format('d M Y') : '-' }}</span>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <span class="detail-label d-block">Gender</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->gender ?? '-' }}</span>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <span class="detail-label d-block">Alamat Lengkap</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->alamat ?? '-' }}</span>
                                                    </div>
                                                </div>

                                                <hr>

                                                <h5 class="mb-3">Pendidikan & Pengalaman</h5>
                                                 <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <span class="detail-label d-block">Pendidikan Terakhir</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->lulusan ?? '-' }}</span>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <span class="detail-label d-block">Tahun Lulus</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->tahun_lulus ?? '-' }}</span>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <span class="detail-label d-block">Nilai Akhir / IPK</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->nilai_akhir ?? '-' }}</span>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <span class="detail-label d-block">Pengalaman Kerja</span>
                                                        <span class="detail-value">{{ $user->profilePelamar->pengalaman_kerja ?? 'Belum ada' }}</span>
                                                    </div>
                                                </div>
                                                
                                                <hr>
                                                
                                                <h5 class="mb-3">Keahlian</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @forelse($user->profilePelamar->keahlian as $skill)
                                                        <span class="badge p-2 keahlian-badge">{{ $skill->nama_keahlian }}</span>
                                                    @empty
                                                        <p class="text-muted">Belum ada keahlian yang ditambahkan.</p>
                                                    @endforelse
                                                </div>

                                            @else
                                                <div class="alert alert-warning text-center">
                                                    Profil pelamar ini belum lengkap.
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="{{ request('sort') === 'auto_rank' ? 7 : 6 }}" class="text-center text-muted py-5">
                                    <h5>Data pelamar tidak ditemukan.</h5>
                                    <p>Coba ubah kata kunci pencarian atau filter Anda.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($pelamar->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-secondary small">
                        Menampilkan {{ $pelamar->firstItem() }} sampai {{ $pelamar->lastItem() }} dari {{ $pelamar->total() }} pelamar
                    </div>
                    <div>
                        {{ $pelamar->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>

    @foreach($pelamar as $user)
    <div class="modal fade" id="detailPelamarModal{{ $user->id }}" tabindex="-1" aria-labelledby="detailPelamarModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-profile">
            <div class="modal-content">
                @if($user->profilePelamar)
                <div class="modal-profile-header">
                    <img src="{{ $user->profilePelamar->foto_profil ? asset('storage/' . $user->profilePelamar->foto_profil) : 'https://placehold.co/120x120/ffffff/f97316?text=' . substr($user->name, 0, 1) }}" class="rounded-circle" width="120" height="120" alt="Foto Profil">
                    <h4>{{ $user->profilePelamar->nama_lengkap ?? $user->name }}</h4>
                    <p><i class="bi bi-geo-alt-fill me-1"></i> {{ $user->profilePelamar->domisili ?? 'Domisili tidak diketahui' }}</p>
                </div>

                <div class="modal-body">
                    <div class="detail-section">
                        <h5><i class="bi bi-person-vcard-fill me-2"></i>Tentang Saya</h5>
                        <p class="text-muted">{{ $user->profilePelamar->tentang_saya ?? 'Pelamar belum menambahkan deskripsi diri.' }}</p>
                    </div>

                    <div class="detail-section">
                        <h5><i class="bi bi-info-circle-fill me-2"></i>Informasi Personal</h5>
                        <div class="row">
                            <div class="col-md-6"><div class="detail-item"><i class="bi bi-envelope-fill"></i><div class="detail-item-content"><span class="label">Email</span><span class="value">{{ $user->email }}</span></div></div></div>
                            <div class="col-md-6"><div class="detail-item"><i class="bi bi-telephone-fill"></i><div class="detail-item-content"><span class="label">No. Telepon</span><span class="value">{{ $user->profilePelamar->no_hp ?? '-' }}</span></div></div></div>
                            <div class="col-md-6"><div class="detail-item"><i class="bi bi-calendar-event-fill"></i><div class="detail-item-content"><span class="label">Tanggal Lahir</span><span class="value">{{ $user->profilePelamar->tanggal_lahir ? \Carbon\Carbon::parse($user->profilePelamar->tanggal_lahir)->format('d M Y') : '-' }}</span></div></div></div>
                            <div class="col-md-6"><div class="detail-item"><i class="bi bi-gender-ambiguous"></i><div class="detail-item-content"><span class="label">Gender</span><span class="value">{{ $user->profilePelamar->gender ?? '-' }}</span></div></div></div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <h5><i class="bi bi-mortarboard-fill me-2"></i>Pendidikan & Pengalaman</h5>
                         <div class="row">
                            <div class="col-md-6"><div class="detail-item"><i class="bi bi-building-fill-check"></i><div class="detail-item-content"><span class="label">Pendidikan Terakhir</span><span class="value">{{ $user->profilePelamar->lulusan ?? '-' }}</span></div></div></div>
                            <div class="col-md-6"><div class="detail-item"><i class="bi bi-briefcase-fill"></i><div class="detail-item-content"><span class="label">Pengalaman Kerja</span><span class="value">{{ $user->profilePelamar->pengalaman_kerja ?? 'Belum ada' }}</span></div></div></div>
                        </div>
                    </div>

                    <div class="detail-section">
                         <h5><i class="bi bi-star-fill me-2"></i>Keahlian</h5>
                         <div class="d-flex flex-wrap gap-2">
                            @forelse($user->profilePelamar->keahlian as $skill)
                                <span class="keahlian-badge">{{ $skill->nama_keahlian }}</span>
                            @empty
                                <p class="text-muted">Belum ada keahlian yang ditambahkan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary-custom"><i class="bi bi-download me-2"></i>Unduh CV</button>
                </div>
                @else
                <div class="modal-body text-center p-5">
                    <div class="alert alert-warning">
                        Profil pelamar ini belum lengkap.
                    </div>
                    <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Tutup</button>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Sidebar Logic ---
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggleBtn = document.getElementById('toggleSidebar');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
            }
            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            // --- Table Interactivity Logic ---
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const tr = this.closest('tr');
                    if (this.checked) {
                        tr.classList.add('tr-selected');
                    } else {
                        tr.classList.remove('tr-selected');
                    }
                });
            });

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                        const tr = checkbox.closest('tr');
                        if (this.checked) {
                            tr.classList.add('tr-selected');
                        } else {
                            tr.classList.remove('tr-selected');
                        }
                    });
                });
            }
        });
    </script>

</body>
</html>