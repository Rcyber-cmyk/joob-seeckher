{{-- /resources/views/pelamar/lowongan/partials/_job-detail.blade.php --}}
<div class="job-detail-container">
    @if($detailLowongan)
    <div id="job-detail-content">
        <div class="d-flex align-items-center mb-4">
            {{-- Menggunakan optional chaining (?->) untuk keamanan --}}
            <img id="detail-logo" src="{{ $detailLowongan->perusahaan?->logo_perusahaan ? asset('storage/' . $detailLowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/80x80/e9ecef/343a40?text=' . substr($detailLowongan->perusahaan?->nama_perusahaan ?? 'N/A', 0, 1) }}" alt="Logo" class="company-logo-detail">
            <div class="ms-3">
                <h4 id="detail-title" class="job-title-detail">{{ $detailLowongan->judul_lowongan }}</h4>
                <p id="detail-company" class="company-name-detail text-muted mb-1">{{ $detailLowongan->perusahaan?->nama_perusahaan ?? 'Perusahaan Tidak Tersedia' }}</p>
                <p id="detail-location" class="location-detail text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $detailLowongan->perusahaan?->alamat_perusahaan ?? 'Lokasi Tidak Tersedia' }}</p>
            </div>
        </div>

        <div class="detail-actions mb-4">
            {{-- CEK STATUS LAMARAN --}}
            @if($sudahMelamar)
                {{-- Jika sudah melamar, tampilkan tombol disabled --}}
                <button class="btn btn-success btn-lg disabled">
                    <i class="bi bi-check-circle-fill me-2"></i> Anda Sudah Melamar
                </button>
            @else
                {{-- Jika belum, tampilkan tombol Lamar --}}
                <a href="{{ route('lowongan.lamar.form', $detailLowongan->id) }}" class="btn btn-orange btn-lg">Lamar Sekarang</a>
            @endif
            
            {{-- Tombol Simpan (tidak berubah) --}}
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
{{-- Style ini khusus untuk partial, agar tetap terlihat bagus saat dimuat terpisah --}}
<style>
    .job-detail-container {
        background-color: #fff;
        border-radius: 0.75rem;
        border: 1px solid #dee2e6;
        padding: 2.5rem; /* Padding ditambah */
        position: sticky;
        top: 20px;
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,.04); /* Shadow halus */
        /* min-height: 500px; */ /* Dihapus agar tinggi menyesuaikan konten */
    }

    /* --- Header Detail --- */
    .company-logo-detail {
        width: 70px; /* Ukuran disesuaikan */
        height: 70px;
        object-fit: contain;
        border-radius: 0.75rem;
        border: 1px solid #eee; /* Border tipis di logo */
        flex-shrink: 0;
    }
    .job-title-detail {
        font-weight: 700;
        font-size: 1.6rem; /* Ukuran font judul */
        color: #212529;
        line-height: 1.3; /* Spasi baris */
        margin-bottom: 0.25rem; /* Jarak ke nama perusahaan */
    }
    .company-name-detail {
        font-size: 1rem;
        font-weight: 500; /* Sedikit tebal */
        color: #495057; /* Warna sedikit lebih gelap */
    }
    .location-detail {
        font-size: 0.95rem;
        color: #6c757d;
    }
    .location-detail i { color: #F39C12; margin-right: 0.3rem; } /* Warna dan jarak ikon */

    /* --- Tombol Aksi --- */
    .detail-actions {
        margin-top: 1rem; /* Jarak dari header */
        margin-bottom: 2rem !important; /* Jarak ke deskripsi (pakai !important karena ada mb-4 inline) */
        display: flex; /* Pakai flexbox */
        gap: 0.75rem; /* Jarak antar tombol */
        flex-wrap: wrap; /* Agar tombol turun jika layar kecil */
    }
    .detail-actions .btn {
        font-weight: 500; /* Font tombol sedikit tebal */
        padding: 0.7rem 1.2rem; /* Ukuran tombol disesuaikan */
    }
    .btn-orange { background-color: #F39C12; border-color: #F39C12; color: #fff; }
    .btn-orange:hover { background-color: #d8890b; border-color: #d8890b; }
    .btn-outline-secondary { /* Style default Bootstrap bagus */ }
    .btn-success.disabled { /* Style untuk tombol 'Sudah Melamar' */
        opacity: 0.8; /* Sedikit transparan */
    }

    /* --- Deskripsi Pekerjaan --- */
    .detail-section-title {
        font-weight: 600;
        font-size: 1.1rem; /* Ukuran font judul section */
        color: #343a40;
        margin-top: 1.5rem;
        margin-bottom: 1rem; /* Jarak ditambah */
        padding-bottom: 0.5rem; /* Garis bawah tipis */
        border-bottom: 1px solid #e9ecef;
    }
    .job-description-detail {
        color: #495057; /* Warna teks deskripsi */
        line-height: 1.7; /* Spasi baris lebih lega */
        font-size: 1rem; /* Ukuran font deskripsi */
    }

    /* --- Placeholder/Empty State --- */
    .empty-state h5 { font-weight: 600; color: #6c757d; }
    .empty-state p { color: #adb5bd; }

</style>
