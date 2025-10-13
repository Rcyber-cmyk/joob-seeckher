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
        }

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
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e2e8f0;
        }
        
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }

        .sidebar-mobile { background-color: var(--orange); color: var(--white); }
        .sidebar-mobile .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
        
        .sidebar-nav .logo { 
            font-weight: 700; 
            font-size: 1.8rem; 
            text-align: center; 
            margin-bottom: 2rem; /* DIUBAH */
            letter-spacing: 1px; 
            color: var(--white); 
            flex-shrink: 0;
        }
        
        .sidebar-nav .nav {
            flex-shrink: 0;
        }

        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.7rem 1.2rem;   /* DIUBAH */
            margin-bottom: 0.3rem; /* DIUBAH */
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.9rem; /* DIUBAH */
            transition: var(--default-transition);
        }

        .sidebar-nav .nav-link i { 
            margin-right: 1rem; 
            font-size: 1.2rem; /* DIUBAH */
        }
        
        .sidebar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }
        .sidebar-nav .nav-link.active {
            background-color: var(--white);
            color: var(--orange-dark);
            font-weight: 600;
        }
        .sidebar-nav .user-profile {
            margin-top: auto;
            background-color: rgba(0,0,0,0.15);
            padding: 1rem;
            border-radius: var(--default-border-radius);
            flex-shrink: 0;
        }
        
        .main-wrapper {
            flex-grow: 1;
            overflow-y: auto;
        }
        @media (min-width: 992px) {
            .main-wrapper { margin-left: var(--sidebar-width); }
        }

        .main-header {
            background-color: var(--white);
            padding: 1.5rem 2.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .main-header .h2 { color: var(--dark-blue); }

        .main-content {
            padding: 2.5rem;
        }

        .card-base {
            background-color: var(--white);
            border-radius: var(--default-border-radius);
            padding: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03);
            transition: var(--default-transition);
        }
        .card-base:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07);
        }
        
        .stat-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: var(--white);
            background-image: linear-gradient(135deg, var(--color-from) 0%, var(--color-to) 100%);
            box-shadow: 0 4px 12px -2px var(--color-to);
        }
        .stat-card h3 {
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 2.25rem;
        }
        .stat-card small {
            color: var(--slate);
            font-weight: 500;
        }
        .stat-card .percentage { font-size: 0.9rem; }

        .activity-card {
            color: white;
            background-image: linear-gradient(135deg, var(--orange-dark) 0%, var(--orange) 100%);
        }
        .activity-item { display: flex; align-items: flex-start; margin-bottom: 1.5rem; }
        .activity-item:last-child { margin-bottom: 0; }
        .activity-item .icon { background-color: rgba(255,255,255,0.15); width: 45px; height: 45px; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; margin-right: 1rem; flex-shrink: 0; }
        .activity-list-wrapper { overflow-y: auto; flex-grow: 1; padding-right: 10px; }
        .activity-list-wrapper::-webkit-scrollbar { width: 6px; }
        .activity-list-wrapper::-webkit-scrollbar-track { background: rgba(0,0,0,0.1); border-radius: 3px; }
        .activity-list-wrapper::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.4); border-radius: 3px; }

        .table-custom { 
            border-collapse: separate;
            border-spacing: 0 1rem;
            margin-top: -1rem;
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
        .table-custom tbody td:first-child { border-top-left-radius: 0.75rem; border-bottom-left-radius: 0.75rem; }
        .table-custom tbody td:last-child { border-top-right-radius: 0.75rem; border-bottom-right-radius: 0.75rem; }
        .table-custom .badge { padding: 0.5em 0.9em; font-weight: 500; font-size: 0.8rem; }
        .table-custom .btn { border-radius: 0.5rem; }
    </style>
</head>
<body>
    <aside class="sidebar d-none d-lg-flex">
        <div class="sidebar-nav">
            <div class="logo">JobRec</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                <a class="nav-link {{ Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
<<<<<<< HEAD
=======
                {{-- [BARU] Tambahkan link untuk UMKM --}}
>>>>>>> 6483f8f7fa256146f9b952666d6b42aa23d3f2b3
                <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
            <div class="user-profile">
                <div class="d-flex align-items-center">
                    <img src="https://placehold.co/40x40/ffffff/f97316?text=A" class="rounded-circle me-3" alt="User">
                    <div>
                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                        <small class="opacity-75">Admin</small>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <div class="offcanvas offcanvas-start d-lg-none sidebar-mobile" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileSidebarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
             <div class="sidebar-nav h-100">
                <div class="logo">JobRec</div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                    <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                    <a class="nav-link {{ Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
                    <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
                    <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                    <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                    <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                    <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </nav>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
                <div class="user-profile">
                     <div class="d-flex align-items-center">
                        <img src="https://placehold.co/40x40/ffffff/f97316?text=A" class="rounded-circle me-3" alt="User">
                        <div>
                            <div class="fw-bold">{{ Auth::user()->name }}</div>
                            <small class="opacity-75">Admin</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="main-wrapper">
        <header class="main-header">
             <div>
                <h2 class="h4 mb-0 fw-bold">Selamat Datang, <span style="color: var(--orange);">Mas Admin</span>!</h2>
                <p class="text-secondary small mb-0">Kelola Proses Rekrutmen Anda Dengan Mudah</p>
            </div>
             <button class="btn btn-link d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </header>

        <div class="main-content">
             <div class="row g-4 mb-5">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card card-base h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small>Total Pelamar</small>
                                <h3>{{ number_format($totalPelamar, 0, ',', '.') }}</h3>
                                <span class="percentage {{ $persentasePelamar['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                    <i class="bi {{ $persentasePelamar['status'] == 'increase' ? 'bi-arrow-up-short' : 'bi-arrow-down-short' }}"></i>
                                    {{ $persentasePelamar['value'] }}% Dari Bulan Lalu
                                </span>
                            </div>
                            <div class="icon" style="--color-from: #3b82f6; --color-to: #60a5fa;"><i class="bi bi-people-fill"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card card-base h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small>Total Perusahaan</small>
                                <h3>{{ number_format($totalPerusahaan, 0, ',', '.') }}</h3>
                                <span class="percentage {{ $persentasePerusahaan['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                    <i class="bi {{ $persentasePerusahaan['status'] == 'increase' ? 'bi-arrow-up-short' : 'bi-arrow-down-short' }}"></i>
                                    {{ $persentasePerusahaan['value'] }}% Dari Bulan Lalu
                                </span>
                            </div>
                            <div class="icon" style="--color-from: #10b981; --color-to: #34d399;"><i class="bi bi-building-fill"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card card-base h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small>Total UMKM</small>
                                <h3>{{ number_format($totalUmkm, 0, ',', '.') }}</h3>
                                <span class="percentage {{ $persentaseUmkm['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                    <i class="bi {{ $persentaseUmkm['status'] == 'increase' ? 'bi-arrow-up-short' : 'bi-arrow-down-short' }}"></i>
                                    {{ $persentaseUmkm['value'] }}% Dari Bulan Lalu
                                </span>
                            </div>
                            <div class="icon" style="--color-from: #8b5cf6; --color-to: #a78bfa;"><i class="bi bi-shop"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card card-base h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small>Lowongan Aktif</small>
                                <h3>{{ number_format($lowonganAktif, 0, ',', '.') }}</h3>
                                <span class="percentage text-secondary">Total lowongan saat ini</span>
                            </div>
                            <div class="icon" style="--color-from: #f59e0b; --color-to: #fbbf24;"><i class="bi bi-briefcase-fill"></i></div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row g-4 mb-5">
                <div class="col-lg-8">
                    <div class="chart-card card-base h-100">
                        <h5 class="mb-4 fw-semibold">Grafik Pendaftaran User Baru (20 Hari Terakhir)</h5>
                        <div style="height: 350px;">
                            <canvas id="userChart" data-labels='@json($chartLabels)' data-pelamar='@json($pelamarChartData)' data-perusahaan='@json($perusahaanChartData)' data-umkm='@json($umkmChartData)'></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="activity-card card-base h-100 d-flex flex-column">
                        <h5 class="mb-4 flex-shrink-0 fw-semibold">Aktivitas Terkini</h5>
                        <div class="activity-list-wrapper">
                            @forelse($recentActivities as $activity)
                                <div class="activity-item">
                                    <div class="icon">
                                        @if($activity->activity_type == 'Pendaftaran Pelamar')
                                            <i class="bi bi-person-plus-fill"></i>
                                        @elseif($activity->activity_type == 'Pendaftaran Perusahaan')
                                            <i class="bi bi-building-add"></i>
                                        @elseif($activity->activity_type == 'Pendaftaran UMKM')
                                            <i class="bi bi-shop"></i>
                                        @else
                                            <i class="bi bi-bell-fill"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="small">
                                            {!! Str::of($activity->description)->replace($activity->user->name ?? '', '<strong>'.($activity->user->name ?? 'Pengguna').'</strong>') !!}
                                        </div>
                                        <small class="d-block opacity-75 mt-1">{{ $activity->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center opacity-75 pt-5">
                                    <p>Belum ada aktivitas terkini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
             <div class="table-card card-base">
                <h5 class="mb-3 fw-semibold">Menunggu Persetujuan</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-custom">
                        <thead>
                            <tr>
                                <th>Nama</th> <th>Tipe</th> <th>Tanggal Pengajuan</th> <th>Status</th> <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menungguPersetujuan as $item)
                            <tr>
                                <td><strong>{{ $item->nama }}</strong></td>
                                <td><span class="badge rounded-pill bg-primary-subtle text-primary-emphasis">{{ $item->tipe }}</span></td>
                                <td>{{ $item->tanggal }}</td>
                                <td><span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">{{ $item->status }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-success" title="Setujui"><i class="bi bi-check-lg"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Tolak"><i class="bi bi-x-lg"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-check2-circle fs-3 d-block mb-2"></i>
                                    Tidak ada data yang menunggu persetujuan.
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
            const chartCanvas = document.getElementById('userChart');
            if (chartCanvas) {
                const ctx = chartCanvas.getContext('2d');
                const chartLabels = JSON.parse(chartCanvas.dataset.labels);
                const pelamarData = JSON.parse(chartCanvas.dataset.pelamar);
                const perusahaanData = JSON.parse(chartCanvas.dataset.perusahaan);
                const umkmData = JSON.parse(chartCanvas.dataset.umkm);

                const createGradient = (color1, color2) => {
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, color1);
                    gradient.addColorStop(1, color2);
                    return gradient;
                }

                const gradientPelamar = createGradient('rgba(56, 189, 248, 0.5)', 'rgba(56, 189, 248, 0)');
                const gradientPerusahaan = createGradient('rgba(52, 211, 153, 0.5)', 'rgba(52, 211, 153, 0)');
                const gradientUmkm = createGradient('rgba(245, 158, 11, 0.5)', 'rgba(245, 158, 11, 0)');
                
                new Chart(ctx, {
                    type: 'line', 
                    data: {
                        labels: chartLabels,
                        datasets: [
                            { 
                                label: 'Pelamar', 
                                data: pelamarData, 
                                backgroundColor: gradientPelamar,
                                borderColor: '#38bdf8',
                                pointBackgroundColor: '#38bdf8',
                                pointBorderColor: '#fff',
                                pointHoverRadius: 7,
                                pointHoverBorderWidth: 2,
                                borderWidth: 2.5,
                                fill: true,
                                tension: 0.4
                            },
                            { 
                                label: 'Perusahaan', 
                                data: perusahaanData, 
                                backgroundColor: gradientPerusahaan,
                                borderColor: '#34d399',
                                pointBackgroundColor: '#34d399',
                                pointBorderColor: '#fff',
                                pointHoverRadius: 7,
                                pointHoverBorderWidth: 2,
                                borderWidth: 2.5,
                                fill: true,
                                tension: 0.4 
                            },
                            { 
                                label: 'UMKM', 
                                data: umkmData, 
                                backgroundColor: gradientUmkm,
                                borderColor: '#f59e0b',
                                pointBackgroundColor: '#f59e0b',
                                pointBorderColor: '#fff',
                                pointHoverRadius: 7,
                                pointHoverBorderWidth: 2,
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
                            y: { 
                                beginAtZero: true, 
                                max: 10,
                                ticks: { 
                                    stepSize: 2,
                                    color: '#64748b',
                                    font: { family: 'Poppins' }
                                }, 
                                grid: { 
                                    color: '#e2e8f0',
                                    drawBorder: false
                                }
                            },
                            x: { 
                                grid: { 
                                    display: false 
                                }, 
                                ticks: { 
                                    color: '#64748b',
                                    font: { family: 'Poppins' }
                                }
                            }
                        },
                        plugins: {
                            legend: { 
                                position: 'top', 
                                align: 'end', 
                                labels: { 
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    boxWidth: 8,
                                    padding: 20,
                                    color: '#1e2d3b', 
                                    font: { size: 14, family: 'Poppins' }
                                }
                            },
                            tooltip: { 
                                backgroundColor: '#0f172a', 
                                titleColor: '#ffffff', 
                                bodyColor: '#ffffff', 
                                boxPadding: 10, 
                                cornerRadius: 8,
                                usePointStyle: true,
                                titleFont: { family: 'Poppins', weight: 'bold' },
                                bodyFont: { family: 'Poppins' }
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