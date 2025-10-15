<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Messari</title>
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa; /* Warna latar belakang abu-abu muda */
        }

        /* Navbar */
        .navbar-admin {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 0.8rem 1rem;
        }
        .navbar-admin .navbar-brand {
            font-weight: bold;
            color: #2d3e50;
        }
        .navbar-admin .nav-link {
            color: #5a6a7a;
            font-weight: 500;
        }
        .navbar-admin .nav-link.active {
            color: #f97316;
            font-weight: bold;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(90deg, #3a506b 0%, #2d3e50 100%);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }
        .hero-section h1 {
            font-size: 2.8rem;
            font-weight: 900;
        }
        .hero-section p {
            font-size: 1.1rem;
            color: #e0e0e0;
        }
        .btn-orange {
            background-color: #f97316;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-orange:hover {
            background-color: #fb923c;
            transform: translateY(-2px);
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
        .chart-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .chart-card h4 {
            font-weight: bold;
            color: #2d3e50;
        }

        /* Footer */
        .admin-footer {
            background-color: #ffffff;
            color: #5a6a7a;
            padding: 1.5rem 0;
            border-top: 1px solid #e9ecef;
        }
        .admin-footer a {
            color: #5a6a7a;
            text-decoration: none;
            margin: 0 1rem;
        }
        .admin-footer a:hover {
            color: #f97316;
        }

        @media (max-width: 991.98px) {
            .hero-illustration {
                display: none;
            }
            .welcome-text-bg {
                font-size: 5rem;
            }
            .hero-section {
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-admin sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">MESSARI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pelamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perusahaan</a>
                    </li>
                </ul>
                <div class="d-flex">
                    @auth
                        <span class="navbar-text me-3">
                            Halo, {{ Auth::user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container position-relative">
            <div class="welcome-text-bg">WELCOME</div>
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>SELAMAT DATANG, <br>MAS ADMIN</h1>
                    <p class="lead my-3">Pantau kegiatan user disini</p>
                    <a href="{{ route('admin.homepage') }}" class="btn btn-orange">
                        Lihat Dashboard <i class="bi bi-arrow-down-circle ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        {{-- Ganti 'src' dengan path gambar ilustrasi Anda --}}
        <img src="{{ asset('images/admin-hero-illustration.png') }}" 
             alt="Admin Illustration" 
             class="hero-illustration"
             onerror="this.onerror=null;this.src='https://placehold.co/400x450/transparent/ffffff?text=Ilustrasi+Admin';">
    </header>

    <!-- Main Content -->
    <main class="main-content" id="chart-section">
        <div class="container">
            <div class="chart-card">
                <h4 class="mb-4">Grafik Pendaftaran User Baru (Berdasarkan Bulan)</h4>
                <div style="height: 350px;">
                    {{-- FIX: Data dari Blade dipindahkan ke atribut data-* untuk memisahkan PHP dan JS --}}
                    <canvas id="userChart" 
                        data-labels='@json($chartLabels)' 
                        data-pelamar='@json($pelamarChartData)' 
                        data-perusahaan='@json($perusahaanChartData)'
                        data-umkm='@json($umkmChartData)'> 
                    </canvas>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="admin-footer">
        <div class="container text-center">
            <a href="#">Tentang Job</a>
            <a href="#">Layanan</a>
            <a href="#">Keamanan & Privasi</a>
            <a href="#">Persyaratan & Ketentuan</a>
            <a href="#"><strong>Kunjungi Pusat Bantuan Kami</strong></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const chartCanvas = document.getElementById('userChart');
        const chartLabels = JSON.parse(chartCanvas.dataset.labels);
        const pelamarData = JSON.parse(chartCanvas.dataset.pelamar);
        const perusahaanData = JSON.parse(chartCanvas.dataset.perusahaan);
        const umkmData = JSON.parse(chartCanvas.dataset.umkm);

        new Chart(chartCanvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [
                    { label: 'Pelamar', data: pelamarData, backgroundColor: '#3b82f6' },
                    { label: 'Perusahaan', data: perusahaanData, backgroundColor: '#10b981' },
                    { label: 'UMKM', data: umkmData, backgroundColor: '#f59e0b' } 
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { 
                        beginAtZero: true,
                        // FIX: Menambahkan nilai maksimum dan ukuran langkah pada sumbu Y
                        max: 10, // Anda bisa sesuaikan angka ini, misalnya 20 atau 50
                        ticks: {
                            stepSize: 1 // Memastikan label sumbu Y adalah bilangan bulat (1, 2, 3, ...)
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
