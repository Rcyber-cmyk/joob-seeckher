<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root { --orange: #f97316; --dark-blue: #1e293b; --slate: #64748b; --light-gray: #f1f5f9; }
        body { background-color: var(--light-gray); font-family: 'Segoe UI', sans-serif; }
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background-color: var(--orange); color: white; padding: 1.5rem 1rem; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar .logo { font-weight: bold; font-size: 1.5rem; text-align: center; margin-bottom: 2rem; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.8); padding: 0.75rem 1rem; margin-bottom: 0.5rem; border-radius: 0.5rem; display: flex; align-items: center; transition: all 0.2s ease-in-out; }
        .sidebar .nav-link i { margin-right: 0.75rem; font-size: 1.2rem; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { background-color: white; color: var(--orange); }
        .main-wrapper { flex-grow: 1; padding: 2rem; overflow-y: auto; }
        .table-card { background-color: white; border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="logo">Job Recruitment</div>
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
            <div class="user-profile mt-auto pt-3 border-top border-white-50">
                <div class="d-flex align-items-center">
                    <img src="https://placehold.co/40x40/ffffff/f97316?text=A" class="rounded-circle me-3" alt="User">
                    <div>
                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                        <small>Admin</small>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main-wrapper">
            <header class="mb-4">
                <h2 class="mb-1">Manajemen Perusahaan</h2>
                <p class="text-secondary">Daftar semua perusahaan yang terdaftar di sistem.</p>
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
                                <td colspan="6" class="text-center text-muted">Data perusahaan tidak ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $perusahaan->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>