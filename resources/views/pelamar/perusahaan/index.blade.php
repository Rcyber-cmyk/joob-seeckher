{{-- /resources/views/pelamar/perusahaan/index.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Jelajahi Perusahaan')

@section('content')
<div class="hero-jelajahi">
    <div class="container text-center">
        <h1>Perusahaan yang Tersedia</h1>
        <p>Temukan perusahaan impian Anda dan lihat lowongan yang mereka tawarkan.</p>
    </div>
</div>

<div class="main-content">
    <div class="container py-5">
        <div class="row g-4">
            <!-- KOLOM KIRI (FILTER) -->
            <div class="col-lg-3">
                <div class="filter-sidebar">
                    <h5 class="filter-title">Filter Pencarian</h5>
                    <form action="{{ route('perusahaan.index') }}" method="GET">
                        <div class="mb-3">
                            <label for="search" class="form-label">Cari Perusahaan</label>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Nama perusahaan..." value="{{ request('search') }}">
                        </div>
                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang Pekerjaan</label>
                            <select name="bidang" id="bidang" class="form-select">
                                <option value="">Semua Bidang</option>
                                @foreach($bidangPekerjaan as $bidang)
                                    <option value="{{ $bidang->id }}" {{ request('bidang') == $bidang->id ? 'selected' : '' }}>{{ $bidang->nama_bidang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                             <select name="lokasi" id="lokasi" class="form-select">
                                <option value="">Semua Lokasi</option>
                                @foreach($lokasi as $loc)
                                    <option value="{{ $loc }}" {{ request('lokasi') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- KOLOM KANAN (DAFTAR PERUSAHAAN) -->
            <div class="col-lg-9">
                @forelse($perusahaan as $p)
                <div class="company-card">
                    <div class="company-banner">
                        <img src="{{ $p->banner ? asset('storage/' . $p->banner) : 'https://placehold.co/800x200/e9ecef/343a40?text=Banner' }}" alt="Banner {{ $p->nama_perusahaan }}">
                    </div>
                    <div class="company-header">
                        <img src="{{ $p->logo ? asset('storage/' . $p->logo) : 'https://placehold.co/100x100/e9ecef/343a40?text=' . substr($p->nama_perusahaan, 0, 1) }}" alt="Logo {{ $p->nama_perusahaan }}" class="company-logo">
                        <div>
                            <h4 class="company-name">{{ $p->nama_perusahaan }}</h4>
                            <p class="company-location text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $p->alamat_perusahaan }}</p>
                        </div>
                    </div>
                    <div class="company-body">
                        <h6 class="section-subtitle">Tentang Perusahaan</h6>
                        <p>{{ $p->deskripsi }}</p>
                        
                        <h6 class="section-subtitle mt-4">Lowongan Tersedia</h6>
                        <div class="job-list">
                            @forelse($p->lowonganPekerjaan as $lowongan)
                                <div class="job-item">
                                    <div>
                                        <div class="job-item-title">{{ $lowongan->judul_lowongan }}</div>
                                        <div class="job-item-location">{{ $p->alamat_perusahaan }}</div>
                                    </div>
                                    {{-- Tombol Lamar akan membutuhkan route dan logika tambahan nanti --}}
                                    <a href="#" class="btn btn-sm btn-orange">Lamar Sekarang</a>
                                </div>
                            @empty
                                <p class="text-muted">Saat ini tidak ada lowongan yang tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center empty-state">
                    <h5>Perusahaan Tidak Ditemukan</h5>
                    <p>Coba ubah kata kunci pencarian atau filter Anda.</p>
                </div>
                @endforelse

                {{-- Paginasi --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $perusahaan->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .main-content { background-color: #f0f2f5; }
    .hero-jelajahi {
        background-color: #22374e;
        color: white;
        padding: 4rem 0;
    }
    .hero-jelajahi h1 { font-weight: 700; }
    .filter-sidebar {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        position: sticky;
        top: 20px;
    }
    .filter-title { font-weight: 600; margin-bottom: 1rem; }
    .company-card {
        background-color: #fff;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    .company-banner img { width: 100%; height: 150px; object-fit: cover; }
    .company-header { display: flex; align-items: flex-end; padding: 0 1.5rem; margin-top: -50px; }
    .company-logo { width: 100px; height: 100px; border-radius: 0.75rem; border: 4px solid #fff; background-color: #fff; object-fit: contain; }
    .company-name { font-weight: 700; margin-left: 1rem; margin-bottom: 0.25rem; }
    .company-location { font-size: 0.9rem; margin-left: 1rem; }
    .company-body { padding: 1.5rem; }
    .section-subtitle { font-weight: 600; font-size: 1rem; margin-bottom: 0.5rem; }
    .job-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        margin-bottom: 0.75rem;
    }
    .job-item-title { font-weight: 600; }
    .job-item-location { font-size: 0.9rem; color: #6c757d; }
    .empty-state { background-color: #fff; padding: 3rem; border-radius: 0.75rem; }
</style>
@endpush
