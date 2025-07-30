<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Messari')</title>

    <!-- Bootstrap & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Style -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            /* Mengubah background body agar lebih netral, karena konten profil menggunakan kartu putih */
            background-color: #f0f2f5; 
            color: #333; /* Mengubah warna teks default agar terbaca di background terang */
            overflow-x: hidden;
        }

        /* --- Navbar Styles --- */
        .navbar {
            padding: 1rem 0;
            z-index: 1000;
            position: relative;
            background-color: #22374e;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: white;
        }
        .navbar-nav .nav-link {
            margin-right: 1rem;
            color: white;
        }
        .navbar-nav .nav-link:hover {
            color: #ff7b00;
        }
        .navbar-nav .highlight-text {
            color: #ff7b00 !important;
            font-weight: bold;
        }

        /* Global Button Styles */
        .btn-orange {
            background-color: #ff7b00;
            color: white;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .btn-orange:hover {
            background-color: #ff8c1a;
            color: white;
        }
        .btn-outline-light {
            padding: 0.6rem 1.5rem;
            border-color: white;
            color: white;
        }
        .btn-outline-light:hover {
            background-color: white;
            color: #22374e;
            border-color: white;
        }

        /* Offcanvas Navbar Styles */
        .offcanvas-header {
            background-color: #22374e;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .offcanvas-title {
            color: white;
            font-weight: bold;
        }
        .offcanvas-body {
            background-color: #22374e;
            color: white;
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
        }
        .offcanvas-body .navbar-nav {
            width: 100%;
            margin-left: 0;
            flex-grow: 1;
        }
        .offcanvas-body .navbar-nav .nav-item {
            width: 100%;
            text-align: left;
            margin-bottom: 0.5rem;
        }
        .offcanvas-body .navbar-nav .nav-link {
            padding: 0.75rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            color: white;
        }
        .offcanvas-body .navbar-nav .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .offcanvas-buttons {
            margin-top: 1.5rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .offcanvas-buttons .btn {
            width: 100%;
        }
        
        @media (max-width: 991.98px) {
            .navbar .ms-auto {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    {{-- PERUBAHAN DI SINI: Menyesuaikan path ke navbar pelamar --}}
    @include('pelamar.partials.navbar')

    <main class="py-4">
        {{-- Di sinilah konten dari halaman profil Anda akan ditampilkan --}}
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
