@extends('perusahaan.layouts.app')

@section('title', 'Pengaturan Akun')

{{-- CSS khusus untuk halaman pengaturan ini tetap diperlukan --}}
@push('styles')
<style>
    /* Card khusus untuk sidebar pengaturan */
    .settings-sidebar-card {
        background-color: white;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }
    .profile-logo {
        width: 100px; /* Ukuran sesuai gambar */
        height: 100px;
        object-fit: contain; /* Agar logo tidak terpotong */
        border-radius: 50%; /* Bentuk lingkaran */
        background-color: #fceee3; /* Warna latar belakang lingkaran */
        padding: 10px; /* Padding di dalam lingkaran */
    }
    .settings-sidebar-card .nav-pills .nav-link {
        color: #6c757d;
        padding: 0.75rem 1rem;
        text-align: left;
        border-radius: 0.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    .settings-sidebar-card .nav-pills .nav-link .bi {
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }
    .settings-sidebar-card .nav-pills .nav-link.active {
        background-color: #ff7b00;
        color: white;
    }
    .settings-sidebar-card .nav-pills .nav-link:hover:not(.active) {
        background-color: #f0f0f0; /* Hover effect untuk non-active link */
    }

    /* Card khusus untuk konten utama pengaturan */
    .settings-content-card {
        background-color: white;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        padding: 2.5rem;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        border: 1px solid #dee2e6;
    }
    .form-control:focus {
        border-color: #ff7b00;
        box-shadow: 0 0 0 0.25rem rgba(255,123,0,0.25);
    }
    .btn-simpan {
        background-color: #ff7b00;
        color: white;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        border: none;
        display: flex; /* Untuk ikon */
        align-items: center;
        justify-content: center;
    }
    .btn-simpan:hover {
        background-color: #e66f00;
        color: white;
    }
    .faq-link {
        display: block;
        text-decoration: none;
        color: #6c757d; /* Warna teks FAQ */
        padding: 0.5rem 0;
        font-weight: 500;
        font-size: 0.95rem; /* Ukuran teks FAQ */
    }
    .faq-link:hover {
        color: #ff7b00; /* Warna hover FAQ */
    }
    .search-input-group {
        position: relative;
    }
    .search-input-group .form-control {
        padding-left: 2.5rem;
    }
    .search-input-group .bi-search {
        position: absolute;
        left: 0.8rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    .btn-hubungi-kami {
        background-color: #ff7b00;
        color: white;
        font-weight: 600;
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        border: none;
    }
    .btn-hubungi-kami:hover {
        background-color: #e66f00;
    }
    .form-text {
        font-size: 0.875em; /* Ukuran teks bantuan di bawah input */
        color: #6c757d;
    }
    .status-verified {
        color: #28a745; /* Warna hijau untuk Verified */
        font-weight: 500;
        font-size: 0.85rem;
    }
</style>
@endpush

@section('content')
    {{-- Header Halaman --}}
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="w-100 w-md-auto mb-3 mb-md-0">
            <h1>Pengaturan Perusahaan</h1>
            {{-- Mengubah teks subtitle sesuai gambar --}}
        </div>
    </div>

    {{-- Konten unik untuk halaman pengaturan --}}
    <div class="row g-4 align-items-start">
        <div class="col-lg-3">
            <div class="settings-sidebar-card">
                <div class="text-center mb-4">
                    {{-- Ganti dengan path logo perusahaan dari database --}}
                    <img src="{{ Auth::user()->profilePerusahaan->logo_perusahaan ? asset('storage/' . Auth::user()->profilePerusahaan->logo_perusahaan) : asset('images/default-company-profile.png') }}"
                     alt="Logo Perusahaan" class="rounded-circle me-10" style="width: 200px; height: 200px; object-fit: cover;">
                    <h5 class="mt-3 mb-1">{{ Auth::user()->profilePerusahaan->nama_perusahaan ?? 'Perusahaan' }}</h5>
                </div>
                <ul class="nav nav-pills flex-column mt-4">
                    <li class="nav-item mb-2">
                        <a class="nav-link" href="{{ route('perusahaan.profile.edit') }}">
                            <i class="bi bi-person"></i>Edit Profil
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link active" href="{{ route('perusahaan.settings.edit') }}">
                            <i class="bi bi-lock"></i>Email & Password
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="settings-content-card">
                <form method="POST" action="{{ route('perusahaan.settings.update') }}">
                    @csrf
                    @method('PATCH')
                    
                    <div class="row g-4">
                        {{-- Kolom Kiri untuk Email & Password --}}
                        <div class="col-md-7">
                            <h5 class="mb-3">Alamat Email</h5>
                            <div class="mb-4">
                                <label for="email" class="form-label visually-hidden">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email ?? 'contact@perusahaan.com' }}">
                            </div>
                            <div class="mb-4">
                                <input type="password" class="form-control" id="password" name="password" placeholder="********">
                            </div>
                            <div class="form-text">Email utama untuk notifikasi dan komunikasi</div>
                        </div>

                        {{-- Kolom Kanan untuk Bantuan --}}
                        <div class="col-md-5">
                            <h5 class="mb-3">Butuh Bantuan Langsung?</h5>
                            <div class="search-input-group mb-4">
                                <i class="bi bi-search"></i>
                                <input type="search" class="form-control" placeholder="Cari topik atau pertanyaan...">
                            </div>
                            <div class="mb-4">
                                <h5 class="mb-3">Hubungi Kami</h5>
                                <a href="#" class="btn btn-hubungi-kami">Hubungi Kami</a>
                            </div>

                            <h5 class="mb-2 mt-5">Pertanyaan Umum</h5>
                            <div>
                                <a href="#" class="faq-link"><i class="bi bi-chevron-right me-2"></i>Bagaimana menempatkan posisi atau jabatan di struktur organisasi?</a>
                                <a href="#" class="faq-link"><i class="bi bi-chevron-right me-2"></i>Apakah saya bisa mengatur ulang lamaran yang sudah dikirim?</a>
                                <a href="#" class="faq-link"><i class="bi bi-chevron-right me-2"></i>Bagaimana mengelola kembali lamaran yang sudah dibuat sebelumnya?</a>
                            </div>
                        </div>
                    </div> {{-- End row --}}
                </form>
            </div>
        </div>
    </div>
@endsection