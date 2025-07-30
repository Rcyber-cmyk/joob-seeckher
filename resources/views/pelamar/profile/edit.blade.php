{{-- /resources/views/pelamar/profile/edit.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Edit Profil Saya')

@section('content')
<div class="profile-edit-page">
    <div class="container py-4">
        <form action="{{ route('pelamar.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Header Halaman --}}
            <div class="page-header mb-4">
                <h1 class="page-title">Pengaturan Profil</h1>
                <p class="page-subtitle">Perbarui informasi Anda agar profil lebih menarik bagi perusahaan.</p>
            </div>
            
            {{-- Notifikasi & Error Alerts --}}
            <div id="alert-container">
                @if (session('success') || session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') ?? session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terdapat kesalahan pada input Anda.</strong> Silakan periksa kembali form di bawah.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="row g-4">
                <!-- ========================== -->
                <!-- KOLOM KIRI (NAVIGASI)      -->
                <!-- ========================== -->
                <div class="col-lg-3">
                    <div class="profile-nav-card">
                        <div class="profile-nav-header text-center">
                            <h5 class="mb-1">{{ $user->name }}</h5> 
                            <p class="text-muted small">{{ $user->email }}</p>
                            <div class="progress-wrapper mt-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>Kelengkapan Profil</span>
                                    <span class="fw-bold">{{ $profile->kelengkapan_profil }}%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $profile->kelengkapan_profil }}%" aria-valuenow="{{ $profile->kelengkapan_profil }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush profile-nav">
                            <li class="list-group-item"><a href="#pribadi"><i class="bi bi-person-badge"></i> Informasi Pribadi</a></li>
                            <li class="list-group-item"><a href="#alamat"><i class="bi bi-geo-alt"></i> Alamat & Domisili</a></li>
                            <li class="list-group-item"><a href="#pendidikan"><i class="bi bi-mortarboard"></i> Pendidikan & Profesional</a></li>
                            <li class="list-group-item"><a href="#dokumen"><i class="bi bi-file-earmark-text"></i> Ringkasan & Dokumen</a></li>
                            <li class="list-group-item"><a href="#keahlian"><i class="bi bi-tools"></i> Keahlian</a></li>
                        </ul>
                    </div>
                </div>

                <!-- ========================== -->
                <!-- KOLOM KANAN (FORM)         -->
                <!-- ========================== -->
                <div class="col-lg-9">
                    <!-- Kartu Informasi Pribadi -->
                    <div class="form-card" id="pribadi">
                        <h5 class="card-title">Informasi Pribadi</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama_depan" class="form-label">Nama Depan</label>
                                <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" id="nama_depan" name="nama_depan" value="{{ old('nama_depan', explode(' ', $user->name)[0]) }}" required>
                                @error('nama_depan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang', explode(' ', $user->name, 2)[1] ?? '') }}">
                                @error('nama_belakang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $profile->nik) }}">
                                </div>
                                @error('nik') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $profile->tanggal_lahir) }}" required>
                                @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="Laki-laki" {{ old('gender', $profile->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender', $profile->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">Nomor Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $profile->no_hp) }}" required>
                                </div>
                                @error('no_hp') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                             <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                                @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Alamat & Domisili -->
                    <div class="form-card" id="alamat">
                        <h5 class="card-title">Alamat & Domisili</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="alamat" class="form-label">Alamat (Sesuai KTP)</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $profile->alamat) }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="domisili" class="form-label">Domisili Saat Ini</label>
                                <input type="text" class="form-control @error('domisili') is-invalid @enderror" id="domisili" name="domisili" value="{{ old('domisili', $profile->domisili) }}" required>
                                <div class="form-text">Contoh: Jakarta Selatan, DKI Jakarta</div>
                                @error('domisili') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Pendidikan & Profesional -->
                    <div class="form-card" id="pendidikan">
                        <h5 class="card-title">Pendidikan & Profesional</h5>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="lulusan" class="form-label">Pendidikan Terakhir</label>
                                <select class="form-select @error('lulusan') is-invalid @enderror" id="lulusan" name="lulusan" required>
                                    <option value="SMP/Sederajat" {{ old('lulusan', $profile->lulusan) == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                                    <option value="SMA/SMK Sederajat" {{ old('lulusan', $profile->lulusan) == 'SMA/SMK Sederajat' ? 'selected' : '' }}>SMA/SMK Sederajat</option>
                                    <option value="D1" {{ old('lulusan', $profile->lulusan) == 'D1' ? 'selected' : '' }}>D1</option>
                                    <option value="D2" {{ old('lulusan', $profile->lulusan) == 'D2' ? 'selected' : '' }}>D2</option>
                                    <option value="D3" {{ old('lulusan', $profile->lulusan) == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('lulusan', $profile->lulusan) == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('lulusan', $profile->lulusan) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('lulusan', $profile->lulusan) == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                                @error('lulusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus', $profile->tahun_lulus) }}" placeholder="Contoh: 2022" required>
                                @error('tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                @error('pengalaman_kerja') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kartu Ringkasan & Dokumen -->
                    <div class="form-card" id="dokumen">
                        <h5 class="card-title">Ringkasan & Dokumen</h5>
                        <hr>
                        <div class="row g-3">
                             <div class="col-12">
                                <label for="tentang_saya" class="form-label">Ringkasan Pribadi</label>
                                <p class="form-text mt-0 mb-2">Tuliskan ringkasan singkat (2-3 kalimat) yang menonjolkan kekuatan Anda.</p>
                                <textarea class="form-control @error('tentang_saya') is-invalid @enderror" name="tentang_saya" rows="4">{{ old('tentang_saya', $profile->tentang_saya) }}</textarea>
                                @error('tentang_saya') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="file_cv" class="form-label">Curriculum Vitae (CV)</label>
                                <input type="file" class="form-control @error('file_cv') is-invalid @enderror" name="file_cv" accept=".pdf">
                                @if ($profile->file_cv)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $profile->file_cv) }}" target="_blank" class="text-decoration-none small">
                                            <i class="bi bi-paperclip"></i> Lihat CV saat ini
                                        </a>
                                    </div>
                                @endif
                                <div class="form-text">Unggah CV terbaru Anda (format PDF, maks 2MB).</div>
                                @error('file_cv') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Keahlian -->
                    <div class="form-card" id="keahlian">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Keahlian</h5>
                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#keahlianModal">
                                <i class="bi bi-plus-lg"></i> Tambah Keahlian
                            </button>
                        </div>
                        <hr>
                        <div class="keahlian-tags">
                            @forelse($profile->keahlian as $k)
                                <span class="badge bg-light text-dark skill-tag">{{ $k->nama_keahlian }}</span>
                            @empty
                                <p class="text-muted small" id="keahlian-placeholder">Belum ada keahlian yang ditambahkan. Klik 'Tambah Keahlian' untuk memulai.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="text-end mt-2">
                         <button type="submit" class="btn btn-orange btn-lg px-4">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal untuk memilih keahlian -->
            <div class="modal fade" id="keahlianModal" tabindex="-1" aria-labelledby="keahlianModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="keahlianModalLabel">Pilih Keahlian Anda</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="accordion" id="accordionKeahlian">
                                @forelse ($bidangKeahlianGrouped as $bidang)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $loop->iteration }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse-{{ $loop->iteration }}">
                                            {{ $bidang->nama_bidang }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $loop->iteration }}" data-bs-parent="#accordionKeahlian">
                                        <div class="accordion-body">
                                            <div class="row">
                                                @forelse ($bidang->keahlian as $k)
                                                <div class="col-sm-6">
                                                    <div class="form-check form-check-inline-block">
                                                        <input class="form-check-input" type="checkbox" name="keahlian[]" value="{{ $k->id }}" id="keahlian{{ $k->id }}"
                                                            @if(in_array($k->id, old('keahlian', $profile->keahlian->pluck('id')->toArray()))) checked @endif
                                                        >
                                                        <label class="form-check-label" for="keahlian{{ $k->id }}">
                                                            {{ $k->nama_keahlian }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @empty
                                                <p class="text-muted small">Belum ada keahlian di bidang ini.</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p class="text-muted">Data bidang keahlian belum tersedia.</p>
                                @endforelse
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-orange" id="selesaiPilihKeahlian" data-bs-dismiss="modal">Pilih</button>
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
    body {
        background-color: #f8f9fa;
    }
    .profile-edit-page .page-header .page-title {
        font-weight: 700;
    }
    .profile-edit-page .page-header .page-subtitle {
        color: #6c757d;
    }
    .profile-nav-card {
        position: sticky;
        top: 20px;
        background-color: #fff;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }
    .profile-nav-header {
        padding: 1.5rem;
        border-bottom: 1px solid #dee2e6;
    }
    .profile-nav .list-group-item {
        border: none;
        padding: 0;
    }
    .profile-nav .list-group-item a {
        display: block;
        padding: 0.9rem 1.5rem;
        text-decoration: none;
        color: #495057;
        font-weight: 500;
        border-left: 3px solid transparent;
        transition: all 0.2s ease-in-out;
    }
    .profile-nav .list-group-item a:hover {
        background-color: #e9ecef;
        color: #243550ff;
    }
    .profile-nav .list-group-item a.active {
        background-color: #e9ecef;
        color: #243550ff;
        border-left-color: #243550ff;
    }
    .profile-nav .list-group-item i {
        margin-right: 0.75rem;
        width: 20px;
        text-align: center;
    }
    .form-card {
        background-color: #fff;
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #dee2e6;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }
    .form-card .card-title {
        font-weight: 600;
        color: #343a40;
    }
    .input-group-text {
        background-color: #e9ecef;
    }
    .keahlian-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    .skill-tag {
        padding: 0.5em 1em;
        font-size: 0.9rem;
        border-radius: 20px;
        font-weight: 500;
        border: 1px solid #dee2e6;
    }
    .modal .form-check-inline-block {
        display: block;
        width: 100%;
        padding: .5rem .75rem;
        border-radius: .5rem;
        transition: background-color .2s;
        cursor: pointer;
    }
    .modal .form-check-inline-block:hover {
        background-color: #f8f9fa;
    }
    .btn-orange {
        background-color: #F39C12;
        border-color: #F39C12;
        color: #fff;
    }
    .btn-orange:hover, .btn-orange:focus {
        background-color: #d8890b;
        border-color: #d8890b;
        color: #fff;
    }
    .invalid-feedback {
        font-size: 0.875em;
    }
    #keahlianModal .accordion-button {
        padding: 0.85rem 1.25rem;
        font-size: 1rem;
        font-weight: 500;
    }
    #keahlianModal .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #212529;
    }
    #keahlianModal .accordion-body {
        padding: 1rem 1.25rem;
    }
    #keahlianModal .form-check-input {
        margin-top: 0.2em;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script untuk navigasi scroll-spy
        const sections = document.querySelectorAll('.form-card');
        const navLinks = document.querySelectorAll('.profile-nav a');
        const observerOptions = { root: null, rootMargin: '0px', threshold: 0.4 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const id = entry.target.getAttribute('id');
                const navLink = document.querySelector(`.profile-nav a[href="#${id}"]`);
                if (entry.isIntersecting) {
                    navLinks.forEach(link => link.classList.remove('active'));
                    if (navLink) navLink.classList.add('active');
                }
            });
        }, observerOptions);
        sections.forEach(section => observer.observe(section));
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetElement = document.querySelector(this.getAttribute('href'));
                if (targetElement) {
                    const offsetTop = targetElement.offsetTop - 20;
                    window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                }
            });
        });

        // SCRIPT UNTUK UPDATE UI KEAHLIAN SECARA VISUAL
        const tombolPilih = document.getElementById('selesaiPilihKeahlian');
        const wadahTagKeahlian = document.querySelector('.keahlian-tags');
        const modalElement = document.getElementById('keahlianModal');

        tombolPilih.addEventListener('click', function() {
            // Pesan debug untuk memastikan event listener berjalan
            console.log('Tombol "Pilih" diklik!');

            // 1. Kosongkan daftar badge keahlian yang ada di halaman utama
            wadahTagKeahlian.innerHTML = ''; 
            
            // 2. Ambil semua checkbox yang sedang tercentang di dalam modal
            const checkboxKeahlian = modalElement.querySelectorAll('input[type="checkbox"]:checked');
            console.log(`Ditemukan ${checkboxKeahlian.length} keahlian yang dipilih.`);

            // 3. Jika ada keahlian yang dipilih
            if (checkboxKeahlian.length > 0) {
                // Lakukan perulangan untuk setiap keahlian yang dipilih
                checkboxKeahlian.forEach(checkbox => {
                    const namaKeahlian = checkbox.nextElementSibling.textContent.trim();
                    const badgeBaru = document.createElement('span');
                    badgeBaru.className = 'badge bg-light text-dark skill-tag';
                    badgeBaru.textContent = namaKeahlian;
                    // Tambahkan badge baru ke halaman utama
                    wadahTagKeahlian.appendChild(badgeBaru);
                });
            } else {
                // 4. Jika tidak ada keahlian yang dipilih, tampilkan pesan
                wadahTagKeahlian.innerHTML = '<p class="text-muted small" id="keahlian-placeholder">Belum ada keahlian yang ditambahkan.</p>';
            }
        });
    });
</script>
@endpush
