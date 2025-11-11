@extends('perusahaan.layouts.app')

@section('content')
<style>
    /* ... (CSS Anda sudah benar, tidak perlu diubah) ... */
    .paket-card { background-color: #fff; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07); padding: 2.5rem; border: 2px solid #e2e8f0; transition: all 0.3s ease; }
    .paket-card.premium { border-color: var(--orange); box-shadow: 0 10px 30px rgba(249, 115, 22, 0.2); }
    .paket-card h3 { color: var(--orange-dark); font-weight: 700; }
    .paket-card .harga { font-size: 2.5rem; font-weight: 700; color: var(--dark-blue); }
    .paket-card .harga sub { font-size: 1rem; font-weight: 500; color: var(--slate); }
    .paket-card ul { list-style-type: none; padding-left: 0; }
    .paket-card ul li { padding: 0.5rem 0; display: flex; align-items: center; font-weight: 500; }
    .paket-card ul li i { color: var(--orange); margin-right: 0.75rem; font-size: 1.2rem; }
    .payment-card { background-color: #fff; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07); padding: 2.5rem; }
    .payment-summary { background-color: var(--bg-main); border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1.5rem; }
    .payment-summary h5 { color: var(--dark-blue); font-weight: 600; margin-bottom: 0.25rem; }
    .payment-summary .harga { font-size: 1.5rem; font-weight: 700; color: var(--orange-dark); }
    .payment-method { border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem 1.25rem; cursor: pointer; transition: all 0.3s ease; }
    .payment-method.active { border-color: var(--orange); background-color: #fff7ed; box-shadow: 0 0 0 2px var(--orange); }
    .payment-method:hover { background-color: #f8fafc; }
    .payment-method .form-check-input { margin-top: 0.25rem; }
    .payment-method .form-check-label { font-weight: 600; }
    .payment-method .text-muted { font-size: 0.9rem; }
    .btn-bayar { background-color: var(--orange-dark); border-color: var(--orange-dark); color: var(--white); font-weight: 600; padding: 0.75rem 1.5rem; }
    .btn-bayar:hover { background-color: var(--orange); border-color: var(--orange); color: var(--white); }
    .payment-submenu { padding-left: 3rem; padding-bottom: 1rem; }
    .bank-option { background-color: #fff; border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.5rem 0.75rem; margin-right: 0.5rem; margin-bottom: 0.5rem; transition: all 0.2s ease; }
    .bank-option:hover { background-color: #f8fafc; }
    .bank-option.active { border-color: var(--orange); background-color: #fff7ed; box-shadow: 0 0 0 1px var(--orange); }
    .bank-option img { height: 20px; }
    #payment-details { background-color: #f8fafc; border: 1px solid #e2e8f0; color: var(--dark-blue); border-radius: 0.75rem; padding: 1.5rem; }
    #payment-details #detail-norek { font-size: 1.5rem; font-weight: 700; color: var(--orange-dark); }
    .pending-card { background-color: #fff; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07); padding: 2.5rem; text-align: center; }
    .pending-card .icon-wrapper { width: 80px; height: 80px; background-color: #fff7ed; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; }
    .pending-card .icon-wrapper i { font-size: 2.5rem; color: var(--orange-dark); }
</style>

{{-- Header Halaman --}}
<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div class="w-100 w-md-auto">
        <h1 class="fw-bold"><i class="bi bi-wallet-fill me-2"></i> Paket Langganan</h1>
        <p class="text-muted mb-0">Upgrade paket Anda untuk membuka semua fitur premium.</p>
    </div>
    <a href="{{ route('perusahaan.kandidat-pelamar.index') }}" class="btn btn-outline-primary mt-3 mt-md-0">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($pendingPayment)
    {{-- TAMPILKAN INI JIKA PEMBAYARAN SEDANG PENDING --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="pending-card">
                <div class="icon-wrapper">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h3 class="fw-bold">Pembayaran Sedang Diproses</h3>
                <p class="text-muted fs-5">
                    Bukti pembayaran Anda untuk paket <strong class="text-dark">Premium (Rp 150.000)</strong> via <strong>{{ $pendingPayment->metode_pembayaran }}</strong> 
                    telah kami terima pada {{ $pendingPayment->created_at->format('d M Y, H:i') }}.
                </p>
                <p class="mt-4">
                    Mohon menunggu persetujuan dari Admin. Akun Anda akan otomatis di-upgrade setelah pembayaran dikonfirmasi.
                </p>
                <a href="{{ Storage::url($pendingPayment->bukti_pembayaran) }}" target="_blank" class="btn btn-outline-secondary mt-3">
                    <i class="bi bi-eye-fill me-2"></i> Lihat Bukti Terkirim
                </a>
            </div>
        </div>
    </div>
    
@else
    {{-- TAMPILKAN INI JIKA BELUM BAYAR (FORMULIR PEMBAYARAN) --}}
    <div class="row g-4">
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="payment-card">
                <h4 class="fw-bold mb-4">Formulir Pembayaran</h4>

                <form action="{{ route('perusahaan.langganan.process') }}" method="POST" id="payment-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="metode_spesifik" id="metode_spesifik" value="">

                    <div class="payment-summary mb-4">
                        <h5>Paket Premium</h5>
                        <div class="harga">Rp 150.000 <sub class="fw-normal">/ bulan</sub></div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Pilih Metode Pembayaran:</label>
                        
                        <label for="metode-bank" class="payment-method d-flex align-items-center mb-2 active">
                            <input class="form-check-input me-3" type="radio" name="payment_method" id="metode-bank" value="bank_transfer" checked>
                            <div>
                                <div class="form-check-label">Bank Transfer (Virtual Account)</div>
                                <span class="text-muted">Bayar lewat BCA, BNI, BRI, Mandiri.</span>
                            </div>
                            <i class="bi bi-bank ms-auto fs-4 text-primary"></i>
                        </label>

                        <div id="bank-options" class="payment-submenu">
                            <button type="button" class="btn bank-option" data-bank="BCA" data-norek="123-456-7890" data-nama="PT. Job Portal Admin">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia_logo.svg/1280px-Bank_Central_Asia_logo.svg.png" alt="BCA">
                            </button>
                            <button type="button" class="btn bank-option" data-bank="BNI" data-norek="098-765-4321" data-nama="PT. Job Portal Admin">
                                <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1280px-BNI_logo.svg.png" alt="BNI">
                            </button>
                            <button type="button" class="btn bank-option" data-bank="Mandiri" data-norek="111-222-3334" data-nama="PT. Job Portal Admin">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1280px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri">
                            </button>
                        </div>

                        <label for="metode-ewallet" class="payment-method d-flex align-items-center mb-2">
                            <input class="form-check-input me-3" type="radio" name="payment_method" id="metode-ewallet" value="ewallet">
                            <div>
                                <div class="form-check-label">E-Wallet</div>
                                <span class="text-muted">Bayar lewat GoPay, OVO, ShopeePay.</span>
                            </div>
                            <i class="bi bi-wallet2 ms-auto fs-4 text-success"></i>
                        </label>

                        <div id="ewallet-options" class="payment-submenu" style="display: none;">
                            <button type="button" class="btn bank-option" data-bank="GoPay" data-norek="0812 3456 7890" data-nama="Mas Admin JobRec">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/1280px-Gopay_logo.svg.png" alt="GoPay">
                            </button>
                            <button type="button" class="btn bank-option" data-bank="OVO" data-norek="0812 3456 7890" data-nama="Mas Admin JobRec">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/1280px-Logo_ovo_purple.svg.png" alt="OVO">
                            </button>
                        </div>
                    </div>
                    
                    <div id="payment-details" class="mb-4" style="display: none;">
                        Silakan transfer ke <strong id="detail-bank"></strong>:
                        <h4 id="detail-norek" class="my-2"></h4>
                        <p class="mb-0">Atas Nama: <strong id="detail-nama"></strong></p>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_pembayaran" class="form-label fw-bold">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="bukti_pembayaran" name="bukti_pembayaran" required>
                    </div>
                    
                    <button type="submit" class="btn btn-bayar w-100 btn-lg mt-3">
                        <i class="bi bi-shield-check-fill me-2"></i> Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="paket-card premium mb-4">
                <h3>Premium</h3>
                <div class="harga">Rp 150.000 <sub class="fw-normal">/ bulan</sub></div>
                <hr>
                <ul class="my-4">
                    <li><i class="bi bi-check-circle-fill"></i> Posting Lowongan (Unlimited)</li>
                    <li><i class="bi bi-check-circle-fill"></i> Menerima Lamaran</li>
                    <li><i class="bi bi-check-circle-fill"></i> Akses Talent Pool Premium</li>
                    <li><i class="bi bi-check-circle-fill"></i> Undang Kandidat (Unlimited)</li>
                </ul>
            </div>
        </div>
    </div>
@endif

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethods = document.querySelectorAll('.payment-method');
        const bankOptions = document.getElementById('bank-options');
        const ewalletOptions = document.getElementById('ewallet-options');
        const allBankButtons = document.querySelectorAll('.bank-option');
        
        const paymentDetails = document.getElementById('payment-details');
        const detailBank = document.getElementById('detail-bank');
        const detailNorek = document.getElementById('detail-norek');
        const detailNama = document.getElementById('detail-nama');
        
        const hiddenMetodeInput = document.getElementById('metode_spesifik');

        // 1. Logika untuk memilih metode utama (Bank vs E-Wallet)
        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                paymentMethods.forEach(m => m.classList.remove('active'));
                this.classList.add('active');
                
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;

                allBankButtons.forEach(btn => btn.classList.remove('active'));
                paymentDetails.style.display = 'none';
                hiddenMetodeInput.value = '';

                if (radio.id === 'metode-bank') {
                    bankOptions.style.display = 'block';
                    ewalletOptions.style.display = 'none';
                } else if (radio.id === 'metode-ewallet') {
                    bankOptions.style.display = 'none';
                    ewalletOptions.style.display = 'block';
                }
            });
        });

        // 2. Logika untuk memilih bank/ewallet spesifik
        allBankButtons.forEach(button => {
            button.addEventListener('click', function(e) { 
                e.preventDefault(); // Mencegah tombol men-submit form
                allBankButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const bankName = this.dataset.bank;
                const norek = this.dataset.norek;
                const nama = this.dataset.nama;

                detailBank.textContent = bankName;
                detailNorek.textContent = norek;
                detailNama.textContent = nama;
                
                paymentDetails.style.display = 'block';
                hiddenMetodeInput.value = bankName;
            });
        });
    });
</script>
@endpush