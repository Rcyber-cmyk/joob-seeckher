{{-- Simpan sebagai /resources/views/pelamar/berita/show.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="main-content">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-3" style="font-weight: 700;">{{ $berita->judul }}</h1>
                <p class="text-muted">Dipublikasikan pada: {{ \Carbon\Carbon::parse($berita->published_at)->format('d F Y') }}</p>
                <hr>
                <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://placehold.co/800x400/e9ecef/343a40?text=Berita' }}" class="img-fluid rounded mb-4" alt="{{ $berita->judul }}">
                
                <div class="article-content">
                    {{-- Menggunakan {!! !!} agar tag HTML dari editor (jika ada) bisa dirender --}}
                    {!! $berita->isi_berita !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
