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

    .lowongan-content p {
        line-height: 1.8;
    }

    .detail-table {
        margin-top: 1rem;
    }

    .detail-table .row {
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px dashed #e9ecef;
    }
    
    .detail-table .row:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .detail-table .col-4 {
        font-weight: 600;
        color: #555;
    }
    
    .detail-table .col-8 .badge {
        font-size: 1rem;
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
                     alt="Logo Perusahaan" class="rounded-circle">
        <div class="lowongan-header-title">
            <div class="badge-lowongan">Lowongan Kerja</div>
            <h1>{{ $lowongan->judul_lowongan }}</h1>
        </div>
    </div>

    {{-- Lokasi & Tipe Pekerjaan --}}
    <p class="text-muted mb-3">
        <i class="bi bi-geo-alt-fill me-2"></i>{{ $lowongan->domisili ?? 'Lokasi tidak tersedia' }} 
        <span class="mx-2">|</span> 
        <i class="bi bi-clock-fill me-2"></i>{{ $lowongan->tipe_pekerjaan ?? 'Tipe tidak tersedia' }}
    </p>

    {{-- Deskripsi Pekerjaan --}}
    <div class="section-title">Jobdesk:</div>
    <div class="lowongan-content">
        <p>{{ $lowongan->deskripsi_pekerjaan }}</p>
    </div>

    {{-- Kualifikasi (Disesuaikan) --}}
    <div class="section-title">Persyaratan Kualifikasi:</div>
    <div class="detail-table">
        <div class="row">
            <div class="col-4">Gender</div>
            <div class="col-8">: {{ $lowongan->gender ?? 'Tidak ditentukan' }}</div>
        </div>
        <div class="row">
            <div class="col-4">Pendidikan</div>
            <div class="col-8">: Minimal {{ $lowongan->pendidikan_terakhir ?? 'Tidak ditentukan' }}</div>
        </div>
        <div class="row">
            <div class="col-4">Rentang Usia</div>
            <div class="col-8">: {{ $lowongan->usia_min ?? 'Tidak ada batas' }} - {{ $lowongan->usia ?? 'Tidak ada batas' }} Tahun</div>
        </div>
        <div class="row">
            <div class="col-4">Rentang Pengalaman</div>
            <div class="col-8">: {{ $lowongan->pengalaman_kerja ?? '0' }} - {{ $lowongan->pengalaman_kerja_maks ?? 'Tidak ada batas' }} Tahun</div>
        </div>
    </div>
    
    {{-- Kriteria Penilaian (E-Ranking) --}}
    <div class="section-title">Kriteria Penilaian (E-Ranking):</div>
    <div class="detail-table">
        <div class="row align-items-center">
            <div class="col-4">Pengalaman</div>
            <div class="col-8">: <span class="badge bg-primary">{{ $lowongan->bobot_pengalaman }}%</span></div>
        </div>
        <div class="row align-items-center">
            <div class="col-4">Pendidikan</div>
            <div class="col-8">: <span class="badge bg-primary">{{ $lowongan->bobot_pendidikan }}%</span></div>
        </div>
         <div class="row align-items-center">
            <div class="col-4">Nilai Akhir</div>
            <div class="col-8">: <span class="badge bg-primary">{{ $lowongan->bobot_nilai }}%</span></div>
        </div>
        <div class="row align-items-center">
            <div class="col-4">Domisili</div>
            <div class="col-8">: <span class="badge bg-primary">{{ $lowongan->bobot_domisili }}%</span></div>
        </div>
        <div class="row align-items-center">
            <div class="col-4">Usia</div>
            <div class="col-8">: <span class="badge bg-primary">{{ $lowongan->bobot_usia }}%</span></div>
        </div>
        <div class="row align-items-center">
            <div class="col-4">Gender</div>
            <div class="col-8">: <span class="badge bg-primary">{{ $lowongan->bobot_gender }}%</span></div>
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="btn btn-outline-primary btn-kembali">
        <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar
    </a>
</div>
@endsection
