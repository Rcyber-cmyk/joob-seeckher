<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Ranking - Admin</title>

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
        .table-card, .criteria-card, .selection-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        thead th {
            font-weight: 600;
            color: var(--slate);
        }
        .progress {
            height: 8px;
        }
        .progress-bar {
            width: var(--progress-width, 0%);
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
                <a class="nav-link {{ Request::routeIs('admin.perusahaan.*') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
                <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            
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
                <h2 class="mb-1 fw-bold">Auto <span style="color: var(--orange);">Ranking</span></h2>
                <p class="text-secondary mb-0">Lihat pelamar dengan mudah berdasarkan kecocokan lowongan.</p>
            </div>
             <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <i class="bi bi-list"></i>
            </button>
        </header>

        <div class="selection-card mb-4">
            <form action="{{ route('admin.pelamar.ranking') }}" method="GET">
                <div class="mb-0">
                    <label for="lowongan_id" class="form-label fw-bold">Pilih Lowongan untuk Dianalisis:</label>
                    <div class="input-group">
                        <select name="lowongan_id" id="lowongan_id" class="form-select">
                            <option value="">-- Pilih Lowongan --</option>
                            @foreach($lowonganList as $lowongan)
                                <option value="{{ $lowongan->id }}" {{ optional($selectedLowongan)->id == $lowongan->id ? 'selected' : '' }}>
                                    {{ $lowongan->judul_lowongan }} ({{ $lowongan->perusahaan->nama_perusahaan }})
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit">Analisis</button>
                    </div>
                </div>
            </form>
        </div>

        @if($selectedLowongan)
            <div class="criteria-card mb-4">
                <h5 class="mb-3">Kriteria Penilaian Utama</h5>
                <div class="row g-3">
                    <div class="col-md-4"><i class="bi bi-briefcase-fill me-2 text-primary"></i><strong>Pengalaman Kerja:</strong> {{ $selectedLowongan->pengalaman_kerja ?? 'Tidak ditentukan' }}</div>
                    <div class="col-md-4"><i class="bi bi-mortarboard-fill me-2 text-primary"></i><strong>Edukasi:</strong> {{ $selectedLowongan->pendidikan_terakhir ?? 'Tidak ditentukan' }}</div>
                    <div class="col-md-4"><i class="bi bi-tools me-2 text-primary"></i><strong>Keahlian Wajib:</strong> {{ optional($selectedLowongan->keahlianDibutuhkan)->pluck('nama_keahlian')->join(', ') ?: 'Tidak ada' }}</div>
                </div>
            </div>

            <div class="table-card">
                <h5 class="mb-4">Peringkat Pelamar</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>Nama Pelamar</th>
                                <th>Skor Akhir</th>
                                <th>Kecocokan Pengalaman</th>
                                <th>Kecocokan Keahlian</th>
                                <th>Kecocokan Edukasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rankedPelamar as $index => $pelamar)
                                <tr>
                                    <td><span class="badge bg-dark fs-6">#{{ $index + 1 }}</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://placehold.co/40x40/f1f5f9/1e293b?text={{ substr($pelamar->name, 0, 1) }}" class="rounded-circle me-3" alt="Avatar">
                                            <div>
                                                <div class="fw-bold">{{ $pelamar->name }}</div>
                                                <small class="text-muted">{{ $pelamar->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold fs-5" style="color: var(--dark-blue);">{{ round($pelamar->final_score) }}%</div>
                                        <div class="progress mt-1" role="progressbar">
                                            <div class="progress-bar bg-success" style="--progress-width: {{ round($pelamar->final_score) }}%;"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge {{ $pelamar->match_details['pengalaman']['score'] > 50 ? 'text-bg-success' : 'text-bg-danger' }}">{{ $pelamar->match_details['pengalaman']['text'] }}</span></td>
                                    <td><span class="badge {{ $pelamar->match_details['keahlian']['score'] > 50 ? 'text-bg-success' : 'text-bg-warning' }}">{{ $pelamar->match_details['keahlian']['text'] }}</span></td>
                                    <td><span class="badge {{ $pelamar->match_details['edukasi']['score'] > 50 ? 'text-bg-success' : 'text-bg-danger' }}">{{ $pelamar->match_details['edukasi']['text'] }}</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Profil</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <p>Tidak ada data pelamar untuk ditampilkan atau belum ada pelamar yang melamar.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="bi bi-search fs-1"></i>
                <h5 class="mt-3">Mulai Analisis Peringkat</h5>
                <p>Silakan pilih lowongan pekerjaan di atas untuk memulai analisis peringkat otomatis.</p>
            </div>
        @endif
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
</body>
</html>