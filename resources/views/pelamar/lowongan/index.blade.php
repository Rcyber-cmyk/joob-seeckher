@extends('pelamar.layouts.app')

@section('title', 'Cari Lowongan')

@section('content')
<style>footer.footer { display: none !important; }</style>

{{-- WRAPPER UTAMA --}}
<div class="job-dashboard-wrapper">
    <div class="container-fluid h-100 p-0">
        <div class="row h-100 g-0">
            
            {{-- ===================================
                 SIDEBAR KIRI (LIST LOWONGAN)
                 =================================== --}}
            <div class="col-lg-4 col-xl-3 border-end bg-white d-flex flex-column h-100 position-relative z-2 shadow-sm" id="jobSidebar">
                
                {{-- Header Filter --}}
                <div class="sidebar-header p-3 border-bottom bg-white">
                    <h5 class="fw-bold text-dark-blue mb-3">Lowongan Kerja</h5>
                    <form action="{{ route('lowongan.index') }}" method="GET">
                        <div class="mb-2">
                            <div class="input-group input-group-solid">
                                <span class="input-group-text border-0 bg-light pe-2"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-0 bg-light ps-1" placeholder="Posisi / Perusahaan..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <select name="lokasi" class="form-select form-select-sm bg-light border-0 fw-bold text-secondary">
                                <option value="">Semua Lokasi</option>
                                @foreach($lokasiOptions as $lokasi)
                                    <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>{{ $lokasi }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-orange btn-sm px-3 rounded-3"><i class="bi bi-funnel-fill"></i></button>
                        </div>
                    </form>
                </div>

                {{-- List Scrollable --}}
                <div class="sidebar-list flex-grow-1 overflow-auto custom-scrollbar">
                    @forelse($lowonganList as $lowongan)
                        @php
                            $isPremium = $lowongan->paket_iklan == 'premium';
                            $isActive = ($detailLowongan && $detailLowongan->id == $lowongan->id);
                        @endphp

                        <div class="job-card p-3 border-bottom cursor-pointer position-relative {{ $isActive ? 'active-job' : '' }}" 
                             data-id="{{ $lowongan->id }}">
                            
                            @if($isPremium)
                                <div class="premium-corner"></div>
                            @endif

                            <div class="d-flex gap-3">
                                <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/f8f9fa/22374e?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" 
                                     class="rounded-3 object-fit-contain border bg-white" style="width: 48px; height: 48px;">
                                
                                <div class="overflow-hidden w-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h6 class="mb-1 fw-bold text-dark-blue text-truncate">{{ $lowongan->judul_lowongan }}</h6>
                                        @if($isPremium)
                                            <i class="bi bi-patch-check-fill text-warning ms-1" style="font-size: 0.8rem;"></i>
                                        @endif
                                    </div>
                                    <p class="mb-1 text-muted small text-truncate">{{ $lowongan->perusahaan->nama_perusahaan }}</p>
                                    
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <span class="badge bg-light text-secondary border fw-normal px-2 py-1" style="font-size: 0.65rem;">
                                            <i class="bi bi-geo-alt me-1"></i> {{ Str::limit($lowongan->domisili, 12) }}
                                        </span>
                                        <small class="text-muted ms-auto" style="font-size: 0.65rem;">{{ $lowongan->created_at->diffForHumans(null, true) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-5 mt-5">
                            <p class="text-muted small">Tidak ada lowongan ditemukan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- ===================================
                 PANEL KANAN (DESKTOP ONLY)
                 =================================== --}}
            <div class="col-lg-8 col-xl-9 h-100 bg-light d-none d-lg-block position-relative" id="jobDetailPanelDesktop">
                <div id="job-detail-wrapper-desktop" class="h-100 overflow-auto custom-scrollbar">
                    @include('pelamar.lowongan.partials._job-detail')
                </div>
                {{-- Spinner Desktop --}}
                <div id="loading-spinner-desktop" class="position-absolute top-50 start-50 translate-middle d-none">
                    <div class="spinner-border text-orange" role="status"></div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ===================================
     MODAL DETAIL FULLSCREEN (MOBILE ONLY)
     =================================== --}}
