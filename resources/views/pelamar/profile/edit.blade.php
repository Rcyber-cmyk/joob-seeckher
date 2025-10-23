{{-- /resources/views/pelamar/profile/edit.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Edit Profil Saya')

@section('content')
<div class="profile-edit-page">
    <div class="container py-4">
        <form action="{{ route('pelamar.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="page-header mb-4">
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
                <div class="col-lg-4">
                    <div class="profile-sidebar">
                        <div class="profile-picture-card text-center">
                            <div class="profile-picture-wrapper mx-auto">
                                <img id="profileImagePreview" src="{{ $profile->foto_profil ? asset('storage/' . $profile->foto_profil) : 'https://placehold.co/150x150/EFEFEF/AAAAAA&text=Foto' }}" alt="Foto Profil">
                                <label for="foto_profil_input" class="profile-picture-edit-button">
                                    <i class="bi bi-camera-fill"></i>
                                </label>
                                <input type="file" name="foto_profil" id="foto_profil_input" class="d-none" accept="image/*">
                            </div>
                            <h5 class="mb-1 mt-3">{{ $profile->nama_lengkap }}</h5>
                            <p class="text-muted small">{{ $user->email }}</p>
                            
                            <div class="progress-wrapper mt-3 px-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>Kelengkapan Profil</span>
                                    <span class="fw-bold">{{ $profile->kelengkapan_profil }}%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $profile->kelengkapan_profil }}%;" aria-valuenow="{{ $profile->kelengkapan_profil }}" aria-valuemin="0" aria-valuemax="100"></div>
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

                <div class="col-lg-8">
                    <div class="main-form-card">
                        <div class="form-section" id="pribadi">
                            <h5 class="form-section-title">Informasi Pribadi</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_depan" class="form-label">Nama Depan</label>
                                    <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" id="nama_depan" name="nama_depan" value="{{ old('nama_depan', explode(' ', $profile->nama_lengkap)[0]) }}" required>
                                    @error('nama_depan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                    <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang', explode(' ', $profile->nama_lengkap, 2)[1] ?? '') }}">
                                    @error('nama_belakang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                        <input type="text" class="form-control" id="nik" value="{{ $profile->nik }}" disabled readonly>
                                    </div>
                                    <div class="form-text">NIK tidak dapat diubah.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $profile->tanggal_lahir) }}" required>
                                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                        <option value="Laki-laki" {{ old('gender', $profile->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender', $profile->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label">Nomor Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="tel" class="form-control" id="no_hp" value="{{ $profile->no_hp }}" disabled readonly>
                                    </div>
                                    <div class="form-text">Nomor Telepon tidak dapat diubah.</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section" id="alamat">
                            <h5 class="form-section-title">Alamat & Domisili</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat (Sesuai KTP)</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $profile->alamat) }}</textarea>
                                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label for="domisili" class="form-label">Domisili Saat Ini</label>
                                    <input type="text" class="form-control @error('domisili') is-invalid @enderror" id="domisili" name="domisili" value="{{ old('domisili', $profile->domisili) }}" required>
                                    @error('domisili')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-section" id="pendidikan">
                            <h5 class="form-section-title">Pendidikan & Profesional</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="lulusan" class="form-label">Pendidikan Terakhir</label>
                                    <select class="form-select @error('lulusan') is-invalid @enderror" id="lulusan" name="lulusan" required>
                                        <option value="SMA/SMK Sederajat" {{ old('lulusan', $profile->lulusan) == 'SMA/SMK Sederajat' ? 'selected' : '' }}>SMA/SMK Sederajat</option>
                                        <option value="D1/D2/D3" {{ old('lulusan', $profile->lulusan) == 'D1/D2/D3' ? 'selected' : '' }}>D1/D2/D3</option>
                                        <option value="S1" {{ old('lulusan', $profile->lulusan) == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('lulusan', $profile->lulusan) == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('lulusan', $profile->lulusan) == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                    @error('lulusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                    <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus', $profile->tahun_lulus) }}" placeholder="Contoh: 2022" required>
                                    @error('tahun_lulus')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label for="pengalaman_kerja" class="form-label">Pengalaman Kerja</label>
                                    <select class="form-select @error('pengalaman_kerja') is-invalid @enderror" id="pengalaman_kerja" name="pengalaman_kerja">
                                        <option value="Fresh Graduate" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == 'Fresh Graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                                        <option value="< 1 Tahun" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == '< 1 Tahun' ? 'selected' : '' }}>< 1 Tahun</option>
                                        <option value="1-3 Tahun" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == '1-3 Tahun' ? 'selected' : '' }}>1-3 Tahun</option>
                                        <option value="3-5 Tahun" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == '3-5 Tahun' ? 'selected' : '' }}>3-5 Tahun</option>
                                        <option value="> 5 Tahun" {{ old('pengalaman_kerja', $profile->pengalaman_kerja) == '> 5 Tahun' ? 'selected' : '' }}>> 5 Tahun</option>
                                    </select>
                                    @error('pengalaman_kerja')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section" id="dokumen">
                            <h5 class="form-section-title">Ringkasan & Dokumen</h5>
                            <div class="row g-3">
                                 <div class="col-12">
                                    <label for="tentang_saya" class="form-label">Ringkasan Pribadi</label>
                                    <textarea class="form-control @error('tentang_saya') is-invalid @enderror" name="tentang_saya" rows="4">{{ old('tentang_saya', $profile->tentang_saya) }}</textarea>
                                    @error('tentang_saya')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="foto_ktp" class="form-label">Foto KTP</label>
                                    <input type="file" class="form-control @error('foto_ktp') is-invalid @enderror" name="foto_ktp" accept="image/*">
                                    @error('foto_ktp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    @if ($profile->foto_ktp)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $profile->foto_ktp) }}" target="_blank" class="text-decoration-none small">
                                                <i class="bi bi-paperclip"></i> Lihat KTP saat ini
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-section" id="keahlian">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="form-section-title mb-0">Keahlian</h5>
                                <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#keahlianModal">
                                    <i class="bi bi-plus-lg"></i> Tambah
                                </button>
                            </div>
                            <div class="keahlian-tags mt-3">
                                @forelse($profile->keahlian as $k)
                                    <span class="badge skill-tag">{{ $k->nama_keahlian }}</span>
                                @empty
                                    <p class="text-muted small">Belum ada keahlian yang ditambahkan.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="text-end mt-4">
                             <button type="submit" class="btn btn-orange btn-lg px-4">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL KEAHLIAN --}}
            <div class="modal fade" id="keahlianModal" tabindex="-1" aria-labelledby="keahlianModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="keahlianModalLabel">Pilih Keahlian Anda</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                @forelse ($bidangKeahlianGrouped as $bidang)
                                    <div class="col-md-6">
                                        <h6 class="fw-bold">{{ $bidang->nama_bidang }}</h6>
                                        @foreach ($bidang->keahlian as $keahlian)
                                            <div class="form-check form-check-inline-block">
                                                <input class="form-check-input" type="checkbox" name="keahlian[]" id="keahlian-{{ $keahlian->id }}" value="{{ $keahlian->id }}" 
                                                {{ $profile->keahlian->contains($keahlian->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="keahlian-{{ $keahlian->id }}">{{ $keahlian->nama_keahlian }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted">Tidak ada keahlian yang tersedia.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-orange">Simpan</button>
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
    body { background-color: #f8f9fa; }
    .page-header .page-title { font-weight: 700; }
    .page-header .page-subtitle { color: #6c757d; }

    .profile-sidebar {
        position: sticky;
        top: 20px;
        background-color: #fff;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }
    .profile-picture-card {
        padding: 1.5rem;
    }
    .profile-picture-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        background-color: #e9ecef;
    }
    .profile-picture-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-picture-edit-button {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 32px;
        height: 32px;
        background-color: rgba(0,0,0,0.6);
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
        border: 2px solid white;
    }
    .profile-picture-edit-button:hover { background-color: rgba(0,0,0,0.8); }
    
    .profile-nav-wrapper {
        padding: 0.75rem;
    }
    .profile-nav .list-group-item { 
        border: none; 
        padding: 0; 
        margin-bottom: 0.25rem;
    }
    .profile-nav .list-group-item a {
        display: block; 
        padding: 0.75rem 1.25rem; 
        text-decoration: none;
        color: #495057; 
        font-weight: 500;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }
    .profile-nav .list-group-item a:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }
    .profile-nav .list-group-item a.active {
        background-color: #0d6efd;
        color: #fff;
        font-weight: 600;
    }
    .profile-nav .list-group-item i { 
        margin-right: 0.75rem; 
        font-size: 1.1rem;
        vertical-align: middle;
    }

    .main-form-card {
        background-color: #fff; border-radius: 0.75rem; padding: 2rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }
    .form-section {
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e9ecef;
    }
    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .form-section-title {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 1rem;
    }
    .input-group-text { background-color: #e9ecef; }
    .keahlian-tags { display: flex; flex-wrap: wrap; gap: 0.75rem; }
    .skill-tag {
        background-color: #e9ecef; color: #495057; padding: 0.5em 1em;
        font-size: 0.9rem; border-radius: 20px; font-weight: 500;
    }
    .modal .form-check-inline-block {
        display: inline-flex; align-items: center; padding: .5rem;
        border-radius: .5rem; transition: background-color .2s;
    }
    .modal .form-check-inline-block:hover { background-color: #f8f9fa; }
    .btn-orange {
        background-color: #F39C12; border-color: #F39C12; color: #fff;
    }
    .btn-orange:hover, .btn-orange:focus {
        background-color: #d8890b; border-color: #d8890b; color: #fff;
    }
    .progress-bar {
        background-color: #0d6efd;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('foto_profil_input');
        const imagePreview = document.getElementById('profileImagePreview');
        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function(event) {
                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        }
        const sections = document.querySelectorAll('.form-section');
        const navLinks = document.querySelectorAll('.profile-nav a');
        const observerOptions = { root: null, rootMargin: '-50px 0px -50% 0px', threshold: 0 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const id = entry.target.getAttribute('id');
                const navLink = document.querySelector(`.profile-nav a[href="#${id}"]`);
                if (entry.isIntersecting) {
                    navLinks.forEach(link => link.classList.remove('active'));
                    if (navLink) {
                        navLink.classList.add('active');
                    }
                }
            });
        }, observerOptions);
        sections.forEach(section => observer.observe(section));
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const offsetTop = targetElement.offsetTop - 20;
                    window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                }
            });
        });
    });
</script>
@endpush