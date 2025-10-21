<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Profil Pelamar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --orange: #f97316;
            --dark-blue: #1e293b;
            --slate: #64748b;
            --light-gray: #f1f5f9;
            --white: #ffffff;
        }
        body {
            background-color: var(--light-gray);
            font-family: 'Poppins', sans-serif;
        }
        .profile-header {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #334155 100%);
            color: var(--white);
            padding: 3rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        .profile-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--orange);
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .profile-card {
            background: var(--white);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        .section-title {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--orange);
            display: inline-block;
        }
        .info-list {
            list-style: none;
            padding: 0;
        }
        .info-list li {
            display: flex;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid #eef2f7;
            font-size: 0.95rem;
        }
        .info-list li:last-child {
            border-bottom: none;
        }
        .info-list i {
            color: var(--orange);
            font-size: 1.2rem;
            width: 30px;
            text-align: center;
            margin-right: 1.5rem;
        }
        .info-list .label {
            color: var(--slate);
            width: 150px;
        }
        .info-list .value {
            color: var(--dark-blue);
            font-weight: 500;
        }
        .skill-badge {
            background-color: #eef2f7;
            color: var(--dark-blue);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        .skill-badge:hover {
            background-color: var(--orange);
            color: var(--white);
        }
        .btn-back {
            background-color: rgba(255,255,255,0.1);
            color: var(--white);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .btn-back:hover {
            background-color: rgba(255,255,255,0.2);
            color: var(--white);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            
            <div class="profile-header text-center text-md-start">
                <div class="row align-items-center">
                    <div class="col-md-auto mb-4 mb-md-0">
                        <img src="{{ $pelamar->profilePelamar->foto_profil ? asset('storage/' . $pelamar->profilePelamar->foto_profil) : 'https://placehold.co/120x120/f97316/ffffff?text=' . substr($pelamar->name, 0, 1) }}" alt="Avatar Pelamar" class="profile-avatar">
                    </div>
                    <div class="col-md">
                        <h1 class="mb-1 display-5 fw-bold">{{ $pelamar->profilePelamar->nama_lengkap }}</h1>
                        <p class="mb-2 fs-5 text-white-50">{{ $pelamar->email }}</p>
                        <p class="mb-0"><i class="bi bi-geo-alt-fill"></i> Tinggal di {{ $pelamar->profilePelamar->domisili }}</p>
                    </div>
                    <div class="col-md-auto mt-4 mt-md-0">
                        {{-- ======================= TOMBOL KEMBALI DIPERBARUI ======================= --}}
                        <a href="{{ route('admin.pelamar.ranking') }}" class="btn btn-back rounded-pill px-4"><i class="bi bi-arrow-left me-2"></i> Kembali ke Ranking</a>
                        {{-- ======================= AKHIR PERUBAHAN ======================= --}}
                    </div>
                </div>
            </div>

            <div class="profile-card">
                <div class="row">
                    <div class="col-lg-7">
                        <h3 class="section-title">Informasi Pribadi</h3>
                        <ul class="info-list">
                            <li><i class="bi bi-person-badge"></i><span class="label">Nama Lengkap</span> <span class="value">{{ $pelamar->profilePelamar->nama_lengkap }}</span></li>
                            <li><i class="bi bi-calendar-event"></i><span class="label">Tanggal Lahir</span> <span class="value">{{ \Carbon\Carbon::parse($pelamar->profilePelamar->tanggal_lahir)->format('d F Y') }} ({{ \Carbon\Carbon::parse($pelamar->profilePelamar->tanggal_lahir)->age }} tahun)</span></li>
                            <li><i class="bi bi-gender-ambiguous"></i><span class="label">Gender</span> <span class="value">{{ $pelamar->profilePelamar->gender }}</span></li>
                            <li><i class="bi bi-telephone"></i><span class="label">No. HP</span> <span class="value">{{ $pelamar->profilePelamar->no_hp }}</span></li>
                            <li><i class="bi bi-house"></i><span class="label">Alamat</span> <span class="value">{{ $pelamar->profilePelamar->alamat }}</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-5 mt-5 mt-lg-0">
                        <h3 class="section-title">Informasi Akademik & Profesional</h3>
                        <ul class="info-list">
                            <li><i class="bi bi-mortarboard"></i><span class="label">Pendidikan</span> <span class="value">{{ $pelamar->profilePelamar->lulusan }}</span></li>
                            <li><i class="bi bi-calendar-check"></i><span class="label">Tahun Lulus</span> <span class="value">{{ $pelamar->profilePelamar->tahun_lulus }}</span></li>
                            <li><i class="bi bi-journal-check"></i><span class="label">Nilai Akhir</span> <span class="value">{{ $pelamar->profilePelamar->nilai_akhir ?? 'Tidak diisi' }}</span></li>
                            <li><i class="bi bi-briefcase"></i><span class="label">Pengalaman</span> <span class="value">{{ $pelamar->profilePelamar->pengalaman_kerja ?? 'Tidak diisi' }}</span></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-5">
                     <h3 class="section-title">Tentang Saya</h3>
                     <p class="text-secondary">
                        {{ $pelamar->profilePelamar->tentang_saya ?? 'Pelamar belum mengisi deskripsi diri.' }}
                     </p>
                </div>
                
                <div class="mt-5">
                    <h3 class="section-title">Keahlian</h3>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse ($pelamar->profilePelamar->keahlian as $skill)
                            <span class="skill-badge">{{ $skill->nama_keahlian }}</span>
                        @empty
                            <p class="text-secondary">Pelamar belum menambahkan keahlian.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