<div class="modal fade" id="mobileJobDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-light">
            {{-- Tombol Close Floating (Akan menimpa banner) --}}
            <button type="button" class="btn btn-light rounded-circle shadow position-fixed top-0 start-0 m-3 z-3 border" 
                    data-bs-dismiss="modal" style="width: 40px; height: 40px;">
                <i class="bi bi-arrow-left fs-5"></i>
            </button>

            <div class="modal-body p-0 position-relative" id="job-detail-wrapper-mobile">
                {{-- Konten Detail akan di-load di sini via AJAX --}}
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="spinner-border text-orange" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    :root { --c-dark-blue: #22374e; --c-orange: #F39C12; }
    body { overflow: hidden; }
    .job-dashboard-wrapper { height: calc(100vh - 76px); background-color: #f4f6f9; }
    .input-group-solid .input-group-text, .input-group-solid .form-control { background-color: #f8f9fa; }
    
    .job-card { transition: all 0.2s; border-left: 4px solid transparent; }
    .job-card:hover { background-color: #f8f9fa; }
    .active-job { background-color: #f0f7ff !important; border-left-color: var(--c-dark-blue); }
    .premium-corner { position: absolute; top: 0; right: 0; width: 0; height: 0; border-top: 12px solid var(--c-orange); border-left: 12px solid transparent; }
    
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #ced4da; border-radius: 10px; }

    /* Modal Fullscreen Fix */
    .modal-fullscreen .modal-body { overflow-y: auto; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const listContainer = document.querySelector('.sidebar-list');
    
    // Desktop Elements
    const detailWrapperDesktop = document.getElementById('job-detail-wrapper-desktop');
    const loadingSpinnerDesktop = document.getElementById('loading-spinner-desktop');
    
    // Mobile Elements
    const mobileModalElement = document.getElementById('mobileJobDetailModal');
    const mobileModal = new bootstrap.Modal(mobileModalElement);
    const detailWrapperMobile = document.getElementById('job-detail-wrapper-mobile');

    // --- FUNGSI LOAD DATA AJAX ---
    async function loadJobDetail(id, isMobile) {
        const wrapper = isMobile ? detailWrapperMobile : detailWrapperDesktop;
        const spinner = isMobile ? null : loadingSpinnerDesktop; // Mobile spinner built-in di HTML awal

        // UI State
        wrapper.style.opacity = isMobile ? '1' : '0.5'; // Mobile jgn transparan krn modal baru buka
        if(!isMobile && spinner) spinner.classList.remove('d-none');

        try {
            const res = await fetch(`/lowongan/detail/${id}`);
            if(!res.ok) throw new Error("Gagal");
            const html = await res.text();
            
            wrapper.innerHTML = html;
            
            // PENTING: Scroll ke atas setelah load
            if(isMobile) {
                // Cari modal-body untuk di-scroll
                const modalBody = mobileModalElement.querySelector('.modal-body');
                if(modalBody) modalBody.scrollTop = 0;
            } else {
                wrapper.scrollTop = 0;
            }

            // --- RE-INITIALIZE MODAL COMPANY ---
            // Karena konten baru dimasukkan via AJAX, modal profil perusahaan yang ada di dalam detail
            // harus dipindahkan ke document.body agar tidak tertutup container scroll.
            const companyModals = wrapper.querySelectorAll('.modal');
            companyModals.forEach(m => document.body.appendChild(m));

        } catch (err) {
            console.error(err);
            wrapper.innerHTML = '<div class="p-5 text-center text-muted">Gagal memuat data.</div>';
        } finally {
            wrapper.style.opacity = '1';
            if(!isMobile && spinner) spinner.classList.add('d-none');
        }
    }

    // --- EVENT LISTENER KLIK LIST ---
    if(listContainer) {
        listContainer.addEventListener('click', e => {
            const card = e.target.closest('.job-card'); 
            if(card) {
                const id = card.getAttribute('data-id');
                const isMobile = window.innerWidth < 992;

                // Update Active State (Visual)
                document.querySelectorAll('.job-card').forEach(c => c.classList.remove('active-job'));
                card.classList.add('active-job');

                if (isMobile) {
                    // Mobile: Buka Modal Dulu, baru Load konten
                    detailWrapperMobile.innerHTML = '<div class="d-flex h-100 justify-content-center align-items-center"><div class="spinner-border text-orange"></div></div>';
                    mobileModal.show();
                    loadJobDetail(id, true);
                } else {
                    // Desktop: Load ke panel kanan
                    loadJobDetail(id, false);
                }
            }
        });
    }
});

// --- FUNGSI BOOKMARK (GLOBAL) ---
async function toggleBookmark(id) {
    const icons = document.querySelectorAll(`.icon-bookmark-${id}`);
    
    // Optimistic UI Update
    let isSaved = false;
    if(icons.length > 0) isSaved = icons[0].classList.contains('bi-bookmark-fill');

    icons.forEach(icon => {
        if(isSaved) {
            icon.classList.remove('bi-bookmark-fill', 'text-warning', 'text-orange');
            icon.classList.add('bi-bookmark');
        } else {
            icon.classList.remove('bi-bookmark');
            icon.classList.add('bi-bookmark-fill', 'text-orange');
        }
    });

    try {
        await fetch(`/lowongan/${id}/simpan`, { 
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        });
    } catch (error) {
        alert('Gagal menyimpan status.');
    }
}
</script>
@endpush