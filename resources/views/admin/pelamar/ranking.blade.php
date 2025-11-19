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
        
        /* ========================================
          == PERUBAHAN CSS UNTUK SIDEBAR SCROLL ==
          ========================================
        */
        .sidebar .nav {
            overflow-y: auto; /* Membuat area link bisa di-scroll */
            overflow-x: hidden;
            flex-grow: 1; /* Memastikan nav mengambil sisa ruang */
        }
        .sidebar .user-profile { 
            margin-top: 1rem; /* Beri jarak dari nav */
            background-color: rgba(0,0,0,0.15); 
            padding: 0.75rem; /* PERKECIL PADDING */
            border-radius: var(--default-border-radius);
            flex-shrink: 0; /* Mencegah user-profile ikut ter-scroll */
        }
        /* ========================================
          == AKHIR PERUBAHAN CSS 
          ========================================
        */
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            /* PERUBAHAN: Jarak diperkecil */
            padding: 0.6rem 1.2rem; /* Diperkecil dari 0.75rem */
            margin-bottom: 0.2rem; /* Diperkecil dari 0.3rem */
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.9rem; /* Diperkecil dari 0.95rem */
            transition: var(--default-transition);
            text-decoration: none;
        }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        
        /* ========================================
          == CSS BARU UNTUK MEMPERKECIL PROFIL ==
          ========================================
        */
        .sidebar .user-profile .d-flex .fw-bold {
            font-size: 0.9rem; /* Perkecil nama */
        }
        .sidebar .user-profile .d-flex small {
            font-size: 0.8rem; /* Perkecil "Admin" */
        }
        .sidebar .user-profile .d-flex img {
            width: 32px; /* Perkecil avatar */
            height: 32px;
            margin-right: 0.75rem !important; /* Perkecil margin */
        }
        .sidebar .user-profile .nav-link.mt-2 {
            /* Perkecil link logout */
            margin-top: 0.5rem !important;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            margin-bottom: 0 !important;
        }
        /* ========================================
          == AKHIR PERUBAHAN CSS 
          ========================================
        */

        /* === Main Wrapper === */
        .main-wrapper {
            transition: var(--default-transition);
            padding: 0; 
        }
        @media (min-width: 992px) {
            .main-wrapper { margin-left: var(--sidebar-width); }
            .sidebar { transform: translateX(0); }
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
        
        /* CSS UNTUK HEADER STICKY */
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
          
        /* === PAGE-SPECIFIC STYLING (Tetap Sama) === */
        .table-card, .criteria-card, .selection-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0; 
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
        .criteria-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }
        .criteria-item i {
            font-size: 1.1rem;
        }
        
        /* Popover Styling */
        .popover-header {
            font-weight: 600;
            background-color: #f8f9fa;
        }
        .popover-body ul {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 0.85rem;
        }
        .popover-body li {
            display: flex;
            justify-content: space-between;
            padding: 0.3rem 0;
            border-bottom: 1px solid #eee;
        }
        .popover-body li:last-child {
            border-bottom: none;
        }
        .popover-body .point-value {
            font-weight: 600;
            color: var(--orange-dark);
        }
        
        /* Style Tabel (dari halaman Pelamar) */
        .table-card .table {
            border-collapse: collapse;
            width: 100%;
        }
        .table-card .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: var(--slate);
            background-color: #f8fafc;
            padding: 1rem 1.25rem;
            border-bottom: 2px solid #e2e8f0;
        }
        .table-card .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .table-card .table tbody tr {
            transition: background-color 0.2s ease-in-out;
        }
        .table-card .table tbody tr:nth-of-type(even) {
            background-color: #f8fafc;
        }
        .table-card .table tbody tr:hover {
            background-color: #f0f9ff;
        }


        /* ================================== */
        /* == 	STYLE RESPONSIVE MOBILE BARU 	== */
        /* ================================== */
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

            /* Page-specific card padding */
            .selection-card, .criteria-card, .table-card {
                padding: 1rem;
            }
            
            /* --- STYLE TABEL "STACKED CARD" (SUDAH BENAR) --- */
            .table-card .table thead {
                display: none; 
            }
            .table-card .table tbody,
            .table-card .table tr,
            .table-card .table td {
                display: block; 
                width: 100%;
            }
            .table-card .table tr {
                margin-bottom: 1rem; 
                border: 1px solid #e2e8f0;
                border-radius: var(--default-border-radius);
                box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            }
            .table-card .table tbody tr:nth-of-type(even) {
                background-color: var(--white); 
            }
            
            .table-card .table td {
                padding: 1rem 1.25rem; 
                border-bottom: 1px solid #f1f5f9;
                text-align: left; 
            }
            .table-card .table td:last-child {
                border-bottom: none;
            }

            .table-card .table td:before {
                content: attr(data-label);
                display: block;
                font-weight: 600;
                font-size: 0.8rem;
                color: var(--slate);
                text-transform: uppercase;
                margin-bottom: 0.25rem; 
            }
            
            /* --- Pengecualian & Perbaikan Tampilan (SUDAH BENAR) --- */
            .table-card .table td[data-label="Aksi"] {
                text-align: right;
            }
            .table-card .table td[data-label="Aksi"]:before {
                display: none;
            }
            .table-card .table td[data-label="Peringkat"]:before {
                display: none;
            }
            .table-card .table td[data-label="Peringkat"] {
                 padding: 1rem 1.25rem 0 1.25rem; 
            }
            .table-card .table td[data-label="Rincian Skor"]:before {
                 display: none;
            }
            .table-card .table td[data-label="Rincian Skor"] {
                text-align: center; 
            }
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
                <a class="nav-link ps-5 {{ Request::routeIs('admin.perusahaan.*') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}">
                    <i class="bi bi-diagram-3-fill"></i> List Perusahaan
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}">
                    <i class="bi bi-person-check-fill"></i> Kandidat
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.iklan.*') ? 'active' : '' }}" href="{{ route('admin.iklan.index') }}">
                    <i class="bi bi-megaphone-fill"></i> Iklan Lowongan
                </a>
            </div>

            <a class="nav-link active" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            <a class="nav-link {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>

            <a class="nav-link {{ Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
        </nav>
        
        <div class="user-profile">
            <div class="d-flex align-items-center text-white">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="Admin">
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
                <h2 class="h4 mb-0 fw-bold">Auto <span style="color: var(--orange);">Ranking</span></h2>
                <p class="text-secondary small mb-0">Lihat pelamar dengan mudah berdasarkan kecocokan lowongan.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </header>
        <div class="main-content">
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
                            <button class="btn btn-primary" type="submit" style="background-color: var(--orange-dark); border-color: var(--orange-dark);">Analisis</button>
                        </div>
                    </div>
                </form>
            </div>

            @if($selectedLowongan)
                <div class="criteria-card mb-4">
                    <h5 class="mb-3"><i class="bi bi-card-checklist me-2"></i> Kriteria Lowongan & Bobot Penilaian</h5>
                    <div class="row g-3">
                        <div class="col-sm-6 col-lg-4 criteria-item">
                            <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                            <strong>Domisili:</strong>&nbsp;{{ $selectedLowongan->domisili ?? 'N/A' }} <span class="badge bg-secondary ms-auto">{{ $selectedLowongan->bobot_domisili }}%</span>
                        </div>
                        <div class="col-sm-6 col-lg-4 criteria-item">
                            <i class="bi bi-person-bounding-box me-2 text-primary"></i>
                            <strong>Usia:</strong>&nbsp;{{ $selectedLowongan->usia_min ?? 'N/A' }} - {{ $selectedLowongan->usia_maks ?? 'N/A' }} tahun <span class="badge bg-secondary ms-auto">{{ $selectedLowongan->bobot_usia }}%</span>
                        </div>
                        <div class="col-sm-6 col-lg-4 criteria-item">
                            <i class="bi bi-gender-ambiguous me-2 text-primary"></i>
                            <strong>Gender:</strong>&nbsp;{{ $selectedLowongan->gender ?? 'N/A' }} <span class="badge bg-secondary ms-auto">{{ $selectedLowongan->bobot_gender }}%</span>
                        </div>
                        <div class="col-sm-6 col-lg-4 criteria-item">
                            <i class="bi bi-mortarboard-fill me-2 text-primary"></i>
                            <strong>Pendidikan:</strong>&nbsp;{{ $selectedLowongan->pendidikan_terakhir ?? 'N/A' }} <span class="badge bg-secondary ms-auto">{{ $selectedLowongan->bobot_pendidikan }}%</span>
                        </div>
                         <div class="col-sm-6 col-lg-4 criteria-item">
                            <i class="bi bi-journal-check me-2 text-primary"></i>
                            <strong>Nilai Min:</strong>&nbsp;{{ $selectedLowongan->nilai_pendidikan_terakhir ?? 'N/A' }} <span class="badge bg-secondary ms-auto">{{ $selectedLowongan->bobot_nilai }}%</span>
                        </div>
                        <div class="col-sm-6 col-lg-4 criteria-item">
                            <i class="bi bi-briefcase-fill me-2 text-primary"></i>
                            <strong>Pengalaman:</strong>&nbsp;{{ $selectedLowongan->pengalaman_kerja ?? 'N/A' }} - {{ $selectedLowongan->pengalaman_kerja_maks ?? 'N/A' }} tahun <span class="badge bg-secondary ms-auto">{{ $selectedLowongan->bobot_pengalaman }}%</span>
                        </div>
                        <div class="col-12 criteria-item">
                            <i class="bi bi-tools me-2 text-primary"></i>
                            <strong>Keahlian Wajib:</strong>&nbsp;{{ optional($selectedLowongan->keahlianDibutuhkan)->pluck('nama_keahlian')->join(', ') ?: 'Tidak ada' }}
                        </div>
                    </div>
                </div>

                <div class="table-card">
                    <h5 class="mb-4">Peringkat Pelamar</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-custom"> <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Nama Pelamar</th>
                                    <th>Skor Akhir</th>
                                    <th class="text-center">Rincian Skor Kriteria</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rankedPelamar as $index => $pelamar)
                                    <tr>
                                        <td data-label="Peringkat"><span class="badge bg-dark fs-6">#{{ $index + 1 }}</span></td>
                                        <td data-label="Nama Pelamar">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $pelamar->profilePelamar && $pelamar->profilePelamar->foto_profil ? asset('storage/' . $pelamar->profilePelamar->foto_profil) : 'https://placehold.co/40x40/f1f5f9/1e293b?text=' . substr($pelamar->name, 0, 1) }}" class="rounded-circle me-3" alt="Avatar" style="width: 40px; height: 40px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-bold">{{ $pelamar->name }}</div>
                                                    <small class="text-muted">{{ $pelamar->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Skor Akhir">
                                            <div class="fw-bold fs-5" style="color: var(--dark-blue);">{{ round($pelamar->final_score) }}%</div>
                                            <div class="progress mt-1" role="progressbar">
                                                <div class="progress-bar bg-success" style="--progress-width: {{ round($pelamar->final_score) }}%;"></div>
                                            </div>
                                        </td>
                                        <td data-label="Rincian Skor" class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                data-bs-toggle="popover" 
                                                data-bs-trigger="hover focus"
                                                data-bs-placement="left"
                                                data-bs-html="true"
                                                title="Rincian Poin E-Ranking"
                                                data-bs-content="
                                                    <ul>
                                                        <li>Pendidikan <span>({{ round($pelamar->match_details['edukasi']['score']) }}/100)</span><span class='point-value'>+{{ number_format($pelamar->match_details['edukasi']['points'], 2) }}</span></li>
                                                        <li>Pengalaman <span>({{ round($pelamar->match_details['pengalaman']['score']) }}/100)</span><span class='point-value'>+{{ number_format($pelamar->match_details['pengalaman']['points'], 2) }}</span></li>
                                                        <li>Usia <span>({{ round($pelamar->match_details['usia']['score']) }}/100)</span><span class='point-value'>+{{ number_format($pelamar->match_details['usia']['points'], 2) }}</span></li>
                                                        <li>Domisili <span>({{ round($pelamar->match_details['domisili']['score']) }}/100)</span><span class='point-value'>+{{ number_format($pelamar->match_details['domisili']['points'], 2) }}</span></li>
                                                        <li>Gender <span>({{ round($pelamar->match_details['gender']['score']) }}/100)</span><span class='point-value'>+{{ number_format($pelamar->match_details['gender']['points'], 2) }}</span></li>
                                                        <li>Nilai <span>({{ round($pelamar->match_details['nilai']['score']) }}/100)</span><span class='point-value'>+{{ number_format($pelamar->match_details['nilai']['points'], 2) }}</span></li>
                                                    </ul>
                                                ">
                                                <i class="bi bi-info-circle"></i> Lihat Rincian
                                            </button>
                                        </td>
                                        <td data-label="Aksi">
                                            <a href="{{ route('admin.pelamar.show', $pelamar->id) }}" class="btn btn-sm btn-outline-primary">Lihat Profil</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">
                                            <p>Tidak ada data pelamar untuk ditampilkan.</p>
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
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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

            // Inisialisasi Popover
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        });
    </script>
</body>
</html>