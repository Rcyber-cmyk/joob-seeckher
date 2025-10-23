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
                            <img src="{{ $lowongan->perusahaan->logo_perusahaan ? asset('storage/' . $lowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" alt="Logo" class="company-logo-list">
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
    /* --- Base --- */
    .main-content { background-color: #f8f9fa; }

    /* --- Filter Card --- */
    .filter-card {
        background-color: #fff;
        padding: 1.75rem; /* Padding ditambah */
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,.04); /* Shadow halus */
        position: sticky; /* Membuat filter tetap terlihat */
        top: 20px; /* Jarak dari atas */
    }
    .filter-card .input-group-text {
        background-color: #e9ecef; /* Background ikon abu */
        border-right: none; /* Hilangkan border kanan ikon */
    }
    .filter-card .form-control, .filter-card .form-select {
        border-left: none; /* Hilangkan border kiri input (menyatu dgn ikon) */
    }
    .filter-card .btn-orange {
        font-weight: 500; /* Font tombol sedikit tebal */
    }

    /* --- Job List Container --- */
    .job-list-container {
        background-color: #fff;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        max-height: calc(100vh - 250px); /* Tinggi maksimum disesuaikan (kurangi tinggi navbar, filter, padding) */
        overflow-y: auto;
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,.04); /* Shadow halus */
    }
    /* Custom Scrollbar (Opsional, tapi keren) */
    .job-list-container::-webkit-scrollbar { width: 6px; }
    .job-list-container::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .job-list-container::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
    .job-list-container::-webkit-scrollbar-thumb:hover { background: #aaa; }

    /* --- Job List Card (di dalam container) --- */
    .job-list-card {
        padding: 1.25rem 1.5rem; /* Padding disesuaikan */
        border-bottom: 1px solid #e9ecef;
        cursor: pointer;
        transition: background-color 0.2s, border-left 0.2s; /* Tambah transisi border */
        border-left: 4px solid transparent; /* Border kiri transparan */
    }
    .job-list-card:last-child { border-bottom: none; }
    .job-list-card:hover { background-color: #f8f9fa; }
    .job-list-card.active {
        background-color: #f8f9fa; /* Background aktif jadi abu */
        border-left: 4px solid #F39C12; /* Border kiri jadi oranye */
    }
    .company-logo-list { width: 48px; height: 48px; object-fit: contain; border-radius: 0.5rem; flex-shrink: 0; } /* Tambah flex-shrink */
    .job-title-list {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.25rem;
        color: #212529; /* Warna judul lebih tegas */
        /* Efek elipsis jika judul terlalu panjang */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 300px; /* Sesuaikan lebar maksimum */
    }
    .company-name-list, .location-list { font-size: 0.9rem; }
    .location-list i { color: #F39C12; } /* Warna ikon lokasi */

    /* Style Pagination (jika diperlukan) */
    .pagination .page-item.active .page-link {
        background-color: #F39C12;
        border-color: #F39C12;
    }
    .pagination .page-link {
        color: #F39C12;
    }

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
