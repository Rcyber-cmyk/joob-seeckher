<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CV {{ $profile->nama_lengkap }}</title>
    <style>
        /* === RESET & BASE === */
        @page { margin: 0px; }
        body { margin: 0px; font-family: 'Helvetica', 'Arial', sans-serif; background-color: #fff; }
        
        /* === LAYOUT UTAMA (TABLE BASED FOR DOMPDF) === */
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; }

        /* === SIDEBAR (KIRI) === */
        .sidebar {
            width: 32%;
            background-color: #22374e; /* Biru Messari */
            color: #ffffff;
            height: 100vh; /* Full Height */
            padding: 30px 20px;
            text-align: center;
        }

        /* Foto Profil */
        .profile-img-container {
            width: 140px;
            height: 140px;
            margin: 0 auto 30px auto;
            border-radius: 50%;
            border: 4px solid #F39C12; /* Border Oranye */
            overflow: hidden;
            background-color: #fff;
        }
        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* Jika tidak ada foto, pakai inisial */
        .initials {
            line-height: 130px;
            font-size: 50px;
            font-weight: bold;
            color: #22374e;
        }

        /* Sidebar Sections */
        .sidebar-section { margin-bottom: 30px; text-align: left; }
        .sidebar-title {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 1px solid #F39C12;
            padding-bottom: 5px;
            margin-bottom: 15px;
            color: #F39C12;
            font-weight: bold;
        }
        .contact-item { font-size: 11px; margin-bottom: 10px; word-wrap: break-word; }
        .contact-label { font-weight: bold; display: block; color: #ccc; font-size: 10px; }
        
        /* Skills Chips */
        .skill-tag {
            display: inline-block;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            margin-bottom: 5px;
            margin-right: 2px;
        }

        /* === MAIN CONTENT (KANAN) === */
        .main-content {
            width: 68%;
            padding: 40px 30px;
            background-color: #fff;
            color: #333;
        }

        /* Header Nama */
        .header-name {
            font-size: 32px;
            font-weight: 800;
            text-transform: uppercase;
            color: #22374e;
            margin-bottom: 5px;
            line-height: 1.1;
        }
        .header-role {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #F39C12;
            font-weight: bold;
            margin-bottom: 25px;
        }

        /* Content Sections */
        .content-section { margin-bottom: 30px; }
        .content-title {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            color: #22374e;
            border-bottom: 2px solid #eee;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        .content-title span {
            border-bottom: 2px solid #F39C12; /* Garis oranye pendek */
            padding-bottom: 8px;
        }

        .summary-text { font-size: 12px; line-height: 1.6; color: #555; text-align: justify; }

        /* Items (Education/Experience) */
        .item-block { margin-bottom: 15px; }
        .item-title { font-size: 14px; font-weight: bold; color: #333; }
        .item-subtitle { font-size: 12px; color: #F39C12; font-weight: bold; margin-bottom: 3px; }
        .item-date { font-size: 11px; color: #777; font-style: italic; margin-bottom: 5px; }
        .item-desc { font-size: 12px; color: #666; line-height: 1.4; }

    </style>
</head>
<body>

<table class="layout-table">
    <tr>
        {{-- KOLOM KIRI (SIDEBAR) --}}
        <td class="sidebar">
            
            {{-- Foto Profil --}}
            <div class="profile-img-container">
                @if(!empty($fotoPath))
                    <img src="{{ $fotoPath }}" class="profile-img">
                @else
                    {{-- Fallback jika tidak ada foto: Inisial Nama --}}
                    <div class="initials">
                        {{ substr($profile->nama_lengkap, 0, 1) }}
                    </div>
                @endif
            </div>

            {{-- Kontak Info --}}
            <div class="sidebar-section">
                <div class="sidebar-title">Kontak</div>
                
                <div class="contact-item">
                    <span class="contact-label">EMAIL</span>
                    {{ $email }}
                </div>
                <div class="contact-item">
                    <span class="contact-label">TELEPON</span>
                    {{ $profile->no_hp }}
                </div>
                <div class="contact-item">
                    <span class="contact-label">ALAMAT</span>
                    {{ $profile->alamat }}
                </div>
                <div class="contact-item">
                    <span class="contact-label">DOMISILI</span>
                    {{ $profile->domisili }}
                </div>
            </div>

            {{-- Keahlian (Skills) --}}
            <div class="sidebar-section">
                <div class="sidebar-title">Keahlian</div>
                @forelse($keahlian as $skill)
                    <span class="skill-tag">{{ $skill->nama_keahlian }}</span>
                @empty
                    <span style="font-size:10px; color:#ddd;">-</span>
                @endforelse
            </div>

            {{-- Data Pribadi Tambahan --}}
            <div class="sidebar-section" style="margin-top: 30px;">
                <div class="sidebar-title">Info Personal</div>
                <div class="contact-item">
                    <span class="contact-label">TGL LAHIR</span>
                    {{ \Carbon\Carbon::parse($profile->tanggal_lahir)->format('d F Y') }}
                </div>
                <div class="contact-item">
                    <span class="contact-label">GENDER</span>
                    {{ $profile->gender }}
                </div>
            </div>

        </td>

        {{-- KOLOM KANAN (MAIN CONTENT) --}}
        <td class="main-content">
            
            {{-- Header Nama --}}
            <div class="header-name">{{ $profile->nama_lengkap }}</div>
            <div class="header-role">{{ $profile->lulusan }} &bullet; {{ $profile->pengalaman_kerja }}</div>

            {{-- Tentang Saya --}}
            @if($profile->tentang_saya)
            <div class="content-section">
                <div class="content-title"><span>Tentang Saya</span></div>
                <div class="summary-text">
                    {{ $profile->tentang_saya }}
                </div>
            </div>
            @endif

            {{-- Pendidikan --}}
            <div class="content-section">
                <div class="content-title"><span>Pendidikan</span></div>
                
                <div class="item-block">
                    <div class="item-title">{{ $profile->lulusan }}</div>
                    <div class="item-subtitle">Lulusan Tahun {{ $profile->tahun_lulus }}</div>
                    <div class="item-desc">
                        Jenjang pendidikan terakhir yang ditempuh adalah {{ $profile->lulusan }}.
                    </div>
                </div>
            </div>

            {{-- Pengalaman Kerja (Placeholder jika data dinamis belum ada di tabel profile) --}}
            <div class="content-section">
                <div class="content-title"><span>Pengalaman Kerja</span></div>
                
                <div class="item-block">
                    <div class="item-title">Pengalaman Profesional</div>
                    <div class="item-subtitle">{{ $profile->pengalaman_kerja }}</div>
                    <div class="item-desc">
                        @if($profile->pengalaman_kerja == 'Fresh Graduate')
                            Belum memiliki pengalaman kerja formal, namun memiliki semangat belajar yang tinggi dan siap berkontribusi.
                        @else
                            Memiliki pengalaman kerja selama {{ $profile->pengalaman_kerja }} di bidang terkait.
                        @endif
                    </div>
                </div>
            </div>

        </td>
    </tr>
</table>

</body>
</html>