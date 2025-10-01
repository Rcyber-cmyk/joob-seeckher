@extends('perusahaan.layouts.app')

@section('content')
<style>
    /* --- CARD FILTER --- */
    .filter-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    /* --- KANDIDAT CARD --- */
    .kandidat-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .kandidat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .kandidat-card-body {
        flex-grow: 1;
    }
    .kandidat-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid var(--primary-color);
    }
    .kandidat-info span {
        display: block;
        color: #6c757d;
        font-size: 0.9rem;
    }

</style>

{{-- Header Halaman --}}
<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div class="w-100 w-md-auto">
        <h1 class="fw-bold"><i class="bi bi-search-heart me-2"></i> Cari Kandidat Pelamar</h1>
        <p class="text-muted mb-0">Temukan kandidat potensial dari seluruh pelamar.</p>
    </div>
     <a href="{{ route('perusahaan.cari-kandidat.index') }}" class="btn btn-outline-primary mt-3 mt-md-0">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>
</div>

{{-- Form Filter (DIPERBAIKI) --}}
<div class="filter-card mb-4">
    <form action="{{ route('perusahaan.kandidat.search') }}" method="GET">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="pendidikan" class="form-label fw-bold">Pendidikan Terakhir</label>
                <select name="pendidikan" id="pendidikan" class="form-select">
                    <option value="">Semua</option>
                    <option value="SMP/Sederajat" {{ $request->pendidikan == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                    <option value="SMA/SMK Sederajat" {{ $request->pendidikan == 'SMA/SMK Sederajat' ? 'selected' : '' }}>SMA/SMK Sederajat</option>
                    <option value="D1" {{ $request->pendidikan == 'D1' ? 'selected' : '' }}>D1</option>
                    <option value="D2" {{ $request->pendidikan == 'D2' ? 'selected' : '' }}>D2</option>
                    <option value="D3" {{ $request->pendidikan == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="S1" {{ $request->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ $request->pendidikan == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ $request->pendidikan == 'S3' ? 'selected' : '' }}>S3</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="pengalaman_min" class="form-label fw-bold">Min. Pengalaman (Tahun)</label>
                <input type="number" name="pengalaman_min" id="pengalaman_min" class="form-control" placeholder="Contoh: 2" value="{{ $request->pengalaman_min }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100" style="background-color: var(--primary-color); border-color: var(--primary-color);">
                    <i class="bi bi-funnel-fill me-1"></i> Cari
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Hasil Pencarian (DIPERBAIKI) --}}
<div class="row g-4">
    @forelse ($kandidat as $item)
        <div class="col-md-6 col-lg-4">
            <div class="kandidat-card">
                <div class="kandidat-card-body p-4">
                    <div class="text-center mb-3">
                        <img src="{{ $item->foto_profil ? asset('storage/' . $item->foto_profil) : asset('images/default-profile.png') }}" alt="Foto Profil" class="kandidat-img">
                    </div>
                    <div class="text-center">
                        <h5 class="fw-bold mb-1">{{ $item->user->name }}</h5>
                        <p class="text-muted small">{{ $item->user->email }}</p>
                    </div>
                    <div class="kandidat-info mt-3">
                        <span><i class="bi bi-geo-alt-fill me-2"></i> {{ $item->domisili ?: 'N/A' }}</span>
                        <span><i class="bi bi-mortarboard-fill me-2"></i> {{ $item->lulusan ?: 'N/A' }}</span>
                        <span><i class="bi bi-briefcase-fill me-2"></i> {{ $item->pengalaman_kerja ?: '0' }} Tahun Pengalaman</span>
                    </div>
                </div>
                <div class="p-3 bg-light text-center d-flex gap-2">
                    @if($item->lamaran->isNotEmpty())
                        <a href="{{ route('perusahaan.pelamar.detail', ['lowongan_id' => $item->lamaran->first()->lowongan_id, 'pelamar_id' => $item->id]) }}" class="btn btn-outline-primary btn-sm w-100">
                            Profil
                        </a>
                    @endif
                     <button class="btn btn-success btn-sm w-100 invite-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#inviteModal"
                            data-pelamar-id="{{ $item->id }}"
                            data-pelamar-name="{{ $item->user->name }}">
                        <i class="bi bi-send-fill me-1"></i> Undang
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center p-5 bg-white rounded shadow-sm">
                <i class="bi bi-person-x-fill display-4 text-muted"></i>
                <h4 class="mt-3">Kandidat Tidak Ditemukan</h4>
                <p class="text-muted">Coba ubah atau reset filter pencarian Anda.</p>
                <a href="{{ route('perusahaan.kandidat.search') }}" class="btn btn-primary mt-2">Reset Filter</a>
            </div>
        </div>
    @endforelse
</div>


{{-- Modal untuk Mengundang (DITAMBAHKAN KEMBALI) --}}
<div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="inviteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inviteModalLabel">Undang Kandidat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="inviteForm">
                    @csrf
                    <input type="hidden" name="pelamar_id" id="pelamarIdInput">
                    <p>Anda akan mengundang <strong id="pelamarName"></strong> untuk melamar pada posisi:</p>
                    
                    <div class="mb-3">
                        <label for="lowonganIdSelect" class="form-label">Pilih Lowongan Aktif</label>
                        <select class="form-select" name="lowongan_id" id="lowonganIdSelect" required>
                            <option value="" disabled selected>-- Pilih Posisi --</option>
                            @forelse ($lowonganAktif as $lowongan)
                                <option value="{{ $lowongan->id }}">{{ $lowongan->judul_lowongan }}</option>
                            @empty
                                <option value="" disabled>Anda tidak memiliki lowongan aktif</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pesanInput" class="form-label">Pesan (Opsional)</label>
                        <textarea class="form-control" name="pesan" id="pesanInput" rows="4" placeholder="Contoh: Halo, kami melihat profil Anda dan tertarik untuk mengundang Anda melamar di posisi Web Developer kami."></textarea>
                    </div>

                    <div class="alert alert-info" id="form-feedback" style="display: none;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="sendInviteBtn">Kirim Undangan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inviteModal = document.getElementById('inviteModal');
    if(inviteModal) {
        const inviteForm = document.getElementById('inviteForm');
        const sendInviteBtn = document.getElementById('sendInviteBtn');
        const feedbackDiv = document.getElementById('form-feedback');

        // Saat modal akan ditampilkan
        inviteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const pelamarId = button.getAttribute('data-pelamar-id');
            const pelamarName = button.getAttribute('data-pelamar-name');

            // Isi data ke dalam modal
            const modalTitle = inviteModal.querySelector('.modal-title');
            const pelamarNameEl = inviteModal.querySelector('#pelamarName');
            const pelamarIdInput = inviteModal.querySelector('#pelamarIdInput');

            modalTitle.textContent = 'Undang ' + pelamarName;
            pelamarNameEl.textContent = pelamarName;
            pelamarIdInput.value = pelamarId;
        });

        // Saat tombol "Kirim Undangan" diklik
        sendInviteBtn.addEventListener('click', function () {
            const pelamarId = document.getElementById('pelamarIdInput').value;
            const formData = new FormData(inviteForm);
            const actionUrl = `/perusahaan/kandidat/${pelamarId}/undang`;
            
            sendInviteBtn.disabled = true;
            sendInviteBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...';
            feedbackDiv.style.display = 'none';

            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                feedbackDiv.style.display = 'block';
                if (data.success) {
                    feedbackDiv.className = 'alert alert-success';
                    feedbackDiv.textContent = data.message;
                    inviteForm.reset();
                    setTimeout(() => {
                        bootstrap.Modal.getInstance(inviteModal).hide();
                    }, 2000);
                } else {
                    feedbackDiv.className = 'alert alert-danger';
                    feedbackDiv.textContent = data.message || 'Terjadi kesalahan.';
                }
            })
            .catch(error => {
                feedbackDiv.style.display = 'block';
                feedbackDiv.className = 'alert alert-danger';
                feedbackDiv.textContent = 'Terjadi kesalahan jaringan. Silakan coba lagi.';
                console.error('Error:', error);
            })
            .finally(() => {
                sendInviteBtn.disabled = false;
                sendInviteBtn.innerHTML = 'Kirim Undangan';
            });
        });
    }
});
</script>
@endpush

