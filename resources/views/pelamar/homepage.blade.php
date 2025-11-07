<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messari - Portal Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    /* === Global & Reset === */
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f9; /* Background abu-abu muda korporat */
        color: #495057; /* Warna teks abu tua */
        overflow-x: hidden;
        line-height: 1.6;
    }
    a {
        color: #F39C12; /* Warna link biru standar Bootstrap (atau bisa #22374e) */
        text-decoration: none;
    }
    a:hover {
        color: #0a58ca;
        text-decoration: underline;
    }
    .btn-orange { /* Oranye tetap jadi aksen utama */
        background-color: #F39C12; border-color: #F39C12; color: #fff;
        padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: 500; transition: all 0.3s;
    }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; transform: translateY(-2px); }

    /* === Navbar (Tetap Sama) === */
    .navbar { padding: 1rem 0; z-index: 1050 !important; position: relative; background-color: #22374e; color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); } /* Tambah shadow */
    .navbar-brand { font-weight: bold; font-size: 1.5rem; letter-spacing: 2px; color: white; }
    .navbar-nav .nav-link { margin-right: 1rem; color: rgba(255, 255, 255, 0.8); } /* Warna link navbar sedikit redup */
    .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: #ffffff; } /* Warna hover/active jadi putih */
    .dropdown-menu { z-index: 1051 !important; }

    /* === Hero Section (Tema Korporat) === */
    .hero-section {
        background-color: #ffffff; /* Background putih */
        color: #343a40; /* Teks gelap */
        padding: 6rem 0; /* Padding lebih besar */
        text-align: left;
        border-bottom: 1px solid #dee2e6; /* Garis bawah tipis */
    }
    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700; /* Font lebih standar */
        line-height: 1.3;
        margin-bottom: 1rem;
        color: #22374e; /* Judul warna biru tua */
    }
    .hero-section p.lead { /* Style untuk subtitle */
        font-size: 1.2rem;
        color: #6c757d; /* Warna abu */
        margin-bottom: 2rem;
        max-width: 500px; /* Batasi lebar subtitle */
    }
    .hero-img {
        max-height: 400px; /* Ukuran disesuaikan */
    }
    /* Tombol Hero */
    .hero-section .btn-orange { /* Tombol Daftar tetap oranye */ }
    .hero-section .btn-outline-secondary { /* Tombol Masuk jadi outline abu */
        padding: 0.8rem 1.8rem; border-radius: 6px; font-weight: 500; transition: all 0.3s;
        border-color: #6c757d; color: #6c757d; border-width: 2px;
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

    /* === Carousel Berita (Style Tema 2 + Tinggi Tetap + Bingkai Biru Muda + Konten Tengah) === */
    #beritaTerkiniLandingPage {
        position: relative;
        height: 55vh; /* TINGGI TETAP (sesuaikan jika perlu) */
        min-height: 450px; /* TINGGI MINIMUM (sesuaikan jika perlu) */
        background-color: #e9ecef; /* Background abu-abu muda luar */
        color: #343a40;
        overflow: hidden;
    }
    #beritaTerkiniLandingPage .carousel-inner {
         height: 100%;
    }
    #beritaTerkiniLandingPage .carousel-item {
        height: 100%;
        background-color: #E0F2F7; /* WARNA BINGKAI BIRU MUDA */
        display: flex;
        flex-direction: column;
        align-items: center; /* Tengah Horizontal */
        justify-content: center; /* Tengah Vertikal */
        padding: 2rem;
        text-align: center;
        /* Hapus style yang tidak perlu dipindah ke anak */
    }
    #beritaTerkiniLandingPage .carousel-item img {
        /* Hapus position absolute */
        width: auto; /* Lebar otomatis */
        max-width: 90%; /* Maksimal 90% lebar biar tidak mepet */
        height: auto; /* Tinggi otomatis */
        max-height: 60%; /* BATASI TINGGI GAMBAR (misal 60%) */
        object-fit: contain; /* TAMPILKAN SELURUH GAMBAR */
        display: block;
        margin-left: auto; /* Paksa tengah H */
        margin-right: auto; /* Paksa tengah H */
        margin-bottom: 1rem; /* Jarak ke teks */
        /* z-index: 2; / / Tidak perlu Z index jika static */
    }

    /* Konten teks di bawah gambar */
    #beritaTerkiniLandingPage .berita-content-landing {
        /* position: static; / / Tidak perlu */
        /* z-index: 3; / / Tidak perlu */
        text-align: center;
        max-width: 90%; /* Batasi lebar teks */
        /* padding: 0; / / Sudah ada di parent */
        /* height: auto; / / Tidak perlu */
        margin: 0 auto; /* Tengah H (sebenarnya sudah oleh parent flex) */
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
    /* Tombol Outline Biru dari Tema 2 */
    #beritaTerkiniLandingPage .berita-content-landing .btn-berita-landing {
        background-color: transparent; color: #22374e;
        border: 2px solid #22374e; padding: 0.5rem 1.2rem;
        border-radius: 6px;
        font-size: 0.85rem; font-weight: 500; transition: all 0.3s;
        text-decoration: none; box-shadow: none;
        display: inline-block; /* Pastikan tombol tidak full width */
    }
    #beritaTerkiniLandingPage .berita-content-landing .btn-berita-landing:hover {
        background-color: #22374e; color: white;
    }
     /* Indikator & Kontrol (Style Tema 2) */
    #beritaTerkiniLandingPage .carousel-indicators { z-index: 5; }
    #beritaTerkiniLandingPage .carousel-indicators button { background-color: rgba(0,0,0,0.2); }
    #beritaTerkiniLandingPage .carousel-indicators .active { background-color: #22374e; }
    #beritaTerkiniLandingPage .carousel-control-prev, #beritaTerkiniLandingPage .carousel-control-next { z-index: 5; }
    #beritaTerkiniLandingPage .carousel-control-prev-icon,
    #beritaTerkiniLandingPage .carousel-control-next-icon {
        filter: invert(20%) sepia(20%) saturate(1000%) hue-rotate(180deg) brightness(80%) contrast(90%); /* Ikon gelap */
        background-color: transparent; border-radius: 0; padding: 0; box-shadow: none;
    }

    /* === Main Content (Area Putih/Abu Sangat Muda) === */
    .main-content {
        background: #ffffff; /* Background putih */
        color: #343a40;
        padding: 4rem 0;
        position: relative;
    }
    .main-content .section-title {
        font-weight: 600; /* Font lebih standar */
        font-size: 1.8rem;
        color: #22374e; /* Warna biru tua */
        margin-bottom: 3rem; /* Jarak lebih besar */
        text-align: center;
        position: relative;
        padding-bottom: 0.8rem;
    }
    .main-content .section-title::after { /* Garis bawah biru */
        content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);
        width: 70px; height: 3px; background-color: #22374e; border-radius: 2px;
    }

    /* === Jelajahi Perusahaan (Premium) === */
    .section-perusahaan-partner .card {
        border: 1px solid #dee2e6; /* Border abu standar */
        border-radius: 8px; /* Radius lebih kotak */
        box-shadow: 0 3px 10px rgba(0,0,0,0.05); /* Shadow sangat halus */
        height: 100%; overflow: hidden; background-color: white;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .section-perusahaan-partner .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    }
    .section-perusahaan-partner .card .card-img-top { height: 160px; object-fit: cover; border-bottom: 1px solid #dee2e6; } /* Tinggi disesuaikan */
    .section-perusahaan-partner .card-body { color: #343a40; padding: 1rem; } /* Padding dikurangi */
    .section-perusahaan-partner .card-body h6 { color: #22374e; font-weight: 600; margin-bottom: 0.3rem; font-size: 1rem; } /* Warna biru */
    .section-perusahaan-partner .card-body p { color: #6c757d; font-size: 0.85rem; }
    .section-perusahaan-partner a.text-decoration-none:hover h6 { color: #F39C12; } /* Hover biru muda */
    .section-perusahaan-partner + .text-end a { /* Link Lihat Selengkapnya */
        color: #F39C12; font-weight: 500;
    }

    /* === Rekomendasi Pekerjaan (Slider) === */
    .section-rekomendasi { padding: 3rem 0 4rem; }
    .job-listing-card, .job-listing-card-premium {
        border: 1px solid #dee2e6; border-radius: 8px; padding: 1.25rem; /* Padding disesuaikan */
        height: 100%; display: flex; flex-direction: column;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        background-color: #fff;
    }
    .job-listing-card:hover, .job-listing-card-premium:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        transform: translateY(-4px);
    }
    .job-listing-card .company-logo, .job-listing-card-premium .company-logo { width: 40px; height: 40px; margin-right: 0.8rem; border-radius: 6px; } /* Ukuran logo */
    .job-listing-card .company-details h6, .job-listing-card-premium .company-details h6 { font-size: 0.95rem; font-weight: 600; color: #22374e; } /* Ukuran & Warna */
    .job-listing-card .company-details p, .job-listing-card-premium .company-details p { font-size: 0.8rem; color: #6c757d; }
    .job-listing-card .location, .job-listing-card-premium .location { font-size: 0.8rem; margin-bottom: 0.8rem; }
    .job-listing-card .location i, .job-listing-card-premium .location i { color: #6c757d; } /* Ikon lokasi abu */
    .job-listing-card .description, .job-listing-card-premium .description { font-size: 0.85rem; color: #495057; margin-bottom: 1rem; }
    .job-listing-card .btn-lihat-detail, .job-listing-card-premium .btn-lihat-detail {
        background-color: transparent; color: #F39C12; /* Tombol jadi outline biru */
        border: 1px solid #F39C12; padding: 0.4rem 0.8rem; border-radius: 6px;
        font-size: 0.8rem; font-weight: 500; margin-top: auto;
    }
    .job-listing-card .btn-lihat-detail:hover, .job-listing-card-premium .btn-lihat-detail:hover {
        background-color: #F39C12; color: white; /* Hover jadi biru solid */
    }

    /* --- Card Premium (Korporat) --- */
    /* --- Card Premium (Dibuat Lebih Menonjol) --- */
    .job-listing-card-premium {
        border: 1px solid #FFEBCD; /* Border oranye sangat muda */
        border-left: 5px solid #F39C12; /* Border kiri oranye tebal */
        background-color: #FFFBF5; /* Background krem/oranye sangat muda */
        box-shadow: 0 6px 20px rgba(243, 156, 18, 0.15); /* Shadow oranye halus */
        position: relative; /* Diperlukan untuk badge absolut */
        /* Hapus transform scale jika tidak mau terlalu besar */
        /* transform: scale(1.02); */
    }
    .job-listing-card-premium .company-details h6 {
        color: #B9770E; /* Judul lowongan warna oranye tua */
        font-weight: 700; /* Lebih tebal */
    }
    .job-listing-card-premium .btn-lihat-detail {
        background-color: #F39C12; /* Tombol jadi solid oranye */
        color: white;
        border: none;
    }
     .job-listing-card-premium .btn-lihat-detail:hover {
        background-color: #d8890b; /* Hover oranye gelap */
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
        font-size: 0.6rem; /* Ukuran bintang sedikit lebih kecil */
        margin-right: 3px;
    }

    /* --- Swiper Slider (Korporat) --- */
    .job-swiper-container { padding-bottom: 40px; }
    .swiper-slide { height: auto; }
    .swiper-button-next, .swiper-button-prev {
        color: #6c757d; /* Warna panah abu */
        background: none; border-radius: 0; width: auto; height: auto; box-shadow: none;
    }
    .swiper-button-next:hover, .swiper-button-prev:hover { background: none; }
    .swiper-button-next::after, .swiper-button-prev::after { font-size: 1.5rem; /* Ukuran panah lebih besar */ }
    .swiper-button-prev { left: -10px; } /* Posisi disesuaikan */
    .swiper-button-next { right: -10px; }

    /* === Modal Login (Korporat) === */
    #loginRequiredModal .modal-content { border-radius: 8px; } /* Radius lebih kotak */
    #loginRequiredModal .modal-header i.bi-lock-fill { color: #F39C12; } /* Ikon gembok biru */
    #loginRequiredModal .modal-title { font-size: 1.4rem; color: #22374e !important; } /* Judul biru tua */
    #loginRequiredModal .modal-body { font-size: 0.95rem; }
    #loginRequiredModal .modal-footer .btn { font-size: 0.9rem; border-radius: 6px; }
    #loginRequiredModal .modal-footer .btn-primary-custom { /* Tombol Masuk jadi biru */
        background-color: #F39C12; border-color: #F39C12;
    }
    #loginRequiredModal .modal-footer .btn-primary-custom:hover { background-color: #0b5ed7; border-color: #0a58ca; }
    #loginRequiredModal .modal-footer .btn-outline-primary-custom { /* Tombol Daftar jadi outline biru */
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

    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h1>TEMPAT SOLUSI <br> ANDA MENCARI KERJA <br> DISINI</h1>
                    <div class="mt-3">
                        @auth
                            <a href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.dashboard') : (Auth::user()->role === 'perusahaan' ? route('perusahaan.dashboard') : route('admin.dashboard')) }}"></a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light me-3">MASUK</a>
                            <a href="{{ route('register') }}" class="btn btn-orange">DAFTAR</a>
                        @endauth
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/gambar1.png') }}" alt="Sekelompok Profesional" class="img-fluid hero-img">
                </div>
            </div>  
        </div>
    </div>

    <div id="beritaTerkiniLandingPage" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner h-100">
            @forelse ($beritaTerkini as $berita)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    {{-- Gambar dinamis --}}
                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('images/default-news.png') }}" alt="{{ $berita->judul }}">
                    
                    {{-- Konten dinamis --}}
                    <div class="berita-content-landing">
                        <h2>{{ $berita->judul }}</h2>
                        <p>{{ $berita->kutipan }}</p> {{-- Gunakan kutipan --}}
                        
                        {{-- Link tombol dinamis --}}
                        @auth
                            <a href="{{ route('berita.show', $berita->slug) }}" class="btn-berita-landing">Cari Tau Selengkapnya</a>
                        @else
                            {{-- Tetap pakai modal jika belum login --}}
                            <a href="#" class="btn-berita-landing" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Cari Tau Selengkapnya</a>
                        @endauth
                    </div>
                </div>
            @empty
                {{-- Tampilan jika tidak ada berita sama sekali --}}
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
            <button type="button" data-bs-target="#beritaTerkiniLandingPage" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#beritaTerkiniLandingPage" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#beritaTerkiniLandingPage" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <h4 class="fw-bold mb-4 mt-5 d-flex align-items-center">Perusahaan Unggulan</h4>
            <div class="row g-4 section-perusahaan-partner">

                @forelse($perusahaanPremium as $perusahaan)
                    <div class="col-4">
                        <a href="{{ route('lowongan.index', ['search' => $perusahaan->nama_perusahaan, 'paket_iklan' => 'premium']) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                                {{-- Tampilkan logo dinamis --}}
                                <img src="{{ $perusahaan->logo_perusahaan ? asset('storage/' . $perusahaan->logo_perusahaan) : asset('images/default-logo.png') }}" 
                                     class="card-img-top" alt="Logo {{ $perusahaan->nama_perusahaan }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="fw-bold">{{ $perusahaan->nama_perusahaan }}</h6>
                                    {{-- Tampilkan deskripsi singkat dinamis --}}
                                    <p class="mb-0 text-muted small">{{ Str::limit($perusahaan->deskripsi, 50, '...') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    {{-- Tampilan jika tidak ada perusahaan premium --}}
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada perusahaan premium yang beriklan saat ini.</p>
                    </div>
                @endforelse

            </div>
            <div class="text-end mt-4">
                @auth
                    <a href="{{ route('lowongan.index') }}" class="text-dark fw-semibold text-decoration-none">LIHAT SELENGKAPNYA →</a>
                @else
                    <a href="{{ route('lowongan.index') }}" class="text-dark fw-semibold text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">LIHAT SELENGKAPNYA →</a>
                @endauth
            </div>

            <br><br>
            <h4 class="fw-bold mb-4 mt-5">Lowongan Terbaru Untukmu</h4>
            <div class="swiper-container job-swiper-container overflow-hidden">
                <div class="swiper-wrapper">
                    
                    @forelse ($lowonganPekerjaan as $lowongan)
                        <div class="swiper-slide h-auto">
                            
                            {{-- Kita gunakan kondisi untuk menentukan kelas CSS berdasarkan paket iklan --}}
                            @php
                                $cardClass = ($lowongan->paket_iklan == 'premium') ? 'job-listing-card-premium' : 'job-listing-card';
                            @endphp

                            <div class="{{ $cardClass }}">
                                @if($lowongan->paket_iklan == 'premium')
                                <span class="premium-badge"><i class="bi bi-star-fill"></i></span>
                                @endif
                                <div class="company-info">
                                    {{-- Tampilkan logo perusahaan, dengan fallback jika tidak ada --}}
                                    <img src="{{ $lowongan->perusahaan && $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : asset('images/default-logo.png') }}" 
                                        alt="Logo {{ $lowongan->perusahaan->nama_perusahaan ?? 'Perusahaan' }}" class="company-logo">
                                    <div class="company-details">
                                        <h6>{{ $lowongan->judul_lowongan }}</h6>
                                        <p>{{ $lowongan->perusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}</p>
                                    </div>
                                </div>
                                <div class="location"><i class="bi bi-geo-alt-fill"></i><span>{{ $lowongan->domisili }}</span></div>
                                <div class="description">
                                    {{-- Menggunakan Str::limit untuk membatasi deskripsi --}}
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