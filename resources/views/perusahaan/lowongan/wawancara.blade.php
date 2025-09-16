@extends('perusahaan.layouts.app')

@section('content')
<style>
    /* Styling umum untuk form section */
    .form-section {
        background: #ffffff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }

    .form-section h5 {
        color: var(--secondary-color);
        font-weight: 600;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 0.75rem;
    }

    /* Styling untuk form control */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(255, 122, 0, 0.25);
    }
    
    .form-control[readonly] {
        background-color: #f1f1f1;
        cursor: not-allowed;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    /* Styling untuk radio button */
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    /* Styling untuk tombol */
    .btn-submit {
        background-color: var(--primary-color);
        color: white;
        padding: 0.75rem 2.5rem;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-submit:hover {
        background-color: #e66a00;
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0,0,0,0.15);
    }

    .btn-cancel {
        background-color: #dc3545;
        color: white;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        transition: all 0.3s;
    }
    .btn-cancel:hover {
        background-color: #c82333;
    }

    /* Styling Header Dashboard */
    .header-dashboard h1 {
        font-size: 2rem;
        color: var(--secondary-color);
        font-weight: 700;
    }
    .header-dashboard p {
        color: #777;
    }
    
    /* Responsif untuk Mobile */
    @media (max-width: 768px) {
        .header-dashboard h1 {
            font-size: 1.5rem;
        }
        .form-section {
            padding: 1.5rem;
        }
        .d-flex.justify-content-end.gap-2 {
            flex-direction: column;
        }
        .d-flex.justify-content-end.gap-2 .btn {
            width: 100%;
        }
    }
</style>

<div class="header-dashboard mb-4">
    <h1>Buat Jadwal Wawancara</h1>
    <p class="text-muted">Beritahu Pelamar Kapan Anda Akan Melakukan Interview</p>
</div>

<div class="form-section p-4">
    <h5 class="fw-bold mb-3"><i class="bi bi-person-fill me-2"></i> Informasi Wawancara Pelamar</h5>
    <form action="{{ route('perusahaan.wawancara.store') }}" method="POST">
        @csrf
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
            <div class="d-flex flex-column flex-md-row gap-4">
                <div class="form-check">
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
        
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('perusahaan.jadwal.index') }}" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-submit">Kirim</button>
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

        const toggleInputs = () => {
            if (walkInRadio.checked) {
                lokasiInput.disabled = false;
                zoomInput.disabled = true;
                zoomInput.value = '';
            } else {
                lokasiInput.disabled = true;
                lokasiInput.value = '';
                zoomInput.disabled = false;
            }
        };

        walkInRadio.addEventListener('change', toggleInputs);
        virtualRadio.addEventListener('change', toggleInputs);
        
        // Atur status input saat halaman pertama kali dimuat
        toggleInputs();
    });
</script>
@endpush
