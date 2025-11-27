@extends('pelamar.layouts.app')

@section('title', 'MESSARI INSIGHT')

@section('content')
{{-- HAPUS FOOTER --}}
<style>footer.footer { display: none !important; }</style>

{{-- 
    =============================================
    1. HERO SECTION (Header + Featured + QUOTE)
    =============================================
--}}
<div class="news-hero-section">
    
    {{-- ELEMEN DEKORASI: TANDA PETIK RAKSASA (The "Anjay Keren" Element) --}}
    <div class="quote-decoration animate__animated animate__fadeInDown">
        <i class="bi bi-quote"></i>
    </div>

    <div class="container h-100 position-relative" style="z-index: 2;">
        <div class="row h-100 align-items-center">
            
            {{-- Bagian Kiri: Judul & Intro --}}
            <div class="col-lg-5 mb-5 mb-lg-0 py-5">
                <div class="animate__animated animate__fadeInLeft">
                    
                    {{-- Badge MESSARI INSIGHT --}}
                    <div class="d-inline-block position-relative mb-3">
                        <span class="badge badge-pill-custom text-uppercase ls-2">
                            <i class="bi bi-lightning-charge-fill text-orange me-1"></i> MESSARI INSIGHT
                        </span>
                    </div>

                    <h1 class="display-4 fw-black text-white mb-4 leading-tight">
                        Wawasan Karir <br>
                        <span class="text-gradient-orange">Masa Depan.</span>
                    </h1>
                    <p class="text-white-50 lead mb-5 pe-lg-5">
                        Temukan strategi karir, tren industri, dan tips wawancara yang dikurasi langsung oleh para ahli.
                    </p>
                    
                    {{-- Search Bar --}}
                    <form action="{{ route('berita.index') }}" method="GET" class="search-header-form shadow-lg">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0 ps-3">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-0 py-3" placeholder="Cari artikel..." value="{{ request('search') }}">
                            <button class="btn btn-orange px-4 fw-bold" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Bagian Kanan: Featured Article (Big Card) --}}
            <div class="col-lg-7 ps-lg-5">
                @if($featured)
                <div class="featured-hero-card position-relative rounded-5 overflow-hidden shadow-2xl animate__animated animate__fadeInRight">
                    <a href="{{ route('berita.show', $featured->slug) }}" class="text-decoration-none">
                        <div class="ratio ratio-16x9">
                            <img src="{{ $featured->gambar ? asset('storage/' . $featured->gambar) : 'https://placehold.co/800x600/1a2c3d/ffffff?text=Featured' }}" 
                                 class="object-fit-cover transition-scale" alt="Featured">
                        </div>
                        {{-- Overlay Gradient Gelap --}}
                        <div class="card-gradient-overlay d-flex flex-column justify-content-end p-4 p-lg-5">
                            <span class="badge bg-orange text-white align-self-start mb-3 rounded-pill px-3 shadow-sm">
                                <i class="bi bi-star-fill me-1"></i> Pilihan Editor
                            </span>
                            <h2 class="text-white fw-bold mb-2 text-shadow-sm">{{ Str::limit($featured->judul, 60) }}</h2>
                            <p class="text-white-50 mb-0 small">
                                {{ \Carbon\Carbon::parse($featured->published_at)->format('d M Y') }} &bull; {{ ceil(str_word_count(strip_tags($featured->isi_berita)) / 200) }} menit baca
                            </p>
                        </div>
                    </a>
                </div>
                @endif
            </div>

        </div>
    </div>
    
    {{-- Background Pattern --}}
    <div class="hero-bg-pattern"></div>
</div>

