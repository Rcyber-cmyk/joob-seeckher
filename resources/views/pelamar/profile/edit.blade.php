{{-- /resources/views/pelamar/profile/edit.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Edit Profil Saya')

@section('content')
{{-- HAPUS FOOTER --}}
<style>footer.footer { display: none !important; }</style>

<div class="profile-edit-page">
    <div class="container py-4 mb-5"> {{-- Tambah margin bottom biar tidak mepet bawah --}}
        <form action="{{ route('pelamar.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Hapus @method('PUT') karena kita pakai POST untuk upload file --}}

            <div class="page-header mb-4 text-center text-lg-start">
                <h1 class="page-title">Pengaturan Profil</h1>
                <p class="page-subtitle">Perbarui informasi Anda agar profil lebih menarik bagi perusahaan.</p>
            </div>
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terdapat kesalahan pada input Anda.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                {{-- SIDEBAR (FOTO & NAVIGASI) --}}
                <div class="col-lg-4">
                    <div class="profile-sidebar sticky-lg-top" style="top: 20px; z-index: 10;">
                        <div class="profile-picture-card text-center border-bottom pb-3">
                            <div class="profile-picture-wrapper mx-auto shadow-sm">
                                <img id="profileImagePreview" src="{{ $profile->foto_profil ? asset('storage/' . $profile->foto_profil) : 'https://placehold.co/150x150/EFEFEF/AAAAAA&text=Foto' }}" alt="Foto Profil">
                                <label for="foto_profil_input" class="profile-picture-edit-button" title="Ganti Foto">
                                    <i class="bi bi-camera-fill"></i>
                                </label>
                                <input type="file" name="foto_profil" id="foto_profil_input" class="d-none" accept="image/*">
                            </div>
                            <h5 class="mb-1 mt-3 fw-bold">{{ $profile->nama_lengkap }}</h5>
                            <p class="text-muted small mb-3">{{ $user->email }}</p>
                            
                            <div class="progress-wrapper px-3">
                                <div class="d-flex justify-content-between small mb-1 text-muted">
                                    <span>Kelengkapan Profil</span>
                                    <span class="fw-bold text-orange">{{ $profile->kelengkapan_profil ?? 0 }}%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-orange" role="progressbar" style="width: {{ $profile->kelengkapan_profil ?? 0 }}%;" aria-valuenow="{{ $profile->kelengkapan_profil ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="profile-nav-wrapper">
                            <ul class="list-group list-group-flush profile-nav">
                                <li class="list-group-item"><a href="#pribadi" class="active"><i class="bi bi-person-badge"></i> Informasi Pribadi</a></li>
                                <li class="list-group-item"><a href="#alamat"><i class="bi bi-geo-alt"></i> Alamat & Domisili</a></li>
                                <li class="list-group-item"><a href="#pendidikan"><i class="bi bi-mortarboard"></i> Pendidikan & Profesional</a></li>
                                <li class="list-group-item"><a href="#dokumen"><i class="bi bi-file-earmark-text"></i> Ringkasan & Dokumen</a></li>
                                <li class="list-group-item"><a href="#keahlian"><i class="bi bi-tools"></i> Keahlian</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- FORM UTAMA --}}
                <div class="col-lg-8">
                    <div class="main-form-card">
                        {{-- Bagian 1: Pribadi --}}
                        <div class="form-section" id="pribadi">
                            <h5 class="form-section-title text-orange">Informasi Pribadi</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_depan" class="form-label fw-medium">Nama Depan</label>
                                    <input type="text" class="form-control bg-light border-0" id="nama_depan" name="nama_depan" value="{{ old('nama_depan', explode(' ', $profile->nama_lengkap)[0]) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama_belakang" class="form-label fw-medium">Nama Belakang</label>
                                    <input type="text" class="form-control bg-light border-0" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang', explode(' ', $profile->nama_lengkap, 2)[1] ?? '') }}">
                                </div>
                                <div class="col-12">
                                    <label for="nik" class="form-label fw-medium">Nomor Induk Kependudukan (NIK)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-person-vcard text-muted"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0 ps-0" id="nik" value="{{ $profile->nik }}" disabled readonly>
                                    </div>
                                    <div class="form-text small">NIK tidak dapat diubah.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label fw-medium">Tanggal Lahir</label>
                                    <input type="date" class="form-control bg-light border-0" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $profile->tanggal_lahir) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label fw-medium">Jenis Kelamin</label>
                                    <select class="form-select bg-light border-0" id="gender" name="gender" required>
                                        <option value="Laki-laki" {{ old('gender', $profile->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender', $profile->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label fw-medium">Nomor Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                                        <input type="tel" class="form-control bg-light border-start-0 ps-0" id="no_hp" value="{{ $profile->no_hp }}" disabled readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bagian 2: Alamat --}}
                        <div class="form-section" id="alamat">
                            <h5 class="form-section-title text-orange">Alamat & Domisili</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="alamat" class="form-label fw-medium">Alamat (Sesuai KTP)</label>
                                    <textarea class="form-control bg-light border-0" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $profile->alamat) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="domisili" class="form-label fw-medium">Domisili Saat Ini</label>
                                    <input type="text" class="form-control bg-light border-0" id="domisili" name="domisili" value="{{ old('domisili', $profile->domisili) }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- Bagian 3: Pendidikan --}}
                        <div class="form-section" id="pendidikan">
                            <h5 class="form-section-title text-orange">Pendidikan & Profesional</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="lulusan" class="form-label fw-medium">Pendidikan Terakhir</label>
                                    <select class="form-select bg-light border-0" id="lulusan" name="lulusan" required>
                                        <option value="SMA/SMK Sederajat" {{ old('lulusan', $profile->lulusan) == 'SMA/SMK Sederajat' ? 'selected' : '' }}>SMA/SMK Sederajat</option>
                                        <option value="D1/D2/D3" {{ in_array(old('lulusan', $profile->lulusan), ['D1','D2','D3']) ? 'selected' : '' }}>D1/D2/D3</option>
                                        <option value="S1" {{ old('lulusan', $profile->lulusan) == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('lulusan', $profile->lulusan) == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('lulusan', $profile->lulusan) == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tahun_lulus" class="form-label fw-medium">Tahun Lulus</label>
                                    <input type="number" class="form-control bg-light border-0" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus', $profile->tahun_lulus) }}" placeholder="Contoh: 2022" required>
                                </div>
                                <div class="col-12">
                                    <label for="pengalaman_kerja" class="form-label fw-medium">Pengalaman Kerja</label>
                                    <select class="form-select bg-light border-0" id="pengalaman_kerja" name="pengalaman_kerja">
                                        <option value="Fresh Graduate" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == 'Fresh Graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                                        <option value="< 1 Tahun" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == '< 1 Tahun' ? 'selected' : '' }}>< 1 Tahun</option>
                                        <option value="1-3 Tahun" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == '1-3 Tahun' ? 'selected' : '' }}>1-3 Tahun</option>
                                        <option value="3-5 Tahun" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == '3-5 Tahun' ? 'selected' : '' }}>3-5 Tahun</option>
                                        <option value="> 5 Tahun" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == '> 5 Tahun' ? 'selected' : '' }}>> 5 Tahun</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Bagian 4: Dokumen --}}
                        <div class="form-section" id="dokumen">
                            <h5 class="form-section-title text-orange">Ringkasan & Dokumen</h5>
                            <div class="row g-3">
                                 <div class="col-12">
                                    <label for="tentang_saya" class="form-label fw-medium">Ringkasan Pribadi</label>
                                    <textarea class="form-control bg-light border-0" name="tentang_saya" rows="4" placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('tentang_saya', $profile->tentang_saya) }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="foto_ktp" class="form-label fw-medium">Foto KTP</label>
                                    <input type="file" class="form-control" name="foto_ktp" accept="image/*">
                                    @if ($profile->foto_ktp)
                                        <div class="mt-2 p-2 bg-light rounded border d-flex align-items-center">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            <span class="small text-muted">KTP sudah diunggah.</span>
                                            <a href="{{ asset('storage/' . $profile->foto_ktp) }}" target="_blank" class="ms-auto btn btn-sm btn-link text-decoration-none p-0">Lihat</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Bagian 5: Keahlian --}}
                        <div class="form-section border-bottom-0" id="keahlian">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="form-section-title text-orange mb-0">Keahlian</h5>
                                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#keahlianModal">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah Keahlian
                                </button>
                            </div>
                            <div class="keahlian-tags bg-light p-3 rounded-3 border border-dashed text-center">
                                @forelse($profile->keahlian as $k)
                                    <span class="badge skill-tag shadow-sm">{{ $k->nama_keahlian }}</span>
                                @empty
                                    <p class="text-muted small mb-0 py-2">Belum ada keahlian. Klik tombol tambah di atas.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="text-end mt-5 pt-4 border-top">
                             <button type="submit" class="btn btn-orange btn-lg px-5 rounded-pill shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL KEAHLIAN --}}
            <div class="modal fade" id="keahlianModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title fw-bold" id="keahlianModalLabel">Pilih Keahlian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pt-0">
                            <div class="row g-4">
                                @forelse ($bidangKeahlianGrouped as $bidang)
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded-3 h-100">
                                            <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">{{ $bidang->nama_bidang }}</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($bidang->keahlian as $keahlian)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="keahlian[]" id="keahlian-{{ $keahlian->id }}" value="{{ $keahlian->id }}" 
                                                        {{ $profile->keahlian->contains($keahlian->id) ? 'checked' : '' }}>
                                                        <label class="form-check-label small" for="keahlian-{{ $keahlian->id }}">{{ $keahlian->nama_keahlian }}</label>
                                                    </div>
                                                @endforeach
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
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-orange rounded-pill px-4">Simpan Pilihan</button>
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
    /* === General Profile Style === */
    body { background-color: #f8f9fa; }
    .text-orange { color: #F39C12 !important; }
    .bg-orange { background-color: #F39C12 !important; }
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: #fff; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; color: #fff; }

    /* Sidebar Desktop */
    .profile-sidebar {
        background-color: #fff;
        border-radius: 1rem;
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .profile-picture-card { padding: 2rem 1.5rem; }
    .profile-picture-wrapper {
        position: relative; width: 140px; height: 140px;
        border-radius: 50%; overflow: hidden;
        background-color: #f1f1f1; border: 4px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .profile-picture-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    .profile-picture-edit-button {
        position: absolute; bottom: 0; width: 100%; height: 40px;
        background: rgba(0,0,0,0.5); color: white;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: background 0.2s; opacity: 0;
    }
    .profile-picture-wrapper:hover .profile-picture-edit-button { opacity: 1; }
    
    .profile-nav-wrapper { padding: 1rem; background-color: #fff; }
    .profile-nav .list-group-item { border: none; padding: 0; margin-bottom: 5px; }
    .profile-nav .list-group-item a {
        display: block; padding: 0.8rem 1.2rem;
        text-decoration: none; color: #6c757d; font-weight: 500;
        border-radius: 0.5rem; transition: all 0.2s;
    }
    .profile-nav .list-group-item a:hover, .profile-nav .list-group-item a.active {
        background-color: #FFF8E1; color: #F39C12; font-weight: 600;
    }
    .profile-nav .list-group-item a.active i { color: #F39C12; }

    /* Main Form */
    .main-form-card {
        background-color: #fff; border-radius: 1rem; padding: 2.5rem;
        border: 1px solid #e9ecef; box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .form-section-title { margin-bottom: 1.5rem; padding-bottom: 0.5rem; border-bottom: 2px solid #f1f1f1; display: inline-block; }
    .skill-tag {
        background-color: #fff; border: 1px solid #e9ecef; color: #495057;
        padding: 0.6em 1.2em; font-size: 0.9rem; border-radius: 50px;
        font-weight: 500; transition: all 0.2s;
    }
    .skill-tag:hover { border-color: #F39C12; color: #F39C12; }

    /* === RESPONSIVE MOBILE === */
    @media (max-width: 991.98px) {
        /* Sidebar berubah jadi header profile di atas */
        .profile-sidebar {
            position: static; /* Reset sticky */
            margin-bottom: 1.5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
        }
        .profile-picture-card { padding: 1.5rem; border-bottom: none; }
        
        /* Menu navigasi jadi horizontal scroll */
        .profile-nav-wrapper {
            padding: 0.5rem 1rem 1rem;
            border-top: 1px solid #eee;
            overflow-x: auto; /* Scroll samping */
            white-space: nowrap;
            -webkit-overflow-scrolling: touch; /* Smooth scroll iOS */
        }
        .profile-nav {
            flex-direction: row; /* Ubah jadi baris */
            display: flex;
            padding-bottom: 5px;
        }
        .profile-nav .list-group-item {
            margin-right: 10px;
            width: auto;
        }
        .profile-nav .list-group-item a {
            background-color: #f8f9fa;
            border: 1px solid #eee;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
        /* Hide scrollbar tapi tetap bisa scroll */
        .profile-nav-wrapper::-webkit-scrollbar { height: 4px; }
        .profile-nav-wrapper::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
        
        .main-form-card { padding: 1.5rem; }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview Image
        const imageInput = document.getElementById('foto_profil_input');
        const imagePreview = document.getElementById('profileImagePreview');
        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function(event) {
                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) { imagePreview.src = e.target.result; }
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        }

        // Scrollspy Sederhana
        const navLinks = document.querySelectorAll('.profile-nav a');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    // Update active state
                    navLinks.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');

                    // Scroll to element
                    const offsetTop = targetElement.offsetTop - 100; // Offset untuk header
                    window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                }
            });
        });
    });
</script>
@endpush