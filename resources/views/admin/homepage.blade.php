<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin - JobRec</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
            --orange-light: #fb923c;
            --dark-blue: #0f172a;
            --slate-700: #334155;
            --slate-500: #64748b;
            --slate-300: #cbd5e1;
            --slate-100: #f1f5f9;
            --white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--slate-100);
        }

        /* Navbar */
        .navbar-admin {
            background-color: var(--white);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            padding: 0.8rem 1rem;
        }
        .navbar-admin .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--orange-dark);
        }
        .navbar-admin .nav-link {
            color: var(--slate-500);
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 0.8rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .navbar-admin .nav-link:hover {
            color: var(--dark-blue);
            background-color: var(--slate-100);
        }
        .navbar-admin .nav-link.active {
            color: var(--orange-dark);
            font-weight: 600;
            background-color: #fff7ed;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(90deg, var(--dark-blue) 0%, var(--slate-700) 100%);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
            border-bottom: 5px solid var(--orange);
        }
        .hero-section h1 {
            font-size: 2.8rem;
            font-weight: 800;
        }
        .hero-section p {
            font-size: 1.1rem;
            color: var(--slate-300);
        }
        .btn-orange {
            background-color: var(--orange);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px -2px rgba(249, 115, 22, 0.4);
        }
        .btn-orange:hover {
            background-color: var(--orange-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -2px rgba(249, 115, 22, 0.5);
        }
        .hero-illustration {
            position: absolute;
            right: 5%;
            bottom: 0;
            max-width: 400px;
            opacity: 0.9;
        }
        .welcome-text-bg {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 8rem;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.05);
            z-index: 0;
            user-select: none;
        }

        /* Main Content */
        .main-content {
            padding: 3rem 0;
        }
        
        /* Kartu Statistik BARU */
        .stat-card-compact {
            background-color: var(--white);
            border-radius: 1rem;
            padding: 1.75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .stat-card-compact:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        .stat-card-compact .icon {
            flex-shrink: 0;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: var(--icon-color, var(--white));
            background-color: var(--icon-bg, var(--dark-blue));
            margin-right: 1.25rem;
        }
        .stat-card-compact h3 {
            font-weight: 700;
            font-size: 2rem;
            color: var(--dark-blue);
            margin: 0;
        }
        .stat-card-compact p {
            font-weight: 500;
            color: var(--slate-500);
            margin: 0;
            line-height: 1.2;
        }

        /* Kartu Grafik */
        .chart-card {
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
        }
        .chart-card h4 {
            font-weight: 700;
            color: var(--dark-blue);
        }

        /* Footer */
        .admin-footer {
            background-color: var(--white);
            color: var(--slate-500);
            padding: 1.5rem 0;
            border-top: 1px solid #e9ecef;
            margin-top: 3rem;
        }
        .admin-footer a {
            color: var(--slate-500);
            text-decoration: none;
            margin: 0 1rem;
        }
        .admin-footer a:hover {
            color: var(--orange);
        }

        @media (max-width: 991.98px) {
            .hero-illustration { display: none; }
            .welcome-text-bg { font-size: 5rem; }
            .hero-section { text-align: center; }
            .navbar-admin .nav-link { margin: 0.25rem 0; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-admin sticky-top">
        <div class="container">
            <a class="navbar-brand" href="">JobRec</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}">Pelamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}">Perusahaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.notifikasi.index') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}">Notifikasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('admin.pengaturan.index') ? 'active' : '' }}" href="{{ route('admin.pengaturan.index') }}">Pengaturan</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    @auth
                        <span class="navbar-text me-3 d-none d-lg-block">
                            Halo, <strong class="text-dark">{{ Auth::user()->name }}</strong>
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container position-relative" style="z-index: 2;">
            <div class="welcome-text-bg">ADMIN</div>
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>SELAMAT DATANG, <br>MAS ADMIN</h1>
                    <p class="lead my-4">Halaman beranda admin untuk mengelola seluruh ekosistem JobRec.</p>
                    <a href="{{ route('admin.homepage') }}" class="btn btn-orange">
                        Buka Dashboard Utama <i class="bi bi-grid-1x2-fill ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        {{-- Ganti 'src' dengan path gambar ilustrasi Anda --}}
        <img src="https://placehold.co/400x450/transparent/ffffff?text=Ilustrasi+Admin" 
             alt="Admin Illustration" 
             class="hero-illustration"
             onerror="this.style.display='none'">
    </header>

    <main class="main-content" id="chart-section">
        <div class="container">

            <div class="row g-4 mb-5">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card-compact h-100">
                        <div class="icon" style="--icon-bg: #3b82f6; --icon-color: #fff;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <h3>{{ $totalPelamar ?? 0 }}</h3>
                            <p>Total Pelamar</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card-compact h-100">
                        <div class="icon" style="--icon-bg: #10b981; --icon-color: #fff;">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <div>
                            <h3>{{ $totalPerusahaan ?? 0 }}</h3>
                            <p>Total Perusahaan</p>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-6">
                    <div class="stat-card-compact h-100">
                        <div class="icon" style="--icon-bg: #8b5cf6; --icon-color: #fff;">
                            <i class="bi bi-shop"></i>
                        </div>
                        <div>
                            <h3>{{ $totalUmkm ?? 0 }}</h3>
                            <p>Total UMKM</p>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-6">
                    <div class="stat-card-compact h-100">
                        <div class="icon" style="--icon-bg: #f59e0b; --icon-color: #fff;">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <div>
                            <h3>{{ $lowonganAktif ?? 0 }}</h3>
                            <p>Lowongan Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-card">
                <h4 class="mb-4">Grafik Pendaftaran User Baru (Berdasarkan Bulan)</h4>
                <div style="height: 350px;">
                    <canvas id="userChart" 
                        data-labels='@json($chartLabels ?? [])' 
                        data-pelamar='@json($pelamarChartData ?? [])' 
                        data-perusahaan='@json($perusahaanChartData ?? [])'
                        data-umkm='@json($umkmChartData ?? [])'> 
                    </canvas>
                </div>
            </div>
        </div>
    </main>

    <footer class="admin-footer">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} JobRec. Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> oleh Tim Anda.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chartCanvas = document.getElementById('userChart');
            if (chartCanvas) {
                const ctx = chartCanvas.getContext('2d');
                const chartLabels = JSON.parse(chartCanvas.dataset.labels);
                const pelamarData = JSON.parse(chartCanvas.dataset.pelamar);
                const perusahaanData = JSON.parse(chartCanvas.dataset.perusahaan);
                const umkmData = JSON.parse(chartCanvas.dataset.umkm);

                // Fungsi untuk membuat gradient
                const createGradient = (color1, color2) => {
                    const gradient = ctx.createLinearGradient(0, 0, 0, 350);
                    gradient.addColorStop(0, color1);
                    gradient.addColorStop(1, color2);
                    return gradient;
                }

                new Chart(ctx, {
                    type: 'line', // DIUBAH DARI 'bar' MENJADI 'line'
                    data: {
                        labels: chartLabels,
                        datasets: [
                            { 
                                label: 'Pelamar', 
                                data: pelamarData, 
                                backgroundColor: createGradient('rgba(59, 130, 246, 0.3)', 'rgba(59, 130, 246, 0)'), // Biru
                                borderColor: '#3b82f6',
                                pointBackgroundColor: '#3b82f6',
                                borderWidth: 2.5,
                                fill: true,
                                tension: 0.4
                            },
                            { 
                                label: 'Perusahaan', 
                                data: perusahaanData, 
                                backgroundColor: createGradient('rgba(16, 185, 129, 0.3)', 'rgba(16, 185, 129, 0)'), // Hijau
                                borderColor: '#10b981',
                                pointBackgroundColor: '#10b981',
                                borderWidth: 2.5,
                                fill: true,
                                tension: 0.4 
                            },
                            { 
                                label: 'UMKM', 
                                data: umkmData, 
                                backgroundColor: createGradient('rgba(245, 158, 11, 0.3)', 'rgba(245, 158, 11, 0)'), // Oranye
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
                            y: { 
                                beginAtZero: true,
                                // max: 10, <-- DIHAPUS agar otomatis
                                ticks: { 
                                    // stepSize: 1, <-- DIHAPUS agar otomatis
                                    color: '#64748b', 
                                    font: { family: 'Poppins' }
                                } 
                            },
                            x: { 
                                grid: { display: false },
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
                                    color: '#334155', 
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
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>