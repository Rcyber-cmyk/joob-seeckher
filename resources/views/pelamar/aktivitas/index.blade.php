@extends('pelamar.layouts.app')

@section('title', 'Aktivitas Saya')

@section('content')
{{-- HAPUS FOOTER --}}
<style>footer.footer { display: none !important; }</style>

<div class="dashboard-activity bg-light-gray min-vh-100 pb-5">
    
    {{-- HEADER DASHBOARD --}}
    <div class="dashboard-header bg-dark-blue text-white pt-5 pb-5 px-4 rounded-bottom-5 position-relative overflow-hidden">
        <div class="container position-relative z-2">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="badge bg-white bg-opacity-10 mb-2 px-3 py-1 rounded-pill fw-normal">Dashboard Pelamar</span>
                    <h2 class="fw-black mb-1">Aktivitas & Lamaran</h2>
                    <p class="text-white-50 mb-0">Pantau progres karirmu secara real-time.</p>
                </div>
            </div>
        </div>
        <div class="header-pattern"></div>
    </div>

    <div class="container mt-n5 position-relative z-3">
        
        {{-- 1. STATS & CHART SECTION --}}
        {{-- 1. STATS CARDS (GRID 4) --}}
        <div class="row g-3 mb-4">
            {{-- Card Total --}}
            <div class="col-6 col-md-3">
                <div class="stat-card bg-white rounded-4 shadow-sm">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    <h3 class="fw-bold text-dark-blue mb-0">{{ $stats['total'] }}</h3>
                    <small class="text-muted fw-bold text-uppercase ls-1" style="font-size: 0.65rem;">Total Lamaran</small>
                </div>
            </div>

            {{-- Card Interview --}}
            <div class="col-6 col-md-3">
                <div class="stat-card bg-white rounded-4 shadow-sm">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <h3 class="fw-bold text-dark-blue mb-0">{{ $stats['interview'] }}</h3>
                    <small class="text-muted fw-bold text-uppercase ls-1" style="font-size: 0.65rem;">Jadwal Interview</small>
                </div>
            </div>

            {{-- Card Diterima --}}
            <div class="col-6 col-md-3">
                <div class="stat-card bg-white rounded-4 shadow-sm">
                    <div class="icon-box bg-success bg-opacity-10 text-success">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <h3 class="fw-bold text-dark-blue mb-0">{{ $stats['diterima'] }}</h3>
                    <small class="text-muted fw-bold text-uppercase ls-1" style="font-size: 0.65rem;">Lolos Seleksi</small>
                </div>
            </div>

            {{-- Card Disimpan --}}
            <div class="col-6 col-md-3">
                <div class="stat-card bg-white rounded-4 shadow-sm">
                    <div class="icon-box bg-secondary bg-opacity-10 text-secondary">
                        <i class="bi bi-bookmark-fill"></i>
                    </div>
                    <h3 class="fw-bold text-dark-blue mb-0">{{ $pekerjaanDisimpan->total() }}</h3>
                    <small class="text-muted fw-bold text-uppercase ls-1" style="font-size: 0.65rem;">Disimpan</small>
                </div>
            </div>
        </div>

        {{-- 2. TABS NAVIGASI --}}
        <ul class="nav nav-pills custom-nav-pills mb-4 bg-white p-1 rounded-pill shadow-sm border mx-auto" style="max-width: 600px;" id="aktivitasTab" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link active rounded-pill py-2 fw-bold w-100" id="lamaran-tab" data-bs-toggle="tab" data-bs-target="#lamaran-tab-pane" type="button" role="tab">
                    <i class="bi bi-send-fill me-2"></i> Riwayat Lamaran
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link rounded-pill py-2 fw-bold w-100" id="disimpan-tab" data-bs-toggle="tab" data-bs-target="#disimpan-tab-pane" type="button" role="tab">
                    <i class="bi bi-bookmark-fill me-2"></i> Disimpan
                </button>
            </li>
        </ul>

        <div class="tab-content" id="aktivitasTabContent">
            
            {{-- TAB 1: RIWAYAT LAMARAN --}}
            <div class="tab-pane fade show active" id="lamaran-tab-pane" role="tabpanel">
                <div class="row g-4">
                    @forelse($riwayatLamaran as $lamaran)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 card-hover">
                            
                            {{-- Header Kartu --}}
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $lamaran->lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lamaran->lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/50x50/e9ecef/343a40?text=Logo' }}" 
                                         alt="Logo" class="rounded-3 border p-1 bg-white shadow-sm" style="width: 55px; height: 55px; object-fit: contain;">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark-blue fs-5">{{ $lamaran->lowongan->judul_lowongan }}</h6>
                                        <p class="text-muted small mb-0">{{ $lamaran->lowongan->perusahaan->nama_perusahaan }}</p>
                                    </div>
                                </div>
                                <div class="text-end d-none d-md-block">
                                    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill fw-normal">
                                        <i class="bi bi-clock me-1"></i> {{ $lamaran->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            {{-- TIMELINE STATUS (RESPONSIVE) --}}
                            {{-- TIMELINE STATUS (FIXED ICON) --}}
                            <div class="timeline-container px-2 mb-3">
                                @php
                                    $s = $lamaran->status; // pending, dilihat, diterima, ditolak, interview
                                    
                                    // Logika Step Aktif
                                    // Step 1: Terkirim (Selalu Aktif)
                                    $step1Class = 'active-orange'; 
                                    
                                    // Step 2: Dilihat
                                    $isSeen = in_array($s, ['dilihat', 'interview', 'diterima', 'ditolak']);
                                    $step2Class = $isSeen ? 'active-blue' : 'text-muted';
                                    
                                    // Step 3: Keputusan
                                    $isDecided = in_array($s, ['diterima', 'ditolak']);
                                    $step3Class = 'text-muted';
                                    $step3Icon = 'bi-question-lg';
                                    $step3Text = 'Keputusan';

                                    if ($s == 'diterima') {
                                        $step3Class = 'active-green'; $step3Icon = 'bi-check-lg'; $step3Text = 'Diterima';
                                    } elseif ($s == 'ditolak') {
                                        $step3Class = 'active-red'; $step3Icon = 'bi-x-lg'; $step3Text = 'Ditolak';
                                    }
                                @endphp

                                <div class="d-flex justify-content-between position-relative align-items-center timeline-flex">
                                    {{-- Garis Background --}}
                                    <div class="position-absolute top-50 start-0 w-100 translate-middle-y timeline-line"></div>
                                    
                                    {{-- Garis Progress (Warna Oranye) --}}
                                    <div class="position-absolute top-50 start-0 translate-middle-y timeline-line-active" 
                                         style="width: {{ $s == 'pending' ? '0%' : ($isSeen && !$isDecided ? '50%' : '100') }}%;"></div>

                                    {{-- Step 1: Terkirim --}}
                                    <div class="timeline-step text-center position-relative z-1">
                                        <div class="step-icon {{ $step1Class }}">
                                            <i class="bi bi-send-fill"></i>
                                        </div>
                                        <span class="step-label text-dark">Terkirim</span>
                                    </div>

                                    {{-- Step 2: Dilihat --}}
                                    <div class="timeline-step text-center position-relative z-1">
                                        <div class="step-icon {{ $step2Class }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </div>
                                        <span class="step-label {{ $isSeen ? 'text-dark' : 'text-muted' }}">Dilihat</span>
                                    </div>

                                    {{-- Step 3: Keputusan --}}
                                    <div class="timeline-step text-center position-relative z-1">
                                        <div class="step-icon {{ $step3Class }}">
                                            <i class="bi {{ $step3Icon }}"></i>
                                        </div>
                                        <span class="step-label {{ $isDecided ? 'text-dark' : 'text-muted' }}">{{ $step3Text }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Actions --}}
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top border-light">
                                <a href="{{ route('pelamar.lowongan.show', $lamaran->lowongan->id) }}" class="text-decoration-none text-muted small hover-orange">
    <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Lowongan
</a>
                                @if(in_array($lamaran->status, ['pending', 'dilihat']))
                                    <form action="{{ route('pelamar.lamaran.destroy', $lamaran->id) }}" method="POST" onsubmit="return confirm('Batalkan lamaran ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-pill px-3 border-0">
                                            <i class="bi bi-trash me-1"></i> Batalkan
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-inbox text-muted display-1 opacity-25"></i>
                        <p class="text-muted mt-3">Belum ada riwayat lamaran.</p>
                        <a href="{{ route('lowongan.index') }}" class="btn btn-orange rounded-pill px-4">Cari Lowongan</a>
                    </div>
                    @endforelse
                </div>
                
                {{-- Pagination --}}
                <div class="mt-5 d-flex justify-content-center">
                    {{ $riwayatLamaran->appends(['active_tab' => 'lamaran'])->links() }}
                </div>
            </div>

            {{-- TAB 2: PEKERJAAN DISIMPAN --}}
            <div class="tab-pane fade" id="disimpan-tab-pane" role="tabpanel">
                <div class="row g-3">
                    @forelse($pekerjaanDisimpan as $lowongan)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100 card-hover">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between mb-3">
                                    <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/50x50/e9ecef/343a40?text=L' }}" 
                                         class="rounded-3 border p-1 bg-white" width="50" height="50">
                                    <form action="{{ route('lowongan.toggleSimpan', $lowongan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                                <h5 class="fw-bold text-dark-blue mb-1 text-truncate">{{ $lowongan->judul_lowongan }}</h5>
                                <p class="text-muted small mb-3">{{ $lowongan->perusahaan->nama_perusahaan }}</p>
                                
                                <div class="mt-auto pt-3 border-top">
                                    <div class="d-grid">
                                        <a href="{{ route('pelamar.lowongan.show', $lowongan->id) }}" class="btn btn-outline-primary btn-sm rounded-pill fw-bold">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada pekerjaan disimpan.</p>
                    </div>
                    @endforelse
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $pekerjaanDisimpan->appends(['active_tab' => 'disimpan'])->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --c-dark-blue: #22374e;
        --c-orange: #F39C12;
        --c-bg-light: #f4f6f9;
    }
    .bg-dark-blue { background-color: var(--c-dark-blue); }
    .bg-light-gray { background-color: var(--c-bg-light); }
    .text-dark-blue { color: var(--c-dark-blue); }
    .text-orange { color: var(--c-orange); }
    .bg-orange { background-color: var(--c-orange); }
    
    /* Header */
    .dashboard-header { border-bottom-left-radius: 2.5rem; border-bottom-right-radius: 2.5rem; }
    .header-pattern {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px; pointer-events: none; opacity: 0.5;
    }
    .mt-n5 { margin-top: -4rem; }

    /* --- PERBAIKAN CARD STATISTIK --- */
    .stat-card { 
        transition: transform 0.2s, box-shadow 0.2s; 
        border: 1px solid rgba(0,0,0,0.05) !important;
        display: flex; flex-direction: column; 
        align-items: center; justify-content: center; /* Konten di tengah */
        padding: 1.5rem !important;
        height: 100%;
    }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
    
    .icon-box { 
        width: 50px; height: 50px; /* Lebih besar dikit */
        border-radius: 12px; 
        display: flex; align-items: center; justify-content: center; 
        margin-bottom: 10px;
        font-size: 1.4rem;
    }

    /* Tabs */
    .custom-nav-pills .nav-link { color: #6c757d; transition: all 0.3s; }
    .custom-nav-pills .nav-link.active { background-color: var(--c-orange); color: white; box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3); }

    /* --- PERBAIKAN TIMELINE ICONS --- */
    .timeline-container { padding: 0 1rem; margin-bottom: 1rem; }
    
    .timeline-line {
        height: 3px !important; background-color: #e9ecef; z-index: 0;
    }
    .timeline-line-active {
        height: 3px !important; background-color: var(--c-orange); z-index: 0;
    }

    .step-icon {
        width: 40px; height: 40px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 0.5rem auto; font-size: 1.1rem; 
        transition: all 0.3s;
        z-index: 2; position: relative; /* Pastikan di atas garis */
        background-color: white; /* Wajib ada background biar garis ketutup */
        border: 2px solid #e9ecef;
    }
    
    /* Warna Khusus Step Active */
    .step-icon.active-orange {
        background-color: var(--c-orange); 
        color: white; 
        border-color: var(--c-orange);
        box-shadow: 0 0 0 4px rgba(243, 156, 18, 0.2); /* Efek glowing */
    }
    .step-icon.active-blue {
        background-color: #0dcaf0; color: white; border-color: #0dcaf0;
        box-shadow: 0 0 0 4px rgba(13, 202, 240, 0.2);
    }
    .step-icon.active-green {
        background-color: #198754; color: white; border-color: #198754;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2);
    }
    .step-icon.active-red {
        background-color: #dc3545; color: white; border-color: #dc3545;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.2);
    }

    .step-label { font-size: 0.75rem; font-weight: 700; display: block; margin-top: 5px; }

    /* Mobile Timeline Fix */
    @media (max-width: 767.98px) {
        .timeline-flex { flex-direction: column; align-items: flex-start; gap: 1.5rem; padding-left: 1rem; }
        .timeline-line, .timeline-line-active {
            width: 3px !important; height: 100% !important; 
            top: 0 !important; left: 29px !important; transform: none !important;
        }
        .timeline-step { display: flex; align-items: center; gap: 1rem; width: 100%; text-align: left !important; }
        .step-icon { margin: 0; } 
        .step-label { margin-top: 0; font-size: 0.9rem; }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartData = @json($chartData);
        const total = {{ $stats['total'] }};

        if (total > 0) {
            var options = {
                series: chartData, // [Pending, Dilihat, Diterima, Ditolak]
                chart: { type: 'donut', height: 280, fontFamily: 'Segoe UI, sans-serif' },
                labels: ['Pending', 'Dilihat', 'Diterima', 'Ditolak'],
                colors: ['#adb5bd', '#0dcaf0', '#198754', '#dc3545'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                total: {
                                    show: true, label: 'Total', fontSize: '14px', fontWeight: 600, color: '#22374e',
                                    formatter: function (w) { return w.globals.seriesTotals.reduce((a, b) => a + b, 0) }
                                }
                            }
                        }
                    }
                },
                dataLabels: { enabled: false },
                legend: { position: 'bottom', markers: { radius: 12 } },
                stroke: { show: false }
            };
            var chart = new ApexCharts(document.querySelector("#statusChart"), options);
            chart.render();
        }
    });
</script>
@endpush