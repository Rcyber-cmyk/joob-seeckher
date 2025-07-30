<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messari - Portal Kerja</title>

    <!-- Bootstrap & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Style Global dan Responsif -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #ff7a00; /* Warna background utama halaman perusahaan (orange) */
            color: white;
            overflow-x: hidden; /* Mencegah scroll horizontal */
        }

        /* --- Navbar Styles --- */
        .navbar {
            padding: 1rem 0;
            z-index: 1000;
            position: relative;
            background-color: #ff7b00; /* Latar belakang navbar desktop adalah Biru Navy */
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: white; /* Warna brand putih */
        }
        /* Link navigasi utama di desktop */
        .navbar-nav .nav-link {
            margin-right: 1rem;
            color: white; /* Warna link default putih */
        }
        .navbar-nav .nav-link:hover {
            color: #ff7b00; /* Efek hover untuk link oranye */
        }
        .navbar-nav .highlight-text {
            color: #FFFFFFFF !important; /* Warna highlight oranye */
            font-weight: bold;
        }

        /* Global Button Styles */
        .btn-navy {
            background-color: #001f3f; /* Biru Navy */
            color: white;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .btn-navy:hover {
            background-color: #001737; /* Biru Navy lebih gelap saat hover */
            color: white;
        }
        .btn-outline-light {
            padding: 0.6rem 1.5rem;
            border-color: white;
            color: white;
        }
        .btn-outline-light:hover {
            background-color: white;
            color: #ff7a00; /* Teks orange saat hover */
        }
        /* Tombol orange untuk konsistensi jika dibutuhkan di halaman perusahaan */
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
        /* Tombol dark, khusus untuk offcanvas "Untuk Pelamar" */
        .btn-dark {
            background-color: #212529; /* Warna dark Bootstrap */
            color: white;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .btn-dark:hover {
            background-color: #343a40; /* Darker on hover */
            color: white;
        }


        /* Gaya untuk Offcanvas Navbar (menu slide dari samping) */
        /* Menggunakan ID untuk spesifisitas yang lebih tinggi */
        #offcanvasNavbar.offcanvas {
            background-color: #ff7a00 !important; /* Background utama offcanvas */
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
            color: white !important; /* Warna teks default offcanvas putih */
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
        }
        /* Link di dalam offcanvas */
        #offcanvasNavbar .offcanvas-body .navbar-nav {
            width: 100%;
            margin-left: 0;
            flex-grow: 1;
        }
        #offcanvasNavbar .offcanvas-body .navbar-nav .nav-item {
            width: 100%;
            text-align: left;
            margin-bottom: 0.5rem;
        }
        #offcanvasNavbar .offcanvas-body .navbar-nav .nav-link {
            padding: 0.75rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            color: white !important; /* Link di offcanvas harus putih */
        }
        #offcanvasNavbar .offcanvas-body .navbar-nav .nav-link:hover {
            background-color: rgba(0,0,0,0.1); /* Efek hover gelap transparan pada background oranye */
        }
        /* Memastikan highlight-text juga terlihat di offcanvas */
        #offcanvasNavbar .offcanvas-body .navbar-nav .nav-link.highlight-text {
            color: white !important; /* Tetap putih agar terlihat di offcanvas oranye */
            font-weight: bold;
        }


        /* Tombol di dalam offcanvas (untuk mobile only) */
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
        /* Gaya spesifik untuk tombol di offcanvas */
        #offcanvasNavbar .offcanvas-buttons .btn-outline-light {
            border-color: white !important;
            color: white !important;
            background-color: transparent !important;
        }
        #offcanvasNavbar .offcanvas-buttons .btn-outline-light:hover {
            background-color: white !important;
            color: #ff7a00 !important;
        }
        #offcanvasNavbar .offcanvas-buttons .btn-dark {
            background-color: #001f3f !important; /* Warna biru navy untuk tombol dark di offcanvas */
            color: white !important;
            border: none !important;
        }
        #offcanvasNavbar .offcanvas-buttons .btn-dark:hover {
            background-color: #001737 !important;
        }


        /* Penyesuaian Navbar untuk Tablet dan Mobile */
        @media (max-width: 991.98px) {
            .navbar .ms-auto { /* Tombol Masuk/Untuk Perusahaan di desktop */
                display: none !important; /* Sembunyikan di mobile */
            }
        }


        /* --- Hero Section --- */
        .hero-section {
            min-height: 100vh; /* Full viewport height */
            display: flex;
            align-items: center; /* Vertikal tengah */
            padding: 4rem 0; /* Padding default */
            background-color: #ff7a00; /* Background hero orange */
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.3;
        }
        .hero-section p {
            font-size: 1.2rem;
        }
        .hero-img {
            max-width: 350px; /* Ukuran gambar hero */
            height: auto;
            filter: drop-shadow(0 0 15px rgba(0,0,0,0.3)); /* Bayangan gambar */
        }
        /* Penyesuaian Hero Section untuk Mobile */
        @media (max-width: 767.98px) {
            .hero-section {
                min-height: 100vh; /* Pastikan tinggi penuh untuk centering vertikal */
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
                flex: 0 0 50% !important; /* Memaksa lebar 50% */
                max-width: 50% !important;
                text-align: left !important; /* Teks rata kiri */
                display: flex;
                flex-direction: column;
                align-items: flex-start !important; /* Elemen di dalam kolom (h1, p, div tombol) rata kiri */
                justify-content: center;
                /* Hapus margin-bottom dari sini karena flex-wrap: nowrap */
                margin-bottom: 0 !important;
            }

            /* Gaya untuk kolom gambar (kolom kedua) */
            .hero-section .col-md-6.text-center {
                flex: 0 0 50% !important; /* Memaksa lebar 50% */
                max-width: 50% !important;
                text-align: center !important; /* Pusatkan gambar */
                display: flex; /* Gunakan flexbox untuk kolom gambar */
                flex-direction: column;
                align-items: center !important; /* Pusatkan gambar secara horizontal menggunakan flexbox */
                justify-content: center;
                margin-top: 0 !important; /* Hapus margin atas yang mungkin ditambahkan sebelumnya */
                /* Hapus margin-bottom dari sini karena flex-wrap: nowrap */
                margin-bottom: 0 !important;
            }

            .hero-section h1 {
                font-size: 1.3rem;
            }
            .hero-section p {
                font-size: 1rem;
            }
            .hero-img {
                max-width: 250px;
            }
            .hero-section .mt-3 { /* Div yang berisi tombol-tombol */
                display: flex;
                flex-direction: row !important; /* Susun tombol secara horizontal */
                gap: 1rem !important; /* Jarak antar tombol */
                width: auto !important; /* Tombol kontainer mengambil lebar sesuai konten */
                align-items: flex-start !important; /* Rata kiri tombol */
            }
            .hero-section .mt-3 .btn {
                width: auto !important; /* Tombol mengambil lebar sesuai kontennya */
                margin: 0 !important; /* Hapus margin yang mengganggu */
            }
        }


        /* --- Main Content Wrapper (Container putih utama) --- */
        .main-content {
            background: white;
            color: black;
            padding-top: 4rem;
            padding-bottom: 4rem;
        }
        /* Judul Seksi Umum dalam main-content */
        .main-content h4 {
            color: #ff7b00;
            font-weight: bold;
        }
        .main-content h4 img {
            vertical-align: middle;
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

        /* --- BAGIAN INFO ATAS (di dalam main-content) --- */
        .info-section h2 {
            color: #ff7b00;
        }
        .info-section p.fw-semibold {
            color: #22374e;
        }
        .info-section .rounded-circle {
            background-color: #ff7b00 !important;
            color: white !important;
        }
        .info-section .fa-hands-helping {
            color: #ff7b00 !important;
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

        /* --- BAGIAN LANGKAH-LANGKAH REKRUTMEN (di dalam main-content) --- */
        .steps-section .p-4 {
            background-color: #22374e !important;
            color: white !important;
        }
        .steps-section .rounded-circle {
            background-color: #ff7b00 !important;
            color: #22374e !important;
        }
        .steps-section h6 {
            color: white !important;
        }
        .steps-section p {
            color: rgba(255,255,255,0.7) !important;
        }
        /* Penyesuaian Langkah-langkah untuk Mobile */
        @media (max-width: 767.98px) {
            .steps-section .row {
                flex-wrap: nowrap !important; /* Mencegah penumpukan kolom */
                overflow-x: auto; /* Memungkinkan scroll horizontal jika konten terlalu lebar */
                justify-content: flex-start !important; /* Mulai dari kiri */
            }
            .steps-section .col-md-4 { /* Target kolom asli */
                flex: 0 0 33.33% !important; /* Memaksa lebar 33.33% */
                max-width: 33.33% !important;
            }
            .steps-section .col-md-4 .p-4 {
                text-align: left; /* Pastikan teks di dalam kartu tetap rata kiri */
            }
        }

        /* --- BAGIAN CTA - Pasang Iklan GRATIS --- */
        .cta-section {
            background-color: #FFFFFFFF; /* Biru Navy */
            color: white;
            padding: 4rem 0;
            text-align: left;
        }
        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: bold;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: #000000ff;
        }
        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #000000ff;
        }
        .cta-section .cta-img {
            max-width: 400px;
            height: auto;
            filter: drop-shadow(0 0 20px rgba(0,0,0,0.5));
        }
