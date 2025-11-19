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

    {{-- Animate.css untuk efek masuk yang mudah --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* === Global & Reset === */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            color: #495057;
            overflow-x: hidden;
            line-height: 1.6;
        }
        a { text-decoration: none; color: inherit; transition: all 0.3s; }
        a:hover { color: #F39C12; }

        /* === Helper Classes === */
        .text-orange { color: #F39C12 !important; }
        .btn-orange {
            background-color: #F39C12; border: 1px solid #F39C12; color: #fff;
            padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s;
        }
        .btn-orange:hover {
            background-color: #d8890b; border-color: #d8890b; color: #fff; transform: translateY(-2px);
        }
        .btn-outline-light-custom {
            border: 2px solid rgba(255,255,255,0.8); color: white; font-weight: 600;
            padding: 0.6rem 1.5rem; border-radius: 8px; transition: all 0.3s;
        }
        .btn-outline-light-custom:hover {
            background-color: white; color: #22374e; border-color: white;
        }
        /* Tombol Outline Oranye */
        .btn-outline-orange {
            border: 2px solid #F39C12; color: #F39C12; font-weight: 600;
            padding: 0.6rem 1.5rem; border-radius: 8px; transition: all 0.3s;
        }
        .btn-outline-orange:hover {
            background-color: #F39C12; color: white;
        }


        /* === Navbar === */
        .navbar { z-index: 1050; position: relative; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

        /* === BAGIAN 1: HERO CAROUSEL === */
        /* Efek Blur untuk yang belum login */
        .guest-blur {
            filter: blur(5px);
            pointer-events: none; /* Mencegah klik */
            user-select: none;
            transition: filter 0.5s ease;
        }
        /* Overlay pesan untuk guest */
        .guest-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.6); /* Putih transparan */
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 16px; /* Sesuaikan dengan border radius kartu */
        }
        
        .hero-section {
            position: relative;
            background-color: #22374e;
            color: white;
            overflow: hidden;
        }
        .hero-carousel-inner { min-height: 550px; }
        .hero-slide-item {
            min-height: 550px;
            display: flex;
            align-items: center;
            padding: 4rem 0;
            /* Fix transisi kasar: pastikan backface hidden */
            backface-visibility: hidden; 
            -webkit-backface-visibility: hidden;
        }
        
        /* Slide 1: Statis */
        .hero-title {
            font-size: 3.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 1.5rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .hero-subtitle {
            font-size: 1.2rem; color: rgba(255,255,255,0.9); margin-bottom: 2.5rem; font-weight: 300;
        }
        .hero-img-static {
            max-height: 450px; width: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
            /* Animasi gerakan halus */
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        /* Slide Premium */
        .hero-premium-content { text-align: center; max-width: 900px; margin: 0 auto; }
        .premium-badge-hero {
            background-color: #F39C12; color: white; padding: 6px 16px;
            border-radius: 30px; font-weight: 700; text-transform: uppercase;
            font-size: 0.85rem; letter-spacing: 1.5px; margin-bottom: 1.5rem;
            display: inline-block; box-shadow: 0 4px 10px rgba(243, 156, 18, 0.4);
        }
        .hero-premium-title { font-size: 2.8rem; font-weight: 700; margin-bottom: 0.5rem; color: white; }
        .hero-premium-company { font-size: 1.5rem; color: rgba(255,255,255,0.8); margin-bottom: 2rem; font-weight: 300; }
        .hero-premium-visual {
            background: white; border-radius: 16px; padding: 1.5rem;
            display: inline-block; box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            margin-bottom: 2rem; transition: transform 0.3s;
            position: relative; /* Untuk overlay guest */
            overflow: hidden;
        }
        .hero-premium-img { height: 120px; width: auto; object-fit: contain; }
        
        /* Carousel Indicators & Controls */
        .carousel-indicators [data-bs-target] { background-color: white; width: 10px; height: 10px; border-radius: 50%; margin: 0 6px; opacity: 0.5; }
        .carousel-indicators .active { opacity: 1; background-color: #F39C12; transform: scale(1.2); }
        
        /* FIX TRANSISI: Hapus transisi default Bootstrap yang kadang glitchy jika tidak pas */
        .carousel-item {
            transition: transform 0.6s ease-in-out; /* Dipercepat sedikit atau sesuaikan */
        }
        /* Atau gunakan carousel-fade (sudah dipakai di HTML) untuk transisi opacity yang lebih mulus */


        /* === BAGIAN 2: DAFTAR LOWONGAN === */
        .section-lowongan { padding: 5rem 0; background-color: #f4f6f9; }
        .section-header { text-align: center; margin-bottom: 3rem; }
        .section-title { font-size: 2rem; font-weight: 700; color: #22374e; margin-bottom: 0.5rem; }
        .section-desc { color: #6c757d; }

        .job-card {
            background: white; border-radius: 16px; overflow: hidden;
            border: 1px solid #e9ecef; transition: all 0.3s ease;
            height: 100%; display: flex; flex-direction: column;
            position: relative; /* Untuk overlay guest */
        }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: #dbe2e8; }
        
        /* Premium Card Style */
        .job-card.premium { border: 1px solid #ffeeba; background: linear-gradient(to bottom, #ffffff, #fffaf0); }
        .job-card.premium::before { content: ""; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background-color: #F39C12; }
        .premium-tag {
            position: absolute; top: 12px; right: 12px;
            background-color: #fff4e0; color: #F39C12;
            font-size: 0.7rem; font-weight: 700; padding: 4px 10px;
            border-radius: 20px; display: flex; align-items: center; gap: 4px; z-index: 2;
        }

        .card-content { padding: 1.5rem; flex-grow: 1; }
        .company-header { display: flex; align-items: center; margin-bottom: 1rem; }
        .company-logo-thumb { width: 48px; height: 48px; border-radius: 10px; object-fit: contain; border: 1px solid #f1f1f1; padding: 2px; background: white; margin-right: 1rem; }
        .job-info-title { font-size: 1.1rem; font-weight: 700; color: #212529; line-height: 1.3; margin-bottom: 0.2rem; }
        .job-info-company { font-size: 0.9rem; color: #6c757d; margin: 0; }
        
        .job-details-meta { font-size: 0.85rem; color: #6c757d; margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 12px; }
        .meta-item { display: flex; align-items: center; gap: 5px; }
        .meta-item i { color: #F39C12; }
        .job-desc-preview { font-size: 0.9rem; color: #6c757d; margin-top: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        .card-action { padding: 1rem 1.5rem; border-top: 1px solid #f1f1f1; text-align: right; background-color: #ffffff; }
        .btn-link-detail { color: #22374e; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; transition: gap 0.2s; }
        .btn-link-detail:hover { color: #F39C12; gap: 8px; }


        /* === BAGIAN 3: MITRA === */
        .section-mitra { background-color: white; padding: 4rem 0; border-top: 1px solid #e9ecef; }
        .mitra-title { text-align: center; font-size: 1rem; font-weight: 700; color: #adb5bd; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 3rem; }
        .logo-swiper { padding: 10px 0; }
        .logo-slide-item { display: flex; justify-content: center; align-items: center; height: 80px; opacity: 1; transition: all 0.3s; }
        .logo-slide-item:hover { transform: scale(1.1); }
        .mitra-logo-img { max-height: 60px; max-width: 100%; object-fit: contain; }


        /* === Responsive === */
        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .hero-slide-item { min-height: auto; padding: 3rem 0; text-align: center; }
            .hero-content-wrapper { text-align: center; margin-bottom: 2rem; }
            .hero-img-static { max-height: 250px; margin-top: 2rem; }
            .hero-premium-title { font-size: 2rem; }
        }
        footer.footer { 
            background-color: #071b2f !important; /* Paksa warna Navy */
            color: white !important; 
            margin-top: 0; /* Hapus margin aneh jika ada */
            padding-top: 4rem;
            padding-bottom: 2rem;
        }
        footer.footer h6 { color: #F39C12 !important; } /* Judul kolom oranye */
        footer.footer a { color: rgba(255,255,255,0.7) !important; }
        footer.footer a:hover { color: #F39C12 !important; }
    </style>
</head>
<body>

    @include('pelamar.partials.navbar')

    {{-- =================================================================== --}}
    {{-- BAGIAN 1: HERO CAROUSEL                                              --}}
    {{-- =================================================================== --}}
    <section class="hero-section">
        {{-- Tambahkan class 'animate__animated animate__fadeIn' untuk efek masuk --}}
        <div id="heroCarousel" class="carousel slide carousel-fade animate__animated animate__fadeIn" data-bs-ride="carousel" data-bs-interval="5000">
            
            <div class="carousel-inner hero-carousel-inner">
                
                {{-- SLIDE 1: STATIS (SELALU JELAS/TIDAK BLUR) --}}
                <div class="carousel-item active hero-slide-item">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 hero-content-wrapper animate__animated animate__fadeInLeft animate__delay-1s">
                                <h1 class="hero-title">TEMPAT SOLUSI<br>ANDA MENCARI KERJA<br><span class="text-orange">DISINI</span></h1>
                                <p class="hero-subtitle">Bergabunglah dengan ribuan profesional lainnya dan temukan karir impian Anda bersama mitra perusahaan terbaik kami.</p>
                                <div class="d-flex gap-3 justify-content-lg-start justify-content-center">
                                    @auth
                                        <a href="{{ route('lowongan.index') }}" class="btn btn-orange btn-lg shadow-sm">Cari Lowongan</a>
                                    @else
                                        <a href="{{ route('register') }}" class="btn btn-orange btn-lg shadow-sm">Daftar Sekarang</a>
                                        <a href="{{ route('login') }}" class="btn btn-outline-light-custom btn-lg">Masuk</a>
                                    @endauth
                                </div>
                            </div>
                            <div class="col-lg-6 text-center d-none d-lg-block animate__animated animate__fadeInRight animate__delay-1s">
                                <img src="{{ asset('images/gambar1.png') }}" alt="Hero Illustration" class="hero-img-static">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SLIDE 2 dst: IKLAN PREMIUM (BLUR JIKA BELUM LOGIN) --}}
                @foreach($iklanPremiumHero as $iklan)
                <div class="carousel-item hero-slide-item">
                    <div class="container">
                        {{-- Kontainer Konten Slide (yang akan di-blur) --}}
                        <div class="hero-premium-content position-relative">
                            
                            {{-- Logika Blur: Tambahkan class 'guest-blur' jika belum login --}}
                            <div class="{{ Auth::check() ? '' : 'guest-blur' }}">
                                <span class="premium-badge-hero"><i class="bi bi-star-fill me-1"></i> Premium Hiring</span>
                                
                                <h2 class="hero-premium-title">{{ $iklan->judul_lowongan }}</h2>
                                <p class="hero-premium-company">di {{ $iklan->perusahaan->nama_perusahaan }}</p>
                                
                                <div class="hero-premium-visual">
                                    @if($iklan->perusahaan->logo_perusahaan)
                                        <img src="{{ asset('storage/' . $iklan->perusahaan->logo_perusahaan) }}" alt="Logo" class="hero-premium-img">
                                    @else
                                        <img src="{{ asset('images/default-logo.png') }}" alt="Logo" class="hero-premium-img">
                                    @endif
                                </div>

                                <div class="d-block">
                                    <a href="{{ route('pelamar.lowongan.show', $iklan->id) }}" class="btn btn-orange btn-lg shadow-sm px-5">
                                        Lihat Detail & Lamar <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>

                            {{-- Overlay Pesan untuk Guest (Hanya muncul jika belum login) --}}
                            @guest
                                <div class="guest-overlay">
                                    <div class="text-center p-4">
                                        <i class="bi bi-lock-fill text-orange display-4 mb-3"></i>
                                        <h4 class="fw-bold text-dark">Konten Eksklusif</h4>
                                        <p class="text-muted mb-4">Login untuk melihat lowongan premium ini secara lengkap.</p>
                                        <a href="{{ route('login') }}" class="btn btn-orange px-4">Masuk Sekarang</a>
                                    </div>
                                </div>
                            @endguest

                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- Navigasi Carousel --}}
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                @foreach($iklanPremiumHero as $index => $iklan)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index + 1 }}"></button>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </section>


    {{-- =================================================================== --}}
    {{-- BAGIAN 2: SEMUA LOWONGAN (BLUR JIKA BELUM LOGIN)                    --}}
    {{-- =================================================================== --}}
    <section class="section-lowongan animate__animated animate__fadeInUp animate__delay-2s">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">Lowongan Terbaru</h3>
                <p class="section-desc">Temukan peluang karir terbaru yang sesuai dengan keahlian Anda</p>
            </div>

            <div class="row g-4">
                @forelse($lowonganSemua as $lowongan)
                    <div class="col-lg-3 col-md-6">
                        <div class="position-relative h-100">
                            
                            {{-- Konten Kartu (yang akan di-blur) --}}
                            <a href="{{ Auth::check() ? route('pelamar.lowongan.show', $lowongan->id) : '#' }}" 
                               class="text-decoration-none h-100 d-block {{ Auth::check() ? '' : 'guest-blur' }}">
                                
                                <div class="job-card {{ $lowongan->paket_iklan == 'premium' ? 'premium' : '' }}">
                                    @if($lowongan->paket_iklan == 'premium')
                                        <div class="premium-tag"><i class="bi bi-star-fill"></i> Premium</div>
                                    @endif
                                    <div class="card-content">
                                        <div class="company-header">
                                            <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : asset('images/default-logo.png') }}" 
                                                 class="company-logo-thumb" alt="Logo">
                                            <div>
                                                <h5 class="job-info-title">{{ Str::limit($lowongan->judul_lowongan, 20) }}</h5>
                                                <p class="job-info-company">{{ Str::limit($lowongan->perusahaan->nama_perusahaan, 25) }}</p>
                                            </div>
                                        </div>
                                        <div class="job-desc-preview">
                                            {{ Str::limit(strip_tags($lowongan->deskripsi_pekerjaan), 90) }}
                                        </div>
                                        <div class="job-details-meta">
                                            <div class="meta-item"><i class="bi bi-geo-alt-fill"></i> <span>{{ Str::limit($lowongan->domisili, 15) }}</span></div>
                                            <div class="meta-item"><i class="bi bi-clock"></i> <span>{{ $lowongan->tipe_pekerjaan ?? 'Full Time' }}</span></div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <span class="btn-link-detail">Lihat Detail <i class="bi bi-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>

                            {{-- Overlay untuk Guest di Setiap Kartu --}}
                            @guest
                                <div class="guest-overlay" style="border-radius: 16px;">
                                    <div class="text-center">
                                        <i class="bi bi-lock-fill text-orange fs-3 mb-2"></i>
                                        <h6 class="fw-bold text-dark mb-3">Login untuk melihat</h6>
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-orange">Masuk</a>
                                    </div>
                                </div>
                            @endguest

                        </div>
                    </div>
                @empty
                    <div class="col-12 py-5 text-center">
                        <div class="empty-state">
                            <i class="bi bi-search display-4 text-muted mb-3"></i>
                            <p class="text-muted fs-5">Belum ada lowongan tersedia saat ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('lowongan.index') }}" class="btn btn-outline-orange rounded-pill px-4 py-2">
                    Lihat Semua Lowongan
                </a>
            </div>
        </div>
    </section>


    {{-- =================================================================== --}}
    {{-- BAGIAN 3: MITRA PERUSAHAAN (LOGO SLIDER)                            --}}
    {{-- =================================================================== --}}
    <section class="section-mitra animate__animated animate__fadeIn">
        <div class="container">
            <h5 class="mitra-title">Dipercaya oleh Perusahaan Terkemuka</h5>
            <div class="swiper-container logo-swiper overflow-hidden">
                <div class="swiper-wrapper align-items-center">
                    @foreach($semuaPerusahaan as $perusahaan)
                        <div class="swiper-slide">
                            <div class="logo-slide-item" title="{{ $perusahaan->nama_perusahaan }}">
                                <img src="{{ asset('storage/' . $perusahaan->logo_perusahaan) }}" 
                                     alt="{{ $perusahaan->nama_perusahaan }}" 
                                     class="mitra-logo-img">
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
        // Swiper untuk Logo Mitra
        var logoSwiper = new Swiper(".logo-swiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,
            speed: 3000, // Kecepatan transisi diperlambat biar halus
            autoplay: {
                delay: 0, // Autoplay jalan terus (linear)
                disableOnInteraction: false,
            },
            freeMode: true, // Mode bebas tanpa snap
            breakpoints: {
                640: { slidesPerView: 4, spaceBetween: 40 },
                768: { slidesPerView: 5, spaceBetween: 50 },
                1024: { slidesPerView: 6, spaceBetween: 60 },
            }
        });
    </script>
</body>
</html>