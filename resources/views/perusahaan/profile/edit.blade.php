<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Perusahaan - Messari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            color: #1a202c;
        }
        .main-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background: #e9eff5; /* Warna latar belakang yang lebih kalem */
        }
        .profile-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1); /* Bayangan lebih halus */
            padding: 3rem;
            display: flex;
            gap: 3rem;
            width: 100%;
            max-width: 1200px;
            border: none;
        }
        .sidebar {
            flex: 0 0 320px;
            background-color: #f7f9fc; /* Warna background sidebar yang lebih terang */
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid #e0e6ed;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-image-container {
            position: relative;
            width: 150px; /* Ukuran foto lebih besar */
            height: 150px;
            margin: 0 auto 1.5rem;
        }
        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #ff7a00; /* Border dengan warna yang menonjol */
        }
        .edit-icon {
            position: absolute;
            bottom: 0;
            right: 15px;
            background-color: #ff7a00;
            color: white;
            border-radius: 50%;
            padding: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .edit-icon:hover {
            background-color: #e66a00;
            transform: scale(1.1);
        }
        .user-info h4 {
            font-weight: 700;
            color: #212529;
            margin-bottom: 0.25rem;
            font-size: 1.5rem;
        }
        .user-info p {
            font-size: 1rem;
            color: #6c757d;
        }
        .user-info hr {
            margin: 1.5rem 0;
        }
        .main-form-content {
            flex-grow: 1;
        }
        .form-section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff7a00; /* Warna utama yang konsisten */
            border-bottom: 2px solid #ff7a00;
            padding-bottom: 0.75rem;
            margin-bottom: 2rem;
            letter-spacing: 0.5px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #e0e6ed;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #ff7a00;
            box-shadow: 0 0 0 0.25rem rgba(255, 122, 0, 0.25);
        }
        .form-control[readonly] {
            background-color: #f1f5f9; /* Warna abu-abu yang lebih halus */
            cursor: not-allowed;
        }
        .btn-orange {
            background-color: #ff7a00;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-orange:hover {
            background-color: #e66a00;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }
        .btn-outline-primary {
            border-color: #ff7a00;
            color: #ff7a00;
        }
        .btn-outline-primary:hover {
            background-color: #ff7a00;
            color: white;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        /* Responsif */
        @media (max-width: 992px) {
            .profile-card {
                flex-direction: column;
                padding: 1.5rem;
            }
            .sidebar {
                flex: 1;
                margin-bottom: 2rem;
            }
            .form-control {
                font-size: 0.9rem;
            }
            .btn-orange {
                width: 100%;
                padding: 0.75rem;
            }
        }
        @media (max-width: 576px) {
            .profile-card {
                padding: 1rem;
            }
            .sidebar {
                padding: 1.5rem;
            }
            .profile-image-container {
                width: 120px;
                height: 120px;
            }
            .user-info h4 {
                font-size: 1.25rem;
            }
            .form-section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="profile-card">
            <div class="sidebar">
                <form id="uploadLogoForm" action="{{ route('perusahaan.profile.upload_logo') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" name="logo" id="uploadLogo" accept="image/*" onchange="this.form.submit()">
                </form>

                <div class="profile-image-container">
                    @if ($profile->logo_perusahaan)
                        <img src="{{ asset('storage/' . $profile->logo_perusahaan) }}" alt="Logo Perusahaan" class="profile-image">
                    @else
                        <img src="{{ asset('images/default-company-profile.png') }}" alt="Logo Default" class="profile-image">
                    @endif
                    <span class="edit-icon" onclick="document.getElementById('uploadLogo').click();">
                        <i class="bi-camera-fill"></i>
                    </span>
                </div>
                <div class="user-info">
                    <h4>{{ $profile->nama_perusahaan }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    <hr>
                    <p>
                        Kelengkapan Profil: <strong>{{ $profile->kelengkapan_profil }}%</strong>
                    </p>
                </div>
                <div class="mt-auto w-100">
                    <a href="{{ route('perusahaan') }}" class="btn btn-outline-primary w-100">Kembali ke Dashboard</a>
                </div>
            </div>

            <div class="main-form-content">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2 class="form-section-title">Profil Perusahaan</h2>
                <form action="{{ route('perusahaan.profile.update') }}" method="POST">
                    @csrf
                    @method('patch')

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $profile->nama_perusahaan) }}" readonly required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="npwp_perusahaan" class="form-label">NPWP Perusahaan</label>
                            <input type="text" class="form-control" id="npwp_perusahaan" name="npwp_perusahaan" value="{{ old('npwp_perusahaan', $profile->npwp_perusahaan) }}" readonly>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" readonly required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="no_telp_perusahaan" class="form-label">Nomor Telepon Perusahaan</label>
                            <input type="text" class="form-control" id="no_telp_perusahaan" name="no_telp_perusahaan" value="{{ old('no_telp_perusahaan', $profile->no_telp_perusahaan) }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="situs_web" class="form-label">Situs Web</label>
                            <input type="url" class="form-control" id="situs_web" name="situs_web" value="{{ old('situs_web', $profile->situs_web) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="alamat_jalan" class="form-label">Alamat Jalan</label>
                            <textarea class="form-control" id="alamat_jalan" name="alamat_jalan" rows="3">{{ old('alamat_jalan', $profile->alamat_jalan) }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="alamat_kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="alamat_kota" name="alamat_kota" value="{{ old('alamat_kota', $profile->alamat_kota) }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $profile->kode_pos) }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi Perusahaan</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $profile->deskripsi) }}</textarea>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-orange">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>