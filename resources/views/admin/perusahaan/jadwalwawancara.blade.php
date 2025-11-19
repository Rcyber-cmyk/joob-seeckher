<?php
// FILE: resources/views/admin/jadwalwawancara/index.blade.php
// Semua logika partials telah digabungkan ke dalam file ini.
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Jadwal Wawancara - Job Recruitment</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === CSS UTAMA (KONSISTEN) === */
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
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.85); padding: 0.6rem 1.2rem; margin-bottom: 0.2rem; border-radius: 0.75rem; display: flex; align-items: center; font-weight: 500; font-size: 0.9rem; transition: var(--default-transition); text-decoration: none; }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        .sidebar .user-profile { margin-top: 1rem; background-color: rgba(0,0,0,0.15); padding: 0.75rem; border-radius: var(--default-border-radius); flex-shrink: 0; }
        .sidebar .user-profile .d-flex .fw-bold { font-size: 0.9rem; }
        .sidebar .user-profile .d-flex small { font-size: 0.8rem; }
        .sidebar .user-profile .d-flex img { width: 32px; height: 32px; margin-right: 0.75rem !important; }
        .sidebar .user-profile .nav-link.mt-2 { margin-top: 0.5rem !important; padding: 0.5rem 0.75rem; font-size: 0.9rem; margin-bottom: 0 !important; }
        .main-wrapper { transition: var(--default-transition); }
        @media (min-width: 992px) { .main-wrapper { margin-left: var(--sidebar-width); } }
        @media (max-width: 991.98px) { .sidebar { transform: translateX(-100%); } .sidebar.active { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,0.3); } }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 1099; }
        .sidebar-overlay.active { display: block; }
        .main-content { padding: 2.5rem; padding-top: 0; }
        .page-header { margin-bottom: 0; position: sticky; top: 0; z-index: 1050; background-color: var(--bg-main); padding: 2.5rem; border-bottom: 1px solid var(--border-color); }
        .card-base { background-color: var(--white); border-radius: var(--default-border-radius); padding: 2rem; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03); }

        /* === NEW GROUPED TABLE STYLES === */
        
        /* Baris Group Lowongan (Toggle Button) */
        .group-header-row {
            background-color: var(--white) !important;
            border-radius: var(--default-border-radius) !important;
            margin-bottom: 0.5rem;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
        }
        .group-header-row:hover {
            background-color: #f8fafc !important;
        }
        
        /* Konten Detail Pelamar (Inside Collapse) */
        .pelamar-detail-table {
            border-spacing: 0;
            width: 100%;
            margin-top: 0.5rem;
            border-radius: 0 0 var(--default-border-radius) var(--default-border-radius);
            overflow: hidden;
        }

        .pelamar-detail-table thead th {
            background-color: #e2e8f0;
            font-size: 0.7rem;
            color: var(--slate);
            text-transform: uppercase;
            padding: 0.75rem 1rem;
        }
        .pelamar-detail-table tbody td {
            background-color: var(--white);
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.85rem;
        }

        .btn-action { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border-radius: 0.5rem; }
        
        /* Badge Kustom */
        .badge-terjadwal { background-color: #e0f2fe; color: #0284c7; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-selesai { background-color: #d1fae5; color: #059669; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-dibatalkan { background-color: #fee2e2; color: #dc2626; font-weight: 600; padding: 0.4em 0.7em; }
        
        /* === STYLE RESPONSIVE MOBILE === */
        @media (max-width: 767.98px) {
            .main-content { padding: 1.5rem; padding-top: 0; }
            .page-header { padding: 1.5rem 1rem; margin-bottom: 0; }
            
            .group-header-row {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
            }
            .group-header-row strong {
                font-size: 1.1rem;
            }
            .group-header-row .text-muted {
                font-size: 0.8rem;
            }
            .group-header-row .badge {
                margin-top: 0.5rem;
            }
            .group-header-row .bi-chevron-down, 
            .group-header-row .bi-chevron-right {
                position: absolute;
                top: 15px;
                right: 15px;
            }

            .pelamar-detail-table {
                display: none; 
            }
            
            /* Tampilan Detail Pelamar Stacked untuk Mobile */
            .pelamar-item-mobile {
                background-color: var(--white);
                border: 1px solid #e2e8f0;
                border-radius: var(--default-border-radius);
                padding: 1rem;
                margin-bottom: 1rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }
            .pelamar-item-mobile strong {
                display: block;
                border-bottom: 1px dashed #eee;
                padding-bottom: 0.5rem;
                margin-bottom: 0.5rem;
            }
            .pelamar-item-mobile div:before { 
                content: attr(data-label);
                display: inline-block;
                width: 100px;
                font-weight: 500;
                color: var(--slate);
                font-size: 0.8rem;
            }
            .pelamar-item-mobile .mt-2 { 
                border-top: 1px solid #eee;
                padding-top: 0.5rem;
                margin-top: 0.5rem !important;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column"> 
            <a class="nav-link" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            
            @php
                // Logika untuk menentukan aktif atau tidaknya menu dropdown
                $isPerusahaanActive = \Request::routeIs('admin.perusahaan.*') || 
                                      \Request::routeIs('admin.kandidat.index') || 
                                      \Request::routeIs('admin.iklan.*') || 
                                      \Request::routeIs('admin.jadwalwawancara.*');
            @endphp
            
            {{-- Tombol Toggler Utama untuk Perusahaan --}}
            <a class="nav-link d-flex justify-content-between align-items-center {{ $isPerusahaanActive ? 'active' : '' }}" 
               data-bs-toggle="collapse" 
               href="#perusahaanSubmenu" 
               role="button" 
               aria-expanded="{{ $isPerusahaanActive ? 'true' : 'false' }}" 
               aria-controls="perusahaanSubmenu">
                <span><i class="bi bi-building-fill"></i> Perusahaan</span>
                <i class="bi {{ $isPerusahaanActive ? 'bi-chevron-down' : 'bi-chevron-right' }} ms-auto" style="font-size: 0.8rem;"></i>
            </a>

            {{-- Konten Submenu Perusahaan --}}
            <div class="collapse {{ $isPerusahaanActive ? 'show' : '' }}" id="perusahaanSubmenu">
                <a class="nav-link ps-5 {{ \Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}">
                    <i class="bi bi-diagram-3-fill"></i> List Perusahaan
                </a>
                <a class="nav-link ps-5 {{ \Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}">
                    <i class="bi bi-person-check-fill"></i> Kandidat
                </a>
                <a class="nav-link ps-5 {{ \Request::routeIs('admin.iklan.*') ? 'active' : '' }}" href="{{ route('admin.iklan.index') }}">
                    <i class="bi bi-megaphone-fill"></i> Iklan Lowongan
                </a>
                <a class="nav-link ps-5 {{ \Request::routeIs('admin.jadwalwawancara.*') ? 'active' : '' }}" href="{{ route('admin.jadwalwawancara.index') }}">
                    <i class="bi bi-calendar-check-fill"></i> Jadwal Interview
                </a>
            </div>
            
            <a class="nav-link" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            <a class="nav-link {{ \Request::routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>

            <a class="nav-link {{ \Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
        </nav>
        <div class="user-profile">
            <div class="d-flex align-items-center text-white">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="Admin">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="opacity-75">Admin</small> </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>

    <main class="main-wrapper">
        
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold">Manajemen Jadwal Wawancara</h2>
                <p class="text-secondary small mb-0">Daftar semua jadwal interview dikelompokkan berdasarkan lowongan.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </div>
        <div class="main-content">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-base p-0">
                <div class="p-4 border-bottom">
                    <h5 class="mb-0 fw-semibold">Grup Lowongan Interview</h5>
                </div>

                {{-- Konten Utama yang Dikelompokkan --}}
                <div class="p-4 pt-3">
                    @forelse ($groupedJadwals as $lowongan_id => $group)
                        @php
                            $lowongan = $group['lowongan'];
                            $pelamarList = $group['jadwals'];
                            $totalPelamar = count($pelamarList);
                            $uniqueId = 'collapse-' . $lowongan_id;
                            
                            // Logika untuk status badge di partials
                            $statusClassMap = [
                                'terjadwal' => 'badge-terjadwal',
                                'selesai' => 'badge-selesai',
                                'dibatalkan' => 'badge-batal',
                                'pending' => 'badge-terjadwal', 
                            ];
                        @endphp
                        
                        {{-- 1. HEADER GROUP LOWONGAN (Toggle Button) --}}
                        <div class="group-header-row mb-3" 
                             data-bs-toggle="collapse" 
                             data-bs-target="#{{ $uniqueId }}" 
                             aria-expanded="false" 
                             aria-controls="{{ $uniqueId }}">
                            
                            <div class="me-auto">
                                <strong class="d-block">{{ $lowongan->judul_lowongan ?? 'Lowongan Dihapus' }}</strong>
                                <span class="text-muted small">
                                    {{ $lowongan->perusahaan->nama_perusahaan ?? 'Perusahaan N/A' }} | 
                                    {{ $lowongan->domisili ?? 'Lokasi N/A' }}
                                </span>
                            </div>

                            <span class="badge bg-primary rounded-pill">{{ $totalPelamar }} Pelamar</span>
                            <i class="bi bi-chevron-right ms-3"></i>
                        </div>

                        {{-- 2. COLLAPSE CONTENT (Daftar Pelamar di Lowongan ini) --}}
                        <div class="collapse" id="{{ $uniqueId }}">
                            <div class="p-3 pt-0">
                                
                                {{-- Tampilan Desktop/Tablet --}}
                                <div class="d-none d-md-block">
                                    <table class="pelamar-detail-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%;">Pelamar</th>
                                                <th style="width: 25%;">Jadwal Interview</th>
                                                <th style="width: 25%;">Metode</th>
                                                <th style="width: 10%;">Status</th>
                                                <th style="width: 10%;" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pelamarList as $jadwal)
                                                {{-- START: Jadwal Row Detail (Gabungan dari partials/jadwal_row_detail.blade.php) --}}
                                                @php
                                                    $statusKey = strtolower($jadwal->status);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <strong class="d-block">{{ $jadwal->pelamar->nama_lengkap ?? 'Pelamar Dihapus' }}</strong>
                                                        <small class="text-muted">{{ $jadwal->pelamar->user->email ?? 'Email N/A' }}</small>
                                                    </td>
                                                    <td>
                                                        <strong class="d-block">{{ \Carbon\Carbon::parse($jadwal->tanggal_interview)->isoFormat('D MMM YYYY') }}</strong>
                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($jadwal->waktu_interview)->format('H:i') }} WIB</small>
                                                    </td>
                                                    <td>
                                                        <strong class="d-block">{{ $jadwal->metode_wawancara }}</strong>
                                                        <small class="text-muted">
                                                            @if ($jadwal->metode_wawancara === 'Virtual Interview')
                                                                <a href="{{ $jadwal->link_zoom }}" target="_blank">Link Zoom</a>
                                                            @else
                                                                {{ \Illuminate\Support\Str::limit($jadwal->lokasi_interview ?? 'Lokasi fisik', 20) }}
                                                            @endif
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <span class="badge rounded-pill {{ $statusClassMap[$statusKey] ?? 'bg-secondary' }}">{{ ucfirst($jadwal->status) }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.jadwalwawancara.show', $jadwal->id) }}" class="btn btn-sm btn-info text-white btn-action" title="Detail">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </a>
                                                        <button onclick="confirmDelete(this)" data-id="{{ $jadwal->id }}" class="btn btn-sm btn-danger text-white btn-action" title="Hapus">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $jadwal->id }}" action="{{ route('admin.jadwalwawancara.destroy', $jadwal->id) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                                {{-- END: Jadwal Row Detail --}}
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                {{-- Tampilan Mobile (Stacked Cards) --}}
                                <div class="d-md-none">
                                    @foreach ($pelamarList as $jadwal)
                                        {{-- START: Jadwal Card Mobile (Gabungan dari partials/jadwal_card_mobile.blade.php) --}}
                                        @php
                                            $statusKey = strtolower($jadwal->status);
                                        @endphp
                                        <div class="pelamar-item-mobile">
                                            <strong class="d-flex justify-content-between">
                                                {{ $jadwal->pelamar->nama_lengkap ?? 'Pelamar Dihapus' }}
                                                <span class="badge rounded-pill {{ $statusClassMap[$statusKey] ?? 'bg-secondary' }}">{{ ucfirst($jadwal->status) }}</span>
                                            </strong>
                                            
                                            <div data-label="Email:">{{ $jadwal->pelamar->user->email ?? 'N/A' }}</div>
                                            <div data-label="Tanggal:">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_interview)->isoFormat('D MMM YYYY') }} - 
                                                {{ \Carbon\Carbon::parse($jadwal->waktu_interview)->format('H:i') }} WIB
                                            </div>
                                            <div data-label="Metode:">
                                                {{ $jadwal->metode_wawancara }}
                                                @if ($jadwal->metode_wawancara === 'Virtual Interview')
                                                    (<a href="{{ $jadwal->link_zoom }}" target="_blank">Link</a>)
                                                @endif
                                            </div>
                                            
                                            <div class="mt-2 text-center">
                                                <a href="{{ route('admin.jadwalwawancara.show', $jadwal->id) }}" class="btn btn-sm btn-info text-white btn-action" title="Detail">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <button onclick="confirmDelete(this)" data-id="{{ $jadwal->id }}" class="btn btn-sm btn-danger text-white btn-action" title="Hapus">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                                <form id="delete-form-{{ $jadwal->id }}" action="{{ route('admin.jadwalwawancara.destroy', $jadwal->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                        {{-- END: Jadwal Card Mobile --}}
                                    @endforeach
                                </div>
                                
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                            <span>Tidak ada jadwal wawancara yang tersedia.</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // === Mobile Sidebar Toggle Script (Konsisten) ===
        document.addEventListener('DOMContentLoaded', function () {
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
            
            // Mengubah ikon chevron saat collapse di-toggle
            const collapseElements = document.querySelectorAll('.collapse');
            collapseElements.forEach(collapseEl => {
                const togglerContainer = collapseEl.previousElementSibling;
                const togglerIcon = togglerContainer.querySelector('.bi');

                if (togglerIcon) {
                    collapseEl.addEventListener('show.bs.collapse', function () {
                        togglerIcon.classList.remove('bi-chevron-right');
                        togglerIcon.classList.add('bi-chevron-down');
                    });
                    collapseEl.addEventListener('hide.bs.collapse', function () {
                        togglerIcon.classList.remove('bi-chevron-down');
                        togglerIcon.classList.add('bi-chevron-right');
                    });
                }
            });
        });

        // === Konfirmasi Hapus ===
        function confirmDelete(button) {
            const jadwalId = button.getAttribute('data-id');
            if (confirm('Apakah Anda yakin ingin menghapus jadwal wawancara ini? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('delete-form-' + jadwalId).submit();
            }
        }
    </script>
</body>
</html>