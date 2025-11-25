<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pasca-Wawancara | {{ $jadwal->lowongan->judul_lowongan ?? 'N/A' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f1f5f9; font-family: 'Poppins', sans-serif; }
        .form-container { max-width: 700px; margin: 50px auto; padding: 30px; background: white; border-radius: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <div class="form-container">
        <h3 class="mb-4 fw-bold text-center">Formulir Pasca-Wawancara</h3>
        <p class="text-center text-muted">Harap lengkapi formulir ini setelah wawancara Anda untuk posisi:</p>
        
        <div class="alert alert-info text-center">
            <strong>{{ $jadwal->lowongan->judul_lowongan ?? 'Lowongan Tidak Ditemukan' }}</strong>
            <br>
            <small>{{ $jadwal->lowongan->perusahaan->nama_perusahaan ?? 'N/A' }}</small>
        </div>

        <form action="{{ route('pelamar.form.submit') }}" method="POST">
            @csrf
            
            {{-- INPUT TERSEMBUNYI PENTING UNTUK VALIDASI --}}
            <input type="hidden" name="form_token" value="{{ $token }}">
            
            {{-- Peringatan --}}
            <div class="alert alert-warning small">
                Link ini akan kedaluwarsa pada **{{ Carbon::parse($jadwal->token_expires_at)->isoFormat('dddd, D MMMM YYYY H:m') }}** WIB.
            </div>

            <hr>
            
            {{-- Isi Formulir Pertanyaan Pelamar --}}
            <div class="mb-3">
                <label for="jawaban_pertanyaan_1" class="form-label fw-semibold">1. Berikan kesan Anda terhadap proses wawancara yang telah berlangsung (maks. 500 karakter).</label>
                <textarea class="form-control @error('jawaban_pertanyaan_1') is-invalid @enderror" id="jawaban_pertanyaan_1" name="jawaban_pertanyaan_1" rows="3" required>{{ old('jawaban_pertanyaan_1') }}</textarea>
                @error('jawaban_pertanyaan_1')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jawaban_pertanyaan_2" class="form-label fw-semibold">2. Apa ekspektasi gaji Anda setelah melalui tahap wawancara ini? (maks. 500 karakter)</label>
                <input type="text" class="form-control @error('jawaban_pertanyaan_2') is-invalid @enderror" id="jawaban_pertanyaan_2" name="jawaban_pertanyaan_2" value="{{ old('jawaban_pertanyaan_2') }}" required>
                @error('jawaban_pertanyaan_2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Tambahkan field formulir lain sesuai kebutuhan --}}
            
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Kirim Formulir Sekarang</button>
            </div>
        </form>
    </div>

</body>
</html>