@extends('perusahaan.layouts.app')

@section('content')

<style>
    /* --- STYLING KHUSUS HALAMAN NOTIFIKASI --- */

    .notifikasi-item {
        position: relative; /* WAJIB agar stretched-link tidak keluar */
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .notifikasi-item:hover {
        background: #f7f9fc !important;
        transform: translateX(3px);
    }

    .notif-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notif-title {
        font-size: 1rem;
        font-weight: 600;
    }

    .notif-msg {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .notif-time {
        font-size: 0.75rem;
    }

    .badge-sm {
        font-size: 0.65rem;
        padding: 4px 8px;
    }

    /* Mobile Improvements */
    @media(max-width: 576px) {
        .notif-icon {
            width: 40px;
            height: 40px;
        }
        .notif-title {
            font-size: 0.95rem;
        }
    }

</style>


{{-- HEADER --}}
<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-semibold">🔔 Notifikasi Rekrutmen</h1>
        <p class="text-muted">Lihat pembaruan terbaru terkait aktivitas rekrutmen perusahaan Anda.</p>
    </div>
</div>


{{-- ACTION BUTTON --}}
<div class="mb-3">
    <form action="{{ route('perusahaan.notifikasi.markAllAsRead') }}" 
          method="POST" 
          onclick="event.stopPropagation();">
        @csrf
        <button type="submit" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-check-all me-2"></i>
            Tandai Semua Sudah Dibaca
        </button>
    </form>
</div>


{{-- NOTIFICATION CARD --}}
<div class="dashboard-section p-0 bg-white rounded shadow-sm">

    @forelse ($notifications as $notification)
        @php
            $isUnread = is_null($notification->read_at);

            $itemClass = $isUnread 
                ? 'bg-light border-start border-4 border-primary' 
                : 'bg-white';

            // Identify icon
            $type = $notification->data['type'] ?? '';
            $icon = 'bi-bell-fill';
            $iconBg = '#e9ecef';
            $iconColor = '#6c757d';

            if (str_contains($type, 'approved')) {
                $icon = 'bi-cash-coin';
                $iconBg = 'rgba(25,135,84,0.15)';
                $iconColor = '#198754';
            } elseif (str_contains($type, 'application')) {
                $icon = 'bi-person-plus-fill';
                $iconBg = 'rgba(13,110,253,0.15)';
                $iconColor = '#0d6efd';
            } elseif (str_contains($type, 'schedule')) {
                $icon = 'bi-calendar-event-fill';
                $iconBg = 'rgba(32,201,151,0.15)';
                $iconColor = '#20c997';
            }
        @endphp

        <div class="notifikasi-item p-3 border-bottom {{ $itemClass }}">

            <div class="d-flex">
                {{-- ICON --}}
                <div class="notif-icon me-3" style="background: {{ $iconBg }};">
                    <i class="bi {{ $icon }} fs-5" style="color: {{ $iconColor }};"></i>
                </div>

                {{-- CONTENT --}}
                <div class="flex-grow-1">

                    <a href="{{ route('perusahaan.notifikasi.readAndRedirect', $notification->id) }}"
                       class="stretched-link text-decoration-none text-dark">

                        <div class="d-flex justify-content-between">
                            <span class="notif-title">
                                {{ $notification->data['title'] ?? 'Notifikasi' }}
                            </span>

                            @if($isUnread)
                                <span class="badge bg-primary badge-sm">Baru</span>
                            @else
                                <span class="badge bg-secondary badge-sm">Terbaca</span>
                            @endif
                        </div>

                        <div class="notif-msg mt-1">
                            {{ $notification->data['message'] ?? '' }}
                        </div>

                        <div class="notif-time text-muted mt-1">
                            <i class="bi bi-clock"></i> {{ $notification->created_at->diffForHumans() }}
                        </div>

                    </a>
                </div>
            </div>

        </div>

    @empty

        <div class="text-center p-5">
            <i class="bi bi-bell-slash fs-1 text-muted"></i>
            <h5 class="mt-2">Tidak ada notifikasi</h5>
            <p class="text-muted small">Anda akan melihat pembaruan ketika ada aktivitas baru.</p>
        </div>

    @endforelse
</div>


{{-- PAGINATION --}}
<div class="mt-4 d-flex justify-content-center">
    {{ $notifications->links() }}
</div>

@endsection
