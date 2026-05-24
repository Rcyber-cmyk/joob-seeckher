<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hasil Rekomendasi SPK</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.4; font-size: 12px; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #22374e; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #22374e; text-transform: uppercase; }
        .header p { margin: 5px 0 0 0; color: #666; font-style: italic; }
        .biodata-table { width: 100%; margin-bottom: 25px; border-collapse: collapse; }
        .biodata-table td { padding: 4px 0; vertical-align: top; }
        .biodata-table td.label { width: 25%; font-weight: bold; color: #555; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .content-table th { background-color: #22374e; color: white; padding: 8px; text-align: left; font-size: 11px; text-transform: uppercase; }
        .content-table td { padding: 10px 8px; border-bottom: 1px solid #ddd; }
        .content-table tr:nth-child(even) { background-color: #f9f9f9; }
        .badge-match { background-color: #e2f0d9; color: #385723; padding: 4px 8px; border-radius: 10px; font-weight: bold; font-size: 11px; display: inline-block; }
        .footer-date { float: right; text-align: center; margin-top: 40px; width: 200px; }
        .footer-date .signature { margin-top: 60px; font-weight: bold; border-top: 1px solid #333; padding-top: 5px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Sistem Pendukung Keputusan Portal Kerja</h2>
        <p>Laporan Analisis Kesesuaian Jabatan menggunakan Metode Profile Matching</p>
    </div>

    <table class="biodata-table">
        <tr>
            <td class="label">Nama Pelamar</td>
            <td>: {{ $pelamar->nama_lengkap }}</td>
            <td class="label">Tanggal Cetak</td>
            <td>: {{ $tanggal }}</td>
        </tr>
        <tr>
            <td class="label">Email Akun</td>
            <td>: {{ $email }}</td>
            <td class="label">Pendidikan Akhir</td>
            <td>: {{ $pelamar->lulusan }} (Th. {{ $pelamar->tahun_lulus }})</td>
        </tr>
        <tr>
            <td class="label">Domisili</td>
            <td>: {{ $pelamar->domisili }}</td>
            <td class="label">Pengalaman Kerja</td>
            <td>: {{ $pelamar->pengalaman_kerja ?? 'Fresh Graduate' }}</td>
        </tr>
    </table>

    <h3 style="color: #22374e; margin-bottom: 5px;">Hasil Rekomendasi Pekerjaan Terbaik</h3>
    <p style="margin: 0 0 10px 0; color: #666;">Daftar lowongan pekerjaan aktif dengan urutan kecocokan (skor tertinggi) berdasarkan bobot kesesuaian kriteria.</p>

    <table class="content-table">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">Rank</th>
                <th style="width: 35%;">Judul Lowongan Pekerjaan</th>
                <th style="width: 25%;">Nama Perusahaan Mitra</th>
                <th style="width: 20%;">Lokasi & Tipe</th>
                <th style="width: 15%; text-align: center;">Match Score</th>
            </tr>
        </thead>
        <tbody>
            @php $rank = 1; @endphp
            @foreach($rekomendasi as $rek)
            <tr>
                <td style="text-align: center; font-weight: bold;">{{ $rank++ }}</td>
                <td><strong style="color: #22374e;">{{ $rek['lowongan']->judul_lowongan }}</strong></td>
                <td>{{ $rek['lowongan']->perusahaan->nama_perusahaan }}</td>
                <td>{{ $rek['lowongan']->domisili }}<br><small style="color:#777;">{{ $rek['lowongan']->tipe_pekerjaan }}</small></td>
                <td style="text-align: center;">
                    <span class="badge-match">{{ $rek['persentase'] }}% Fit</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-date">
        <p>Semarang, {{ $tanggal }}</p>
        <p>Mengetahui,</p>
        <div class="signature">Sistem Otomatis SPK</div>
    </div>

</body>
</html>