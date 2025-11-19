<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Upgrade Premium - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
            --dark-blue: #0f172a; 
            --slate: #475569;
            --bg-main: #f1f5f9; 
            --white: #ffffff;
            --sidebar-width: 260px;
            --default-border-radius: 1rem;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        body { background-color: var(--bg-main); font-family: 'Poppins', sans-serif; color: var(--dark-blue); overflow-x: hidden; }
        .sidebar { width: var(--sidebar-width); background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%); padding: 1.5rem 1rem; position: fixed; top: 0; left: 0; height: 100vh; z-index: 1100; display: flex; flex-direction: column; transition: var(--default-transition); }
        .sidebar .logo { font-weight: 700; font-size: 1.8rem; text-align: center; margin-bottom: 2rem; letter-spacing: 1px; color: var(--white); }
        .sidebar .nav { overflow-y: auto; overflow-x: hidden; flex-grow: 1; }
        .sidebar .user-profile { margin-top: 1rem; background-color: rgba(0,0,0,0.15); padding: 0.75rem; border-radius: var(--default-border-radius); flex-shrink: 0; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.85); padding: 0.6rem 1.2rem; margin-bottom: 0.2rem; border-radius: 0.75rem; display: flex; align-items: center; font-weight: 500; font-size: 0.9rem; transition: var(--default-transition); text-decoration: none; }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        .sidebar .user-profile .d-flex .fw-bold { font-size: 0.9rem; }
        .sidebar .user-profile .d-flex small { font-size: 0.8rem; }
        .sidebar .user-profile .d-flex img { width: 32px; height: 32px; margin-right: 0.75rem !important; }
        .sidebar .user-profile .nav-link.mt-2 { margin-top: 0.5rem !important; padding: 0.5rem 0.75rem; font-size: 0.9rem; margin-bottom: 0 !important; }
        .main-wrapper { transition: var(--default-transition); }
        @media (min-width: 992px) { .main-wrapper { margin-left: var(--sidebar-width); } .sidebar { transform: translateX(0); } }
        @media (max-width: 991.98px) { .sidebar { transform: translateX(-100%); } .sidebar.active { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,0.3); } }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 1099; }
        .sidebar-overlay.active { display: block; }
        
        .main-content { padding: 2.5rem; padding-top: 0; }
        .page-header { margin-bottom: 0; position: sticky; top: 0; z-index: 1050; background-color: var(--bg-main); padding: 2.5rem; border-bottom: 1px solid #e2e8f0; }
        .card-base-no-hover { background-color: var(--white); border-radius: var(--default-border-radius); padding: 2rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03); }
        
        .kandidat-list .list-group-item { padding: 1.25rem 1.5rem; border-bottom: 1px solid #e2e8f0; transition: var(--default-transition); background-color: var(--white); margin-bottom: 0; border-radius: 0 !important; border: none; border-bottom: 1px solid #e2e8f0; }
        .kandidat-list .list-group-item:first-child { border-top-left-radius: 0.75rem !important; border-top-right-radius: 0.75rem !important; }
        .kandidat-list .list-group-item:last-child { border-bottom: none; border-bottom-left-radius: 0.75rem !important; border-bottom-right-radius: 0.75rem !important; }
        
        .kandidat-list .list-group-item:hover { background-color: #f8fafc; }
        .kandidat-list .kandidat-icon { flex-shrink: 0; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; background-color: var(--icon-bg, var(--slate)); color: var(--icon-color, var(--white)); }
        .kandidat-list .btn-sm { padding: 0.2rem 0.6rem; font-size: 0.8rem; }
        
        .nav-tabs .nav-link { border: none; border-bottom: 3px solid transparent; color: var(--slate); font-weight: 600; }
        .nav-tabs .nav-link.active { border-color: var(--orange); color: var(--orange-dark); background-color: transparent; }

        @media (max-width: 767.98px) {
            .main-content { padding: 1.5rem; padding-top: 0; }
            .page-header { padding: 1.5rem 1rem; margin-bottom: 0; }
            .page-header h2 { font-size: 1.25rem; }
            .card-base-no-hover { padding: 1rem; }
            .kandidat-list .list-group-item { padding: 1rem; }
            .kandidat-list .aksi-buttons { margin-left: 0 !important; margin-top: 0.75rem; width: 100%; display: flex; gap: 0.5rem; }
            .kandidat-list .aksi-buttons .btn, .kandidat-list .aksi-buttons form { flex-grow: 1; }
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
            
            @php
                // Tentukan apakah ada sub-menu Perusahaan yang aktif.
                $isPerusahaanActive = Request::routeIs('admin.perusahaan.*') || 
                                      Request::routeIs('admin.kandidat.index') || 
                                      Request::routeIs('admin.iklan.*');
            @endphp
            
            {{-- Tombol Toggler Utama: Perusahaan (Sekarang aktif) --}}
            <a class="nav-link {{ $isPerusahaanActive ? 'active' : '' }}" 
               data-bs-toggle="collapse" 
               href="#perusahaanSubmenu" 
               role="button" 
               aria-expanded="{{ $isPerusahaanActive ? 'true' : 'false' }}" 
               aria-controls="perusahaanSubmenu">
                 <i class="bi bi-building-fill"></i> Perusahaan
                 <i class="bi {{ $isPerusahaanActive ? 'bi-chevron-down' : 'bi-chevron-right' }} ms-auto" style="font-size: 0.8rem;"></i>
            </a>

            {{-- Konten Submenu --}}
            <div class="collapse {{ $isPerusahaanActive ? 'show' : '' }}" id="perusahaanSubmenu">
                <a class="nav-link ps-5 {{ Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}">
                    <i class="bi bi-diagram-3-fill"></i> List Perusahaan
                </a>
                {{-- Tautan Kandidat aktif di halaman ini --}}
                <a class="nav-link ps-5 {{ Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}">
                    <i class="bi bi-person-check-fill"></i> Kandidat
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.iklan.*') ? 'active' : '' }}" href="{{ route('admin.iklan.index') }}">
                    <i class="bi bi-megaphone-fill"></i> Iklan Lowongan
                </a>
            </div>

            <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            <a class="nav-link {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>

            <a class="nav-link {{ Request::routeIs('admin.notifikasi.index') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
        </nav>
        <div class="user-profile">
            <div class="d-flex align-items-center text-white">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="User">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="opacity-75">Admin</small>
                </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>

    <main class="main-wrapper">
        
        <header class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold">Permintaan Upgrade Premium</h2>
                <p class="text-secondary small mb-0">Setujui atau tolak pembayaran paket premium.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </header>

        <div class="main-content">
            
            <div class="card-base-no-hover p-0"> 
                
                <nav class="nav nav-tabs p-3" style="border-bottom: 1px solid #e2e8f0;">
                    <a class="nav-link {{ $currentStatus == 'pending' ? 'active' : '' }}" 
                       href="{{ route('admin.kandidat.index', ['status' => 'pending']) }}">
                        Permintaan Pending 
                        <span class="badge rounded-pill {{ $currentStatus == 'pending' ? 'bg-primary' : 'bg-secondary-subtle text-secondary-emphasis' }}">{{ $pendingCount }}</span>
                    </a>
                    <a class="nav-link {{ $currentStatus == 'riwayat' ? 'active' : '' }}" 
                       href="{{ route('admin.kandidat.index', ['status' => 'riwayat']) }}">
                        Riwayat Permintaan
                        <span class="badge rounded-pill {{ $currentStatus == 'riwayat' ? 'bg-primary' : 'bg-secondary-subtle text-secondary-emphasis' }}">{{ $riwayatCount }}</span>
                    </a>
                </nav>

                <ul class="list-group list-group-flush kandidat-list">
                    
                    @forelse($permintaanKandidat as $permintaan)
                        <li class="list-group-item d-flex flex-wrap align-items-center">
                            
                            <div class="kandidat-icon" style="--icon-bg: #10b981; --icon-color: #ffffff;">
                                <i class="bi bi-building-check"></i>
                            </div>
                            
                            <div class="ms-3 flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="mb-1">{{ $permintaan->perusahaan->nama_perusahaan ?? 'Perusahaan Dihapus' }}</strong>
                                    <small class="text-muted">{{ $permintaan->created_at->diffForHumans() }}</small>
                                </div>
                                <span class="d-block text-muted">
                                    Pembayaran <strong style="color: var(--orange-dark);">Rp {{ number_format($permintaan->total_bayar, 0, ',', '.') }}</strong> 
                                    via <strong>{{ $permintaan->metode_pembayaran }}</strong>
                                </span>
                            </div>
                            
                            <div class="ms-auto aksi-buttons d-flex gap-2">
                                
                                <a href="{{ Storage::url($permintaan->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye-fill me-1"></i> Lihat Bukti
                                </a>
                                @if($permintaan->status == 'pending')
                                    <form action="{{ route('admin.kandidat.approve', $permintaan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-check-circle me-1"></i> Setujui
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.kandidat.reject', $permintaan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-x-circle me-1"></i> Tolak
                                        </button>
                                    </form>
                                
                                @elseif($permintaan->status == 'disetujui')
                                    <span class="badge bg-success-subtle text-success-emphasis p-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> Disetujui
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger-emphasis p-2">
                                        <i class="bi bi-x-circle-fill me-1"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted py-5">
                            <i class="bi bi-check2-circle fs-3 d-block mb-2"></i>
                            <span>
                                @if($currentStatus == 'pending')
                                    Tidak ada permintaan upgrade yang tertunda.
                                @else
                                    Tidak ada riwayat permintaan.
                                @endif
                            </span>
                        </li>
                    @endforelse
                    
                </ul>
                
                @if ($permintaanKandidat->hasPages())
                <nav class="mt-4 p-3 d-flex justify-content-center">
                    {{ $permintaanKandidat->links() }}
                </nav>
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