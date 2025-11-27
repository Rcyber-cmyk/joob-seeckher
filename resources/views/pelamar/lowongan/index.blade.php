@extends('pelamar.layouts.app')

@section('title', 'Cari Lowongan')

@section('content')
{{-- HAPUS FOOTER AGAR TAMPILAN FULL HEIGHT --}}
<style>footer.footer { display: none !important; }</style>

{{-- WRAPPER UTAMA --}}
<div class="job-dashboard-wrapper">
    <div class="container-fluid h-100 p-0">
        <div class="row h-100 g-0">
            
            {{-- SIDEBAR KIRI: LIST LOWONGAN --}}
            <div class="col-lg-4 col-xl-3 border-end bg-white d-flex flex-column h-100 position-relative z-2 shadow-sm" id="jobSidebar">
                
                {{-- 1. Header Filter --}}
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

                {{-- 2. List Lowongan (Scrollable) --}}
                <div class="sidebar-list flex-grow-1 overflow-auto custom-scrollbar">
                    @forelse($lowonganList as $lowongan)
                        @php
                            $isPremium = $lowongan->paket_iklan == 'premium';
                            $isActive = ($detailLowongan && $detailLowongan->id == $lowongan->id);
                        @endphp

                        {{-- Perhatikan class 'job-card' ini dipakai di JS --}}
                        <div class="job-card p-3 border-bottom cursor-pointer position-relative {{ $isActive ? 'active-job' : '' }}" 
                             data-id="{{ $lowongan->id }}">
                            
                            @if($isPremium)
                                <div class="premium-corner"></div>
                            @endif

                            <div class="d-flex gap-3">
                                <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/f8f9fa/22374e?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" 
                                     class="rounded-3 object-fit-contain border bg-white" style="width: 48px; height: 48px;">
                                
                                <div class="overflow-hidden">
                                    <h6 class="mb-1 fw-bold text-dark-blue text-truncate">{{ $lowongan->judul_lowongan }}</h6>
                                    <p class="mb-1 text-muted small text-truncate">{{ $lowongan->perusahaan->nama_perusahaan }}</p>
                                    
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <span class="badge bg-light text-secondary border fw-normal px-2 py-1" style="font-size: 0.7rem;">
                                            {{ Str::limit($lowongan->domisili, 12) }}
                                        </span>
                                        <small class="text-muted ms-auto" style="font-size: 0.7rem;">{{ $lowongan->created_at->diffForHumans(null, true) }}</small>
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

            {{-- PANEL KANAN: DETAIL CONTENT --}}
            <div class="col-lg-8 col-xl-9 h-100 bg-light position-relative job-detail-panel" id="jobDetailPanel">
                
                {{-- Tombol Back Mobile --}}
                <div class="d-lg-none p-3 bg-white border-bottom shadow-sm d-flex align-items-center sticky-top z-3">
                    <button class="btn btn-sm btn-light border me-3" id="btnBackToList"><i class="bi bi-arrow-left"></i></button>
                    <span class="fw-bold">Detail Lowongan</span>
                </div>

                {{-- Wrapper Konten (Ini yang di-update via AJAX) --}}
                <div id="job-detail-wrapper" class="h-100 overflow-auto custom-scrollbar">
                    @include('pelamar.lowongan.partials._job-detail')
                </div>

                {{-- Loading Spinner --}}
                <div id="loading-spinner" class="position-absolute top-50 start-50 translate-middle d-none">
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
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #ced4da; border-radius: 10px; }
    @media (max-width: 991.98px) {
        .job-detail-panel { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1050; transform: translateX(100%); transition: transform 0.3s ease; background: white; }
        .job-detail-panel.show { transform: translateX(0); }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selector
    const listContainer = document.querySelector('.sidebar-list'); 
    const detailPanel = document.getElementById('jobDetailPanel');
    const detailWrapper = document.getElementById('job-detail-wrapper');
    const loadingSpinner = document.getElementById('loading-spinner');
    const btnBack = document.getElementById('btnBackToList');

    // --- FUNGSI LOAD DETAIL (AJAX) ---
    async function loadJobDetail(id) {
        // UI Loading State
        detailWrapper.style.opacity = '0.3';
        detailWrapper.style.pointerEvents = 'none';
        if(loadingSpinner) loadingSpinner.classList.remove('d-none');

        try {
            // Fetch Data
            const res = await fetch(`/lowongan/detail/${id}`);
            if(!res.ok) throw new Error("Gagal load data");
            const html = await res.text();
            
            // Masukkan HTML ke Wrapper
            detailWrapper.innerHTML = html;
            detailWrapper.scrollTop = 0; // Reset scroll ke atas

            // === FIX MODAL HILANG ===
            // Kita pindahkan Modal dari dalam wrapper (yg ada scrollnya) ke Body
            // Supaya tidak kepotong/hidden
            const modalEl = detailWrapper.querySelector('.modal');
            if(modalEl) {
                document.body.appendChild(modalEl);
            }

        } catch (err) {
            console.error(err);
            detailWrapper.innerHTML = `<div class="h-100 d-flex flex-column justify-content-center align-items-center text-muted">
                <i class="bi bi-wifi-off display-4 mb-3"></i>
                <p>Gagal memuat lowongan. Periksa koneksi Anda.</p>
            </div>`;
        } finally {
            // Reset UI State
            detailWrapper.style.opacity = '1';
            detailWrapper.style.pointerEvents = 'auto';
            if(loadingSpinner) loadingSpinner.classList.add('d-none');
        }
    }

    // --- EVENT LISTENER KLIK LOWONGAN ---
    if(listContainer) {
        listContainer.addEventListener('click', e => {
            // Cari elemen kartu terdekat yang diklik
            const card = e.target.closest('.job-card'); 
            
            if(card) {
                // 1. Hapus 'active' dari semua kartu
                document.querySelectorAll('.job-card').forEach(c => c.classList.remove('active-job'));
                
                // 2. Tambah 'active' ke kartu yang diklik
                card.classList.add('active-job');

                // 3. Panggil fungsi Load AJAX
                // Pastikan attribute data-id ada di HTML
                const jobId = card.getAttribute('data-id');
                if(jobId) loadJobDetail(jobId);

                // 4. (Mobile Only) Buka Panel Kanan
                if(window.innerWidth < 992 && detailPanel) {
                    detailPanel.classList.add('show');
                }
            }
        });
    }

    // Tombol Back (Mobile)
    if(btnBack) {
        btnBack.addEventListener('click', () => {
            if(detailPanel) detailPanel.classList.remove('show');
        });
    }
});

// --- FUNGSI BOOKMARK (SIMPAN) ---
// Taruh di global scope agar bisa dipanggil onclick=""
async function toggleBookmark(id) {
    const buttons = document.querySelectorAll(`.btn-bookmark-${id}`);
    const icons = document.querySelectorAll(`.icon-bookmark-${id}`);

    // UI Optimistic Update (Ubah dulu sebelum request selesai)
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
        const response = await fetch(`/lowongan/${id}/simpan`, { 
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        });
        if (!response.ok) throw new Error('Gagal');
    } catch (error) {
        alert('Gagal menyimpan status.');
        // Revert UI jika gagal
        icons.forEach(icon => {
            // Logika balikkan icon...
        });
    }
}
</script>
@endpush
