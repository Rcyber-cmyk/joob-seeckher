<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Manajemen Iklan - Admin JobRec</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Memastikan Carbon tersedia untuk digunakan di Blade --}}
    @inject('Carbon', 'Carbon\Carbon') 

    <style>
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
        .sidebar .logo { 
            font-weight: 700; 
            font-size: 1.8rem; 
            text-align: center; 
            margin-bottom: 2rem; 
            letter-spacing: 1px; 
            color: var(--white); 
        }
        .sidebar .nav { 
            overflow-y: auto; 
            overflow-x: hidden; 
            flex-grow: 1; 
        }
        .sidebar .user-profile { 
            margin-top: 1rem; 
            background-color: rgba(0,0,0,0.15); 
            padding: 0.75rem; 
            border-radius: var(--default-border-radius); 
            flex-shrink: 0; 
        }
        .sidebar .nav-link { 
            color: rgba(255, 255, 255, 0.85); 
            padding: 0.6rem 1.2rem; 
            margin-bottom: 0.2rem; 
            border-radius: 0.75rem; 
            display: flex; 
            align-items: center; 
            font-weight: 500; 
            font-size: 0.9rem; 
            transition: var(--default-transition); 
            text-decoration: none; 
        }
        .sidebar .nav-link i { 
            margin-right: 1rem; 
            font-size: 1.25rem; 
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
        .sidebar .user-profile .d-flex .fw-bold { font-size: 0.9rem; }
        .sidebar .user-profile .d-flex small { font-size: 0.8rem; }
        .sidebar .user-profile .d-flex img { 
            width: 32px; 
            height: 32px; 
            margin-right: 0.75rem !important; 
        }
        .sidebar .user-profile .nav-link.mt-2 { 
            margin-top: 0.5rem !important; 
            padding: 0.5rem 0.75rem; 
            font-size: 0.9rem; 
            margin-bottom: 0 !important; 
        }
        .main-wrapper { 
            transition: var(--default-transition); 
        }
        @media (min-width: 992px) { 
            .main-wrapper { 
                margin-left: var(--sidebar-width); 
            } 
            .sidebar { transform: translateX(0); }
        }
        @media (max-width: 991.98px) { 
            .sidebar { 
                transform: translateX(-100%); 
            } 
            .sidebar.active { 
                transform: translateX(0); 
                box-shadow: 0 0 40px rgba(0,0,0,0.3); 
            } 
        }
        .sidebar-overlay { 
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            right: 0; 
            bottom: 0; 
            background-color: rgba(0,0,0,0.5); 
            z-index: 1099; 
        }
        .sidebar-overlay.active { 
            display: block; 
        }
        .main-content { 
            padding: 2.5rem; 
            padding-top: 0; 
        }
        .page-header { 
            margin-bottom: 0; 
            position: sticky; 
            top: 0; 
            z-index: 1050; 
            background-color: var(--bg-main); 
            padding: 2.5rem; 
            border-bottom: 1px solid #e2e8f0; 
        }
        .card-base { 
            background-color: var(--white); 
            border-radius: var(--default-border-radius); 
            padding: 2rem; 
            border: 1px solid #e2e8f0; 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03); 
        }
        .table-custom { 
            border-collapse: separate; 
            border-spacing: 0 1rem; 
            margin-top: -1rem; 
            width: 100%; 
        }
        .table-custom thead th { 
            border: none; 
            font-weight: 600; 
            color: var(--slate-light); 
            text-transform: uppercase; 
            font-size: 0.8rem; 
            letter-spacing: 0.8px; 
            padding: 1rem 1.5rem; 
        }
        .table-custom tbody tr { 
            background-color: var(--white); 
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05); 
            transition: var(--default-transition); 
        }
        .table-custom tbody tr:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 7px 14px 0 rgb(0 0 0 / 0.07), 0 3px 6px 0 rgb(0 0 0 / 0.05); 
        }
        .table-custom tbody td { 
            border: none; 
            padding: 1.25rem 1.5rem; 
            vertical-align: middle; 
        }
        .table-custom tbody td:first-child { 
            border-top-left-radius: 0.75rem; 
            border-bottom-left-radius: 0.75rem; 
        }
        .table-custom tbody td:last-child { 
            border-top-right-radius: 0.75rem; 
            border-bottom-right-radius: 0.75rem; 
        }
        .nav-tabs { 
            border-bottom: 1px solid #e2e8f0; 
            margin-bottom: 1.5rem; 
        }
        .nav-tabs .nav-link { 
            font-weight: 600; 
            color: var(--slate); 
            border: none; 
            border-bottom: 2px solid transparent; 
            padding: 0.75rem 1.25rem; 
            margin-bottom: -1px; 
        }
        .nav-tabs .nav-link.active, 
        .nav-tabs .nav-link:hover { 
            color: var(--orange-dark); 
            border-color: var(--orange-dark); 
            background-color: transparent; 
        }
        @media (max-width: 767.98px) {
            .main-content { 
                padding: 1.5rem; 
                padding-top: 0; 
            }
            .page-header { 
                padding: 1.5rem 1rem; 
                margin-bottom: 0; 
            }
            .page-header h2 { 
                font-size: 1.25rem; 
            }
            .card-base { 
                padding: 1.25rem; 
            }
            .table-custom thead { 
                display: none; 
            }
            .table-custom tbody, 
            .table-custom tr, 
            .table-custom td { 
                display: block; 
                width: 100%; 
            }
            .table-custom tr { 
                margin-bottom: 1rem; 
                border: 1px solid #e2e8f0; 
                border-radius: var(--default-border-radius); 
                box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
            }
            .table-custom tbody tr:nth-of-type(even) { 
                background-color: var(--white); 
            }
            .table-custom td { 
                padding: 1rem 1.25rem; 
                border-bottom: 1px solid #f1f5f9; 
                text-align: left; 
                position: relative; 
                padding-left: 1.25rem; 
            }
            .table-custom td:last-child { 
                border-bottom: none; 
            }
            .table-custom td:before { 
                content: attr(data-label); 
                display: block; 
                font-weight: 600; 
                font-size: 0.8rem; 
                color: var(--slate); 
                text-transform: uppercase; 
                margin-bottom: 0.25rem; 
            }
            .table-custom td[data-label="Aksi"] { text-align: right; }
            .table-custom td[data-label="Aksi"]:before { display: none; }
            .table-custom td[data-label="Banner"] { text-align: right; }
            .table-custom td[data-label="Banner"]:before { display: none; }
            .table-custom td[data-label="Bukti"] { text-align: right; }
            .table-custom td[data-label="Bukti"]:before { display: none; }
            .table-custom td[data-label="Bukti Bayar"] { text-align: right; }
            .table-custom td[data-label="Bukti Bayar"]:before { display: none; }
            .table-custom td[data-label="Tipe Iklan"] { text-align: left; }
            .table-custom td[data-label="Tipe Iklan"]:before { display: inline-block; width: 100px; }
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
                <a class="nav-link ps-5 {{ Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}">
                    <i class="bi bi-person-check-fill"></i> Kandidat
                </a>
                {{-- Tautan Iklan Lowongan aktif di halaman ini --}}
                <a class="nav-link ps-5 active" href="{{ route('admin.iklan.index') }}">
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
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
        </div>
    </aside>

    <main class="main-wrapper">
        
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold">Manajemen Iklan</h2>
                <p class="text-secondary small mb-0">Setujui, tolak, dan lihat riwayat iklan premium.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </div>
        
        <div class="main-content">
            
            @if (session('success')) <div class="alert alert-success mb-4">{{ session('success') }}</div> @endif
            @if (session('warning')) <div class="alert alert-warning mb-4">{{ session('warning') }}</div> @endif

            <ul class="nav nav-tabs" id="iklanTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">
                        Menunggu Persetujuan <span class="badge bg-warning text-dark ms-2">{{ $pendingIklan->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="false">
                        Iklan Aktif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">
                        Riwayat Keputusan
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="iklanTabsContent">

{{-- ================= TAB 1: PENDING ================= --}}
<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
    <div class="card-base mt-3">
        <h5 class="mb-3 fw-semibold">Daftar Menunggu Persetujuan</h5>
        <div class="table-responsive">
            <table class="table align-middle table-custom">
                <thead>
                    <tr>
                        <th>Tgl. Pengajuan</th>
                        <th>Perusahaan</th>
                        <th>Judul Iklan</th>
                        <th>Metode Bayar</th>
                        <th>Banner</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendingIklan as $iklan)
                    <tr>
                        <td data-label="Tgl. Pengajuan">{{ $iklan->created_at->format('d M Y, H:i') }}</td>
                        <td data-label="Perusahaan"><strong>{{ $iklan->perusahaan->nama_perusahaan ?? 'N/A' }}</strong></td>
                        <td data-label="Judul Iklan"><strong>{{ $iklan->judul }}</strong></td>
                        <td data-label="Metode Bayar">{{ $iklan->metode_pembayaran }}</td>
                        
                        <td data-label="Banner">
                            @if($iklan->file_iklan_banner)
                                <a href="{{ Storage::url($iklan->file_iklan_banner) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-image"></i>
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td data-label="Bukti">
                            @if($iklan->bukti_pembayaran)
                            <a href="{{ Storage::url($iklan->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            @else
                                <span class="text-danger">Error</span>
                            @endif
                        </td>
                        <td data-label="Aksi">
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.iklan.approve', $iklan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-check-lg"></i></button>
                                </form>
                                <form action="{{ route('admin.iklan.reject', $iklan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menolak pembayaran ini?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-check2-circle fs-3 d-block mb-2"></i>
                            <span>Tidak ada pengajuan yang menunggu.</span>
                        </td>
                    </tr>
                    @endforelse 
                </tbody>
            </table>
        </div>
    </div>
</div>

                {{-- ================= TAB 2: ACTIVE ================= --}}
                <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
                    <div class="card-base mt-3">
                        <h5 class="mb-3 fw-semibold">Daftar Iklan Aktif (Yang Sedang Tayang)</h5>
                        <div class="table-responsive">
                            <table class="table align-middle table-custom">
                                <thead>
                                    <tr>
                                        <th>Perusahaan</th>
                                        <th>Judul Iklan</th>
                                        <th>Tipe Iklan</th>
                                        <th>Banner</th>
                                        <th>Tgl. Tayang</th>
                                        <th>Tgl. Berakhir</th> 
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($activeIklan as $iklan)
                                    <tr>
                                        <td data-label="Perusahaan"><strong>{{ $iklan->perusahaan->nama_perusahaan ?? 'N/A' }}</strong></td>
                                        <td data-label="Judul Iklan"><strong>{{ $iklan->judul }}</strong></td>
                                        <td data-label="Tipe Iklan">
                                            @if ($iklan->paket == 'vip')
                                                <span class="badge rounded-pill bg-success-subtle text-success-emphasis">Premium (VIP)</span>
                                            @else
                                                <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis">Gratis</span>
                                            @endif
                                        </td>
                                        
                                        <td data-label="Banner">
                                            @if($iklan->file_iklan_banner)
                                                <a href="{{ Storage::url($iklan->file_iklan_banner) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-image"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        <td data-label="Tgl. Tayang">{{ $iklan->published_at ? $iklan->published_at->format('d M Y') : '-' }}</td>
                                        
                                        {{-- ================================================ --}}
                                        {{--     INI ADALAH BAGIAN YANG DIPERBARUI            --}}
                                        {{-- ================================================ --}}
                                        <td data-label="Tgl. Berakhir">
                                            @if($iklan->expires_at)
                                                {{-- Tampilkan tanggal utamanya --}}
                                                {{ $iklan->expires_at->format('d M Y') }}
                                        
                                                @php
                                                    // Gunakan startOfDay() untuk perbandingan hari yang bersih
                                                    $hariIni = Carbon\Carbon::now()->startOfDay();
                                                    $tglKedaluwarsa = $iklan->expires_at->startOfDay();
                                                    
                                                    // Kita tahu ini tidak akan negatif karena query controller
                                                    $selisihHari = $hariIni->diffInDays($tglKedaluwarsa, false); 
                                                @endphp
                                        
                                                @if($selisihHari > 0)
                                                    {{-- MASIH AKTIF (Besok atau lusa, dst.) --}}
                                                    <span class="badge rounded-pill bg-info-subtle text-info-emphasis ms-1">
                                                        {{ $selisihHari }} hari lagi
                                                    </span>
                                                @else
                                                    {{-- MASIH AKTIF (Hari ini, selisih 0) --}}
                                                    <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis ms-1">
                                                        Berakhir hari ini
                                                    </span>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        {{-- ================================================ --}}
                                        {{--     AKHIR BAGIAN YANG DIPERBARUI               --}}
                                        {{-- ================================================ --}}
                                        
                                        <td data-label="Aksi">
                                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i> Detail</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="bi bi-journal-x fs-3 d-block mb-2"></i>
                                            <span>Tidak ada iklan yang sedang aktif.</span>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- ================= TAB 3: HISTORY ================= --}}
                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                    <div class="card-base mt-3">
                        <h5 class="mb-3 fw-semibold">Riwayat Keputusan (Diterima, Ditolak, Kedaluwarsa)</h5>
                        <div class="table-responsive">
                            <table class="table align-middle table-custom">
                                <thead>
                                    <tr>
                                        <th>Tgl. Keputusan</th>
                                        <th>Judul Iklan</th>
                                        <th>Perusahaan</th>
                                        <th>Tipe Iklan</th> 
                                        <th>Status</th>
                                        <th>Banner</th>
                                        <th>Bukti Bayar</th> 
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @forelse ($historyIklan as $iklan)
                                    <tr>
                                        <td data-label="Tgl. Keputusan">
                                            @if($iklan->status == 'ditolak')
                                                {{ $iklan->updated_at->format('d M Y, H:i') }}
                                            @elseif($iklan->status == 'aktif')
                                                {{ $iklan->published_at ? $iklan->published_at->format('d M Y, H:i') : $iklan->updated_at->format('d M Y, H:i') }}
                                            @else
                                                {{ $iklan->expires_at ? $iklan->expires_at->format('d M Y') : $iklan->updated_at->format('d M Y') }}
                                            @endif
                                        </td>
                                
                                        <td data-label="Judul Iklan"><strong>{{ $iklan->judul ?? '(Lowongan Dihapus)' }}</strong></td>
                                        <td data-label="Perusahaan"><strong>{{ $iklan->perusahaan->nama_perusahaan ?? 'N/A' }}</strong></td>
                                        
                                        <td data-label="Tipe Iklan">
                                            @if ($iklan->paket == 'vip')
                                                <span class="badge rounded-pill bg-success-subtle text-success-emphasis">Premium (VIP)</span>
                                            @else
                                                <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis">Gratis</span>
                                            @endif
                                        </td>

                                        <td data-label="Status">
                                            @if($iklan->status == 'ditolak')
                                                <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis">Ditolak</span>
                                            
                                            @elseif($iklan->status == 'aktif')
                                                <span class="badge rounded-pill bg-success-subtle text-success-emphasis">Diterima (Aktif)</span>
                                                
                                                @if($iklan->expires_at && $iklan->expires_at->isPast())
                                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis ms-1">
                                                        Sudah Selesai
                                                    </span>
                                                @elseif($iklan->expires_at)
                                                     <span class="badge rounded-pill bg-info-subtle text-info-emphasis ms-1">
                                                        {{ $iklan->expires_at->diffForHumans(['parts' => 1, 'join' => ', ', 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}
                                                    </span>
                                                @endif
                                                
                                            @else 
                                                <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis">Kedaluwarsa</span>
                                            @endif
                                        </td>
                                
                                        <td data-label="Banner">
                                            @if($iklan->file_iklan_banner)
                                                <a href="{{ Storage::url($iklan->file_iklan_banner) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-image"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                
                                        <td data-label="Bukti Bayar">
                                            @if($iklan->bukti_pembayaran)
                                                <a href="{{ Storage::url($iklan->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="bi bi-hourglass-split fs-3 d-block mb-2"></i>
                                            <span>Belum ada riwayat keputusan.</span>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
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