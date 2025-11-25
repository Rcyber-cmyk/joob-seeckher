<?php
// FILE: resources/views/admin/perusahaan/show.blade.php
// Menampilkan detail lowongan dan daftar pelamar yang dijadwalkan wawancara.
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jadwal Lowongan: {{ $lowongan->judul_lowongan ?? 'N/A' }} | {{ $lowongan->perusahaan->nama_perusahaan ?? 'N/A' }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === CSS UTAMA (KONSISTEN) === */
        :root {
            --orange: #f97316; --orange-dark: #ea580c; --dark-blue: #0f172a; 
            --slate: #475569; --slate-light: #94a3b8; --bg-main: #f1f5f9; 
            --white: #ffffff; --default-border-radius: 1rem;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --border-color: #e2e8f0; 
        }
        
        body { 
            background-color: var(--bg-main); 
            font-family: 'Poppins', sans-serif; 
            color: var(--dark-blue); 
            overflow-x: hidden; 
        }
        
        /* Layout & Wrapper */
        .main-content { padding: 2.5rem; }
        .card-base { 
            background-color: var(--white); 
            border-radius: var(--default-border-radius); 
            padding: 2rem; 
            border: 1px solid var(--border-color); 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03); 
        }
        
        /* Gaya Khusus Detail */
        .detail-item { padding: 0.5rem 0; border-bottom: 1px dashed var(--border-color); }
        .detail-item:last-child { border-bottom: none; }
        .detail-label { font-weight: 600; color: var(--slate); font-size: 0.9rem; }
        
        /* Tabel Jadwal */
        .jadwal-table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0; 
            margin-top: 1rem; 
        }
        .jadwal-table th { 
            background-color: #e2e8f0; 
            padding: 0.75rem 1rem; 
            text-align: left; 
            font-size: 0.8rem; 
            color: var(--slate); 
            text-transform: uppercase; 
        }
        .jadwal-table td { 
            background-color: var(--white); 
            padding: 0.75rem 1rem; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 0.85rem; 
            vertical-align: middle; 
        }
        .jadwal-table tbody tr:last-child td { border-bottom: none; }

        .btn-action { 
            width: 38px; 
            height: 38px; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 0.5rem; 
            flex-shrink: 0; /* Penting agar tidak melar di tabel */
        }
        
        /* Badge Kustom Jadwal */
        .badge-terjadwal { background-color: #e0f2fe; color: #0284c7; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-selesai { background-color: #d1fae5; color: #059669; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-dibatalkan { background-color: #fee2e2; color: #dc2626; font-weight: 600; padding: 0.4em 0.7em; }
        .badge-pending { background-color: #fffbeb; color: #d97706; font-weight: 600; padding: 0.4em 0.7em; }

        /* Badge Status Evaluasi */
        .badge-sudah_diisi { background-color: #e6ffed; color: #2d995b; }
        .badge-terkirim { background-color: #e0f2fe; color: #0284c7; }
        .badge-belum_diisi { background-color: #ffe6e6; color: #e53e3e; }
        .badge-n_a { background-color: #e2e8f0; color: #475569; }
        .badge-ditolak { background-color: #fee2e2; color: #dc2626; }

        /* Mobile View Jadwal */
        @media (max-width: 767.98px) {
            .main-content { padding: 1.5rem; }
            .jadwal-table { display: none; }
            .jadwal-card-mobile {
                background-color: var(--white);
                border: 1px solid #e2e8f0;
                border-radius: var(--default-border-radius);
                padding: 1rem;
                margin-bottom: 1rem;
            }
            .jadwal-card-mobile div:not(.mt-3):before { 
                content: attr(data-label);
                display: inline-block;
                width: 100px; 
                font-weight: 500;
                color: var(--slate);
                font-size: 0.8rem;
                flex-shrink: 0;
            }
            .jadwal-card-mobile div:not(.mt-3) {
                display: flex;
                align-items: baseline;
            }
        }
    </style>
    
    @php
        // FIX: Mendefinisikan mapping status PHP agar dapat digunakan di dalam loop Blade
        $statusClassMap = [
            'terjadwal' => 'badge-terjadwal',
            'selesai' => 'badge-selesai',
            'dibatalkan' => 'badge-dibatalkan', // FIX: Menggunakan 'dibatalkan' (sesuai status)
            'pending' => 'badge-pending',
        ];
        
        $formClassMap = [
            'sudah_diisi' => 'badge-sudah_diisi', // FIX: Menggunakan underscore untuk konsistensi
            'terkirim' => 'badge-terkirim', // Status baru: terkirim (menunggu diisi admin)
            'belum_diisi' => 'badge-belum_diisi',
            'n/a' => 'badge-n_a',
            'ditolak' => 'badge-ditolak',
        ];
    @endphp
</head>
<body>
    
    <main class="main-wrapper">
        <div class="main-content">
            
            <div class="d-flex align-items-center mb-4">
                {{-- FIX: Menggunakan route yang benar dan memastikan tombol kembali berfungsi --}}
                <a href="{{ route('admin.jadwalwawancara.index') }}" class="btn btn-outline-secondary me-3" title="Kembali ke Daftar Lowongan">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h2 class="h4 mb-0 fw-bold">Jadwal Wawancara Lowongan</h2>
                    <p class="text-secondary small mb-0">Detail Lowongan dan daftar pelamar yang dijadwalkan.</p>
                </div>
            </div>

            {{-- Alert Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-base mb-4">
                <h5 class="fw-bold mb-3 border-bottom pb-2">Detail Lowongan: {{ $lowongan->judul_lowongan ?? 'N/A' }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        {{-- FIX: Menambahkan safety check pada akses relasi dan properti --}}
                        <div class="detail-item"><span class="detail-label">Perusahaan:</span> {{ $lowongan->perusahaan->nama_perusahaan ?? 'N/A' }}</div>
                        <div class="detail-item"><span class="detail-label">Domisili:</span> {{ $lowongan->domisili ?? 'N/A' }}</div>
                        <div class="detail-item"><span class="detail-label">Pendidikan Min.:</span> {{ $lowongan->pendidikan_terakhir ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-item"><span class="detail-label">Tipe Pekerjaan:</span> {{ $lowongan->tipe_pekerjaan ?? 'N/A' }}</div>
                        <div class="detail-item"><span class="detail-label">Usia Min.:</span> {{ $lowongan->usia_min ?? 0 }} tahun</div>
                        <div class="detail-item"><span class="detail-label">Pengalaman Maks.:</span> {{ $lowongan->pengalaman_kerja_maks ?? 0 }} tahun</div>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="detail-label d-block mb-1">Deskripsi Pekerjaan:</span>
                    <p class="small text-muted">{{ $lowongan->deskripsi_pekerjaan ?? '-' }}</p>
                </div>
            </div>

            <div class="card-base p-0">
                <div class="p-4 border-bottom">
                    {{-- FIX: Menggunakan count($jadwals) secara aman --}}
                    <h5 class="mb-0 fw-semibold">Daftar Pelamar Wawancara (Total: {{ $jadwals ? count($jadwals) : 0 }})</h5>
                </div>
                
                {{-- Konten Jadwal --}}
                <div class="p-4 table-responsive">
                    {{-- Menggunakan if check yang lebih aman --}}
                    @if(isset($jadwals) && count($jadwals) > 0)
                        
                        {{-- Tampilan Desktop/Tablet --}}
                        <div class="d-none d-md-block">
                            <table class="jadwal-table">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;">Pelamar</th>
                                        <th style="width: 20%;">Tanggal & Waktu</th>
                                        <th style="width: 15%;">Metode</th>
                                        <th style="width: 15%;">Status Jadwal</th>
                                        <th style="width: 15%;">Status Evaluasi</th>
                                        <th style="width: 10%;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwals as $jadwal)
                                        @php
                                            // Handling missing related data safely
                                            $pelamar = $jadwal->pelamar ?? (object)['nama_lengkap' => 'Pelamar Dihapus', 'user' => (object)['email' => 'Email N/A']];
                                            $email = $pelamar->user->email ?? 'Email N/A';

                                            // Normalisasi status untuk pencocokan class
                                            $formStatus = $jadwal->form_status ?? 'N/A'; 
                                            $formStatusKey = strtolower(str_replace([' ', '/'], ['_', '_'], $formStatus)); // Mengganti spasi dan / dengan underscore
                                            $jadwalStatusKey = strtolower($jadwal->status ?? 'pending');

                                            // Menggunakan mapping yang sudah didefinisikan
                                            $jadwalStatusClass = $statusClassMap[$jadwalStatusKey] ?? 'badge-pending';
                                            $formStatusClass = $formClassMap[$formStatusKey] ?? 'badge-n_a';
                                        @endphp
                                        <tr>
                                            <td>
                                                {{-- FIX: Memastikan $pelamar memiliki properti nama_lengkap --}}
                                                <strong class="d-block">{{ $pelamar->nama_lengkap ?? 'Pelamar Dihapus' }}</strong>
                                                <small class="text-muted">{{ $email }}</small>
                                            </td>
                                            <td>
                                                {{-- FIX: Memastikan data tanggal/waktu ada sebelum di-format --}}
                                                <strong class="d-block">
                                                    {{ $jadwal->tanggal_interview ? \Carbon\Carbon::parse($jadwal->tanggal_interview)->isoFormat('D MMM YYYY') : 'N/A' }}
                                                </strong>
                                                <small class="text-muted">
                                                    {{ $jadwal->waktu_interview ? \Carbon\Carbon::parse($jadwal->waktu_interview)->format('H:i') . ' WIB' : 'N/A' }}
                                                </small>
                                            </td>
                                            <td>
                                                <strong class="d-block">{{ $jadwal->metode_wawancara ?? 'N/A' }}</strong>
                                                <small class="text-muted">
                                                    @if (($jadwal->metode_wawancara ?? '') === 'Virtual Interview')
                                                        {{-- FIX: Menambahkan safety check pada link_zoom --}}
                                                        @if ($jadwal->link_zoom)
                                                            <a href="{{ $jadwal->link_zoom }}" target="_blank" class="small">Link Zoom</a>
                                                        @else
                                                            Link tidak tersedia
                                                        @endif
                                                    @else
                                                        {{-- FIX: Menambahkan safety check pada lokasi_interview --}}
                                                        {{ \Illuminate\Support\Str::limit($jadwal->lokasi_interview ?? 'Lokasi fisik', 20) }}
                                                    @endif
                                                </small>
                                            </td>
                                            <td>
                                                {{-- Menggunakan status yang sudah dinormalisasi --}}
                                                <span class="badge rounded-pill {{ $jadwalStatusClass }}">{{ ucfirst($jadwal->status ?? 'Pending') }}</span>
                                            </td>
                                            <td>
                                                {{-- Menggunakan status formulir yang sudah dinormalisasi --}}
                                                <span class="badge rounded-pill {{ $formStatusClass }}">{{ $formStatus }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{-- Tombol aksi --}}
                                                @if ($formStatusKey === 'sudah_diisi')
                                                    {{-- Tombol Lihat/Edit Evaluasi Admin (Sudah Ada Hasil) --}}
                                                    <a href="{{ route('admin.jadwalwawancara.form.edit', $jadwal->id) }}" 
                                                        class="btn btn-sm btn-success text-white btn-action" title="Lihat/Edit Evaluasi">
                                                        <i class="bi bi-file-text-fill"></i>
                                                    </a>
                                                @else
                                                    {{-- TOMBOL BARU: Arahkan ke Halaman Form Input Admin --}}
                                                    <a href="{{ route('admin.jadwalwawancara.form.edit', $jadwal->id) }}" 
                                                        class="btn btn-sm btn-primary text-white btn-action" title="Isi Hasil / Atur Formulir">
                                                        <i class="bi bi-file-earmark-text-fill"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- Tampilan Mobile (Stacked Cards) --}}
                        <div class="d-md-none">
                            @foreach ($jadwals as $jadwal)
                                @php
                                    // Menggunakan ulang variabel status
                                    $pelamar = $jadwal->pelamar ?? (object)['nama_lengkap' => 'Pelamar Dihapus', 'user' => (object)['email' => 'Email N/A']];
                                    $email = $pelamar->user->email ?? 'Email N/A';

                                    $formStatus = $jadwal->form_status ?? 'N/A';
                                    $formStatusKey = strtolower(str_replace([' ', '/'], ['_', '_'], $formStatus));
                                    $jadwalStatusKey = strtolower($jadwal->status ?? 'pending');
                                    
                                    $jadwalStatusClass = $statusClassMap[$jadwalStatusKey] ?? 'badge-pending';
                                    $formStatusClass = $formClassMap[$formStatusKey] ?? 'badge-n_a';
                                @endphp
                                <div class="jadwal-card-mobile mb-3">
                                    <strong class="d-flex justify-content-between mb-2">
                                        <span>{{ $pelamar->nama_lengkap ?? 'Pelamar Dihapus' }}</span>
                                        <span class="badge rounded-pill {{ $jadwalStatusClass }}">{{ ucfirst($jadwal->status ?? 'Pending') }}</span>
                                    </strong>
                                    
                                    <div data-label="Email:"><small class="text-muted">{{ $email }}</small></div>
                                    <div data-label="Tanggal:">
                                        {{ $jadwal->tanggal_interview ? \Carbon\Carbon::parse($jadwal->tanggal_interview)->isoFormat('D MMM YYYY') : 'N/A' }}, 
                                        {{ $jadwal->waktu_interview ? \Carbon\Carbon::parse($jadwal->waktu_interview)->format('H:i') . ' WIB' : 'N/A' }}
                                    </div>
                                    <div data-label="Metode:">{{ $jadwal->metode_wawancara ?? 'N/A' }}</div>
                                    <div data-label="Formulir:">
                                        <span class="badge rounded-pill {{ $formStatusClass }}">{{ $formStatus }}</span>
                                    </div>
                                    
                                    <div class="mt-3 text-center">
                                        @if ($formStatusKey === 'sudah_diisi')
                                            {{-- Tombol Lihat/Edit Isian --}}
                                            <a href="{{ route('admin.jadwalwawancara.form.edit', $jadwal->id) }}" class="btn btn-sm btn-success text-white btn-action" title="Lihat/Edit Isian Formulir">
                                                <i class="bi bi-file-text-fill"></i>
                                            </a>
                                        @else
                                            {{-- TOMBOL BARU: Arahkan ke Halaman Form Input Admin --}}
                                            <a href="{{ route('admin.jadwalwawancara.form.edit', $jadwal->id) }}" 
                                                class="btn btn-sm btn-primary text-white btn-action" title="Isi Hasil / Atur Formulir">
                                                <i class="bi bi-file-earmark-text-fill"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @else
                        <div class="text-center text-muted py-3">
                            <i class="bi bi-person-x fs-3 d-block mb-2"></i>
                            <span>Belum ada pelamar yang dijadwalkan wawancara untuk lowongan ini.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>