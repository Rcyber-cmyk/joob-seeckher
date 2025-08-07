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
                {{-- PERBAIKAN: Tambahkan pengecekan kondisional --}}
                @if ($lowongan->pivot && $lowongan->pivot->created_at)
                    <small class="text-muted d-block mb-2">Disimpan {{ $lowongan->pivot->created_at->diffForHumans() }}</small>
                @endif
                <a href="{{ route('lowongan.index', ['view' => $lowongan->id]) }}" class="btn btn-sm btn-orange">Lihat Selengkapnya</a>
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
                    <div class="job-card-aktivitas">
                        <div class="company-info">
                            {{-- Perbaikan: Menggunakan relasi 'lowongan' dan kolom 'logo_perusahaan' --}}
                            <img src="{{ $lamaran->lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lamaran->lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lamaran->lowongan->perusahaan->nama_perusahaan, 0, 1) }}" alt="Logo" class="company-logo">
                            <div class="company-details">
                                <h5 class="job-title"><a href="{{ route('lowongan.index', ['view' => $lamaran->lowongan->id]) }}">{{ $lamaran->lowongan->judul_lowongan }}</a></h5>
                                <p class="company-name text-muted">{{ $lamaran->lowongan->perusahaan->nama_perusahaan }}</p>
                                {{-- Perbaikan: Menggunakan kolom 'alamat_kota' --}}
                                <p class="location text-muted mb-2"><i class="bi bi-geo-alt-fill"></i>{{ $lamaran->lowongan->perusahaan->alamat_kota ?? 'Lokasi tidak tersedia' }}</p>
                                <p class="job-description">{{ Str::limit($lamaran->lowongan->deskripsi_pekerjaan, 120) }}</p>
                            </div>
                        </div>
                        <div class="job-actions">
                            <small class="text-muted d-block mb-2">Dilamar {{ $lamaran->created_at->diffForHumans() }}</small>
                            <span class="badge status-badge status-{{ strtolower($lamaran->status) }}">{{ ucfirst($lamaran->status) }}</span>
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
    .status-badge { font-size: 0.8rem; padding: 0.5em 0.75em; font-weight: 600; }
    .status-pending { background-color: #6c757d; color: white; }
    .status-dilihat { background-color: #0d6efd; color: white; }
    .status-diterima { background-color: #198754; color: white; }
    .status-ditolak { background-color: #dc3545; color: white; }

    /* --- STYLE BARU UNTUK PAGINASI --- */
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
    .pagination {
        margin-bottom: 0;
    }
    .pagination .page-item .page-link {
        border-radius: 50%; /* Membuat tombol bulat */
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
    .pagination .page-link .sr-only {
        display: none;
    }
</style>
@endpush
