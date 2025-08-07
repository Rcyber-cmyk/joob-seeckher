@extends('perusahaan.layouts.app')

@section('content')
<style>
    .form-section {
        background: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .form-section h5 {
        color: #333;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border-color: #ccc;
    }

    .form-label {
        font-weight: 600;
        color: #444;
    }

    .btn-success {
        padding: 10px 30px;
        font-weight: 600;
        border-radius: 10px;
    }

    .header-dashboard h1 {
        font-size: 2rem;
        color: #222;
    }

    .header-dashboard p {
        color: #777;
    }

    @media (max-width: 768px) {
        .header-dashboard h1 {
            font-size: 1.5rem;
        }

        .dashboard-section {
            padding: 1rem;
        }
    }
</style>

<div class="mb-3">
    <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div class="w-100 w-md-auto">
        <h1>Tambah Lowongan Pekerjaan</h1>
        <p class="text-muted">Tambah lowongan pekerjaan untuk perusahaan anda</p>
    </div>
</div>

<form action="{{ route('perusahaan.lowongan.store') }}" method="POST">
    @csrf
    <div class="dashboard-section p-4 mb-4 form-section">
        <h5 class="mb-3"><i class="bi bi-person-fill me-2"></i> Deskripsi Perusahaan</h5>
        <div class="row g-4 mb-4">
            <div class="col-12">
                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" id="nama_perusahaan" class="form-control" 
                       value="{{ Auth::user()->profilePerusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}" readonly>
            </div>
            <div class="col-12 col-md-6">
                <label for="posisi_pekerjaan" class="form-label">Posisi Pekerjaan</label>
                <input type="text" name="posisi_pekerjaan" id="posisi_pekerjaan" class="form-control" placeholder="Contoh: Web Developer">
            </div>
            <div class="col-12 col-md-6">
                <label for="domisili" class="form-label">Domisili</label>
                <input type="text" name="domisili" id="domisili" class="form-control" placeholder="Contoh: Jakarta">
            </div>
        </div>
        <div class="mb-4">
            <label for="deskripsi_lowongan" class="form-label">Deskripsi Lowongan</label>
            <textarea name="deskripsi_lowongan" id="deskripsi_lowongan" class="form-control" rows="5" placeholder="Silahkan Masukkan Deskripsi Lowongan..."></textarea>
        </div>
    </div>

    <div class="dashboard-section p-4 mb-4 form-section">
        <h5 class="mb-3"><i class="bi bi-card-checklist me-2"></i> Kualifikasi Perusahaan</h5>
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="">Pilih Gender</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Semua">Semua</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control" placeholder="Contoh: S1 Teknik Informatika">
            </div>
            <div class="col-12 col-md-6">
                <label for="usia" class="form-label">Usia</label>
                <input type="number" name="usia" id="usia" class="form-control" placeholder="Usia Minimal">
            </div>
            <div class="col-12 col-md-6">
                <label for="nilai_pendidikan" class="form-label">Nilai Pendidikan Terakhir</label>
                <input type="text" name="nilai_pendidikan" id="nilai_pendidikan" class="form-control" placeholder="Contoh: IPK 3.00">
            </div>
            <div class="col-12 col-md-6">
                <label for="pengalaman_kerja" class="form-label fw-bold">Pengalaman Kerja</label>
                <select name="pengalaman_kerja" id="pengalaman_kerja" class="form-select">
                    <option value="">Pilih Pengalaman Kerja</option>
                    <option value="None">None</option>
                    <option value="<1 tahun">Kurang dari 1 tahun</option>
                    <option value="1-3 tahun">1 - 3 tahun</option>
                    <option value="3-5 tahun">3 - 5 tahun</option>
                    <option value=">5 tahun">Lebih dari 5 tahun</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label for="keahlian" class="form-label">Keahlian Bidang Pekerjaan</label>
                <textarea name="keahlian" id="keahlian" class="form-control" rows="3" placeholder="Contoh: HTML, CSS, JavaScript"></textarea>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-success">Tambahkan</button>
    </div>
</form>
@endsection
