<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #22374e;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">MESSARI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Tampilan Desktop --}}
        <div class="collapse navbar-collapse d-none d-lg-flex" id="main-nav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="#beritaTerkiniLandingPage" class="nav-link">Berita Terkini</a>
                </li>
                
                {{-- MODIFIKASI DIMULAI DISINI (UNTUK DESKTOP) --}}
                @if(Auth::check() && Auth::user()->role === 'pelamar')
                <li class="nav-item">
                    {{-- Ganti '#' dengan route yang sesuai, misal: route('aktivitas.index') --}}
                    <a href="#" class="nav-link {{ Request::is('karir') ? 'highlight-text' : '' }}"> 
                        Aktivitas
                    </a>
                </li>
                <li class="nav-item">
                    {{-- Ganti '#' dengan route yang sesuai, misal: route('perusahaan.index') --}}
                    <a class="nav-link {{ Request::is('perusahaan') ? 'highlight-text' : '' }}" href="#">Jelajahi Perusahaan</a>
                </li>
                @endif
                {{-- MODIFIKASI SELESAI --}}
            </ul>

            <div class="d-flex ms-auto">
                @auth
                    {{-- JIKA PENGGUNA SUDAH LOGIN --}}
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2 fs-5"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.dashboard') : (Auth::user()->role === 'perusahaan' ? route('perusahaan.dashboard') : route('admin.dashboard')) }}"><i class="bi bi-layout-text-sidebar-reverse me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.profile.edit') : (Auth::user()->role === 'perusahaan' ? route('perusahaan.profile.edit') : route('admin.profile.edit')) }}"><i class="bi bi-person-lines-fill me-2"></i>Lihat Profil</a></li>
                            <li><a class="dropdown-item" href=""><i class="bi bi-gear-fill me-2"></i>Pengaturan</a></li>
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
                    <a href="{{ route('perusahaan') }}" class="btn btn-orange">Untuk Perusahaan</a>
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
                        <a href="#beritaTerkiniLandingPage" class="nav-link">Berita Terkini</a>
                    </li>

                    {{-- MODIFIKASI DIMULAI DISINI (UNTUK MOBILE) --}}
                    @if(Auth::check() && Auth::user()->role === 'pelamar')
                    <li class="nav-item">
                         {{-- Ganti '#' dengan route yang sesuai, misal: route('aktivitas.index') --}}
                        <a href="#" class="nav-link {{ Request::is('karir') ? 'highlight-text' : '' }}">
                            Aktivitas
                        </a>
                    </li>
                    <li class="nav-item">
                        {{-- Ganti '#' dengan route yang sesuai, misal: route('perusahaan.index') --}}
                        <a class="nav-link {{ Request::is('perusahaan') ? 'highlight-text' : '' }}" href="#">Jelajahi Perusahaan</a>
                    </li>
                    @endif
                    {{-- MODIFIKASI SELESAI --}}
                </ul>
                
                {{-- Tombol Dinamis untuk Offcanvas --}}
                <div class="mt-auto">
                    @auth
                        <div class="text-center mb-3">
                            <i class="bi bi-person-circle me-2 fs-5"></i>
                            <span>Halo, {{ Auth::user()->name }}</span>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.dashboard') : (Auth::user()->role === 'perusahaan' ? route('perusahaan.dashboard') : route('admin.dashboard')) }}" class="btn btn-light">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Log Out</button>
                            </form>
                        </div>
                    @else
                        <div class="d-grid gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-light">MASUK</a>
                            <a href="{{ route('perusahaan') }}" class="btn btn-orange">Untuk Perusahaan</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>