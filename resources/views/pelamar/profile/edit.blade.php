@extends('pelamar.layouts.app')

@section('title', 'Edit Profil Saya')

@section('content')
{{-- HAPUS FOOTER (Biar fokus di form) --}}
<style>footer.footer { display: none !important; }</style>

{{-- HERO BANNER (BACKGROUND) --}}
<div class="profile-hero-bg">
    <div class="container h-100 d-flex flex-column justify-content-center text-center text-white position-relative z-2">
        <h2 class="fw-black mb-1 animate__animated animate__fadeInDown">Profil Profesional</h2>
        <p class="text-white-50 animate__animated animate__fadeInUp">Kelola informasi Anda untuk menarik perhatian perekrut terbaik.</p>
    </div>
    {{-- Dekorasi Pattern --}}
    <div class="hero-pattern"></div>
</div>

<div class="profile-content-wrapper">
    <div class="container pb-5">
        <form action="{{ route('pelamar.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ALERT MESSAGES (Floating) --}}
            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center animate__animated animate__fadeInDown">
                    <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Berhasil!</h6>
                        <small>{{ session('success') }}</small>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center animate__animated animate__shakeX">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-danger"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Periksa Kembali</h6>
                        <small>Ada beberapa input yang belum sesuai.</small>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                
                {{-- SIDEBAR KIRI (FOTO & NAVIGASI) --}}
                <div class="col-lg-4">
                    <div class="sticky-sidebar">
                        
                        {{-- 1. CARD FOTO PROFIL --}}
                        <div class="card card-profile-sidebar border-0 shadow-lg text-center mb-4">
                            <div class="card-body p-4">
                                {{-- Foto Upload Wrapper --}}
                                <div class="profile-upload-wrapper mx-auto mb-3">
                                    <img id="profileImagePreview" 
                                         src="{{ $profile->foto_profil ? asset('storage/' . $profile->foto_profil) : 'https://placehold.co/150x150/f1f5f9/cbd5e1?text=Upload' }}" 
                                         alt="Foto Profil" class="profile-img">
                                    
                                    {{-- Tombol Edit Overlay --}}
                                    <label for="foto_profil_input" class="upload-overlay">
                                        <i class="bi bi-camera-fill fs-3 text-white"></i>
                                        <span class="text-white small fw-bold mt-1">Ubah Foto</span>
                                    </label>
                                    <input type="file" name="foto_profil" id="foto_profil_input" class="d-none" accept="image/*">
                                </div>

                                <h5 class="fw-bold text-dark-blue mb-1">{{ $profile->nama_lengkap }}</h5>
                                <p class="text-muted small mb-4">{{ $user->email }}</p>

                                {{-- Progress Bar Kelengkapan --}}
                                <div class="p-3 bg-light rounded-3 text-start">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small fw-bold text-muted">Kelengkapan Profil</span>
                                        <span class="small fw-bold text-orange">{{ $profile->kelengkapan_profil ?? 0 }}%</span>
                                    </div>
                                    <div class="progress" style="height: 8px; border-radius: 4px;">
                                        <div class="progress-bar bg-gradient-orange" role="progressbar" 
                                             style="width: {{ $profile->kelengkapan_profil ?? 0 }}%;"></div>
                                    </div>
                                </div>
                                <div class="mt-4 d-grid">
                                    <a href="{{ route('pelamar.profile.download_cv') }}" class="btn btn-outline-dark rounded-pill fw-bold" target="_blank">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i> Download CV (PDF)
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- 2. CARD NAVIGASI (Scrollspy) --}}
                        <div class="card border-0 shadow-sm d-none d-lg-block">
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush rounded-3 overflow-hidden">
                                    <a href="#section-pribadi" class="list-group-item list-group-item-action py-3 px-4 active-nav">
                                        <i class="bi bi-person-bounding-box me-3"></i> Informasi Pribadi
                                    </a>
                                    <a href="#section-alamat" class="list-group-item list-group-item-action py-3 px-4">
                                        <i class="bi bi-geo-alt-fill me-3"></i> Alamat & Kontak
                                    </a>
                                    <a href="#section-pendidikan" class="list-group-item list-group-item-action py-3 px-4">
                                        <i class="bi bi-mortarboard-fill me-3"></i> Pendidikan & Karir
                                    </a>
                                    <a href="#section-dokumen" class="list-group-item list-group-item-action py-3 px-4">
                                        <i class="bi bi-file-earmark-person-fill me-3"></i> Ringkasan & Dokumen
                                    </a>
                                    <a href="#section-keahlian" class="list-group-item list-group-item-action py-3 px-4">
                                        <i class="bi bi-stars me-3"></i> Keahlian (Skills)
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- KONTEN KANAN (FORMULIR) --}}
                <div class="col-lg-8">
                    
                    {{-- 1. INFORMASI PRIBADI --}}
                    <div id="section-pribadi" class="card border-0 shadow-sm mb-4 form-card">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold text-dark-blue mb-4 pb-2 border-bottom">Informasi Pribadi</h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Nama Depan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-modern" name="nama_depan" value="{{ old('nama_depan', explode(' ', $profile->nama_lengkap)[0]) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Nama Belakang</label>
                                    <input type="text" class="form-control form-control-modern" name="nama_belakang" value="{{ old('nama_belakang', explode(' ', $profile->nama_lengkap, 2)[1] ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-modern" name="tanggal_lahir" value="{{ old('tanggal_lahir', $profile->tanggal_lahir) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-modern" name="gender" required>
                                        <option value="Laki-laki" {{ old('gender', $profile->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender', $profile->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">NIK (KTP)</label>
                                    <input type="text" class="form-control form-control-modern bg-light text-muted cursor-not-allowed" value="{{ $profile->nik }}" readonly disabled>
                                    <div class="form-text ms-1"><i class="bi bi-lock-fill me-1"></i>NIK tidak dapat diubah demi keamanan data.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. ALAMAT & DOMISILI --}}
                    <div id="section-alamat" class="card border-0 shadow-sm mb-4 form-card">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold text-dark-blue mb-4 pb-2 border-bottom">Alamat & Kontak</h5>
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label-custom">Alamat Lengkap (Sesuai KTP)</label>
                                    <textarea class="form-control form-control-modern" name="alamat" rows="3" required>{{ old('alamat', $profile->alamat) }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Domisili Saat Ini</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3"><i class="bi bi-geo-alt text-orange"></i></span>
                                        <input type="text" class="form-control form-control-modern border-start-0 ps-0" name="domisili" value="{{ old('domisili', $profile->domisili) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Nomor Telepon / WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0 rounded-start-pill ps-3"><i class="bi bi-telephone"></i></span>
                                        <input type="tel" class="form-control form-control-modern bg-light border-start-0 ps-0 text-muted" value="{{ $profile->no_hp }}" readonly disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. PENDIDIKAN & KARIR --}}
                    <div id="section-pendidikan" class="card border-0 shadow-sm mb-4 form-card">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold text-dark-blue mb-4 pb-2 border-bottom">Pendidikan & Karir</h5>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label class="form-label-custom">Pendidikan Terakhir</label>
                                    <select class="form-select form-select-modern" name="lulusan" required>
                                        @foreach(['SMA/SMK Sederajat', 'D1/D2/D3', 'S1', 'S2', 'S3'] as $edu)
                                            <option value="{{ $edu }}" {{ old('lulusan', $profile->lulusan) == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom">Tahun Lulus</label>
                                    <input type="number" class="form-control form-control-modern" name="tahun_lulus" value="{{ old('tahun_lulus', $profile->tahun_lulus) }}" placeholder="202X" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom">Pengalaman</label>
                                    <select class="form-select form-select-modern" name="pengalaman_kerja">
                                        @foreach(['Fresh Graduate', '< 1 Tahun', '1-3 Tahun', '3-5 Tahun', '> 5 Tahun'] as $exp)
                                            <option value="{{ $exp }}" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == $exp ? 'selected' : '' }}>{{ $exp }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 4. DOKUMEN --}}
                    <div id="section-dokumen" class="card border-0 shadow-sm mb-4 form-card">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold text-dark-blue mb-4 pb-2 border-bottom">Dokumen & Ringkasan</h5>
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label-custom">Tentang Saya (Ringkasan Profesional)</label>
                                    <textarea class="form-control form-control-modern" name="tentang_saya" rows="4" placeholder="Jelaskan keahlian dan pengalaman singkat Anda...">{{ old('tentang_saya', $profile->tentang_saya) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Upload Foto KTP</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-grow-1">
                                            <input type="file" class="form-control form-control-modern" name="foto_ktp" accept="image/*">
                                        </div>
                                        @if ($profile->foto_ktp)
                                            <a href="{{ asset('storage/' . $profile->foto_ktp) }}" target="_blank" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                                <i class="bi bi-eye me-1"></i> Lihat KTP
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 5. KEAHLIAN (SKILLS) --}}
                    <div id="section-keahlian" class="card border-0 shadow-sm mb-5 form-card">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                <h5 class="fw-bold text-dark-blue mb-0">Keahlian (Skills)</h5>
                                <button type="button" class="btn btn-orange-soft btn-sm rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#keahlianModal">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah / Edit
                                </button>
                            </div>
                            
                            <div class="keahlian-container bg-light p-4 rounded-4 text-center border border-dashed-orange">
                                @if($profile->keahlian->count() > 0)
                                    <div class="d-flex flex-wrap justify-content-center gap-2">
                                        @foreach($profile->keahlian as $k)
                                            <span class="badge bg-white text-dark border shadow-sm px-3 py-2 rounded-pill fw-normal">
                                                {{ $k->nama_keahlian }}
                                                <i class="bi bi-check-circle-fill text-success ms-2"></i>
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="py-3">
                                        <i class="bi bi-tools display-4 text-muted opacity-25 mb-2 d-block"></i>
                                        <p class="text-muted small mb-0">Belum ada keahlian ditambahkan.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL SIMPAN FLOATING DI BAWAH --}}
                    <div class="sticky-save-bar d-flex justify-content-end p-3 rounded-pill shadow-lg bg-white border">
                        <button type="button" class="btn btn-light rounded-pill px-4 me-2 fw-bold text-muted" onclick="window.history.back()">Batal</button>
                        <button type="submit" class="btn btn-orange rounded-pill px-5 fw-bold shadow-sm">
                            <i class="bi bi-save2 me-2"></i> Simpan Perubahan
                        </button>
                    </div>

                </div>
            </div>

            {{-- MODAL KEAHLIAN --}}
            <div class="modal fade" id="keahlianModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                        <div class="modal-header bg-dark-blue text-white border-0 py-3">
                            <h5 class="modal-title fw-bold"><i class="bi bi-stars me-2 text-orange"></i> Pilih Keahlian</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 bg-light">
                            <div class="row g-3">
                                @forelse ($bidangKeahlianGrouped as $bidang)
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 shadow-sm rounded-4">
                                            <div class="card-header bg-white border-0 fw-bold text-dark-blue pt-3 pb-0">
                                                {{ $bidang->nama_bidang }}
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($bidang->keahlian as $keahlian)
                                                        <div class="position-relative">
                                                            <input type="checkbox" class="btn-check" name="keahlian[]" 
                                                                   id="k-{{ $keahlian->id }}" value="{{ $keahlian->id }}" 
                                                                   {{ $profile->keahlian->contains($keahlian->id) ? 'checked' : '' }}>
                                                            <label class="btn btn-outline-secondary btn-sm rounded-pill border-0 bg-light text-dark small" 
                                                                   for="k-{{ $keahlian->id }}">{{ $keahlian->nama_keahlian }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p class="text-muted">Tidak ada data keahlian.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-white shadow-top justify-content-center py-3">
                            <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-orange rounded-pill px-5 fw-bold shadow-sm">Simpan Pilihan</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --c-dark-blue: #22374e;
        --c-orange: #F39C12;
        --c-gray-bg: #f8f9fa;
    }
    
    body { background-color: var(--c-gray-bg); }

    /* HERO BANNER */
    .profile-hero-bg {
        background: linear-gradient(135deg, #1a2c3d 0%, #2c3e50 100%);
        height: 280px; width: 100%;
        position: relative; overflow: hidden;
        border-radius: 0 0 50% 50% / 20px; /* Lengkungan halus di bawah */
    }
    .hero-pattern {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 30px 30px; opacity: 0.6;
    }
    
    .profile-content-wrapper { margin-top: -100px; position: relative; z-index: 10; }

    /* SIDEBAR FOTO */
    .sticky-sidebar { position: sticky; top: 20px; }
    .card-profile-sidebar { border-radius: 20px; overflow: hidden; background: white; }
    
    .profile-upload-wrapper {
        width: 140px; height: 140px; position: relative;
        border-radius: 50%; overflow: hidden;
        border: 5px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        cursor: pointer;
    }
    .profile-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .upload-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6); display: flex; flex-direction: column;
        justify-content: center; align-items: center; opacity: 0;
        transition: opacity 0.3s; cursor: pointer;
    }
    .profile-upload-wrapper:hover .upload-overlay { opacity: 1; }
    .profile-upload-wrapper:hover .profile-img { transform: scale(1.1); }

    .bg-gradient-orange { background: linear-gradient(90deg, #F39C12, #ffc107); }

    /* NAVIGASI SIDEBAR */
    .active-nav {
        background-color: #FFF8E1 !important;
        color: var(--c-orange) !important;
        border-left: 4px solid var(--c-orange) !important;
        font-weight: 700;
    }
    .list-group-item { border: none; border-bottom: 1px solid #f1f1f1; transition: all 0.2s; }
    .list-group-item:hover { background-color: #f8f9fa; padding-left: 1.8rem !important; }

    /* FORM STYLES (MODERN) */
    .form-card { border-radius: 20px; overflow: hidden; transition: transform 0.2s; }
    .form-label-custom { font-weight: 600; font-size: 0.85rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
    
    .form-control-modern, .form-select-modern {
        background-color: #f8fafc; border: 2px solid #e2e8f0;
        border-radius: 12px; padding: 12px 16px;
        font-size: 0.95rem; color: #334155; transition: all 0.3s;
    }
    .form-control-modern:focus, .form-select-modern:focus {
        background-color: white; border-color: var(--c-orange);
        box-shadow: 0 0 0 4px rgba(243, 156, 18, 0.1); outline: none;
    }
    .cursor-not-allowed { cursor: not-allowed !important; opacity: 0.7; }

    /* KEAHLIAN STYLE */
    .btn-check:checked + .btn-outline-secondary {
        background-color: var(--c-orange); color: white; border-color: var(--c-orange);
        box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3);
    }
    .border-dashed-orange { border: 2px dashed #fcd34d; background: #fffbeb; }
    .btn-orange-soft { background: #fff7ed; color: var(--c-orange); border: 1px solid #ffedd5; }
    .btn-orange-soft:hover { background: var(--c-orange); color: white; }

    /* STICKY SAVE BAR */
    .sticky-save-bar {
        position: sticky; bottom: 20px; z-index: 99;
        background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .btn-orange { background-color: var(--c-orange); border: none; color: white; transition: 0.3s; }
    .btn-orange:hover { background-color: #e67e22; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3); }

    /* RESPONSIVE */
    @media (max-width: 991.98px) {
        .profile-hero-bg { height: 220px; margin-bottom: 2rem; }
        .profile-content-wrapper { margin-top: -60px; }
        .sticky-sidebar { position: static; }
        .sticky-save-bar { bottom: 10px; flex-direction: column-reverse; gap: 10px; }
        .sticky-save-bar button { width: 100%; }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Preview Image Realtime
        const imgInput = document.getElementById('foto_profil_input');
        const imgPreview = document.getElementById('profileImagePreview');
        if(imgInput && imgPreview) {
            imgInput.addEventListener('change', function(e) {
                if(e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) { imgPreview.src = e.target.result; }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }

        // 2. Smooth Scroll Navigasi (Desktop)
        document.querySelectorAll('.list-group-item-action').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                // Hapus active class semua
                document.querySelectorAll('.list-group-item-action').forEach(el => el.classList.remove('active-nav'));
                // Tambah ke yg diklik
                this.classList.add('active-nav');

                const targetId = this.getAttribute('href');
                const targetEl = document.querySelector(targetId);
                if(targetEl) {
                    // Scroll dengan offset header
                    const offset = 100; 
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elementRect = targetEl.getBoundingClientRect().top;
                    const elementPosition = elementRect - bodyRect;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({ top: offsetPosition, behavior: "smooth" });
                }
            });
        });
    });
</script>
@endpush