{{-- Sidebar untuk Desktop --}}
<div class="sidebar d-none d-lg-flex flex-column">
    <div class="logo-section d-flex align-items-center">
        <i class="bi bi-briefcase-fill me-2 fs-4"></i>
        <span>Job Recruitmen</span>
    </div>
    <div><a href="{{ route('perusahaan') }}"><i class="bi bi-arrow-left"></i> <div class="back-button" onclick="showRoleChoice()"></div></a></div>
    <div class="main-menu d-flex flex-column flex-grow-1">
        <div class="menu-section mb-4">
            <p class="text-uppercase text-white-50 fw-semibold mb-2">Dashboard</p>
            <a href="{{ route('perusahaan.kandidat-pelamar.index') }}" class="nav-link {{ Request::routeIs('perusahaan.kandidat-pelamar.index') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i> Home
            </a>
            <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="nav-link {{ Request::routeIs('perusahaan.lowongan-saya.index') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Lowongan Kerja
            </a>
            <a href="{{ route('perusahaan.jadwal.index') }}" class="nav-link {{ Request::routeIs('perusahaan.jadwal.index') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> Jadwal
            </a>
            <a href="{{ route('perusahaan.notifikasi.index') }}" class="nav-link {{ Request::routeIs('perusahaan.notifikasi.index') ? 'active' : '' }}">
                <i class="bi bi-bell"></i> Notifikasi
            </a>
            <a href="#" class="nav-link">
                <i class="bi bi-gear-fill"></i> Pengaturan
            </a>
            <a href="{{ route('perusahaan.bantuan.index') }}" class="nav-link {{ Request::routeIs('perusahaan.bantuan.index') ? 'active' : '' }}">
                <i class="bi bi-question-circle-fill"></i> Bantuan
            </a>
        </div>
    </div>
    <div class="user-profile d-flex align-items-center mt-auto">
        {{-- Logika untuk menampilkan foto profil --}}
        @if (Auth::user()->profilePerusahaan)
            <img src="{{ Auth::user()->profilePerusahaan->logo_perusahaan ? asset('storage/' . Auth::user()->profilePerusahaan->logo_perusahaan) : asset('images/default-company-profile.png') }}"
                 alt="Logo Perusahaan" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
        @else
            <img src="{{ asset('images/default-company-profile.png') }}"
                 alt="Logo Default" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
        @endif
        <div class="d-flex flex-column me-auto">
            <span class="text-white fw-bold">{{ Auth::user()->name }}</span>
            <span class="text-small">{{ Auth::user()->email }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="bg-transparent border-0 log-out">
                <i class="bi bi-box-arrow-right fs-4"></i>
            </button>
        </form>
    </div>
</div>

{{-- Sidebar Offcanvas untuk Mobile --}}
<div class="offcanvas offcanvas-start d-lg-none bg-dark text-white" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
    <div class="offcanvas-header border-bottom border-secondary">
        <div class="d-flex align-items-center">
            <i class="bi bi-briefcase-fill me-2 fs-4 text-white"></i>
            <h5 class="offcanvas-title fw-bold mb-0" id="sidebarOffcanvasLabel">Job Recruitmen</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column p-3">
        <div><a href="{{ route('perusahaan') }}"><i class="bi bi-arrow-left"></i> <div class="back-button" onclick="showRoleChoice()"></div></a></div>
        <div class="menu-section mb-4">
            <p class="text-uppercase text-white-50 fw-semibold mb-3">Dashboard</p>
            <a href="{{ route('perusahaan.kandidat-pelamar.index') }}" class="nav-link text-white px-2 py-2 rounded {{ Request::routeIs('perusahaan.kandidat-pelamar.index') ? 'bg-primary' : 'hover-bg-dark' }}">
                <i class="bi bi-house-door-fill me-2"></i> Home
            </a>
            <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="nav-link text-white px-2 py-2 rounded {{ Request::routeIs('perusahaan.lowongan-saya.index') ? 'bg-primary' : 'hover-bg-dark' }}">
                <i class="bi bi-person-badge me-2"></i> Lowongan Kerja
            </a>
            <a href="{{ route('perusahaan.jadwal.index') }}" class="nav-link text-white px-2 py-2 rounded {{ Request::routeIs('perusahaan.jadwal.index') ? 'bg-primary' : 'hover-bg-dark' }}">
                <i class="bi bi-calendar-event me-2"></i> Jadwal
            </a>
            <a href="{{ route('perusahaan.notifikasi.index') }}" class="nav-link text-white px-2 py-2 rounded {{ Request::routeIs('perusahaan.notifikasi.index') ? 'bg-primary' : 'hover-bg-dark' }}">
                <i class="bi bi-bell me-2"></i> Notifikasi
            </a>
            <a href="#" class="nav-link text-white px-2 py-2 rounded hover-bg-dark">
                <i class="bi bi-gear-fill me-2"></i> Pengaturan
            </a>
            <a href="{{ route('perusahaan.bantuan.index') }}" class="nav-link text-white px-2 py-2 rounded {{ Request::routeIs('perusahaan.bantuan.index') ? 'bg-primary' : 'hover-bg-dark' }}">
                <i class="bi bi-question-circle-fill me-2"></i> Bantuan
            </a>
        </div>

        {{-- Footer user profile --}}
        <div class="user-profile mt-auto d-flex align-items-center border-top border-secondary pt-3">
            @if (Auth::user()->profilePerusahaan)
                <img src="{{ Auth::user()->profilePerusahaan->logo_perusahaan ? asset('storage/' . Auth::user()->profilePerusahaan->logo_perusahaan) : asset('images/default-company-profile.png') }}"
                     alt="Logo Perusahaan" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
            @else
                <img src="{{ asset('images/default-company-profile.png') }}"
                     alt="Logo Default" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
            @endif
            <div class="d-flex flex-column me-auto">
                <span class="fw-bold text-white">{{ Auth::user()->name }}</span>
                <span class="text-white-50 small">{{ Auth::user()->email }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="bg-transparent border-0 text-white">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </button>
            </form>
        </div>
    </div>
</div>
