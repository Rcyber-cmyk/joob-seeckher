<!DOCTYPE html>
<html lang="id">
<head>
    {{-- ... (head Anda sudah benar, tidak perlu diubah) ... --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasang Iklan Lowongan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ... (CSS Anda sudah benar) ... */
        body { background-color: #f4f6f9; font-family: 'Poppins', sans-serif; }
        .page-header { background: linear-gradient(135deg, #071b2f, #0d3053); color: white; padding: 2rem 1rem; border-radius: 12px; margin-bottom: 2rem; }
        .card-header-custom { background-color: #071b2f; color: white; font-weight: 600; }
        .paket-pilihan .card { transition: all 0.25s ease-in-out; cursor: pointer; border: 2px solid transparent; }
        .paket-pilihan .card:hover { transform: translateY(-4px); border-color: #ff7b00; box-shadow: 0 6px 18px rgba(0,0,0,0.12) !important; }
        .paket-pilihan input[type="radio"]:disabled + .card { cursor: not-allowed; background-color: #f8f9fa; opacity: 0.7; }
        .paket-pilihan input[type="radio"]:disabled + .card:hover { transform: none; border-color: transparent; box-shadow: none !important; }
        .paket-pilihan input[type="radio"]:checked + .card { border-color: #ff7b00; box-shadow: 0 0 0 3px rgba(255, 123, 0, 0.3) !important; }
        .image-preview-container { width: 100%; height: 160px; border: 2px dashed #ccc; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; background-color: #fafafa; flex-direction: column; text-align: center; padding: 8px; }
        .image-preview-container img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .btn-orange { background-color: #ff7b00; border: none; }
        .btn-orange:hover { background-color: #e56f00; }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link { background-color: #071b2f; }
        .nav-pills .nav-link { color: #071b2f; }
        .list-group-item-action.active { background-color: #fff3e6; border-color: #ff7b00; color: #333; font-weight: 600; }
    </style>
</head>

<div class="container py-4">
    
    {{-- Header --}}
    <div class="page-header text-center shadow-sm">
        <h1 class="fw-bold mb-2">Pasang Iklan Lowongan Baru</h1>
        <p class="mb-0">Isi detail di bawah untuk menjangkau ribuan kandidat berkualitas</p>
    </div>

    {{-- Tampilkan error jika ada --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Form --}}
    {{-- ========================================================= --}}
    {{-- PERBAIKAN: Tambahkan data-is-pending di sini --}}
    {{-- ========================================================= --}}
    <form action="{{ route('perusahaan.iklan.store') }}" method="POST" enctype="multipart/form-data" 
          id="iklan-form" 
          data-is-pending="{{ $isVipPending ?? false ? 'true' : 'false' }}">
        @csrf

        {{-- Input tersembunyi untuk metode pembayaran --}}
        <input type="hidden" name="metode_pembayaran" id="metode_pembayaran">

        <div class="row g-4">
            
            {{-- Kolom Kiri --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    {{-- ... (Konten kolom kiri Anda sudah benar) ... --}}
                    <div class="card-header card-header-custom">
                        <i class="bi bi-file-earmark-text me-2"></i> Detail Iklan
                    </div>
                    <div class="card-body p-4">

                        {{-- Nama Perusahaan --}}
                        <div class="mb-3">
                            <label for="nama_perusahaan" class="form-label fw-semibold">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama_perusahaan" 
                                   value="{{ Auth::user()->profilePerusahaan->nama_perusahaan ?? 'Nama Perusahaan' }}" readonly>
                            <div class="form-text">Nama perusahaan otomatis dari profil Anda</div>
                        </div>

                        {{-- Judul Lowongan --}}
                        <div class="mb-3">
                            <label for="judul_lowongan" class="form-label fw-semibold">Judul Lowongan</label>
                            <input type="text" class="form-control @error('judul_lowongan') is-invalid @enderror" id="judul_lowongan" name="judul_lowongan" 
                                   placeholder="Contoh: Senior Web Developer" required value="{{ old('judul_lowongan') }}">
                            @error('judul_lowongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi Lowongan</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="7"
                                      placeholder="Tulis deskripsi pekerjaan, kualifikasi, benefit, dll" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload File (DIHAPUS DARI CONTROLLER, tapi biarkan di form) --}}
                        <div class="mb-3">
                            <label for="file_iklan" class="form-label fw-semibold">Poster / Banner Iklan (Opsional)</label>
                            <input class="form-control @error('file_iklan') is-invalid @enderror" type="file" id="file_iklan" name="file_iklan" accept="image/png, image/jpeg, application/pdf">
                            @error('file_iklan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPG, PNG, atau PDF. Maks 2MB</div>
                        </div>

                        {{-- Preview --}}
                        <div class="mt-3">
                            <label class="form-label fw-semibold">Preview Banner</label>
                            <div class="image-preview-container" id="previewContainer">
                                <img src="" alt="Image Preview" class="d-none" id="imagePreview">
                                <span class="preview-text" id="previewText"><i class="bi bi-image fs-1 text-muted"></i></span>
                                <span class="preview-file-name d-none" id="fileName"></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="col-lg-4">
                {{-- ... (Konten kolom kanan Anda sudah benar) ... --}}
                {{-- Pilihan Paket --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header card-header-custom">
                        <i class="bi bi-star-fill me-2"></i>Pilih Paket Iklan
                    </div>
                    <div class="card-body p-3 paket-pilihan">
                        {{-- Gratis --}}
                        <label for="paket_gratis" class="w-100">
                            <input type="radio" name="paket" id="paket_gratis" value="gratis" class="d-none" {{ old('paket', 'gratis') == 'gratis' ? 'checked' : '' }}>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="fw-bold">GRATIS</h6>
                                    <p class="small text-muted mb-1">Aktif 15 hari • Jangkauan standar</p>
                                    <div class="text-end fw-bold fs-6">Rp 0</div>
                                </div>
                            </div>
                        </label>
                        {{-- VIP --}}
                        <label for="paket_vip" class="w-100">
                            <input type="radio" name="paket" id="paket_vip" value="vip" class="d-none" {{ old('paket') == 'vip' ? 'checked' : '' }}>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="fw-bold text-warning">VIP</h6>
                                        <span class="badge bg-warning text-dark">Populer</span>
                                    </div>
                                    <p class="small text-muted mb-1">Promosi di halaman utama • Aktif 30 hari</p>
                                    <div class="text-end fw-bold fs-6">Rp 150.000</div>
                                </div>
                            </div>
                        </label>
                        {{-- Pesan Peringatan --}}
                        <div id="vip-pending-alert" class="alert alert-warning p-2 small d-none mt-2">
                            <i class="bi bi-hourglass-split me-1"></i>
                            Anda memiliki 1 Iklan VIP yang sedang ditinjau. Anda dapat memilih VIP lagi setelah disetujui.
                        </div>
                    </div>
                </div>
                {{-- Card Bukti Pembayaran --}}
                <div class="card shadow-sm border-0 mb-4 d-none" id="cardBuktiPembayaran">
                    <div class="card-header card-header-custom" style="background-color: #ff7b00; color: white;">
                        <i class="bi bi-wallet2 me-2"></i> Pembayaran & Bukti (VIP)
                    </div>
                    <div class="card-body p-3">
                        <label class="form-label fw-semibold">1. Pilih Metode Pembayaran</label>
                        <ul class="nav nav-pills nav-fill mb-3" id="paymentMethodTabs" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link active" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank-tab-pane" type="button" role="tab" ...><i class="bi bi-bank me-1"></i> Transfer Bank</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="ewallet-tab" data-bs-toggle="tab" data-bs-target="#ewallet-tab-pane" type="button" role="tab" ...><i class="bi bi-phone-fill me-1"></i> E-Wallet</button></li>
                        </ul>
                        <div class="tab-content" id="paymentMethodContent">
                            <div class="tab-pane fade show active" id="bank-tab-pane" ...>
                                <div class="list-group list-group-payment">
                                    <button type="button" class="list-group-item list-group-item-action" data-value="BCA" data-payment-details="Bank: <b>BCA</b><br>No. Rek: <b>123456789</b>...">BCA</button>
                                    <button type="button" class="list-group-item list-group-item-action" data-value="BNI" data-payment-details="Bank: <b>BNI</b><br>No. Rek: <b>987654321</b>...">BNI</button>
                                    <button type="button" class="list-group-item list-group-item-action" data-value="Mandiri" data-payment-details="Bank: <b>Mandiri</b><br>No. Rek: <b>1122334455</b>...">Mandiri</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ewallet-tab-pane" ...>
                                <div class="list-group list-group-payment">
                                    <button type="button" class="list-group-item list-group-item-action" data-value="GoPay" data-payment-details="E-Wallet: <b>GoPay</b><br>No. HP: <b>08123456789</b>...">GoPay</button>
                                    <button type="button" class="list-group-item list-group-item-action" data-value="OVO" data-payment-details="E-Wallet: <b>OVO</b><br>No. HP: <b>08123456789</b>...">OVO</button>
                                    <button type="button" class="list-group-item list-group-item-action" data-value="ShopeePay" data-payment-details="E-Wallet: <b>ShopeePay</b><br>No. HP: <b>08123456789</b>...">ShopeePay</button>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-3 d-none" id="paymentDetailsCard" role="alert"></div>
                        <hr class="my-4">
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label fw-semibold">2. Upload Bukti Transfer</label>
                            <input class="form-control @error('bukti_pembayaran') is-invalid @enderror" type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/png, image/jpeg, application/pdf">
                            @error('bukti_pembayaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <label class="form-label fw-semibold">Preview Bukti</label>
                        <div class="image-preview-container" id="previewContainerPembayaran">
                            <img src="" alt="Image Preview" class="d-none" id="imagePreviewPembayaran">
                            <span class="preview-text" id="previewTextPembayaran"><i class="bi bi-image fs-1 text-muted"></i></span>
                            <span class="preview-file-name d-none" id="fileNamePembayaran"></span>
                        </div>
                    </div>
                </div>
                {{-- Tombol --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <p class="small text-muted">Pastikan semua data sudah benar. Iklan akan ditinjau jika memilih VIP.</p>
                        <div class="d-grid gap-2">
                            <a href="javascript:history.back()" class="btn btn-secondary btn-lg fw-semibold">
                                <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-orange btn-lg fw-semibold text-white">
                                <i class="bi bi-send-fill me-2"></i> Kirim & Pasang Iklan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- ========================================================= --}}
{{-- SCRIPT DIPINDAHKAN DARI @push KE DALAM @section('content') --}}
{{-- ========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- (Semua JS Preview & Info Pembayaran Anda sudah benar) ---
    // ... (kode JS preview Anda) ...
    const fileInput = document.getElementById('file_iklan');
    const imagePreview = document.getElementById('imagePreview');
    const previewText = document.getElementById('previewText');
    const fileNameDisplay = document.getElementById('fileName');
    if(fileInput) { 
        fileInput.addEventListener('change', function(event) {
            handleFilePreview(event.target.files[0], imagePreview, previewText, fileNameDisplay);
        });
    }
    const fileInputPembayaran = document.getElementById('bukti_pembayaran');
    const imagePreviewPembayaran = document.getElementById('imagePreviewPembayaran');
    const previewTextPembayaran = document.getElementById('previewTextPembayaran');
    const fileNameDisplayPembayaran = document.getElementById('fileNamePembayaran');
    if(fileInputPembayaran) { 
        fileInputPembayaran.addEventListener('change', function(event) {
            handleFilePreview(event.target.files[0], imagePreviewPembayaran, previewTextPembayaran, fileNameDisplayPembayaran);
        });
    }
    function handleFilePreview(file, imgElement, textElement, nameElement) {
        if (!imgElement || !textElement || !nameElement) return; 
        if (file) {
            imgElement.classList.add('d-none'); textElement.classList.add('d-none'); nameElement.classList.add('d-none');
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) { imgElement.src = e.target.result; imgElement.classList.remove('d-none'); }
                reader.readAsDataURL(file);
            } else {
                textElement.innerHTML = '<i class="bi bi-file-earmark-text fs-1 text-muted"></i>';
                nameElement.textContent = file.name;
                textElement.classList.remove('d-none'); nameElement.classList.remove('d-none');
            }
        } else {
            imgElement.classList.add('d-none'); nameElement.classList.add('d-none');
            textElement.innerHTML = '<i class="bi bi-image fs-1 text-muted"></i>';
            textElement.classList.remove('d-none'); imgElement.src = ''; nameElement.textContent = '';
        }
    }
    const paymentDetailsCard = document.getElementById('paymentDetailsCard');
    const paymentButtons = document.querySelectorAll('.list-group-payment .list-group-item-action');
    const hiddenMetodeInput = document.getElementById('metode_pembayaran'); 
    paymentButtons.forEach(button => {
        button.addEventListener('click', function() {
            const details = this.dataset.paymentDetails;
            const value = this.dataset.value;
            if(paymentDetailsCard) {
                paymentDetailsCard.innerHTML = `<strong>Silakan transfer ke:</strong><br>${details}`;
                paymentDetailsCard.classList.remove('d-none');
            }
            if(hiddenMetodeInput) hiddenMetodeInput.value = value; 
            paymentButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // --- LOGIKA UTAMA (GRATIS/VIP) ---
    
    const radioPaket = document.querySelectorAll('input[name="paket"]');
    const cardPembayaran = document.getElementById('cardBuktiPembayaran');
    const inputPembayaran = document.getElementById('bukti_pembayaran');
    
    // Ambil elemen input dari form kiri
    const inputJudul = document.getElementById('judul_lowongan');
    const inputDeskripsi = document.getElementById('deskripsi');

    // --- PERBAIKAN ---
    // Ambil status pending dari tag <form>
    const iklanForm = document.getElementById('iklan-form');
    // Konversi string 'true'/'false' menjadi boolean
    const isVipPending = iklanForm.dataset.isPending === 'true'; 
    // --- AKHIR PERBAIKAN ---

    const radioVip = document.getElementById('paket_vip');
    const radioGratis = document.getElementById('paket_gratis');
    const vipAlert = document.getElementById('vip-pending-alert');

    // Fungsi untuk ganti tampilan
    function togglePaymentCard(paketValue) {
        if (paketValue === 'vip') {
            if(cardPembayaran) cardPembayaran.classList.remove('d-none');
            if(inputPembayaran) inputPembayaran.required = true;
            if(inputJudul) inputJudul.required = true;
            if(inputDeskripsi) inputDeskripsi.required = true;
        } else { // 'gratis'
            if(cardPembayaran) cardPembayaran.classList.add('d-none');
            if(inputPembayaran) {
                inputPembayaran.required = false;
                inputPembayaran.value = null; 
            }
            if(hiddenMetodeInput) hiddenMetodeInput.value = null; 
            if(inputJudul) inputJudul.required = true;
            if(inputDeskripsi) inputDeskripsi.required = true;
            handleFilePreview(null, imagePreviewPembayaran, previewTextPembayaran, fileNameDisplayPembayaran);
            if(paymentDetailsCard) paymentDetailsCard.classList.add('d-none');
            paymentButtons.forEach(btn => btn.classList.remove('active'));
        }
    }

    // --- LOGIKA BARU UNTUK BLOKIR VIP ---
    if (isVipPending) {
        if(radioVip) radioVip.disabled = true;
        if(radioGratis) radioGratis.checked = true; // Otomatis pilih gratis
        if(vipAlert) vipAlert.classList.remove('d-none');
        
        // Panggil fungsi toggle untuk memastikan form pembayaran tersembunyi
        togglePaymentCard('gratis'); 
    }

    // Tambahkan listener ke radio buttons
    radioPaket.forEach(radio => {
        radio.addEventListener('change', function() {
            // Hanya jalankan jika tombol tidak di-disable
            if (!this.disabled) {
                togglePaymentCard(this.value);
            }
        });
    });

    // Jalankan saat load, untuk menangani jika ada error validasi (old value)
    const radioTerpilih = document.querySelector('input[name="paket"]:checked');
    if (radioTerpilih && !isVipPending) { // Hanya jalankan jika VIP tidak diblokir
        togglePaymentCard(radioTerpilih.value);
    }
});
</script>
