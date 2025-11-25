<?php
// FILE: resources/views/admin/jadwalwawancara/form_input_admin.blade.php
// Halaman untuk Admin menginput atau mengedit hasil evaluasi wawancara untuk seorang pelamar.
// Bagian Edit Template Pertanyaan TELAH DIHAPUS untuk menghindari error RouteNotDefinedException.
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($formSubmission->exists ?? false) ? 'Edit Evaluasi' : 'Input Evaluasi Baru' }} | {{ $jadwal->pelamar->nama_lengkap ?? 'N/A' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { 
            background-color: #f1f5f9; 
            font-family: 'Poppins', sans-serif; 
            color: #0f172a; /* dark-blue */
        }
        .card-base { 
            background: white; 
            border-radius: 1rem; 
            padding: 2rem; 
            border: 1px solid #e2e8f0; 
            margin-bottom: 2rem; 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03); 
        }
        .main-content { 
            max-width: 800px; 
            margin: 30px auto; 
            padding: 0 15px;
        }
        .btn-kirim-link { 
            border: 1px solid #0d6efd; 
            color: #0d6efd; 
            background-color: transparent; 
        }
        .btn-kirim-link:hover { 
            color: white; 
            background-color: #0d6efd; 
        }
        .question-group { 
            padding: 1.5rem; 
            border: 1px solid #e2e8f0; 
            border-radius: 0.5rem; 
            margin-bottom: 1rem; 
            background-color: #fafafa;
        }
    </style>
</head>
<body>
    @php
        // =======================================================================
        // MEMUAT DATA PERTANYAAN (DINAMIS DARI LOWONGAN)
        // =======================================================================
        
        // Template default jika lowongan belum memiliki template form_template.
        $defaultFormTemplate = [
            [
                'id' => 'skor_wawancara', 
                'label' => 'Skor Evaluasi Wawancara (0 - 100)', 
                'type' => 'number', 
                'placeholder' => 'Contoh: 85',
                'min' => 0,
                'max' => 100,
            ],
            [
                'id' => 'kecocokan_budaya', 
                'label' => 'Kecocokan dengan Budaya Perusahaan', 
                'type' => 'radio', 
                'options' => ['Sangat Cocok', 'Cocok', 'Perlu Penyesuaian', 'Tidak Cocok'],
            ],
            [
                'id' => 'catatan_kekuatan', 
                'label' => 'Kekuatan Utama Kandidat', 
                'type' => 'textarea', 
                'placeholder' => 'Catatan detail mengenai kekuatan utama pelamar...',
            ],
            [
                'id' => 'catatan_kelemahan', 
                'label' => 'Area Peningkatan Kandidat', 
                'type' => 'textarea', 
                'placeholder' => 'Catatan detail mengenai area yang perlu ditingkatkan...',
            ],
            [
                'id' => 'gaji_ditawarkan',
                'label' => 'Gaji yang Ditawarkan (Opsional)',
                'type' => 'text',
                'placeholder' => 'Contoh: Rp 5.000.000',
            ],
        ];

        // Memuat template dari data lowongan. Jika tidak ada, gunakan template default.
        $formTemplateJson = $jadwal->lowongan->form_template ?? json_encode($defaultFormTemplate, JSON_PRETTY_PRINT);
        $formQuestions = json_decode($formTemplateJson, true) ?? $defaultFormTemplate;

        // Mendapatkan data isian sebelumnya, jika ada (dari kolom evaluation_data)
        $previousData = json_decode($formSubmission->evaluation_data ?? '{}', true);
        
        // Fallback untuk data gaji ditawarkan lama (dari kolom data_tambahan_pelamar)
        $gajiDitawarkanOld = $formSubmission->data_tambahan_pelamar['gaji_ditawarkan'] ?? '';
    @endphp
    
    <div class="main-content">
        <div class="d-flex align-items-center mb-4">
            {{-- Menggunakan safety check untuk lowongan_id --}}
            <a href="{{ route('admin.jadwalwawancara.show', $jadwal->lowongan_id ?? '#') }}" class="btn btn-outline-secondary me-3" title="Kembali ke Detail Lowongan">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="h4 mb-0 fw-bold">{{ ($formSubmission->exists ?? false) ? 'Edit Hasil Evaluasi' : 'Input Hasil Evaluasi Baru' }}</h2>
                <p class="text-secondary small mb-0">
                    Pelamar: <strong>{{ $jadwal->pelamar->nama_lengkap ?? 'N/A' }}</strong> untuk Lowongan: <strong>{{ $jadwal->lowongan->judul_lowongan ?? 'N/A' }}</strong>
                </p>
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
        
        {{-- CARD FORM INPUT ADMIN (Dinamis dari template lowongan) --}}
        <div class="card-base">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Formulir Evaluasi Wawancara (Isi Hasil)</h5>
            
            <form action="{{ route('admin.jadwalwawancara.form.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT') 
                
                <div class="alert alert-info small">
                    Isi formulir di bawah ini berdasarkan template pertanyaan Lowongan yang saat ini aktif.
                </div>

                {{-- LOOP UNTUK MERENDER PERTANYAAN DINAMIS --}}
                @foreach ($formQuestions as $question)
                    @php
                        $inputId = $question['id'];
                        // Ambil nilai lama dari input dinamis, utamakan old(), lalu data sebelumnya
                        $oldValue = old('evaluation_data.' . $inputId);
                        if (empty($oldValue)) {
                            $oldValue = $previousData[$inputId] ?? '';
                        }

                        // Kasus khusus Gaji Ditawarkan (untuk kompatibilitas mundur jika data belum dipindahkan)
                        if ($inputId === 'gaji_ditawarkan' && empty($oldValue)) {
                            $oldValue = $gajiDitawarkanOld;
                        }
                    @endphp

                    <div class="mb-3 question-group">
                        <label for="{{ $inputId }}" class="form-label fw-semibold mb-2">
                            {{ $question['label'] }}
                        </label>

                        @if ($question['type'] === 'textarea')
                            <textarea class="form-control @error('evaluation_data.' . $inputId) is-invalid @enderror" 
                                id="{{ $inputId }}" name="evaluation_data[{{ $inputId }}]" rows="4" 
                                placeholder="{{ $question['placeholder'] ?? '' }}">{{ $oldValue }}</textarea>

                        @elseif ($question['type'] === 'number')
                            <input type="number" class="form-control @error('evaluation_data.' . $inputId) is-invalid @enderror" 
                                id="{{ $inputId }}" name="evaluation_data[{{ $inputId }}]" 
                                value="{{ $oldValue }}" 
                                placeholder="{{ $question['placeholder'] ?? '' }}"
                                min="{{ $question['min'] ?? '' }}"
                                max="{{ $question['max'] ?? '' }}">

                        @elseif ($question['type'] === 'radio' && isset($question['options']))
                            <div>
                                @foreach ($question['options'] as $option)
                                    @php $optionId = $inputId . '_' . strtolower(str_replace(' ', '_', $option)); @endphp
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="evaluation_data[{{ $inputId }}]" 
                                            id="{{ $optionId }}" value="{{ $option }}" 
                                            {{ $oldValue === $option ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $optionId }}">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        
                        @else {{-- Default: type text --}}
                            <input type="text" class="form-control @error('evaluation_data.' . $inputId) is-invalid @enderror" 
                                id="{{ $inputId }}" name="evaluation_data[{{ $inputId }}]" 
                                value="{{ $oldValue }}" 
                                placeholder="{{ $question['placeholder'] ?? '' }}">
                        @endif

                        {{-- Perlu penanganan error di controller untuk validasi isian dinamis --}}
                        @error('evaluation_data.' . $inputId)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                {{-- AKHIR LOOP PERTANYAAN DINAMIS --}}

                <hr class="my-4">

                {{-- BAGIAN REKOMENDASI STATIS (Keputusan Akhir) --}}
                <div class="mb-4">
                    <label for="rekomendasi" class="form-label fw-semibold">Rekomendasi Keputusan Akhir:</label>
                    {{-- Menggunakan safety check $formSubmission->rekomendasi --}}
                    <select class="form-select @error('rekomendasi') is-invalid @enderror" id="rekomendasi" name="rekomendasi" required>
                        {{-- Simpan rekomendasi saat ini jika ada, default ke string kosong jika null --}}
                        @php $currentRekomendasi = old('rekomendasi', $formSubmission->rekomendasi ?? ''); @endphp

                        <option value="Pertimbangkan" {{ $currentRekomendasi == 'Pertimbangkan' ? 'selected' : '' }}>Pertimbangkan (Status Jadwal TETAP Terjadwal)</option>
                        <option value="Lolos" {{ $currentRekomendasi == 'Lolos' ? 'selected' : '' }}>Lolos (Ganti Status ke Diterima/Offer)</option>
                        <option value="Tolak" {{ $currentRekomendasi == 'Tolak' ? 'selected' : '' }}>Ditolak (Ganti Status ke Ditolak)</option>
                    </select>
                    @error('rekomendasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-save me-2"></i> Simpan Hasil Evaluasi
                    </button>
                </div>
            </form>
        </div>

        
        {{-- CARD UNTUK MENGIRIM LINK (Aksi Terpisah) --}}
        <div class="card-base">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Opsi Tambahan: Kirim Link ke Pelamar</h5>
            <p class="text-muted small">Gunakan opsi ini jika Anda ingin Pelamar mengisi formulir ini sendiri (misal: *self-assessment* atau formulir data final) melalui *link* unik yang dikirim via email.</p>
            
            <form action="{{ route('admin.jadwalwawancara.form.kirim.link', $jadwal->id) }}" method="POST">
                @csrf
                <div class="d-grid">
                    <button type="submit" class="btn btn-kirim-link btn-lg">
                        <i class="bi bi-send-fill me-2"></i> Kirim Link Formulir ke Email Pelamar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>