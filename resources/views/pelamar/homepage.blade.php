<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messari - Portal Kerja</title>
    
    {{-- Library CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* === Global & Reset === */
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f6f9; color: #495057; overflow-x: hidden; line-height: 1.6; }
        a { text-decoration: none; color: inherit; transition: all 0.3s; }
        a:hover { color: #F39C12; }

        /* === Styles Umum Button & Text (Non-Navbar) === */
        .text-orange { color: #F39C12 !important; }
        .btn-orange { background-color: #F39C12; border: 1px solid #F39C12; color: #fff; padding: 0.6rem 1.5rem; border-radius: 8px; font-weight: 600; transition: all 0.3s; }
        .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; color: #fff; transform: translateY(-2px); }
        .btn-outline-orange { border: 2px solid #F39C12; color: #F39C12; font-weight: 600; padding: 0.6rem 1.5rem; border-radius: 50px; transition: all 0.3s; background: transparent; }
        .btn-outline-orange:hover { background-color: #F39C12; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3); }
        .btn-outline-light-custom { border: 2px solid rgba(255,255,255,0.8); color: white; font-weight: 600; padding: 0.6rem 1.5rem; border-radius: 8px; transition: all 0.3s; }
        .btn-outline-light-custom:hover { background-color: white; color: #22374e; border-color: white; }

        /* === BAGIAN 1: HERO (IKLAN VIP) === */
        .hero-section { position: relative; background-color: #22374e; color: white; overflow: hidden; }
        .hero-slide-item { min-height: 550px; display: flex; align-items: center; padding: 4rem 0; position: relative; }
        .hero-title { font-size: 3.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 1.5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .hero-subtitle { font-size: 1.2rem; color: rgba(255,255,255,0.9); margin-bottom: 2.5rem; font-weight: 300; }
        .hero-img-static { max-height: 450px; width: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3)); animation: float 6s ease-in-out infinite; }
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0px); } }
        .vip-ad-container { text-align: center; max-width: 900px; margin: 0 auto; }
        .vip-ad-badge { background-color: #FFD700; color: #22374e; padding: 5px 15px; border-radius: 20px; font-weight: 800; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; margin-bottom: 1.5rem; display: inline-block; box-shadow: 0 0 15px rgba(255, 215, 0, 0.5); }
        .vip-ad-title { font-size: 2.8rem; font-weight: 700; margin-bottom: 0.5rem; color: white; }
        .vip-ad-company { font-size: 1.5rem; color: rgba(255,255,255,0.8); margin-bottom: 1rem; font-weight: 300; }
        .vip-ad-visual img { height: 300px; width: 100%; object-fit: cover; border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,0.4); border: 4px solid rgba(255,255,255,0.1); margin-bottom: 1.5rem;}
        .vip-meta { color: rgba(255,255,255,0.6); font-size: 0.9rem; font-style: italic; display: flex; justify-content: center; gap: 20px; }

        /* === BAGIAN 2: IKLAN GRATIS (SLIDER & CARD LOKAL) === */
        .section-promo { padding: 5rem 0; background-color: #f4f6f9; position: relative; }
        .section-title { font-size: 2rem; font-weight: 700; color: #22374e; margin-bottom: 0.5rem; }
        .promo-card {
            background: white; border-radius: 16px; overflow: hidden; border: 1px solid #e9ecef;
            transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column; position: relative;
        }
        .promo-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: #F39C12; }
        .promo-img-wrapper { height: 180px; overflow: hidden; position: relative; background-color: #e9ecef; }
        .promo-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .promo-card:hover .promo-img { transform: scale(1.05); }
        .promo-content { padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; }
        .promo-title { font-size: 1.1rem; font-weight: 700; color: #212529; margin-bottom: 0.5rem; line-height: 1.3; }
        .promo-company { font-size: 0.9rem; color: #6c757d; margin-bottom: 1rem; }
        .promo-desc { font-size: 0.9rem; color: #495057; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 1rem; flex-grow: 1; }
        .promo-meta { margin-top: auto; font-size: 0.8rem; color: #adb5bd; border-top: 1px solid #f1f1f1; padding-top: 0.8rem; display: flex; justify-content: space-between;}

        /* Locked / Blur */
        .card-blur-content { transition: filter 0.3s ease; }
        .promo-card.locked .card-blur-content { filter: blur(6px); pointer-events: none; user-select: none; }
        .card-lock-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(2px);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            z-index: 10; opacity: 0; transition: all 0.3s ease; pointer-events: none;
        }
        .promo-card.locked .card-lock-overlay { opacity: 1; pointer-events: auto; }
        .lock-icon-card { font-size: 2.5rem; color: #F39C12; margin-bottom: 0.5rem; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.1)); }
        .lock-text-card { font-weight: 700; color: #22374e; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;}

        /* Carousel Controls */
        .carousel-control-prev-dark, .carousel-control-next-dark { width: 5%; filter: invert(1) grayscale(100); opacity: 0.5; }
        .carousel-control-prev-dark:hover, .carousel-control-next-dark:hover { opacity: 1; }
        #promoCarousel .carousel-inner { padding-top: 20px; padding-bottom: 20px; overflow: visible; }
        #promoCarousel { padding: 0 15px; }

        /* === BAGIAN 3: MITRA === */
        .section-mitra { 
            background: linear-gradient(to bottom, #ffffff 0%, #f8f9fa 100%);
            padding: 5rem 0; border-top: 1px solid #e9ecef;
            box-shadow: inset 0 10px 20px -10px rgba(0,0,0,0.05);
        }
        .mitra-title { text-align: center; font-size: 1.1rem; font-weight: 800; color: #22374e; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 4rem; opacity: 0.7; }
        .logo-slide-item { 
            display: flex; justify-content: center; align-items: center; height: 90px; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: grayscale(100%) opacity(0.6); padding: 1rem;
        }
        .logo-slide-item:hover { 
            transform: scale(1.15); filter: grayscale(0%) opacity(1); background: white;
            border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }
        .mitra-logo-img { max-height: 65px; max-width: 100%; object-fit: contain; }

        /* VIP Overlay */
        .blur-effect { filter: blur(8px); pointer-events: none; user-select: none; opacity: 0.5; }
        .locked-overlay-vip { position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 100; }
        .locked-card-vip { background-color: rgba(255, 255, 255, 0.95); padding: 2rem 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); text-align: center; max-width: 90%; }
        .locked-icon-vip { font-size: 3rem; color: #22374e; margin-bottom: 1rem; }
        .locked-title-vip { font-weight: 800; color: #22374e; margin-bottom: 0.5rem; }

        /* Footer */
        footer.footer { background-color: #071b2f !important; color: white !important; padding-top: 4rem; padding-bottom: 2rem; margin-top: 0 !important; }
        footer.footer h6 { color: #F39C12 !important; }
        footer.footer a { color: rgba(255,255,255,0.7) !important; }
        footer.footer a:hover { color: #F39C12 !important; }
        footer.footer .text-white-50 { color: rgba(255,255,255,0.6) !important; }
        .carousel-indicators [data-bs-target] { background-color: white; width: 10px; height: 10px; border-radius: 50%; margin: 0 6px; opacity: 0.5; }
        .carousel-indicators .active { opacity: 1; background-color: #F39C12; }
        @media (max-width: 768px) { .hero-title { font-size: 2.5rem; } .hero-slide-item { padding: 3rem 0; text-align: center; } .hero-img-static { max-height: 250px; margin-top: 2rem; } .vip-ad-title { font-size: 2rem; } }
    </style>
</head>
<body>

    @include('pelamar.partials.navbar')

    {{-- BAGIAN 1: HERO SLIDER --}}
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade animate__animated animate__fadeIn" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner hero-carousel-inner">
                {{-- Slide 1: Intro (Selalu Terbuka) --}}
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

                {{-- Slide 2 dst: Iklan VIP (Locked if Guest) --}}
                @foreach($iklanVip as $iklan)
                <div class="carousel-item hero-slide-item">
                    @guest
                    <div class="locked-overlay-vip">
                        <div class="locked-card-vip animate__animated animate__zoomIn">
                            <i class="bi bi-lock-fill locked-icon-vip"></i>
                            <h3 class="locked-title-vip">Konten Eksklusif</h3>
                            <p class="locked-text-vip mb-3">Login untuk melihat info lowongan VIP ini.</p>
                            
                            {{-- UPDATE: TOMBOL MASUK & DAFTAR --}}
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('login') }}" class="btn btn-orange btn-sm rounded-pill px-4">Masuk</a>
                                <a href="{{ route('register') }}" class="btn btn-outline-orange btn-sm rounded-pill px-4 bg-white">Daftar</a>
                            </div>
                        </div>
                    </div>
                    @endguest
                    <div class="container @guest blur-effect @endguest">
                        <div class="vip-ad-container">
                            <span class="vip-ad-badge"><i class="bi bi-star-fill me-1"></i> VIP</span>
                            <h2 class="vip-ad-title">{{ $iklan->judul }}</h2>
                            <p class="vip-ad-company">Oleh: {{ $iklan->perusahaan->nama_perusahaan }}</p>
                            <div class="vip-ad-visual mb-3">
                                <img src="{{ $iklan->file_iklan_banner ? asset('storage/' . $iklan->file_iklan_banner) : '' }}" 
                                     onerror="this.onerror=null; this.src='https://placehold.co/800x400/34495e/ffffff?text={{ urlencode($iklan->judul) }}';"
                                     alt="Banner Iklan">
                            </div>
                            <div class="text-white mb-3 px-5">{{ $iklan->deskripsi }}</div>
                            <div class="vip-meta">
                                <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($iklan->published_at)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
             <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                @foreach($iklanVip as $index => $iklan)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index + 1 }}"></button>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
        </div>
    </section>

    {{-- BAGIAN 2: IKLAN GRATIS --}}
    <section class="section-promo animate__animated animate__fadeInUp position-relative">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h3 class="section-title">Info & Promo Terbaru</h3>
                <p class="section-desc">Kabar terbaru dari mitra perusahaan kami</p>
            </div>

            @if($iklanGratis->count() > 0)
            <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
                <div class="carousel-inner px-md-5">
                    @foreach($iklanGratis->chunk(4) as $chunkIndex => $iklanChunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row g-4 justify-content-center">
                                @foreach($iklanChunk as $iklan)
                                <div class="col-md-6 col-lg-3">
                                    <div class="promo-card h-100 @guest locked @endguest shadow-sm">
                                        <div class="card-lock-overlay">
                                            <i class="bi bi-lock-fill lock-icon-card animate__animated animate__headShake animate__infinite animate__slower"></i>
                                            <span class="lock-text-card">Konten Terkunci</span>
                                            <small class="text-muted mb-2">Akses terbatas</small>
                                            @guest
                                            <div class="d-flex gap-2 mt-1">
                                                <a href="{{ route('login') }}" class="btn btn-orange btn-sm rounded-pill px-3">Masuk</a>
                                                <a href="{{ route('register') }}" class="btn btn-outline-orange btn-sm rounded-pill px-3 bg-white">Daftar</a>
                                            </div>
                                            @endguest
                                        </div>
                                        <div class="card-blur-content h-100 d-flex flex-column">
                                            <div class="promo-img-wrapper">
                                                <img src="{{ $iklan->file_iklan_banner ? asset('storage/' . $iklan->file_iklan_banner) : '' }}" 
                                                     onerror="this.onerror=null; this.src='https://placehold.co/600x400/f8f9fa/22374e?text={{ urlencode(Str::limit($iklan->judul, 20)) }}';"
                                                     class="promo-img" alt="{{ $iklan->judul }}">
                                            </div>
                                            <div class="promo-content">
                                                <h5 class="promo-title">{{ Str::limit($iklan->judul, 50) }}</h5>
                                                <p class="promo-company">{{ $iklan->perusahaan->nama_perusahaan }}</p>
                                                <p class="promo-desc">{{ Str::limit($iklan->deskripsi, 80) }}</p>
                                                <div class="promo-meta">
                                                    <div><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($iklan->published_at)->format('d M') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($iklanGratis->count() > 4)
                <button class="carousel-control-prev carousel-control-prev-dark" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev" style="width: 4%; margin-left: -1rem;"><span class="carousel-control-prev-icon" aria-hidden="true"></span></button>
                <button class="carousel-control-next carousel-control-next-dark" type="button" data-bs-target="#promoCarousel" data-bs-slide="next" style="width: 4%; margin-right: -1rem;"><span class="carousel-control-next-icon" aria-hidden="true"></span></button>
                @endif
            </div>
            @else
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 shadow-sm border">
                    <i class="bi bi-info-circle display-4 text-muted mb-3"></i>
                    <p class="text-muted">Belum ada info terbaru saat ini.</p>
                </div>
            </div>
            @endif
            
            <div class="text-center mt-5">
                <a href="{{ route('lowongan.index') }}" class="btn btn-outline-orange rounded-pill px-4 py-2">Lihat Semua Lowongan</a>
            </div>
        </div>
    </section>

    {{-- BAGIAN 3: LOGO MITRA --}}
    <section class="section-mitra">
        <div class="container">
            <h5 class="mitra-title">Trusted Partners & Top Companies</h5>
            <div class="swiper-container logo-swiper overflow-hidden py-3">
                <div class="swiper-wrapper align-items-center">
                    @foreach($semuaPerusahaan as $perusahaan)
                        <div class="swiper-slide">
                            <div class="logo-slide-item" title="{{ $perusahaan->nama_perusahaan }}">
                                <img src="{{ asset('storage/' . $perusahaan->logo_perusahaan) }}" alt="{{ $perusahaan->nama_perusahaan }}" class="mitra-logo-img">
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
            slidesPerView: 3, spaceBetween: 40, loop: true, speed: 4000,
            autoplay: { delay: 0, disableOnInteraction: false, pauseOnMouseEnter: true },
            freeMode: true,
            breakpoints: { 640: { slidesPerView: 4 }, 768: { slidesPerView: 5 }, 1024: { slidesPerView: 6 } }
        });
    </script>
</body>
</html>