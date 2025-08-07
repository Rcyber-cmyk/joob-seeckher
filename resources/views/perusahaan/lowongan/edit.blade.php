@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Halaman --}}
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="w-100 w-md-auto mb-3 mb-md-0">
            <h1>Edit Lowongan Pekerjaan</h1>
            <p class="text-muted">Edit detail lowongan pekerjaan</p>
        </div>
        <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="btn btn-secondary d-flex align-items-center">
            <i class="bi bi-arrow-left-circle me-2"></i> Kembali
        </a>
    </div>

    {{-- Form Edit Lowongan --}}
    <form action="{{ route('perusahaan.lowongan.update', $lowongan->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="dashboard-section p-4 mb-4">
            {{-- Bagian Deskripsi Perusahaan --}}
            <h5 class="fw-bold mb-3"><i class="bi bi-person-fill me-2"></i> Deskripsi Perusahaan</h5>
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <label for="nama_perusahaan" class="form-label fw-bold">Nama Perusahaan</label>
                    <input type="text" id="nama_perusahaan" class="form-control" 
                           value="{{ Auth::user()->profilePerusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}" readonly>
                </div>
                <div class="col-12 col-md-6">
                    <label for="posisi_pekerjaan" class="form-label fw-bold">Posisi Pekerjaan</label>
                    <input type="text" name="posisi_pekerjaan" id="posisi_pekerjaan" class="form-control" placeholder="Silahkan Nama Lowongan" value="{{ old('posisi_pekerjaan', $lowongan->judul_lowongan) }}">
                </div>
                <div class="col-12 col-md-6">
                    <label for="domisili" class="form-label fw-bold">Domisili</label>
                    <input type="text" name="domisili" id="domisili" class="form-control" placeholder="Domisili" value="{{ old('domisili', $lowongan->domisili) }}">
                </div>
            </div>
            <div class="mb-4">
                <label for="deskripsi_lowongan" class="form-label fw-bold">Deskripsi Lowongan</label>
                <textarea name="deskripsi_lowongan" id="deskripsi_lowongan" class="form-control" rows="5" placeholder="Silahkan Masukan Deskripsi Lowongan Pekerjaan Anda....">{{ old('deskripsi_lowongan', $lowongan->deskripsi_pekerjaan) }}</textarea>
            </div>
        </div>

        <div class="dashboard-section p-4 mb-4">
            {{-- Bagian Kualifikasi Perusahaan --}}
            <h5 class="fw-bold mb-3"><i class="bi bi-card-checklist me-2"></i> Kualifikasi Perusahaan</h5>
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label for="gender" class="form-label fw-bold">Gender</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="">Pilih Gender</option>
                        <option value="Laki-laki" {{ old('gender', $lowongan->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $lowongan->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        <option value="Semua" {{ old('gender', $lowongan->gender) == 'Semua' ? 'selected' : '' }}>Semua</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="pendidikan_terakhir" class="form-label fw-bold">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control" placeholder="Contoh: S1 Teknik Informatika" value="{{ old('pendidikan_terakhir', $lowongan->pendidikan_terakhir) }}">
                </div>
                <div class="col-12 col-md-6">
                    <label for="usia" class="form-label fw-bold">Usia</label>
                    <input type="text" name="usia" id="usia" class="form-control" placeholder="Usia minimal" value="{{ old('usia', $lowongan->usia) }}">
                </div>
                <div class="col-12 col-md-6">
                    <label for="nilai_pendidikan" class="form-label fw-bold">Nilai Pendidikan Terakhir</label>
                    <input type="text" name="nilai_pendidikan" id="nilai_pendidikan" class="form-control" placeholder="Contoh: IPK 3.00" value="{{ old('nilai_pendidikan', $lowongan->nilai_pendidikan_terakhir) }}">
                </div>
                <div class="col-12 col-md-6">
                    <label for="pengalaman_kerja" class="form-label fw-bold">Pengalaman Kerja</label>
                    <select name="pengalaman_kerja" id="pengalaman_kerja" class="form-select">
                        <option value="">Pilih Pengalaman Kerja</option>
                        <option value="None" {{ old('pengalaman_kerja', $lowongan->pengalaman_kerja) == 'None' ? 'selected' : '' }}>None</option>
                        <option value="Kurang dari 1 tahun" {{ old('pengalaman_kerja', $lowongan->pengalaman_kerja) == 'Kurang dari 1 tahun' ? 'selected' : '' }}>Kurang dari 1 tahun</option>
                        <option value="1-3 tahun" {{ old('pengalaman_kerja', $lowongan->pengalaman_kerja) == '1-3 tahun' ? 'selected' : '' }}>1-3 tahun</option>
                        <option value="3-5 tahun" {{ old('pengalaman_kerja', $lowongan->pengalaman_kerja) == '3-5 tahun' ? 'selected' : '' }}>3-5 tahun</option>
                        <option value="Lebih dari 5 tahun" {{ old('pengalaman_kerja', $lowongan->pengalaman_kerja) == 'Lebih dari 5 tahun' ? 'selected' : '' }}>Lebih dari 5 tahun</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="keahlian" class="form-label fw-bold">Keahlian Bidang Pekerjaan</label>
                    <textarea name="keahlian" id="keahlian" class="form-control" rows="3" placeholder="Contoh: HTML, CSS, JavaScript">{{ old('keahlian', $lowongan->keahlian_bidang_pekerjaan) }}</textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
@endsection