{{-- /resources/views/pelamar/settings/index.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
{{-- HAPUS FOOTER --}}
<style>footer.footer { display: none !important; }</style>

<div class="settings-page bg-light" style="min-height: 100vh;">
    <div class="container py-5">
        
        {{-- Header Halaman --}}
        <div class="row mb-4 align-items-end">
            <div class="col-md-8">
                <h2 class="fw-bold text-dark mb-1">Pengaturan</h2>
                <p class="text-muted mb-0">Kelola preferensi akun, keamanan, dan privasi Anda.</p>
            </div>
        </div>

        {{-- Alert Global --}}
        @if (session('status'))
             <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                <div>{{ session('status') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-3 d-flex align-items-center mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                <div>{{ $errors->first() }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            {{-- 1. SIDEBAR MENU (KIRI) --}}
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden sticky-top" style="top: 20px; z-index: 1;">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush" id="settingsTab" role="tablist">
                            <a class="list-group-item list-group-item-action active p-3 d-flex align-items-center gap-3" id="account-tab" data-bs-toggle="list" href="#account" role="tab">
                                <i class="bi bi-person-circle fs-5"></i> <span class="fw-medium">Akun Saya</span>
                            </a>
                            <a class="list-group-item list-group-item-action p-3 d-flex align-items-center gap-3" id="security-tab" data-bs-toggle="list" href="#security" role="tab">
                                <i class="bi bi-shield-lock fs-5"></i> <span class="fw-medium">Keamanan</span>
                            </a>
                            <a class="list-group-item list-group-item-action p-3 d-flex align-items-center gap-3" id="notification-tab" data-bs-toggle="list" href="#notification" role="tab">
                                <i class="bi bi-bell fs-5"></i> <span class="fw-medium">Notifikasi</span>
                            </a>
                            <a class="list-group-item list-group-item-action p-3 d-flex align-items-center gap-3" id="privacy-tab" data-bs-toggle="list" href="#privacy" role="tab">
                                <i class="bi bi-eye fs-5"></i> <span class="fw-medium">Privasi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. KONTEN TAB (KANAN) --}}
            <div class="col-lg-9">
                <div class="tab-content" id="settingsTabContent">
                    
                    {{-- TAB 1: AKUN SAYA (Email & Hapus) --}}
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
                        
                        {{-- Card Email --}}
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white border-bottom p-4">
                                <h5 class="mb-0 fw-bold">Informasi Login</h5>
                            </div>
                            <div class="card-body p-4">
                                <div id="view-email-section" class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.75rem;">Alamat Email</small>
                                        <span class="fw-medium fs-5 text-dark">{{ $user->email }}</span>
                                        @if($user->email_verified_at)
                                            <i class="bi bi-patch-check-fill text-success ms-2" title="Terverifikasi"></i>
                                        @endif
                                    </div>
                                    <button id="edit-email-btn" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">Ubah</button>
                                </div>

                                {{-- Form Ubah Email (Hidden) --}}
                                <div id="edit-email-section" style="display: none;" class="bg-light p-4 rounded-3 mt-3 border">
                                    <form action="{{ route('pelamar.settings.updateEmail') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Email Baru</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label small fw-bold">Konfirmasi Password Saat Ini</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <button type="button" id="cancel-edit-email-btn" class="btn btn-light border">Batal</button>
                                            <button type="submit" class="btn btn-orange text-white">Simpan Email</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Card Hapus Akun --}}
                        <div class="card border border-danger border-opacity-25 shadow-sm rounded-4 bg-danger bg-opacity-10">
                            <div class="card-body p-4">
                                <h5 class="text-danger fw-bold mb-2">Zona Bahaya</h5>
                                <p class="text-muted small mb-3">
                                    Menghapus akun akan menghilangkan semua data lamaran, profil, dan riwayat Anda secara permanen. Tindakan ini tidak dapat dibatalkan.
                                </p>
                                <button type="button" class="btn btn-danger px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                    Hapus Akun Saya
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- TAB 2: KEAMANAN (Ubah Password) --}}
                    <div class="tab-pane fade" id="security" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-white border-bottom p-4">
                                <h5 class="mb-0 fw-bold">Ubah Kata Sandi</h5>
                            </div>
                            <div class="card-body p-4">
                                {{-- Form Ubah Password (Pastikan route update-password dibuat nanti) --}}
                                <form action="#" method="POST"> 
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Kata Sandi Saat Ini</label>
                                        <input type="password" name="current_password" class="form-control">
                                    </div>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Kata Sandi Baru</label>
                                            <input type="password" name="new_password" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Konfirmasi Kata Sandi Baru</label>
                                            <input type="password" name="new_password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-orange text-white px-4" disabled>Simpan Password (Demo)</button>
                                        <small class="d-block text-muted mt-2 fst-italic">*Fitur ini perlu backend controller</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- TAB 3: NOTIFIKASI --}}
                    <div class="tab-pane fade" id="notification" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-white border-bottom p-4">
                                <h5 class="mb-0 fw-bold">Preferensi Notifikasi</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-4 border-bottom pb-3">
                                    <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                        <div>
                                            <label class="form-check-label fw-bold" for="notifLowongan">Rekomendasi Lowongan</label>
                                            <p class="text-muted small mb-0">Terima email tentang lowongan pekerjaan baru yang sesuai profil Anda.</p>
                                        </div>
                                        <input class="form-check-input ms-auto" type="checkbox" id="notifLowongan" checked>
                                    </div>
                                </div>
                                <div class="mb-4 border-bottom pb-3">
                                    <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                        <div>
                                            <label class="form-check-label fw-bold" for="notifLamaran">Status Lamaran</label>
                                            <p class="text-muted small mb-0">Beritahu saya ketika status lamaran saya berubah (Dilihat/Diterima).</p>
                                        </div>
                                        <input class="form-check-input ms-auto" type="checkbox" id="notifLamaran" checked>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-check form-switch d-flex justify-content-between align-items-center ps-0">
                                        <div>
                                            <label class="form-check-label fw-bold" for="notifPromo">Berita & Tips Karir</label>
                                            <p class="text-muted small mb-0">Kirimkan tips karir mingguan dan berita industri.</p>
                                        </div>
                                        <input class="form-check-input ms-auto" type="checkbox" id="notifPromo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TAB 4: PRIVASI --}}
                    <div class="tab-pane fade" id="privacy" role="tabpanel">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-white border-bottom p-4">
                                <h5 class="mb-0 fw-bold">Visibilitas Profil</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="visibility" id="publicProfile" checked>
                                    <label class="form-check-label" for="publicProfile">
                                        <span class="d-block fw-bold text-dark">Publik (Direkomendasikan)</span>
                                        <span class="text-muted small">Profil Anda dapat ditemukan oleh perusahaan dan HRD yang mencari kandidat.</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="visibility" id="privateProfile">
                                    <label class="form-check-label" for="privateProfile">
                                        <span class="d-block fw-bold text-dark">Pribadi</span>
                                        <span class="text-muted small">Profil Anda disembunyikan. Anda hanya bisa melamar kerja, tapi tidak bisa dicari oleh perusahaan.</span>
                                    </label>
                                </div>
                                <div class="text-end mt-4">
                                     <button type="button" class="btn btn-orange text-white px-4">Simpan Preferensi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Hapus Akun Permanen?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted mb-4">Tindakan ini <strong>tidak dapat dibatalkan</strong>. Silakan masukkan password Anda untuk mengonfirmasi penghapusan.</p>
                <form id="delete-account-form" action="{{ route('pelamar.settings.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password Anda" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 pt-0 px-4 pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="delete-account-form" class="btn btn-danger rounded-pill px-4">Ya, Hapus Akun</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* === Base Styles === */
    .text-orange { color: #F39C12 !important; }
    .bg-orange { background-color: #F39C12 !important; }
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: white; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; color: white; }

    /* Form Controls */
    .form-control:focus, .form-check-input:focus {
        border-color: #F39C12; 
        box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
    }
    .form-check-input:checked {
        background-color: #F39C12; 
        border-color: #F39C12;
    }

    /* === DESKTOP STYLES (Layar Besar) === */
    @media (min-width: 992px) {
        .list-group-item {
            border: none; 
            border-radius: 0.5rem !important; 
            margin-bottom: 0.25rem;
            color: #495057; 
            transition: all 0.2s;
            font-size: 0.95rem;
        }
        .list-group-item:hover { background-color: #f8f9fa; color: #F39C12; }
        .list-group-item.active {
            background-color: #FFF8E1; 
            color: #F39C12; 
            font-weight: 600; 
            border: none;
        }
        .list-group-item.active i { color: #F39C12; }
    }

    /* === MOBILE STYLES (Layar Kecil) - INI YANG KITA UBAH TOTAL === */
    @media (max-width: 991.98px) {
        /* 1. Container Menu */
        .col-lg-3 { padding-bottom: 0; }
        .col-lg-3 .card {
            background: transparent; 
            box-shadow: none !important; 
            border: none;
            margin-bottom: 1rem;
        }
        .col-lg-3 .card-body { padding: 0; }
        
        /* 2. Menu jadi Tab Horizontal Bersih */
        .list-group {
            flex-direction: row; 
            overflow-x: auto; 
            white-space: nowrap; 
            border-bottom: 1px solid #dee2e6; /* Garis pemisah di bawah */
            padding-bottom: 0;
            /* Sembunyikan scrollbar */
            -ms-overflow-style: none; 
            scrollbar-width: none; 
        }
        .list-group::-webkit-scrollbar { display: none; }
        
        /* Item Tab */
        .list-group-item {
            background: transparent !important;
            border: none !important;
            border-radius: 0 !important;
            padding: 0.8rem 1.2rem;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 0;
        }
        
        /* State Aktif (Garis Bawah Oranye) */
        .list-group-item.active {
            color: #F39C12 !important;
            background: transparent !important;
            border-bottom: 3px solid #F39C12 !important; /* Garis bawah tebal */
            font-weight: 700;
        }
        .list-group-item.active i { color: #F39C12; }

        /* 3. Perbaikan Layout Konten di Mobile */
        #view-email-section {
            flex-direction: column; /* Susun vertikal */
            align-items: flex-start !important;
        }
        #view-email-section > div {
            width: 100%;
            margin-bottom: 1rem;
        }
        
        /* Tombol Ubah jadi Outline Oranye & Full Width */
        #edit-email-btn {
            width: 100%;
            padding: 0.6rem;
            border-color: #dee2e6;
            color: #495057;
        }
        #edit-email-btn:hover {
            border-color: #F39C12;
            color: #F39C12;
            background: white;
        }
        
        /* Card Zona Bahaya */
        .card-body .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }
        .card-body .d-flex button { width: 100%; }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Logic untuk toggle form email (sama seperti sebelumnya)
        const viewSection = document.getElementById('view-email-section');
        const editSection = document.getElementById('edit-email-section');
        const editBtn = document.getElementById('edit-email-btn');
        const cancelBtn = document.getElementById('cancel-edit-email-btn');

        if (editBtn) {
            editBtn.addEventListener('click', () => {
                viewSection.classList.add('d-none');
                viewSection.classList.remove('d-flex');
                editSection.style.display = 'block';
            });
        }
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                editSection.style.display = 'none';
                viewSection.classList.remove('d-none');
                viewSection.classList.add('d-flex');
            });
        }
    });
</script>
@endpush