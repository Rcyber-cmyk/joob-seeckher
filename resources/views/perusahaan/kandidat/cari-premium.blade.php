@extends('perusahaan.layouts.app')

@section('content')
<style>
    .filter-card { background-color: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); padding: 1.5rem; }
    .kandidat-card { background-color: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); transition: all 0.3s ease; overflow: hidden; height: 100%; display: flex; flex-direction: column; border: 2px solid transparent; }
    .kandidat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); }
    .premium-badge { position: absolute; top: 15px; right: 15px; background-color: #ffc107; color: #333; font-weight: bold; padding: 5px 10px; border-radius: 5px; font-size: 0.8rem; }
    .kandidat-img { width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid #ffc107; }
    .kandidat-info span { display: block; color: #6c757d; font-size: 0.9rem; }
</style>

{{-- Header Halaman --}}
<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div class="w-100 w-md-auto">
        <h1 class="fw-bold"><i class="bi bi-gem me-2 text-warning"></i> Talent Pool Premium</h1>
        <p class="text-muted mb-0">Akses kandidat terverifikasi dan berkualitas tinggi.</p>
    </div>
     <a href="{{ route('perusahaan.cari-kandidat.index') }}" class="btn btn-outline-primary mt-3 mt-md-0">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>
</div>

{{-- Form Filter --}}
<div class="filter-card mb-4">
    <form action="{{ route('perusahaan.kandidat.search.premium') }}" method="GET">
        <div class="row g-3 align-items-end">
            <div class="col-md-4"><label for="nama" class="form-label fw-bold">Nama Kandidat</label><input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh: Citra Kirana" value="{{ $request->nama ?? '' }}"></div>
            <div class="col-md-3"><label for="pendidikan" class="form-label fw-bold">Pendidikan</label><select name="pendidikan" id="pendidikan" class="form-select"><option value="">Semua</option><option value="S1" {{ ($request->pendidikan ?? '') == 'S1' ? 'selected' : '' }}>S1</option><option value="S2" {{ ($request->pendidikan ?? '') == 'S2' ? 'selected' : '' }}>S2</option><option value="S3" {{ ($request->pendidikan ?? '') == 'S3' ? 'selected' : '' }}>S3</option></select></div>
            <div class="col-md-3"><label for="pengalaman_min" class="form-label fw-bold">Min. Pengalaman (Tahun)</label><input type="number" name="pengalaman_min" id="pengalaman_min" class="form-control" placeholder="Contoh: 5" value="{{ $request->pengalaman_min ?? '' }}"></div>
            <div class="col-md-2"><button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel-fill me-1"></i> Cari</button></div>
        </div>
    </form>
</div>

{{-- Hasil Pencarian --}}
<div class="row g-4">
    @forelse ($kandidat as $item)
        <div class="col-md-6 col-lg-4">
            <div class="kandidat-card position-relative">
                <span class="premium-badge"><i class="bi bi-patch-check-fill"></i> Terverifikasi</span>
                <div class="p-4 text-center" style="background-color: #fffcf1;">
                    <img src="{{ $item->foto_profil ? asset('storage/' . $item->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil" class="kandidat-img mb-3">
                    <h5 class="fw-bold mb-1">{{ $item->user->name }}</h5>
                    <p class="text-muted">{{ $item->user->email }}</p>
                </div>
                <div class="p-4 kandidat-info">
                    <span><i class="bi bi-geo-alt-fill me-2"></i> {{ $item->domisili ?: 'N/A' }}</span>
                    <span><i class="bi bi-mortarboard-fill me-2"></i> {{ $item->lulusan ?: 'N/A' }}</span>
                    <span><i class="bi bi-briefcase-fill me-2"></i> {{ $item->pengalaman_kerja ?: '0' }} Tahun Pengalaman</span>
                </div>
                <div class="p-3 bg-light mt-auto">
                    <button class="btn btn-warning btn-sm w-100 invite-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#inviteModal"
                            data-pelamar-id="{{ $item->id }}"
                            data-pelamar-name="{{ $item->user->name }}">
                        <i class="bi bi-send-fill me-1"></i> Undang Melamar
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center p-5 bg-white rounded shadow-sm">
                <i class="bi bi-person-x-fill display-4 text-muted"></i>
                <h4 class="mt-3">Kandidat Premium Tidak Ditemukan</h4>
                <p class="text-muted">Coba ubah filter pencarian Anda, atau saat ini belum ada kandidat premium.</p>
                <a href="{{ route('perusahaan.kandidat.search.premium') }}" class="btn btn-primary mt-2">Reset Filter</a>
            </div>
        </div>
    @endforelse
</div>

{{-- Pagination & Modal --}}
<div class="d-flex justify-content-center mt-5">{{ $kandidat->links() }}</div>

{{-- Kita akan include modal dan script dari file terpisah agar rapi --}}
@include('perusahaan.kandidat.partials.modal-undang')
@endsection

@push('scripts')
@include('perusahaan.kandidat.partials.script-undang')
@endpush

