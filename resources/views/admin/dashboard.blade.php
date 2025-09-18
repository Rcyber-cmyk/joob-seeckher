<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - Job Recruitment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --orange: #f97316;
            --dark-blue: #1e293b;
            --slate: #64748b;
            --light-gray: #f1f5f9;
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
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: white;
            color: var(--orange);
        }
        .sidebar .user-profile {
            margin-top: auto;
            display: flex;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        .main-wrapper {
            flex-grow: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        .stat-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        .stat-card h3 {
            font-weight: 700;
            color: var(--dark-blue);
        }
        .stat-card .percentage {
            font-size: 0.875rem;
            font-weight: 500;
        }
        .chart-card, .activity-card, .table-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .activity-card {
            background-color: var(--orange);
            color: white;
        }
        .activity-item {
            display: flex;
            margin-bottom: 1rem;
        }
        .activity-item .icon {
            background-color: rgba(255,255,255,0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }
            .activity-list-wrapper {
            overflow-y: auto; /* Menambahkan scrollbar vertikal jika konten meluap */
            flex-grow: 1; /* Membuat elemen ini mengisi sisa ruang vertikal */
            padding-right: 8px; /* Memberi sedikit ruang untuk scrollbar */
        }

        /* Optional: Style untuk scrollbar agar serasi dengan tema */
        .activity-list-wrapper::-webkit-scrollbar {
            width: 6px;
        }
        .activity-list-wrapper::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        .activity-list-wrapper::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 3px;
        }
        .activity-list-wrapper::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.7);
        }
        
        .table-custom .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="logo">Job Recruitment</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                <a class="nav-link {{ Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}"><i class="bi bi-building-fill"></i> Perusahaan</a>
                {{-- [BARU] Tambahkan link untuk UMKM --}}
                <a class="nav-link" href="#"><i class="bi bi-shop"></i> UMKM</a>
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
                <img src="https://placehold.co/40x40/ffffff/f97316?text=A" class="rounded-circle me-3" alt="User">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small>Admin</small>
                </div>
            </div>
        </aside>

        <main class="main-wrapper">
            <header class="mb-5">
                <h2>Selamat Datang <span style="color: var(--orange);">Mas Admin</span></h2>
                <p class="text-secondary">Kelola Proses Rekrutmen Anda Dengan Mudah</p>
            </header>

            <div class="row g-4 mb-5">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small class="text-secondary">Total Pelamar</small>
                                <h3>{{ number_format($totalPelamar, 0, ',', '.') }}</h3>
                                <span class="percentage {{ $persentasePelamar['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                    <i class="bi {{ $persentasePelamar['status'] == 'increase' ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                                    {{ $persentasePelamar['value'] }}% Dari Bulan Lalu
                                </span>
                            </div>
                            <div class="icon" style="background-color: #3b82f6;"><i class="bi bi-people-fill"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small class="text-secondary">Total Perusahaan</small>
                                <h3>{{ number_format($totalPerusahaan, 0, ',', '.') }}</h3>
                                <span class="percentage {{ $persentasePerusahaan['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                    <i class="bi {{ $persentasePerusahaan['status'] == 'increase' ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                                    {{ $persentasePerusahaan['value'] }}% Dari Bulan Lalu
                                </span>
                            </div>
                            <div class="icon" style="background-color: #10b981;"><i class="bi bi-building-fill"></i></div>
                        </div>
                    </div>
                </div>
                
                {{-- [BARU] Kartu Statistik untuk UMKM --}}
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small class="text-secondary">Total UMKM</small>
                                <h3>{{ number_format($totalUmkm, 0, ',', '.') }}</h3>
                                <span class="percentage {{ $persentaseUmkm['status'] == 'increase' ? 'text-success' : 'text-danger' }}">
                                    <i class="bi {{ $persentaseUmkm['status'] == 'increase' ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                                    {{ $persentaseUmkm['value'] }}% Dari Bulan Lalu
                                </span>
                            </div>
                            <div class="icon" style="background-color: #6366f1;"><i class="bi bi-shop"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stat-card h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small class="text-secondary">Lowongan Aktif</small>
                                <h3>{{ number_format($lowonganAktif, 0, ',', '.') }}</h3>
                                <span class="percentage text-secondary">Total lowongan saat ini</span>
                            </div>
                            <div class="icon" style="background-color: #f59e0b;"><i class="bi bi-briefcase-fill"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
            <div class="col-md-8">
                <div class="chart-card h-100">
                    <h5 class="mb-4">Grafik Pendaftaran User Baru (20 Hari Terakhir)</h5>
                    <div style="height: 300px;">
                        {{-- [DIUBAH] Menambahkan data-umkm --}}
                        <canvas id="userChart" 
                                data-labels='@json($chartLabels)' 
                                data-pelamar='@json($pelamarChartData)' 
                                data-perusahaan='@json($perusahaanChartData)'
                                data-umkm='@json($umkmChartData)'></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="activity-card h-100 d-flex flex-column">
                    <h5 class="mb-4 flex-shrink-0">Aktivitas Terkini</h5>
                    
                    <div class="activity-list-wrapper">
                        @forelse($recentActivities as $activity)
                            <div class="activity-item">
                                <div class="icon">
                                    @if($activity->activity_type == 'Pendaftaran Pelamar')
                                        <i class="bi bi-person-plus-fill"></i>
                                    @elseif($activity->activity_type == 'Pendaftaran Perusahaan')
                                        <i class="bi bi-building-add"></i>
                                    {{-- [BARU] Tambahkan ikon untuk pendaftaran UMKM --}}
                                    @elseif($activity->activity_type == 'Pendaftaran UMKM')
                                        <i class="bi bi-shop"></i>
                                    @else
                                        <i class="bi bi-bell-fill"></i>
                                    @endif
                                </div>
                                <div>
                                    {!! Str::of($activity->description)->replace($activity->user->name ?? '', '<strong>'.($activity->user->name ?? 'Pengguna').'</strong>') !!}
                                    <small class="d-block opacity-75">{{ $activity->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center opacity-75">
                                <p>Belum ada aktivitas terkini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

            <div class="table-card">
                <h5 class="mb-4">Menunggu Persetujuan</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-custom">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menungguPersetujuan as $item)
                            <tr>
                                <td><strong>{{ $item->nama }}</strong></td>
                                <td><span class="badge bg-primary-subtle text-primary-emphasis">{{ $item->tipe }}</span></td>
                                <td>{{ $item->tanggal }}</td>
                                <td><span class="badge bg-warning-subtle text-warning-emphasis">{{ $item->status }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-success"><i class="bi bi-check-lg"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data yang menunggu persetujuan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    {{-- [DIUBAH] Memperbarui script untuk memasukkan data UMKM --}}
    <script>
        const chartCanvas = document.getElementById('userChart');
        const chartLabels = JSON.parse(chartCanvas.dataset.labels);
        const pelamarData = JSON.parse(chartCanvas.dataset.pelamar);
        const perusahaanData = JSON.parse(chartCanvas.dataset.perusahaan);
        const umkmData = JSON.parse(chartCanvas.dataset.umkm); // [BARU] Baca data UMKM

        new Chart(chartCanvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [
                    { label: 'Pelamar', data: pelamarData, backgroundColor: '#3b82f6', borderRadius: 4 },
                    { label: 'Perusahaan', data: perusahaanData, backgroundColor: '#10b981', borderRadius: 4 },
                    // [BARU] Tambahkan dataset untuk UMKM
                    { label: 'UMKM', data: umkmData, backgroundColor: '#f59e0b', borderRadius: 4 } 
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { 
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: { 
                        grid: { display: false },
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 45
                        }
                    }
                },
                plugins: {
                    legend: { position: 'top', align: 'end' }
                }
            }
        });
    </script>
</body>
</html>