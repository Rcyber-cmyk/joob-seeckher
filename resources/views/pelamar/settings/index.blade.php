{{-- /resources/views/pelamar/settings/index.blade.php --}}

@extends('pelamar.layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container py-5" style="max-width: 800px;">

    {{-- Header Halaman --}}
    <div class="page-header mb-4">
        <h1 class="page-title">Pengaturan</h1>
    </div>

    {{-- Notifikasi Sukses/Error --}}
    @if (session('status'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Error:</strong> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tab Navigasi --}}
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-person-circle me-2"></i>Akun</a>
        </li>
    </ul>

    {{-- Kartu Email (Sekarang Interaktif) --}}
    <div class="card setting-card mb-4">
        <div class="card-body">
            {{-- Bagian Tampilan Statis --}}
            <div id="view-email-section">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">Email</h5>
                        <p class="card-text text-muted mb-0">{{ $user->email }}</p>
                    </div>
                    <button id="edit-email-btn" class="btn btn-link text-decoration-none text-primary">
                        <i class="bi bi-pencil-fill"></i> Ubah
                    </button>
                </div>
            </div>

            {{-- Bagian Form Edit (Tersembunyi) --}}
            <div id="edit-email-section" style="display: none;">
                <h5 class="card-title mb-3">Ubah Alamat Email</h5>
                <form action="{{ route('pelamar.settings.updateEmail') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email Baru</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_password_email" class="form-label">Password Saat Ini (untuk konfirmasi)</label>
                        <input type="password" name="password" class="form-control" id="current_password_email" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" id="cancel-edit-email-btn" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Kartu Hapus Akun --}}
    <div class="card setting-card border-danger">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 text-danger">Hapus Akun</h5>
                    <p class="card-text text-muted mb-0">Tindakan ini akan menghapus semua data Anda secara permanen.</p>
                </div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="bi bi-trash-fill me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Konfirmasi Hapus Akun -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Konfirmasi Hapus Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda benar-benar yakin ingin menghapus akun Anda? Semua data profil, lamaran, dan aktivitas Anda akan dihapus secara permanen. **Tindakan ini tidak dapat diurungkan.**</p>
                <p>Untuk melanjutkan, silakan masukkan password Anda saat ini.</p>
                
                <form id="delete-account-form" action="{{ route('pelamar.settings.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <div class="mb-3">
                        <label for="password_delete" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password_delete" name="password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="delete-account-form" class="btn btn-danger">Ya, Hapus Akun Saya</button>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT DIPINDAHKAN KE SINI UNTUK MEMASTIKAN IA BERJALAN --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewSection = document.getElementById('view-email-section');
        const editSection = document.getElementById('edit-email-section');
        const editBtn = document.getElementById('edit-email-btn');
        const cancelBtn = document.getElementById('cancel-edit-email-btn');

        if (editBtn) {
            editBtn.addEventListener('click', () => {
                viewSection.style.display = 'none';
                editSection.style.display = 'block';
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                editSection.style.display = 'none';
                viewSection.style.display = 'block';
            });
        }
    });
</script>
@endsection

@push('styles')
<style>
    .page-title {
        font-weight: 700;
    }
    .setting-card .card-body {
        padding: 1.25rem;
    }
    .setting-card .card-title {
        font-weight: 600;
    }
</style>
@endpush
