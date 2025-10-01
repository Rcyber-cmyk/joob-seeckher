@extends('perusahaan.layouts.app')

@section('content')
<style>
    .header-dashboard {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 1.5rem;
    }
    .package-card {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        transition: all 0.3s ease;
        background-color: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-color);
    }
    .package-card .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .package-card .card-title {
        color: var(--secondary-color);
        font-weight: 700;
    }
    .package-card .card-icon {
        font-size: 3rem;
        color: var(--primary-color);
    }
    .package-card .feature-list {
        list-style: none;
        padding-left: 0;
        margin-top: 1.5rem;
        flex-grow: 1;
    }
    .feature-list li {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: flex-start;
    }
    .feature-list i {
        color: #28a745;
        margin-right: 10px;
        margin-top: 5px;
    }
    .package-card .btn {
        width: 100%;
        padding: 0.75rem;
        font-weight: 600;
        margin-top: auto; /* Mendorong tombol ke bawah */
    }
    .badge-popular {
        position: absolute;
        top: -15px;
        right: 20px;
        transform: rotate(10deg);
        font-size: 0.9rem;
    }
</style>

<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-5">
    <div class="w-100 w-md-auto">
        <h1 class="fw-bold">Dapatkan Kandidat Terbaik</h1>
        <p class="text-muted mb-0">Pilih metode pencarian kandidat yang paling sesuai dengan kebutuhan Anda.</p>
    </div>
     <a href="{{ route('perusahaan.kandidat-pelamar.index') }}" class="btn btn-outline-primary mt-3 mt-md-0">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
    </a>
</div>

<div class="row g-4 justify-content-center">
    {{-- Opsi 1: Gratis --}}
    <div class="col-md-6 col-lg-5">
        <div class="package-card p-4">
            <div class="card-body text-center">
                <div class="card-icon mb-3"><i class="bi bi-search-heart"></i></div>
                <h3 class="card-title">Cari Kandidat Pelamar</h3>
                <p class="text-muted">Temukan Kandidat Karyawan Pilihanmu</p>

                <ul class="feature-list text-start">
                    <li><i class="bi bi-check-circle-fill"></i>Kandidat Pelamar.</li>
                    <li><i class="bi bi-check-circle-fill"></i>Gunakan filter canggih berdasarkan pengalaman dan pendidikan.</li>
                    <li><i class="bi bi-check-circle-fill"></i>Undangan Lamaran Untuk Pelamar.</li>
                    <li><i class="bi bi-check-circle-fill"></i>Sepenuhnya **Gratis**.</li>
                </ul>

                <a href="{{ route('perusahaan.kandidat.search') }}" class="btn btn-outline-primary">Mulai Mencari</a>
            </div>
        </div>
    </div>

    {{-- Opsi 2: Berbayar/Premium --}}
    <div class="col-md-6 col-lg-5">
        <div class="package-card p-4 position-relative">
            <span class="badge bg-success p-2 badge-popular"><i class="bi bi-star-fill me-1"></i> Populer</span>
            <div class="card-body text-center">
                <div class="card-icon mb-3"><i class="bi bi-gem"></i></div>
                <h3 class="card-title">Cari Kandidat Pelamar Premium</h3>
                <p class="text-muted">Dapatkan akses ke *talent pool* eksklusif kami yang berisi kandidat pasif dan terverifikasi.</p>

                <ul class="feature-list text-start">
                    <li><i class="bi bi-check-circle-fill"></i>Semua fitur dari paket gratis.</li>
                    <li><i class="bi bi-check-circle-fill"></i>Kandidat Terbaik Sesuai Kriteria Anda.</li>
                    <li><i class="bi bi-check-circle-fill"></i>Profil kandidat yang direkomendasikan oleh kami.</li>
                    <li><i class="bi bi-check-circle-fill"></i>**Berbayar** (Hubungi Tim Sales).</li>
                </ul>

                <a href="{{ route('perusahaan.kandidat.search.premium') }}" class="btn btn-primary" style="background-color: var(--primary-color); border-color: var(--primary-color);">Hubungi Tim Sales</a>
            </div>
        </div>
    </div>
</div>
@endsection
