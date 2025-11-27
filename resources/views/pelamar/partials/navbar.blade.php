<style>
    /* =========================================
       STYLE KHUSUS NAVBAR (Glassmorphism & Layout)
       ========================================= */
    .navbar {
        background: rgba(34, 55, 78, 0.95) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        padding-top: 0.8rem;
        padding-bottom: 0.8rem;
        z-index: 1030;
    }
    .navbar-brand {
        font-weight: 800; letter-spacing: 1.5px; font-size: 1.5rem;
        background: linear-gradient(45deg, #fff, #F39C12);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    
    /* Link Desktop (Hover Animation) */
    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.8) !important;
        font-weight: 500; position: relative; margin: 0 0.8rem;
    }
    .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: #fff !important; }
    .navbar-nav .nav-link::after {
        content: ''; position: absolute; width: 0; height: 2px; bottom: 0; left: 0;
        background-color: #F39C12; transition: width 0.3s ease-in-out;
    }
    .navbar-nav .nav-link:hover::after, .navbar-nav .nav-link.active::after { width: 100%; }

    /* Dropdown Animation */
    .dropdown-menu {
        background-color: #1a2c3d; border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3); animation: fadeInSlide 0.3s ease forwards;
        margin-top: 10px;
    }
    @keyframes fadeInSlide { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .dropdown-item { color: rgba(255, 255, 255, 0.8); transition: all 0.2s; }
    .dropdown-item:hover { background-color: rgba(243, 156, 18, 0.1); color: #F39C12; }

    /* Tombol Navbar Simetris (Desktop) */
    .navbar-btn-group .btn {
        min-width: 110px; height: 40px; display: inline-flex; align-items: center; justify-content: center;
        font-weight: 600; font-size: 0.95rem; border-radius: 50px; transition: all 0.3s ease;
    }
    .navbar-btn-group .btn-wide { min-width: 130px; }
    .navbar-btn-group .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(243, 156, 18, 0.3); }
    .navbar-btn-group { display: flex; gap: 10px; }

    /* =========================================
       MOBILE OFFCANVAS (FIXED FULL HEIGHT)
       ========================================= */
    .offcanvas.offcanvas-end {
        position: fixed !important; top: 0 !important; bottom: 0 !important; right: 0 !important; left: auto !important;
        width: 85% !important; max-width: 320px !important; height: 100vh !important;
        background: linear-gradient(180deg, #1a2c3d 0%, #111c29 100%) !important;
        box-shadow: -5px 0 15px rgba(0,0,0,0.5); z-index: 9999 !important; border: none; outline: none;
        display: flex; flex-direction: column;
    }
    .offcanvas-header { 
        display: flex; align-items: center; justify-content: space-between;
        padding: 1.2rem 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); min-height: 70px; 
    }
    .offcanvas-title { color: #F39C12; font-weight: 800; font-size: 1.2rem; letter-spacing: 2px; margin: 0; }
    .btn-close-white { background-color: rgba(255,255,255,0.1); border-radius: 50%; padding: 0.8rem; background-size: 1rem; opacity: 1; transition: transform 0.2s;}
    .btn-close-white:active { transform: scale(0.9); }
    
    .offcanvas-body { padding: 1.5rem; overflow-y: auto; }
    .offcanvas-body .nav-link {
        color: rgba(255, 255, 255, 0.85); font-size: 1.1rem; padding: 15px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05); display: flex; align-items: center;
    }
    .offcanvas-body .nav-link i { font-size: 1.3rem; width: 35px; color: #F39C12; display: inline-flex; justify-content: center; }
    
    /* Card Profil Mobile */
    .mobile-profile-card { background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 20px; margin-top: 30px; margin-bottom: 20px;}
    
    /* Helper Button Mobile */
    .btn-orange { background-color: #F39C12; border: none; color: white; transition: all 0.3s; }
    .btn-orange:hover { background-color: #e67e22; color: white; }
</style>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
    <div class="container">
        {{-- Logo Brand --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-rocket-takeoff-fill me-2"></i>MESSARI
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Tampilan Desktop --}}
        <div class="collapse navbar-collapse d-none d-lg-flex" id="main-nav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita.index') }}" class="nav-link {{ Request::routeIs('berita.index') ? 'active' : '' }}">Berita</a>
                </li>
                
                @if(Auth::check() && Auth::user()->role === 'pelamar')
                <li class="nav-item">
                    <a href="{{ route('pelamar.aktivitas.index') }}" class="nav-link {{ Request::routeIs('pelamar.aktivitas.index') ? 'active' : '' }}"> 
                        Aktivitas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pelamar.notifikasi.index') }}" class="nav-link {{ Request::routeIs('pelamar.notifikasi.index') ? 'active' : '' }} position-relative">
                        Notifikasi
                        @php
                            $jumlahUndangan = \App\Models\UndanganLamaran::where('pelamar_id', Auth::user()->profilePelamar->id ?? 0)
                                            ->where('status', 'terkirim')
                                            ->count();
                        @endphp
                        @if($jumlahUndangan > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm border border-light" style="font-size: 0.6rem;">
                                {{ $jumlahUndangan }}
                            </span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('perusahaan.index') ? 'active' : '' }}" href="{{ route('lowongan.index') }}">Cari Lowongan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('marketplace.index') }}" class="nav-link">MarketPlace</a>
                </li>
                @endif
            </ul>

            {{-- Tombol Kanan Desktop --}}
            <div class="d-flex align-items-center gap-2">
                @auth
                    {{-- LOGIC USER LOGIN --}}
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center bg-transparent border-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                $profile = Auth::user()->profilePelamar;
                            @endphp
                            @if($profile && $profile->foto_profil)
                                <img src="{{ asset('storage/' . $profile->foto_profil) }}" 
                                     alt="Foto" class="rounded-circle me-2 border border-2 border-warning" 
                                     style="width: 38px; height: 38px; object-fit: cover;">
                            @else
                                <div class="rounded-circle me-2 d-flex align-items-center justify-content-center bg-secondary text-white" style="width: 38px; height: 38px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                            <span class="fw-semibold">{{ Str::limit(Auth::user()->name, 10) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end animate slideIn">
                            <li><h6 class="dropdown-header text-warning">Akun Saya</h6></li>
                            <li><a class="dropdown-item" href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.profile.edit') : '#' }}"><i class="bi bi-person-circle me-2"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('pelamar.settings.index') }}"><i class="bi bi-gear-fill me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold"><i class="bi bi-box-arrow-right me-2"></i>Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- LOGIC TAMU (DESKTOP) --}}
                    <div class="navbar-btn-group d-none d-lg-flex">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Masuk</a>
                        <a href="{{ route('perusahaan') }}" class="btn btn-orange btn-wide">Perusahaan</a>
                        <a href="{{ route('toko-umkm.index') }}" class="btn btn-orange">UMKM</a>
                    </div>
                @endauth
            </div>
        </div>

        {{-- Tampilan Mobile Offcanvas --}}
        <div class="offcanvas offcanvas-end text-bg-dark d-lg-none" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                     <i class="bi bi-grid-fill me-2"></i>MENU
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body d-flex flex-column">
                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3 mb-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-2"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('berita.index') }}" class="nav-link {{ Request::routeIs('berita.index') ? 'active' : '' }}">
                            <i class="bi bi-newspaper me-2"></i>Berita Terkini
                        </a>
                    </li>

                    @if(Auth::check() && Auth::user()->role === 'pelamar')
                    <li class="nav-item">
                        <a href="{{ route('pelamar.aktivitas.index') }}" class="nav-link {{ Request::routeIs('pelamar.aktivitas.index') ? 'active' : '' }}">
                            <i class="bi bi-activity me-2"></i>Aktivitas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('perusahaan.index') ? 'active' : '' }}" href="{{ route('lowongan.index') }}">
                            <i class="bi bi-search me-2"></i>Cari Lowongan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('pelamar.notifikasi.index') ? 'active' : '' }} d-flex justify-content-between align-items-center" href="{{ route('pelamar.notifikasi.index') }}">
                            <span><i class="bi bi-bell me-2"></i>Notifikasi</span>
                            @php
                                $jumlahUndanganMobile = \App\Models\UndanganLamaran::where('pelamar_id', Auth::user()->profilePelamar->id ?? 0)
                                                ->where('status', 'terkirim')
                                                ->count();
                            @endphp
                            @if($jumlahUndanganMobile > 0)
                                <span class="badge bg-danger rounded-pill shadow-sm">
                                    {{ $jumlahUndanganMobile }}
                                </span>
                            @endif
                        </a>
                    </li>
                    @endif
                </ul>
                
                <div class="mt-auto">
                    @auth
                        {{-- CARD PROFIL MOBILE BARU --}}
                        <div class="mobile-profile-card">
                            <div class="d-flex align-items-center mb-3">
                                @php
                                    $profileMobile = Auth::user()->profilePelamar;
                                @endphp
                                @if ($profileMobile && $profileMobile->foto_profil)
                                    <img src="{{ asset('storage/' . $profileMobile->foto_profil) }}" 
                                         alt="Foto Profil" class="rounded-circle me-3 border border-warning" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="me-3 rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-person-fill text-white fs-4"></i>
                                    </div>
                                @endif
                                
                                <div class="overflow-hidden">
                                    <h6 class="text-white fw-bold mb-0 text-truncate">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">Pelamar</small>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.profile.edit') : '#' }}" class="btn btn-sm btn-outline-light rounded-pill">Edit Profil</a>
                                <form method="POST" action="{{ route('logout') }}" class="d-grid">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                        <i class="bi bi-box-arrow-right me-1"></i> Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- TOMBOL MOBILE JIKA BELUM LOGIN --}}
                        <div class="d-grid gap-3 mt-4">
                            <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill py-2 fw-bold">MASUK</a>
                            <div class="row g-2">
                                <div class="col-6">
                                    <a href="{{ route('perusahaan') }}" class="btn btn-orange w-100 rounded-pill py-2 small-text">Perusahaan</a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('toko-umkm.index') }}" class="btn btn-orange w-100 rounded-pill py-2 small-text">UMKM</a>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>