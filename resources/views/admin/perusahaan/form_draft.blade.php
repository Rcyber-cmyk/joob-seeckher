{{-- resources/views/admin/perusahaan/form_draft.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draft Formulir: {{ $jadwal->pelamar->nama_lengkap ?? 'N/A' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f1f5f9; font-family: 'Poppins', sans-serif; }
        .card-base { background: white; border-radius: 1rem; padding: 2rem; border: 1px solid #e2e8f0; margin-bottom: 2rem; }
        .main-content { max-width: 900px; margin: 30px auto; }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.jadwalwawancara.show', $jadwal->lowongan_id) }}" class="btn btn-outline-secondary me-3" title="Kembali">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="h4 mb-0 fw-bold">Draft Formulir Wawancara</h2>
                <p class="text-secondary small mb-0">Edit subjek dan isi pesan sebelum dikirim ke <strong>{{ $jadwal->pelamar->user->email ?? 'N/A' }}</strong>.</p>
            </div>
        </div>

        <div class="card-base">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Detail Pengiriman</h5>

            <form action="{{ route('admin.jadwalwawancara.form.send.final', $jadwal->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="subject" class="form-label fw-semibold">Subjek Email:</label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject', $defaultSubject) }}" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label fw-semibold">Isi Pesan Email (Surat Pengantar):</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="10" required>{{ old('body', $defaultBody) }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="alert alert-info small mt-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    **Penting:** Link pengisian formulir yang unik akan otomatis diinjeksikan dan dikirimkan bersama isi pesan ini.
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-envelope-fill me-2"></i> Kirim Final ke Email Pelamar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>