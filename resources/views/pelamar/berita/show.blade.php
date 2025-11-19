@extends('pelamar.layouts.app')

@section('title', $berita->judul)

@section('content')
{{-- HAPUS FOOTER --}}
<style>footer.footer { display: none !important; }</style>

<div class="article-page-wrapper bg-white">
    
    {{-- 1. HERO HEADER ARTIKEL --}}
    <div class="article-header-section position-relative py-5 bg-light border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    @if($berita->kategori)
                        <span class="badge bg-orange text-white mb-3 px-3 py-2 rounded-pill">{{ $berita->kategori->nama_kategori }}</span>
                    @endif
                    <h1 class="article-title display-5 fw-bold text-dark mb-4">{{ $berita->judul }}</h1>
                    
                    <div class="article-meta d-flex justify-content-center align-items-center text-muted small">
                        <div class="d-flex align-items-center me-4">
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ \Carbon\Carbon::parse($berita->published_at)->format('d F Y') }}
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock me-2"></i>
                            {{-- Estimasi waktu baca (opsional logic) --}}
                            {{ ceil(str_word_count(strip_tags($berita->isi_berita)) / 200) }} menit baca
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. KONTEN UTAMA --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                {{-- Gambar Utama --}}
                <div class="article-featured-image mb-5 rounded-4 overflow-hidden shadow-sm">
                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/800x450/e9ecef/343a40?text=Cover+Image' }}" 
                         class="img-fluid w-100 object-fit-cover" alt="{{ $berita->judul }}">
                </div>

                {{-- Isi Artikel (Rich Text) --}}
                <div class="article-body">
                    {{-- Kutipan Awal sebagai Lead Paragraph --}}
                    @if($berita->kutipan)
                        <p class="lead fw-medium text-dark mb-5 ps-4 border-start border-4 border-orange fst-italic">
                            {{ $berita->kutipan }}
                        </p>
                    @endif

                    {{-- Konten Utama dari Database --}}
                    <div class="content-wrapper text-secondary">
                        {!! $berita->isi_berita !!}
                    </div>
                </div>

                {{-- Footer Artikel (Share & Tags) --}}
                <div class="article-footer mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Berita
                    </a>
                    <div class="share-buttons">
                        <span class="text-muted me-3 small">Bagikan:</span>
                        <a href="#" class="text-muted me-3 fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-muted me-3 fs-5"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* Styles Khusus Halaman Artikel */
    .article-title { line-height: 1.2; }
    .bg-orange { background-color: #F39C12 !important; }
    .border-orange { border-color: #F39C12 !important; }
    
    /* Styling Konten (Typography untuk Rich Text dari Admin) */
    .content-wrapper { font-size: 1.15rem; line-height: 1.8; color: #343a40; }
    .content-wrapper p { margin-bottom: 1.5rem; }
    .content-wrapper h2 { font-weight: 700; margin-top: 2.5rem; margin-bottom: 1rem; color: #22374e; }
    .content-wrapper h3 { font-weight: 600; margin-top: 2rem; margin-bottom: 1rem; color: #22374e; }
    .content-wrapper ul, .content-wrapper ol { margin-bottom: 1.5rem; padding-left: 1.5rem; }
    .content-wrapper li { margin-bottom: 0.5rem; }
    .content-wrapper img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 2rem 0; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .content-wrapper blockquote { border-left: 4px solid #e9ecef; padding-left: 1.5rem; margin: 2rem 0; font-style: italic; color: #6c757d; }
    .content-wrapper a { color: #F39C12; text-decoration: underline; }
    .content-wrapper a:hover { color: #d8890b; }
</style>
@endpush