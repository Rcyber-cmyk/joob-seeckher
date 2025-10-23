{{-- Simpan sebagai /resources/views/pelamar/lowongan/success.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Lamaran Terkirim')

@section('content')
<div class="container my-5 d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 250px);"> {{-- Menambah tinggi minimum --}}
    <div class="success-card mx-auto text-center shadow-lg"> {{-- Menambah shadow --}}
        <div class="success-icon mb-4"> {{-- Margin diatur --}}
            <i class="bi bi-check-circle-fill text-success"></i> {{-- Warna hijau dan ikon berbeda --}}
        </div>
        <h2 class="success-title mb-3">Lamaran Berhasil Terkirim!</h2> {{-- Judul diubah --}}
        <p class="success-subtitle mb-4">Lamaran Anda untuk posisi terkait telah berhasil dikirimkan ke perusahaan. Mohon cek email Anda secara berkala untuk informasi selanjutnya.</p> {{-- Subtitle diubah --}}
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center"> {{-- Layout tombol diubah --}}
            {{-- Tombol Lihat Aktivitas jadi primary (oranye) --}}
            <a href="{{ route('pelamar.aktivitas.index') }}" class="btn btn-orange btn-lg px-4 gap-3">
                <i class="bi bi-list-check me-2"></i>Lihat Aktivitas Lamaran
            </a>
            {{-- Tombol Kembali jadi secondary (outline) --}}
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg px-4">
                <i class="bi bi-house-door me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Menggunakan background dari layout utama jika ada */
    /* body { background-color: #f0f2f5; } */

    .success-card {
        background-color: #ffffff; /* Ganti ke putih */
        color: #212529; /* Ganti ke hitam */
        padding: 3rem; /* Padding disesuaikan */
        border-radius: 1rem;
        max-width: 650px; /* Lebar ditambah sedikit */
        border-top: 5px solid #198754; /* Border hijau di atas */
    }
    .success-icon {
        font-size: 5rem; /* Icon lebih besar */
        line-height: 1; /* Agar tidak menambah tinggi berlebih */
    }
    .success-title {
        font-weight: 700;
        font-size: 1.75rem; /* Ukuran font disesuaikan */
        color: #343a40; /* Warna lebih gelap */
    }
    .success-subtitle {
        color: #6c757d; /* Warna abu-abu standar */
        font-size: 1.1rem; /* Ukuran font disesuaikan */
        line-height: 1.6; /* Spasi antar baris */
    }
    /* Menggunakan warna oranye tema untuk tombol primary */
    .btn-orange {
        background-color: #F39C12;
        border-color: #F39C12;
        color: white;
    }
    .btn-orange:hover {
        background-color: #d8890b; /* Warna hover sedikit lebih gelap */
        border-color: #d8890b;
        color: white;
    }
    .btn-outline-secondary {
        /* Bootstrap sudah punya style bagus untuk ini */
    }
    /* Responsif untuk tombol di layar kecil */
    @media (max-width: 575.98px) {
        .d-sm-flex {
            flex-direction: column; /* Tombol jadi vertikal */
        }
    }
</style>
@endpush