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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* === Global & Reset === */
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; color: #495057; overflow-x: hidden; line-height: 1.6; }
        a { text-decoration: none; color: inherit; transition: all 0.3s; }
        a:hover { color: #F39C12; }

        /* === Helper Classes & Buttons === */
        .text-orange { color: #F39C12 !important; }
        
        /* Tombol Solid Oranye */
        .btn-orange { background-color: #F39C12; border: 1px solid #F39C12; color: #fff; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s; }
        .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; color: #fff; transform: translateY(-2px); }
        
        /* Tombol Outline Oranye (INI YANG AKU TAMBAHKAN) */
        .btn-outline-orange { border: 2px solid #F39C12; color: #F39C12; font-weight: 600; padding: 0.6rem 1.5rem; border-radius: 50px; transition: all 0.3s; background: transparent; }
        .btn-outline-orange:hover { background-color: #F39C12; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3); }

        /* Tombol Outline Putih */
        .btn-outline-light-custom { border: 2px solid rgba(255,255,255,0.8); color: white; font-weight: 600; padding: 0.6rem 1.5rem; border-radius: 8px; transition: all 0.3s; }
        .btn-outline-light-custom:hover { background-color: white; color: #22374e; border-color: white; }
        
        /* === Navbar === */
        .navbar { z-index: 1050; position: relative; box-shadow: 0 2px 10px rgba(0,0,0,0.1); background-color: #22374e; }

        /* === BAGIAN 1: HERO (IKLAN VIP) === */
        .hero-section { position: relative; background-color: #22374e; color: white; overflow: hidden; }
        .hero-slide-item { min-height: 550px; display: flex; align-items: center; padding: 4rem 0; }
        .hero-title { font-size: 3.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 1.5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .hero-subtitle { font-size: 1.2rem; color: rgba(255,255,255,0.9); margin-bottom: 2.5rem; font-weight: 300; }
        .hero-img-static { max-height: 450px; width: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3)); animation: float 6s ease-in-out infinite; }
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0px); } }
        
        /* Tampilan Iklan VIP */
        .vip-ad-container { text-align: center; max-width: 900px; margin: 0 auto; }
        .vip-ad-badge { background-color: #FFD700; color: #22374e; padding: 5px 15px; border-radius: 20px; font-weight: 800; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; margin-bottom: 1.5rem; display: inline-block; box-shadow: 0 0 15px rgba(255, 215, 0, 0.5); }
        .vip-ad-title { font-size: 2.8rem; font-weight: 700; margin-bottom: 0.5rem; color: white; }
        .vip-ad-company { font-size: 1.5rem; color: rgba(255,255,255,0.8); margin-bottom: 1rem; font-weight: 300; }
        
        /* Gambar VIP */
        .vip-ad-visual img { 
            height: 300px; width: 100%; object-fit: cover; 
            border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,0.4); 
            border: 4px solid rgba(255,255,255,0.1); margin-bottom: 1.5rem;
        }
        /* Meta Data VIP */
        .vip-meta { color: rgba(255,255,255,0.6); font-size: 0.9rem; font-style: italic; display: flex; justify-content: center; gap: 20px; }

        /* === BAGIAN 2: IKLAN GRATIS (GRID) === */
        .section-promo { padding: 5rem 0; background-color: #f4f6f9; }
        .section-title { font-size: 2rem; font-weight: 700; color: #22374e; margin-bottom: 0.5rem; }
        
        .promo-card {
            background: white; border-radius: 16px; overflow: hidden; border: 1px solid #e9ecef;
            transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column;
        }
        .promo-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: #F39C12; }
        .promo-img-wrapper { height: 180px; overflow: hidden; position: relative; background-color: #e9ecef; }
        .promo-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .promo-card:hover .promo-img { transform: scale(1.05); }
        .promo-content { padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; }
        .promo-title { font-size: 1.1rem; font-weight: 700; color: #212529; margin-bottom: 0.5rem; line-height: 1.3; }
        .promo-company { font-size: 0.9rem; color: #6c757d; margin-bottom: 1rem; }
        .promo-desc { font-size: 0.9rem; color: #495057; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 1rem; flex-grow: 1; }
        
        /* Meta Data Gratis */
        .promo-meta { margin-top: auto; font-size: 0.8rem; color: #adb5bd; border-top: 1px solid #f1f1f1; padding-top: 0.8rem; display: flex; justify-content: space-between;}

        /* === BAGIAN 3: MITRA (LOGO) === */
        .section-mitra { background-color: white; padding: 4rem 0; border-top: 1px solid #e9ecef; }
        .mitra-title { text-align: center; font-size: 1rem; font-weight: 700; color: #adb5bd; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 3rem; }
        .logo-slide-item { display: flex; justify-content: center; align-items: center; height: 80px; opacity: 1; transition: all 0.3s; filter: none; }
        .logo-slide-item:hover { transform: scale(1.1); }
        .mitra-logo-img { max-height: 60px; max-width: 100%; object-fit: contain; }

        /* === FIX FOOTER (NAVY) === */
        footer.footer { 
            background-color: #071b2f !important; /* Paksa Navy */
            color: white !important; 
            padding-top: 4rem; padding-bottom: 2rem; 
            margin-top: 0 !important;
        }
        footer.footer h6 { color: #F39C12 !important; }
        footer.footer a { color: rgba(255,255,255,0.7) !important; }
        footer.footer a:hover { color: #F39C12 !important; }
        footer.footer .text-white-50 { color: rgba(255,255,255,0.6) !important; }

        /* Responsive & Utilities */
        .carousel-indicators [data-bs-target] { background-color: white; width: 10px; height: 10px; border-radius: 50%; margin: 0 6px; opacity: 0.5; }
        .carousel-indicators .active { opacity: 1; background-color: #F39C12; }
        @media (max-width: 768px) { .hero-title { font-size: 2.5rem; } .hero-slide-item { padding: 3rem 0; text-align: center; } .hero-img-static { max-height: 250px; margin-top: 2rem; } .vip-ad-title { font-size: 2rem; } }
    </style>
</head>
<body>

    @include('pelamar.partials.navbar')

    {{-- BAGIAN 1: HERO SLIDER (Intro + Iklan VIP) --}}
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade animate__animated animate__fadeIn" data-bs-ride="carousel" data-bs-interval="5000">
            
            <div class="carousel-inner hero-carousel-inner">
                
                {{-- Slide 1: Intro Messari --}}
                <div class="carousel-item active hero-slide-item">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 text-center text-lg-start animate__animated animate__fadeInLeft">
                                <h1 class="hero-title">TEMPAT SOLUSI<br>ANDA MENCARI KERJA<br><span class="text-orange">DISINI</span></h1>
                                <p class="hero-subtitle">Temukan ribuan lowongan pekerjaan dari perusahaan terbaik.</p>
                                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                                    @auth
                                        <a href="{{ route('lowongan.index') }}" class="btn btn-orange btn-lg shadow-sm">Cari Lowongan</a>
                                    @else
                                        <a href="{{ route('register') }}" class="btn btn-orange btn-lg shadow-sm">Daftar</a>
                                        <a href="{{ route('login') }}" class="btn btn-outline-light-custom btn-lg">Masuk</a>
                                    @endauth
                                </div>
                            </div>
                            <div class="col-lg-6 text-center d-none d-lg-block animate__animated animate__fadeInRight">
                                <img src="{{ asset('images/gambar1.png') }}" alt="Hero" class="hero-img-static">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 dst: Iklan VIP (Tanpa Tombol, Ada Tanggal) --}}
                @foreach($iklanVip as $iklan)
                <div class="carousel-item hero-slide-item">
                    <div class="container">
                        <div class="vip-ad-container">
                            <h2 class="vip-ad-title">{{ $iklan->judul }}</h2>
                            <p class="vip-ad-company">Oleh: {{ $iklan->perusahaan->nama_perusahaan }}</p>
                            
                            <div class="vip-ad-visual mb-3">
                                {{-- GAMBAR DENGAN AUTO-FALLBACK JIKA ERROR/TIDAK ADA --}}
                                <img src="{{ $iklan->file_iklan_banner ? asset('storage/' . $iklan->file_iklan_banner) : '' }}" 
                                     onerror="this.onerror=null; this.src='https://placehold.co/800x400/34495e/ffffff?text={{ urlencode($iklan->judul) }}';"
                                     alt="Banner Iklan">
                            </div>
                            
                            <div class="text-white mb-3 px-5">{{ $iklan->deskripsi }}</div>

                            {{-- Tanggal Publish & Update --}}
                            <div class="vip-meta">
                                <span><i class="bi bi-calendar3"></i> Diposting: {{ \Carbon\Carbon::parse($iklan->published_at)->format('d M Y') }}</span>
                                <span><i class="bi bi-clock-history"></i> Update: {{ \Carbon\Carbon::parse($iklan->updated_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- Indikator & Kontrol --}}
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                @foreach($iklanVip as $index => $iklan)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index + 1 }}"></button>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    {{-- BAGIAN 2: IKLAN GRATIS (GRID - SEMUA TAMPIL) --}}
    <section class="section-promo animate__animated animate__fadeInUp">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="section-title">Info Terbaru</h3>
                <p class="section-desc">Kabar terbaru dari mitra perusahaan kami</p>
            </div>

            {{-- GRID LAYOUT (Bukan Slider) --}}
            <div class="row g-4">
                @forelse($iklanGratis as $iklan)
                <div class="col-md-6 col-lg-3">
                    <div class="promo-card h-100">
                        <div class="promo-img-wrapper">
                            {{-- GAMBAR DENGAN AUTO-FALLBACK --}}
                            <img src="{{ $iklan->file_iklan_banner ? asset('storage/' . $iklan->file_iklan_banner) : '' }}" 
                                 onerror="this.onerror=null; this.src='https://placehold.co/600x400/f8f9fa/22374e?text={{ urlencode(Str::limit($iklan->judul, 20)) }}';"
                                 class="promo-img" alt="{{ $iklan->judul }}">
                        </div>
                        <div class="promo-content">
                            <h5 class="promo-title">{{ Str::limit($iklan->judul, 50) }}</h5>
                            <p class="promo-company">{{ $iklan->perusahaan->nama_perusahaan }}</p>
                            <p class="promo-desc">{{ Str::limit($iklan->deskripsi, 80) }}</p>
                            
                            {{-- Tanggal --}}
                            <div class="promo-meta">
                                <div><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($iklan->published_at)->format('d M Y') }}</div>
                                <div><i class="bi bi-clock-history me-1"></i> {{ \Carbon\Carbon::parse($iklan->updated_at)->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded-4 shadow-sm">
                        <i class="bi bi-info-circle display-4 text-muted mb-3"></i>
                        <p class="text-muted">Belum ada info terbaru saat ini.</p>
                    </div>
                </div>
                @endforelse
            </div>
            
            {{-- TOMBOL SUDAH DIPERBAIKI (Class ditambahkan di CSS) --}}
            <div class="text-center mt-5">
                <a href="{{ route('lowongan.index') }}" class="btn btn-outline-orange rounded-pill px-4 py-2">
                    Mulai Mencari Kerja
                </a>
            </div>
        </div>
    </section>

    {{-- BAGIAN 3: LOGO MITRA --}}
    <section class="section-mitra">
        <div class="container">
            <h5 class="mitra-title">Dipercaya oleh Perusahaan Terkemuka</h5>
            <div class="swiper-container logo-swiper overflow-hidden">
                <div class="swiper-wrapper align-items-center">
                    @foreach($semuaPerusahaan as $perusahaan)
                        <div class="swiper-slide">
                            <div class="logo-slide-item" title="{{ $perusahaan->nama_perusahaan }}">
                                <img src="{{ asset('storage/' . $perusahaan->logo_perusahaan) }}" 
                                     alt="{{ $perusahaan->nama_perusahaan }}" class="mitra-logo-img">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('pelamar.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".logo-swiper", {
            slidesPerView: 3, spaceBetween: 30, loop: true, speed: 3000,
            autoplay: { delay: 0, disableOnInteraction: false }, freeMode: true,
            breakpoints: { 640: { slidesPerView: 4 }, 768: { slidesPerView: 5 }, 1024: { slidesPerView: 6 } }
        });
    </script>
</body>
</html>