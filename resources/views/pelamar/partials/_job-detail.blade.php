{{-- Simpan sebagai /resources/views/pelamar/lowongan/partials/_job-detail.blade.php --}}
<div class="job-detail-container">
    @if($detailLowongan)
    <div id="job-detail-content">
        <div class="d-flex align-items-center mb-3">
            <img id="detail-logo" src="{{ $detailLowongan->perusahaan->logo ? asset('storage/' . $detailLowongan->perusahaan->logo) : 'https://placehold.co/80x80/e9ecef/343a40?text=' . substr($detailLowongan->perusahaan->nama_perusahaan, 0, 1) }}" alt="Logo" class="company-logo-detail">
            <div class="ms-3">
                <h4 id="detail-title" class="job-title-detail">{{ $detailLowongan->judul_lowongan }}</h4>
                <p id="detail-company" class="company-name-detail text-muted mb-1">{{ $detailLowongan->perusahaan->nama_perusahaan }}</p>
            </div>
        </div>

        <div class="detail-info-grid mb-4">
            <div><i class="bi bi-geo-alt-fill"></i> <span id="detail-location">{{ $detailLowongan->perusahaan->alamat_perusahaan }}</span></div>
            <div><i class="bi bi-clock-fill"></i> <span>Full Time</span></div>
            <div><i class="bi bi-cash-stack"></i> <span>Rp 7.000.000 - 9.000.000 per month</span></div>
        </div>

        <div class="detail-actions mb-4">
            <form id="form-lamar" action="{{ route('lowongan.lamar', $detailLowongan->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">Lamar</button>
            </form>
            <form id="form-simpan" action="{{ route('lowongan.toggleSimpan', $detailLowongan->id) }}" method="POST" class="d-inline">
                @csrf
                <button id="btn-simpan" type="submit" class="btn btn-outline-secondary btn-lg">
                    @if(in_array($detailLowongan->id, $saved_lowongan_ids))
                        <i class="bi bi-bookmark-check-fill"></i>
                    @else
                        <i class="bi bi-bookmark"></i>
                    @endif
                </button>
            </form>
        </div>

        <div class="detail-section">
            <h6 class="detail-section-title">Tentang Perusahaan:</h6>
            <p id="detail-company-desc">{{ $detailLowongan->perusahaan->deskripsi }}</p>
        </div>
        
        <div class="detail-section">
            <h6 class="detail-section-title">Deskripsi:</h6>
            <div id="detail-description" class="job-description-detail">
               {!! nl2br(e($detailLowongan->deskripsi_pekerjaan)) !!}
            </div>
        </div>

        <div class="detail-section">
            <img id="detail-banner" src="{{ $detailLowongan->perusahaan->banner ? asset('storage/' . $detailLowongan->perusahaan->banner) : 'https://placehold.co/600x300/e9ecef/343a40?text=Banner+Perusahaan' }}" class="img-fluid rounded" alt="Banner Perusahaan">
        </div>
    </div>
    @else
    <div class="text-center empty-state">
        <h5>Pilih Lowongan</h5>
        <p>Pilih salah satu lowongan di sebelah kiri untuk melihat detailnya.</p>
    </div>
    @endif
</div>
