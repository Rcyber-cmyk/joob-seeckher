<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $product->name }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: #1a202c;
        }

        .product-detail-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 1rem;
        }

        /* Tombol kembali */
        .btn-back {
            display: inline-flex;
            align-items: center;
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: 0.3s;
        }
        .btn-back:hover {
            background-color: #edf2f7;
            text-decoration: none;
        }

        /* Kolom kiri: Gambar */
        .product-image-gallery {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: relative;
        }

        .main-product-image {
            max-width: 100%;
            max-height: 500px;
            object-fit: contain;
            border-radius: 10px;
        }
        
        .gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 1rem;
        }

        .gallery-nav .btn {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 50%;
            width: 42px;
            height: 42px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        /* Kolom kanan: Info produk */
        .product-info {
            padding: 1rem 2rem;
        }

        .product-info h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-info .description {
            font-size: 1rem;
            color: #4a5568;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .price-section .label {
            font-size: 0.8rem;
            color: #a0aec0;
            text-transform: uppercase;
        }
        .price-section .current-price {
            font-size: 1.9rem;
            font-weight: 700;
            color: #2d3748;
        }
        .price-section .original-price {
            font-size: 1.1rem;
            color: #a0aec0;
            text-decoration: line-through;
            margin-left: 0.75rem;
        }

        /* Warna pilihan */
        .color-section .label, 
        .quantity-section .label {
            font-size: 0.8rem;
            color: #a0aec0;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        .color-swatches { 
            display: flex; 
            gap: 0.5rem; 
            margin-bottom: 2rem; 
        }
        .color-swatch {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: 0.2s;
        }
        .color-swatch.active { border-color: #2d3748; }
        .color-swatch.yellow { background-color: #f6e05e; }
        .color-swatch.black { background-color: #2d3748; }
        .color-swatch.blue { background-color: #90cdf4; }
        .color-swatch.gray { background-color: #a0aec0; }
        
        /* Quantity selector */
        .quantity-selector {
            display: flex;
            align-items: center;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            width: fit-content;
            margin-bottom: 2rem;
        }
        .quantity-selector input {
            width: 50px;
            text-align: center;
            border: none;
            font-weight: bold;
        }
        .quantity-selector .btn {
            border: none;
            font-size: 1.2rem;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }

        /* Tombol beli */
        .btn-add-to-cart {
            background-color: #ff7e3d;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .btn-add-to-cart:hover { background-color: #e46d31; }

        .availability {
            font-size: 0.9rem;
            color: #2f855a;
            margin-top: 1rem;
        }

        /* Navigasi bawah */
        .info-nav {
            margin-top: 3rem;
            border-top: 1px solid #e2e8f0;
            padding-top: 1rem;
        }
        .info-nav a {
            text-decoration: none;
            color: #718096;
            font-size: 0.9rem;
            font-weight: 600;
            margin-right: 1.5rem;
        }
        .info-nav a:hover { color: #2d3748; }

        /* Responsif */
        @media (max-width: 768px) {
            .product-info {
                padding: 1rem;
            }
            .product-info h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="product-detail-container">
        
        {{-- Tombol kembali --}}
        <a href="{{ url()->previous() }}" class="btn-back mb-3">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>

        <div class="row g-5">
            {{-- Gambar Produk --}}
            <div class="col-lg-7">
                <div class="product-image-gallery">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/600x600/f8f9fa/ccc?text=Produk' }}" 
                         alt="{{ $product->name }}" class="main-product-image">
                    
                    <div class="gallery-nav d-none d-md-flex">
                        <button class="btn"><i class="bi bi-arrow-left"></i></button>
                        <button class="btn"><i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            {{-- Info Produk --}}
            <div class="col-lg-5">
                <div class="product-info">
                    <h1>{{ strtoupper($product->name) }}</h1>
                    <p class="description">
                        {{ $product->description ?? 'Deskripsi produk tidak tersedia.' }}
                    </p>

                    <div class="price-section mb-4">
                        <div class="label">Harga</div>
                        <span class="current-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="original-price">Rp{{ number_format($product->price * 1.3, 0, ',', '.') }}</span>
                    </div>

                    <div class="color-section">
                        <div class="label">Warna</div>
                        <div class="color-swatches">
                            <span class="color-swatch yellow"></span>
                            <span class="color-swatch black"></span>
                            <span class="color-swatch blue active"></span>
                            <span class="color-swatch gray"></span>
                        </div>
                    </div>

                    <div class="quantity-section">
                        <div class="label">Jumlah</div>
                        <div class="quantity-selector">
                            <button class="btn btn-link text-dark">-</button>
                            <input type="number" value="1" min="1" class="form-control text-center border-0 shadow-none">
                            <button class="btn btn-link text-dark">+</button>
                        </div>
                    </div>

                    <button class="btn btn-add-to-cart">TAMBAHKAN KE KERANJANG</button>
                    <p class="availability"><i class="bi bi-check-circle-fill"></i> Stok tersedia</p>
                    
                    <nav class="info-nav">
                        <a href="#">DETAIL</a>
                        <a href="#">PENGIRIMAN</a>
                        <a href="#">PENGEMBALIAN</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>