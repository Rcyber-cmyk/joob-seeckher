<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Messari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* CSS Anda sudah bagus dan tidak perlu diubah */
        body { font-family: 'Segoe UI', sans-serif; background-color: #263341; color: #ffffff; margin: 0; padding: 0; overflow-x: hidden; }
        .register-container { display: flex; min-height: 100vh; width: 100vw; position: relative; }
        .panel { display: flex; align-items: center; justify-content: center; transition: all 0.5s ease-in-out; width: 50%; padding: 3rem; box-sizing: border-box; }
        .illustration-panel { background-color: #263341; flex-direction: column; align-items: flex-start; justify-content: flex-start; padding-top: 2rem; padding-left: 2rem; display: none; }
        .illustration-panel .page-title { font-size: 1.5rem; font-weight: bold; color: white; margin-bottom: 2rem; }
        .illustration-panel img { max-width: 80%; height: auto; filter: drop-shadow(0 0 20px rgba(255,115,34,0.6)); margin-top: 2rem; margin-left: auto; margin-right: auto; }
        .form-wrapper { width: 100%; max-width: 450px; }
        .role-choice-panel h1, .form-panel h2 { font-weight: 900; font-size: 3.5rem; letter-spacing: 1px; margin-bottom: 2rem; text-align: center; color: white; }
        .btn-role, .btn-navigate { background-color: #f97316; border: none; color: white; padding: 1rem; font-weight: bold; border-radius: 0.75rem; width: 100%; max-width: 300px; margin-left: auto; margin-right: auto; font-size: 1.2rem; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(249, 115, 22, 0.2); }
        .btn-role:hover, .btn-navigate:hover { background-color: #fb923c; color: white; transform: translateY(-3px); box-shadow: 0 8px 20px rgba(249, 115, 22, 0.4); }
        .d-grid.gap-3 { display: flex; flex-direction: column; gap: 1rem; align-items: center; }
        .form-control, .form-select { background-color: #4a5568 !important; border: none !important; color: white !important; padding: 0.8rem 1rem !important; border-radius: 0.5rem !important; height: 50px !important; }
        .form-control::placeholder { color: #a0aec0; }
        .form-control:focus, .form-select:focus { background-color: #4a5568 !important; color: white !important; box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25) !important; border-color: #f97316 !important; }
        .back-button { cursor: pointer; color: #a0aec0; margin-bottom: 1rem; display: inline-block; transition: color 0.3s ease; }
        .back-button:hover { color: white; }
        .bottom-link a { color: #f97316; font-weight: bold; text-decoration: none; transition: text-decoration 0.3s ease; }
        .bottom-link a:hover { text-decoration: underline; }
        .required-star { color: #f97316; }
        .step-indicator { display: flex; justify-content: center; margin-bottom: 2rem; }
        .step-indicator .step { width: 30px; height: 30px; border-radius: 50%; background-color: #4a5568; color: #a0aec0; display: flex; align-items: center; justify-content: center; font-weight: bold; margin: 0 0.5rem; transition: all 0.3s ease; }
        .step-indicator .step.active { background-color: #f97316; color: white; }
        .step-indicator .step.completed { background-color: #10B981; color: white; }
        .invalid-feedback { display: block; color: #ff7b7b; font-size: 0.875em; margin-top: 0.25rem; }
        @media (max-width: 991.98px) {
            .register-container { flex-direction: column; }
            .panel { width: 100%; padding: 1.5rem; }
            .illustration-panel { display: flex; align-items: center; padding-top: 1rem; padding-left: 1.5rem; order: -1; height: 180px; }
            .illustration-panel .page-title { text-align: center; width: 100%; margin-bottom: 1rem; }
            .illustration-panel img { max-width: 150px; margin-top: 1rem; margin-bottom: 1rem; }
            .role-choice-panel h1, .form-panel h2 { font-size: 2.5rem; text-align: center; margin-bottom: 1.5rem; }
        }
        @media (min-width: 992px) { .illustration-panel { display: flex !important; } }
    </style>
</head>
<body data-has-errors="{{ $errors->any() ? 'true' : 'false' }}" 
      data-old-role="{{ old('role') }}" 
      data-old-step-pelamar="{{ old('current_step', 1) }}" 
      data-old-step-perusahaan="{{ old('current_step_perusahaan', 1) }}">

<div class="register-container">
    <div class="panel illustration-panel order-lg-first order-first">
        <div class="page-title d-lg-block d-none">Messari</div>
        <img src="{{ asset('images/auth/register.png') }}" onerror="this.onerror=null;this.src='https://placehold.co/600x400/263341/ffffff?text=Ilustrasi';">
    </div>

    <div class="panel form-container-panel order-lg-last order-last">
        <div class="form-wrapper">
            {{-- Panel Pilihan Role --}}
            <div id="role-choice-panel">
                <h1 class="text-center">DAFTAR</h1>
                <div class="d-grid gap-3">
                    <button class="btn btn-role" onclick="showForm('pelamar')">PELAMAR</button>
                    <button class="btn btn-role" onclick="showForm('perusahaan')">PERUSAHAAN</button>
                </div>
                <div class="text-center mt-4 small bottom-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </div>

            {{-- Panel Form Utama --}}
            <div id="form-panel" style="display: none;">
                <div class="back-button" onclick="showRoleChoice()"><i class="bi bi-arrow-left"></i> Kembali</div>
                <h2 id="form-title">Daftar</h2>

                <div class="step-indicator"></div>
                
                {{-- PENYESUAIAN: Menambahkan atribut 'novalidate' untuk mencegah validasi bawaan browser --}}
                <form method="POST" action="{{ route('register') }}" id="multi-step-form" novalidate>
                    @csrf
                    <input type="hidden" id="role" name="role">
                    <input type="hidden" id="current_step" name="current_step" value="1">
                    <input type="hidden" id="current_step_perusahaan" name="current_step_perusahaan" value="1">
                    
                    {{-- Step 1 (Common for both) --}}
                    <div id="step-1" class="form-step">
                        <div class="mb-3">
                            <label for="name" class="form-label" id="name_label">Nama Lengkap / Nama Perusahaan <span class="required-star">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email <span class="required-star">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="required-star">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="required-star">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>

                    {{-- Step 2: Pelamar Specific --}}
                    <div id="step-2-pelamar" class="form-step" style="display: none;">
                        <div class="mb-3"><label for="nik" class="form-label">NIK <span class="required-star">*</span></label><input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required>@error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-3"><label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="required-star">*</span></label><input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>@error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-3"><label for="alamat" class="form-label">Alamat Lengkap Sesuai KTP <span class="required-star">*</span></label><textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" required>{{ old('alamat') }}</textarea>@error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="row"><div class="col-md-6 mb-3"><label for="gender" class="form-label">Jenis Kelamin <span class="required-star">*</span></label><select class="form-select @error('gender') is-invalid @enderror" name="gender" required><option value="">Pilih</option><option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option><option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option></select>@error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div class="col-md-6 mb-3"><label for="no_hp" class="form-label">Nomor HP <span class="required-star">*</span></label><input type="tel" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required>@error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></div>
                    </div>

                    {{-- Step 3: Pelamar Specific --}}
                    <div id="step-3-pelamar" class="form-step" style="display: none;">
                        <div class="mb-3"><label for="domisili" class="form-label">Domisili (Kota) <span class="required-star">*</span></label><input type="text" class="form-control @error('domisili') is-invalid @enderror" name="domisili" value="{{ old('domisili') }}" required>@error('domisili')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-3"><label for="lulusan" class="form-label">Pendidikan Terakhir <span class="required-star">*</span></label><select class="form-select @error('lulusan') is-invalid @enderror" name="lulusan" required><option value="">Pilih</option><option value="SMP/Sederajat" @if(old('lulusan')=='SMP/Sederajat')selected @endif>SMP/Sederajat</option><option value="SMA/SMK Sederajat" @if(old('lulusan')=='SMA/SMK Sederajat')selected @endif>SMA/SMK Sederajat</option><option value="D1" @if(old('lulusan')=='D1')selected @endif>D1</option><option value="D2" @if(old('lulusan')=='D2')selected @endif>D2</option><option value="D3" @if(old('lulusan')=='D3')selected @endif>D3</option><option value="D4" @if(old('lulusan')=='D4')selected @endif>D4</option><option value="S1" @if(old('lulusan')=='S1')selected @endif>S1</option><option value="S2" @if(old('lulusan')=='S2')selected @endif>S2</option><option value="S3" @if(old('lulusan')=='S3')selected @endif>S3</option></select>@error('lulusan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-3">
                                <label for="tahun_lulus" class="form-label">Tahun Lulus <span class="required-star">*</span></label>
                                <select class="form-select @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" required>
                                    <option value="">-- Pilih Tahun --</option>
                                    @php
                                        $tahunSekarang = date('Y');
                                        for ($tahun = $tahunSekarang - 50; $tahun <= $tahunSekarang; $tahun++) {
                                            echo '<option value="' . $tahun . '" ' . (old('tahun_lulus') == $tahun ? 'selected' : '') . '>' . $tahun . '</option>';
                                        }
                                    @endphp
                                </select>
                                @error('tahun_lulus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        <div class="mb-4"><label for="pengalaman_kerja" class="form-label">Pengalaman Kerja <span class="required-star">*</span></label><select class="form-select @error('pengalaman_kerja') is-invalid @enderror" name="pengalaman_kerja" required><option value="">Pilih</option><option value="Fresh Graduate" {{ old('pengalaman_kerja')=='Fresh Graduate'?'selected':'' }}>Fresh Graduate</option><option value="< 1 Tahun" {{ old('pengalaman_kerja')=='< 1 Tahun'?'selected':'' }}>< 1 Tahun</option><option value="1-3 Tahun" {{ old('pengalaman_kerja')=='1-3 Tahun'?'selected':'' }}>1-3 Tahun</option><option value="3-5 Tahun" {{ old('pengalaman_kerja')=='3-5 Tahun'?'selected':'' }}>3-5 Tahun</option><option value="> 5 Tahun" {{ old('pengalaman_kerja')=='> 5 Tahun'?'selected':'' }}>> 5 Tahun</option></select>@error('pengalaman_kerja')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div>

                    {{-- Step 2: Perusahaan Specific --}}
                    <div id="step-2-perusahaan" class="form-step" style="display: none;">
                        <div class="mb-3"><label for="alamat_jalan" class="form-label">Alamat Kantor (Jalan) <span class="required-star">*</span></label><textarea class="form-control @error('alamat_jalan') is-invalid @enderror" name="alamat_jalan" required>{{ old('alamat_jalan') }}</textarea>@error('alamat_jalan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="row"><div class="col-md-6 mb-3"><label for="alamat_kota" class="form-label">Kota <span class="required-star">*</span></label><input type="text" class="form-control @error('alamat_kota') is-invalid @enderror" name="alamat_kota" value="{{ old('alamat_kota') }}" required>@error('alamat_kota')<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div class="col-md-6 mb-3"><label for="kode_pos" class="form-label">Kode Pos <span class="required-star">*</span></label><input type="text" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ old('kode_pos') }}" required>@error('kode_pos')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></div>
                        <div class="mb-3"><label for="no_telp_perusahaan" class="form-label">Nomor Telepon Perusahaan <span class="required-star">*</span></label><input type="tel" class="form-control @error('no_telp_perusahaan') is-invalid @enderror" name="no_telp_perusahaan" value="{{ old('no_telp_perusahaan') }}" required>@error('no_telp_perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="mb-4"><label for="npwp_perusahaan" class="form-label">NPWP Perusahaan <span class="required-star">*</span></label><input type="text" class="form-control @error('npwp_perusahaan') is-invalid @enderror" name="npwp_perusahaan" value="{{ old('npwp_perusahaan') }}" required>@error('npwp_perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div>

                    {{-- Container untuk tombol navigasi --}}
                    <div id="form-navigation-container" class="mt-4"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
// --- VARIABEL GLOBAL ---
const roleChoicePanel = document.getElementById('role-choice-panel');
const formPanel = document.getElementById('form-panel');
const form = document.getElementById('multi-step-form');
const roleInput = document.getElementById('role');
const formTitle = document.getElementById('form-title');
const nameLabel = document.getElementById('name_label');
const stepIndicatorContainer = document.querySelector('.step-indicator');
const navContainer = document.getElementById('form-navigation-container');

let currentRole = '';
let currentStep = 1;
let totalSteps = 0;

// --- FUNGSI UTAMA ---
function showForm(role) {
    currentRole = role;
    roleInput.value = role;
    roleChoicePanel.style.display = 'none';
    formPanel.style.display = 'block';
    
    if (role === 'pelamar') {
        formTitle.innerText = 'Daftar sebagai Pelamar';
        nameLabel.innerHTML = 'Nama Lengkap <span class="required-star">*</span>';
        totalSteps = 3;
    } else if (role === 'perusahaan') {
        formTitle.innerText = 'Daftar sebagai Perusahaan';
        nameLabel.innerHTML = 'Nama Perusahaan <span class="required-star">*</span>';
        totalSteps = 2;
    }
    
    currentStep = 1;
    showStep(currentStep);
}

function showStep(step) {
    currentStep = step;
    document.querySelectorAll('.form-step').forEach(el => el.style.display = 'none');

    // Update hidden input values
    if (currentRole === 'pelamar') {
        document.getElementById('current_step').value = step;
    } else if (currentRole === 'perusahaan') {
        document.getElementById('current_step_perusahaan').value = step;
    }

    if (currentStep === 1) {
        document.getElementById('step-1').style.display = 'block';
    } else {
        const stepId = `step-${step}-${currentRole}`;
        const stepElement = document.getElementById(stepId);
        if (stepElement) {
            stepElement.style.display = 'block';
        }
    }
    
    updateStepIndicator();
    updateNavigation();
}

function changeStep(direction) {
    const newStep = currentStep + direction;

    if (direction > 0) { // Moving forward
        if (!validateCurrentStep()) {
            alert('Harap lengkapi semua kolom yang wajib diisi.');
            return;
        }
    }
    
    if (newStep > 0 && newStep <= totalSteps) {
        showStep(newStep);
    }
}

function validateCurrentStep() {
    let stepElement;
    if (currentStep === 1) {
        stepElement = document.getElementById('step-1');
    } else {
        const stepId = `step-${currentStep}-${currentRole}`;
        stepElement = document.getElementById(stepId);
    }

    if (!stepElement) return false; // Failsafe

    const inputs = stepElement.querySelectorAll('[required]');
    let isValid = true;
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    });
    return isValid;
}

function updateNavigation() {
    let buttons = '';
    if (currentStep === 1) {
        buttons = `<button type="button" class="btn btn-navigate w-100" onclick="changeStep(1)">Lanjut</button>`;
    } else if (currentStep < totalSteps) {
        buttons = `<div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary btn-navigate" onclick="changeStep(-1)" style="max-width: 120px;">Kembali</button>
            <button type="button" class="btn btn-navigate" onclick="changeStep(1)" style="max-width: 120px;">Lanjut</button>
        </div>`;
    } else { // Last step
        const buttonText = currentRole === 'pelamar' ? 'Lanjut & Pilih Keahlian' : 'DAFTAR';
        buttons = `<div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary btn-navigate" onclick="changeStep(-1)" style="max-width: 120px;">Kembali</button>
            <button type="submit" class="btn btn-role" style="max-width: 220px;">${buttonText}</button>
        </div>`;
    }
    navContainer.innerHTML = buttons;
}

function updateStepIndicator() {
    let indicatorHtml = '';
    for (let i = 1; i <= totalSteps; i++) {
        let status = i === currentStep ? 'active' : (i < currentStep ? 'completed' : '');
        indicatorHtml += `<div class="step ${status}">${i}</div>`;
    }
    stepIndicatorContainer.innerHTML = indicatorHtml;
}

function showRoleChoice() {
    roleChoicePanel.style.display = 'block';
    formPanel.style.display = 'none';
    form.reset();
}

// Handle jika ada error validasi dari server
document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const hasErrors = body.getAttribute('data-has-errors') === 'true';
    const oldRole = body.getAttribute('data-old-role');

    if (hasErrors && oldRole) {
        showForm(oldRole); // This sets the role and totalSteps

        // After setting the role, jump to the correct step
        let oldStep = 1;
        if (oldRole === 'pelamar') {
            oldStep = parseInt(body.getAttribute('data-old-step-pelamar') || '1');
        } else if (oldRole === 'perusahaan') {
            oldStep = parseInt(body.getAttribute('data-old-step-perusahaan') || '1');
        }
        
        if (oldStep > 1) {
            showStep(oldStep);
        }
    }
});
</script>
</body>
</html>
