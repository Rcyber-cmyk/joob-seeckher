@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Halaman --}}
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="w-100 w-md-auto mb-3 mb-md-0">
            <h1>Notifikasi Rekrutmen</h1>
            <p class="text-muted">Lihat Pembaruan Notifikasi Perusahaan Anda</p>
        </div>
    </div>

    {{-- Filter dan Aksi --}}
    <div class="filter-section mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div class="dropdown me-md-2 mb-2 mb-md-0">
            <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Notifikasi
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Belum Terbaca</a></li>
                <li><a class="dropdown-item" href="#">Sudah Terbaca</a></li>
            </ul>
        </div>
        <button class="btn btn-primary d-flex align-items-center btn-post" type="button">
            Tandai Semua Sudah Di baca
        </button>
    </div>

    {{-- Daftar Notifikasi --}}
    <div class="dashboard-section p-0">
        <div class="notifikasi-list">
            {{-- Loop data notifikasi di sini --}}
            <div class="notifikasi-item d-flex align-items-start p-3 border-bottom">
                <i class="bi bi-bell-fill me-3 fs-5 text-secondary"></i>
                <div class="flex-grow-1">
                    <span class="fw-bold d-block">Pelamar Baru untuk UI/UX Designer</span>
                    <small class="text-muted d-block">Jhon Doe Telah Melamar Untuk Posisi UI/UX Designer.</small>
                    <small class="text-muted d-block">Tanggal : 20 Juni 2025</small>
                </div>
                <small class="text-primary fw-bold text-end ms-auto">Belum Terbaca</small>
            </div>
            <div class="notifikasi-item d-flex align-items-start p-3 border-bottom">
                <i class="bi bi-bell-fill me-3 fs-5 text-secondary"></i>
                <div class="flex-grow-1">
                    <span class="fw-bold d-block">Pelamar Baru untuk UI/UX Designer</span>
                    <small class="text-muted d-block">Jhon Doe Telah Melamar Untuk Posisi UI/UX Designer.</small>
                    <small class="text-muted d-block">Tanggal : 20 Juni 2025</small>
                </div>
                <small class="text-primary fw-bold text-end ms-auto">Belum Terbaca</small>
            </div>
            <div class="notifikasi-item d-flex align-items-start p-3 border-bottom">
                <i class="bi bi-bell-fill me-3 fs-5 text-secondary"></i>
                <div class="flex-grow-1">
                    <span class="fw-bold d-block">Pelamar Baru untuk UI/UX Designer</span>
                    <small class="text-muted d-block">Jhon Doe Telah Melamar Untuk Posisi UI/UX Designer.</small>
                    <small class="text-muted d-block">Tanggal : 20 Juni 2025</small>
                </div>
                <small class="text-primary fw-bold text-end ms-auto">Belum Terbaca</small>
            </div>
            <div class="notifikasi-item d-flex align-items-start p-3">
                <i class="bi bi-bell-fill me-3 fs-5 text-secondary"></i>
                <div class="flex-grow-1">
                    <span class="fw-bold d-block">Pelamar Baru untuk UI/UX Designer</span>
                    <small class="text-muted d-block">Jhon Doe Telah Melamar Untuk Posisi UI/UX Designer.</small>
                    <small class="text-muted d-block">Tanggal : 20 Juni 2025</small>
                </div>
                <small class="text-primary fw-bold text-end ms-auto">Belum Terbaca</small>
            </div>
            {{-- Akhir dari loop --}}
        </div>
    </div>
@endsection