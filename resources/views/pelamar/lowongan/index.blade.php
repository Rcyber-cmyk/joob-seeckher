@extends('pelamar.layouts.app')

@section('title', 'Cari Lowongan')

@section('content')
{{-- HAPUS FOOTER AGAR TAMPILAN FULL HEIGHT --}}
<style>footer.footer { display: none !important; }</style>

<div class="search-page-wrapper">
    <div class="container-fluid h-100">
        <div class="row h-100">
            
            {{-- SIDEBAR: DAFTAR LOWONGAN --}}
            <div class="col-lg-4 col-xl-3 p-0 d-flex flex-column border-end job-sidebar" id="jobSidebar">
                
                {{-- Filter Section (Fixed at Top) --}}
                <div class="filter-section p-3 border-bottom bg-white shadow-sm" style="z-index: 10;">
                    <form action="{{ route('lowongan.index') }}" method="GET">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control bg-light border-start-0 ps-0" placeholder="Posisi / Perusahaan..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <select name="lokasi" class="form-select form-select-sm bg-light">
                                <option value="">Semua Lokasi</option>
                                @foreach($lokasiOptions as $lokasi)
                                    <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>{{ $lokasi }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-orange btn-sm px-3"><i class="bi bi-filter"></i></button>
                        </div>
                    </form>
                </div>

                {{-- Job List (Scrollable Area) --}}
                <div class="job-list-scroll flex-grow-1 bg-light custom-scrollbar">
                    @forelse($lowonganList as $lowongan)
                        @php
                            $isPremium = $lowongan->paket_iklan == 'premium';
                            $isActive = ($detailLowongan && $detailLowongan->id == $lowongan->id);
                            $cardClasses = $isActive ? 'active' : '';
                            $cardClasses .= $isPremium ? ' premium-card' : '';
                        @endphp

                        <div class="job-list-card p-3 border-bottom {{ $cardClasses }}" data-id="{{ $lowongan->id }}">
                            @if($isPremium)
                                <div class="list-premium-badge"><i class="bi bi-star-fill"></i> Premium</div>
                            @endif

                            <div class="d-flex align-items-start">
                                <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" 
                                     alt="Logo" class="company-logo-list rounded-3 border bg-white shadow-sm">
                                
                                <div class="ms-3 flex-grow-1 position-relative" style="z-index: 2;">
                                    <h6 class="job-title-list mb-1 {{ $isPremium ? 'text-orange' : 'text-dark' }}">
                                        {{ $lowongan->judul_lowongan }}
                                    </h6>
                                    <p class="company-name-list text-muted small mb-1">{{ $lowongan->perusahaan->nama_perusahaan }}</p>
                                    <div class="d-flex align-items-center text-muted small" style="font-size: 0.8rem;">
                                        <span class="badge bg-white border text-secondary me-2 fw-normal">
                                            <i class="bi bi-geo-alt text-orange me-1"></i> {{ Str::limit($lowongan->domisili, 15) }}
                                        </span>
                                        <span>{{ $lowongan->created_at->diffForHumans(null, true) }}</span>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted ms-2 align-self-center d-lg-none"></i> 
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-5 text-muted">
                            <img src="{{ asset('images/empty-state.svg') }}" alt="No Data" style="width: 100px; opacity: 0.5;" class="mb-3">
                            <p>Lowongan tidak ditemukan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- DETAIL PANEL (KANAN) --}}
            <div class="col-lg-8 col-xl-9 p-0 bg-white h-100 job-detail-panel" id="jobDetailPanel">
                <div class="d-lg-none p-3 border-bottom bg-white sticky-top d-flex align-items-center shadow-sm">
                    <button class="btn btn-link text-dark text-decoration-none p-0 me-3" id="btnBackToList">
                        <i class="bi bi-arrow-left fs-4"></i>
                    </button>
                    <span class="fw-bold">Detail Lowongan</span>
                </div>
                <div id="job-detail-wrapper" class="h-100 overflow-auto custom-scrollbar pb-5 pb-lg-0">
                    @include('pelamar.lowongan.partials._job-detail')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* === STRUCTURE FIX === */
    /* Pastikan Container tidak lebih tinggi dari layar */
    .search-page-wrapper {
        height: calc(100vh - 76px); /* Tinggi Viewport dikurangi Navbar */
        overflow: hidden; /* KUNCI: Mencegah halaman utama scroll */
        background-color: #fff;
    }

    /* Sidebar harus patuh pada tinggi parent */
    .job-sidebar {
        height: 100% !important; /* Paksa agar tidak melebihi wrapper */
        overflow: hidden; /* Sembunyikan jika ada elemen bandel yang keluar */
        display: flex;
        flex-direction: column;
    }

    /* Area List Lowongan */
    .job-list-scroll {
        flex: 1; /* Gunakan Flex Grow agar mengisi sisa ruang */
        overflow-y: auto; /* Scroll HANYA di dalam area ini */
        min-height: 0; /* Fix penting agar scrollbar muncul */
        /* height: 100%; <- INI SAYA HAPUS KARENA MENYEBABKAN MASALAH */
    }

    /* === DESIGN ELEMENTS === */
    .job-list-card { 
        cursor: pointer; transition: all 0.2s; background-color: #fff; 
        position: relative; border-left: 4px solid transparent; 
    }
    .job-list-card:hover { background-color: #f8f9fa; }
    .job-list-card.active { background-color: #f0f7ff; border-left: 4px solid #22374e; }

    /* Premium Styles */
    .job-list-card.premium-card { background-color: #fffbf2 !important; border-left: 4px solid #F39C12 !important; }
    .job-list-card.premium-card.active { background-color: #fff3cd !important; border-left: 4px solid #d8890b !important; }
    .list-premium-badge {
        position: absolute; top: 0; right: 0; background-color: #F39C12; color: white;
        font-size: 0.65rem; font-weight: bold; padding: 2px 8px;
        border-bottom-left-radius: 8px; text-transform: uppercase; z-index: 5;
    }
    .list-premium-badge i { font-size: 0.6rem; margin-right: 2px; }

    .company-logo-list { width: 50px; height: 50px; object-fit: contain; flex-shrink: 0; }
    .job-title-list { font-weight: 700; font-size: 0.95rem; line-height: 1.3; }
    .text-orange { color: #F39C12 !important; }
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: white; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; color: white; }

    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ddd; border-radius: 10px; }

    /* Mobile */
    @media (max-width: 991.98px) {
        .job-detail-panel {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            z-index: 2000; background-color: white;
            transform: translateX(100%); transition: transform 0.3s ease-in-out;
            padding-bottom: 0 !important;
        }
        .job-detail-panel.show { transform: translateX(0); }
        #job-detail-wrapper { height: calc(100% - 60px) !important; }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jobListContainer = document.querySelector('.job-list-scroll');
    const jobDetailPanel = document.getElementById('jobDetailPanel');
    const jobDetailWrapper = document.getElementById('job-detail-wrapper');
    const btnBack = document.getElementById('btnBackToList');

    async function updateDetails(lowonganId) {
        if (!jobDetailWrapper) return;
        jobDetailWrapper.innerHTML = `<div class="d-flex justify-content-center align-items-center h-100"><div class="spinner-border text-orange" role="status"></div></div>`;
        try {
            const response = await fetch(`/lowongan/detail/${lowonganId}`);
            if (!response.ok) throw new Error('Error');
            jobDetailWrapper.innerHTML = await response.text();
            jobDetailWrapper.scrollTop = 0; 
        } catch (error) {
            jobDetailWrapper.innerHTML = `<div class="p-5 text-center text-muted">Gagal memuat detail.</div>`;
        }
    }

    if (jobListContainer) {
        jobListContainer.addEventListener('click', function(event) {
            const card = event.target.closest('.job-list-card');
            if (card) {
                jobListContainer.querySelectorAll('.job-list-card').forEach(c => c.classList.remove('active'));
                card.classList.add('active');
                updateDetails(card.dataset.id);
                if (window.innerWidth < 992) jobDetailPanel.classList.add('show');
            }
        });
    }

    if (btnBack) btnBack.addEventListener('click', () => jobDetailPanel.classList.remove('show'));
});
</script>
@endpush