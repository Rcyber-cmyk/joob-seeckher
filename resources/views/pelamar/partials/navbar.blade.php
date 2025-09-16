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
                            <i class="bi bi-person-circle me-2 fs-5"></i>
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
                        <div class="d-grid gap-2">
                            <a href="{{ Auth::user()->role === 'pelamar' ? route('pelamar.profile.edit') : '#' }}" class="btn btn-light">Profil Saya</a>
                            <a href="{{ route('pelamar.settings.index') }}" class="btn btn-light">Pengaturan</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Log Out</button>
                            </form>
                        </div>
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
