{{-- /resources/views/pelamar/aktivitas/index.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Aktivitas Saya')

@section('content')
{{-- HAPUS FOOTER --}}
<style>footer.footer { display: none !important; }</style>

<div class="activity-page bg-light" style="min-height: 100vh;">
    <div class="container py-5">
        
        {{-- Header Halaman --}}
        <div class="row mb-4 align-items-end">
            <div class="col-md-8">
                <h2 class="fw-bold text-dark mb-1">Aktivitas Saya</h2>
                <p class="text-muted mb-0">Pantau status lamaran dan lowongan yang Anda simpan.</p>
            </div>
        </div>

        {{-- Tab Navigasi --}}
        <ul class="nav nav-pills nav-fill custom-nav-pills mb-4 bg-white p-1 rounded-pill shadow-sm border" id="aktivitasTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill py-2 fw-bold" id="disimpan-tab" data-bs-toggle="tab" data-bs-target="#disimpan-tab-pane" type="button" role="tab">
                    <i class="bi bi-bookmark-fill me-2"></i> Pekerjaan Disimpan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill py-2 fw-bold" id="lamaran-tab" data-bs-toggle="tab" data-bs-target="#lamaran-tab-pane" type="button" role="tab">
                    <i class="bi bi-send-fill me-2"></i> Riwayat Lamaran
                </button>
            </li>
        </ul>

        <div class="tab-content" id="aktivitasTabContent">
            
            {{-- TAB 1: PEKERJAAN DISIMPAN --}}
            <div class="tab-pane fade show active" id="disimpan-tab-pane" role="tabpanel">
                <div class="row g-3">
                    @forelse($pekerjaanDisimpan as $lowongan)
                    <div class="col-md-6 col-lg-12"> {{-- Grid di mobile, Full di desktop --}}
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="card-body p-4 d-lg-flex align-items-center gap-4">
                                {{-- Logo --}}
                                <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" 
                                     alt="Logo" class="rounded-3 border p-1 bg-white mb-3 mb-lg-0" style="width: 60px; height: 60px; object-fit: contain;">
                                
                                {{-- Detail --}}
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1 text-dark">
                                        <a href="{{ route('pelamar.lowongan.show', $lowongan->id) }}" class="text-decoration-none text-dark hover-orange">{{ $lowongan->judul_lowongan }}</a>
                                    </h5>
                                    <p class="text-muted mb-1 small">{{ $lowongan->perusahaan->nama_perusahaan }} • <i class="bi bi-geo-alt-fill text-orange"></i> {{ $lowongan->domisili }}</p>
                                    <small class="text-muted fst-italic">Disimpan {{ $lowongan->pivot->created_at->diffForHumans() }}</small>
                                </div>

                                {{-- Aksi --}}
                                <div class="d-flex flex-column gap-2 mt-3 mt-lg-0 action-buttons">
                                    <a href="{{ route('pelamar.lowongan.show', $lowongan->id) }}" class="btn btn-orange btn-sm px-4 rounded-pill">Lihat Detail</a>
                                    <form action="{{ route('lowongan.toggleSimpan', $lowongan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-4 rounded-pill w-100">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <img src="{{ asset('images/empty-state.svg') }}" alt="Empty" style="width: 150px; opacity: 0.5;">
                        <p class="text-muted mt-3">Belum ada pekerjaan yang disimpan.</p>
                        <a href="{{ route('lowongan.index') }}" class="btn btn-outline-orange rounded-pill px-4">Cari Lowongan</a>
                    </div>
                    @endforelse
                </div>
                
                {{-- Pagination --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $pekerjaanDisimpan->appends(['active_tab' => 'disimpan'])->links() }}
                </div>
            </div>

            {{-- TAB 2: RIWAYAT LAMARAN --}}
            <div class="tab-pane fade" id="lamaran-tab-pane" role="tabpanel">
                
                {{-- Statistik Ringkas --}}
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="card border-0 shadow-sm rounded-4 bg-white text-center p-3">
                            <h3 class="fw-bold text-orange mb-0">{{ $totalLamaran }}</h3>
                            <small class="text-muted fw-bold text-uppercase">Total Lamaran</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm rounded-4 bg-white text-center p-3">
                            <h3 class="fw-bold text-primary mb-0">{{ $dilihatPerusahaan }}</h3>
                            <small class="text-muted fw-bold text-uppercase">Dilihat HRD</small>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    @forelse($riwayatLamaran as $lamaran)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                            
                            {{-- Header Kartu Lamaran --}}
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $lamaran->lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lamaran->lowongan->perusahaan->logo_perusahaan) : asset('images/default-logo.png') }}" 
                                         alt="Logo" class="rounded-3 border p-1 bg-white" style="width: 50px; height: 50px; object-fit: contain;">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $lamaran->lowongan->judul_lowongan }}</h6>
                                        <small class="text-muted">{{ $lamaran->lowongan->perusahaan->nama_perusahaan }}</small>
                                    </div>
                                </div>
                                <div class="text-end d-none d-md-block">
                                    <small class="text-muted d-block">Tanggal Lamar</small>
                                    <span class="fw-medium text-dark">{{ $lamaran->created_at->format('d M Y') }}</span>
                                </div>
                            </div>

                            {{-- Timeline Status --}}
                            <div class="timeline-wrapper my-4 px-2">
                                @php
                                    $status = $lamaran->status;
                                    $step1 = 'active'; // Terkirim selalu aktif
                                    $step2 = in_array($status, ['dilihat', 'diterima', 'ditolak']) ? 'active' : '';
                                    $step3 = in_array($status, ['diterima', 'ditolak']) ? 'active' : '';
                                    
                                    // Warna Step 3
                                    $step3Color = 'bg-secondary'; // Default
                                    $step3Icon = 'bi-question-lg';
                                    $step3Label = 'Keputusan';
                                    
                                    if ($status == 'diterima') {
                                        $step3Color = 'bg-success'; $step3Icon = 'bi-check-lg'; $step3Label = 'Diterima';
                                    } elseif ($status == 'ditolak') {
                                        $step3Color = 'bg-danger'; $step3Icon = 'bi-x-lg'; $step3Label = 'Ditolak';
                                    } elseif ($step2 == 'active' && $status != 'dilihat') {
                                         // Pending keputusan
                                    }
                                @endphp

                                <div class="position-relative">
                                    {{-- Garis Progress --}}
                                    <div class="progress" style="height: 2px;">
                                        <div class="progress-bar bg-orange" role="progressbar" style="width: {{ $status == 'pending' ? '0%' : ($status == 'dilihat' ? '50%' : '100%') }};"></div>
                                    </div>
                                    
                                    {{-- Titik-titik Timeline --}}
                                    <div class="position-absolute top-0 start-0 translate-middle-y w-100 d-flex justify-content-between">
                                        
                                        {{-- Step 1: Terkirim --}}
                                        <div class="text-center timeline-point">
                                            <div class="rounded-circle bg-orange text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 30px; height: 30px;">
                                                <i class="bi bi-send-fill small"></i>
                                            </div>
                                            <small class="d-block mt-2 fw-bold text-orange">Terkirim</small>
                                        </div>

                                        {{-- Step 2: Dilihat --}}
                                        <div class="text-center timeline-point">
                                            <div class="rounded-circle {{ $step2 ? 'bg-primary text-white' : 'bg-light text-muted border' }} d-flex align-items-center justify-content-center shadow-sm" style="width: 30px; height: 30px;">
                                                <i class="bi bi-eye-fill small"></i>
                                            </div>
                                            <small class="d-block mt-2 fw-bold {{ $step2 ? 'text-primary' : 'text-muted' }}">Dilihat</small>
                                        </div>

                                        {{-- Step 3: Keputusan --}}
                                        <div class="text-center timeline-point">
                                            <div class="rounded-circle {{ $step3 ? $step3Color . ' text-white' : 'bg-light text-muted border' }} d-flex align-items-center justify-content-center shadow-sm" style="width: 30px; height: 30px;">
                                                <i class="bi {{ $step3Icon }} small"></i>
                                            </div>
                                            <small class="d-block mt-2 fw-bold {{ $step3 ? ($status == 'diterima' ? 'text-success' : 'text-danger') : 'text-muted' }}">{{ $step3Label }}</small>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Footer Kartu (Batal Lamar) --}}
                            @if(in_array($lamaran->status, ['pending', 'dilihat']))
                            <div class="text-end border-top pt-3 mt-2">
                                <form action="{{ route('pelamar.lamaran.destroy', $lamaran->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan lamaran ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 small">
                                        <i class="bi bi-x-circle me-1"></i> Batalkan Lamaran
                                    </button>
                                </form>
                            </div>
                            @endif

                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <img src="{{ asset('images/empty-state.svg') }}" alt="Empty" style="width: 150px; opacity: 0.5;">
                        <p class="text-muted mt-3">Belum ada riwayat lamaran.</p>
                        <a href="{{ route('lowongan.index') }}" class="btn btn-outline-orange rounded-pill px-4">Mulai Melamar</a>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $riwayatLamaran->appends(['active_tab' => 'lamaran'])->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* === Base Styles (Global) === */
    .main-content { background-color: #f8f9fa; min-height: 100vh; }
    .text-orange { color: #F39C12 !important; }
    .bg-orange { background-color: #F39C12 !important; }
    
    /* Buttons */
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: white; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; color: white; }
    .btn-outline-orange { color: #F39C12; border-color: #F39C12; }
    .btn-outline-orange:hover { background-color: #F39C12; color: white; }

    /* Tab Menu Desktop */
    .custom-nav-pills {
        background-color: #fff; padding: 0.5rem; border-radius: 50px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05); border: 1px solid #dee2e6;
        display: flex; gap: 0.5rem;
    }
    .custom-nav-pills .nav-link {
        color: #6c757d; transition: all 0.3s; border-radius: 50px;
        font-weight: 600; padding: 0.6rem 1rem; flex: 1; text-align: center;
    }
    .custom-nav-pills .nav-link:hover { background-color: #f8f9fa; color: #F39C12; }
    .custom-nav-pills .nav-link.active {
        background-color: #F39C12; color: white;
        box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3);
    }

    /* === TIMELINE DESKTOP (Update: Hapus Garis) === */
    .timeline-wrapper { 
        padding: 0 3rem; 
        margin-top: 2rem; 
        margin-bottom: 1rem;
    }
    
    /* Hapus Garis Progress Bar di Desktop */
    .timeline-wrapper .progress {
        display: none !important; /* <-- HAPUS GARIS INI */
    }

    .timeline-point { 
        position: relative; 
        z-index: 2; 
        width: 100px; 
        text-align: center; 
    }
    .timeline-point .rounded-circle { 
        margin: 0 auto; 
        background-color: #fff; 
        width: 40px; /* Ikon sedikit diperbesar biar jelas */
        height: 40px; 
        border: 2px solid #e9ecef; 
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* Tambah shadow biar menonjol */
    }
    .timeline-point small { 
        display: block; 
        margin-top: 0.8rem; 
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    /* Statistik Card */
    .stats-card h3 { font-size: 1.8rem; }

    /* === MOBILE RESPONSIVE (Update: Hapus Garis Vertikal) === */
    @media (max-width: 767.98px) {
        .custom-nav-pills {
            border-radius: 12px; padding: 5px; margin-bottom: 1.5rem !important;
        }
        .custom-nav-pills .nav-link {
            font-size: 0.85rem; padding: 8px 5px; border-radius: 8px;
        }
        .stats-card { padding: 1rem !important; }
        .stats-card h3 { font-size: 1.4rem; }
        .stats-card small { font-size: 0.65rem; }

        /* Header Kartu Mobile */
        .company-info { align-items: flex-start !important; }
        .company-logo { width: 45px; height: 45px; margin-right: 12px; border-radius: 8px; flex-shrink: 0; }
        .company-details h5 { font-size: 1rem; margin-bottom: 2px; line-height: 1.3; }
        .company-details p { font-size: 0.85rem; }

        /* Timeline Mobile */
        .timeline-wrapper {
            margin-top: 1.5rem; padding-left: 0; padding-right: 0;
            display: flex; flex-direction: column; gap: 0;
        }
        
        /* Hapus elemen absolut (garis) di mobile */
        .timeline-wrapper .position-absolute {
            display: none !important; /* <-- HAPUS GARIS VERTIKAL INI */
        }

        .timeline-point {
            width: 100%; text-align: left !important; margin-bottom: 1rem;
            display: flex; align-items: center;
        }
        .timeline-point:last-child { margin-bottom: 0; }

        .timeline-point .rounded-circle {
            /* Reset posisi absolute */
            position: static; 
            margin-right: 12px; /* Jarak ikon ke teks */
            width: 32px; height: 32px; 
            background-color: white; border: 1px solid #e9ecef; 
            z-index: 2; font-size: 0.9rem;
        }
        .timeline-point small { margin-top: 0 !important; font-size: 0.9rem; }

        /* Tombol Batal Mobile */
        .job-actions {
            text-align: center !important; border-top: 1px solid #f0f0f0;
            padding-top: 1rem; margin-top: 1rem; width: 100%;
        }
        .job-actions form { width: 100%; }
        .job-actions .btn-outline-danger {
            width: 100%; border-radius: 50px; font-size: 0.85rem; padding: 8px;
        }
    }
</style>
@endpush