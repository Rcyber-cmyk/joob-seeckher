<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Kelola Berita - Job Recruitment</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Font Awesome 6.5.2 mendukung fas (solid) dan far (regular/outline) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> 
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === Styles yang Sudah Ada + Tambahan untuk Gambar/Tabel === */
        :root {
            --orange: #f97316; --orange-dark: #ea580c; --dark-blue: #0f172a; 
            --slate: #475569; --slate-light: #94a3b8; --bg-main: #f1f5f9; 
            --white: #ffffff; --sidebar-width: 260px; --default-border-radius: 1rem;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --border-color: #e2e8f0; 
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
        .main-content { padding: 2.5rem; }
        .page-header { margin-bottom: 0; position: sticky; top: 0; z-index: 1050; background-color: var(--bg-main); padding: 2.5rem; border-bottom: 1px solid var(--border-color); }
        .card-base { background-color: var(--white); border-radius: var(--default-border-radius); padding: 2rem; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03); transition: var(--default-transition); }
        .card-base:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07); }
        .card-header { background-color: var(--white); border-bottom: none; padding: 0 0 1.5rem 0; color: var(--dark-blue); }
        .table-custom-berita { border-collapse: separate; border-spacing: 0 0.75rem; margin-top: -0.75rem; width: 100%; }
        .table-custom-berita thead th { border: none; font-weight: 600; color: var(--slate); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; padding: 1rem 1.5rem; vertical-align: bottom; background-color: #e2e8f0; }
        .table-custom-berita thead tr th:first-child { border-top-left-radius: 0.75rem; }
        .table-custom-berita thead tr th:last-child { border-top-right-radius: 0.75rem; }
        .table-custom-berita tbody tr { background-color: var(--white); box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.05); transition: var(--default-transition); border-radius: 0.75rem; }
        .table-custom-berita tbody tr:hover { transform: translateY(-2px); box-shadow: 0 5px 10px 0 rgb(0 0 0 / 0.08); }
        .table-custom-berita tbody td { border: none; padding: 1.25rem 1.5rem; vertical-align: middle; color: var(--dark-blue); font-size: 0.9rem; }
        .table-custom-berita tbody td:first-child { border-top-left-radius: 0.75rem; border-bottom-left-radius: 0.75rem; }
        .table-custom-berita tbody td:last-child { border-top-right-radius: 0.75rem; border-bottom-right-radius: 0.75rem; }
        .badge-kustom-info { background-color: #e0f2fe; color: #0284c7; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-kustom-success { background-color: #d1fae5; color: #059669; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-kustom-warning { background-color: #fef3c7; color: #d97706; font-weight: 600; padding: 0.4em 0.7em; }
        .btn-action { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border-radius: 0.5rem; }
        @media (max-width: 767.98px) {
            .main-content { padding: 1.5rem; } .page-header { padding: 1.5rem 1rem; }
            .page-header h2 { font-size: 1.25rem; }
            .table-custom-berita thead { display: none; }
            .table-custom-berita tbody, .table-custom-berita tr, .table-custom-berita td { display: block; width: 100%; }
            .table-custom-berita tr { margin-bottom: 1rem; border: 1px solid var(--border-color); border-radius: var(--default-border-radius); box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
            .table-custom-berita tbody tr:hover { transform: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
            .table-custom-berita td { padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; text-align: right; position: relative; }
            .table-custom-berita td:last-child { border-bottom: none; }
            .table-custom-berita td:before { content: attr(data-label); display: block; font-weight: 600; font-size: 0.8rem; color: var(--slate); text-transform: uppercase; margin-bottom: 0.25rem; text-align: left; float: left; }
            .table-custom-berita td[data-label="Aksi"] { text-align: center; }
            .table-custom-berita td[data-label="Aksi"]:before { display: none; }
            /* Penyesuaian Responsif untuk Kolom Gambar */
            .table-custom-berita td[data-label="Gambar"] { 
                text-align: left; 
                border-bottom: 1px solid #f1f5f9;
            }
            .table-custom-berita td[data-label="Gambar"]:before { 
                display: none; 
            }
        }
    </style>
</head>
<body>
    @php
        // Pastikan Anda memuat data $beritas dan Auth::user() dari Controller
    @endphp

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
                                      Request::routeIs('admin.jadwalwawancara.index');
            @endphp
            
            {{-- Tombol Toggler Utama: Perusahaan --}}
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
                <a class="nav-link ps-5 {{ Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}">
                    <i class="bi bi-person-check-fill"></i> Kandidat
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.iklan.*') ? 'active' : '' }}" href="{{ route('admin.iklan.index') }}">
                    <i class="bi bi-megaphone-fill"></i> Iklan Lowongan
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.jadwalwawancara.index') ? 'active' : '' }}" href="{{ route('admin.jadwalwawancara.index') }}"><i class="bi bi-calendar-check-fill"></i> Interview</a>
            </div>

            <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            {{-- Tautan Berita aktif di halaman ini --}}
            <a class="nav-link active" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>
            
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
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
        </div>
    </aside>

    <main class="main-wrapper">
        
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold">Manajemen Berita & Artikel</h2>
                <p class="text-secondary small mb-0">Kelola semua konten berita dan artikel di sini.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </div>

        <div class="main-content">
            
            <a href="{{ route('admin.berita.create') }}" class="btn btn-lg mb-4 shadow-sm text-white" style="background-color: var(--orange); border-color: var(--orange-dark); font-weight: 500;">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Berita Baru
            </a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-base">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 fw-bold text-primary" style="color: var(--orange-dark) !important;">Daftar Berita Terpublish</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom-berita" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Gambar</th> {{-- Tambah header Gambar --}}
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th class="text-center">Featured</th>
                                    <th>Tanggal Terbit</th>
                                    <th class="text-center" data-label="Aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($beritas as $berita)
                                    <tr>
                                        <td data-label="ID">{{ $berita->id }}</td>
                                        <td data-label="Gambar"> {{-- Tambah kolom Gambar --}}
                                            @if ($berita->gambar)
                                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-fluid rounded" style="width: 60px; height: 40px; object-fit: cover;">
                                            @else
                                                <i class="far fa-image text-muted" title="Tidak ada gambar"></i>
                                            @endif
                                        </td>
                                        <td data-label="Judul">
                                            <p class="fw-bold mb-0 text-gray-800" style="font-size: 0.95rem;" title="{{ $berita->kutipan }}">
                                                {{ \Illuminate\Support\Str::limit($berita->judul, 60) }}
                                            </p>
                                            <small class="text-muted d-block mt-1">{{ \Illuminate\Support\Str::limit(strip_tags($berita->kutipan), 40) }}</small>
                                        </td>
                                        <td data-label="Kategori">
                                            <span class="badge rounded-pill badge-kustom-info">{{ $berita->kategori->nama_kategori ?? 'Tidak Berkategori' }}</span>
                                        </td>
                                        <td data-label="Status">
                                            @if ($berita->published_at)
                                                <span class="badge rounded-pill badge-kustom-success">Publikasi</span>
                                            @else
                                                <span class="badge rounded-pill badge-kustom-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td data-label="Featured" class="text-center">
                                            @if ($berita->is_featured)
                                                <i class="fas fa-star text-warning" title="Featured Post"></i> {{-- Ikon Bintang Solid --}}
                                            @else
                                                <i class="far fa-star text-muted opacity-50" title="Not Featured"></i> {{-- Ikon Bintang Outline (Perbaikan) --}}
                                            @endif
                                        </td>
                                        <td data-label="Tanggal">{{ $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->format('d M Y H:i') : 'DRAFT' }}</td>
                                        <td data-label="Aksi" class="text-center">
                                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-info text-white btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus berita: {{ addslashes($berita->judul) }}?')" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-muted"> {{-- colspan disesuaikan menjadi 8 --}}
                                            <i class="bi bi-emoji-frown fs-3 d-block mb-2"></i>
                                            <span>Tidak ada data berita yang tersedia.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if (isset($beritas) && method_exists($beritas, 'links'))
                        <div class="d-flex justify-content-center mt-4">
                            {{ $beritas->links() }}
                        </div>
                    @endif
                </div>
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