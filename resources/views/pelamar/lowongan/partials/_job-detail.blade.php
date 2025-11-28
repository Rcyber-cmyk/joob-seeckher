@if($detailLowongan)
<style>
    /* =========================================
       1. HERO & LAYOUT UTAMA (DETAIL JOB)
       ========================================= */
    .detail-hero-banner {
        background: linear-gradient(135deg, #1a2c3d 0%, #151f28 100%);
        padding: 3rem 2rem 6rem 2rem;
        border-radius: 0 0 2.5rem 2.5rem;
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
    
    .btn-profile-company {
        background: white; color: #22374e; border: 1px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08); font-weight: 700; transition: all 0.3s;
    }
    .btn-profile-company:hover {
        background: #22374e; color: white; transform: translateY(-3px);
    }

    /* =========================================
       2. INFO GRID & STATS
       ========================================= */
    .stat-card {
        background: white; padding: 1.2rem; border-radius: 16px; text-align: center;
        border: 1px solid #f0f0f0; box-shadow: 0 4px 10px rgba(0,0,0,0.02); height: 100%;
    }
    .stat-card:hover { transform: translateY(-3px); border-color: #F39C12; }
    .stat-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.8rem auto; font-size: 1.1rem;}

    /* =========================================
       3. MODAL PERUSAHAAN (DESKTOP DEFAULT)
       ========================================= */
    /* Agar logo yang 'floating' tidak terpotong */
    .modal-content-custom {
        border: 0; border-radius: 1.5rem; 
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        overflow: visible !important; 
    }

    .modal-banner-fancy { 
        height: 140px; 
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
        border-top-left-radius: 1.5rem; border-top-right-radius: 1.5rem;
        position: relative; overflow: hidden;
    }
    
    /* Logo Floating Absolute (Default Desktop) */
    .modal-logo-absolute {
        position: absolute;
        top: 70px; /* Posisi vertikal logo */
        left: 50%;
        transform: translateX(-50%);
        width: 110px; height: 110px;
        z-index: 1060;
    }
    .modal-logo-absolute img {
        width: 100%; height: 100%; object-fit: contain;
        background: white; border-radius: 50%; padding: 5px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2); border: 4px solid white;
    }

    .contact-list-item {
        display: flex; align-items: center; gap: 12px;
        padding: 12px; margin-bottom: 8px;
        background: #f8fafc; border-radius: 12px; border: 1px solid #f1f5f9;
        transition: all 0.2s;
    }
    .contact-list-item:hover { background: #fff7ed; border-color: #fdba74; }
    .contact-icon {
        width: 36px; height: 36px; background: #fff; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #F39C12; box-shadow: 0 2px 5px rgba(0,0,0,0.05); font-size: 1.1rem;
        flex-shrink: 0; /* Agar icon tidak gepeng di HP */
    }

    /* Border pemisah default (kanan) */
    .modal-split-line { border-right: 1px solid #e9ecef; }

    /* =========================================
       4. MOBILE RESPONSIVE FIXES (UPDATE!)
       ========================================= */
    @media (max-width: 991.98px) {
        /* Layout Detail Job */
        .detail-hero-banner { padding: 2rem 1.5rem 5rem 1.5rem; border-radius: 0 0 1.5rem 1.5rem; }
        .detail-overlap-content { margin-top: -3.5rem; padding: 0 1rem; }
        .company-logo-main { width: 80px; height: 80px; }
        .stat-card { padding: 1rem 0.5rem; }
        .stat-icon { width: 30px; height: 30px; font-size: 0.9rem; margin-bottom: 0.5rem; }
        
        /* --- FIX MODAL DI HP --- */
        .modal-banner-fancy { height: 120px; } /* Banner lebih pendek dikit */
        
        .modal-logo-absolute {
            width: 90px; height: 90px; /* Logo lebih kecil */
            top: 75px; /* Sesuaikan posisi */
        }
        
        /* Hapus border kanan, ganti border bawah */
        .modal-split-line { 
            border-right: none !important; 
            border-bottom: 1px dashed #e2e8f0; 
            margin-bottom: 1.5rem; 
            padding-bottom: 1.5rem; 
        }
        
        /* Reset padding kolom kanan di modal */
        .modal-body .ps-md-4 { padding-left: 0 !important; }
        
        /* Spacer khusus mobile agar konten tidak ketabrak logo */
        .mobile-logo-spacer { margin-top: 40px !important; } 
    }
</style>

<div class="position-relative pb-5 animate__animated animate__fadeIn">
    
    {{-- HEADER BANNER JOB --}}
    <div class="detail-hero-banner text-center">
        <div class="d-flex justify-content-center align-items-start position-relative z-2 mb-3">
            <span class="badge bg-white bg-opacity-10 text-white border border-light border-opacity-25 px-3 py-2 rounded-pill fw-normal text-uppercase ls-1">
                {{ $detailLowongan->tipe_pekerjaan ?? 'Full Time' }}
            </span>
        </div>
        
        <h2 class="fw-bold mb-2 fs-3">{{ $detailLowongan->judul_lowongan }}</h2>
        <div class="d-flex justify-content-center align-items-center gap-2 text-white-50 small">
            <span>{{ $detailLowongan->perusahaan->nama_perusahaan }}</span>
            @if($detailLowongan->perusahaan->is_premium)
                <i class="bi bi-patch-check-fill text-warning" title="Verified"></i>
            @endif
        </div>
    </div>

    {{-- CONTENT JOB OVERLAP --}}
    <div class="detail-overlap-content">
        
        {{-- Logo & Tombol Profil --}}
        <div class="d-flex flex-column align-items-center mb-4 mb-md-5">
            <img src="{{ $detailLowongan->perusahaan->logo_perusahaan ? asset('storage/' . $detailLowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/100x100/e9ecef/343a40?text=Logo' }}" 
                 class="company-logo-main mb-3">
            
            <button class="btn btn-sm btn-profile-company rounded-pill px-4 py-2" 
                    data-bs-toggle="modal" 
                    data-bs-target="#companyModal-{{ $detailLowongan->id }}">
                <i class="bi bi-building me-2 text-orange"></i> Lihat Profil Perusahaan
            </button>
        </div>

        {{-- Info Grid --}}
        <div class="row g-2 g-md-3 mb-4 px-lg-3">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-geo-alt-fill"></i></div>
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size:0.6rem">Lokasi</small>
                    <span class="fw-bold text-dark small text-truncate d-block">{{ Str::limit($detailLowongan->domisili, 15) }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-mortarboard-fill"></i></div>
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size:0.6rem">Pendidikan</small>
                    <span class="fw-bold text-dark small text-truncate d-block">{{ $detailLowongan->pendidikan_terakhir }}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-briefcase-fill"></i></div>
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size:0.6rem">Pengalaman</small>
                    <span class="fw-bold text-dark small text-truncate d-block">{{ $detailLowongan->pengalaman_kerja }} Thn</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-currency-dollar"></i></div>
                    <small class="d-block text-muted text-uppercase fw-bold" style="font-size:0.6rem">Gaji</small>
                    <span class="fw-bold text-dark small text-truncate d-block">Kompetitif</span>
                </div>
            </div>
        </div>

        {{-- Deskripsi & Kualifikasi --}}
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="bg-white p-3 p-md-5 rounded-4 border shadow-sm mb-4">
                    <h5 class="fw-bold text-dark-blue mb-3 border-bottom pb-2">Deskripsi Pekerjaan</h5>
                    <div class="text-secondary lh-base mb-4 small text-justify">
                        {!! nl2br(e($detailLowongan->deskripsi_pekerjaan)) !!}
                    </div>

                    <h5 class="fw-bold text-dark-blue mb-3 border-bottom pb-2">Kualifikasi</h5>
                    <div class="row g-2">
                        <div class="col-12 col-md-4"><div class="p-2 bg-light rounded-3"><small class="d-block text-muted">Gender</small> <b>{{ $detailLowongan->gender }}</b></div></div>
                        <div class="col-12 col-md-4"><div class="p-2 bg-light rounded-3"><small class="d-block text-muted">Usia</small> <b>{{ $detailLowongan->usia_min ? $detailLowongan->usia_min.'-' : '' }}{{ $detailLowongan->usia }} Tahun</b></div></div>
                        <div class="col-12 col-md-4"><div class="p-2 bg-light rounded-3"><small class="d-block text-muted">Nilai Min</small> <b>{{ $detailLowongan->nilai_pendidikan_terakhir }}</b></div></div>
                    </div>
                    
                    @if($detailLowongan->keahlian_bidang_pekerjaan)
                        <div class="mt-4">
                            <small class="fw-bold text-dark d-block mb-2">Keahlian:</small>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(explode(',', $detailLowongan->keahlian_bidang_pekerjaan) as $skill)
                                    <span class="badge bg-white text-dark border fw-normal py-2">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- STICKY BAR --}}
    <div class="position-sticky bottom-0 start-0 w-100 p-3 bg-white border-top shadow-lg d-flex justify-content-between align-items-center z-3" style="border-radius: 20px 20px 0 0;">
        <div class="d-none d-md-block px-3">
            <small class="text-muted d-block">Status Lamaran</small>
            <span class="fw-bold text-success">Sedang Dibuka</span>
        </div>
        <div class="d-flex gap-2 w-100 w-md-auto justify-content-between justify-content-md-end px-1 px-md-3">
            <button onclick="toggleBookmark({{ $detailLowongan->id }})" 
                    class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center btn-bookmark-{{ $detailLowongan->id }}" 
                    style="width: 45px; height: 45px;">
                <i class="bi {{ in_array($detailLowongan->id, $saved_lowongan_ids) ? 'bi-bookmark-fill text-orange' : 'bi-bookmark' }} icon-bookmark-{{ $detailLowongan->id }} fs-5"></i>
            </button>

            @if($sudahMelamar)
                <button class="btn btn-success rounded-pill px-4 px-md-5 fw-bold flex-grow-1 flex-md-grow-0" disabled>
                    <i class="bi bi-check-lg me-1"></i> Terkirim
                </button>
            @else
                <a href="{{ route('lowongan.lamar.form', $detailLowongan->id) }}" class="btn btn-orange rounded-pill px-4 px-md-5 fw-bold shadow-sm flex-grow-1 flex-md-grow-0">
                    Lamar <span class="d-none d-sm-inline">Sekarang</span>
                </a>
            @endif
        </div>
    </div>

    {{-- ========================================================== --}}
    {{-- MODAL PROFIL PERUSAHAAN (FULL RESPONSIVE FIX)              --}}
    {{-- ========================================================== --}}
    <div class="modal fade" id="companyModal-{{ $detailLowongan->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            
            {{-- Modal Content dengan Overflow Visible (Penting buat logo) --}}
            <div class="modal-content modal-content-custom bg-white">
                
                {{-- Banner Modal --}}
                <div class="modal-banner-fancy d-flex align-items-start justify-content-end p-3">
                    <button type="button" class="btn btn-sm btn-light rounded-circle shadow-sm z-3" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- LOGO ABSOLUTE --}}
                <div class="modal-logo-absolute">
                    <img src="{{ $detailLowongan->perusahaan->logo_perusahaan ? asset('storage/' . $detailLowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/100x100/e9ecef/343a40?text=Logo' }}">
                </div>

                <div class="modal-body px-4 pb-5 pt-0 text-center">
                    
                    {{-- SPACER LOGO (Penting di Mobile) --}}
                    <div class="mt-5 mobile-logo-spacer"></div>

                    <h3 class="fw-bold mb-1 mt-2 fs-4">{{ $detailLowongan->perusahaan->nama_perusahaan }}</h3>
                    
                    @if($detailLowongan->perusahaan->is_premium)
                        <div class="mt-2 mb-4">
                            <span class="badge bg-orange bg-opacity-10 text-orange border border-orange border-opacity-25 px-3 py-2 rounded-pill small">
                                <i class="bi bi-patch-check-fill me-1"></i> Verified Partner
                            </span>
                        </div>
                    @else
                        <div class="mt-2 mb-4 text-muted small">Perusahaan Terdaftar</div>
                    @endif

                    {{-- CONTENT ROW --}}
                    <div class="row g-4 text-start">
                        
                        {{-- KIRI: TENTANG (Border Right di Desktop, Border Bottom di HP) --}}
                        <div class="col-md-7 modal-split-line">
                            <h6 class="fw-bold text-dark-blue mb-3 d-flex align-items-center">
                                <i class="bi bi-info-circle-fill me-2 text-muted"></i> Tentang Perusahaan
                            </h6>
                            <p class="text-secondary small" style="line-height: 1.8; text-align: justify;">
                                {{ $detailLowongan->perusahaan->deskripsi ?? 'Perusahaan ini belum menambahkan deskripsi profil.' }}
                            </p>
                            
                            <div class="mt-4 pt-3 border-top border-dashed">
                                <small class="text-muted d-block mb-1">Bergabung Sejak</small>
                                <span class="fw-bold text-dark">{{ $detailLowongan->perusahaan->created_at->format('d F Y') }}</span>
                            </div>
                        </div>

                        {{-- KANAN: KONTAK --}}
                        <div class="col-md-5 ps-md-4">
                            <h6 class="fw-bold text-dark-blue mb-3 d-flex align-items-center">
                                <i class="bi bi-person-lines-fill me-2 text-muted"></i> Kontak & Info
                            </h6>

                            <div class="contact-list-item">
                                <div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                <div class="overflow-hidden w-100">
                                    <small class="text-muted d-block" style="font-size: 0.65rem;">LOKASI</small>
                                    <span class="text-dark fw-bold small text-break lh-sm d-block">
                                        {{ $detailLowongan->perusahaan->alamat_kota }}
                                        @if($detailLowongan->perusahaan->alamat_jalan)
                                            <br><span class="fw-normal text-muted">{{ Str::limit($detailLowongan->perusahaan->alamat_jalan, 30) }}</span>
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="contact-list-item">
                                <div class="contact-icon"><i class="bi bi-globe"></i></div>
                                <div class="overflow-hidden w-100">
                                    <small class="text-muted d-block" style="font-size: 0.65rem;">WEBSITE</small>
                                    @if($detailLowongan->perusahaan->situs_web)
                                        <a href="{{ $detailLowongan->perusahaan->situs_web }}" target="_blank" class="text-decoration-none fw-bold text-dark-blue small text-truncate d-block">
                                            {{ parse_url($detailLowongan->perusahaan->situs_web, PHP_URL_HOST) ?? $detailLowongan->perusahaan->situs_web }}
                                            <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 0.6rem;"></i>
                                        </a>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </div>
                            </div>

                            <div class="contact-list-item">
                                <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                                <div class="overflow-hidden w-100">
                                    <small class="text-muted d-block" style="font-size: 0.65rem;">EMAIL</small>
                                    <span class="text-dark fw-bold small text-truncate d-block">
                                        {{ $detailLowongan->perusahaan->user->email ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="contact-list-item">
                                <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.65rem;">TELEPON</small>
                                    <span class="text-dark fw-bold small">
                                        {{ $detailLowongan->perusahaan->no_telp_perusahaan ?? '-' }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
                {{-- Footer Modal --}}
                <div class="modal-footer border-0 bg-light justify-content-center py-3" style="border-bottom-left-radius: 1.5rem; border-bottom-right-radius: 1.5rem;">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-5 fw-bold" data-bs-dismiss="modal">Tutup Profil</button>
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