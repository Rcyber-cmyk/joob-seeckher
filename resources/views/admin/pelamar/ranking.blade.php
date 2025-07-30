<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Ranking - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        :root {
            --orange: #f97316;
            --dark-blue: #1e293b;
            --slate: #64748b;
            --light-gray: #f1f5f9;
            --navy: #0f172a;
        }
        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', sans-serif;
        }
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 260px;
            background-color: var(--orange);
            color: white;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .sidebar .logo {
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
        }
        .sidebar .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: white;
            color: var(--orange);
        }
        .sidebar .user-profile {
            margin-top: auto;
            display: flex;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        .main-wrapper {
            flex-grow: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        .table-card, .criteria-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .progress {
            height: 8px;
        }
        .progress-bar {
            width: var(--progress-width, 0%);
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">Job Recruitment</div>
            <nav class="nav flex-column">
                <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
                <a class="nav-link" href="#"><i class="bi bi-building-fill"></i> Perusahaan</a>
                <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
                <a class="nav-link" href="#"><i class="bi bi-bell-fill"></i> Notifikasi</a>
                <a class="nav-link" href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
                <a class="nav-link" href="#"><i class="bi bi-question-circle-fill"></i> Bantuan</a>

                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>
            </nav>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            <div class="user-profile">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="User">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small>Admin</small>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-wrapper">
            <header class="mb-5">
                <h2>Auto <span style="color: var(--orange);">Ranking</span></h2>
                <p class="text-secondary">Lihat pelamar dengan mudah berdasarkan kecocokan lowongan.</p>
            </header>

            <!-- Form untuk memilih lowongan -->
            <div class="card p-3 mb-4">
                <form action="{{ route('admin.pelamar.ranking') }}" method="GET">
                    <div class="mb-2">
                        <label for="lowongan_id" class="form-label fw-bold">Lowongan yang Dianalisis:</label>
                        <select name="lowongan_id" id="lowongan_id" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Pilih Lowongan --</option>
                            @foreach($lowonganList as $lowongan)
                                <option value="{{ $lowongan->id }}" {{ optional($selectedLowongan)->id == $lowongan->id ? 'selected' : '' }}>
                                    {{ $lowongan->judul_lowongan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            @if($selectedLowongan)
                <!-- Tampilkan Kriteria Penilaian Utama -->
                <div class="criteria-card p-4 mb-5">
                    <h5 class="mb-4">Kriteria Penilaian Utama</h5>
                    <div class="row g-3">
                        <div class="col-md-4"><i class="bi bi-briefcase-fill me-2 text-primary"></i><strong>Pengalaman Kerja:</strong> {{ $selectedLowongan->pengalaman_minimal ?? 'Tidak ditentukan' }}</div>
                        <div class="col-md-4"><i class="bi bi-mortarboard-fill me-2 text-primary"></i><strong>Edukasi:</strong> {{ $selectedLowongan->edukasi_minimal ?? 'Tidak ditentukan' }}</div>
                        <div class="col-md-4"><i class="bi bi-tools me-2 text-primary"></i><strong>Keahlian Wajib:</strong> {{ $selectedLowongan->keahlianDibutuhkan->pluck('nama_keahlian')->join(', ') }}</div>
                    </div>
                </div>

                <!-- Tabel Peringkat Pelamar -->
                <div class="table-card">
                    <h5 class="mb-4">Peringkat Pelamar</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Nama Pelamar</th>
                                    <th>Skor Akhir</th>
                                    <th>Kecocokan Pengalaman</th>
                                    <th>Kecocokan Keahlian</th>
                                    <th>Kecocokan Edukasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rankedPelamar as $index => $pelamar)
                                    <tr>
                                        <td><span class="badge bg-dark fs-6">#{{ $index + 1 }}</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://placehold.co/40x40/f1f5f9/1e293b?text={{ substr($pelamar->name, 0, 1) }}" class="rounded-circle me-3" alt="Avatar">
                                                <div>
                                                    <div class="fw-bold">{{ $pelamar->name }}</div>
                                                    <small class="text-muted">{{ $pelamar->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold fs-5" style="color: var(--dark-blue);">{{ round($pelamar->final_score) }}%</div>
                                            <div class="progress mt-1" role="progressbar">
                                                <div class="progress-bar bg-success" style="--progress-width: {{ round($pelamar->final_score) }}%;"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge {{ $pelamar->match_details['pengalaman']['score'] > 50 ? 'text-bg-success' : 'text-bg-danger' }}">{{ $pelamar->match_details['pengalaman']['text'] }}</span></td>
                                        <td><span class="badge {{ $pelamar->match_details['keahlian']['score'] > 50 ? 'text-bg-success' : 'text-bg-warning' }}">{{ $pelamar->match_details['keahlian']['text'] }}</span></td>
                                        <td><span class="badge {{ $pelamar->match_details['edukasi']['score'] > 50 ? 'text-bg-success' : 'text-bg-danger' }}">{{ $pelamar->match_details['edukasi']['text'] }}</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Lihat Detail Pelamar</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <p>Tidak ada data pelamar untuk ditampilkan atau belum ada pelamar yang melamar.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="text-center text-muted py-5">
                    <i class="bi bi-search fs-1"></i>
                    <h5 class="mt-3">Mulai Analisis Peringkat</h5>
                    <p>Silakan pilih lowongan pekerjaan di atas untuk memulai analisis peringkat otomatis.</p>
                </div>
            @endif
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
