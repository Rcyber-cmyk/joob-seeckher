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
    /* --- Base Styling --- */
    .main-content { background-color: #f8f9fa; /* Background sedikit abu-abu */ color: #333; }
    .section-title { font-weight: 700; margin-bottom: 2rem; color: #343a40; } /* Judul section lebih jelas */

    /* --- Featured News Card --- */
    .featured-news-card {
        background-color: #ffffff; /* Background putih */
        border-radius: 0.75rem; /* Sudut lebih tumpul */
        overflow: hidden;
        border: none; /* Hilangkan border */
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.075); /* Shadow halus */
        transition: transform 0.2s ease-in-out;
    }
    .featured-news-card:hover {
         transform: translateY(-5px); /* Efek angkat saat hover */
    }
    .featured-image {
        width: 100%;
        height: 100%; /* Biar mengisi penuh kolom kiri */
        min-height: 350px; /* Tinggi minimum */
        object-fit: cover;
    }
    .featured-content { 
        padding: 2.5rem; /* Padding lebih besar */
        display: flex; /* Aktifkan flexbox */
        flex-direction: column; /* Susun vertikal */
        justify-content: center; /* Tengah secara vertikal */
        height: 100%; /* Isi penuh tinggi kartu */
    }
    .featured-title { 
        font-size: 1.8rem; /* Ukuran disesuaikan */ 
        font-weight: 700; 
        color: #212529; 
        margin-bottom: 1rem; 
        line-height: 1.3; /* Spasi antar baris judul */
    }
    .featured-excerpt { 
        font-size: 1rem; /* Ukuran disesuaikan */ 
        color: #6c757d; 
        margin-bottom: 1.5rem; 
        line-height: 1.6; /* Spasi antar baris */
    }
    /* Style Tombol (sudah konsisten) */
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: #fff; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; }
    
    /* --- News List Card --- */
    .news-card { 
        margin-bottom: 2rem; 
        background-color: #ffffff;
        border-radius: 0.75rem;
        overflow: hidden;
        border: 1px solid #dee2e6; /* Border halus */
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,.05);
        transition: box-shadow 0.2s, transform 0.2s;
    }
     .news-card:hover { 
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.1); 
    }
    .news-image { 
        width: 100%; 
        height: 200px; /* Tinggi gambar dibuat konsisten */ 
        object-fit: cover; 
    }
    .news-content { padding: 1.5rem; } /* Padding di dalam konten teks */
    .news-title { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; line-height: 1.4; }
    .news-title a { color: #212529; text-decoration: none; transition: color 0.2s; }
    .news-title a:hover { color: #F39C12; }
    .news-excerpt { color: #6c757d; font-size: 0.95rem; margin-bottom: 1rem; line-height: 1.6; } /* Margin bawah ditambah */
    .btn-outline-orange { 
        color: #F39C12; 
        border-color: #F39C12; 
        font-weight: 500; /* Font sedikit tebal */
    }
    .btn-outline-orange:hover { background-color: #F39C12; color: #fff; }

    /* --- Sidebar Widget --- */
    .sidebar-widget {
        background-color: #ffffff; /* Background putih */
        padding: 1.5rem;
        border-radius: 0.75rem; /* Radius disamakan */
        border: 1px solid #dee2e6; /* Border halus */
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,.05); /* Shadow halus */
    }
    .widget-title { font-weight: 700; /* Judul widget lebih tebal */ margin-bottom: 1.25rem; color: #343a40; }
    
    /* Sidebar Trending */
    .trending-list .list-group-item {
        background: none;
        border: none;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    .trending-list .list-group-item:last-child { border-bottom: none; padding-bottom: 0; }
    .trending-list a { text-decoration: none; color: #333; font-weight: 500; }
    .trending-list a:hover { color: #F39C12; }

    /* Sidebar Kategori (diubah) */
    .category-widget { /* Hapus background oranye */ }
    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 1rem; /* Padding disesuaikan */
        color: #333; /* Warna teks biasa */
        background-color: #f8f9fa; /* Background abu-abu */
        text-decoration: none;
        font-weight: 500;
        border-radius: 0.5rem; /* Sudut lebih tumpul */
        margin-bottom: 0.5rem; /* Jarak antar item */
        transition: background-color 0.2s, color 0.2s;
    }
    .category-item:last-child { margin-bottom: 0; }
    .category-item:hover { 
        background-color: #F39C12; /* Background jadi oranye saat hover */
        color: #fff; /* Teks jadi putih */
    }
    .category-item i { transition: transform 0.2s; }
    .category-item:hover i { transform: translateX(3px); } /* Efek panah bergerak */

    /* Pagination Styling (jika perlu disesuaikan) */
    .pagination .page-item.active .page-link {
        background-color: #F39C12;
        border-color: #F39C12;
    }
    .pagination .page-link {
        color: #F39C12;
    }
    .pagination .page-link:hover {
        color: #d8890b;
    }

</style>
@endpush