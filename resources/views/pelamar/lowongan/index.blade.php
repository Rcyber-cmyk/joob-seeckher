{{-- /resources/views/pelamar/lowongan/index.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Cari Lowongan')

@section('content')
<div class="main-content">
    <div class="container py-5">
        <div class="row g-4">
            <!-- KOLOM KIRI (FILTER & DAFTAR LOWONGAN) -->
            <div class="col-lg-5">
                <div class="filter-card mb-4">
                    <form action="{{ route('lowongan.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Jabatan atau perusahaan..." value="{{ request('search') }}">
                        </div>
                        <div class="input-group">
                             <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <select name="lokasi" class="form-select">
                                <option value="">Semua Lokasi</option>
                                @foreach($lokasiOptions as $lokasi)
                                    <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>{{ $lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-orange">Cari Lowongan</button>
                        </div>
                    </form>
                </div>

                <div class="job-list-container">
                    @forelse($lowonganList as $lowongan)
                    <div class="job-list-card {{ ($detailLowongan && $detailLowongan->id == $lowongan->id) ? 'active' : '' }}" data-id="{{ $lowongan->id }}">
                        <div class="d-flex">
                            <img src="{{ $lowongan->perusahaan->logo ? asset('storage/' . $lowongan->perusahaan->logo) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" alt="Logo" class="company-logo-list">
                            <div class="ms-3">
                                <h6 class="job-title-list">{{ $lowongan->judul_lowongan }}</h6>
                                <p class="company-name-list text-muted mb-1">{{ $lowongan->perusahaan->nama_perusahaan }}</p>
                                <p class="location-list text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $lowongan->perusahaan->alamat_perusahaan }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center p-5">
                        <p>Tidak ada lowongan yang cocok dengan kriteria Anda.</p>
                    </div>
                    @endforelse
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $lowonganList->appends(request()->query())->links() }}
                </div>
            </div>

            <!-- KOLOM KANAN (DETAIL LOWONGAN) -->
            <div class="col-lg-7">
                <div id="job-detail-wrapper">
                    @include('pelamar.lowongan.partials._job-detail')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .main-content { background-color: #f8f9fa; }
    .filter-card {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
    }
    .job-list-container {
        background-color: #fff;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        max-height: 70vh;
        overflow-y: auto;
    }
    .job-list-card {
        padding: 1.25rem;
        border-bottom: 1px solid #e9ecef;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .job-list-card:last-child { border-bottom: none; }
    .job-list-card:hover { background-color: #f8f9fa; }
    .job-list-card.active { background-color: #e7f1ff; }
    .company-logo-list { width: 48px; height: 48px; object-fit: contain; border-radius: 0.5rem; }
    .job-title-list { font-weight: 600; font-size: 1rem; margin-bottom: 0.25rem; }
    .company-name-list, .location-list { font-size: 0.9rem; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jobListContainer = document.querySelector('.job-list-container');
    const jobDetailWrapper = document.getElementById('job-detail-wrapper');

    // Fungsi async/await modern untuk mengambil data
    async function updateDetails(lowonganId) {
        if (!jobDetailWrapper) return;
        
        // Tampilkan loading skeleton
        jobDetailWrapper.innerHTML = `<div class="job-detail-container"><div class="text-center p-5"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div></div>`;

        try {
            // Fetch HTML yang sudah dirender dari controller
            const response = await fetch(`/lowongan/detail/${lowonganId}`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const html = await response.text();
            // Langsung ganti konten dengan HTML yang diterima
            jobDetailWrapper.innerHTML = html;
        } catch (error) {
            console.error('Error fetching details:', error);
            if (jobDetailWrapper) {
                jobDetailWrapper.innerHTML = `<div class="job-detail-container"><div class="text-center empty-state p-5"><p>Gagal memuat detail lowongan. Silakan coba lagi.</p></div></div>`;
            }
        }
    }

    // Gunakan event delegation agar listener tetap berfungsi setelah paginasi
    if (jobListContainer) {
        jobListContainer.addEventListener('click', function(event) {
            const card = event.target.closest('.job-list-card');
            if (card) {
                // Hapus kelas aktif dari semua kartu
                jobListContainer.querySelectorAll('.job-list-card').forEach(c => c.classList.remove('active'));
                // Tambahkan kelas aktif ke kartu yang diklik
                card.classList.add('active');
                
                const lowonganId = card.dataset.id;
                updateDetails(lowonganId);
            }
        });
    }
});
</script>
@endpush
