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
            @forelse ($notifications as $notification)
                @php
                    // Logika untuk menentukan tampilan notifikasi
                    $isUnread = is_null($notification->read_at);
                    $itemClass = $isUnread ? 'bg-light fw-bold' : '';
                    $statusText = $isUnread ? 'Belum Terbaca' : 'Sudah Terbaca';
                    $statusClass = $isUnread ? 'text-primary' : 'text-muted';
                @endphp
                <div class="notifikasi-item d-flex align-items-start p-3 border-bottom {{ $itemClass }}">
                    <i class="bi bi-bell-fill me-3 fs-5 text-secondary"></i>
                    <div class="flex-grow-1">
                        {{-- Buat notifikasi bisa diklik untuk menuju halaman detail pelamar --}}
                        <a href="{{ route('perusahaan.lowongan.pelamar.index', ['lowongan_id' => $notification->data['lowongan_id']]) }}" class="text-decoration-none text-dark">
                            <span class="d-block">Pelamar Baru untuk: {{ $notification->data['judul_lowongan'] }}</span>
                            <small class="text-muted d-block">{{ $notification->data['message'] }}</small>
                            <small class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
                        </a>
                    </div>
                    <small class="{{ $statusClass }} text-end ms-auto">{{ $statusText }}</small>
                </div>
            @empty
                <div class="notifikasi-item text-center p-4">
                    <i class="bi bi-bell-slash fs-3"></i>
                    <p class="mt-2 text-muted">Tidak ada notifikasi untuk Anda.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Tambahkan link pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $notifications->links() }}
    </div>
@endsection