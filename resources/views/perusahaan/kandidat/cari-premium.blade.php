@extends('perusahaan.layouts.app')

@section('content')
<style>
    .filter-card { background-color: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); padding: 1.5rem; }
    .kandidat-card { background-color: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); transition: all 0.3s ease; overflow: hidden; height: 100%; display: flex; flex-direction: column; border: 1px solid #e2e8f0; }
    .kandidat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); border-color: var(--orange); }
    .kandidat-card .card-body-premium { border-top: 4px solid #ffc107; padding: 1.5rem; flex-grow: 1; }
    .kandidat-card .btn-warning { background-color: #ffc107; border-color: #ffc107; color: var(--dark-blue); font-weight: 600; }
    .kandidat-card .btn-warning:hover { background-color: #ffca2c; border-color: #ffca2c; }
    .premium-badge { position: absolute; top: 15px; right: 15px; background-color: #ffc107; color: #333; font-weight: bold; padding: 5px 10px; border-radius: 5px; font-size: 0.8rem; }
    .kandidat-img { width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid #ffc107; }
    .kandidat-info span { display: block; color: #6c757d; font-size: 0.9rem; }
    
    .premium-lock-card { background: linear-gradient(135deg, var(--dark-blue), #334155); color: var(--white); border-radius: 1rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    .premium-lock-card .icon-wrapper { width: 100px; height: 100px; background-color: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; }
    .premium-lock-card .icon-wrapper i { font-size: 3rem; color: #ffc107; }
    .premium-lock-card h2 { font-weight: 700; color: var(--white); }
    .premium-lock-card p { font-size: 1.1rem; color: var(--slate-light); max-width: 500px; margin: 1rem auto; }
    .btn-premium-upgrade { background-color: #ffc107; color: var(--dark-blue); font-weight: 600; padding: 0.75rem 2rem; border-radius: 50px; border: none; transition: all 0.3s ease; }
    .btn-premium-upgrade:hover { background-color: #ffca2c; transform: scale(1.05); }
    .form-multiselect { height: 150px; }

    /* Style Filter "Mewah" */
    .filter-card .form-label { font-size: 0.85rem; font-weight: 600; color: var(--slate); margin-bottom: 0.5rem; }
    .filter-card .form-control,
    .filter-card .form-select { border-radius: 0.5rem; border: 2px solid #e2e8f0; padding: 0.6rem 1rem; font-weight: 500; background-color: #f8fafc; transition: all 0.2s ease; }
    .filter-card .form-control:focus,
    .filter-card .form-select:focus { background-color: var(--white); border-color: var(--orange); box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15); }
    .form-select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 16px 12px; -webkit-appearance: none; -moz-appearance: none; appearance: none; }
    .filter-card .btn-primary { background-color: var(--orange-dark); border-color: var(--orange-dark); font-weight: 600; padding: 0.6rem 1.5rem; }
    .filter-card .btn-primary:hover { background-color: var(--orange); border-color: var(--orange); }
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

{{-- 
=====================================================
KONTROL AKSES PREMIUM (3 KONDISI)
=====================================================
--}}

@if(Auth::user()->profilePerusahaan && Auth::user()->profilePerusahaan->is_premium)

    {{-- ========================================================== --}}
    {{-- 1. TAMPILAN JIKA PERUSAHAAN SUDAH PREMIUM (FITUR TERBUKA) --}}
    {{-- ========================================================== --}}

    <div class="filter-card mb-4">
        <form action="{{ route('perusahaan.kandidat.search.premium') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-12">
                    <label for="keahlian_ids" class="form-label">Keahlian Dicari (Opsional)</label>
                    <select name="keahlian_ids[]" id="keahlian_ids" class="form-select form-multiselect" multiple>
                        @foreach($opsiKeahlian as $keahlian)
                            <option value="{{ $keahlian->id }}" 
                                {{ (in_array($keahlian->id, $request->keahlian_ids ?? [])) ? 'selected' : '' }}>
                                {{ $keahlian->nama_keahlian }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mt-3">
                    <a data-bs-toggle="collapse" href="#filterLanjutan" role="button" 
                       aria-expanded="{{ $request->has('domisili') || $request->has('pendidikan') || $request->has('usia_min') ? 'true' : 'false' }}" 
                       aria-controls="filterLanjutan" class="text-decoration-none fw-bold">
                        <i class="bi bi-sliders me-1"></i> Filter Lanjutan
                    </a>
                </div>
            </div>

            <div class="collapse {{ $request->has('domisili') || $request->has('pendidikan') || $request->has('usia_min') ? 'show' : '' }} mt-3" id="filterLanjutan">
                <hr>
                <div class="row g-3 align-items-end">
                    <div class="col-md-3 col-sm-6">
                        <label for="domisili" class="form-label">Domisili</label>
                        <select name="domisili" id="domisili" class="form-select">
                            <option value="">Semua</option>
                            @foreach($opsiDomisili as $dom)
                                <option value="{{ $dom }}" {{ ($request->domisili ?? '') == $dom ? 'selected' : '' }}>{{ $dom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="pendidikan" class="form-label">Pendidikan</label>
                        <select name="pendidikan" id="pendidikan" class="form-select">
                            <option value="">Semua</option>
                            @foreach($opsiPendidikan as $pend)
                                <option value="{{ $pend }}" {{ ($request->pendidikan ?? '') == $pend ? 'selected' : '' }}>{{ $pend }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="pengalaman_kerja" class="form-label">Pengalaman</label>
                        <select name="pengalaman_kerja" id="pengalaman_kerja" class="form-select">
                             <option value="">Semua</option>
                            @foreach($opsiPengalaman as $peng)
                                <option value="{{ $peng }}" {{ ($request->pengalaman_kerja ?? '') == $peng ? 'selected' : '' }}>{{ $peng }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col-md-3 col-sm-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">Semua</option>
                            <option value="Laki-laki" {{ ($request->gender ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ ($request->gender ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                        <label for="usia_min" class="form-label">Usia Min.</label>
                        <input type="number" name="usia_min" id="usia_min" class="form-control" placeholder="Contoh: 20" value="{{ $request->usia_min ?? '' }}">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="usia_maks" class="form-label">Usia Maks.</label>
                        <input type="number" name="usia_maks" id="usia_maks" class="form-control" placeholder="Contoh: 35" value="{{ $request->usia_maks ?? '' }}">
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                        <select name="tahun_lulus" id="tahun_lulus" class="form-select">
                             <option value="">Semua</option>
                            @foreach($opsiTahunLulus as $tahun)
                                <option value="{{ $tahun }}" {{ ($request->tahun_lulus ?? '') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label for="nilai_akhir_min" class="form-label">Nilai Min. (IPK/Rata-rata)</label>
                        <input type="text" name="nilai_akhir_min" id="nilai_akhir_min" class="form-control" placeholder="Contoh: 3.00" value="{{ $request->nilai_akhir_min ?? '' }}">
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12 text-end">
                    <a href="{{ route('perusahaan.kandidat.search.premium') }}" class="btn btn-outline-secondary">Reset Filter</a>
                    <button type="submit" class="btn btn-secondary w-auto"><i class="bi bi-funnel-fill me-1"></i> Terapkan Filter</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Hasil Pencarian --}}
    <div class="row g-4">
        @forelse ($kandidat as $item)
            <div class="col-md-6 col-lg-4">
                <div class="kandidat-card">
                    @if($item->is_premium)
                        <span class="premium-badge"><i class="bi bi-patch-check-fill"></i> Terverifikasi</span>
                    @endif
                    <div class="p-4 text-center {{ $item->is_premium ? 'bg-warning-subtle' : 'bg-light' }}">
                        <img src="{{ $item->foto_profil ? asset('storage/'. $item->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil" 
                             class="kandidat-img mb-3" style="border-color: {{ $item->is_premium ? '#ffc107' : '#e2e8f0' }};">
                        <h5 class="fw-bold mb-1">{{ $item->user->name }}</h5>
                        <p class="text-muted">{{ $item->user->email }}</p>
                    </div>
                    <div class="card-body-premium">
                        <div class="kandidat-info">
                            <span><i class="bi bi-geo-alt-fill me-2"></i> {{ $item->domisili ?: 'N/A' }}</span>
                            <span><i class="bi bi-mortarboard-fill me-2"></i> {{ $item->lulusan ?: 'N/A' }}</span>
                            <span><i class="bi bi-briefcase-fill me-2"></i> {{ $item->pengalaman_kerja ?: 'Belum ada' }}</span>
                        </div>
                    </div>
                    <div class="p-3 bg-light mt-auto d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm w-50"
                                data-bs-toggle="modal" 
                                data-bs-target="#detailKandidatModal{{ $item->id }}">
                            <i class="bi bi-person-vcard me-1"></i> Lihat Profil
                        </button>
                        <button class="btn btn-warning btn-sm w-50 invite-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#inviteModal"
                                data-pelamar-id="{{ $item->id }}"
                                data-pelamar-name="{{ $item->user->name }}">
                            <i class="bi bi-send-fill me-1"></i> Undang
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center p-5 bg-white rounded shadow-sm">
                    <i class="bi bi-person-x-fill display-4 text-muted"></i>
                    <h4 class="mt-3">Kandidat Tidak Ditemukan</h4>
                    <p class="text-muted">Coba ubah filter pencarian Anda. Saat ini tidak ada kandidat yang cocok.</p>
                    <a href="{{ route('perusahaan.kandidat.search.premium') }}" class="btn btn-primary mt-2">Reset Filter</a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination & Modal --}}
    <div class="d-flex justify-content-center mt-5">{{ $kandidat->links() }}</div>

    @include('perusahaan.kandidat.partials.modal-undang')
    
    @foreach($kandidat as $item)
    <div class="modal fade" id="detailKandidatModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailKandidatModalLabel{{ $item->id }}" aria-hidden="true">
        </div>
    @endforeach

@elseif($pendingPayment)

    {{-- ========================================================== --}}
    {{-- 2. TAMPILAN JIKA BELUM PREMIUM, TAPI PEMBAYARAN PENDING --}}
    {{-- ========================================================== --}}
    <div class="row">
        <div class="col-12">
            <div class="premium-lock-card text-center p-4 p-md-5" style="background: linear-gradient(135deg, var(--dark-blue), #3a557a);">
                <div class="icon-wrapper mx-auto" style="background-color: rgba(255, 193, 7, 0.1);">
                    <i class="bi bi-clock-history" style="color: #ffc107;"></i>
                </div>
                <h2>Pembayaran Sedang Diproses</h2>
                <p>
                    Bukti pembayaran Anda sedang diverifikasi oleh Admin. <br class="d-none d-md-block">
                    Fitur Talent Pool Premium akan terbuka secara otomatis setelah disetujui.
                </p>
                <a href="{{ route('perusahaan.langganan.index') }}" class="btn btn-outline-warning">
                    <i class="bi bi-eye-fill me-2"></i>Lihat Status Pembayaran
                </a>
            </div>
        </div>
    </div>

@else

    {{-- ========================================================== --}}
    {{-- 3. TAMPILAN JIKA BELUM PREMIUM & BELUM BAYAR (FITUR TERKUNCI) --}}
    {{-- ========================================================== --}}
    <div class="row">
        <div class="col-12">
            <div class="premium-lock-card text-center p-4 p-md-5">
                <div class="icon-wrapper mx-auto">
                    <i class="bi bi-gem"></i>
                </div>
                <h2>Akses Fitur Kandidat Premium Terkunci</h2>
                <p>
                    Upgrade paket Anda untuk membuka akses penuh ke Talent Pool. <br class="d-none d-md-block">
                    Cari kandidat terverifikasi dan undang mereka melamar secara langsung.
                </p>
                
                <a href="{{ route('perusahaan.langganan.index') }}" class="btn btn-premium-upgrade">
                    <i class="bi bi-arrow-up-circle-fill me-2"></i> Upgrade ke Premium Sekarang
                </a>
            </div>
        </div>
    </div>

@endif 

@endsection

@push('scripts')
{{-- Script untuk modal undang (dari kode Anda) --}}
@include('perusahaan.kandidat.partials.script-undang')
@endpush