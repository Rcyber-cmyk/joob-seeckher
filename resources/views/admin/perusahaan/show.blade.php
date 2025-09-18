<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Perusahaan: {{ $perusahaan->nama_perusahaan }}</title>
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
        .detail-card { background-color: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
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
            <header class="mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Detail Perusahaan</h2>
                    <p class="text-secondary">{{ $perusahaan->nama_perusahaan }}</p>
                </div>
                <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left-circle me-2"></i>Kembali ke Daftar
                </a>
            </header>

            <div class="detail-card">
                <div class="row">
                    <div class="col-md-8">
                        <h3>{{ $perusahaan->nama_perusahaan }}</h3>
                        <p class="text-muted">{{ $perusahaan->alamat_kota ?? 'Lokasi tidak tersedia' }}</p>
                        <hr>
                        <dl class="row">
                            <dt class="col-sm-4"><i class="bi bi-envelope-fill me-2"></i>Email Akun</dt>
                            <dd class="col-sm-8">{{ $perusahaan->user->email }}</dd>

                            <dt class="col-sm-4"><i class="bi bi-geo-alt-fill me-2"></i>Alamat Lengkap</dt>
                            <dd class="col-sm-8">{{ $perusahaan->alamat_jalan ?? 'Tidak dicantumkan' }}, {{ $perusahaan->alamat_kota }}</dd>

                            <dt class="col-sm-4"><i class="bi bi-telephone-fill me-2"></i>No. Telepon</dt>
                            <dd class="col-sm-8">{{ $perusahaan->no_telp_perusahaan ?? 'Tidak dicantumkan' }}</dd>

                            <dt class="col-sm-4"><i class="bi bi-globe me-2"></i>Situs Web</dt>
                            <dd class="col-sm-8"><a href="{{ $perusahaan->situs_web }}" target="_blank">{{ $perusahaan->situs_web ?? 'Tidak dicantumkan' }}</a></dd>
                            
                            <dt class="col-sm-4"><i class="bi bi-card-text me-2"></i>Deskripsi</dt>
                            <dd class="col-sm-8">{{ $perusahaan->deskripsi ?? 'Tidak ada deskripsi.' }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-4">
                        @if($perusahaan->logo_perusahaan)
                            <img src="{{ asset('storage/' . $perusahaan->logo_perusahaan) }}" alt="Logo" class="img-fluid rounded border mb-3">
                        @else
                            <div class="text-center p-5 border rounded bg-light">
                                <i class="bi bi-building fs-1 text-muted"></i>
                                <p class="mt-2 text-muted">Logo tidak tersedia</p>
                            </div>
                        @endif

                        <div class="card mt-3">
                            <div class="card-header">
                                <strong>Lowongan Aktif</strong>
                            </div>
                            <ul class="list-group list-group-flush">
                                @forelse($perusahaan->lowonganPekerjaan as $lowongan)
                                    <li class="list-group-item">{{ $lowongan->judul_lowongan }}</li>
                                @empty
                                    <li class="list-group-item text-muted">Tidak ada lowongan aktif.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>