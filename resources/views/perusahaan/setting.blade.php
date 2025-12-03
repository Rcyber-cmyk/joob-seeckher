@extends('perusahaan.layouts.app')

@section('title', 'Pengaturan Akun')

@push('styles')
<style>
    /* ---------------------------------------------------------
       SIDEBAR
    ----------------------------------------------------------*/
    .settings-sidebar-card {
        background-color: #ffffff;
        border: none;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }

    .profile-logo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        background: #fdf1e7;
        padding: 12px;
    }

    .settings-sidebar-card .nav-pills .nav-link {
        color: #6c757d;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        transition: 0.2s;
    }

    .settings-sidebar-card .nav-pills .nav-link .bi {
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }

    .settings-sidebar-card .nav-pills .nav-link.active {
        background: #ff7b00;
        color: #fff;
        box-shadow: 0 4px 12px rgba(255,123,0,0.25);
    }

    .settings-sidebar-card .nav-pills .nav-link:hover:not(.active) {
        background-color: #f7f7f7;
    }

    /* ---------------------------------------------------------
       CONTENT CARD
    ----------------------------------------------------------*/
    .settings-content-card {
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 2.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        border: 1px solid #dcdcdc;
    }

    .form-control:focus {
        border-color: #ff7b00;
        box-shadow: 0 0 0 0.25rem rgba(255,123,0,0.25);
    }

    /* Show / Hide Password */
    .password-wrapper {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
        font-size: 1.1rem;
    }

    .btn-simpan {
        background-color: #ff7b00;
        color: #ffffff;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        border: none;
        font-weight: 600;
        width: 100%;
        transition: 0.2s;
    }
    .btn-simpan:hover {
        background-color: #e66f00;
    }

    /* FAQ ACCORDION */
    .faq-accordion .accordion-button {
        font-weight: 500;
        color: #444;
    }
    .faq-accordion .accordion-button:not(.collapsed) {
        background-color: #ffe5cc;
        color: #ff7b00;
        box-shadow: none;
    }
</style>
@endpush

@section('content')
    <div class="header-dashboard mb-4">
        <h1>Pengaturan Perusahaan</h1>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('status'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i> {{ session('status') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong><i class="bi bi-exclamation-circle me-2"></i>Terjadi Kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- SIDEBAR --}}
        <div class="col-lg-3">
            <div class="settings-sidebar-card text-center">

                <img src="{{ Auth::user()->profilePerusahaan->logo_perusahaan 
                        ? asset('storage/' . Auth::user()->profilePerusahaan->logo_perusahaan)
                        : asset('images/default-company-profile.png') }}"
                     class="profile-logo" alt="Logo Perusahaan">

                <h5 class="mt-3">{{ Auth::user()->profilePerusahaan->nama_perusahaan }}</h5>

                <ul class="nav nav-pills flex-column mt-4">
                    <li class="nav-item mb-2">
                        <a class="nav-link" href="{{ route('perusahaan.profile.edit') }}">
                            <i class="bi bi-person"></i> Edit Profil
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link active" href="{{ route('perusahaan.settings.edit') }}">
                            <i class="bi bi-lock"></i> Email & Password
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-lg-9">
            <div class="settings-content-card">

                <form method="POST" action="{{ route('perusahaan.settings.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="row g-4">
                        <div class="col-md-7">

                            {{-- EMAIL --}}
                            <h5 class="mb-3">Alamat Email</h5>

                            <div class="mb-4">
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    name="email"
                                    value="{{ old('email', Auth::user()->email) }}"
                                    required
                                >
                                <div class="form-text">Email utama untuk notifikasi & akses akun.</div>
                            </div>

                            {{-- PASSWORD --}}
                            <h5 class="mb-3 mt-4">Ubah Password</h5>

                            <div class="mb-4 password-wrapper">
                                <label class="form-label">Password Saat Ini</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>

                            <div class="mb-4 password-wrapper">
                                <label class="form-label">Password Baru</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>

                            <div class="mb-4 password-wrapper">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn-simpan">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>

                        </div>

                        {{-- FAQ --}}
                        <div class="col-md-5">

                            <h5 class="mb-3">Bantuan Cepat</h5>

                            <div class="accordion faq-accordion" id="faqAccordion">

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq1">
                                            Bagaimana menempatkan posisi organisasi?
                                        </button>
                                    </h2>
                                    <div id="collapseFaq1" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            Atur struktur organisasi melalui menu Profil Perusahaan.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq2">
                                            Bisakah saya mengatur ulang lamaran pelamar?
                                        </button>
                                    </h2>
                                    <div id="collapseFaq2" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            Semua lamaran dikelola di menu *Pelamar* pada Lowongan.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq3">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFaq3">
                                            Bagaimana melihat riwayat lamaran?
                                        </button>
                                    </h2>
                                    <div id="collapseFaq3" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            Riwayat lamaran dapat dilihat dalam halaman Pelamar.
                                        </div>
                                    </div>
                                    <div class="mt-4 p-3" style="background: #fff7ef; border-radius: 0.75rem; border: 1px solid #ffe2c6;">
                                        <h6 class="mb-2" style="color:#ff7b00; font-weight:600;">
                                            <i class="bi bi-envelope-open me-2"></i>Hubungi Admin
                                        </h6>

                                        <p class="mb-2" style="color:#444; font-size:0.95rem;">
                                            Jika Anda membutuhkan bantuan lebih lanjut, Anda dapat menghubungi admin melalui email berikut:
                                        </p>

                                        <a href="mailto:admin@joblink.id" class="fw-bold" 
                                        style="color:#ff7b00; text-decoration:none; font-size:1rem;">
                                            admin@joblink.id
                                        </a>

                                        <p class="mt-2 mb-0" style="font-size:0.85rem; color:#6c757d;">
                                            Waktu respon rata-rata: 5–30 menit
                                        </p>
                                    </div>
                                </div>

                            </div>

                        </div> {{-- End FAQ --}}
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
