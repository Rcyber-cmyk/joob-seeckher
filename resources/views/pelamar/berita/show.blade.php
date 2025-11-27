@extends('pelamar.layouts.app')

@section('title', $berita->judul)

@section('content')
{{-- HAPUS FOOTER --}}
<style>footer.footer { display: none !important; }</style>

{{-- 
    =============================================
    1. READING PROGRESS BAR (Indikator Baca)
    =============================================
--}}
<div class="reading-progress-container fixed-top" style="z-index: 9999;">
    <div class="reading-progress-bar bg-orange" id="readingBar"></div>
</div>

{{-- 
    =============================================
    2. HERO HEADER (Judul & Meta)
    =============================================
--}}
<div class="article-hero-section position-relative">
    <div class="container position-relative z-2 h-100 d-flex flex-column justify-content-center align-items-center text-center">
        
        {{-- Breadcrumb / Kategori --}}
        <div class="mb-4 animate__animated animate__fadeInDown">
            @if($berita->kategori)
                <span class="badge badge-pill-glass text-uppercase ls-2">
                    <i class="bi bi-hash text-orange"></i> {{ $berita->kategori->nama_kategori }}
                </span>
            @endif
        </div>

        {{-- Judul Artikel --}}
        <h1 class="display-4 fw-black text-white mb-4 animate__animated animate__fadeInUp article-title-hero">
            {{ $berita->judul }}
        </h1>

        {{-- Meta Info (Author, Date, Time) --}}
        <div class="d-flex justify-content-center align-items-center gap-4 text-white-50 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="d-flex align-items-center">
                <div class="avatar-circle me-2 bg-orange text-white fw-bold">M</div>
                <span>Tim Messari</span>
            </div>
            <div class="d-none d-md-block">&bull;</div>
            <div>
                <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($berita->published_at)->format('d M Y') }}
            </div>
            <div class="d-none d-md-block">&bull;</div>
            <div>
                <i class="bi bi-clock me-1"></i> {{ ceil(str_word_count(strip_tags($berita->isi_berita)) / 200) }} menit baca
            </div>
        </div>

    </div>

    {{-- Background Pattern --}}
    <div class="hero-bg-pattern"></div>
</div>

{{-- 
    =============================================
    3. MAIN CONTENT (Overlap Style)
    =============================================
--}}
<div class="article-content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                
                {{-- GAMBAR UTAMA (FEATURED IMAGE) --}}
                <div class="featured-image-container shadow-2xl rounded-5 overflow-hidden position-relative mb-5 animate__animated animate__zoomIn">
                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/1200x600/1a2c3d/ffffff?text=Cover+Image' }}" 
                         class="w-100 object-fit-cover" alt="{{ $berita->judul }}">
                </div>

                <div class="row">
                    {{-- SIDEBAR KIRI (Share Button - Sticky) --}}
                    <div class="col-lg-1 d-none d-lg-block">
                        <div class="sticky-share d-flex flex-column align-items-center gap-3">
                            <span class="text-muted small fw-bold text-uppercase" style="writing-mode: vertical-rl; transform: rotate(180deg);">Bagikan</span>
                            <a href="#" class="btn btn-share rounded-circle"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="btn btn-share rounded-circle"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="btn btn-share rounded-circle"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="btn btn-share rounded-circle"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    {{-- KONTEN ARTIKEL --}}
                    <div class="col-lg-11">
                        <div class="article-body ps-lg-4">
                            
                            {{-- Kutipan (Lead Paragraph) --}}
                            @if($berita->kutipan)
                                <div class="quote-box p-4 rounded-4 mb-5 border-start border-4 border-orange bg-light-gray position-relative">
                                    <i class="bi bi-quote position-absolute text-orange opacity-25 display-1" style="top: -20px; left: 10px;"></i>
                                    <p class="lead fw-medium fst-italic m-0 text-dark-blue position-relative z-1">
                                        {{ $berita->kutipan }}
                                    </p>
                                </div>
                            @endif

                            {{-- Isi Berita (Rich Text) --}}
                            <div class="rich-text-content text-dark-blue">
                                {!! $berita->isi_berita !!}
                            </div>

                            {{-- Tags / Footer Artikel --}}
                            <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div>
                                    <span class="text-muted small me-2">Tags:</span>
                                    <a href="#" class="btn btn-sm btn-light rounded-pill border px-3">Karir</a>
                                    <a href="#" class="btn btn-sm btn-light rounded-pill border px-3">Tips</a>
                                    <a href="#" class="btn btn-sm btn-light rounded-pill border px-3">Lowongan</a>
                                </div>
                                {{-- Tombol Share Mobile --}}
                                <div class="d-lg-none d-flex gap-2">
                                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-share"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- 
    =============================================
    4. RELATED ARTICLES (Replaced with Logic)
    =============================================
