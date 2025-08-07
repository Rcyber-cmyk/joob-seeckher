{{-- Simpan sebagai /resources/views/pelamar/berita/index.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Berita Terkini')

@section('content')
<div class="main-content">
    <div class="container py-5">

        {{-- BERITA UTAMA (FEATURED) --}}
        @if($featured)
        <div class="featured-news-card mb-5">
            <div class="row g-0 align-items-center">
                <div class="col-lg-7">
                    {{-- Ganti dengan gambar placeholder jika tidak ada gambar --}}
                    <img src="{{ $featured->gambar ? asset('storage/' . $featured->gambar) : 'https://placehold.co/600x400/e9ecef/343a40?text=Berita' }}" class="img-fluid featured-image" alt="{{ $featured->judul }}">
                </div>
                <div class="col-lg-5">
                    <div class="featured-content">
                        <h1 class="featured-title">{{ $featured->judul }}</h1>
                        <p class="featured-excerpt">{{ $featured->kutipan }}</p>
                        <a href="{{ route('berita.show', $featured->slug) }}" class="btn btn-orange">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row g-5">
            {{-- KOLOM KIRI (DAFTAR BERITA) --}}
            <div class="col-lg-8">
                <h2 class="section-title">Berita Terkini</h2>
                <div class="news-list">
                    @forelse($beritaTerkini as $berita)
                    <div class="news-card">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/300x180/e9ecef/343a40?text=Berita' }}" class="img-fluid news-image" alt="{{ $berita->judul }}">
                            </div>
                            <div class="col-md-8">
                                <div class="news-content">
                                    <h4 class="news-title"><a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a></h4>
                                    <p class="news-excerpt">{{ $berita->kutipan }}</p>
                                    <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-sm btn-outline-orange">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <p>Belum ada berita yang dipublikasikan.</p>
                    </div>
                    @endforelse
                </div>
                
                {{-- Paginasi --}}
                <div class="mt-4">
                    {{ $beritaTerkini->links() }}
                </div>
            </div>

            {{-- KOLOM KANAN (SIDEBAR) --}}
            <div class="col-lg-4">
                {{-- Widget Berita Trending --}}
                <div class="sidebar-widget mb-4">
                    <h5 class="widget-title">Berita Sedang Tren</h5>
                    <ul class="list-group list-group-flush trending-list">
                        @forelse($beritaTrending as $item)
                        <li class="list-group-item">
                            <a href="{{ route('berita.show', $item->slug) }}">{{ $item->judul }}</a>
                        </li>
                        @empty
                        <li class="list-group-item">Tidak ada berita tren.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Widget Kategori --}}
                <div class="sidebar-widget">
                    <h5 class="widget-title">Kategori Berita</h5>
                    <div class="category-widget">
                        @forelse($kategori as $cat)
                        <a href="#" class="category-item">
                            <span>{{ $cat->nama_kategori }}</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        @empty
                        <p class="text-white small">Tidak ada kategori.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .main-content { background-color: #fff; color: #333; }
    .featured-news-card {
        background-color: #f8f9fa;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid #e9ecef;
    }
    .featured-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    .featured-content { padding: 2rem; }
    .featured-title { font-size: 2rem; font-weight: 700; color: #212529; margin-bottom: 1rem; }
    .featured-excerpt { font-size: 1.1rem; color: #6c757d; margin-bottom: 1.5rem; }
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: #fff; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; }
    
    .section-title { font-weight: 700; margin-bottom: 1.5rem; }
    .news-card { margin-bottom: 2rem; }
    .news-image { width: 100%; height: 180px; object-fit: cover; border-radius: 0.5rem; }
    .news-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; }
    .news-title a { color: #212529; text-decoration: none; transition: color 0.2s; }
    .news-title a:hover { color: #F39C12; }
    .news-excerpt { color: #6c757d; font-size: 0.95rem; }
    .btn-outline-orange { color: #F39C12; border-color: #F39C12; }
    .btn-outline-orange:hover { background-color: #F39C12; color: #fff; }

    .sidebar-widget {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        border: 1px solid #e9ecef;
    }
    .widget-title { font-weight: 600; margin-bottom: 1rem; }
    .trending-list .list-group-item {
        background: none;
        border: none;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    .trending-list .list-group-item:last-child { border-bottom: none; }
    .trending-list a { text-decoration: none; color: #333; font-weight: 500; }
    .trending-list a:hover { color: #F39C12; }

    .category-widget { background-color: #F39C12; border-radius: 0.5rem; padding: 0.5rem; }
    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        border-radius: 0.25rem;
        transition: background-color 0.2s;
    }
    .category-item:hover { background-color: rgba(255,255,255,0.1); }
</style>
@endpush
