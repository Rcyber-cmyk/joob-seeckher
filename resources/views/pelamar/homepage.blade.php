<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messari - Portal Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #22374e;
            color: white;
            overflow-x: hidden;
        }
        .navbar { padding: 1rem 0; z-index: 1000; position: relative; }
        .navbar-brand { font-weight: bold; font-size: 1.5rem; letter-spacing: 2px; }
        .navbar-nav .nav-link { margin-right: 1rem; color: white; }
        .navbar-nav .nav-link:hover { color: #ff7b00; }
        .navbar-nav .highlight-text { color: #ff7b00 !important; }
        .offcanvas-header { background-color: #22374e; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .offcanvas-title { color: white; font-weight: bold; }
        .offcanvas-body { background-color: #22374e; color: white; padding-top: 1rem; display: flex; flex-direction: column; }
        .offcanvas-body .navbar-nav { width: 100%; margin-left: 0; flex-grow: 1; }
        .offcanvas-body .navbar-nav .nav-item { width: 100%; text-align: left; margin-bottom: 0.5rem; }
        .offcanvas-body .navbar-nav .nav-link { padding: 0.75rem 1rem; border-radius: 5px; transition: background-color 0.3s ease; }
        .offcanvas-body .navbar-nav .nav-link:hover { background-color: rgba(255,255,255,0.1); }
        .offcanvas-buttons { margin-top: 1.5rem; width: 100%; display: flex; flex-direction: column; gap: 0.5rem; }
        .offcanvas-buttons .btn { width: 100%; }
        @media (max-width: 991.98px) {
            .navbar .ms-auto { display: none !important; }
        }
        .hero-section { padding: 4rem 0; text-align: left; }
        .hero-section h1 { font-size: 3rem; font-weight: 800; line-height: 1.3; }
        .hero-section p { font-size: 1.2rem; }
        .btn-orange { background-color: #ff7b00; color: white; padding: 0.6rem 1.5rem; border: none; border-radius: 5px; transition: all 0.3s; }
        .btn-orange:hover { background-color: #ff8c1a; color: white; }
        .btn-outline-light { padding: 0.6rem 1.5rem; }
        .hero-img { max-height: 500px; filter: drop-shadow(0 0 15px rgba(255,123,0,0.5)); }
        @media (max-width: 767.98px) {
            .hero-section { min-height: 100vh; padding: 2rem 1rem; display: flex; flex-direction: column; justify-content: center; align-items: center; }
            .hero-section .container { display: flex; flex-direction: column; width: 100%; align-items: center; }
            .hero-section .row { width: 100%; display: flex; flex-direction: row !important; flex-wrap: nowrap !important; justify-content: flex-start !important; align-items: center !important; }
            .hero-section .col-md-6 { flex: 0 0 50% !important; max-width: 50% !important; margin-bottom: 0 !important; }
            .hero-section .col-md-6:first-child { text-align: left !important; display: flex; flex-direction: column; align-items: flex-start !important; justify-content: center; }
            .hero-section .col-md-6.text-center { margin-top: 0 !important; text-align: center !important; display: flex; flex-direction: column; align-items: center !important; justify-content: center; }
            .hero-section h1 { font-size: 1.5rem; }
            .hero-section p { font-size: 1rem; }
            .hero-img { max-width: 250px; }
            .hero-section .mt-3 { display: flex; flex-direction: row !important; flex-wrap: nowrap !important; justify-content: flex-start !important; gap: 1rem !important; width: auto !important; }
            .hero-section .mt-3 .btn { width: auto !important; margin: 0 !important; }
        }
        #beritaTerkiniLandingPage { position: relative; height: 80vh; min-height: 500px; background-color: #22374e; color: white; overflow: hidden; }
        #beritaTerkiniLandingPage .carousel-inner, #beritaTerkiniLandingPage .carousel-item { height: 100%; position: relative; }
        #beritaTerkiniLandingPage .carousel-item img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; }
        #beritaTerkiniLandingPage .carousel-item::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); z-index: 2; }
        #beritaTerkiniLandingPage .berita-content-landing { position: relative; z-index: 3; text-align: center; max-width: 900px; padding: 1rem 2rem; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%; margin: auto; }
        #beritaTerkiniLandingPage .berita-content-landing h2 { font-size: 3.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 1.5rem; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
        #beritaTerkiniLandingPage .berita-content-landing p { font-size: 1.5rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9); text-shadow: 1px 1px 2px rgba(0,0,0,0.5); }
        #beritaTerkiniLandingPage .berita-content-landing .btn-berita-landing { background-color: #ff7b00; color: white; padding: 0.8rem 2rem; border: none; border-radius: 5px; font-size: 1.1rem; font-weight: bold; transition: all 0.3s; text-decoration: none; }
        #beritaTerkiniLandingPage .berita-content-landing .btn-berita-landing:hover { background-color: #ff8c1a; }
        #beritaTerkiniLandingPage .carousel-control-prev, #beritaTerkiniLandingPage .carousel-control-next { z-index: 4; }
        #beritaTerkiniLandingPage .carousel-indicators { z-index: 4; bottom: 20px; }
        @media (max-width: 991.98px) {
            #beritaTerkiniLandingPage { height: 60vh; min-height: 400px; }
            #beritaTerkiniLandingPage .berita-content-landing h2 { font-size: 2.2rem; }
            #beritaTerkiniLandingPage .berita-content-landing p { font-size: 1.1rem; }
            #beritaTerkiniLandingPage .berita-content-landing .btn-berita-landing { padding: 0.6rem 1.2rem; font-size: 1rem; }
        }
        @media (max-width: 767.98px) {
            #beritaTerkiniLandingPage { height: 50vh; min-height: 350px; }
            #beritaTerkiniLandingPage .berita-content-landing h2 { font-size: 1.8rem; }
            #beritaTerkiniLandingPage .berita-content-landing p { font-size: 0.9rem; }
            #beritaTerkiniLandingPage .berita-content-landing .btn-berita-landing { padding: 0.5rem 1rem; font-size: 0.9rem; }
        }
        .main-content { background: white; color: black; padding-top: 2rem; padding-bottom: 4rem; }
        .main-content h4 { color: #ff7b00; font-weight: bold; }
        .main-content h4 img { vertical-align: middle; }
        @media (max-width: 767.98px) {
            .main-content .container { padding-left: 1rem; padding-right: 1rem; }
            .main-content h4 { font-size: 1.4rem; text-align: center; justify-content: center !important; }
            .main-content h4 img { height: 40px !important; }
        }
        .section-perusahaan-partner .card { border: none; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); height: 100%; overflow: hidden; background-color: white; }
        .section-perusahaan-partner .card .card-img-top { height: 200px; object-fit: cover; transition: transform 0.3s ease; }
        .section-perusahaan-partner .card:hover .card-img-top { transform: scale(1.05); }
        .section-perusahaan-partner .card-body { color: black; }
        .section-perusahaan-partner .card-body h6 { color: #ff7b00; font-weight: bold; }
        .section-perusahaan-partner .card-body p { color: #666; }
        @media (max-width: 767.98px) {
            .section-perusahaan-partner .row { flex-wrap: nowrap !important; overflow-x: auto; justify-content: flex-start !important; }
            .section-perusahaan-partner .col-4 { flex: 0 0 33.33% !important; max-width: 33.33% !important; }
        }
        .section-rekomendasi { background: #fff; color: #000; padding: 2rem 0 4rem; }
        .job-listing-card { border: 1px solid #e0e0e0; border-radius: 10px; padding: 1.5rem; height: 100%; display: flex; flex-direction: column; justify-content: space-between; transition: box-shadow 0.3s ease, border-color 0.3s ease; background-color: #fff; }
        .job-listing-card:hover { box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); border-color: #ff7b00; }
        .job-listing-card .company-info { display: flex; align-items: center; margin-bottom: 1rem; }
        .job-listing-card .company-logo { width: 50px; height: 50px; object-fit: contain; margin-right: 1rem; border-radius: 5px; }
        .job-listing-card .company-details h6 { font-size: 1.1rem; font-weight: bold; margin-bottom: 0.2rem; color: #22374e; }
        .job-listing-card .company-details p { font-size: 0.9rem; color: #666; margin-bottom: 0; }
        .job-listing-card .location { font-size: 0.9rem; color: #888; margin-bottom: 1rem; display: flex; align-items: center; }
        .job-listing-card .location i { margin-right: 0.5rem; color: #ff7b00; }
        .job-listing-card .description { font-size: 0.95rem; line-height: 1.5; color: #444; margin-bottom: 1.5rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; }
        .job-listing-card .btn-lihat-detail { background-color: #ff7b00; color: white; padding: 0.5rem 1.2rem; border: none; border-radius: 5px; font-size: 0.9rem; text-decoration: none; align-self: flex-start; transition: background-color 0.3s ease; }
        .job-listing-card .btn-lihat-detail:hover { background-color: #ff8c1a; color: white; }
        @media (max-width: 767.98px) {
            .section-rekomendasi .row { flex-wrap: nowrap !important; overflow-x: auto; justify-content: flex-start !important; }
            .section-rekomendasi .col-6 { flex: 0 0 50% !important; max-width: 50% !important; }
        }
        footer.footer { background-color: #071b2f; color: white; width: 100%; padding: 4rem 0; }
        footer.footer ul { list-style-type: none; padding-left: 0; }
        footer.footer .text-white-50 { color: rgba(255, 255, 255, 0.5); }
        footer.footer a { color: #ff7b00; text-decoration: none; transition: text-decoration 0.3s ease; }
        footer.footer a:hover { text-decoration: underline; }
        footer.footer .col-lg-4 img { max-height: 300px; object-fit: contain; filter: drop-shadow(0 0 10px rgba(0,0,0,0.3)); }
        @media (max-width: 991.98px) {
            footer.footer .row.align-items-center { flex-wrap: nowrap !important; overflow-x: auto; justify-content: flex-start !important; padding-bottom: 2rem; }
            footer.footer .col-8, footer.footer .col-4 { flex: 0 0 auto !important; max-width: none !important; width: auto !important; text-align: left !important; margin-bottom: 0 !important; padding-right: 1rem; padding-left: 1rem; }
            footer.footer .col-4 img { margin-left: 2rem; }
            footer.footer .col-8 .row { flex-wrap: nowrap !important; overflow-x: auto; justify-content: flex-start !important; }
            footer.footer .col-8 .col-4 { flex: 0 0 33.33% !important; max-width: 33.33% !important; text-align: left !important; margin-bottom: 0 !important; padding-right: 1rem; padding-left: 1rem; }
        }
        #loginRequiredModal .modal-content { background-color: #ffffff; color: #212529; border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
        #loginRequiredModal .modal-header { border-bottom: none; padding: 2rem 2rem 0rem 2rem; flex-direction: column; align-items: center; }
        #loginRequiredModal .modal-header .modal-logo { display: none; }
        #loginRequiredModal .modal-header i.bi-lock-fill { font-size: 3rem; color: #ff7b00; margin-bottom: 1rem; }
        #loginRequiredModal .modal-title { color: #212529 !important; font-weight: bold; font-size: 1.8rem; text-align: center; width: 100%; }
        #loginRequiredModal .btn-close { filter: none; position: absolute; top: 15px; right: 15px; }
        #loginRequiredModal .modal-body { color: #495057 !important; padding: 1rem 2rem 1.5rem 2rem; font-size: 1.05rem; text-align: center; }
        #loginRequiredModal .modal-footer { border-top: none; padding: 0rem 2rem 2rem 2rem; justify-content: center; flex-direction: column; gap: 10px; }
        #loginRequiredModal .modal-footer .btn { width: 100%; max-width: 250px; padding: 0.8rem 1.5rem; font-size: 1rem; font-weight: 600; border-radius: 8px; text-decoration: none; }
        #loginRequiredModal .modal-footer .btn-primary-custom { background-color: #ff7b00; border-color: #ff7b00; color: white; }
        #loginRequiredModal .modal-footer .btn-primary-custom:hover { background-color: #ff8c1a; border-color: #ff8c1a; color: white; }
        #loginRequiredModal .modal-footer .btn-outline-primary-custom { background-color: transparent; border-color: #ff7b00; color: #ff7b00; }
        #loginRequiredModal .modal-footer .btn-outline-primary-custom:hover { background-color: #ff7b00; border-color: #ff7b00; color: white; }
    </style>
</head>
<body>
    @include('pelamar.partials.navbar')

    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h1>TEMPAT SOLUSI <br> ANDA CARI KERJA <br> DISINI</h1>
                    <div class="mt-3">
                        @auth
                            <a href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.dashboard') : (Auth::user()->role === 'perusahaan' ? route('perusahaan.dashboard') : route('admin.dashboard')) }}" class="btn btn-orange">Buka Dashboard</a>
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
            <div class="carousel-item active">
                <img src="{{ asset('images/gojek.png') }}" alt="Prospek Pekerjaan GOJEK">
                <div class="berita-content-landing">
                    <h2>Prospek Pekerjaan GOJEK<br>Beserta Gajinya</h2>
                    <p>Temukan peluang karir menarik di ekosistem Gojek yang dinamis, mulai dari teknologi hingga operasional.</p>
                    @auth
                        <a href="{{ route('berita.index') }}" class="btn-berita-landing">Cari Tau Selengkapnya</a>
                    @else
                        <a href="{{ route('berita.index') }}" class="btn-berita-landing" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Cari Tau Selengkapnya</a>
                    @endauth
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/event.jpg') }}" alt="Mari Bekerja Event">
                <div class="berita-content-landing">
                    <h2>Mari Bekerja <br>Dapatkan Sebuah Keseruan dengan para pengusaha</h2>
                    <p>Jelajahi berbagai event dan pameran karir untuk bertemu langsung dengan calon atasan Anda.</p>
                    @auth
                        <a href="{{ route('berita.index') }}" class="btn-berita-landing">Cari Tahu Selengkapnya</a>
                    @else
                        <a href="{{ route('berita.index') }}" class="btn-berita-landing" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Cari Tahu Selengkapnya</a>
                    @endauth
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/webinar.jpg') }}" alt="Webinar Inovasi Digital">
                <div class="berita-content-landing">
                    <h2>Inovasi Digital <br>Membuka Peluang Karir Baru</h2>
                    <p>Ikuti webinar terbaru kami untuk menambah wawasan di dunia ekonomi digital dan temukan jalur karir yang inovatif.</p>
                    @auth
                        <a href="{{ route('berita.index') }}" class="btn-berita-landing">Baca Selengkapnya</a>
                    @else
                        <a href="{{ route('berita.index') }}" class="btn-berita-landing" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Baca Selengkapnya</a>
                    @endauth
                </div>
            </div>
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
            <h4 class="fw-bold mb-4 mt-5 d-flex align-items-center">JELAJAHI PERUSAHAAN</h4>
            <div class="row g-4 section-perusahaan-partner">
                <div class="col-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <img src="{{ asset('images/ruangguru.png') }}" class="card-img-top" alt="Ruangguru Logo">
                        <div class="card-body">
                            <h6 class="fw-bold">RUANG GURU</h6>
                            <p class="mb-0 text-muted small">Inilah yg ditawarkan oleh ruang guru sekarang</p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <img src="{{ asset('images/tokopedia.png') }}" class="card-img-top" alt="Tokopedia Logo">
                        <div class="card-body">
                            <h6 class="fw-bold">TOKOPEDIA</h6>
                            <p class="mb-0 text-muted small">Perusahaan e-commerce buatan lokal</p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <img src="{{ asset('images/alfamart.png') }}" class="card-img-top" alt="Alfamart Logo">
                        <div class="card-body">
                            <h6 class="fw-bold">ALFAMART</h6>
                            <p class="mb-0 text-muted small">Sebuah perusahaan perdagangan retail</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end mt-4">
                @auth
                    <a href="{{ route('lowongan.index') }}" class="text-dark fw-semibold text-decoration-none">LIHAT SELENGKAPNYA →</a>
                @else
                    <a href="{{ route('lowongan.index') }}" class="text-dark fw-semibold text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">LIHAT SELENGKAPNYA →</a>
                @endauth
            </div>

            <br><br>
            <h4 class="fw-bold mb-4 mt-5">Rekomendasi Pekerjaan Untukmu</h4>
            <div class="row g-4">
                <div class="col-6">
                    <div class="job-listing-card">
                        <div class="company-info">
                            <img src="{{ asset('images/nestle.png') }}" alt="Nestle Logo" class="company-logo">
                            <div class="company-details">
                                <h6>Supply Chain</h6>
                                <p>PT Nestle Indonesia</p>
                            </div>
                        </div>
                        <div class="location"><i class="bi bi-geo-alt-fill"></i><span>Kota Jakarta</span></div>
                        <div class="description">Jaringan yang menghubungkan berbagai pihak, mulai dari pemasok bahan baku hingga konsumen akhir, untuk memproduksi dan mendistribusikan suatu produk atau layanan.</div>
                        @auth
                            <a href="#" class="btn-lihat-detail">Lihat Detail</a>
                        @else
                            <a href="#" class="btn-lihat-detail" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Lihat Detail</a>
                        @endauth
                    </div>
                </div>
                <div class="col-6">
                    <div class="job-listing-card">
                        <div class="company-info">
                            <img src="{{ asset('images/alfamart.png') }}" alt="Alfamart Logo" class="company-logo">
                            <div class="company-details">
                                <h6>Asisten Kepala Toko</h6>
                                <p>PT Alfamart</p>
                            </div>
                        </div>
                        <div class="location"><i class="bi bi-geo-alt-fill"></i><span>Kota Semarang</span></div>
                        <div class="description">Membantu kepala toko dalam mengelola operasional toko, memastikan kepuasan pelanggan, dan menjaga ketersediaan stok barang.</div>
                        @auth
                            <a href="#" class="btn-lihat-detail">Lihat Detail</a>
                        @else
                            <a href="#" class="btn-lihat-detail" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Lihat Detail</a>
                        @endauth
                    </div>
                </div>
                <div class="col-6">
                    <div class="job-listing-card">
                        <div class="company-info">
                            <img src="{{ asset('images/bca.png') }}" alt="BCA Logo" class="company-logo">
                            <div class="company-details">
                                <h6>Asisten Kepala Toko</h6>
                                <p>PT Bank Central Asia</p>
                            </div>
                        </div>
                        <div class="location"><i class="bi bi-geo-alt-fill"></i><span>Kota Bandung</span></div>
                        <div class="description">Petugas bank yang berada di garis depan dalam melayani nasabah untuk berbagai transaksi keuangan.</div>
                        @auth
                            <a href="#" class="btn-lihat-detail">Lihat Detail</a>
                        @else
                            <a href="#" class="btn-lihat-detail" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Lihat Detail</a>
                        @endauth
                    </div>
                </div>
                <div class="col-6">
                    <div class="job-listing-card">
                        <div class="company-info">
                            <img src="{{ asset('images/telkom.png') }}" alt="Telkom Logo" class="company-logo">
                            <div class="company-details">
                                <h6>Product Designer</h6>
                                <p>PT Telkom Indonesia</p>
                            </div>
                        </div>
                        <div class="location"><i class="bi bi-geo-alt-fill"></i><span>Kota Semarang</span></div>
                        <div class="description">Membutuhkan keahlian dalam merancang pengalaman pengguna yang baik serta kolaborasi dengan tim lain untuk mewujudkan desain yang inovatif.</div>
                        @auth
                            <a href="#" class="btn-lihat-detail">Lihat Detail</a>
                        @else
                            <a href="#" class="btn-lihat-detail" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Lihat Detail</a>
                        @endauth
                    </div>
                </div>
                <div class="col-6">
                    <div class="job-listing-card">
                        <div class="company-info">
                            <img src="{{ asset('images/berita terkini/pertamina.png') }}" alt="Pertamina Logo" class="company-logo">
                            <div class="company-details">
                                <h6>Driver Truk</h6>
                                <p>PT Pertamina</p>
                            </div>
                        </div>
                        <div class="location"><i class="bi bi-geo-alt-fill"></i><span>Kota Bandung</span></div>
                        <div class="description">Mengantarkan bahan bakar minyak sampai ke spbu dengan aman dan terkendali.</div>
                        @auth
                            <a href="#" class="btn-lihat-detail">Lihat Detail</a>
                        @else
                            <a href="#" class="btn-lihat-detail" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Lihat Detail</a>
                        @endauth
                    </div>
                </div>
                <div class="col-6">
                    <div class="job-listing-card">
                        <div class="company-info">
                            <img src="{{ asset('images/indomaret.png') }}" alt="Indomaret" class="company-logo">
                            <div class="company-details">
                                <h6>Manajemen Keuangan</h6>
                                <p>PT Indomaret</p>
                            </div>
                        </div>
                        <div class="location"><i class="bi bi-geo-alt-fill"></i><span>Kota Semarang</span></div>
                        <div class="description">Membutuhkan keahlian dalam manajemen keuangan.</div>
                        @auth
                            <a href="#" class="btn-lihat-detail">Lihat Detail</a>
                        @else
                            <a href="#" class="btn-lihat-detail" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">Lihat Detail</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="fw-bold mb-4">SEGERA TEMUKAN <br>PEKERJAAN MU</h3>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <h6 class="fw-semibold">Tentang website</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Kontak Kami</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Bergabung Sebagai Konsultan</a></li>
                            </ul>
                        </div>
                        <div class="col-4 mb-3">
                            <h6 class="fw-semibold">Untuk Pencari Kerja</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white-50 text-decoration-none">Lowongan</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Pameran Lowongan</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Pameran Lowongan Disabilitas</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">Rekomendasi Lowongan</a></li>
                                <li><a href="#" class="text-white-50 text-decoration-none">FAQ untuk Pencari Kerja</a></li>
                            </ul>
                        </div>
                        <div class="col-4 mb-3">
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
                <div class="col-4 text-center">
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
</body>
</html>