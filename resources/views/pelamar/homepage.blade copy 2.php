<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messari - Portal Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <style>
    /* === Global & Reset === */
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f9;
        color: #495057;
        overflow-x: hidden;
        line-height: 1.6;
    }
    a {
        color: #F39C12;
        text-decoration: none;
    }
    a:hover {
        color: #0a58ca;
        text-decoration: underline;
    }
    .btn-orange { 
        background-color: #F39C12; border-color: #F39C12; color: #fff;
        padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 500; transition: all 0.3s;
    }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; transform: translateY(-2px); }

    /* === Navbar (Tetap Sama) === */
    .navbar { padding: 1rem 0; z-index: 1050 !important; position: relative; background-color: #22374e; color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .navbar-brand { font-weight: bold; font-size: 1.5rem; letter-spacing: 2px; color: white; }
    .navbar-nav .nav-link { margin-right: 1rem; color: rgba(255, 255, 255, 0.8); }
    .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: #ffffff; }
    .dropdown-menu { z-index: 1051 !important; }

    /* === Hero Section (Tema Korporat) === */
    .hero-section {
        background-color: #ffffff;
        color: #343a40;
        padding: 6rem 0;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
        /* Tambahan untuk background */
        position: relative;
        background-size: cover;
        background-position: center;
        z-index: 1;
    }
    /* (CSS BARU) Overlay tipis agar teks gelap tetap terbaca */
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        /* Anda bisa pilih: overlay gelap (ganti teks jadi putih) atau overlay terang (biarkan teks gelap) */
        /* Pilihan 1: Overlay Terang (agar teks gelap & gambar kartun tetap terlihat) */
        background-color: rgba(255, 255, 255, 0.85); /* 85% putih */
        
        /* Pilihan 2: Overlay Gelap (teks harus diubah jadi putih) */
        /* background-color: rgba(0, 0, 0, 0.5); */ /* 50% hitam */
        
        z-index: -1; /* Letakkan di belakang konten */
    }
    /* (CSS BARU) Konten hero di atas overlay */
    .hero-section .container {
        position: relative;
        z-index: 2;
    }

    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 1rem;
        color: #22374e; /* Teks tetap gelap (karena overlay terang) */
    }
    .hero-section p.lead {
        font-size: 1.2rem;
        color: #6c757d;
        margin-bottom: 2rem;
        max-width: 500px;
    }
    .hero-img {
        max-height: 400px;
    }
    /* Tombol Hero */
    .hero-section .btn-orange { }
    .hero-section .btn-outline-secondary { 
        padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 500; transition: all 0.3s;
        border-color: #6c757d; color: #6c757d; border-width: 1px;
    }
    .hero-section .btn-outline-secondary:hover { background-color: #6c757d; color: white; transform: translateY(-2px); }
    
    /* --- Responsif Hero --- */
    @media (max-width: 767.98px) {
        .hero-section { padding: 4rem 1rem; }
        .hero-section h1 { font-size: 2.2rem; }
        .hero-section p.lead { font-size: 1rem; }
        .hero-img { max-width: 250px; margin-top: 2rem; }
        .hero-section .mt-3 { justify-content: center; }
        .hero-section .btn { padding: 0.7rem 1.4rem; font-size: 0.9rem; }
    }

    /* === Carousel Berita (TETAP SAMA) === */
    #beritaTerkiniLandingPage {
        position: relative;
        height: 55vh; 
        min-height: 450px; 
        background-color: #e9ecef; 
        color: #343a40;
        overflow: hidden;
    }
    #beritaTerkiniLandingPage .carousel-inner {
         height: 100%;
    }
    #beritaTerkiniLandingPage .carousel-item {
        height: 100%;
        background-color: #E0F2F7; 
        display: flex;
        flex-direction: column;
        align-items: center; 
        justify-content: center; 
        padding: 2rem;
        text-align: center;
    }
    #beritaTerkiniLandingPage .carousel-item img {
        width: auto; 
        max-width: 90%; 
        height: auto; 
        max-height: 60%; 
        object-fit: contain; 
        display: block;
        margin-left: auto; 
        margin-right: auto; 
        margin-bottom: 1rem; 
    }

    #beritaTerkiniLandingPage .berita-content-landing {
        text-align: center;
        max-width: 90%; 
        margin: 0 auto; 
        color: #343a40;
    }
     #beritaTerkiniLandingPage .berita-content-landing h2 {
        color: #22374e;
        font-size: 1.8rem;
        font-weight: 600;
        text-shadow: none;
        margin-bottom: 0.5rem;
    }
    #beritaTerkiniLandingPage .berita-content-landing p {
        color: #495057;
        font-size: 1rem;
        text-shadow: none;
        margin-bottom: 1rem;
    }
    #beritaTerkiniLandingPage .berita-content-landing .btn-berita-landing {
        background-color: transparent; color: #22374e;
        border: 2px solid #22374e; padding: 0.5rem 1.2rem;
        border-radius: 6px;
        font-size: 0.85rem; font-weight: 500; transition: all 0.3s;
        text-decoration: none; box-shadow: none;
        display: inline-block; 
    }
    #beritaTerkiniLandingPage .berita-content-landing .btn-berita-landing:hover {
        background-color: #22374e; color: white;
    }
     #beritaTerkiniLandingPage .carousel-indicators { z-index: 5; }
    #beritaTerkiniLandingPage .carousel-indicators button { background-color: rgba(0,0,0,0.2); }
    #beritaTerkiniLandingPage .carousel-indicators .active { background-color: #22374e; }
    #beritaTerkiniLandingPage .carousel-control-prev, #beritaTerkiniLandingPage .carousel-control-next { z-index: 5; }
    #beritaTerkiniLandingPage .carousel-control-prev-icon,
    #beritaTerkiniLandingPage .carousel-control-next-icon {
        filter: invert(20%) sepia(20%) saturate(1000%) hue-rotate(180deg) brightness(80%) contrast(90%);
        background-color: transparent; border-radius: 0; padding: 0; box-shadow: none;
    }

    /* === Main Content (Area Putih/Abu Sangat Muda) === */
    .main-content {
        background: #ffffff;
        color: #343a40;
        padding: 4rem 0;
        position: relative;
    }
    .main-content .section-title {
        font-weight: 600;
        font-size: 1.8rem;
        color: #22374e;
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
        padding-bottom: 0.8rem;
    }
    .main-content .section-title::after {
        content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);
        width: 70px; height: 3px; background-color: #22374e; border-radius: 2px;
    }

    /* === Iklan Gratis (Menggantikan Perusahaan Partner) === */
    .section-perusahaan-partner .card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        height: 100%; overflow: hidden; background-color: white;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .section-perusahaan-partner .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    }
    .section-perusahaan-partner .card .card-img-top { height: 160px; object-fit: cover; border-bottom: 1px solid #dee2e6; }
    .section-perusahaan-partner .card-body { color: #343a40; padding: 1rem; }
    .section-perusahaan-partner .card-body h6 { color: #22374e; font-weight: 600; margin-bottom: 0.3rem; font-size: 1rem; }
    .section-perusahaan-partner .card-body p { color: #6c757d; font-size: 0.85rem; }
    .section-perusahaan-partner a.text-decoration-none:hover h6 { color: #F39C12; }
    .section-perusahaan-partner + .text-end a {
        color: #F39C12; font-weight: 500;
    }

    /* === Rekomendasi Pekerjaan (Slider) === */
    .section-rekomendasi { padding: 3rem 0 4rem; }
    .job-listing-card, .job-listing-card-premium {
        border: 1px solid #dee2e6; border-radius: 8px; padding: 1.25rem;
        height: 100%; display: flex; flex-direction: column;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        background-color: #fff;
    }
    .job-listing-card:hover, .job-listing-card-premium:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        transform: translateY(-4px);
    }
    .job-listing-card .company-logo, .job-listing-card-premium .company-logo { width: 40px; height: 40px; margin-right: 0.8rem; border-radius: 6px; }
    .job-listing-card .company-details h6, .job-listing-card-premium .company-details h6 { font-size: 0.95rem; font-weight: 600; color: #22374e; }
    .job-listing-card .company-details p, .job-listing-card-premium .company-details p { font-size: 0.8rem; color: #6c757d; }
    .job-listing-card .location, .job-listing-card-premium .location { font-size: 0.8rem; margin-bottom: 0.8rem; }
    .job-listing-card .location i, .job-listing-card-premium .location i { color: #6c757d; }
    .job-listing-card .description, .job-listing-card-premium .description { font-size: 0.85rem; color: #495057; margin-bottom: 1rem; }
    .job-listing-card .btn-lihat-detail, .job-listing-card-premium .btn-lihat-detail {
        background-color: transparent; color: #F39C12;
        border: 1px solid #F39C12; padding: 0.4rem 0.8rem; border-radius: 6px;
        font-size: 0.8rem; font-weight: 500; margin-top: auto;
    }
    .job-listing-card .btn-lihat-detail:hover, .job-listing-card-premium .btn-lihat-detail:hover {
        background-color: #F39C12; color: white;
    }

    /* --- Card Premium (Korporat) --- */
    .job-listing-card-premium {
        border: 1px solid #FFEBCD; 
        border-left: 5px solid #F39C12; 
        background-color: #FFFBF5; 
        box-shadow: 0 6px 20px rgba(243, 156, 18, 0.15); 
        position: relative; 
    }
    .job-listing-card-premium .company-details h6 {
        color: #B9770E; 
        font-weight: 700; 
    }
    .job-listing-card-premium .btn-lihat-detail {
        background-color: #F39C12; 
        color: white;
        border: none;
    }
     .job-listing-card-premium .btn-lihat-detail:hover {
        background-color: #d8890b; 
        color: white;
    }
    /* Style untuk Badge Premium */
    .premium-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #F39C12;
        color: white;
        font-size: 0.7rem;
        font-weight: bold;
        padding: 3px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .premium-badge i {
        font-size: 0.6rem; 
        margin-right: 3px;
    }

    /* --- Swiper Slider (Korporat) --- */
    .job-swiper-container { padding-bottom: 40px; }
    .swiper-slide { height: auto; }
    .swiper-button-next, .swiper-button-prev {
        color: #6c757d; 
        background: none; border-radius: 0; width: auto; height: auto; box-shadow: none;
    }
    .swiper-button-next:hover, .swiper-button-prev:hover { background: none; }
    .swiper-button-next::after, .swiper-button-prev::after { font-size: 1.5rem; }
    .swiper-button-prev { left: -10px; } 
    .swiper-button-next { right: -10px; }

    /* === Modal Login (Korporat) === */
    #loginRequiredModal .modal-content { border-radius: 8px; } 
    #loginRequiredModal .modal-header i.bi-lock-fill { color: #F39C12; } 
    #loginRequiredModal .modal-title { font-size: 1.4rem; color: #22374e !important; }
    #loginRequiredModal .modal-body { font-size: 0.95rem; }
    #loginRequiredModal .modal-footer .btn { font-size: 0.9rem; border-radius: 6px; }
    #loginRequiredModal .modal-footer .btn-primary-custom { 
        background-color: #F39C12; border-color: #F39C12;
    }
    #loginRequiredModal .modal-footer .btn-primary-custom:hover { background-color: #0b5ed7; border-color: #0a58ca; }
    #loginRequiredModal .modal-footer .btn-outline-primary-custom {
        border-color: #F39C12; color: #F39C12;
    }
    #loginRequiredModal .modal-footer .btn-outline-primary-custom:hover { background-color: #F39C12; color: white; }
    footer.footer { 
        background-color: #071b2f; 
        color: white; 
        width: 100%; 
        padding: 4rem 0; 
        flex-shrink: 0;
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

    </style>
</head>
<body>
    @include('pelamar.partials.navbar')

    {{-- ========================================================== --}}
    {{-- 1. MODIFIKASI HERO SECTION (MENJADI DINAMIS)           --}}
    {{-- ========================================================== --}}
    
    @php
        // Tentukan class dan style berdasarkan $iklanHero
        $heroClass = 'hero-section';
        $heroStyle = '';
        // Cek jika $iklanHero ada DAN punya banner
        if (isset($iklanHero) && $iklanHero && $iklanHero->file_iklan_banner) {
            $heroStyle = "background-image: url('" . asset('storage/' . $iklanHero->file_iklan_banner) . "');";
        }
    @endphp
    
    {{-- Terapkan class dan style dinamis ke hero-section --}}
    <div class="{{ $heroClass }}" style="{{ $heroStyle }}">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h1>TEMPAT SOLUSI <br> ANDA MENCARI KERJA <br> DISINI</h1>
                    <div class="mt-3">
                        @auth
                            {{-- Link kosong dari kode asli Anda --}}
                            <a href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.dashboard') : (Auth::user()->role === 'perusahaan' ? route('perusahaan.dashboard') : route('admin.dashboard')) }}"></a>
                        @else
                            {{-- TOMBOL "MASUK" DIPERBAIKI agar terlihat --}}
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary me-3">MASUK</a>
                            <a href="{{ route('register') }}" class="btn btn-orange">DAFTAR</a>
                        @endauth
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    {{-- Gambar kartun orang ramai TETAP ADA --}}
                    <img src="{{ asset('images/gambar1.png') }}" alt="Sekelompok Profesional" class="img-fluid hero-img">
                </div>
            </div>  
        </div>
    </div>
    {{-- ========================================================== --}}
    {{-- AKHIR DARI MODIFIKASI HERO SECTION                       --}}
    {{-- ========================================================== --}}


    {{-- Ini adalah CAROUSEL BERITA (bukan iklan) --}}
    <div id="beritaTerkiniLandingPage" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner h-100">
            @forelse ($beritaTerkini as $berita)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('images/default-news.png') }}" alt="{{ $berita->judul }}">
                    <div class="berita-content-landing">
                        <h2>{{ $berita->judul }}</h2>
                        <p>{{ $berita->kutipan }}</p>
                        @auth
                            <a href="{{ route('berita.show', $berita->slug) }}" class="btn-berita-landing">Cari Tau Selengkapnya</a>
                        @else
                            <a href="#" class="btn-berita-landing" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Cari Tau Selengkapnya</a>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="carousel-item active">
                     <div class="berita-content-landing d-flex justify-content-center align-items-center h-100">
                         <p class="text-muted">Belum ada berita terkini.</p>
                     </div>
                </div>
            @endforelse
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#beritaTerkiniLandingPage" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
        <button class="carousel-control-next" type="button" data-bs-target="#beritaTerkiniLandingPage" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
        <div class="carousel-indicators">
            @foreach ($beritaTerkini as $index => $berita)
                <button type="button" data-bs-target="#beritaTerkiniLandingPage" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
            @if($beritaTerkini->isEmpty())
                <button type="button" data-bs-target="#beritaTerkiniLandingPage" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            @endif
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            
            {{-- ========================================================== --}}
            {{-- 2. MODIFIKASI BAGIAN IKLAN GRATIS                      --}}
            {{-- ========================================================== --}}
            <h4 class="fw-bold mb-4 mt-5 d-flex align-items-center">Iklan Partner</h4>
            <div class="row g-4 section-perusahaan-partner">
                
                {{-- Loop ini sekarang menggunakan $iklanGratis --}}
                @forelse($iklanGratis as $iklan)
                    <div class="col-md-4 col-sm-6"> {{-- Dibuat 3 kolom --}}
                        
                        @php
                            $searchUrl = route('lowongan.index', ['search' => $iklan->perusahaan->nama_perusahaan ?? '']);
                        @endphp

                        <a href="{{ Auth::check() ? $searchUrl : '#' }}" 
                           class="text-decoration-none"
                           @guest data-bs-toggle="modal" data-bs-target="#loginRequiredModal" @endguest>
                        
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                {{-- Tampilkan banner iklan gratis --}}
                                <img src="{{ $iklan->file_iklan_banner ? asset('storage/' . $iklan->file_iklan_banner) : asset('images/default-logo.png') }}" 
                                     class="card-img-top" alt="Banner {{ $iklan->judul }}" style="height: 160px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="fw-bold">{{ $iklan->judul }}</h6>
                                    <p class="mb-0 text-muted small">{{ $iklan->perusahaan->nama_perusahaan ?? 'Perusahaan' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    {{-- Tampilan jika tidak ada iklan gratis --}}
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada iklan partner yang tayang saat ini.</p>
                    </div>
                @endforelse

            </div>
            <div class="text-end mt-4">
                @auth
                    <a href="{{ route('lowongan.index') }}" class="text-dark fw-semibold text-decoration-none">LIHAT SELENGKAPNYA →</a>
                @else
                    <a href="#" class="text-dark fw-semibold text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">LIHAT SELENGKAPNYA →</a>
                @endauth
            </div>
            
            {{-- ========================================================== --}}
            {{-- 3. BAGIAN LOWONGAN TERBARU (SLIDER) TETAP SAMA         --}}
            {{-- ========================================================== --}}
            <br><br>
            <h4 class="fw-bold mb-4 mt-5">Lowongan Terbaru Untukmu</h4>
            <div class="swiper-container job-swiper-container overflow-hidden">
                <div class="swiper-wrapper">
                    
                    @forelse ($lowonganPekerjaan as $lowongan)
                        <div class="swiper-slide h-auto">
                            
                            @php
                                $cardClass = ($lowongan->paket_iklan == 'premium') ? 'job-listing-card-premium' : 'job-listing-card';
                            @endphp

                            <div class="{{ $cardClass }}">
                                @if($lowongan->paket_iklan == 'premium')
                                <span class="premium-badge"><i class="bi bi-star-fill"></i></span>
                                @endif
                                <div class="company-info">
                                    <img src="{{ $lowongan->perusahaan && $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : asset('images/default-logo.png') }}" 
                                         alt="Logo {{ $lowongan->perusahaan->nama_perusahaan ?? 'Perusahaan' }}" class="company-logo">
                                    <div class="company-details">
                                        <h6>{{ $lowongan->judul_lowongan }}</h6>
                                        <p>{{ $lowongan->perusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}</p>
                                    </div>
                                </div>
                                <div class="location"><i class="bi bi-geo-alt-fill"></i><span>{{ $lowongan->domisili }}</span></div>
                                <div class="description">
                                    {{ Str::limit(strip_tags($lowongan->deskripsi_pekerjaan), 100, '...') }}
                                </div>
                                @auth
                                    <a href="{{ route('pelamar.lowongan.show', $lowongan->id) }}" class="btn-lihat-detail mt-auto">Lihat Detail</a>
                                @else
                                    <a href="#" class="btn-lihat-detail mt-auto" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Lihat Detail</a>
                                @endauth
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-muted">Belum ada lowongan pekerjaan yang tersedia saat ini.</p>
                        </div>
                    @endforelse

                </div>
                <div class="swiper-button-next text-dark"></div>
                <div class="swiper-button-prev text-dark"></div>
            </div>
        </div>
    </div>


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
    @include('pelamar.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".job-swiper-container", {
            slidesPerView: 1.5,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2.5,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 3.5,
                    spaceBetween: 30,
                }
            }
        });
    </script>
</body>
</html>