<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM MarketPlace</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f9ff;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: white;
            padding: 1rem 0;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: bold;
            color: #0077b6;
        }
        .nav-link {
            color: #495057;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #0077b6;
        }
        .btn-green {
            background-color: #38b000;
            color: white;
            border-radius: 30px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-green:hover {
            background-color: #2d8600;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(to right, #d0f4ff, #ffffff);
            padding: 4rem 0;
        }
        .hero-section h1 {
            font-weight: 800;
            color: #023e8a;
        }
        .hero-buttons .btn {
            border-radius: 30px;
            padding: 0.8rem 2rem;
            font-weight: 600;
        }
        .btn-outline-green {
            border: 2px solid #38b000;
            color: #38b000;
        }
        .btn-outline-green:hover {
            background-color: #38b000;
            color: white;
        }

        /* Produk & Edukasi Cards */
        .product-card, .edukasi-card, .testimoni-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-card:hover, .edukasi-card:hover, .testimoni-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .product-card img {
            height: 150px;
            object-fit: contain;
        }
        .product-card h6 {
            font-weight: 700;
            margin-top: 1rem;
            color: #0077b6;
        }
        .product-card p.price {
            color: #ff7b00;
            font-weight: bold;
        }

        /* Footer */
        .footer {
            background-color: #0077b6;
            color: white;
            padding: 2rem 0;
        }
        .footer a {
            color: #dff6ff;
            text-decoration: none;
        }
        .footer a:hover {
            color: white;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-section {
                text-align: center;
            }
            .hero-section img {
                margin-top: 2rem;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">UMKM MESSARI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kategori Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Edukasi UMKM</a></li>
            </ul>
            <a href="#" class="btn btn-green me-2">Login</a>
            <a href="{{ route('home') }}" class="btn btn-warning me-2">Pelamar</a>
            <a href="{{ route('perusahaan') }}" class="btn btn-warning">Perusahaan</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Dukung UMKM,<br>Majukan Ekonomi<br>Lokal!</h1>
                <div class="hero-buttons mt-4">
                    <a href="#" class="btn btn-dark me-2">Lihat Produk</a>
                    <a href="#" class="btn btn-outline-green">Daftar Jadi Penjual</a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/umkm/logo.png') }}" alt="Ilustrasi UMKM" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Produk & Edukasi -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Produk -->
            <div class="col-lg-6">
                <h3 class="mb-4">Produk Unggulan</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="product-card text-center">
                            <img src="{{ asset('images/umkm/produk1.png') }}" alt="Kerupuk Udang">
                            <h6>Kerupuk Udang</h6>
                            <p class="price">Rp 20.000</p>
                            <p class="text-muted">Bunda Wati</p>
                            <a href="#" class="btn btn-green w-100">Beli Sekarang</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-card text-center">
                            <img src="{{ asset('images/umkm/produk2.png') }}" alt="Gamis Polos">
                            <h6>Gamis Polos</h6>
                            <p class="price">Rp 150.000</p>
                            <p class="text-muted">Toko Sari</p>
                            <a href="#" class="btn btn-green w-100">Beli Sekarang</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-card text-center">
                            <img src="{{ asset('images/umkm/produk3.png') }}" alt="Keranjang Rotan">
                            <h6>Keranjang Rotan</h6>
                            <p class="price">Rp 80.000</p>
                            <p class="text-muted">Kerajinan Nusantara</p>
                            <a href="#" class="btn btn-green w-100">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edukasi -->
            <div class="col-lg-6">
                <h3 class="mb-4">Edukasi & Tips UMKM</h3>
                <div class="edukasi-card">
                    <ul class="list-unstyled">
                        <li><a href="#">Cara Daftar NIB</a></li>
                        <li><a href="#">Tips Meningkatkan Penjualan Online</a></li>
                        <li><a href="#">Cara Mengajukan KUR</a></li>
                    </ul>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-green">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni -->
<section class="py-5">
    <div class="container">
        <h3 class="text-center mb-4">Testimoni Pelanggan</h3>
        <div class="testimoni-card d-flex align-items-center p-4">
            <img src="{{ asset('images/avatar.png') }}" class="rounded-circle me-3" width="80" height="80">
            <div>
                <p class="mb-2">"Produk berkualitas, pelayanan memuaskan, akan belanja lagi!"</p>
                <p class="fw-bold mb-0">- Budi</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">UMKM MARKETPLACE</h5>
                <p class="small">Dukung UMKM, Majukan Ekonomi Lokal!</p>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Menu</h6>
                <ul class="list-unstyled small">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Kategori Produk</a></li>
                    <li><a href="#">Edukasi UMKM</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Contact</h6>
                <ul class="list-unstyled small">
                    <li><i class="bi bi-envelope-fill me-2"></i>hello@ukm.com</li>
                    <li><i class="bi bi-telephone-fill me-2"></i>012-345-6799</li>
                </ul>
                <div class="mt-2">
                    <a href="#"><i class="bi bi-facebook me-3"></i></a>
                    <a href="#"><i class="bi bi-instagram me-3"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
