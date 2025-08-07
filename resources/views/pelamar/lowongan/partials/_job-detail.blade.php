{{-- /resources/views/pelamar/lowongan/partials/_job-detail.blade.php --}}
<div class="job-detail-container">
    @if($detailLowongan)
    <div id="job-detail-content">
        <div class="d-flex align-items-center mb-4">
            {{-- Menggunakan optional chaining (?->) untuk keamanan --}}
            <img id="detail-logo" src="{{ $detailLowongan->perusahaan?->logo ? asset('storage/' . $detailLowongan->perusahaan->logo) : 'https://placehold.co/80x80/e9ecef/343a40?text=' . substr($detailLowongan->perusahaan?->nama_perusahaan ?? 'N/A', 0, 1) }}" alt="Logo" class="company-logo-detail">
            <div class="ms-3">
                <h4 id="detail-title" class="job-title-detail">{{ $detailLowongan->judul_lowongan }}</h4>
                <p id="detail-company" class="company-name-detail text-muted mb-1">{{ $detailLowongan->perusahaan?->nama_perusahaan ?? 'Perusahaan Tidak Tersedia' }}</p>
                <p id="detail-location" class="location-detail text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $detailLowongan->perusahaan?->alamat_perusahaan ?? 'Lokasi Tidak Tersedia' }}</p>
            </div>
        </div>

        <div class="detail-actions mb-4">
            {{-- PERUBAHAN DI SINI: Mengganti route() ke 'lowongan.lamar.form' dan method menjadi GET (karena ini adalah link) --}}
            <a href="{{ route('lowongan.lamar.form', $detailLowongan->id) }}" class="btn btn-orange btn-lg">Lamar Sekarang</a>
            
            <form id="form-simpan" action="{{ route('lowongan.toggleSimpan', $detailLowongan->id) }}" method="POST" class="d-inline">
                @csrf
                <button id="btn-simpan" type="submit" class="btn btn-outline-secondary btn-lg">
                    @if(in_array($detailLowongan->id, $saved_lowongan_ids))
                        <i class="bi bi-bookmark-check-fill"></i> Tersimpan
                    @else
                        <i class="bi bi-bookmark"></i> Simpan
                    @endif
                </button>
            </form>
        </div>

        <h6 class="detail-section-title">Deskripsi Pekerjaan</h6>
        <div id="detail-description" class="job-description-detail">
           {!! nl2br(e($detailLowongan->deskripsi_pekerjaan)) !!}
        </div>
    </div>
    @else
    <div class="text-center empty-state p-5">
        <h5>Pilih Lowongan</h5>
        <p>Pilih salah satu lowongan di sebelah kiri untuk melihat detailnya.</p>
    </div>
    @endif
</div>

{{-- Style ini khusus untuk partial, agar tetap terlihat bagus saat dimuat terpisah --}}
<style>
    .job-detail-container {
        background-color: #fff;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        padding: 2rem;
        position: sticky;
        top: 20px;
        min-height: 500px; /* Menjaga tinggi konsisten */
    }
    .company-logo-detail { width: 80px; height: 80px; object-fit: contain; border-radius: 0.75rem; }
    .job-title-detail { font-weight: 700; font-size: 1.5rem; }
    .company-name-detail, .location-detail { font-size: 1rem; }
    .detail-section-title { font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; }
    .job-description-detail { color: #6c757d; line-height: 1.6; }
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: #fff; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; }
</style>