/* CTA Section Mobile */
            .cta-section {
                padding: 2rem 0;
                /* text-align: center; Dihapus karena akan rata kiri secara default flex */
            }
            .cta-section .row {
                flex-direction: row; /* Kembali ke horizontal */
                flex-wrap: nowrap !important; /* Jangan menumpuk */
                 /* Aktifkan scroll horizontal jika perlu */
                justify-content: flex-start; /* Konten mulai dari kiri */
                align-items: center; /* Vertikal tengah */
            }
            .cta-section .col-md-7 { /* Kolom teks */
                flex: 0 0 60% !important; /* 60% lebar */
                max-width: 60% !important;
                padding-right: 1rem; /* Tambah padding agar tidak terlalu mepet dengan gambar */
                text-align: left; /* Pastikan rata kiri */
            }
            .cta-section .col-md-5 { /* Kolom gambar */
                flex: 0 0 40% !important; /* 40% lebar */
                max-width: 40% !important;
            }
            .cta-section h2 {
                font-size: 1.8rem; /* Lebih kecil dari 2rem */
                margin-top: 0; /* Hapus margin atas yang ada dari column-reverse */
            }
            .cta-section p {
                font-size: 0.9rem; /* Lebih kecil dari 1rem */
            }
            .cta-section .btn { /* Untuk tombol di CTA section */
                font-size: 0.8rem; /* Lebih kecil */
                padding: 0.4rem 0.8rem; /* Padding lebih kecil */
            }
            .cta-section .cta-img {
                max-width: 200px; /* Lebih kecil lagi */
                margin-bottom: 0;
                margin-left: auto; /* Untuk memusatkan jika ada sisa ruang */
                margin-right: auto;
            }    
        /* --- Footer --- */
        footer.footer {
            background-color: #071b2f;
            color: white;
            width: 100%;
            padding: 4rem 0;
        }

        footer.footer ul {
            list-style-type: none;
            padding-left: 0;
        }

        footer.footer .text-white-50 {
            color: rgba(255, 255, 255, 0.5);
        }
        footer.footer a {
            color: #ff7b00;
            text-decoration: none;
            transition: text-decoration 0.3s ease;
        }
        footer.footer a:hover {
            text-decoration: underline;
        }
        footer.footer .col-lg-4 img {
            max-height: 300px;
            object-fit: contain;
            filter: drop-shadow(0 0 10px rgba(0,0,0,0.3));
        }
        /* Penyesuaian Footer untuk Mobile */
        @media (max-width: 991.98px) {
            /* Main footer row */
            footer.footer .row.align-items-center {
                flex-wrap: nowrap !important; /* Mencegah penumpukan kolom utama */
                overflow-x: auto; /* Memungkinkan scroll horizontal */
                justify-content: flex-start !important; /* Mulai dari kiri */
                padding-bottom: 2rem; /* Tambahkan padding bawah untuk memisahkan dari konten di bawahnya jika ada */
            }
            footer.footer .col-lg-8,
            footer.footer .col-lg-4 {
                flex: 0 0 auto !important; /* Biarkan konten menentukan lebar */
                max-width: none !important; /* Hapus batasan lebar */
                width: auto !important; /* Biarkan lebar ditentukan secara otomatis */
                text-align: left !important; /* Rata kiri teks di kolom utama footer */
                margin-bottom: 0 !important; /* Hapus margin vertikal dari penumpukan */
                padding-right: 1rem; /* Tambahkan jarak antar kolom utama */
                padding-left: 1rem;
            }
            footer.footer .col-lg-4 img {
                margin-left: 2rem; /* Tambahkan jarak untuk gambar */
            }

            /* Nested row inside col-lg-8 */
            footer.footer .col-lg-8 .row {
                flex-wrap: nowrap !important; /* Mencegah penumpukan kolom bersarang */
                overflow-x: auto; /* Memungkinkan scroll horizontal */
                justify-content: flex-start !important; /* Mulai dari kiri */
            }
            footer.footer .col-lg-8 .col-md-4 {
                flex: 0 0 33.33% !important; /* Paksa lebar 33.33% */
                max-width: 33.33% !important;
                text-align: left !important; /* Rata kiri teks di kolom bersarang */
                margin-bottom: 0 !important; /* Hapus margin vertikal dari penumpukan */
                padding-right: 1rem; /* Tambahkan jarak antar kolom bersarang */
                padding-left: 1rem;
            }
        }
        
        /* Modal Peringatan Login (Desain Baru) */
        #loginRequiredModal .modal-content {
            background-color: #ffffff;
            color: #212529;
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        #loginRequiredModal .modal-header {
            border-bottom: none;
            padding: 2rem 2rem 0rem 2rem;
            flex-direction: column;
            align-items: center;
        }

        #loginRequiredModal .modal-header .modal-logo {
            display: none;
        }

        #loginRequiredModal .modal-header i.bi-lock-fill {
            font-size: 3rem;
            color: #ff7b00;
            margin-bottom: 1rem;
        }

        #loginRequiredModal .modal-title {
            color: #212529 !important;
            font-weight: bold;
            font-size: 1.8rem;
            text-align: center;
            width: 100%;
        }

        #loginRequiredModal .btn-close {
            filter: none;
            position: absolute;
            top: 15px;
            right: 15px;
        }

        #loginRequiredModal .modal-body {
            color: #495057 !important;
            padding: 1rem 2rem 1.5rem 2rem;
            font-size: 1.05rem;
            text-align: center;
        }

        #loginRequiredModal .modal-footer {
            border-top: none;
            padding: 0rem 2rem 2rem 2rem;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
        }

        #loginRequiredModal .modal-footer .btn {
            width: 100%;
            max-width: 250px;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
        }

        #loginRequiredModal .modal-footer .btn-primary-custom {
            background-color: #ff7b00;
            border-color: #ff7b00;
            color: white;
        }
        #loginRequiredModal .modal-footer .btn-primary-custom:hover {
            background-color: #ff8c1a;
            border-color: #ff8c1a;
            color: white;
        }

        #loginRequiredModal .modal-footer .btn-outline-primary-custom {
            background-color: transparent;
            border-color: #ff7b00;
            color: #ff7b00;
        }
        #loginRequiredModal .modal-footer .btn-outline-primary-custom:hover {
            background-color: #ff7b00;
            border-color: #ff7b00;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">MESSARI</a>
            <!-- Navbar Toggler (for mobile, will open offcanvas) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas (This is the mobile menu, hidden on desktop) -->
            <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MESSARI Menu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Nav Links for Offcanvas -->
                    <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('perusahaan') ? 'highlight-text' : '' }}" href="#">Home</a>
                        </li>
                    </ul>
                    <!-- Buttons for Offcanvas -->
                    <div class="offcanvas-buttons mt-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">MASUK</a>
                        <a href="{{ route('home') }}" class="btn btn-dark">Untuk Pelamar</a>
                    </div>
                </div>
            </div>

            <!-- Navbar Collapse (This is the desktop menu, hidden on mobile) -->
            <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarNav">
                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('perusahaan') ? 'highlight-text' : '' }}" href="#">Home</a>
                    </li>
                </ul>
                <div class="ms-auto">
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">MASUK</a>
                    <a href="{{ route('home') }}" class="btn btn-dark">Untuk Pelamar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section bg-orange text-white py-5">
        <div class="container">
            <!-- Menghapus align-items-center dari row untuk kontrol yang lebih baik di mobile -->
            <div class="row">
                <!-- Kiri: Teks -->
                <div class="col-md-6 mb-4 mb-md-0">
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

                <!-- Kanan: Gambar -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/gambar1.png') }}" alt="We Are Hiring" class="img-fluid hero-img">
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Putih / Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Bagian Info Atas -->
            <div class="info-section container py-5 bg-white text-center text-dark">
                <h4 class="fw-bold mb-4">Mencari kandidat untuk perusahaan anda menjadi<br>lebih mudah dan cepat</h4>
                <!-- Menambahkan g-4 untuk jarak antar kolom dan baris -->
                <div class="row justify-content-center align-items-center mb-5 g-4">
                    <div class="col-md-4">
                        <h2 class="fw-bold text-primary">250+</h2>
                        <p class="fw-semibold">Perusahaan Terdaftar</p>
                        <p class="text-muted small">Lebih dari 250 perusahaan yang terdaftar disini</p>
                    </div>
                    <div class="col-md-4">
                        <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; font-weight: bold;">1</div>
                        <p class="fw-semibold">Pilihan no.1 untuk pencari kerja</p>
                        <p class="text-muted small">Lebih dari 250 perusahaan yang terdaftar disini</p>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <i class="fa-solid fa-hands-helping fa-2x text-warning"></i>
                        </div>
                        <p class="fw-semibold">Siap membantu</p>
                        <p class="text-muted small">Hubungi kontak tertera untuk mengajukan pertanyaan</p>
                    </div>
                </div>

                <!-- Garis pemisah -->
                <hr class="my-4" style="border-color: #ccc;">

                <!-- Langkah-langkah Rekrutmen -->
                <h4 class="fw-bold mb-4">Mulai merekrut dengan 3 langkah mudah</h4>
                <div class="row text-start steps-section justify-content-center g-4">
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
                    <div class="col-md-7">
                        <h2>Pasang iklan GRATIS, juga pilihan pro</h2>
                        <p>Dapatkan iklan lowongan dan temukan kandidat yang tepat di platform rekrutmen #1 di Indonesia.</p>
                        @auth
                            @if(Auth::user()->role === 'perusahaan')
                                <a href="{{ route('perusahaan.dashboard') }}" class="btn btn-orange">Kelola Lowongan</a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-orange">Daftar sebagai Perusahaan</a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn btn-orange">Daftar sebagai Perusahaan</a>
                        @endauth
                    </div>
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('images/iklan.png') }}" alt="Recruitment Illustration" class="img-fluid cta-img">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer text-white">
        <div class="container">
            <!-- Menambahkan kelas kustom untuk baris utama footer -->
            <div class="row align-items-center">
                <!-- Kiri -->
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

                <!-- Kanan -->
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('images/footer.png') }}" alt="Karakter" class="img-fluid" style="max-height: 300px;">
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Peringatan Login (Desain Baru) -->
    <div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-4 border-bottom-0">
                    <!-- Ikon Kunci -->
                    <i class="bi bi-lock-fill"></i>
                    <h5 class="modal-title fw-bold text-center w-100" id="loginRequiredModalLabel">Akses Aktivitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <p class="text-center mb-0">Silakan masuk atau daftar akun terlebih dahulu untuk melihat aktivitas.</p>
                </div>
                <div class="modal-footer flex-column border-top-0 p-4 gap-2">
                    <!-- Tombol Masuk -->
                    <a href="{{ route('login') }}" class="btn btn-primary-custom d-flex align-items-center justify-content-center gap-2 w-100 fw-semibold">
                        <i class="bi bi-arrow-right"></i> Masuk
                    </a>
                    <!-- Tombol Daftar -->
                    <a href="{{ route('register') }}" class="btn btn-outline-primary-custom w-100 fw-semibold">Daftar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan Font Awesome -->
    <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
