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
        {{-- Tombol Tandai Semua Sudah Dibaca (Menggunakan Form untuk POST) --}}
        <form action="{{ route('perusahaan.notifikasi.markAllAsRead') }}" method="POST">
            @csrf
            <button class="btn btn-primary d-flex align-items-center btn-post" type="submit">
                <i class="bi bi-check-all me-1"></i> Tandai Semua Sudah Dibaca
            </button>
        </form>
    </div>

    {{-- Daftar Notifikasi --}}
    <div class="dashboard-section p-0">
        <div class="notifikasi-list">
            @forelse ($notifications as $notification)
                @php
                    $isUnread = is_null($notification->read_at);
                    $itemClass = $isUnread ? 'bg-light fw-bold' : '';
                    $statusText = $isUnread ? 'Baru' : 'Terbaca';
                    $statusClass = $isUnread ? 'text-primary' : 'text-muted';
                @endphp
                
                {{-- Gunakan $notification->data['action_url'] yang sudah kita simpan di notifikasi --}}
                <div class="notifikasi-item d-flex align-items-start p-3 border-bottom {{ $itemClass }}">
                    <i class="bi bi-bell-fill me-3 fs-5 text-secondary"></i>
                    <div class="flex-grow-1">
                        {{-- Arahkan ke route readAndRedirect, yang kemudian akan membawa user ke URL yang benar --}}
                        <a href="{{ route('perusahaan.lowongan.pelamar.index', ['lowongan_id' => $notification->data['lowongan_id']]) }}" class="text-decoration-none text-dark">
                            <span class="d-block fw-bold">{{ $notification->data['title'] ?? 'Notifikasi Baru' }}</span>
                            <small class="text-muted d-block">{{ $notification->data['message'] ?? 'Klik untuk detail.' }}</small>
                            <small class="text-muted d-block mt-1">{{ $notification->created_at->diffForHumans() }}</small>
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