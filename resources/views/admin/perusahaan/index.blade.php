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
    
    {{-- Hapus <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> dari <head> karena tidak dipakai di sini --}}

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
        .main-content { padding: 2.5rem; }
        .page-header { margin-bottom: 2.5rem; }
        
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
    
    {{-- 1. TAMBAHKAN SIDEBAR OVERLAY --}}
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    {{-- 2. TAMBAHKAN ID="sidebar" & HAPUS .sidebar-nav --}}
    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        {{-- 3. TAMBAHKAN flex-grow-1 PADA NAV --}}
        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            <a class="nav-link {{ Request::routeIs('admin.perusahaan.*') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
            <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
            <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            <a class="nav-link {{ Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
            <a class="nav-link {{ Request::routeIs('admin.pengaturan.index') ? 'active' : '' }}" href="{{ route('admin.pengaturan.index') }}"><i class="bi bi-gear-fill"></i> Pengaturan</a>
        </nav>
        
        {{-- 4. PINDAHKAN LOGOUT KE DALAM USER-PROFILE --}}
        <div class="user-profile">
            <div class="d-flex align-items-center">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="Admin">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small>Admin</small>
                </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>

    {{-- 5. BUNGKUS KONTEN DENGAN main-content --}}
    <main class="main-wrapper">
        <div class="main-content">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h4 mb-0 fw-bold">Manajemen Perusahaan</h2>
                    <p class="text-secondary small mb-0">Daftar semua perusahaan yang terdaftar di sistem.</p>
                </div>
                {{-- 6. TAMBAHKAN TOMBOL TOGGLER MOBILE --}}
                <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                    <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
                </button>
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
                    {{ $perusahaan->links() }}
                </div>
                @endif
            </div>
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- 7. TAMBAHKAN SCRIPT UNTUK TOGGLE MOBILE --}}
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