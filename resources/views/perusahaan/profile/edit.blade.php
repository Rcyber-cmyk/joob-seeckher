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
            color: #1a202c;  /* Much darker gray for better contrast */
        }
        .main-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
        }
        .profile-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            display: flex;
            gap: 2.5rem;
            width: 100%;
            max-width: 1200px;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .sidebar {
            flex: 0 0 350px;
            background: linear-gradient(to bottom, #ffffff, #f0f4f8);
            border-left: 5px solid #4fd1c5;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .profile-image-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
        }
        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #4299e1;
        }
        .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: #ff7a00;
            color: white;
            border-radius: 50%;
            padding: 5px;
            font-size: 0.8rem;
            cursor: pointer;
        }
        .user-info h4 {
            font-weight: 700;
            color: #212529;
            margin-bottom: 0.25rem;
        }
        .user-info p {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .main-form-content {
            flex-grow: 1;
        }
        .form-section-title {
            font-weight: 700;
            color: #3182ce;
            border-bottom: 3px solid #63b3ed;
            padding-bottom: 0.5rem;
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
            border: 1px solid #a0aec0;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #ff7a00;
            box-shadow: 0 0 0 0.25rem rgba(255, 122, 0, 0.25);
        }
        .form-control[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        .btn-orange {
            background: linear-gradient(to right, #4299e1, #3182ce, #2c5282);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-orange:hover {
            background: linear-gradient(to right, #5a67d8, #6b46c1);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            border-radius: 8px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            border-radius: 8px;
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
    </style>
</head>
<body>
    <div class="main-container">
        <div class="profile-card">
            <div class="sidebar">
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
                <div class="mt-4">
                    <a href="{{ route('perusahaan.dashboard') }}" class="btn btn-navy w-100">Kembali ke Homepage</a>
                </div>
                <form id="uploadLogoForm" action="{{ route('perusahaan.profile.upload_logo') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <input type="file" name="logo" id="uploadLogo" accept="image/*" onchange="document.getElementById('uploadLogoForm').submit()">
                </form>
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
