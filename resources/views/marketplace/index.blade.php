<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace - Messari</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8fafc;
        }

        /* Navbar */
        .navbar-marketplace {
            background: linear-gradient(90deg, #0d6efd, #2563eb);
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }
        .navbar-marketplace .navbar-brand {
            font-weight: 700;
            color: #fff;
        }
        .navbar-marketplace .nav-link {
            color: rgba(255,255,255,0.8);
            font-weight: 500;
        }
        .navbar-marketplace .nav-link.active,
        .navbar-marketplace .nav-link:hover {
            color: #fff;
        }

        /* Container */
        .marketplace-container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 2rem 1rem; 
        }

        /* Search & Filters */
        .search-bar .form-control {
            border-radius: 8px 0 0 8px;
            border: 1px solid #dee2e6;
        }
        .search-bar .btn {
            border-radius: 0 8px 8px 0;
        }
        .filter-tabs {
            margin-top: 1.5rem; 
            border-bottom: 2px solid #e5e7eb;
        }
        .filter-tabs ul {
            display: flex;
            gap: 1.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .filter-tabs a {
            padding: 0.75rem 0.25rem;
            text-decoration: none;
            font-weight: 500;
            color: #6b7280;
            border-bottom: 3px solid transparent;
        }
        .filter-tabs a.active,
        .filter-tabs a:hover {
            color: #0d6efd;
            border-bottom-color: #0d6efd;
        }

        /* Product Cards */
        .product-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); 
            gap: 1.5rem; 
            margin-top: 2rem; 
        }
        .product-card { 
            background: #fff;
            border-radius: 12px; 
            overflow: hidden; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); 
            transition: transform 0.2s, box-shadow 0.2s; 
            display: flex; 
            flex-direction: column; 
        }
        .product-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }
        .product-card img { 
            width: 100%; 
            height: 240px; 
            object-fit: cover; 
        }
        .card-content { 
            padding: 1rem; 
            display: flex; 
            flex-direction: column; 
            height: 100%; 
        }
        .card-title { 
            font-size: 1rem; 
            font-weight: 600; 
            margin-bottom: 0.5rem; 
            color: #111827; 
        }
        .card-price { 
            font-size: 1.125rem; 
            font-weight: 700; 
            color: #0d6efd; 
        }
        .card-location { 
            font-size: 0.875rem; 
            color: #6b7280; 
            margin-top: auto; 
        }

        /* Footer */
        .footer-marketplace {
            background: #f1f5f9;
            padding: 1.5rem 0;
            font-size: 0.9rem;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }

        /* Back Button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            margin-bottom: 1rem;
            color: #0d6efd;
            text-decoration: none;
        }
        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-marketplace">
        <div class="container">
            <a class="nav-link {{ Request::routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">MESSARI</a>
            <div>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Marketplace</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="marketplace-container">
            
            {{-- Tombol kembali --}}
            <a href="javascript:history.back()" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <header class="marketplace-header">
                <form action="{{ route('marketplace.index') }}" method="GET" class="search-bar">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari produk..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <nav class="filter-tabs">
                        <ul>
                            <li>
                                <a href="{{ route('marketplace.index', ['sort' => 'latest', 'search' => request('search')]) }}" 
                                   class="{{ !request('sort') || request('sort') == 'latest' ? 'active' : '' }}">
                                   Produk
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('marketplace.index', ['sort' => 'price_asc', 'search' => request('search')]) }}"
                                   class="{{ request('sort') == 'price_asc' ? 'active' : '' }}">
                                   Harga Termurah
                                </a>
                            </li>
                        </ul>
                    </nav>
                </form>
            </header>
        
            <div class="product-grid">
                @forelse ($products as $product)
                    <div class="product-card">
                        <a href="{{ route('marketplace.show', $product) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400/e2e8f0/4299e1?text=Produk' }}" alt="{{ $product->name }}">
                            <div class="card-content">
                                <h3 class="card-title">{{ $product->name }}</h3>
                                <p class="card-price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="card-location">{{ $product->location }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="w-100">
                        <p class="text-center text-muted fs-5 mt-5">Belum ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </main>

    <footer class="footer-marketplace">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Messari Marketplace. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>