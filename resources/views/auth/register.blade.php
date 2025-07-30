<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Messari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #2d3e50;
            color: #ffffff;
            margin: 0;
            padding: 2rem 0;
        }
        .register-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }
        .panel {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s ease-in-out;
            width: 50%;
            padding: 2rem;
        }
        .illustration-panel {
            background-color: #ffffff;
            clip-path: polygon(0 0, 100% 0, 75% 100%, 0% 100%);
        }
        .illustration-panel img { max-width: 60%; height: auto; }
        .form-container-panel { flex-direction: column; }
        .form-wrapper { width: 100%; max-width: 500px; }
        .role-choice-panel h1, .form-panel h2 { font-weight: 900; font-size: 3rem; margin-bottom: 2rem; }
        .btn-role { background-color: #f97316; border: none; color: white; padding: 1rem; font-weight: bold; border-radius: 0.75rem; width: 100%; font-size: 1.2rem; transition: all 0.3s ease; }
        .btn-role:hover { background-color: #fb923c; color: white; transform: translateY(-3px); }
        .form-control, .form-select { background-color: #4a5568; border: none; color: white; padding: 0.8rem 1rem; border-radius: 0.5rem; height: 50px; }
        .form-control::placeholder { color: #a0aec0; }
        .form-control:focus, .form-select:focus { background-color: #4a5568; color: white; box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25); border-color: #f97316; }
        .back-button { cursor: pointer; color: #a0aec0; margin-bottom: 1rem; display: inline-block; }
        .bottom-link a { color: #f97316; font-weight: bold; text-decoration: none; }
        .error-message { color: #ff7b7b; font-size: 0.875em; display: block; margin-top: .25rem; }
        .form-label { margin-bottom: 0.5rem; }
        .form-label .required-star { color: #ff7b7b; font-weight: bold; margin-left: 2px; }
        @media (max-width: 991.98px) {
            .illustration-panel { display: none; }
            .panel { width: 100%; }
        }
    </style>
</head>
<body data-has-errors="{{ $errors->any() ? 'true' : 'false' }}" data-old-role="{{ old('role') }}">
    <div class="register-container">
        <div class="panel illustration-panel d-none d-lg-flex">
            <img src="{{ asset('images/register-illustration.png') }}" onerror="this.onerror=null;this.src='https://placehold.co/600x600/ffffff/2d3e50?text=Ilustrasi';">
        </div>

        <div class="panel form-container-panel">
            <div class="form-wrapper">
                <div id="role-choice-panel">
                    <h1 class="text-center text-lg-start">DAFTAR</h1>
                    <div class="d-grid gap-3">
                        <button class="btn btn-role" onclick="showForm('pelamar')">PELAMAR</button>
                        <button class="btn btn-role" onclick="showForm('perusahaan')">PERUSAHAAN</button>
                    </div>
                     <div class="text-center text-lg-start mt-4 small bottom-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                    </div>
                </div>

                <div id="form-panel" style="display: none;">
                    <div class="back-button" onclick="showRoleChoice()"><i class="bi bi-arrow-left"></i> Kembali</div>
                    <h2 id="form-title">Daftar sebagai Pelamar</h2>
                    
                    {{-- ======================================================= --}}
                    {{-- TAMBAHKAN BLOK INI UNTUK MENAMPILKAN SEMUA ERROR DI ATAS --}}
                    @if ($errors->any())
                        <div class="alert alert-danger" style="background-color: #7f1d1d; border: none; color: white;">
                            <h5 class="alert-heading">Terjadi Kesalahan!</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- ======================================================= --}}

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" id="role" name="role" value="{{ old('role') }}">

                        {{-- Kolom Umum --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email <span class="required-star">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                        
                        {{-- Field Khusus Pelamar --}}
                        <div id="pelamar-fields">
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK <span class="required-star">*</span></label>
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}">
                                @error('nik') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="required-star">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="domisili" class="form-label">Domisili (Kota) <span class="required-star">*</span></label>
                                <input type="text" class="form-control" id="domisili" name="domisili" value="{{ old('domisili') }}">
                                @error('domisili') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap Sesuai KTP <span class="required-star">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" style="height: 80px;">{{ old('alamat') }}</textarea>
                                @error('alamat') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="lulusan" class="form-label">Pendidikan Terakhir <span class="required-star">*</span></label>
                                    <select class="form-select" id="lulusan" name="lulusan">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="SMP/Sederajat" @if(old('lulusan') == 'SMP/Sederajat') selected @endif>SMP/Sederajat</option>
                                        <option value="SMA/SMK Sederajat" @if(old('lulusan') == 'SMA/SMK Sederajat') selected @endif>SMA/SMK Sederajat</option>
                                        <option value="D1" @if(old('lulusan') == 'D1') selected @endif>D1</option>
                                        <option value="D2" @if(old('lulusan') == 'D2') selected @endif>D2</option>
                                        <option value="D3" @if(old('lulusan') == 'D3') selected @endif>D3</option>
                                        <option value="D4" @if(old('lulusan') == 'D4') selected @endif>D4</option>
                                        <option value="S1" @if(old('lulusan') == 'S1') selected @endif>S1</option>
                                        <option value="S2" @if(old('lulusan') == 'S2') selected @endif>S2</option>
                                        <option value="S3" @if(old('lulusan') == 'S3') selected @endif>S3</option>
                                    </select>
                                    @error('lulusan') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tahun_lulus" class="form-label">Tahun Lulus <span class="required-star">*</span></label>
                                    <select class="form-select" id="tahun_lulus" name="tahun_lulus">
                                        <option value="">-- Pilih Tahun --</option>
                                        @php
                                            $tahunSekarang = date('Y');
                                            for ($tahun = $tahunSekarang; $tahun >= $tahunSekarang - 50; $tahun--) {
                                                echo '<option value="' . $tahun . '" ' . (old('tahun_lulus') == $tahun ? 'selected' : '') . '>' . $tahun . '</option>';
                                            }
                                        @endphp
                                    </select>
                                    @error('tahun_lulus') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin <span class="required-star">*</span></label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label">Nomor Telepon <span class="required-star">*</span></label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                    @error('no_hp') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pengalaman_kerja" class="form-label">Pengalaman Kerja <span class="required-star">*</span></label>
                                <select class="form-select" id="pengalaman_kerja" name="pengalaman_kerja">
                                    <option value="">-- Pilih Pengalaman --</option>
                                    <option value="Fresh Graduate" {{ old('pengalaman_kerja') == 'Fresh Graduate' ? 'selected' : '' }}>Fresh Graduate / Belum ada</option>
                                    <option value="< 1 Tahun" {{ old('pengalaman_kerja') == '< 1 Tahun' ? 'selected' : '' }}>< 1 Tahun</option>
                                    <option value="1-3 Tahun" {{ old('pengalaman_kerja') == '1-3 Tahun' ? 'selected' : '' }}>1-3 Tahun</option>
                                    <option value="3-5 Tahun" {{ old('pengalaman_kerja') == '3-5 Tahun' ? 'selected' : '' }}>3-5 Tahun</option>
                                    <option value="> 5 Tahun" {{ old('pengalaman_kerja') == '> 5 Tahun' ? 'selected' : '' }}>> 5 Tahun</option>
                                </select>
                                @error('pengalaman_kerja') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Kolom Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="required-star">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="required-star">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        
                        <button type="submit" class="btn btn-role w-100">DAFTAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const roleChoicePanel = document.getElementById('role-choice-panel');
        const formPanel = document.getElementById('form-panel');
        const roleInput = document.getElementById('role');
        const formTitle = document.getElementById('form-title');
        const nameInput = document.querySelector('input[name="name"]');
        const pelamarFields = document.getElementById('pelamar-fields');

        // Saya hapus atribut 'required' dari field pelamar via JS
        const pelamarInputs = pelamarFields.querySelectorAll('input, select, textarea');

        function showForm(role) {
            roleInput.value = role;

            if (role === 'pelamar') {
                formTitle.innerText = 'Daftar Pelamar';
                nameInput.placeholder = 'Nama Lengkap';
                pelamarFields.style.display = 'block';
                // Set 'required' untuk field pelamar
                pelamarInputs.forEach(input => input.setAttribute('required', ''));
            } else {
                formTitle.innerText = 'Daftar Perusahaan';
                nameInput.placeholder = 'Nama Perusahaan';
                pelamarFields.style.display = 'none';
                // Hapus 'required' untuk field pelamar agar form perusahaan bisa disubmit
                pelamarInputs.forEach(input => input.removeAttribute('required'));
            }

            roleChoicePanel.style.display = 'none';
            formPanel.style.display = 'block';
        }

        function showRoleChoice() {
            formPanel.style.display = 'none';
            roleChoicePanel.style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            const hasErrors = body.getAttribute('data-has-errors') === 'true';
            const oldRole = body.getAttribute('data-old-role');

            if (hasErrors && oldRole) {
                showForm(oldRole);
            }
        });
    </script>
</body>
</html>