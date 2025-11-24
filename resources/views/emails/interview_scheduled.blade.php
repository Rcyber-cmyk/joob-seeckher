<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Wawancara</title>
    <style>
        /* Reset & Gaya Dasar Email */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            width: 100% !important;
        }

        /* Container Utama - Mengatur lebar email */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Header - Bagian Atas Berwarna Biru */
        .email-header {
            background-color: #0d6efd; /* Warna Biru Utama */
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Konten - Bagian Isi Surat */
        .email-body {
            padding: 40px 30px;
            color: #333333;
            font-size: 16px;
            line-height: 1.6;
        }

        .email-body p {
            margin-bottom: 15px;
        }

        /* Box Informasi Jadwal - Highlight Abu-abu */
        .info-box {
            background-color: #f8f9fa;
            border-left: 5px solid #0d6efd;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .info-row {
            margin-bottom: 10px;
            display: block;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            width: 140px; /* Lebar label agar sejajar */
        }

        .info-value {
            color: #212529;
            font-weight: 500;
        }

        /* Tombol Aksi */
        .btn-container {
            text-align: center;
            margin-top: 35px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #0d6efd;
            color: #ffffff !important;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(13, 110, 253, 0.3);
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        /* Link text */
        a.text-link {
            color: #0d6efd;
            text-decoration: underline;
        }

        /* Footer - Bagian Bawah */
        .email-footer {
            background-color: #f1f3f5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #868e96;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Email -->
        <div class="email-header">
            <h1>Undangan Wawancara Kerja</h1>
        </div>

        <!-- Isi Email -->
        <div class="email-body">
            <p>Halo <strong>{{ $jadwal->pelamar->user->name ?? 'Kandidat' }}</strong>,</p>

            <p>
                Kami membawa kabar baik! Berdasarkan hasil seleksi administrasi, kami mengundang Anda untuk mengikuti sesi wawancara untuk posisi:
            </p>
            
            <h3 style="text-align: center; color: #0d6efd; margin: 20px 0;">
                {{ $jadwal->lowongan->judul_lowongan ?? 'Posisi Lowongan' }}
            </h3>

            <p>Berikut adalah rincian jadwal wawancara yang telah kami siapkan untuk Anda:</p>

            <!-- Box Informasi Jadwal -->
            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">📅 Tanggal</span>
                    <span class="info-value">: {{ \Carbon\Carbon::parse($jadwal->tanggal_interview)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">⏰ Waktu</span>
                    <span class="info-value">: {{ \Carbon\Carbon::parse($jadwal->waktu_interview)->format('H:i') }} WIB</span>
                </div>
                <div class="info-row">
                    <span class="info-label">🎥 Metode</span>
                    <span class="info-value">: {{ $jadwal->metode_wawancara }}</span>
                </div>
                
                <div class="info-row" style="margin-top: 10px;">
                    <span class="info-label">📍 Lokasi / Link</span>
                    <span class="info-value">: 
                        @if($jadwal->metode_wawancara == 'Virtual Interview')
                            <br>
                            <a href="{{ $jadwal->link_zoom }}" class="text-link" target="_blank">
                                Klik di sini untuk bergabung (Zoom/Meet)
                            </a>
                        @else
                            <br>
                            {{ $jadwal->lokasi_interview }}
                        @endif
                    </span>
                </div>

                @if (!empty($jadwal->deskripsi))
                <div class="info-row" style="margin-top: 10px;">
                    <span class="info-label">📝 Catatan</span>
                    <span class="info-value">: {{ $jadwal->deskripsi }}</span>
                </div>
                @endif
            </div>

            <p>
                Mohon untuk hadir tepat waktu. Jika Anda berhalangan hadir atau ingin mengajukan perubahan jadwal, harap segera menghubungi kami.
            </p>

            <!-- Tombol Lihat Detail -->
            <div class="btn-container">
                {{-- Ganti '#' dengan route ke halaman detail jadwal pelamar jika ada --}}
                <a href="{{ url('/') }}" class="btn-primary">Lihat Detail di Dashboard</a>
            </div>
            
            <p style="margin-top: 30px;">
                Salam hangat,<br>
                <strong>Tim Rekrutmen</strong>
            </p>
        </div>

        <!-- Footer Email -->
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Hak cipta dilindungi undang-undang.</p>
            <p>Email ini dibuat secara otomatis, mohon jangan membalas secara langsung ke alamat pengirim ini.</p>
        </div>
    </div>
</body>
</html>