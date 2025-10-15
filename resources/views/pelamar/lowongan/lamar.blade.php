{{-- Simpan sebagai /resources/views/pelamar/lowongan/lamar.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Lamar Pekerjaan')

@section('content')
<div class="container my-5">
    <div class="lamar-card">
        <div class="lamar-header">
            <img src="{{ $lowongan->perusahaan->logo ? asset('storage/' . $lowongan->perusahaan->logo) : 'https://placehold.co/60x60' }}" alt="Logo" class="company-logo">
            <div>
                <h4 class="job-title">{{ $lowongan->judul_lowongan }}</h4>
                <p class="company-name text-muted mb-0">PT {{ $lowongan->perusahaan->nama_perusahaan }}</p>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="progress-container">
            <div class="progress-step active" data-step="1">1</div>
            <div class="progress-line"></div>
            <div class="progress-step" data-step="2">2</div>
            <div class="progress-line"></div>
            <div class="progress-step" data-step="3">3</div>
        </div>

        <form action="{{ route('lowongan.lamar.store', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- STEP 1: INFORMASI PRIBADI -->
            <div class="form-step active" id="step-1">
                <h5 class="step-title">Informasi Pribadi</h5>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Nama Depan</label><input type="text" name="nama_depan" class="form-control" value="{{ explode(' ', $pelamar->nama_lengkap)[0] }}" required></div>
                    <div class="col-md-6"><label class="form-label">Nama Belakang</label><input type="text" name="nama_belakang" class="form-control" value="{{ explode(' ', $pelamar->nama_lengkap, 2)[1] ?? '' }}" required></div>
                    <div class="col-12"><label class="form-label">Lokasi Rumah</label><input type="text" name="lokasi_rumah" class="form-control" value="{{ $pelamar->alamat }}" required></div>
                    <div class="col-12"><label class="form-label">Nomor Telepon</label><input type="tel" name="nomor_telepon" class="form-control" value="{{ $pelamar->no_hp }}" required></div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6 class="form-section-title">Surat Lamaran</h6>
                        <div class="form-check"><input class="form-check-input" type="radio" name="surat_option" id="unggah_surat" value="unggah" checked><label class="form-check-label" for="unggah_surat">Unggah Surat Lamaran</label></div>
                        <input type="file" name="unggah_surat_lamaran" class="form-control form-control-sm my-2">
                        <div class="form-check"><input class="form-check-input" type="radio" name="surat_option" id="tulis_surat" value="tulis"><label class="form-check-label" for="tulis_surat">Tulis Surat Lamaran</label></div>
                        <textarea name="tulis_surat_lamaran" class="form-control my-2" rows="4" style="display: none;"></textarea>
                        <div class="form-check"><input class="form-check-input" type="radio" name="surat_option" id="tanpa_surat" value="tidak"><label class="form-check-label" for="tanpa_surat">Tidak Menyertakan Surat Lamaran</label></div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="form-section-title">Resume</h6>
                        <div class="form-check"><input class="form-check-input" type="radio" name="resume_option" id="unggah_resume" value="unggah" checked><label class="form-check-label" for="unggah_resume">Unggah Resume</label></div>
                        <input type="file" name="unggah_resume" class="form-control form-control-sm my-2">
                        <div class="form-check"><input class="form-check-input" type="radio" name="resume_option" id="tanpa_resume" value="tidak"><label class="form-check-label" for="tanpa_resume">Tidak Menyertakan Resume</label></div>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-dark next-btn">Lanjut &rarr;</button>
                </div>
            </div>

            <!-- STEP 2: PERTANYAAN PERUSAHAAN -->
            <div class="form-step" id="step-2">
                <h5 class="step-title">Jawab Pertanyaan Perusahaan</h5>
                <div class="mb-3"><label class="form-label">Berapa gaji pokok bulanan yang Anda inginkan?</label><input type="text" name="gaji_diharapkan" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Apa Pendidikan terakhir yang Anda tempuh?</label>
                    <select name="pendidikan_terakhir" class="form-select">
                        <option>SMA/SMK Sederajat</option><option>D3</option><option>S1</option><option>S2</option>
                    </select>
                </div>
                <div class="mb-3"><label class="form-label">Berapa tahun pengalaman Anda mendalami peran ini?</label><input type="text" name="pengalaman_tahun" class="form-control"></div>
                
                <h6 class="form-section-title mt-4">Pilih bidang keahlian yang Anda kuasai!</h6>
                @foreach($semuaKeahlian->take(7) as $keahlian)
                <div class="form-check"><input class="form-check-input" type="radio" name="keahlian_utama" id="keahlian{{$keahlian->id}}"><label class="form-check-label" for="keahlian{{$keahlian->id}}">{{$keahlian->nama_keahlian}}</label></div>
                @endforeach
                <div class="form-check"><input class="form-check-input" type="radio" name="keahlian_utama" id="keahlian_lainnya"><label class="form-check-label" for="keahlian_lainnya">Tidak Ada Satupun</label></div>
                
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary prev-btn">&larr; Kembali</button>
                    <button type="button" class="btn btn-dark next-btn">Lanjut &rarr;</button>
                </div>
            </div>

            <!-- STEP 3: RIWAYAT KARIR -->
            <div class="form-step" id="step-3">
                <h5 class="step-title">Riwayat Karir</h5>
                <div class="row g-3">
                    <div class="col-12"><label class="form-label">Posisi Pekerjaan</label><input type="text" name="posisi_pekerjaan" class="form-control" required></div>
                    <div class="col-12"><label class="form-label">Nama Perusahaan</label><input type="text" name="nama_perusahaan" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Mulai</label><input type="date" name="mulai" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Berakhir</label><input type="date" name="berakhir" class="form-control"></div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary prev-btn">&larr; Kembali</button>
                    <button type="submit" class="btn btn-dark">Kirim Lamaran</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .lamar-card { background-color: #fff; border-radius: 1rem; padding: 2.5rem; max-width: 800px; margin: auto; box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1); }
    .lamar-header { display: flex; align-items: center; border-bottom: 1px solid #e9ecef; padding-bottom: 1.5rem; margin-bottom: 1.5rem; }
    .company-logo { width: 60px; height: 60px; border-radius: 0.5rem; margin-right: 1rem; }
    .job-title { font-weight: 700; }
    .progress-container { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; }
    .progress-step { width: 30px; height: 30px; border-radius: 50%; background-color: #e9ecef; color: #6c757d; display: flex; justify-content: center; align-items: center; font-weight: bold; transition: all 0.3s; }
    .progress-step.active { background-color: #212529; color: white; }
    .progress-line { flex-grow: 1; height: 2px; background-color: #e9ecef; }
    .form-step { display: none; }
    .form-step.active { display: block; }
    .step-title, .form-section-title { font-weight: 600; margin-bottom: 1.5rem; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const nextBtns = document.querySelectorAll('.next-btn');
    const prevBtns = document.querySelectorAll('.prev-btn');
    let currentStep = 1;

    function updateProgress() {
        progressSteps.forEach((step, index) => {
            if (index < currentStep) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
    }

    function showStep(stepNumber) {
        steps.forEach(step => step.classList.remove('active'));
        document.getElementById(`step-${stepNumber}`).classList.add('active');
        currentStep = stepNumber;
        updateProgress();
    }

    nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep < steps.length) {
                showStep(currentStep + 1);
            }
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });
    });

    // Logic for radio buttons
    document.querySelectorAll('input[name="surat_option"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelector('input[name="unggah_surat_lamaran"]').style.display = (this.value === 'unggah') ? 'block' : 'none';
            document.querySelector('textarea[name="tulis_surat_lamaran"]').style.display = (this.value === 'tulis') ? 'block' : 'none';
        });
    });
});
</script>
@endpush
