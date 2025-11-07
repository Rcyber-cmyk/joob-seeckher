<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Beranda Perusahaan - Messari</title>

    <!-- Bootstrap & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Style Global dan Responsif -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            color: #333;
            overflow-x: hidden;
            background-color: #f0f2f5;
            -webkit-tap-highlight-color: transparent;
        }

        /* --- Navbar Styles --- */
        .navbar { padding: 1rem 0; z-index: 1000; position: relative; background-color: #071b2f; color: white; }
        .navbar-brand { font-weight: bold; font-size: 1.5rem; letter-spacing: 2px; color: white; }
        .navbar-nav .nav-link { margin-right: 1rem; color: white; }
        .navbar-nav .nav-link:hover { color: #071b2f; }
        .navbar-nav .highlight-text { color: #071b2f !important; font-weight: bold; }
         #offcanvasNavbar.offcanvas {
            background-color: #ff7a00 !important;
        }
        #offcanvasNavbar .offcanvas-header {
            background-color: #ff7a00 !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        #offcanvasNavbar .offcanvas-title {
            color: white !important;
            font-weight: bold;
        }
        #offcanvasNavbar .offcanvas-body {
            background-color: #ff7a00 !important;
            color: white !important;
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
        }
        #offcanvasNavbar .offcanvas-body .navbar-nav {
            width: 90%;
            margin-left: 0;
            flex-grow: 1;
        }
        #offcanvasNavbar .offcanvas-body .navbar-nav .nav-item {
            width: 60%;
            text-align: left;
            margin-bottom: 0.5rem;
        }
        #offcanvasNavbar .offcanvas-body .navbar-nav .nav-link {
            padding: 0.75rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            color: white !important;
        }
        #offcanvasNavbar .offcanvas-body .navbar-nav .nav-link:hover {
            background-color: rgba(255,123,0,0.2);
        }
        #offcanvasNavbar .offcanvas-body .navbar-nav .nav-link.highlight-text {
            color: white !important;
            font-weight: bold;
        }
        #offcanvasNavbar .offcanvas-buttons {
            margin-top: 1.5rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        #offcanvasNavbar .offcanvas-buttons .btn {
            width: 100%;
        }
        #offcanvasNavbar .offcanvas-buttons .btn-outline-light {
            border-color: white !important;
            color: white !important;
            background-color: transparent !important;
        }
        #offcanvasNavbar .offcanvas-buttons .btn-outline-light:hover {
            background-color: white !important;
            color: #071b2f !important;
        }
        #offcanvasNavbar .offcanvas-buttons .btn-dark {
            background-color: #071b2f !important;
            color: white !important;
            border: none !important;
        }
        #offcanvasNavbar .offcanvas-buttons .btn-dark:hover {
            background-color: #0A2C4FFF !important;
        }

        @media (max-width: 768px) {
            .navbar .ms-auto { display: none !important; }
        }

        /* Global Button Styles */
        .btn-orange { background-color: #ff7b00; color: white; padding: 0.6rem 1.5rem; border: none; border-radius: 5px; transition: all 0.3s; }
        .btn-orange:hover { background-color: #ff8c1a; color: white; }
        .btn-navy { background-color: #001f3f; color: white; padding: 0.6rem 1.5rem; border: none; border-radius: 5px; transition: all 0.3s; }
        .btn-navy:hover { background-color: #001737; color: white; }
        .btn-outline-light { padding: 0.6rem 1.5rem; border-color: white; color: white; }
        .btn-outline-light:hover { background-color: white; color: #ff7a00; }
        .btn-dark { background-color: #212529; color: white; padding: 0.6rem 1.5rem; border: none; border-radius: 5px; transition: all 0.3s; }
        .btn-dark:hover { background-color: #343a40; color: white; }

        /* --- Hero Section --- */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 4rem 0;
            background-color: #ff7a00;
            color: white;
        }
        .hero-section h1 { font-size: 3rem; font-weight: 800; line-height: 1.3; }
        .hero-section p { font-size: 1.2rem; }
        .hero-img { max-width: 350px; height: auto; filter: drop-shadow(0 0 15px rgba(0,0,0,0.3)); }

        /* --- Main Content Wrapper --- */
        .main-content { background: white; color: black; padding-top: 4rem; padding-bottom: 4rem; }
        .main-content h4 { color: #ff7b00; font-weight: bold; margin-bottom: 2rem; }
        .main-content h4 img { vertical-align: middle; height: 50px; margin-right: 10px; }
        .info-section .card { border: none; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 1.5rem; text-align: center; background-color: #f8f9fa; color: #333; height: 100%; }
        .info-section h2 { color: #001f3f; font-weight: bold; }
        .info-section p.fw-semibold { color: #ff7b00; font-size: 1.1rem; }
        .info-section .rounded-circle { background-color: #ff7b00 !important; color: white !important; width: 50px; height: 50px; font-weight: bold; font-size: 1.5rem; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; }
        .info-section .fa-hands-helping { color: #ff7b00 !important; font-size: 2.5rem; margin-bottom: 10px;}
        .steps-section .p-4 { background-color: #22374e !important; color: white !important; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); height: 100%; display: flex; flex-direction: column; justify-content: flex-start; }
        .steps-section .rounded-circle { background-color: #ff7b00 !important; color: white !important; width: 35px; height: 35px; font-weight: bold; font-size: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }
        .steps-section h6 { color: white !important; font-size: 1.1rem; font-weight: bold; margin-bottom: 0.5rem; }
        .steps-section p { color: rgba(255,255,255,0.7) !important; font-size: 0.95rem;}
        
        /* --- CTA Section --- */
        .cta-section { background-color: white; color: #000; padding: 4rem 0; text-align: left; }
        .cta-section h2 { font-size: 2.5rem; font-weight: bold; line-height: 1.2; margin-bottom: 1.5rem; color: #000000; }
        .cta-section p { font-size: 1.1rem; margin-bottom: 2rem; color: #666; }
        .cta-section .cta-img { max-width: 400px; height: auto; filter: drop-shadow(0 0 20px rgba(0,0,0,0.5)); }

        /* --- Footer --- */
        footer.footer { background-color: #071b2f; color: white; width: 100%; padding: 4rem 0; }
        footer.footer ul { list-style-type: none; padding-left: 0; }
        footer.footer .text-white-50 { color: rgba(255, 255, 255, 0.5); }
        footer.footer a { color: #ff7b00; text-decoration: none; transition: text-decoration 0.3s ease; }
        footer.footer a:hover { text-decoration: underline; }
        footer.footer .footer-img { max-height: 300px; object-fit: contain; filter: drop-shadow(0 0 10px rgba(0,0,0,0.3)); }
        
        /* Modal */
        #loginRequiredModal .modal-content { background-color: #ffffff; color: #212529; border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
        #loginRequiredModal .modal-header { border-bottom: none; padding: 2rem 2rem 0rem 2rem; flex-direction: column; align-items: center; }
        #loginRequiredModal .modal-title { color: #212529 !important; font-weight: bold; font-size: 1.8rem; text-align: center; width: 100%; }
        #loginRequiredModal .btn-close { filter: none; position: absolute; top: 15px; right: 15px; }
        #loginRequiredModal .modal-body { color: #495057 !important; padding: 1rem 2rem 1.5rem 2rem; font-size: 1.05rem; text-align: center; }
        #loginRequiredModal .modal-footer { border-top: none; padding: 0rem 2rem 2rem 2rem; justify-content: center; flex-direction: column; gap: 10px; }
        #loginRequiredModal .modal-footer .btn { width: 100%; max-width: 250px; padding: 0.8rem 1.5rem; font-size: 1rem; font-weight: 600; border-radius: 8px; text-decoration: none; }
        #loginRequiredModal .modal-footer .btn-primary-custom { background-color: #ff7b00; border-color: #ff7b00; color: white; }
        #loginRequiredModal .modal-footer .btn-primary-custom:hover { background-color: #ff8c1a; border-color: #ff8c1a; color: white; }
        #loginRequiredModal .modal-footer .btn-outline-primary-custom { background-color: transparent; border-color: #ff7b00; color: #ff7b00; }
        #loginRequiredModal .modal-footer .btn-outline-primary-custom:hover { background-color: #ff7b00; border-color: #ff7b00; color: white; }


        /* --- Responsive Adjustments --- */
        @media (max-width: 360px) {
            .navbar .ms-auto { display: none !important; }
        }
            @media (max-width: 767.98px) {
            .hero-section {
                min-height: 60vh; /* Pastikan tinggi penuh untuk centering vertikal */
                padding: 2rem 1rem;
                display: flex; /* Aktifkan flexbox */
                flex-direction: column; /* Susun item secara vertikal */
                justify-content: center; /* Pusatkan konten vertikal */
                align-items: center; /* Pusatkan seluruh konten hero section secara horizontal */
            }
            .hero-section .container {
                display: flex;
                flex-direction: column;
                width: 100%; /* Pastikan container mengambil lebar penuh */
                align-items: center; /* Pusatkan konten container secara horizontal */
            }
            .hero-section .row {
                width: 100%; /* Pastikan baris mengambil lebar penuh */
                display: flex; /* Make the row a flex container */
                flex-direction: row !important; /* Paksa kolom berdampingan */
                flex-wrap: nowrap !important; /* Mencegah kolom menumpuk */
                justify-content: flex-start !important; /* Mulai dari kiri */
                align-items: center !important; /* Pusatkan konten secara vertikal di dalam baris */
            }

            /* Gaya untuk kolom teks/tombol (kolom pertama) */
            .hero-section .col-md-6:first-child {
                flex: 0 0 60% !important; /* Memaksa lebar 50% */
                max-width: 60% !important;
                text-align: left !important; /* Teks rata kiri */
                display: flex;
                flex-direction: column;
                align-items: flex-start !important; /* Elemen di dalam kolom (h1, p, div tombol) rata kiri */
                justify-content: center;
                margin-bottom: 2rem !important;
            }

            /* Gaya untuk kolom gambar (kolom kedua) */
            .hero-section .col-md-6.text-center {
                flex: 0 0 40% !important; /* Memaksa lebar 50% */
                max-width: 40% !important;
                text-align: center !important; /* Pusatkan gambar */
                display: flex; /* Gunakan flexbox untuk kolom gambar */
                flex-direction: column;
                align-items: center !important; /* Pusatkan gambar secara horizontal menggunakan flexbox */
                justify-content: center;
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }

            .hero-section h1 {
                font-size: 1rem;
            }
            .hero-section p {
                font-size: 0.5rem;
            }
            .hero-img {
                max-width: 80%;
            }
            .hero-section .mt-3 { /* Div yang berisi tombol-tombol */
                display: flex;
                flex-direction: row !important; /* Susun tombol secara horizontal */
                gap: 1rem !important; /* Jarak antar tombol */
                width: 90% !important; /* Tombol kontainer mengambil lebar sesuai konten */
                align-items: flex-start !important; /* Rata kiri tombol */
            }
            .hero-section .mt-3 .btn {
                width: 40% !important; /* Tombol mengambil lebar sesuai kontennya */
            }
        }

        /* Penyesuaian Main Content untuk Mobile */
        @media (max-width: 767.98px) {
            .main-content .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .main-content h4 {
                font-size: 1.4rem;
                text-align: center;
                justify-content: center !important;
            }
            .main-content h4 img {
                height: 40px !important;
            }
        }

        /* Penyesuaian Info Atas untuk Mobile */
        @media (max-width: 767.98px) {
            .info-section .row {
                flex-wrap: nowrap !important; /* Mencegah penumpukan kolom */
                overflow-x: auto; /* Memungkinkan scroll horizontal jika konten terlalu lebar */
                justify-content: flex-start !important; /* Mulai dari kiri */
            }
            .info-section .col-md-4 { /* Target kolom asli */
                flex: 0 0 33.33% !important; /* Memaksa lebar 33.33% */
                max-width: 33.33% !important;
                text-align: center; /* Tetap pusatkan teks di setiap kolom */
            }
        }

        /* Penyesuaian Langkah-langkah untuk Mobile */
        @media (max-width: 767.98px) {
            .steps-section .row {
                flex-wrap: nowrap !important; /* Mencegah penumpukan kolom */
                overflow-x: auto; /* Memungkinkan scroll horizontal jika konten terlalu lebar */
                justify-content: flex-start !important; /* Mulai dari kiri */
            }
            .steps-section .col-md-4 { /* Target kolom asli */
                flex: 0 0 60.33% !important; /* Memaksa lebar 33.33% */
                max-width: 60.33% !important;
            }
            .steps-section .col-md-4 .p-4 {
                text-align: left; /* Pastikan teks di dalam kartu tetap rata kiri */
                font-size: 0.2rem;
            }
        }

        /* CTA Section Mobile */
        @media (max-width: 767.98px) {
            .cta-section {
                padding: 2rem 0;
            }
            .cta-section .row {
                flex-direction: row;
                flex-wrap: nowrap !important;
                justify-content: flex-start;
                align-items: center;
            }
            .cta-section .col-md-7 {
                flex: 0 0 60% !important;
                max-width: 60% !important;
                padding-right: 1rem;
                text-align: left;
            }
            .cta-section .col-md-5 {
                flex: 0 0 30% !important;
                max-width: 30% !important;
            }
            .cta-section h2 {
                font-size: 1.8rem;
                margin-top: 0;
            }
            .cta-section p {
                font-size: 0.9rem;
            }
            .cta-section .btn {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
            .cta-section .cta-img {
                max-width: 130%;
                margin-bottom: 0;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 991.98px) {
            footer.footer .row.align-items-center {
                flex-wrap: nowrap !important;
                overflow-x: auto;
                justify-content: flex-start !important;
                padding-bottom: 2rem;
            }
            footer.footer .col-lg-8,
            footer.footer .col-lg-4 {
                flex: 0 0 auto !important;
                max-width: none !important;
                width: auto !important;
                text-align: left !important;
                margin-bottom: 0 !important;
                padding-right: 1rem;
                padding-left: 1rem;
            }
            footer.footer .col-lg-4 img {
                margin-left: 2rem;
            }

            footer.footer .col-lg-8 .row {
                flex-wrap: nowrap !important;
                overflow-x: auto;
                justify-content: flex-start !important;
            }
            footer.footer .col-lg-8 .col-md-4 {
                flex: 0 0 33.33% !important;
                max-width: 33.33% !important;
                text-align: left !important;
                margin-bottom: 0 !important;
                padding-right: 1rem;
                padding-left: 1rem;
            }
            /* --- iOS Safari Fixes --- */

            /* 1️⃣ Pastikan layout tidak terpotong oleh notch (safe area) */
            body {
                padding-top: env(safe-area-inset-top);
                padding-left: env(safe-area-inset-left);
                padding-right: env(safe-area-inset-right);
            }

            /* 2️⃣ Perbaiki scroll bouncing di iOS */
            html, body {
                -webkit-overflow-scrolling: touch;
                scroll-behavior: smooth;
            }

            /* 3️⃣ Perbaiki tampilan font & ukuran pada Safari */
            body, button, input, select, textarea {
                -webkit-text-size-adjust: 100%;
            }

            /* 4️⃣ Perbaiki bug border-radius dan shadow Safari */
            img, video {
                -webkit-mask-image: -webkit-radial-gradient(white, black);
            }

            /* 5️⃣ Perbaiki posisi hero image di Safari */
            .hero-section img {
                transform: translateZ(0);
                will-change: transform;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ff7b00;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">MESSARI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Tampilan Desktop -->
            <div class="collapse navbar-collapse d-none d-lg-flex" id="main-nav">
                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <a class="nav-link highlight-text" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('marketplace.index') }}" class="nav-link">MarketPlace</a>
                    </li>
                </ul>
                
                <div class="d-flex ms-auto">
                    @auth
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->profilePerusahaan->logo_perusahaan ? asset('storage/' . Auth::user()->profilePerusahaan->logo_perusahaan) : asset('images/default-company-profile.png') }}" 
                                     alt="Logo Perusahaan" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.profile.edit') : (Auth::user()->role === 'perusahaan' ? route('perusahaan.profile.edit') : route('admin.profile.edit')) }}">Profil Perusahaan</a></li>
                                <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">MASUK</a>
                        <a href="{{ route('home') }}" class="btn btn-dark me-2">PELAMAR</a>
                        <a href="{{ route('toko-umkm.index') }}" class="btn btn-dark">UMKM</a>
                    @endauth
                </div>
            </div>
    
            <!-- Tampilan Mobile (Offcanvas) -->
            <div class="offcanvas offcanvas-end text-bg-dark d-lg-none" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        <a class="nav-link text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                        </a>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') || Request::is('perusahaan') ? 'highlight-text' : '' }}" href="#">Beranda</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') || Request::is('perusahaan') ? 'highlight-text' : '' }}" href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.profile.edit') : (Auth::user()->role === 'perusahaan' ? route('perusahaan.profile.edit') : route('admin.profile.edit')) }}">Profile Perusahaan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('marketplace.index') }}" class="nav-link">MarketPlace</a>
                        </li>
                    </ul>
                    <div class="mt-auto">
                        <div class="d-grid gap-2">
                            <a href="{{ route('perusahaan.dashboard') }}" class="btn btn-light">Pengaturan</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Log Out</button>
                            </form>
                        </div>
                        @else
                    </div>
                    <div class="offcanvas-buttons mt-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">MASUK</a>
                        <a href="{{ route('home') }}" class="btn btn-dark">PELAMAR</a>
                        <a href="{{ route('toko-umkm.index') }}" class="btn btn-dark">UMKM</a>
                    </div>  
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main>
        {{-- Hero Section --}}
        @auth
            <div class="hero-section bg-orange text-white py-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
                            <h1 class="fw-bold mb-3">
                                REKRUT KANDIDAT <br>
                                YANG TEPAT UNTUK <br>
                                PERUSAHAAN ANDA
                            </h1>
                            <p class="text-light mb-2" style="font-size: 12px;">Dapatkan akses ke ribuan pelamar berkualitas yang siap bergabung dengan tim Anda.</p>
                            <div class="mt-1">
                            <a href="{{ route('perusahaan.kandidat-pelamar.index') }}" class="btn btn-navy">Dashboard Perusahaan</a>
                            </div>
                        </div>
                        <div class="col-md-6 text-center" data-aos="fade-left">
                            <img src="{{ asset('images/gambar1.png') }}" alt="We Are Hiring" class="img-fluid hero-img">
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="hero-section bg-orange text-white py-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
                            <h1 class="fw-bold mb-3">
                                REKRUT KANDIDAT <br>
                                YANG TEPAT UNTUK <br>
                                PERUSAHAAN ANDA
                            </h1>
                            <p class="text-light mb-2" style="font-size: 14px;">Daftarkan Perusahaan Anda Disini</p>
                            <div class="mt-3">
                                <a href="{{ route('login') }}" class="btn btn-outline-light me-3">MASUK</a>
                                <a href="{{ route('register') }}" class="btn btn-navy">DAFTAR</a>
                            </div>
                        </div>
                        <div class="col-md-6 text-center" data-aos="fade-left">
                            <img src="{{ asset('images/gambar1.png') }}" alt="We Are Hiring" class="img-fluid hero-img">
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    
        <div class="main-content">
            <div class="container" >
                <div class="info-section container py-5 bg-white text-center text-dark">
                    <h4 class="fw-bold mb-4" data-aos="zoom-in">Mencari kandidat untuk perusahaan anda menjadi<br>lebih mudah dan cepat</h4>
                    <div class="row justify-content-center align-items-center mb-5 g-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="col-md-4">
                            <h2 class="fw-bold text-primary">250+</h2>
                            <p class="fw-semibold">Perusahaan Terdaftar</p>
                            <p class="text-muted small">Lebih dari 250 perusahaan telah bergabung di platform kami.</p>
                        </div>
                        <div class="col-md-4">
                            <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; font-weight: bold;">1</div>
                            <p class="fw-semibold">Pilihan no.1 untuk pencari kerja</p>
                            <p class="text-muted small">Dikenal sebagai platform pilihan utama bagi para pencari kerja untuk menemukan peluang terbaik.</p>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-2">
                                <i class="fa-solid fa-hands-helping fa-2x text-warning"></i>
                            </div>
                            <p class="fw-semibold">Siap membantu</p>
                            <p class="text-muted small">Hubungi kontak tertera untuk mengajukan pertanyaan</p>
                        </div>
                    </div>
                    <hr class="my-4" style="border-color: #ccc;">
                    <h4 class="fw-bold mb-4"  data-aos="zoom-in" data-aos-delay="200">Mulai merekrut dengan 3 langkah mudah</h4>
                    <div class="row text-start steps-section justify-content-center g-4"  data-aos="zoom-in" data-aos-delay="400">
                        <div class="col-md-4">
                            <div class="p-4 bg-dark text-white rounded shadow h-100">
                                <div class="mb-2 rounded-circle bg-warning text-center text-dark fw-bold" style="width: 30px; height: 30px;">1</div>
                                <h6 class="fw-semibold mt-2">Daftar Online</h6>
                                <p class="text-light small">Buat dan verifikasi akun dengan alamat email Anda</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-dark text-white rounded shadow h-100">
                                <div class="mb-2 rounded-circle bg-warning text-center text-dark fw-bold" style="width: 30px; height: 30px;">2</div>
                                <h6 class="fw-semibold mt-2">Posting Lowongan</h6>
                                <p class="text-light small">Panduan lengkap kami akan membantu Anda membuat iklan lowongan kerja yang menarik</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-dark text-white rounded shadow h-100">
                                <div class="mb-2 rounded-circle bg-warning text-center text-dark fw-bold" style="width: 30px; height: 30px;">3</div>
                                <h6 class="fw-semibold mt-2">Sortir Ranking</h6>
                                <p class="text-light small">Fitur kami memudahkan Anda mengidentifikasi kandidat terbaik untuk lowongan kerja Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <section class="cta-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7" data-aos="fade-right">
                        <h2>Pasang iklan GRATIS, juga pilihan pro</h2>
                        <p>Dapatkan iklan lowongan dan temukan kandidat yang tepat di platform rekrutmen #1 di Indonesia.</p>
                        @auth
                            @if(Auth::user()->role === 'perusahaan')
                                <a href="/perusahaan/iklan/pasang-baru" class="btn btn-orange">Pasang Iklan</a>
                            @else
                                <a href="#" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Pasang Iklan</a>
                            @endif
                        @else
                            <a href="#" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Pasang Iklan</a>
                        @endauth
                    </div>
                    <div class="col-md-5 text-center" data-aos="fade-left">
                        <img src="{{ asset('images/iklan.png') }}" alt="Recruitment Illustration" class="img-fluid cta-img">
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <footer class="footer text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-4">SEGERA TEMUKAN <br>PEKERJAAN MU</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h6 class="fw-semibold">Tentang website</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Kontak Kami</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Bergabung Sebagai Konsultan</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="fw-semibold">Untuk Pencari Kerja</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none">Lowongan</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Pameran Lowongan</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Pameran Lowongan Disabilitas</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Rekomendasi Lowongan</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">FAQ untuk Pencari Kerja</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="fw-semibold">Untuk Perusahaan</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none">Daftar Gratis</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Pasang Iklan Lowongan</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Produk & Harga</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="me-3 text-white-50">Ikuti kami:</span>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('images/footer.png') }}" alt="Karakter" class="img-fluid" style="max-height: 300px;">
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-4 border-bottom-0">
                    <i class="bi bi-lock-fill"></i>
                    <h5 class="modal-title fw-bold text-center w-100" id="loginRequiredModalLabel">Akses Aktivitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <p class="text-center mb-0">Silakan masuk atau daftar akun terlebih dahulu untuk melihat aktivitas.</p>
                </div>
                <div class="modal-footer flex-column border-top-0 p-4 gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary-custom d-flex align-items-center justify-content-center gap-2 w-100 fw-semibold">
                        <i class="bi bi-arrow-right"></i> Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary-custom w-100 fw-semibold">Daftar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>
</html>