{{-- 
    =============================================
    2. MAIN CONTENT (List & Sidebar)
    =============================================
--}}
<div class="bg-white py-5 position-relative" style="z-index: 10; margin-top: -30px; border-radius: 40px 40px 0 0; box-shadow: 0 -10px 30px rgba(0,0,0,0.05);">
    <div class="container py-4">
        <div class="row g-5">
            
            {{-- KOLOM KIRI: Daftar Artikel --}}
            <div class="col-lg-8">
                <div class="d-flex align-items-end justify-content-between mb-5">
                    <div>
                        <h6 class="text-uppercase text-orange fw-bold ls-2 mb-2">Terbaru</h6>
                        <h3 class="fw-bold text-dark-blue m-0">Artikel & Berita</h3>
                    </div>
                    <div class="d-none d-md-block h-line flex-grow-1 ms-4 bg-light"></div>
                </div>

                <div class="article-list">
                    @forelse($beritaTerkini as $berita)
                    <div class="card article-row-card border-0 mb-4 group-hover">
                        <div class="row g-0 align-items-center">
                            {{-- Gambar Kecil di Kiri --}}
                            <div class="col-4 col-md-3">
                                <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative">
                                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/400x400/e9ecef/343a40?text=News' }}" 
                                         class="object-fit-cover w-100 h-100 transition-scale" alt="img">
                                </div>
                            </div>
                            
                            {{-- Konten di Kanan --}}
                            <div class="col-8 col-md-9 ps-3 ps-md-4">
                                <div class="card-body p-0">
                                    <div class="mb-2">
                                        @if($berita->kategori)
                                            <span class="text-orange fw-bold small text-uppercase ls-1 me-2">{{ $berita->kategori->nama_kategori }}</span>
                                        @endif
                                        <span class="text-muted small">&bull; {{ \Carbon\Carbon::parse($berita->published_at)->diffForHumans() }}</span>
                                    </div>
                                    <h4 class="card-title fw-bold text-dark-blue mb-2">
                                        <a href="{{ route('berita.show', $berita->slug) }}" class="text-decoration-none text-dark-blue title-hover">
                                            {{ Str::limit($berita->judul, 70) }}
                                        </a>
                                    </h4>
                                    <p class="card-text text-muted small d-none d-md-block line-clamp-2 mb-3">
                                        {{ Str::limit($berita->kutipan, 120) }}
                                    </p>
                                    <a href="{{ route('berita.show', $berita->slug) }}" class="btn-link-custom">
                                        Baca <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 bg-light rounded-4">
                        <i class="bi bi-newspaper display-4 text-muted mb-3 d-block"></i>
                        <span class="text-muted">Belum ada artikel terbaru.</span>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-5">
                    {{ $beritaTerkini->links() }}
                </div>
            </div>

            {{-- KOLOM KANAN: Sidebar Sticky --}}
            <div class="col-lg-4">
                <div class="sticky-sidebar" style="top: 100px;">
                    
                    {{-- Widget: Popular Posts --}}
                    <div class="sidebar-widget p-4 rounded-4 bg-light-gray border border-light">
                        <h5 class="fw-bold text-dark-blue mb-4">
                            <i class="bi bi-graph-up-arrow me-2 text-orange"></i> Sedang Tren
                        </h5>
                        
                        <div class="trending-list">
                            @forelse($beritaTrending as $index => $item)
                            <a href="{{ route('berita.show', $item->slug) }}" class="trending-item d-flex align-items-center text-decoration-none py-3 border-bottom-dashed group-hover">
                                <div class="trending-number me-3">{{ $index + 1 }}</div>
                                <div>
                                    <h6 class="fw-bold text-dark-blue mb-1 fs-6 title-hover">{{ Str::limit($item->judul, 45) }}</h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">{{ \Carbon\Carbon::parse($item->published_at)->format('d M') }}</small>
                                </div>
                            </a>
                            @empty
                            <p class="text-muted small">Belum ada data tren.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Widget: Info Box --}}
                    <div class="mt-4 p-4 rounded-4 bg-dark-blue text-white position-relative overflow-hidden shadow-lg">
                        <div class="position-relative z-1">
                            <h5 class="fw-bold mb-2">Ingin jadi Kontributor?</h5>
                            <p class="small text-white-50 mb-3">Bagikan wawasan karirmu kepada ribuan pencari kerja lainnya.</p>
                            <button class="btn btn-sm btn-outline-light rounded-pill px-3">Hubungi Admin</button>
                        </div>
                        {{-- Dekorasi bulat --}}
                        <div class="circle-decoration"></div>
                        <i class="bi bi-pencil-square position-absolute text-white opacity-10" style="font-size: 5rem; right: -10px; bottom: -20px;"></i>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* === VARIABLES === */
    :root {
        --c-dark-blue: #22374e;
        --c-dark-blue-darker: #1a2c3d;
        --c-orange: #F39C12;
        --c-orange-hover: #e67e22;
        --c-gray-bg: #f8f9fa;
    }

    /* === TYPOGRAPHY & UTILS === */
    .fw-black { font-weight: 900; }
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    .text-dark-blue { color: var(--c-dark-blue) !important; }
    .text-orange { color: var(--c-orange) !important; }
    .bg-dark-blue { background-color: var(--c-dark-blue); }
    .bg-light-gray { background-color: #f8f9fa; }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4); }
    .text-shadow-sm { text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
    
    .text-gradient-orange {
        background: linear-gradient(to right, #F39C12, #ffda79);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* === HERO SECTION & QUOTE === */
    .news-hero-section {
        background-color: var(--c-dark-blue);
        padding-top: 5rem;
        padding-bottom: 6rem; 
        position: relative;
        overflow: hidden;
    }

    /* UPDATE POSISI TANDA PETIK */
    .quote-decoration {
        position: absolute;
        top: 60px; /* SAYA TURUNKAN JAUH (Dari -50px jadi 60px) */
        right: 40px; /* Geser dikit ke kiri biar gak mepet layar */
        z-index: 1;
        pointer-events: none;
        opacity: 0.08;
    }
    
    /* Biar makin estetik, kita kasih sedikit rotasi */
    .quote-decoration i {
        font-size: 25rem;
        line-height: 1;
        color: white;
        font-family: serif;
        display: block;
    }

    /* Badge "MESSARI INSIGHT" */
    .badge-pill-custom {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 0.6rem 1.2rem;
        border-radius: 50px;
        font-weight: 800;
        font-size: 0.85rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    /* Dekorasi Pattern */
    .hero-bg-pattern {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.6;
        pointer-events: none;
    }

    /* Search Form */
    .search-header-form { border-radius: 50px; overflow: hidden; padding: 5px; background: white; }
    .search-header-form .form-control:focus { box-shadow: none; }
    .btn-orange { background-color: var(--c-orange); color: white; border-radius: 50px; transition: all 0.3s; }
    .btn-orange:hover { background-color: var(--c-orange-hover); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4); }

    /* Featured Hero Card */
    .featured-hero-card {
        border: 1px solid rgba(255,255,255,0.1);
        transition: transform 0.3s ease;
        background: var(--c-dark-blue-darker);
    }
    .featured-hero-card:hover { transform: translateY(-8px); }
    .card-gradient-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0) 100%);
    }
    .transition-scale { transition: transform 0.8s ease; }
    .featured-hero-card:hover .transition-scale { transform: scale(1.08); }

    /* === ARTICLE LIST === */
    .article-row-card { background: transparent; transition: all 0.3s ease; }
    .article-row-card:hover .title-hover { color: var(--c-orange) !important; }
    .article-row-card .ratio { box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    
    .btn-link-custom {
        color: var(--c-dark-blue); font-weight: 700; text-decoration: none; font-size: 0.9rem;
        transition: all 0.2s; display: inline-flex; align-items: center;
    }
    .btn-link-custom i { margin-left: 5px; transition: margin 0.2s; }
    .article-row-card:hover .btn-link-custom { color: var(--c-orange); }
    .article-row-card:hover .btn-link-custom i { margin-left: 10px; }

    /* === SIDEBAR === */
    .trending-number {
        font-size: 2.2rem; font-weight: 900; line-height: 1;
        color: rgba(34, 55, 78, 0.1); /* Warna transparan angka */
        min-width: 45px;
        font-style: italic;
    }
    .trending-item:hover .trending-number { color: var(--c-orange); transition: color 0.3s; }
    .border-bottom-dashed { border-bottom: 1px dashed #dee2e6; }
    .border-bottom-dashed:last-child { border-bottom: none; }

    .circle-decoration {
        position: absolute; top: -30px; right: -30px;
        width: 120px; height: 120px; background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    /* === PAGINATION === */
    .pagination .page-item .page-link {
        width: 40px; height: 40px; border-radius: 50%; margin: 0 5px; border: none;
        color: var(--c-dark-blue); display: flex; align-items: center; justify-content: center; font-weight: 600;
        background: #f1f3f5;
    }
    .pagination .page-item.active .page-link {
        background-color: var(--c-orange); color: white; box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3);
    }

    /* RESPONSIVE */
    @media (max-width: 991px) {
        .news-hero-section { padding-bottom: 3rem; text-align: center; }
        .search-header-form { max-width: 500px; margin: 0 auto; }
        .pe-lg-5 { padding-right: 0 !important; }
        .featured-hero-card { margin-top: 3rem; }
        .quote-decoration { display: none; } /* Sembunyikan petik di HP biar gak penuh */
    }
</style>
@endpush