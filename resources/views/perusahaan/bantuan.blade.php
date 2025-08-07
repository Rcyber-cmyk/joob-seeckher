@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Halaman --}}
    <div class="header-dashboard mb-4 text-center text-md-start">
        <h1 class="fw-bold">Pusat Bantuan</h1>
        <p class="text-muted">Temukan jawaban dan panduan penggunaan platform Anda di sini.</p>
    </div>

    {{-- Navigasi Bantuan Kategori --}}
    <div class="row g-3 mb-5">
        @php
            $cards = [
                ['icon' => 'briefcase', 'title' => 'Job Posting'],
                ['icon' => 'person-circle', 'title' => 'Cara Membuat Lamaran'],
                ['icon' => 'journal-text', 'title' => 'Joob'],
                ['icon' => 'send', 'title' => 'Pengajuan Lamaran'],
            ];
        @endphp
        @foreach ($cards as $index => $card)
            <div class="col-6 col-md-3">
                <div class="info-card p-4 text-center {{ $index === 0 ? 'active' : '' }}">
                    <i class="bi bi-{{ $card['icon'] }} fs-2 mb-2"></i>
                    <h6 class="fw-semibold text-secondary mb-0">{{ $card['title'] }}</h6>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4">
        {{-- Kolom Kiri --}}
        <div class="col-lg-6">
            <div class="dashboard-section h-100 shadow-sm p-4 rounded-4 bg-white">
                <h5 class="mb-4 fw-bold">Cara Mengelola Lamaran</h5>
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex align-items-center">
                        <i class="bi bi-gear-fill me-3 fs-5 text-primary"></i>
                        <span class="fw-medium">Pengaturan Akun</span>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <i class="bi bi-star-fill me-3 fs-5 text-warning"></i>
                        <span class="fw-medium">Preferensi</span>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <i class="bi bi-wrench-adjustable-fill me-3 fs-5 text-success"></i>
                        <span class="fw-medium">Teknik</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-lg-6">
            <div class="dashboard-section h-100 d-flex flex-column shadow-sm p-4 rounded-4 bg-white">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <h5 class="fw-bold mb-2 mb-md-0">Butuh Bantuan Langsung?</h5>
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-chat-dots me-1"></i> Hubungi Kami
                    </a>
                </div>

                {{-- Live Chat --}}
                <div class="mb-4">
                    <div class="input-group shadow-sm rounded">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="Cari topik atau pertanyaan...">
                    </div>
                </div>

                {{-- FAQ --}}
                <div class="faq-section mt-auto">
                    <h6 class="fw-semibold mb-3">Pertanyaan Umum</h6>
                    <ul class="list-unstyled ps-2">
                        <li class="mb-2">
                            <i class="bi bi-chevron-right me-2 text-primary"></i>
                            Bagaimana menempatkan posisi atau jabatan di struktur organisasi?
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-chevron-right me-2 text-primary"></i>
                            Apakah saya bisa mengatur ulang lamaran yang sudah dikirim?
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-chevron-right me-2 text-primary"></i>
                            Bagaimana mengelola kembali lamaran yang sudah dibuat sebelumnya?
                        </li>
                    </ul>
                </div>

                <div class="text-center mt-4">
                    <a href="#" class="btn btn-primary px-4 py-2">Masih butuh bantuan?</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    .info-card {
        background-color: #f8f9fa;
        border-radius: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border-color: #0d6efd;
    }

    .info-card.active {
        border-color: #0d6efd;
        background-color: #e9f3ff;
    }

    .faq-section ul {
        list-style: none;
        padding: 0;
    }

    .faq-section li {
        transition: color 0.2s;
    }

    .faq-section li:hover {
        color: #0d6efd;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .info-card {
            margin-bottom: 1rem;
        }

        .dashboard-section {
            padding: 1.5rem !important;
        }
    }
</style>
@endpush
