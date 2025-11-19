@extends('pelamar.layouts.app')

@section('title', 'Cari Lowongan')

@section('content')
{{-- HAPUS FOOTER AGAR TAMPILAN FULL HEIGHT --}}
<style>footer.footer { display: none !important; }</style>

<div class="search-page-wrapper">
    <div class="container-fluid h-100">
        <div class="row h-100">
            
            <div class="col-lg-4 col-xl-3 p-0 d-flex flex-column border-end job-sidebar" id="jobSidebar">
                
                {{-- Filter Section --}}
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

                {{-- Job List (Scrollable) --}}
                <div class="job-list-scroll flex-grow-1 bg-light custom-scrollbar">
                    @forelse($lowonganList as $lowongan)
                        @php
                            // Cek apakah lowongan ini premium
                            $isPremium = $lowongan->paket_iklan == 'premium';
                            
                            // Cek apakah lowongan ini sedang dibuka detailnya
                            $isActive = ($detailLowongan && $detailLowongan->id == $lowongan->id);
                            
                            // Tentukan kelas CSS tambahan
                            $cardClasses = $isActive ? 'active' : '';
                            $cardClasses .= $isPremium ? ' premium-card' : '';
                        @endphp

                        <div class="job-list-card p-3 border-bottom {{ $cardClasses }}" data-id="{{ $lowongan->id }}">
                            
                            {{-- BADGE PREMIUM (Hanya muncul jika premium) --}}
                            @if($isPremium)
                                <div class="list-premium-badge">
                                    <i class="bi bi-star-fill"></i> Premium
                                </div>
                            @endif

                            <div class="d-flex align-items-start">
                                {{-- Logo Perusahaan --}}
                                <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" 
                                     alt="Logo" class="company-logo-list rounded-3 border bg-white shadow-sm">
                                
                                <div class="ms-3 flex-grow-1 position-relative" style="z-index: 2;">
                                    {{-- Judul Lowongan (Oranye jika premium) --}}
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
                                
                                {{-- Panah (Hanya di Mobile) --}}
                                <i class="bi bi-chevron-right text-muted ms-2 align-self-center d-lg-none"></i> 
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-5 text-muted">
                            <img src="{{ asset('images/empty-state.svg') }}" alt="No Data" style="width: 100px; opacity: 0.5;" class="mb-3">
                            <p>Lowongan tidak ditemukan.</p>
                        </div>
                    @endforelse
                    
                    {{-- Pagination --}}
                    @if($lowonganList->hasPages())
                        <div class="p-3 text-center border-top bg-white">
                            {{ $lowonganList->appends(request()->query())->links() }} 
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-8 col-xl-9 p-0 bg-white h-100 job-detail-panel" id="jobDetailPanel">
                
                {{-- Tombol Kembali (HANYA MOBILE) --}}
                <div class="d-lg-none p-3 border-bottom bg-white sticky-top d-flex align-items-center shadow-sm">
                    <button class="btn btn-link text-dark text-decoration-none p-0 me-3" id="btnBackToList">
                        <i class="bi bi-arrow-left fs-4"></i>
                    </button>
                    <span class="fw-bold">Detail Lowongan</span>
                </div>

                <div id="job-detail-wrapper" class="h-100 overflow-auto custom-scrollbar pb-5 pb-lg-0">
                    {{-- Konten akan di-load di sini via AJAX --}}
                    @include('pelamar.lowongan.partials._job-detail')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* === DESKTOP LAYOUT === */
    .search-page-wrapper {
        height: calc(100vh - 76px); /* Sesuaikan dengan tinggi navbar kamu */
        overflow: hidden;
        background-color: #fff;
    }

    /* --- Style Dasar Kartu --- */
    .job-list-card { 
        cursor: pointer; 
        transition: all 0.2s; 
        background-color: #fff; 
        position: relative; /* Penting untuk posisi badge */
        border-left: 4px solid transparent; /* Border kiri default transparan */
    }
    .job-list-card:hover { background-color: #f8f9fa; }
    
    /* --- Style Active State (Sedang Diklik) --- */
    .job-list-card.active { 
        background-color: #f0f7ff; 
        border-left: 4px solid #22374e; /* Biru Navy saat aktif */
    }

    /* --- STYLE PREMIUM (YANG KAMU MINTA) --- */
    .job-list-card.premium-card {
        background-color: #fffbf2 !important; /* Background kekuningan halus */
        border-left: 4px solid #F39C12 !important; /* Border kiri Oranye */
    }
    /* Jika premium sedang aktif/diklik */
    .job-list-card.premium-card.active {
        background-color: #fff3cd !important; /* Lebih gelap saat aktif */
        border-left: 4px solid #d8890b !important;
    }

    /* --- BADGE PREMIUM (Pojok Kanan Atas) --- */
    .list-premium-badge {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #F39C12;
        color: white;
        font-size: 0.65rem;
        font-weight: bold;
        padding: 2px 8px;
        border-bottom-left-radius: 8px;
        text-transform: uppercase;
        z-index: 5;
        box-shadow: -1px 1px 3px rgba(0,0,0,0.1);
    }
    .list-premium-badge i { font-size: 0.6rem; margin-right: 2px; }

    /* Elemen Lain */
    .company-logo-list { width: 50px; height: 50px; object-fit: contain; flex-shrink: 0; }
    .job-title-list { font-weight: 700; font-size: 0.95rem; line-height: 1.3; }
    .text-orange { color: #F39C12 !important; }
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: white; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; color: white; }

    /* Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ddd; border-radius: 10px; }

    /* === MOBILE LAYOUT === */
    @media (max-width: 991.98px) {
        .job-sidebar { width: 100%; height: 100%; }
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
        // Tampilkan Loading
        jobDetailWrapper.innerHTML = `
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="spinner-border text-orange" role="status"><span class="visually-hidden">Loading...</span></div>
            </div>`;
        try {
            // Fetch Data Partial
            const response = await fetch(`/lowongan/detail/${lowonganId}`);
            if (!response.ok) throw new Error('Error');
            const html = await response.text();
            jobDetailWrapper.innerHTML = html;
            jobDetailWrapper.scrollTop = 0; 
        } catch (error) {
            jobDetailWrapper.innerHTML = `<div class="p-5 text-center text-muted">Gagal memuat detail.</div>`;
        }
    }

    if (jobListContainer) {
        jobListContainer.addEventListener('click', function(event) {
            const card = event.target.closest('.job-list-card');
            if (card) {
                // Handle Active Class
                jobListContainer.querySelectorAll('.job-list-card').forEach(c => c.classList.remove('active'));
                card.classList.add('active');
                
                // Fetch Detail
                const lowonganId = card.dataset.id;
                updateDetails(lowonganId);

                // Mobile Logic
                if (window.innerWidth < 992) {
                    jobDetailPanel.classList.add('show');
                }
            }
        });
    }

    if (btnBack) {
        btnBack.addEventListener('click', function() {
            jobDetailPanel.classList.remove('show');
        });
    }
});
</script>
@endpush