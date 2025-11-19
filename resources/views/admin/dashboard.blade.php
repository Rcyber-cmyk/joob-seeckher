<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - Job Recruitment</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        
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
            transition: var(--default-transition);
        }
        .card-base:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07); }
        .stat-card .icon { width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; color: var(--white); background-image: linear-gradient(135deg, var(--color-from) 0%, var(--color-to) 100%); box-shadow: 0 4px 12px -2px var(--color-to); }
        .stat-card h3 { font-weight: 700; color: var(--dark-blue); font-size: 2.25rem; }
        .stat-card small { color: var(--slate); font-weight: 500; }

        /* === Timeline Aktivitas (BARU) === */
        .timeline { list-style: none; padding: 0; position: relative; }
        .timeline:before { content: ''; position: absolute; top: 10px; left: 22px; bottom: 10px; width: 2px; background: rgba(255,255,255,0.2); }
        .timeline-item { display: flex; align-items: flex-start; margin-bottom: 1.5rem; }
        .timeline-item .timeline-icon { z-index: 1; flex-shrink: 0; width: 45px; height: 45px; background-color: rgba(255,255,255,0.15); border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem; font-size: 1.2rem; }
        .timeline-item:last-child { margin-bottom: 0; }
        
        /* === Tabel (Sama seperti sebelumnya) === */
        .table-custom { border-collapse: separate; border-spacing: 0 1rem; margin-top: -1rem; width: 100%; }
        .table-custom thead th { border: none; font-weight: 600; color: var(--slate-light); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.8px; padding: 1rem 1.5rem; }
        .table-custom tbody tr { background-color: var(--white); box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05); transition: var(--default-transition); }
        .table-custom tbody tr:hover { transform: translateY(-4px); box-shadow: 0 7px 14px 0 rgb(0 0 0 / 0.07), 0 3px 6px 0 rgb(0 0 0 / 0.05); }
        .table-custom tbody td { border: none; padding: 1.25rem 1.5rem; vertical-align: middle; }
        .table-custom tbody td:first-child { border-top-left-radius: 0.75rem; border-bottom-left-radius: 0.75rem; }
        .table-custom tbody td:last-child { border-top-right-radius: 0.75rem; border-bottom-right-radius: 0.75rem; }

        /* ================================== */
        /* ==   STYLE RESPONSIVE MOBILE   == */
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
            .card-base {
                padding: 1.25rem; 
            }
            .stat-card h3 {
                font-size: 1.8rem; 
            }
            .stat-card .icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }

            /* --- STYLE TABEL RESPONSIf BARU (STACKED) --- */
            .table-custom thead { display: none; }
            .table-custom tbody, .table-custom tr, .table-custom td { display: block; width: 100%; }
            .table-custom tr {
                margin-bottom: 1rem; 
                border: 1px solid #e2e8f0;
                border-radius: var(--default-border-radius);
                box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            }
            .table-custom tbody tr:nth-of-type(even) { background-color: var(--white); }
            
            .table-custom td {
                padding: 1rem 1.25rem; 
                border-bottom: 1px solid #f1f5f9;
                text-align: left; 
                position: relative; 
                padding-left: 1.25rem; 
            }
            .table-custom td:last-child { border-bottom: none; }

            .table-custom td:before {
                content: attr(data-label);
                display: block;
                font-weight: 600;
                font-size: 0.8rem;
                color: var(--slate);
                text-transform: uppercase;
                margin-bottom: 0.25rem; 
                position: static; 
                width: 100%;
                text-align: left;
                padding-right: 0;
            }
            
            .table-custom td[data-label="Aksi"] { text-align: right; }
            .table-custom td[data-label="Aksi"]:before { display: none; }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column"> 
            <a class="nav-link active" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            <a class="nav-link" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            
            @php
                // Tentukan apakah ada sub-menu yang aktif
                $isPerusahaanActive = Request::routeIs('admin.perusahaan.*') || 
                                      Request::routeIs('admin.kandidat.index') || 
                                      Request::routeIs('admin.iklan.*');
            @endphp
            
            {{-- Tombol Toggler Utama --}}
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
            </div>
            
            <a class="nav-link" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            <a class="nav-link {{ Request::routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>

            <a class="nav-link {{ Request::routeIs('admin.notifikasi.*') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
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
                <h2 class="h4 mb-0 fw-bold">Selamat Datang, <span style="color: var(--orange);">Admin</span>!</h2>
                <p class="text-secondary small mb-0">Kelola proses rekrutmen Anda dengan mudah.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </div>
        <div class="main-content">
            {{-- Stat Cards --}}
            <div class="row g-4 mb-4">
                {{-- Total Pelamar --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card card-base h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small>Total Pelamar</small>
                                <h3>{{ number_format($totalPelamar, 0, ',', '.') }}</h3>
                                <span class="small {{ $persentasePelamar['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                    <i class="bi {{ $persentasePelamar['status'] == 'increase' ? 'bi-arrow-up-short' : 'bi-arrow-down-short' }}"></i>
                                    {{ $persentasePelamar['value'] }}% Dari Bulan Lalu
                                </span>
                            </div>
                            <div class="icon" style="--color-from: #3b82f6; --color-to: #60a5fa;"><i class="bi bi-people-fill"></i></div>
                        </div>
                    </div>
                </div>
                {{-- Total Perusahaan --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card card-base h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small>Total Perusahaan</small>
                                <h3>{{ number_format($totalPerusahaan, 0, ',', '.') }}</h3>
                                   <span class="small {{ $persentasePerusahaan['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                     <i class="bi {{ $persentasePerusahaan['status'] == 'increase' ? 'bi-arrow-up-short' : 'bi-arrow-down-short' }}"></i>
                                     {{ $persentasePerusahaan['value'] }}% Dari Bulan Lalu
                                 </span>
                            </div>
                            <div class="icon" style="--color-from: #10b981; --color-to: #34d399;"><i class="bi bi-building-fill"></i></div>
                        </div>
                    </div>
                </div>
                {{-- Total UMKM --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card card-base h-100">
                           <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small>Total UMKM</small>
                                <h3>{{ number_format($totalUmkm, 0, ',', '.') }}</h3>
                                <span class="small {{ $persentaseUmkm['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                     <i class="bi {{ $persentaseUmkm['status'] == 'increase' ? 'bi-arrow-up-short' : 'bi-arrow-down-short' }}"></i>
                                     {{ $persentaseUmkm['value'] }}% Dari Bulan Lalu
                                 </span>
                            </div>
                            <div class="icon" style="--color-from: #8b5cf6; --color-to: #a78bfa;"><i class="bi bi-shop"></i></div>
                        </div>
                    </div>
                </div>
                {{-- Lowongan Aktif --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card card-base h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small>Lowongan Aktif</small>
                                <h3>{{ number_format($lowonganAktif, 0, ',', '.') }}</h3>
                                <span class="small text-secondary">Total lowongan saat ini</span>
                            </div>
                            <div class="icon" style="--color-from: #f59e0b; --color-to: #fbbf24;"><i class="bi bi-briefcase-fill"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chart & Activities --}}
            <div class="row g-4 mb-4">
                <div class="col-lg-8">
                    <div class="card-base h-100">
                        <h5 class="mb-4 fw-semibold">Grafik Pendaftaran (20 Hari Terakhir)</h5>
                        <div style="height: 350px;">
                            <canvas id="userChart" data-labels='@json($chartLabels)' data-pelamar='@json($pelamarChartData)' data-perusahaan='@json($perusahaanChartData)' data-umkm='@json($umkmChartData)'></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-base h-100 d-flex flex-column" style="background-image: linear-gradient(135deg, var(--orange-dark) 0%, var(--orange) 100%); color: white;">
                        <h5 class="mb-4 flex-shrink-0 fw-semibold">Aktivitas Terkini</h5>
                        <div class="flex-grow-1" style="overflow-y: auto;">
                            <ul class="timeline">
                                @forelse($recentActivities as $activity)
                                    <li class="timeline-item">
                                        <div class="timeline-icon">
                                            @if($activity->activity_type == 'Pendaftaran Pelamar') <i class="bi bi-person-plus-fill"></i>
                                            @elseif($activity->activity_type == 'Pendaftaran Perusahaan') <i class="bi bi-building-add"></i>
                                            @elseif($activity->activity_type == 'Pendaftaran UMKM') <i class="bi bi-shop"></i>
                                            @else <i class="bi bi-bell-fill"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="small">
                                                {!! Str::of($activity->description)->replace($activity->user->name ?? '', '<strong>'.($activity->user->name ?? 'Pengguna').'</strong>') !!}
                                            </div>
                                            <small class="d-block opacity-75 mt-1">{{ $activity->created_at->diffForHumans() }}</small>
                                        </div>
                                    </li>
                                @empty
                                    <div class="text-center opacity-75 pt-5">
                                        <p>Belum ada aktivitas terkini.</p>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Approvals Table --}}
            <div class="card-base">
                <h5 class="mb-3 fw-semibold">Menunggu Persetujuan</h5>
                <div class="table-responsive">
                    <table class="table align-middle table-custom">
                        <thead>
                            <tr>
                                <th>Nama</th> <th>Tipe</th> <th>Tanggal Pengajuan</th> <th>Status</th> <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menungguPersetujuan as $item)
                            <tr>
                                <td data-label="Nama"><strong>{{ $item->nama }}</strong></td>
                                <td data-label="Tipe"><span class="badge rounded-pill bg-primary-subtle text-primary-emphasis">{{ $item->tipe }}</span></td>
                                <td data-label="Tanggal">{{ $item->tanggal }}</td>
                                <td data-label="Status"><span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">{{ $item->status }}</span></td>
                                <td data-label="Aksi">
                                    <button class="btn btn-sm btn-outline-success"><i class="bi bi-check-lg"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-check2-circle fs-3 d-block mb-2"></i>
                                    <span>Tidak ada data yang menunggu persetujuan.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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

            // Chart.js initialization
            const chartCanvas = document.getElementById('userChart');
            if (chartCanvas) {
                const ctx = chartCanvas.getContext('2d');
                const chartLabels = JSON.parse(chartCanvas.dataset.labels || '[]');
                const pelamarData = JSON.parse(chartCanvas.dataset.pelamar || '[]');
                const perusahaanData = JSON.parse(chartCanvas.dataset.perusahaan || '[]');
                const umkmData = JSON.parse(chartCanvas.dataset.umkm || '[]');

                const createGradient = (color1, color2) => {
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, color1);
                    gradient.addColorStop(1, color2);
                    return gradient;
                }
                
                new Chart(ctx, {
                    type: 'line', 
                    data: {
                        labels: chartLabels,
                        datasets: [
                            { 
                                label: 'Pelamar', 
                                data: pelamarData, 
                                backgroundColor: createGradient('rgba(56, 189, 248, 0.5)', 'rgba(56, 189, 248, 0)'),
                                borderColor: '#38bdf8',
                                pointBackgroundColor: '#38bdf8',
                                borderWidth: 2.5,
                                fill: true,
                                tension: 0.4
                            },
                            { 
                                label: 'Perusahaan', 
                                data: perusahaanData, 
                                backgroundColor: createGradient('rgba(52, 211, 153, 0.5)', 'rgba(52, 211, 153, 0)'),
                                borderColor: '#34d399',
                                pointBackgroundColor: '#34d399',
                                borderWidth: 2.5,
                                fill: true,
                                tension: 0.4 
                            },
                             { 
                                label: 'UMKM', 
                                data: umkmData, 
                                backgroundColor: createGradient('rgba(245, 158, 11, 0.5)', 'rgba(245, 158, 11, 0)'),
                                borderColor: '#f59e0b',
                                pointBackgroundColor: '#f59e0b',
                                borderWidth: 2.5,
                                fill: true,
                                tension: 0.4
                            } 
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true, max: 10, ticks: { stepSize: 2, color: '#64748b', font: { family: 'Poppins' }}, grid: { color: '#e2e8f0', drawBorder: false }},
                            x: { grid: { display: false }, ticks: { color: '#64748b', font: { family: 'Poppins' }}}
                        },
                        plugins: {
                            legend: { position: 'top', align: 'end', labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 8, padding: 20, color: '#1e2d3b', font: { size: 14, family: 'Poppins' }}},
                            tooltip: { 
                                backgroundColor: '#0f172a', titleColor: '#ffffff', bodyColor: '#ffffff', 
                                boxPadding: 10, cornerRadius: 8, usePointStyle: true,
                                titleFont: { family: 'Poppins', weight: 'bold' }, bodyFont: { family: 'Poppins' }
                            }
                        },
                        interaction: { intersect: false, mode: 'index' },
                    }
                });
            }
        });
    </script>
</body>
</html>