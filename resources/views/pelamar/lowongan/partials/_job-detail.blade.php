@if($detailLowongan)
<style>
    /* CSS Khusus Detail */
    .detail-hero-banner {
        background: linear-gradient(135deg, #1a2c3d 0%, #151f28 100%);
        padding: 3rem 2rem 6rem 2rem; border-radius: 0 0 2.5rem 2.5rem;
        color: white; position: relative; overflow: hidden;
    }
    .detail-hero-banner::before {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 20px 20px; pointer-events: none;
    }
    .detail-overlap-content { margin-top: -4.5rem; padding: 0 1.5rem; position: relative; z-index: 10; }
    
    .company-logo-main {
        width: 100px; height: 100px; object-fit: contain; background: white;
        border-radius: 20px; padding: 5px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 4px solid white;
    }
    
    /* Tombol Profil */
    .btn-profile-company {
        background: white; color: #22374e; border: 1px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08); font-weight: 700; transition: all 0.3s;
    }
    .btn-profile-company:hover {
        background: #22374e; color: white; transform: translateY(-3px);
    }

    /* Info Grid */
    .stat-card {
        background: white; padding: 1.2rem; border-radius: 16px; text-align: center;
        border: 1px solid #f0f0f0; box-shadow: 0 4px 10px rgba(0,0,0,0.02); height: 100%;
    }
    .stat-card:hover { transform: translateY(-5px); border-color: #F39C12; }
    .stat-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.8rem auto; font-size: 1.1rem;}

    /* Modal Styling Lebih Mewah */
    .modal-banner { height: 130px; background: linear-gradient(to right, #22374e, #2c3e50); border-radius: 1rem 1rem 0 0; position: relative;}
    .modal-logo-wrapper { margin-top: -65px; position: relative; z-index: 5; }
    .contact-item { padding: 10px; background: #f8f9fa; border-radius: 10px; margin-bottom: 10px; transition: 0.2s; }
    .contact-item:hover { background: #fff3cd; }
</style>

<div class="position-relative pb-5 animate__animated animate__fadeIn">
    
    {{-- 1. HEADER BANNER (Tombol Simpan SUDAH DIHAPUS) --}}
    <div class="detail-hero-banner text-center">
        <div class="d-flex justify-content-center align-items-start position-relative z-2 mb-3">
            <span class="badge bg-white bg-opacity-10 text-white border border-light border-opacity-25 px-3 py-2 rounded-pill fw-normal text-uppercase ls-1">
                {{ $detailLowongan->tipe_pekerjaan ?? 'Full Time' }}
            </span>
        </div>
        
        <h2 class="fw-bold mb-2">{{ $detailLowongan->judul_lowongan }}</h2>
        <div class="d-flex justify-content-center align-items-center gap-2 text-white-50">
            <span>{{ $detailLowongan->perusahaan->nama_perusahaan }}</span>
            @if($detailLowongan->perusahaan->is_premium)
                <i class="bi bi-patch-check-fill text-warning" title="Verified"></i>
            @endif
        </div>
    </div>

    {{-- 2. OVERLAPPING CONTENT --}}
    <div class="detail-overlap-content">
        
        {{-- LOGO & TOMBOL PROFIL --}}
        <div class="d-flex flex-column align-items-center mb-5">
            <img src="{{ $detailLowongan->perusahaan->logo_perusahaan ? asset('storage/' . $detailLowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/100x100/e9ecef/343a40?text=Logo' }}" 
                 class="company-logo-main mb-3">
            
            <button class="btn btn-sm btn-profile-company rounded-pill px-4 py-2" 
                    data-bs-toggle="modal" 
                    data-bs-target="#companyModal-{{ $detailLowongan->id }}">
                <i class="bi bi-building me-2 text-orange"></i> Lihat Profil Perusahaan
            </button>
        </div>

        {{-- INFO GRID --}}
        <div class="row g-3 mb-5 px-lg-3">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-geo-alt-fill"></i></div>
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size:0.65rem">Lokasi</small>
                    <span class="fw-bold text-dark small">{{ Str::limit($detailLowongan->domisili, 15) }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-mortarboard-fill"></i></div>
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size:0.65rem">Pendidikan</small>
                    <span class="fw-bold text-dark small">{{ $detailLowongan->pendidikan_terakhir }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-briefcase-fill"></i></div>
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size:0.65rem">Pengalaman</small>
                    <span class="fw-bold small text-dark">{{ $detailLowongan->pengalaman_kerja }} Thn</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-currency-dollar"></i></div>
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size:0.65rem">Gaji</small>
                    <span class="fw-bold text-dark small">Kompetitif</span>
                </div>
            </div>
        </div>

        {{-- DESKRIPSI --}}
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4">
                    <h5 class="fw-bold text-dark-blue mb-4 border-bottom pb-2">Deskripsi Pekerjaan</h5>
                    <div class="text-secondary lh-lg mb-5" style="text-align: justify;">
                        {!! nl2br(e($detailLowongan->deskripsi_pekerjaan)) !!}
                    </div>

                    <h5 class="fw-bold text-dark-blue mb-4 border-bottom pb-2">Kualifikasi</h5>
                    <div class="row g-3">
                        <div class="col-md-4"><div class="p-3 bg-light rounded-3"><small class="d-block text-muted">Gender</small> <b>{{ $detailLowongan->gender }}</b></div></div>
                        <div class="col-md-4"><div class="p-3 bg-light rounded-3"><small class="d-block text-muted">Usia</small> <b>{{ $detailLowongan->usia }} Thn</b></div></div>
                        <div class="col-md-4"><div class="p-3 bg-light rounded-3"><small class="d-block text-muted">Nilai Min</small> <b>{{ $detailLowongan->nilai_pendidikan_terakhir }}</b></div></div>
                    </div>
                    
                    @if($detailLowongan->keahlian_bidang_pekerjaan)
                        <div class="mt-4">
                            <small class="text-muted d-block mb-2 fw-bold">Keahlian:</small>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(explode(',', $detailLowongan->keahlian_bidang_pekerjaan) as $skill)
                                    <span class="badge bg-white text-dark border px-3 py-2 rounded-pill fw-normal shadow-sm">
                                        <i class="bi bi-check2 text-success me-1"></i> {{ trim($skill) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 3. STICKY ACTION BAR --}}
    <div class="position-sticky bottom-0 start-0 w-100 p-3 bg-white border-top shadow-lg d-flex justify-content-between align-items-center z-3" style="border-radius: 20px 20px 0 0;">
        <div class="d-none d-md-block px-3">
            <small class="text-muted d-block">Status Lamaran</small>
            <span class="fw-bold text-success">Sedang Dibuka</span>
        </div>
        <div class="d-flex gap-2 w-100 w-md-auto justify-content-end px-md-3">
            {{-- Tombol Bookmark Tetap Ada Di Sini --}}
            <button onclick="toggleBookmark({{ $detailLowongan->id }})" 
                    class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center btn-bookmark-{{ $detailLowongan->id }}" 
                    style="width: 45px; height: 45px;">
                <i class="bi {{ in_array($detailLowongan->id, $saved_lowongan_ids) ? 'bi-bookmark-fill text-orange' : 'bi-bookmark' }} icon-bookmark-{{ $detailLowongan->id }} fs-5"></i>
            </button>

            @if($sudahMelamar)
                <button class="btn btn-success rounded-pill px-5 fw-bold w-100 w-md-auto" disabled><i class="bi bi-check-lg me-1"></i> Lamaran Terkirim</button>
            @else
                <a href="{{ route('lowongan.lamar.form', $detailLowongan->id) }}" class="btn btn-orange rounded-pill px-5 fw-bold w-100 w-md-auto shadow-sm">Lamar Sekarang</a>
            @endif
        </div>
    </div>

    {{-- ========================================================== --}}
    {{-- MODAL PROFIL PERUSAHAAN (FULL LENGKAP)                     --}}
    {{-- ========================================================== --}}
    <div class="modal fade" id="companyModal-{{ $detailLowongan->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                
                {{-- Banner Modal --}}
                <div class="modal-banner d-flex align-items-start justify-content-end p-3">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body px-4 pb-5 pt-0 text-center">
                    {{-- Logo --}}
                    <div class="modal-logo-wrapper mb-3">
                        <img src="{{ $detailLowongan->perusahaan->logo_perusahaan ? asset('storage/' . $detailLowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/100x100/e9ecef/343a40?text=Logo' }}" 
                             class="rounded-circle border border-4 border-white shadow-sm bg-white" style="width: 110px; height: 110px; object-fit: contain;">
                    </div>

                    <h3 class="fw-bold mb-1">{{ $detailLowongan->perusahaan->nama_perusahaan }}</h3>
                    @if($detailLowongan->perusahaan->is_premium)
                        <div class="mb-4">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="bi bi-patch-check-fill"></i> Verified Partner</span>
                        </div>
                    @else
                        <div class="mb-4"></div>
                    @endif

                    <div class="row text-start mt-4">
                        {{-- Kolom Kiri: Deskripsi --}}
                        <div class="col-lg-7 mb-4 mb-lg-0 border-end-lg">
                            <h6 class="fw-bold text-uppercase text-dark-blue small mb-3 border-bottom pb-2">Tentang Perusahaan</h6>
                            <p class="text-secondary small" style="line-height: 1.8; text-align: justify;">
                                {{ $detailLowongan->perusahaan->deskripsi ?? 'Belum ada deskripsi profil perusahaan yang tersedia.' }}
                            </p>
                        </div>

                        {{-- Kolom Kanan: Kontak Lengkap --}}
                        <div class="col-lg-5 ps-lg-4">
                            <h6 class="fw-bold text-uppercase text-dark-blue small mb-3 border-bottom pb-2">Informasi & Kontak</h6>
                            
                            <div class="contact-item d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill text-orange fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.65rem;">ALAMAT</small>
                                    <span class="text-dark fw-bold small">
                                        {{ $detailLowongan->perusahaan->alamat_jalan ?? '' }} {{ $detailLowongan->perusahaan->alamat_kota }} 
                                        {{ $detailLowongan->perusahaan->kode_pos ? ', ' . $detailLowongan->perusahaan->kode_pos : '' }}
                                    </span>
                                </div>
                            </div>

                            <div class="contact-item d-flex align-items-center">
                                <i class="bi bi-telephone-fill text-orange fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.65rem;">TELEPON</small>
                                    <span class="text-dark fw-bold small">
                                        {{ $detailLowongan->perusahaan->no_telp_perusahaan ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="contact-item d-flex align-items-center">
                                <i class="bi bi-envelope-fill text-orange fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.65rem;">EMAIL</small>
                                    <span class="text-dark fw-bold small">
                                        {{ $detailLowongan->perusahaan->user->email ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="contact-item d-flex align-items-center">
                                <i class="bi bi-globe text-orange fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.65rem;">WEBSITE</small>
                                    @if($detailLowongan->perusahaan->situs_web)
                                        <a href="{{ $detailLowongan->perusahaan->situs_web }}" target="_blank" class="text-decoration-none fw-bold small">{{ $detailLowongan->perusahaan->situs_web }}</a>
                                    @else
                                        <span class="text-dark small">-</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-3 text-center">
                                <small class="text-muted">Bergabung sejak {{ $detailLowongan->perusahaan->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@else
    {{-- Tampilan Kosong --}}
    <div class="d-flex flex-column justify-content-center align-items-center h-100 text-center p-5">
        <div class="bg-white p-4 rounded-circle shadow-sm mb-4"><i class="bi bi-briefcase text-orange display-1"></i></div>
        <h4 class="fw-bold text-dark-blue">Mulai Karir Barumu</h4>
        <p class="text-muted">Pilih lowongan di sebelah kiri untuk melihat detail.</p>
    </div>
@endif