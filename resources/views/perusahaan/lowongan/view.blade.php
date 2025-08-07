@extends('perusahaan.layouts.app')

@section('content')
<style>
    .lowongan-wrapper {
        background-color: #fff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
    }

    .lowongan-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .lowongan-header img {
        height: 80px;
        width: 80px;
        object-fit: cover;
        border-radius: 50%;
    }

    .lowongan-header-title h1 {
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 2.2rem;
        color: #123282;
        margin: 0;
    }

    .badge-lowongan {
        background-color: #123282;
        color: #fff;
        font-weight: 600;
        padding: 0.3rem 1rem;
        border-radius: 0.5rem;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.2rem;
        color: #0d6efd;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .lowongan-content ul {
        list-style: decimal;
        padding-left: 1.25rem;
    }

    .lowongan-content ul li {
        margin-bottom: 0.75rem;
        line-height: 1.6;
    }

    .kualifikasi-table {
        margin-top: 1rem;
    }

    .kualifikasi-table .row {
        margin-bottom: 0.5rem;
    }

    .kualifikasi-table .col-4 {
        font-weight: 600;
        color: #555;
    }

    .btn-kembali {
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .lowongan-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .lowongan-header-title h1 {
            font-size: 1.6rem;
        }
    }
</style>

<div class="lowongan-wrapper">
    {{-- Header Logo dan Judul --}}
    <div class="lowongan-header">
        <img src="{{ Auth::user()->profilePerusahaan->logo_perusahaan ? asset('storage/' . Auth::user()->profilePerusahaan->logo_perusahaan) : asset('images/default-company-profile.png') }}"
                     alt="Logo Perusahaan" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
        <div class="lowongan-header-title">
            <div class="badge-lowongan">Lowongan Kerja</div>
            <h1>{{ $lowongan->judul_lowongan }}</h1>
        </div>
    </div>

    {{-- Lokasi --}}
    <p class="text-muted mb-3"><i class="bi bi-geo-alt-fill me-2"></i>{{ $lowongan->domisili ?? 'Lokasi tidak tersedia' }}</p>

    {{-- Kualifikasi --}}
    <div class="section-title">Persyaratan:</div>
    <div class="kualifikasi-table">
        <div class="row">
            <div class="col-4">Gender</div>
            <div class="col-8">: {{ $lowongan->gender ?? 'Tidak ditentukan' }}</div>
        </div>
        <div class="row">
            <div class="col-4">Pendidikan</div>
            <div class="col-8">: {{ $lowongan->pendidikan_terakhir ?? 'Tidak ditentukan' }}</div>
        </div>
        <div class="row">
            <div class="col-4">Usia</div>
            <div class="col-8">: {{ $lowongan->usia ?? 'Tidak ditentukan' }}</div>
        </div>
        <div class="row">
            <div class="col-4">Pengalaman</div>
            <div class="col-8">: {{ $lowongan->pengalaman_kerja ?? 'Tidak ditentukan' }}</div>
        </div>
        <div class="row">
            <div class="col-4">Keahlian</div>
            <div class="col-8">: {{ $lowongan->keahlian_bidang_pekerjaan ?? 'Tidak ditentukan' }}</div>
        </div>
    </div>
    {{-- Deskripsi Pekerjaan --}}
    <div class="section-title">Jobdesk:</div>
    <div class="lowongan-content">
        <p>{{ $lowongan->deskripsi_pekerjaan }}</p>
    </div>

    {{-- Tombol Kembali --}}
    <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="btn btn-outline-primary btn-kembali">
        <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar
    </a>
</div>
@endsection
