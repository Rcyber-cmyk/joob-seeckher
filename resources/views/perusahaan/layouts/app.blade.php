<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perusahaan - Messari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #ff7a00;
            --secondary-color: #071b2f;
            --text-color: #333;
            --bg-light: #E8E8E8FF;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-color);
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* --- Sidebar & Offcanvas on Desktop --- */
        .sidebar {
            width: 280px;
            background-color: var(--secondary-color);
            color: white;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: all 0.3s ease-in-out;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1050;
        }
        
        /* --- Styles untuk semua mode --- */
        .sidebar .logo-section {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 2rem;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        .sidebar .nav-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 1rem;
        }
        .user-profile {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
        }
        .user-profile img {
            border: 2px solid var(--primary-color);
        }
        .user-profile .text-small {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
        }
        .user-profile .log-out {
            color: var(--primary-color);
            transition: color 0.3s;
        }
        .user-profile .log-out:hover {
            color: white;
        }
        .main-content {
            flex-grow: 1;
            padding: 2rem;
            margin-left: 280px; /* Jarak untuk sidebar */
            transition: all 0.3s ease-in-out;
        }

        /* --- Main Content Mobile Header (Navbar) --- */
        .main-content-header {
            display: none;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .main-content-header .btn-toggle {
            background-color: transparent;
            border: none;
            color: var(--secondary-color);
            font-size: 1.5rem;
        }
        .main-content-header .logo-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--secondary-color);
        }

        /* --- Media Queries --- */
        /* Tablet & Mobile */
        @media (max-width: 991.98px) {
            .dashboard-container {
                flex-direction: column;
            }
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .main-content {
                margin-left: 0;
                padding-top: 5rem; /* Tambahkan padding agar tidak tertutup header mobile */
            }
            .main-content-header {
                display: flex;
            }
            .sidebar-offcanvas {
                visibility: visible;
                transform: none;
                position: relative;
            }
            .header-dashboard {
                flex-direction: column;
                align-items: flex-start;
            }
            .header-dashboard h1 {
                font-size: 1.5rem;
            }
            .header-dashboard .btn-post {
                width: 100%;
                margin-top: 1rem;
            }
            .offcanvas-lg .logo-section,
            .offcanvas-lg .user-profile {
                display: none;
            }
        }
        /* Desktop */
        @media (min-width: 992px) {
            .offcanvas-lg {
                visibility: visible;
                transform: none;
                position: relative;
                display: flex !important;
            }
            .main-content {
                margin-left: 280px;
            }
        }
        
        /* Gaya tambahan untuk offcanvas */
        .offcanvas-header {
            background-color: var(--secondary-color);
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .offcanvas-body {
            background-color: var(--secondary-color);
            color: white;
        }

        /* --- Main Content Elements --- */
        .header-dashboard {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .header-dashboard h1 {
            font-size: 2rem;
            font-weight: bold;
            color: var(--secondary-color);
        }
        .header-dashboard .btn-post {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
        }
        /* Penyesuaian untuk tampilan mobile */
        @media (max-width: 991.98px) {
            .header-dashboard-mobile h1 {
                font-size: 1.5rem;
            }
            .header-dashboard-mobile .btn-post {
                width: 100%;
                margin-top: 1rem;
            }
            .info-card .card-value {
                font-size: 2rem;
            }
            .dashboard-section h5 {
                font-size: 1.1rem;
            }
        }

        .info-card {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        .info-card h4 {
            font-size: 1rem;
            color: #6c757d;
        }
        .info-card .card-value {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .info-card .icon-placeholder {
            width: 50px;
            height: 50px;
            background-color: #e9ecef;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .info-card .icon-placeholder i {
            font-size: 1.5rem;
            color: var(--text-color);
        }
        .info-card .change-text {
            font-size: 0.85rem;
            color: #28a745;
        }
        .info-card .info-lowongan .icon-placeholder { background-color: rgba(255, 122, 0, 0.1); }
        .info-card .info-lowongan .icon-placeholder i { color: var(--primary-color); }
        .info-card .info-pelamar .icon-placeholder { background-color: rgba(7, 27, 47, 0.1); }
        .info-card .info-pelamar .icon-placeholder i { color: var(--secondary-color); }
        .info-card .info-wawancara .icon-placeholder { background-color: rgba(255, 122, 0, 0.1); }
        .info-card .info-wawancara .icon-placeholder i { color: var(--primary-color); }
        .info-card .info-diterima .icon-placeholder { background-color: rgba(7, 27, 47, 0.1); }
        .info-card .info-diterima .icon-placeholder i { color: var(--secondary-color); }
        .dashboard-section {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        .dashboard-section h5 {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }
        .kandidat-item {
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 0;
        }
        .kandidat-item:last-child {
            border-bottom: none;
        }
        .kandidat-item .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .kandidat-item .name {
            font-weight: 600;
        }
        .kandidat-item .email {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .kandidat-item .date {
            font-size: 0.8rem;
            color: #6c757d;
        }
        .kandidat-item .status {
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }
        .kandidat-item .status.new {
            color: var(--primary-color);
            background-color: rgba(255, 122, 0, 0.1);
        }
        .kandidat-item .status.viewed {
            color: var(--secondary-color);
            background-color: rgba(7, 27, 47, 0.1);
        }
        .chart-container {
            position: relative;
            height: 250px;
        }
        .chart-legend {
            margin-left: 2rem;
            font-size: 0.5rem;
        }
        .chart-legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .chart-legend-color {
            width: 15px;
            height: 15px;
            border-radius: 3px;
            margin-right: 0.5rem;
        }
        
    </style>
</head>
<body>
    <div class="main-content-header d-lg-none">
        <button class="btn btn-sm btn-outline-dark me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
            <i class="bi bi-list"></i>
        </button>
        <span class="logo-text">Job Recruitmen</span>
    </div>

    <div class="dashboard-container">
        <!-- Memanggil navbar dari file terpisah -->
        @include('perusahaan.partials.navbar')

        <div class="main-content">
            <!-- Tempat untuk konten spesifik halaman -->
            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