--}}
<div class="bg-light-gray py-5 mt-5 position-relative overflow-hidden">
    <div class="container py-4 position-relative z-2">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold text-dark-blue m-0">Bacaan Selanjutnya</h3>
            <a href="{{ route('berita.index') }}" class="btn btn-link text-orange fw-bold text-decoration-none">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row g-4">
            {{-- LOGIC PHP: Ambil 3 Berita Terkait (Kecuali yg sedang dibuka) --}}
            @php
                $relatedArticles = \App\Models\Berita::where('id', '!=', $berita->id)
                                    ->latest('published_at')
                                    ->take(3)
                                    ->get();
            @endphp

            @forelse($relatedArticles as $related)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover-lift">
                    <div class="ratio ratio-16x9">
                        <img src="{{ $related->gambar ? asset('storage/' . $related->gambar) : 'https://placehold.co/400x250/e9ecef/343a40?text=Related' }}" 
                             class="object-fit-cover" alt="Related">
                    </div>
                    <div class="card-body">
                        <small class="text-orange fw-bold text-uppercase ls-1" style="font-size: 0.7rem;">
                            {{ $related->kategori->nama_kategori ?? 'UMUM' }}
                        </small>
                        <h6 class="fw-bold mt-2 lh-sm">
                            <a href="{{ route('berita.show', $related->slug) }}" class="text-decoration-none text-dark-blue stretched-link">
                                {{ Str::limit($related->judul, 60) }}
                            </a>
                        </h6>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($related->published_at)->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                Tidak ada artikel terkait.
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- SCRIPT: Progress Bar Logic --}}
<script>
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("readingBar").style.width = scrolled + "%";
    };
</script>
@endsection

@push('styles')
<style>
    /* === VARIABLES === */
    :root {
        --c-dark-blue: #22374e;
        --c-orange: #F39C12;
        --c-gray-bg: #f8f9fa;
        --c-light-gray: #f1f3f5;
    }

    /* === UTILS === */
    .fw-black { font-weight: 900; }
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    .text-dark-blue { color: var(--c-dark-blue); }
    .text-orange { color: var(--c-orange); }
    .bg-orange { background-color: var(--c-orange); }
    .bg-light-gray { background-color: var(--c-light-gray); }
    .bg-dark-blue { background-color: var(--c-dark-blue); }
    .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }

    /* === PROGRESS BAR === */
    .reading-progress-container { width: 100%; height: 5px; background: transparent; }
    .reading-progress-bar { height: 5px; width: 0%; transition: width 0.1s; box-shadow: 0 0 10px var(--c-orange); }

    /* === HERO SECTION === */
    .article-hero-section {
        background-color: var(--c-dark-blue);
        min-height: 550px;
        padding-top: 80px;
        padding-bottom: 150px; /* Space for overlap */
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    
    .article-title-hero {
        line-height: 1.1;
        max-width: 900px;
    }

    .badge-pill-glass {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        backdrop-filter: blur(5px);
        font-weight: 700;
    }

    .avatar-circle {
        width: 35px; height: 35px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
    }

    .hero-bg-pattern {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.5;
        pointer-events: none;
    }

    /* === CONTENT WRAPPER (OVERLAP LOGIC) === */
    .article-content-wrapper {
        margin-top: -120px; /* KUNCI OVERLAP: Tarik ke atas */
        position: relative;
        z-index: 10;
    }

    .featured-image-container {
        border: 8px solid white; /* Frame putih biar kontras */
    }

    /* === STICKY SHARE === */
    .sticky-share {
        position: sticky;
        top: 120px;
    }
    .btn-share {
        width: 45px; height: 45px;
        display: flex; align-items: center; justify-content: center;
        color: #999; border: 1px solid #eee;
        transition: all 0.3s; background: white;
    }
    .btn-share:hover {
        background-color: var(--c-dark-blue);
        color: white; border-color: var(--c-dark-blue);
        transform: scale(1.1);
    }

    /* === TYPOGRAPHY CONTENT === */
    .rich-text-content {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #2c3e50;
    }
    .rich-text-content p { margin-bottom: 1.8rem; }
    
    /* Drop Cap (Huruf Pertama Paragraf Pertama) */
    .rich-text-content > p:first-of-type::first-letter {
        float: left; font-size: 4rem; line-height: 0.85;
        font-weight: 900; color: var(--c-orange);
        padding-right: 15px; padding-top: 5px;
    }

    .rich-text-content h2 { font-weight: 800; color: var(--c-dark-blue); margin-top: 3rem; margin-bottom: 1.5rem; }
    .rich-text-content h3 { font-weight: 700; color: var(--c-dark-blue); margin-top: 2.5rem; margin-bottom: 1rem; }
    .rich-text-content ul, .rich-text-content ol { padding-left: 1.5rem; margin-bottom: 2rem; }
    .rich-text-content li { margin-bottom: 0.8rem; }
    .rich-text-content img { border-radius: 12px; height: auto; max-width: 100%; margin: 2rem 0; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
    .rich-text-content blockquote {
        font-style: italic; color: #555; border-left: 4px solid var(--c-orange);
        padding-left: 1.5rem; margin: 2rem 0;
    }

    /* === RELATED CARD === */
    .card-hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .card-hover-lift:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .article-hero-section { min-height: auto; padding-bottom: 80px; }
        .article-content-wrapper { margin-top: -50px; }
        .article-title-hero { font-size: 2.5rem; }
        .rich-text-content { font-size: 1rem; }
    }
</style>
@endpush