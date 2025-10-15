<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
<<<<<<< HEAD
    <title>Manajemen Perusahaan - Admin JobRec</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* === GLOBAL & LAYOUT STYLING === */
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
            --dark-blue: #1e293b;
            --slate: #64748b;
            --light-gray: #f8fafc;
            --white: #ffffff;
            --sidebar-width: 260px;
            --default-border-radius: 1rem;
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-blue);
        }

        /* === SIDEBAR STYLING (KONSISTEN) === */
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
            display: none; /* Default hide for mobile */
            flex-direction: column;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar .logo {
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.7rem 1.2rem;
            margin-bottom: 0.3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
        }

        .sidebar .nav-link i {
            margin-right: 1rem;
            font-size: 1.2rem;
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
            background-color: rgba(0, 0, 0, 0.15);
            padding: 1rem;
            border-radius: var(--default-border-radius);
        }

        /* === MAIN CONTENT WRAPPER === */
        .main-wrapper {
            padding: 2rem;
        }
        
        @media (min-width: 992px) {
            .sidebar { display: flex; }
            .main-wrapper {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }
        }
        @media (max-width: 991.98px) {
            .main-wrapper {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem;
            }
        }

        /* Offcanvas for mobile */
        .sidebar-mobile { background-color: var(--orange); color: var(--white); }
        .sidebar-mobile .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }

        /* === PAGE-SPECIFIC STYLING === */
        .table-card {
            background-color: var(--white);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        thead th {
            font-weight: 600;
            color: var(--slate);
        }
        .pagination-container .pagination {
            --bs-pagination-color: var(--slate);
            --bs-pagination-active-bg: var(--dark-blue);
            --bs-pagination-active-border-color: var(--dark-blue);
            --bs-pagination-hover-color: var(--dark-blue);
        }
    </style>
</head>
<body>
    
    <aside class="sidebar">
        <div class="sidebar-nav">
            <div class="logo">JobRec</div>
=======
    <title>Manajemen Perusahaan</title>
=======
    <title>Manajemen Perusahaan - Admin JobRec</title>
    
    {{-- Bootstrap & Icons --}}
>>>>>>> eff3c20
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Fonts --}}
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
            --default-border-radius: 1rem;
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-blue);
        }

        /* Sidebar */
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
            display: none;
            flex-direction: column;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar .logo {
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.7rem 1.2rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            text-decoration: none;
        }

        .sidebar .nav-link i {
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: var(--white);
        }

        .sidebar .user-profile {
            margin-top: auto;
            background-color: rgba(0, 0, 0, 0.15);
            padding: 1rem;
            border-radius: var(--default-border-radius);
        }

        /* Main Layout */
        .main-wrapper {
            padding: 2rem;
        }

        @media (min-width: 992px) {
            .sidebar { display: flex; }
            .main-wrapper {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }
        }

        @media (max-width: 991.98px) {
            .main-wrapper {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem;
            }
        }

        /* Table Card */
        .table-card {
            background-color: var(--white);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        thead th {
            font-weight: 600;
            color: var(--slate);
        }

        .pagination-container .pagination {
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>
<body>
<<<<<<< HEAD
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="logo">Job Recruitment</div>
>>>>>>> 6483f8f7fa256146f9b952666d6b42aa23d3f2b3
=======
    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-nav">
            <div class="logo">JobRec</div>
>>>>>>> eff3c20
            <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                <a class="nav-link {{ Request::routeIs('admin.perusahaan.*') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
                <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>
                <a class="nav-link" href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
<<<<<<< HEAD
<<<<<<< HEAD
            
            <div class="user-profile">
                <div class="d-flex align-items-center">
                    <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="Admin">
                    <div>
                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                        <small class="opacity-75">Admin</small>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-wrapper">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1 fw-bold">Manajemen Perusahaan</h2>
                <p class="text-secondary mb-0">Daftar semua perusahaan yang terdaftar di sistem.</p>
            </div>
            <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <i class="bi bi-list"></i>
            </button>
        </header>

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
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                            <td><strong>{{ $item->nama_perusahaan }}</strong></td>
                            <td>{{ $item->user->email ?? 'N/A' }}</td>
                            <td>{{ $item->alamat_kota ?? 'N/A' }}</td>
                            <td>{{ $item->no_telp_perusahaan ?? 'N/A' }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
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
            
            @if ($perusahaan->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4 pagination-container">
                <div class="text-secondary small">
                    Menampilkan {{ $perusahaan->firstItem() }} sampai {{ $perusahaan->lastItem() }} dari {{ $perusahaan->total() }} perusahaan
                </div>
                <div>
                    {{ $perusahaan->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </main>

    <div class="offcanvas offcanvas-start sidebar-mobile" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
         <div class="offcanvas-header">
            <h5 class="offcanvas-title logo" id="mobileSidebarLabel">JobRec</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
             <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                <a class="nav-link {{ Request::routeIs('admin.perusahaan.*') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
                <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </nav>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
=======
            <div class="user-profile mt-auto pt-3 border-top border-white-50">
=======
            <div class="user-profile">
>>>>>>> eff3c20
                <div class="d-flex align-items-center">
                    <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="Admin">
                    <div>
                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                        <small>Admin</small>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-wrapper">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1 fw-bold">Manajemen Perusahaan</h2>
                <p class="text-secondary mb-0">Daftar semua perusahaan yang terdaftar di sistem.</p>
            </div>
        </header>

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
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
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
                            <td><strong>{{ $item->nama_perusahaan }}</strong></td>
                            <td>{{ $item->user->email ?? 'N/A' }}</td>
                            <td>{{ $item->alamat_kota ?? 'N/A' }}</td>
                            <td>{{ $item->no_telp_perusahaan ?? 'N/A' }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
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
                {{ $perusahaan->links('pagination::bootstrap-5') }}
            </div>
<<<<<<< HEAD
        </main>
    </div>
>>>>>>> 6483f8f7fa256146f9b952666d6b42aa23d3f2b3
=======
            @endif
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        
    </script>
>>>>>>> eff3c20
</body>
</html>
