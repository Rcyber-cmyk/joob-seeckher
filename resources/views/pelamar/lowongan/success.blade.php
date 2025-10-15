{{-- Simpan sebagai /resources/views/pelamar/lowongan/success.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Lamaran Terkirim')

@section('content')
<div class="container my-5 text-center">
    <div class="success-card mx-auto">
        <div class="success-icon">
            <i class="bi bi-patch-check-fill"></i>
        </div>
        <h2 class="success-title">Lamaran yang Anda isi telah dikirim ke perusahaan</h2>
        <p class="success-subtitle">Mohon menunggu email yang dikirim oleh perusahaan tersebut.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('home') }}" class="btn btn-outline-dark">Kembali ke Beranda</a>
            <a href="{{ route('pelamar.aktivitas.index') }}" class="btn btn-dark">Lihat Aktivitas Lamaran</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .success-card {
        background-color: #22374e;
        color: white;
        padding: 4rem 2rem;
        border-radius: 1rem;
        max-width: 600px;
    }
    .success-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
    }
    .success-title {
        font-weight: 700;
    }
    .success-subtitle {
        color: rgba(255,255,255,0.8);
    }
</style>
@endpush
