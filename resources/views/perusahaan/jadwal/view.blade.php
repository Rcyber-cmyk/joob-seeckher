@extends('perusahaan.layouts.app')

@section('content')
<style>
    /* ==== Warna Utama ==== */
    :root {
        --primary-color: #0d6efd;
        --secondary-color: #495057;
        --light-bg: #f8f9fa;
        --border-radius: 12px;
    }

    /* ==== Header Jadwal ==== */
    .header-dashboard {
        background: linear-gradient(135deg, var(--primary-color), #4dabf7);
        border-radius: var(--border-radius);
        padding: 1.8rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .header-dashboard h1 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: .3rem;
    }
    .header-dashboard p {
        margin: 0;
        font-size: .95rem;
        opacity: 0.9;
    }

    /* ==== Card Detail ==== */
    .detail-section {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        padding: 2rem;
    }
    .detail-section h5 {
        color: var(--secondary-color);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: 1.2rem;
    }

    /* ==== Item Label & Value ==== */
    .detail-label {
        font-weight: 600;
        font-size: .9rem;
        color: var(--secondary-color);
        margin-bottom: 0.4rem;
        display: block;
    }
    .detail-value {
        background-color: var(--light-bg);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: .5rem;
        font-size: .95rem;
    }
    .detail-value a {
        text-decoration: none;
        word-break: break-all;
    }

    /* ==== Badge Status ==== */
    .badge-status {
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.4rem 0.75rem;
        border-radius: 50px;
    }
    .badge-terjadwal {
        background-color: var(--primary-color);
        color: white;
    }
    .badge-selesai {
        background-color: #28a745;
        color: white;
    }

    /* ==== Tombol Kembali ==== */
    .btn-back {
        background-color: white;
        border: 1px solid #dee2e6;
        color: var(--secondary-color);
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        background-color: var(--light-bg);
    }

    /* ==== Tombol Danger ==== */
    .btn-outline-danger {
        border-radius: 8px;
        font-weight: 600;
    }

    /* ==== Responsif ==== */
    @media (max-width: 768px) {
        .header-dashboard {
            padding: 1.5rem;
            text-align: center;
        }
        .header-dashboard h1 {
            font-size: 1.5rem;
        }
        .detail-section {
            padding: 1.5rem;
        }
    }
</style>

<!-- Tombol Kembali -->
<div class="mb-4">
    <a href="{{ route('perusahaan.jadwal.index') }}" class="btn btn-back">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>
</div>

<!-- Header -->
<div class="header-dashboard">
    <h1>Detail Jadwal Wawancara</h1>
    <p>Informasi lengkap jadwal wawancara untuk pelamar</p>
</div>

<!-- Detail Section -->
<div class="detail-section">
    <!-- Info Pelamar -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5><i class="bi bi-person-fill"></i> Informasi Pelamar</h5>
        @if ($jadwal->status === 'terjadwal')
            <span class="badge-status badge-terjadwal">Terjadwal</span>
        @else
            <span class="badge-status badge-selesai">Selesai</span>
        @endif
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <span class="detail-label">Nama Pelamar</span>
            <span class="detail-value"><i class="bi bi-person-badge"></i>{{ $jadwal->pelamar->user->name ?? 'Tidak Diketahui' }}</span>
        </div>
        <div class="col-md-6">
            <span class="detail-label">Posisi Dilamar</span>
            <span class="detail-value"><i class="bi bi-briefcase"></i>{{ $jadwal->lowongan->judul_lowongan ?? 'Tidak Diketahui' }}</span>
        </div>
    </div>

    <!-- Detail Wawancara -->
    <h5><i class="bi bi-calendar-check"></i> Detail Wawancara</h5>
    <div class="row g-4">
        <div class="col-md-6">
            <span class="detail-label">Tanggal Wawancara</span>
            <span class="detail-value"><i class="bi bi-calendar-event"></i>{{ \Carbon\Carbon::parse($jadwal->tanggal_interview)->format('d F Y') }}</span>
        </div>
        <div class="col-md-6">
            <span class="detail-label">Waktu Wawancara</span>
            <span class="detail-value"><i class="bi bi-clock"></i>{{ \Carbon\Carbon::parse($jadwal->waktu_interview)->format('H:i') }}</span>
        </div>
        <div class="col-md-6">
            <span class="detail-label">Metode Wawancara</span>
            <span class="detail-value"><i class="bi bi-camera-video"></i>{{ $jadwal->metode_wawancara }}</span>
        </div>
        <div class="col-md-6">
            @if ($jadwal->metode_wawancara === 'Virtual Interview')
                <span class="detail-label">Link Zoom</span>
                <span class="detail-value">
                    <i class="bi bi-link-45deg"></i>
                    <a href="{{ $jadwal->link_zoom }}" target="_blank" class="text-primary">
                        {{ $jadwal->link_zoom }}
                    </a>
                </span>
            @else
                <span class="detail-label">Lokasi Interview</span>
                <span class="detail-value"><i class="bi bi-geo-alt"></i>{{ $jadwal->lokasi_interview }}</span>
            @endif
        </div>
    </div>
</div>
@endsection
