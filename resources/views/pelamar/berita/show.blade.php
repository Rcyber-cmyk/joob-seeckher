{{-- Simpan sebagai /resources/views/pelamar/berita/show.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9"> {{-- Kolom sedikit lebih lebar --}}
                
                {{-- Header Artikel --}}
                <div class="article-header mb-4">
                    <h1>{{ $berita->judul }}</h1>
                    <p class="article-meta">
                        Dipublikasikan pada: {{ \Carbon\Carbon::parse($berita->published_at)->isoFormat('dddd, D MMMM YYYY') }} 
                        {{-- Format tanggal lebih lengkap --}}
                        @if($berita->kategori) {{-- Tampilkan kategori jika ada --}}
                            | Kategori: <a href="#" class="text-decoration-none fw-medium">{{ $berita->kategori->nama_kategori }}</a>
                        @endif
                    </p>
                </div>

                {{-- Gambar Artikel --}}
                <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/800x400/e9ecef/343a40?text=Berita' }}" class="article-image" alt="{{ $berita->judul }}">
                
                {{-- Konten Artikel --}}
                <div class="article-content">
                    {!! $berita->isi_berita !!}
                </div>

                {{-- Tombol Kembali --}}
                <a href="{{ route('berita.index') }}" class="back-link">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Berita
                </a>

            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    .main-content { background-color: #ffffff; /* Background putih bersih */ padding-bottom: 4rem; /* Padding bawah */ }
    .article-header h1 {
        font-size: 2.5rem; /* Judul lebih besar */
        font-weight: 700;
        color: #212529;
        line-height: 1.3;
        margin-bottom: 0.75rem; /* Jarak ke tanggal */
    }
    .article-meta {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 1.5rem; /* Jarak ke garis */
    }
    .article-image {
        width: 100%;
        max-height: 450px; /* Batas tinggi gambar */
        object-fit: cover;
        border-radius: 0.75rem; /* Sudut tumpul */
        margin-bottom: 2.5rem; /* Jarak ke konten */
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.1); /* Shadow halus */
    }
    .article-content {
        color: #343a40; /* Warna teks utama */
        font-size: 1.1rem; /* Ukuran font konten */
        line-height: 1.8; /* Spasi baris lebih lega */
    }
    /* Style untuk tag HTML di dalam konten (jika dari editor) */
    .article-content p { margin-bottom: 1.5rem; }
    .article-content h2, 
    .article-content h3, 
    .article-content h4, 
    .article-content h5, 
    .article-content h6 { 
        font-weight: 600; 
        margin-top: 2rem; 
        margin-bottom: 1rem; 
        color: #212529;
    }
    .article-content ul, .article-content ol { padding-left: 1.5rem; margin-bottom: 1.5rem; }
    .article-content li { margin-bottom: 0.5rem; }
    .article-content blockquote {
        border-left: 4px solid #F39C12;
        padding-left: 1rem;
        margin: 2rem 0;
        font-style: italic;
        color: #6c757d;
    }
    .article-content a { color: #F39C12; text-decoration: none; }
    .article-content a:hover { text-decoration: underline; }

    /* Tombol Kembali (jika ingin ditambahkan) */
    .back-link {
        display: inline-block;
        margin-top: 3rem;
        color: #F39C12;
        text-decoration: none;
        font-weight: 500;
    }
    .back-link:hover {
        text-decoration: underline;
    }

</style>
@endpush
