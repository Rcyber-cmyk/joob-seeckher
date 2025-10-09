<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelamar - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
            --dark-blue: #1e293b;
            --slate: #475569;
            --slate-light: #94a3b8;
            --bg-main: #f8fafc;
            --white: #ffffff;
            --sidebar-width: 260px;
            --default-border-radius: 1rem;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --card-shadow-hover: 0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07);
        }

        body {
            background-color: var(--bg-main);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-blue);
        }

        /* --- GAYA SIDEBAR KONSISTEN (COMPACT) --- */
        .sidebar {
            width: var(--sidebar-width);
            background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%);
            color: var(--white);
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1100;
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

        .table-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .form-control-search {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .btn-search {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            background-color: var(--dark-blue);
            color: white;
        }
        .btn-search:hover {
            background-color: #334155;
            color: white;
        }

        .btn-dark-blue {
            background-color: var(--dark-blue);
            color: white;
        }

        .btn-dark-blue:hover {
            background-color: #334155;
            color: white;
        }

        .table-custom thead th {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: var(--slate);
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-custom tbody td {
            vertical-align: middle;
        }

        .table-custom .user-info {
            display: flex;
            align-items: center;
        }

        .table-custom .user-info img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            margin-right: 1rem;
        }

        .table-custom .user-info .name {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .table-custom .user-info .email {
            font-size: 0.875rem;
            color: var(--slate);
        }

        .progress {
            height: 8px;
        }

        .progress-bar {
            width: var(--progress-width, 0%);
        }

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
        }
    </style>
</head>
<body>
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
            <form action="{{ route('admin.pelamar.index') }}" method="GET">
                @if(request('sort') === 'auto_rank')
                    <input type="hidden" name="sort" value="auto_rank">
                @endif
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div class="input-group" style="max-width: 500px; flex-grow: 1;">
                        <input type="text" name="search" class="form-control form-control-search" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                        <button class="btn btn-search" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="{{ request()->hasAny(['domisili', 'lulusan', 'pengalaman_kerja', 'keahlian_id']) ? 'true' : 'false' }}" aria-controls="filterCollapse"><i class="bi bi-funnel-fill me-2"></i> Filter</button>
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
                    <table class="table table-hover align-middle table-custom">
                        <thead>
                            <tr>
                                <th style="width: 5%;"><input class="form-check-input" type="checkbox" id="selectAllCheckbox"></th>
                                <th style="width: 25%;">Nama Pelamar</th>
                                @if(request('sort') === 'auto_rank')
                                    <th style="width: 15%;">Skor Ranking</th>
                                @endif
                                <th style="width: 15%;">Kelengkapan Profil</th>
                                <th style="width: 15%;">Tgl Registrasi</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelamar as $user)
                            <tr>
                                <td><input class="form-check-input row-checkbox" type="checkbox" value="{{ $user->id }}"></td>
                                <td>
                                    <div class="user-info">
                                        <img src="https://placehold.co/40x40/f1f5f9/1e293b?text={{ substr($user->name, 0, 1) }}" class="rounded-circle" alt="Avatar">
                                        <div>
                                            <div class="name">{{ $user->name }}</div>
                                            <div class="email">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                @if(request('sort') === 'auto_rank')
                                    <td><span class="badge rounded-pill text-bg-primary badge-score"><i class="bi bi-star-fill"></i> {{ number_format($user->ranking_score ?? 0, 2) }}</span></td>
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
                                        <span class="me-2 small">{{ $kelengkapan }}%</span>
                                        <div class="progress w-100" role="progressbar" aria-valuenow="{{ $kelengkapan }}" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar {{ $colorClass }}" style="--progress-width: {{ $kelengkapan }}%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td><span class="badge rounded-pill text-bg-success badge-status">Aktif</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailPelamarModal{{ $user->id }}"><i class="bi bi-eye-fill me-2"></i>Lihat Detail</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-fill me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash-fill me-2"></i>Hapus</a></li>
                                        </ul>
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
                                <td colspan="{{ request('sort') === 'auto_rank' ? 7 : 6 }}" class="text-center text-muted py-4">Data pelamar tidak ditemukan.</td>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }
        });
    </script>
</body>
</html>