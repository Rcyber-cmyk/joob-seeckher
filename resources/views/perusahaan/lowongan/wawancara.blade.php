@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Halaman --}}
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="w-100 w-md-auto">
            <h1>Buat Jadwal Wawancara</h1>
            <p class="text-muted">Beritahu Pelamar Kapan Anda Akan Melakukan Interview</p>
        </div>
    </div>

    {{-- Form Jadwal Wawancara --}}
    <div class="dashboard-section p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-person-fill me-2"></i> Informasi Wawancara Pelamar</h5>
        <form action="{{ route('perusahaan.wawancara.store') }}" method="POST">
            @csrf
            {{-- Tambahkan pengecekan untuk memastikan variabel ada sebelum digunakan --}}
            @if ($lowongan)
            <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">
            @endif
            @if ($pelamar)
            <input type="hidden" name="pelamar_id" value="{{ $pelamar->id }}">
            @endif
            
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6">
                    <label for="nama_pelamar" class="form-label">Nama Pelamar</label>
                    <input type="text" id="nama_pelamar" class="form-control" 
                           value="{{ $pelamar->user->name ?? '' }}" readonly>
                </div>
                <div class="col-12 col-md-6">
                    <label for="posisi_dilamar" class="form-label">Posisi Dilamar</label>
                    <input type="text" id="posisi_dilamar" class="form-control" 
                           value="{{ $lowongan->judul_lowongan ?? '' }}" readonly>
                </div>
            </div>

            <div class="mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2"></i> Metode Wawancara</h5>
                <div class="d-flex flex-column flex-md-row">
                    <div class="form-check me-4">
                        <input class="form-check-input" type="radio" name="metode_wawancara" id="walkIn" value="Walk In Interview" checked>
                        <label class="form-check-label" for="walkIn">
                            Walk In Interview
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metode_wawancara" id="virtual" value="Virtual Interview">
                        <label class="form-check-label" for="virtual">
                            Virtual Interview
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6">
                    <label for="lokasi_interview" class="form-label">Lokasi Interview</label>
                    <input type="text" name="lokasi_interview" id="lokasi_interview" class="form-control" placeholder="Lokasi Interview">
                </div>
                <div class="col-12 col-md-6">
                    <label for="link_zoom" class="form-label">Link Zoom</label>
                    <input type="text" name="link_zoom" id="link_zoom" class="form-control" placeholder="Link Zoom" disabled>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6">
                    <label for="tanggal_interview" class="form-label">Tanggal Interview</label>
                    <input type="date" name="tanggal_interview" id="tanggal_interview" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                    <label for="waktu_interview" class="form-label">Waktu Interview</label>
                    <input type="time" name="waktu_interview" id="waktu_interview" class="form-control">
                </div>
            </div>

            <div class="mb-4">
                <label for="deskripsi_lowongan" class="form-label">Deskripsi Tambahan</label>
                <textarea name="deskripsi_lowongan" id="deskripsi_lowongan" class="form-control" rows="5" placeholder="Silahkan Masukan Deskripsi Tambahan Anda...."></textarea>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('perusahaan.jadwal.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-success">Kirim</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const walkInRadio = document.getElementById('walkIn');
        const virtualRadio = document.getElementById('virtual');
        const lokasiInput = document.getElementById('lokasi_interview');
        const zoomInput = document.getElementById('link_zoom');

        walkInRadio.addEventListener('change', function() {
            if (this.checked) {
                lokasiInput.disabled = false;
                zoomInput.disabled = true;
                zoomInput.value = '';
            }
        });

        virtualRadio.addEventListener('change', function() {
            if (this.checked) {
                lokasiInput.disabled = true;
                lokasiInput.value = '';
                zoomInput.disabled = false;
            }
        });
    });
</script>
@endpush