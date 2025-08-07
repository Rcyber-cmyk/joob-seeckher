<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Keahlian - Messari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Menggunakan CSS yang sama persis dari halaman register utama */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #263341;
            color: #ffffff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .register-container {
            display: flex;
            min-height: 100vh;
            width: 100vw;
            position: relative;
        }
        .panel {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s ease-in-out;
            width: 50%;
            padding: 3rem;
            box-sizing: border-box;
        }
        .illustration-panel {
            background-color: #263341;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            padding-top: 2rem;
            padding-left: 2rem;
            display: none; /* Sembunyi di mobile, aktif di desktop via media query */
        }
        .illustration-panel .page-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 2rem;
        }
        .illustration-panel img {
            max-width: 80%;
            height: auto;
            filter: drop-shadow(0 0 20px rgba(255,115,34,0.6));
            margin-top: 2rem;
            margin-left: auto;
            margin-right: auto;
        }
        .form-wrapper {
            width: 100%;
            max-width: 600px; /* Lebarkan sedikit untuk form keahlian */
        }
        .form-panel-title {
            font-weight: 900;
            font-size: 2.8rem; /* Sedikit lebih kecil agar pas */
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            text-align: center;
            color: white;
        }
        .form-panel-subtitle {
            text-align: center;
            color: #a0aec0;
            margin-bottom: 2rem;
        }
        .btn-submit {
            background-color: #f97316;
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: bold;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(249, 115, 22, 0.2);
        }
        .btn-submit:hover {
            background-color: #fb923c;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.4);
        }
        .btn-skip {
            background-color: transparent;
            border: 1px solid #4a5568;
            color: #a0aec0;
        }
        .btn-skip:hover {
            background-color: #4a5568;
            color: white;
        }
        .skill-group h5 {
            border-bottom: 1px solid #4a5568;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
            color: #f97316;
            font-weight: bold;
        }
        .form-check-input:checked {
            background-color: #f97316;
            border-color: #f97316;
        }
        .form-check-input {
            background-color: #4a5568;
            border: 1px solid #718096;
        }
        .form-check-label {
            cursor: pointer;
            color: #e2e8f0;
        }

        /* Media Queries untuk responsivitas */
        @media (max-width: 991.98px) {
            .register-container {
                flex-direction: column;
            }
            .panel {
                width: 100%;
                padding: 1.5rem;
                min-height: auto;
            }
            .illustration-panel {
                order: -1;
                height: 180px;
                padding: 1rem;
                align-items: center;
            }
            .illustration-panel .page-title {
                display: none;
            }
            .illustration-panel img {
                max-width: 150px;
                margin: auto;
            }
            .form-panel-title {
                font-size: 2rem;
            }
        }
        @media (min-width: 992px) {
            .illustration-panel {
                display: flex !important;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    {{-- Panel Ilustrasi (Sama seperti halaman register) --}}
    <div class="panel illustration-panel order-lg-first order-first">
        <div class="page-title d-lg-block d-none">Messari</div>
        <img src="{{ asset('images/auth/register.png') }}" onerror="this.onerror=null;this.src='https://placehold.co/600x600/263341/ffffff?text=Ilustrasi';">
    </div>

    {{-- Panel Form Keahlian --}}
    <div class="panel form-container-panel order-lg-last order-last">
        <div class="form-wrapper">
            <h1 class="form-panel-title">Lengkapi Profil Anda</h1>
            <p class="form-panel-subtitle">Pilih keahlian yang Anda kuasai untuk membantu perusahaan menemukan Anda.</p>

            <form action="{{ route('register.keahlian.store') }}" method="POST">
                @csrf
                <input type="hidden" name="pelamar_id" value="{{ $pelamar_id }}">

                @if ($errors->any())
                    <div class="alert alert-danger" style="background-color: #5f2d2d; border: none; color: white;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div style="max-height: 45vh; overflow-y: auto; padding-right: 15px;">
                    @forelse ($bidangKeahlians as $bidang)
                        <div class="mb-4 skill-group">
                            <h5>{{ $bidang->nama_bidang }}</h5>
                            <div class="row">
                                @foreach ($bidang->keahlian as $keahlian)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="keahlian[]" value="{{ $keahlian->id }}" id="keahlian-{{ $keahlian->id }}">
                                            <label class="form-check-label" for="keahlian-{{ $keahlian->id }}">
                                                {{ $keahlian->nama_keahlian }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-white-50">Belum ada data keahlian yang tersedia.</p>
                    @endforelse
                </div>

                <hr class="my-4" style="border-color: #4a5568;">

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-submit btn-skip" name="skip" value="1">Lewati</button>
                    <button type="submit" class="btn btn-submit">Selesaikan Pendaftaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>