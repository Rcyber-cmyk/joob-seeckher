<style>
    .offcanvas.offcanvas-end {
        background-color: #22374e; /* Biru khas Messari */
        color: white; /* Teks default jadi putih */
        width: 280px; /* Lebar offcanvas bisa disesuaikan */
    }

    /* Header Offcanvas */
    .offcanvas-header {
        background-color: #1a2c3d; /* Warna sedikit lebih gelap untuk header */
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1rem 1.5rem;
    }

    /* Judul Offcanvas (MENU) */
    .offcanvas-title {
        font-weight: bold;
        color: #F39C12; /* Warna oranye untuk judul "MENU" */
        letter-spacing: 1px;
    }

    /* Tombol Close Offcanvas (X) */
    .offcanvas-header .btn-close {
        filter: invert(1); /* Agar ikon X jadi putih */
        opacity: 0.8;
        transition: opacity 0.2s ease;
    }
    .offcanvas-header .btn-close:hover {
        opacity: 1;
    }

    /* Body Offcanvas (Menu Navigasi) */
    .offcanvas-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Untuk mendorong user-profile ke bawah */
    }

    /* Link Navigasi di Offcanvas */
    .offcanvas-body .nav-link {
        color: rgba(255, 255, 255, 0.85); /* Warna link */
        padding: 0.8rem 0;
        font-size: 1.1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05); /* Garis bawah halus */
    }
    .offcanvas-body .nav-link:hover,
    .offcanvas-body .nav-link.active {
        color: #F39C12; /* Hover dan active jadi oranye */
    }
    .offcanvas-body .nav-link:last-child {
        border-bottom: none; /* Hapus border bawah untuk item terakhir */
    }

    /* Profil Pengguna di Offcanvas (bagian bawah) */
    .offcanvas-body .user-profile {
        background-color: #1a2c3d; /* Background lebih gelap untuk profil */
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1.5rem; /* Jarak dari menu di atas */
    }
    .offcanvas-body .user-profile img {
        border: 2px solid rgba(255, 255, 255, 0.5); /* Border foto default */
    }
    .offcanvas-body .user-profile .text-white {
        color: white !important; /* Pastikan nama tetap putih */
    }

    /* Tombol Logout di Offcanvas */
    .offcanvas-body .user-profile .log-out {
        color: #dc3545 !important; /* Warna merah untuk ikon logout */
        transition: color 0.2s ease;
    }
    .offcanvas-body .user-profile .log-out:hover {
        color: #c82333 !important; /* Merah lebih gelap saat hover */
    }

    /* Tombol Edit Profil/Pengaturan di Offcanvas */
    .offcanvas-body .d-grid .btn-outline-light {
        border-color: rgba(255, 255, 255, 0.3); /* Border lebih halus */
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.2s ease;
    }
    .offcanvas-body .d-grid .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: white;
    }

    /* Tombol untuk tamu (belum login) di offcanvas */
    .offcanvas-body .d-grid .btn-outline-light,
    .offcanvas-body .d-grid .btn-orange {
         /* Pastikan style ini juga konsisten jika mereka di bagian bawah offcanvas */
         margin-top: 1rem;
    }.offcanvas.offcanvas-end {
        background-color: #22374e; /* Biru khas Messari */
        color: white; /* Teks default jadi putih */
        width: 280px; /* Lebar offcanvas bisa disesuaikan */
    }

    /* Header Offcanvas */
    .offcanvas-header {
        background-color: #1a2c3d; /* Warna sedikit lebih gelap untuk header */
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1rem 1.5rem;
    }

    /* Judul Offcanvas (MENU) */
    .offcanvas-title {
        font-weight: bold;
        color: #F39C12; /* Warna oranye untuk judul "MENU" */
        letter-spacing: 1px;
    }

    /* Tombol Close Offcanvas (X) */
    .offcanvas-header .btn-close {
        filter: invert(1); /* Agar ikon X jadi putih */
        opacity: 0.8;
        transition: opacity 0.2s ease;
    }
    .offcanvas-header .btn-close:hover {
        opacity: 1;
    }

    /* Body Offcanvas (Menu Navigasi) */
    .offcanvas-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Untuk mendorong user-profile ke bawah */
    }

    /* Link Navigasi di Offcanvas */
    .offcanvas-body .nav-link {
        color: rgba(255, 255, 255, 0.85); /* Warna link */
        padding: 0.8rem 0;
        font-size: 1.1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05); /* Garis bawah halus */
    }
    .offcanvas-body .nav-link:hover,
    .offcanvas-body .nav-link.active {
        color: #F39C12; /* Hover dan active jadi oranye */
    }
    .offcanvas-body .nav-link:last-child {
        border-bottom: none; /* Hapus border bawah untuk item terakhir */
    }

    /* Profil Pengguna di Offcanvas (bagian bawah) */
    .offcanvas-body .user-profile {
        background-color: #1a2c3d; /* Background lebih gelap untuk profil */
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1.5rem; /* Jarak dari menu di atas */
    }
    .offcanvas-body .user-profile img {
        border: 2px solid rgba(255, 255, 255, 0.5); /* Border foto default */
    }
    .offcanvas-body .user-profile .text-white {
        color: white !important; /* Pastikan nama tetap putih */
    }

    /* Tombol Logout di Offcanvas */
    .offcanvas-body .user-profile .log-out {
        color: #dc3545 !important; /* Warna merah untuk ikon logout */
        transition: color 0.2s ease;
    }
    .offcanvas-body .user-profile .log-out:hover {
        color: #c82333 !important; /* Merah lebih gelap saat hover */
    }

    /* Tombol Edit Profil/Pengaturan di Offcanvas */
    .offcanvas-body .d-grid .btn-outline-light {
        border-color: rgba(255, 255, 255, 0.3); /* Border lebih halus */
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.2s ease;
    }
    .offcanvas-body .d-grid .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: white;
    }

    /* Tombol untuk tamu (belum login) di offcanvas */
    .offcanvas-body .d-grid .btn-outline-light,
    .offcanvas-body .d-grid .btn-orange {
         /* Pastikan style ini juga konsisten jika mereka di bagian bawah offcanvas */
         margin-top: 1rem;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #22374e;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">MESSARI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Tampilan Desktop --}}
        <div class="collapse navbar-collapse d-none d-lg-flex" id="main-nav">
            {{-- PERUBAHAN: Menghapus 'mx-auto' dan menambahkan 'me-auto' untuk mendorong menu ke kiri --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}"></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita.index') }}" class="nav-link {{ Request::routeIs('berita.index') ? 'active fw-bold' : '' }}">Berita Terkini</a>
                </li>
                
                @if(Auth::check() && Auth::user()->role === 'pelamar')
                <li class="nav-item">
                    <a href="{{ route('pelamar.aktivitas.index') }}" class="nav-link {{ Request::routeIs('pelamar.aktivitas.index') ? 'active fw-bold' : '' }}"> 
                        Aktivitas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('perusahaan.index') ? 'active fw-bold' : '' }}" href="{{ route('lowongan.index') }}">Cari Lowongan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('marketplace.index') }}" class="nav-link">MarketPlace</a>
                </li>
                @endif
            </ul>

            {{-- Tombol di sebelah kanan --}}
            <div class="d-flex">
                @auth
                    {{-- JIKA PENGGUNA SUDAH LOGIN --}}
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    
                            @php
                            $profile = Auth::user()->profilePelamar; // Ambil modelnya (atau null)
                        @endphp
                        @if($profile && $profile->foto_profil) {{-- Gunakan variabel $profile --}}
                            <img src="{{ asset('storage/' . $profile->foto_profil) }}" {{-- Gunakan variabel $profile --}}
                                 alt="Foto" class="rounded-circle me-2" 
                                 style="width: 32px; height: 32px; object-fit: cover;">
                        @else
                            <i class="bi bi-person-circle me-2 fs-5"></i>
                        @endif
                            
                            {{-- Ini nama penggunanya, biarkan saja --}}
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.profile.edit') : '#' }}"><i class="bi bi-person-lines-fill me-2"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('pelamar.settings.index') }}"><i class="bi bi-gear-fill me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- JIKA PENGGUNA ADALAH TAMU (BELUM LOGIN) --}}
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">MASUK</a>
                    <a href="{{ route('perusahaan') }}" class="btn btn-orange me-2">Perusahaan</a>
                    <a href="{{ route('toko-umkm.index') }}" class="btn btn-orange">UMKM</a>
                @endauth
            </div>
        </div>

        {{-- Tampilan Mobile (Offcanvas) --}}
        <div class="offcanvas offcanvas-end text-bg-dark d-lg-none" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3 mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('berita.index') }}" class="nav-link {{ Request::routeIs('berita.index') ? 'active fw-bold' : '' }}">Berita Terkini</a>
                    </li>

                    @if(Auth::check() && Auth::user()->role === 'pelamar')
                    <li class="nav-item">
                        <a href="{{ route('pelamar.aktivitas.index') }}" class="nav-link {{ Request::routeIs('pelamar.aktivitas.index') ? 'active fw-bold' : '' }}">
                            Aktivitas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('perusahaan.index') ? 'active fw-bold' : '' }}" href="{{ route('lowongan.index') }}">Cari Lowongan</a>
                    </li>
                    @endif
                </ul>
                
                {{-- Tombol Dinamis untuk Offcanvas --}}
                <div class="mt-auto">
                    @auth
                        {{-- ================================================ --}}
                        {{-- KODE BARU ANDA MULAI DARI SINI (UNTUK MOBILE) --}}
                        {{-- ================================================ --}}
                        <div class="user-profile d-flex align-items-center">
                            {{-- Logika untuk menampilkan foto profil pelamar --}}
                            @php
                            $profileMobile = Auth::user()->profilePelamar; // Ambil modelnya (atau null)
                        @endphp
                        @if ($profileMobile && $profileMobile->foto_profil) {{-- Gunakan variabel $profileMobile --}}
                            <img src="{{ asset('storage/' . $profileMobile->foto_profil) }}" {{-- Gunakan variabel $profileMobile --}}
                                 alt="Foto Profil" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid rgba(255, 255, 255, 0.5);">
                        @else
                                {{-- Tampilkan gambar default jika tidak ada foto --}}
                                <div class="me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person-circle text-white" style="font-size: 2.5rem;"></i> {{-- Ukuran ikon disesuaikan --}}
                                </div>
                            @endif
                            
                            {{-- Bagian Nama dan Email --}}
                            <div class="d-flex flex-column me-auto">
                                <span class="text-white fw-bold">{{ Auth::user()->name }}</span>
                                {{-- Anda bisa tambahkan email jika mau, tapi mungkin terlalu penuh --}}
                                {{-- <span class="text-small">{{ Auth::user()->email }}</span> --}}
                            </div>
                            
                            {{-- Tombol Logout --}}
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="bg-transparent border-0 log-out text-white">
                                    <i class="bi bi-box-arrow-right fs-4"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Tombol link di bawahnya --}}
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.profile.edit') : '#' }}" class="btn btn-outline-light btn-sm">Edit Profil</a>
                            <a href="{{ route('pelamar.settings.index') }}" class="btn btn-outline-light btn-sm">Pengaturan</a>
                        </div>
                        {{-- ================================================ --}}
                        {{-- BATAS AKHIR KODE BARU --}}
                        {{-- ================================================ --}}
                    @else
                        <div class="d-grid gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-light">MASUK</a>
                            <a href="{{ route('perusahaan') }}" class="btn btn-orange">Perusahaan</a>
                            <a href="{{ route('toko-umkm.index') }}" class="btn btn-orange">UMKM</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>