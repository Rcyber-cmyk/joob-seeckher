@extends('pelamar.layouts.app')

@section('title', 'Berita Terkini')

@section('content')
{{-- HAPUS FOOTER --}}
<style>footer.footer { display: none !important; }</style>

<div class="main-content">
    <div class="container py-5" style="min-height: 100vh;">
        
        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-dark mb-3">Berita & Wawasan</h1>
            <p class="text-muted lead">Update terbaru seputar dunia kerja dan pengembangan karir untukmu.</p>
        </div>

        {{-- BERITA UTAMA (FEATURED) --}}
        @if($featured)
        <div class="featured-news-card mb-5">
            <div class="row g-0">
                <div class="col-lg-6 position-relative overflow-hidden featured-img-col">
                    <img src="{{ $featured->gambar ? asset('storage/' . $featured->gambar) : 'https://placehold.co/600x400/e9ecef/343a40?text=Featured' }}" 
                         class="img-fluid w-100 h-100 object-fit-cover featured-img" alt="{{ $featured->judul }}">
                    <div class="featured-overlay"></div>
                </div>
                <div class="col-lg-6 d-flex align-items-center bg-white">
                    <div class="featured-content p-4 p-lg-5">
                        <span class="badge bg-orange text-white mb-3 px-3 py-2 rounded-pill text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Featured Story</span>
                        <h2 class="featured-title mb-3"><a href="{{ route('berita.show', $featured->slug) }}" class="text-dark text-decoration-none">{{ $featured->judul }}</a></h2>
                        <p class="featured-excerpt text-muted mb-4">{{ Str::limit($featured->kutipan, 150) }}</p>
                        <a href="{{ route('berita.show', $featured->slug) }}" class="btn btn-outline-dark rounded-pill px-4">Baca Artikel <i class="bi bi-arrow-right ms-2"></i></a>
                        <div class="mt-4 text-muted small border-top pt-3">
                            <i class="bi bi-calendar3 me-2"></i> {{ \Carbon\Carbon::parse($featured->published_at)->format('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row g-5">
            {{-- KOLOM KIRI (DAFTAR BERITA GRID) --}}
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h4 class="fw-bold m-0">Artikel Terbaru</h4>
                </div>

                <div class="row g-4">
                    @forelse($beritaTerkini as $berita)
                    <div class="col-md-6">
                        <div class="news-card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                            <a href="{{ route('berita.show', $berita->slug) }}" class="text-decoration-none">
                                <div class="news-img-wrapper position-relative">
                                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/400x250/e9ecef/343a40?text=News' }}" 
                                         class="card-img-top object-fit-cover" alt="{{ $berita->judul }}" style="height: 220px;">
                                    <div class="category-badge position-absolute top-0 end-0 m-3 bg-white text-dark px-3 py-1 rounded-pill shadow-sm small fw-bold">
                                        {{ $berita->kategori->nama_kategori ?? 'Umum' }}
                                    </div>
                                </div>
                                <div class="card-body p-4 d-flex flex-column h-100">
                                    <small class="text-muted mb-2 d-block"><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($berita->published_at)->diffForHumans() }}</small>
                                    <h5 class="card-title fw-bold text-dark mb-3">{{ Str::limit($berita->judul, 60) }}</h5>
                                    <p class="card-text text-secondary small mb-4 flex-grow-1">{{ Str::limit($berita->kutipan, 90) }}</p>
                                    <span class="text-orange fw-bold small mt-auto">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <img src="{{ asset('images/empty-state.svg') }}" alt="Empty" style="width: 150px; opacity: 0.5;" class="mb-3">
                        <p class="text-muted">Belum ada berita terbaru.</p>
                    </div>
                    @endforelse
                </div>
                
                {{-- Paginasi --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $beritaTerkini->links() }}
                </div>
            </div>

            {{-- KOLOM KANAN (SIDEBAR MODERN) --}}
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px; z-index: 1;">
                    
                    {{-- Widget Trending --}}
                    <div class="sidebar-widget bg-white p-4 rounded-4 shadow-sm border-0 mb-4">
                        <h6 class="widget-title fw-bold text-uppercase text-muted small mb-4 letter-spacing-1">Sedang Tren</h6>
                        <div class="trending-list">
                            @forelse($beritaTrending as $index => $item)
                            <a href="{{ route('berita.show', $item->slug) }}" class="d-flex align-items-start text-decoration-none mb-3 pb-3 border-bottom last-no-border">
                                <span class="fw-bold text-orange fs-4 me-3" style="line-height: 1;">0{{ $index + 1 }}</span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">{{ $item->judul }}</h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">{{ \Carbon\Carbon::parse($item->published_at)->format('d M') }}</small>
                                </div>
                            </a>
                            @empty
                            <p class="text-muted small">Tidak ada berita tren.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Widget Kategori --}}
                    <div class="sidebar-widget bg-white p-4 rounded-4 shadow-sm border-0">
                        <h6 class="widget-title fw-bold text-uppercase text-muted small mb-4 letter-spacing-1">Jelajahi Topik</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($kategori as $cat)
                            <a href="#" class="badge bg-light text-dark border text-decoration-none px-3 py-2 rounded-pill fw-normal hover-orange transition">
                                {{ $cat->nama_kategori }}
                            </a>
                            @empty
                            <p class="text-muted small">Tidak ada kategori.</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .main-content { background-color: #f8f9fa; }
    
    /* Featured Card */
    .featured-news-card { 
        border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        transition: transform 0.3s; border: 1px solid rgba(0,0,0,0.05);
    }
    .featured-news-card:hover { transform: translateY(-5px); }
    .featured-title { font-size: 2rem; font-weight: 800; line-height: 1.2; }
    .featured-img-col { min-height: 400px; }
    
    /* News Card */
    .news-card { transition: transform 0.3s, box-shadow 0.3s; border: 1px solid rgba(0,0,0,0.03) !important; }
    .news-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important; }
    .news-card a:hover .card-title { color: #F39C12 !important; transition: color 0.2s; }
    
    /* Sidebar */
    .last-no-border:last-child { border-bottom: none !important; margin-bottom: 0 !important; padding-bottom: 0 !important; }
    .hover-orange:hover { background-color: #F39C12 !important; color: white !important; border-color: #F39C12 !important; }
    .transition { transition: all 0.2s ease; }
    
    /* Colors */
    .text-orange { color: #F39C12 !important; }
    .bg-orange { background-color: #F39C12 !important; }
    .btn-outline-dark:hover { background-color: #212529; color: white; }
    
    /* Pagination Style */
    .pagination .page-link { color: #333; border: none; margin: 0 5px; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; }
    .pagination .active .page-link { background-color: #F39C12; color: white; font-weight: bold; }
</style>
@endpush