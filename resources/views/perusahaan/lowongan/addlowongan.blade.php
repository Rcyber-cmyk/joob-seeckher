@extends('perusahaan.layouts.app')

@section('content')
<style>
    /* Styling umum untuk form section */
    .form-section {
        background: #ffffff; /* Latar belakang putih */
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); /* Bayangan lebih halus */
        padding: 2rem; /* Padding lebih besar */
    }

    .form-section h5 {
        color: var(--secondary-color); /* Warna judul sesuai tema */
        font-weight: 600;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 0.75rem;
    }

    /* Styling untuk form control */
    .form-control, .form-select {
        border-radius: 8px; /* Sudut lebih melengkung */
        border: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(255, 122, 0, 0.25); /* Box shadow dengan warna oranye */
    }

    .form-label {
        font-weight: 600;
        color: #495057; /* Warna label yang lebih jelas */
    }

    /* Styling untuk tombol */
    .btn-submit {
        background-color: var(--primary-color);
        color: white;
        padding: 0.75rem 2.5rem;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-submit:hover {
        background-color: #e66a00;
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0,0,0,0.15);
    }

    .btn-back {
        background-color: transparent;
        color: var(--secondary-color);
        border: 1px solid #e0e0e0;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s;
    }
    .btn-back:hover {
        background-color: #f1f1f1;
    }

    /* Styling Header Dashboard */
    .header-dashboard h1 {
        font-size: 2rem;
        color: var(--secondary-color);
        font-weight: 700;
    }
    .header-dashboard p {
        color: #777;
    }

    /* Responsif untuk Mobile */
    @media (max-width: 768px) {
        .header-dashboard h1 {
            font-size: 1.5rem;
        }
        .form-section {
            padding: 1.5rem;
        }
        .btn-submit, .btn-back {
            width: 100%;
            margin-top: 1rem;
        }
    }
</style>

<div class="mb-4">
    <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="btn btn-back">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="header-dashboard mb-4">
    <h1>Tambah Lowongan Pekerjaan</h1>
    <p class="text-muted">Tambah lowongan pekerjaan untuk perusahaan anda</p>
</div>

@if ($errors->any())
    <div class="alert alert-danger mb-4">
        <strong>Terjadi Kesalahan!</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('perusahaan.lowongan.store') }}" method="POST">
    @csrf
    <div class="form-section p-4 mb-4">
        <h5 class="mb-3"><i class="bi bi-briefcase-fill me-2"></i> Detail Lowongan</h5>
        <div class="row g-4 mb-4">
            <div class="col-12">
                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" id="nama_perusahaan" class="form-control" 
                       value="{{ Auth::user()->profilePerusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}" readonly>
            </div>
            <div class="col-12 col-md-6">
                <label for="judul_lowongan" class="form-label">Posisi Pekerjaan</label>
                <input type="text" name="judul_lowongan" id="judul_lowongan" class="form-control" placeholder="Contoh: Web Developer" value="{{ old('judul_lowongan') }}">
            </div>
            <div class="col-12 col-md-6">
                <label for="domisili" class="form-label">Domisili</label>
                <input type="text" name="domisili" id="domisili" class="form-control" placeholder="Contoh: Jakarta" value="{{ old('domisili') }}">
            </div>
            <div class="col-12">
                <label for="tipe_pekerjaan" class="form-label">Tipe Pekerjaan</label>
                <select name="tipe_pekerjaan" id="tipe_pekerjaan" class="form-select">
                    <option value="">Pilih Tipe Pekerjaan</option>
                    <option value="Full-time" {{ old('tipe_pekerjaan') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('tipe_pekerjaan') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Kontrak" {{ old('tipe_pekerjaan') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                    <option value="Magang" {{ old('tipe_pekerjaan') == 'Magang' ? 'selected' : '' }}>Magang</option>
                </select>
            </div>
        </div>
        <div class="mb-4">
            <label for="deskripsi_pekerjaan" class="form-label">Deskripsi Lowongan</label>
            <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" class="form-control" rows="5" placeholder="Silahkan Masukkan Deskripsi Lowongan...">{{ old('deskripsi_pekerjaan') }}</textarea>
        </div>
    </div>

    <div class="form-section p-4 mb-4">
        <h5 class="mb-3"><i class="bi bi-card-checklist me-2"></i> Kualifikasi Pelamar</h5>
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="">Pilih Gender</option>
                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    <option value="Semua" {{ old('gender') == 'Semua' ? 'selected' : '' }}>Semua</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control" placeholder="Contoh: S1 Teknik Informatika" value="{{ old('pendidikan_terakhir') }}">
            </div>
            <div class="col-12 col-md-6">
                <label for="usia" class="form-label">Usia Minimal</label>
                <input type="number" name="usia" id="usia" class="form-control" placeholder="Contoh: 22" value="{{ old('usia') }}">
            </div>
            <div class="col-12 col-md-6">
                <label for="nilai_pendidikan_terakhir" class="form-label">Nilai Pendidikan Terakhir</label>
                <input type="text" name="nilai_pendidikan_terakhir" id="nilai_pendidikan_terakhir" class="form-control" placeholder="Contoh: IPK 3.00" value="{{ old('nilai_pendidikan_terakhir') }}">
            </div>
            <div class="col-12 col-md-6">
                <label for="pengalaman_kerja" class="form-label">Pengalaman Kerja</label>
                <select name="pengalaman_kerja" id="pengalaman_kerja" class="form-select">
                    <option value="">Pilih Pengalaman Kerja</option>
                    <option value="None" {{ old('pengalaman_kerja') == 'None' ? 'selected' : '' }}>None</option>
                    <option value="<1 tahun" {{ old('pengalaman_kerja') == '<1 tahun' ? 'selected' : '' }}>Kurang dari 1 tahun</option>
                    <option value="1-3 tahun" {{ old('pengalaman_kerja') == '1-3 tahun' ? 'selected' : '' }}>1 - 3 tahun</option>
                    <option value="3-5 tahun" {{ old('pengalaman_kerja') == '3-5 tahun' ? 'selected' : '' }}>3 - 5 tahun</option>
                    <option value=">5 tahun" {{ old('pengalaman_kerja') == '>5 tahun' ? 'selected' : '' }}>Lebih dari 5 tahun</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="keahlian_bidang_pekerjaan" class="form-label">Keahlian Bidang Pekerjaan</label>
                <textarea name="keahlian_bidang_pekerjaan" id="keahlian_bidang_pekerjaan" class="form-control" rows="3" placeholder="Contoh: HTML, CSS, JavaScript">{{ old('keahlian_bidang_pekerjaan') }}</textarea>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-submit">Tambahkan</button>
    </div>
</form>
@endsection
