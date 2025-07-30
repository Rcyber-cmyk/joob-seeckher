{{-- resources/views/auth/register-keahlian.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Langkah 2: Pilih Keahlian - Messari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Menggunakan style yang sama persis dengan halaman register */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #2d3e50;
            color: #ffffff;
            margin: 0;
            padding: 0; /* Padding dihilangkan dari body */
        }
        .register-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
            align-items: center; /* Menengahkan panel secara vertikal */
        }
        .panel {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
            padding: 2rem;
            height: 100vh; /* Panel mengisi tinggi layar */
        }
        .illustration-panel {
            background-color: #ffffff;
            clip-path: polygon(0 0, 100% 0, 75% 100%, 0% 100%);
        }
        .illustration-panel img { max-width: 60%; height: auto; }
        .form-container-panel { flex-direction: column; }
        .form-wrapper { width: 100%; max-width: 550px; } /* Sedikit diperlebar untuk accordion */
        .form-wrapper h1 { font-weight: 900; font-size: 2.5rem; margin-bottom: 0.5rem; color: #fff; }
        .form-wrapper p { color: #a0aec0; margin-bottom: 1.5rem; }
        .btn-submit { background-color: #f97316; border: none; color: white; padding: 0.8rem 1.5rem; font-weight: bold; border-radius: 0.75rem; width: 100%; font-size: 1.2rem; transition: all 0.3s ease; }
        .btn-submit:hover { background-color: #fb923c; transform: translateY(-2px); }
        
        /* [FIX] Container untuk accordion agar bisa di-scroll */
        .accordion-container {
            max-height: 48vh; /* Batas tinggi maksimal */
            overflow-y: auto;  /* Aktifkan scroll vertikal jika konten melebihi batas */
            padding-right: 15px; /* Ruang untuk scrollbar */
            margin-bottom: 1.5rem; /* Jarak ke tombol submit */
        }

        /* Accordion Styling */
        .accordion-item { background-color: #4a5568; border: none; margin-bottom: 0.5rem; border-radius: 0.5rem !important; }
        .accordion-header { border-radius: 0.5rem; }
        .accordion-button { background-color: #4a5568; color: white; font-weight: bold; border-radius: 0.5rem !important; }
        .accordion-button:not(.collapsed) { background-color: #5a6878; color: #f97316; }
        .accordion-button:focus { box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25); }
        .accordion-button::after { filter: brightness(0) invert(1); }
        .accordion-body { padding: 1rem 1.25rem; }

        /* Checklist Styling */
        .keahlian-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 0.75rem; }
        .form-check-label {
            width: 100%;
            padding: 0.5rem 0.75rem;
            background-color: #3a4a5b;
            color: #ffffff; /* [FIX] Teks default selalu putih */
            border: 1px solid #4a5568;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            text-align: center;
            font-size: 0.9rem;
        }
        .form-check-input { display: none; }
        .form-check-input:checked + .form-check-label {
            background-color: #f97316;
            color: #111827; /* [FIX] Teks menjadi hitam pekat saat dipilih */
            font-weight: bold;
            border-color: #f97316;
        }

        @media (max-width: 991.98px) {
            .illustration-panel { display: none; }
            .panel { width: 100%; height: auto; min-height: 100vh; }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="panel illustration-panel d-none d-lg-flex">
            <img src="{{ asset('images/register-illustration.png') }}" onerror="this.onerror=null;this.src='https://placehold.co/600x600/ffffff/2d3e50?text=Pilih+Keahlian';">
        </div>

        <div class="panel form-container-panel">
            <div class="form-wrapper">
                <h1>Langkah Terakhir</h1>
                <p>Pilih keahlian yang Anda kuasai dari berbagai bidang di bawah ini.</p>
                
                <form method="POST" action="{{ route('register.keahlian.store') }}">
                    @csrf
                    <input type="hidden" name="pelamar_id" value="{{ $pelamar_id }}">

                    @if($bidangKeahlians->isEmpty())
                        <p class="text-center">Saat ini belum ada daftar keahlian yang tersedia.</p>
                    @else
                        <div class="accordion-container">
                            <div class="accordion" id="accordionKeahlian">
                                @foreach ($bidangKeahlians as $bidang)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-{{ $bidang->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $bidang->id }}" aria-expanded="false" aria-controls="collapse-{{ $bidang->id }}">
                                                {{ $bidang->nama_bidang }}
                                            </button>
                                        </h2>
                                        <div id="collapse-{{ $bidang->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $bidang->id }}" data-bs-parent="#accordionKeahlian">
                                            <div class="accordion-body">
                                                @if($bidang->keahlian->isEmpty())
                                                    <p class="text-center small text-white-50">Belum ada keahlian di bidang ini.</p>
                                                @else
                                                    <div class="keahlian-grid">
                                                        @foreach ($bidang->keahlian as $keahlian)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="keahlian[]" value="{{ $keahlian->id }}" id="keahlian-{{ $keahlian->id }}">
                                                                <label class="form-check-label" for="keahlian-{{ $keahlian->id }}">
                                                                    {{ $keahlian->nama_keahlian }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn-submit">Selesai & Masuk ke Dashboard</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
