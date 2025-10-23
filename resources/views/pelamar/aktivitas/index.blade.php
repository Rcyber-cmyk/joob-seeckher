{{-- /resources/views/pelamar/aktivitas/index.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Aktivitas Saya')

@section('content')
<div class="main-content">
    <div class="container py-5">
        <div class="page-header mb-4">
            <h1 class="page-title">Aktivitas Saya</h1>
            <p class="page-subtitle">Lacak lowongan yang Anda simpan dan lamaran yang telah Anda kirim.</p>
        </div>

        <ul class="nav nav-pills nav-fill mb-4" id="aktivitasTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="disimpan-tab" data-bs-toggle="tab" data-bs-target="#disimpan-tab-pane" type="button" role="tab" aria-controls="disimpan-tab-pane" aria-selected="true">
                    <i class="bi bi-bookmark-fill me-2"></i>Pekerjaan Disimpan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="lamaran-tab" data-bs-toggle="tab" data-bs-target="#lamaran-tab-pane" type="button" role="tab" aria-controls="lamaran-tab-pane" aria-selected="false">
                    <i class="bi bi-file-earmark-check-fill me-2"></i>Riwayat Lamaran
                </button>
            </li>
        </ul>

        <div class="tab-content" id="aktivitasTabContent">
            {{-- KONTEN TAB PEKERJAAN DISIMPAN --}}
            <div class="tab-pane fade show active" id="disimpan-tab-pane" role="tabpanel" aria-labelledby="disimpan-tab" tabindex="0">
            @forelse($pekerjaanDisimpan as $lowongan)
                <div class="job-card-aktivitas">
                    <div class="company-info">
                        <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" alt="Logo" class="company-logo">
                        <div class="company-details">
                            <h5 class="job-title"><a href="{{ route('lowongan.index', ['view' => $lowongan->id]) }}">{{ $lowongan->judul_lowongan }}</a></h5>
                            <p class="company-name text-muted">{{ $lowongan->perusahaan->nama_perusahaan }}</p>
                            <p class="location text-muted mb-2"><i class="bi bi-geo-alt-fill"></i>{{ $lowongan->perusahaan->alamat_kota ?? 'Lokasi tidak tersedia' }}</p>
                            <p class="job-description">{{ Str::limit($lowongan->deskripsi_pekerjaan, 120) }}</p>
                        </div>
                    </div>
                    <div class="job-actions">
                        @if ($lowongan->pivot && $lowongan->pivot->created_at)
                            <small class="text-muted d-block mb-2">Disimpan {{ $lowongan->pivot->created_at->diffForHumans() }}</small>
                        @endif
                        
                        {{-- Tombol Lihat Detail (dibuat full-width) --}}
                        <a href="{{ route('lowongan.index', ['view' => $lowongan->id]) }}" class="btn btn-sm btn-orange mb-2 w-100">Lihat Selengkapnya</a>
                        
                        {{-- INI TOMBOL BARU KITA --}}
                        <form action="{{ route('lowongan.toggleSimpan', $lowongan->id) }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                <i class="bi bi-bookmark-x-fill me-1"></i> Batal Simpan
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center empty-state">
                    <i class="bi bi-bookmark-x-fill empty-icon"></i>
                    <h5>Belum Ada Pekerjaan Disimpan</h5>
                    <p>Simpan lowongan yang Anda minati untuk melihatnya di sini.</p>
                </div>
            @endforelse
                
                @if ($pekerjaanDisimpan->hasPages())
                <div class="pagination-wrapper">
                    <div class="pagination-summary">
                        Menampilkan {{ $pekerjaanDisimpan->firstItem() }} - {{ $pekerjaanDisimpan->lastItem() }} dari {{ $pekerjaanDisimpan->total() }} hasil
                    </div>
                    {{ $pekerjaanDisimpan->links() }}
                </div>
                @endif
            </div>

            {{-- KONTEN TAB RIWAYAT LAMARAN --}}
            <div class="tab-pane fade" id="lamaran-tab-pane" role="tabpanel" aria-labelledby="lamaran-tab" tabindex="0">
                <div class="stats-card">
                    <div class="stat-item">
                        <div class="stat-value">{{ $totalLamaran }}</div>
                        <div class="stat-label">Total Lamaran</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $dilihatPerusahaan }}</div>
                        <div class="stat-label">Kali Dilihat Perusahaan</div>
                    </div>
                </div>

                @forelse($riwayatLamaran as $lamaran)
                    @php
                        // Logika untuk menentukan status timeline
                        $status = $lamaran->status; // 'pending', 'dilihat', 'diterima', 'ditolak'

                        $step1_class = '';
                        $step2_class = '';
                        $step3_class = '';
                        $step3_label = 'Hasil';
                        $step3_icon = '<i class="bi bi-patch-question-fill"></i>';

                        if ($status == 'pending') {
                            $step1_class = 'active'; // Step 1 adalah 'sekarang'
                            $step2_class = '';
                            $step3_class = '';
                        } elseif ($status == 'dilihat') {
                            $step1_class = 'complete';
                            $step2_class = 'active'; // Step 2 adalah 'sekarang'
                            $step3_class = '';
                        } elseif ($status == 'diterima') {
                            $step1_class = 'complete';
                            $step2_class = 'complete';
                            $step3_class = 'complete'; // Step 3 complete (oranye)
                            $step3_label = 'Diterima';
                            $step3_icon = '<i class="bi bi-check-lg"></i>';
                        } elseif ($status == 'ditolak') {
                            $step1_class = 'complete rejected';
                            $step2_class = 'complete rejected';
                            $step3_class = 'complete rejected'; // Step 3 complete (merah)
                            $step3_label = 'Ditolak';
                            $step3_icon = '<i class="bi bi-x-lg"></i>';
                        }
                    @endphp

                    <div class="job-card-aktivitas">
                        <div class="company-info">
                            <img src="{{ $lamaran->lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lamaran->lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lamaran->lowongan->perusahaan->nama_perusahaan, 0, 1) }}" alt="Logo" class="company-logo">
                            <div class="company-details">
                                <h5 class="job-title"><a href="{{ route('lowongan.index', ['view' => $lamaran->lowongan->id]) }}">{{ $lamaran->lowongan->judul_lowongan }}</a></h5>
                                <p class="company-name text-muted">{{ $lamaran->lowongan->perusahaan->nama_perusahaan }}</p>
                                <p class="location text-muted mb-0"><i class="bi bi-geo-alt-fill"></i>{{ $lamaran->lowongan->perusahaan->alamat_kota ?? 'Lokasi tidak tersedia' }}</p>
                            </div>
                            {{-- Kita pindahkan tanggal lamar ke pojok kanan atas --}}
                            <div class="job-actions" style="text-align: right; min-width: 150px;">
                                <small class="text-muted d-block">Dilamar</small>
                                <small class="text-muted d-block mb-2">{{ $lamaran->created_at->diffForHumans() }}</small>

                                {{-- TOMBOL BATAL MELAMAR BARU --}}
                                {{-- Kita hanya tampilkan jika statusnya 'pending' atau 'dilihat' --}}
                                @if(in_array($lamaran->status, ['pending', 'dilihat']))
                                    <form action="{{ route('pelamar.lamaran.destroy', $lamaran->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin membatalkan lamaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash3-fill me-1"></i> Batal Melamar
                                        </button>
                                    </form>
                                @endif
                                {{-- AKHIR TOMBOL BATAL --}}
                            </div>
                        </div>

                        {{-- TIMELINE VISUAL BARU --}}
                        <div class="timeline-wrapper">
                            {{-- Step 1: Dilamar --}}
                            <div class="timeline-step {{ $step1_class }}">
                                <div class="timeline-icon"><i class="bi bi-file-earmark-check-fill"></i></div>
                                <div class="timeline-label">Dilamar</div>
                            </div>
                            {{-- Step 2: Dilihat --}}
                            <div class="timeline-step {{ $step2_class }}">
                                <div class="timeline-icon"><i class="bi bi-eye-fill"></i></div>
                                <div class="timeline-label">Dilihat</div>
                            </div>
                            {{-- Step 3: Hasil --}}
                            <div class="timeline-step {{ $step3_class }}">
                                <div class="timeline-icon">{!! $step3_icon !!}</div>
                                <div class="timeline-label">{{ $step3_label }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center empty-state">
                        <i class="bi bi-file-earmark-excel-fill empty-icon"></i>
                        <h5>Belum Ada Riwayat Lamaran</h5>
                        <p>Setiap lowongan yang Anda lamar akan tercatat di sini.</p>
                    </div>
                @endforelse

                @if ($riwayatLamaran->hasPages())
                <div class="pagination-wrapper">
                    <div class="pagination-summary">
                        Menampilkan {{ $riwayatLamaran->firstItem() }} - {{ $riwayatLamaran->lastItem() }} dari {{ $riwayatLamaran->total() }} hasil
                    </div>
                    {{ $riwayatLamaran->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .main-content { background-color: #f8f9fa; }
    .page-header .page-title { font-weight: 700; }
    .page-header .page-subtitle { color: #6c757d; }

    /* --- [FIX] Ini style TAB yang tadi hilang --- */
    .nav-pills .nav-link {
        color: #6c757d;
        font-weight: 600;
        background-color: #fff;
        border: 1px solid #dee2e6;
        margin: 0 5px;
        border-radius: 0.5rem;
    }
    .nav-pills .nav-link.active {
        color: #fff;
        background-color: #F39C12;
        border-color: #F39C12;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    /* --- Batas Akhir Style TAB --- */


    .job-card-aktivitas {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border: 1px solid #e9ecef;
        border-radius: 0.75rem;
        margin-bottom: 1rem;
        transition: box-shadow 0.2s, transform 0.2s;
        background-color: #fff;
    }
    .job-card-aktivitas:hover { 
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.1); 
    }
    .company-info { display: flex; align-items: flex-start; flex-grow: 1; }
    .company-logo { width: 48px; height: 48px; object-fit: contain; border-radius: 0.5rem; margin-right: 1.5rem; }
    .company-details { flex-grow: 1; }
    .job-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem; }
    .job-title a { color: #212529; text-decoration: none; }
    .job-title a:hover { color: #F39C12; }
    .company-name, .location { color: #6c757d; font-size: 0.9rem; }
    .location i { color: #F39C12; }
    .job-description { font-size: 0.9rem; color: #6c757d; margin-bottom: 0; }
    .job-actions { text-align: right; min-width: 150px; }
    
    .stats-card {
        display: flex;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        justify-content: space-around;
        text-align: center;
        box-shadow: 0 0.25rem 1rem rgba(0,0,0,.05);
    }
    .stat-item { flex: 1; }
    .stat-value { font-size: 2rem; font-weight: 700; color: #F39C12; }
    .stat-label { font-size: 0.9rem; color: #6c757d; }
    .stat-divider { width: 1px; background-color: #dee2e6; }

    .empty-state {
        background-color: #fff;
        padding: 3rem;
        border-radius: 0.75rem;
        border: 1px dashed #dee2e6;
    }
    .empty-icon {
        font-size: 3rem;
        color: #ced4da;
        margin-bottom: 1rem;
    }
    
    /* --- [FIX] Ini style BADGE STATUS yang tadi hilang --- */
    .status-badge { font-size: 0.8rem; padding: 0.5em 0.75em; font-weight: 600; }
    .status-pending { background-color: #6c757d; color: white; }
    .status-dilihat { background-color: #0d6efd; color: white; }
    .status-diterima { background-color: #198754; color: white; }
    .status-ditolak { background-color: #dc3545; color: white; }
    /* --- Batas Akhir Style BADGE STATUS --- */

    /* --- Style PAGINASI (sudah ada) --- */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
    }
    .pagination-summary {
        color: #6c757d;
        font-size: 0.9rem;
    }
    .pagination { margin-bottom: 0; }
    .pagination .page-item .page-link {
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 4px;
        border: 1px solid #dee2e6;
        color: #6c757d;
        font-weight: 500;
    }
    .pagination .page-item.active .page-link {
        background-color: #F39C12;
        border-color: #F39C12;
        color: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .pagination .page-item:not(.active) .page-link:hover {
        background-color: #f8f9fa;
        border-color: #adb5bd;
    }
    .pagination .page-item.disabled .page-link {
        background-color: transparent;
        color: #ced4da;
    }
    .pagination .page-link .sr-only { display: none; }
    .btn-orange {
        background-color: #F39C12;
        border-color: #F39C12;
        color: #fff;
    }
    .btn-orange:hover {
        background-color: #d8890b;
        border-color: #d8890b;
    }
    /* --- Batas Akhir Style BUTTON --- */


    /* --- [FIX] GAYA BARU UNTUK TIMELINE LAMARAN (DIBUAT SPESIFIK) --- */
    #lamaran-tab-pane .timeline-wrapper {
        display: flex;
        align-items: center;
        width: 100%;
        margin-top: 1.5rem;
        padding: 0.5rem 0;
    }
    #lamaran-tab-pane .timeline-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex: 1;
        text-align: center;
    }
    #lamaran-tab-pane .timeline-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #adb5bd;
        border: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        z-index: 2;
        transition: all 0.3s ease;
    }
    #lamaran-tab-pane .timeline-label {
        font-size: 0.8rem;
        font-weight: 500;
        color: #adb5bd;
        margin-top: 0.5rem;
        transition: all 0.3s ease;
    }
    #lamaran-tab-pane .timeline-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 14px;
        left: 50%;
        width: 100%;
        height: 2px;
        background-color: #e9ecef;
        z-index: 1;
        transition: all 0.3s ease;
    }
    #lamaran-tab-pane .timeline-step.active .timeline-icon {
        background-color: #fff;
        border-color: #F39C12;
        color: #F39C12;
    }
    #lamaran-tab-pane .timeline-step.active .timeline-label {
        color: #212529;
    }
    #lamaran-tab-pane .timeline-step.active:not(:last-child)::after {
        background-color: #e9ecef;
    }
    #lamaran-tab-pane .timeline-step.complete .timeline-icon {
        background-color: #F39C12;
        border-color: #F39C12;
        color: #fff;
    }
    #lamaran-tab-pane .timeline-step.complete .timeline-label {
        color: #212529;
    }
    #lamaran-tab-pane .timeline-step.complete:not(:last-child)::after {
        background-color: #F39C12;
    }
    #lamaran-tab-pane .timeline-step.rejected.complete .timeline-icon {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }
    #lamaran-tab-pane .timeline-step.rejected.complete .timeline-label {
        color: #dc3545;
    }
    #lamaran-tab-pane .timeline-step.rejected.complete:not(:last-child)::after {
        background-color: #dc3545;
    }

    /* [FIX] Mengubah card HANYA di tab lamaran */
    #lamaran-tab-pane .job-card-aktivitas {
        flex-direction: column;
        align-items: flex-start;
    }
    #lamaran-tab-pane .company-info {
        width: 100%;
    }
    /* --- BATAS AKHIR STYLE TIMELINE --- */
</style>
@endpush
