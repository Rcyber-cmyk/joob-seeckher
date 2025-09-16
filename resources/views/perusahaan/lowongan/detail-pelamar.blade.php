@extends('perusahaan.layouts.app')

@section('content')
<style>
    /* --- Umum --- */
    .dashboard-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .dashboard-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .header-dashboard {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-dashboard img {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary-color);
    }

    /* Badge Keahlian */
    .badge-skill {
        background-color: var(--primary-color);
        color: #fff;
        font-size: 0.85rem;
        padding: 0.4rem 0.75rem;
        border-radius: 20px;
    }

    /* List Info */
    .list-info li {
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px dashed #e0e0e0;
    }

    .list-info .fw-bold {
        color: var(--secondary-color);
    }

    /* Mobile Responsif */
    @media (max-width: 768px) {
        .header-dashboard {
            flex-direction: column;
            text-align: center;
        }
        .header-dashboard img {
            margin-bottom: 0.5rem;
        }
    }
</style>

{{-- Header --}}

<div class="header-dashboard mb-3">
    <div>
        <img src="{{ Auth::user()->profilePerusahaan->logo_perusahaan ? asset('storage/' . Auth::user()->profilePerusahaan->logo_perusahaan) : asset('images/default-company-profile.png') }}" alt="Logo Perusahaan">
        <p class="text fw-bold mb-0">{{ $lowongan->judul_lowongan }}</p>
    </div>
    <div>
    <h1 class="mb-1">Detail Pelamar</h1>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary w-100">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>
    </div>
</div>

<div class="row g-4">
    {{-- Informasi Pelamar --}}
    <div class="col-lg-6">
        <div class="dashboard-section p-4 h-100">
            <h5 class="fw-bold mb-3"><i class="bi bi-person-circle me-2"></i> Informasi Pelamar</h5>
            <ul class="list-unstyled list-info">
                <li><span class="fw-bold">Nama</span> : {{ $pelamar->user->name }}</li>
                <li><span class="fw-bold">Lokasi</span> : {{ $pelamar->domisili }}</li>
                <li><span class="fw-bold">Gender</span> : {{ $pelamar->gender }}</li>
                <li><span class="fw-bold">Usia</span> : {{ $pelamar->tanggal_lahir }}</li>
            </ul>

            <h5 class="fw-bold mt-4 mb-3"><i class="bi bi-file-earmark-text me-2"></i> Dokumen Lamaran</h5>
            <div class="d-flex flex-wrap gap-3">
                <a href="#" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-file-earmark-text me-1"></i> Surat Lamaran
                </a>
                <a href="#" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-file-earmark-richtext me-1"></i> Resume
                </a>
            </div>

            <h5 class="fw-bold mt-4 mb-3"><i class="bi bi-card-list me-2"></i> Ringkasan Pelamar</h5>
            <ul class="list-unstyled list-info">
                <li><span class="fw-bold">Gaji yang diinginkan</span> : {{ $lowongan->gaji_diharapkan }}</li>
                <li><span class="fw-bold">Pendidikan terakhir</span> : {{ $pelamar->lulusan }}</li>
                <li><span class="fw-bold">Nilai</span> : {{ $pelamar->nilai_akhir }}</li>
                <li><span class="fw-bold">Pengalaman kerja</span> : {{ $pelamar->pengalaman_kerja }}</li>
                <li>
                    <span class="fw-bold">Bidang keahlian</span> :
                    @forelse ($pelamar->keahlian as $keahlian)
                        <span class="badge-skill me-1">{{ $keahlian->nama_keahlian }}</span>
                    @empty
                        <span class="text-muted">Tidak ada keahlian</span>
                    @endforelse
                </li>
            </ul>
        </div>
    </div>

    {{-- Keahlian & Riwayat Karir --}}
    <div class="col-lg-6">
        <div class="dashboard-section p-4 h-100">
            <h5 class="fw-bold mb-3"><i class="bi bi-star me-2"></i> Keahlian</h5>
            <div class="d-flex flex-wrap gap-2 mb-4">
                <span class="badge-skill">Membangun Tim</span>
                <span class="badge-skill">Bekerja Dalam Tim</span>
                <span class="badge-skill">Menguasai Laravel</span>
                <span class="badge-skill">Bekerja dalam Tekanan</span>
                <span class="badge-skill">Kerja Cepat</span>
                <span class="badge-skill">Analisis</span>
                <span class="badge-skill">Mudah Beradaptasi</span>
            </div>

            <h5 class="fw-bold mb-3"><i class="bi bi-briefcase me-2"></i> Riwayat Karir</h5>
            <ul class="list-unstyled list-info">
                <li><span class="fw-bold">Posisi Pekerjaan</span> : Software Engineer</li>
                <li><span class="fw-bold">Nama Perusahaan</span> : Universitas AKI</li>
                <li><span class="fw-bold">Mulai</span> : 16/09/2022</li>
                <li><span class="fw-bold">Berakhir</span> : 01/05/2025</li>
            </ul>
        </div>
    </div>
</div>
@endsection
