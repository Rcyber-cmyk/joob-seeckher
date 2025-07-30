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
            --dark-blue: #1e293b;
            --slate: #64748b;
            --light-gray: #f1f5f9;
            --navy: #0f172a;
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', sans-serif;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background-color: var(--orange);
            color: white;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar .logo {
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: white;
            color: var(--orange);
        }

        .sidebar .user-profile {
            margin-top: auto;
            display: flex;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .main-wrapper {
            flex-grow: 1;
            padding: 2rem;
            overflow-y: auto;
        }

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
            background-color: var(--navy);
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
            border-bottom: 2px solid var(--light-gray);
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
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="logo">Job Recruitment</div>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                <a class="nav-link {{ request('sort') !== 'auto_rank' ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                <a class="nav-link" href="#"><i class="bi bi-building-fill"></i> Perusahaan</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>

                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>
            </nav>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            <div class="user-profile">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="User">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small>Admin</small>
                </div>
            </div>
        </aside>

        <main class="main-wrapper">
            <header class="mb-5">
                <h2>Manajemen <span style="color: var(--orange);">{{ request('sort') === 'auto_rank' ? 'Auto-Ranking Pelamar' : 'Pelamar' }}</span></h2>
                <p class="text-secondary">{{ request('sort') === 'auto_rank' ? 'Pelamar diurutkan berdasarkan skor tertinggi.' : 'Lihat, filter, dan kelola data pelamar.' }}</p>
            </header>

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
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye-fill me-2"></i>Lihat Detail</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-fill me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash-fill me-2"></i>Hapus</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
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