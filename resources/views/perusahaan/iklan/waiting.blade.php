@extends('perusahaan.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="bi bi-hourglass-split display-3 text-warning"></i>
                    </div>
                    <h2 class="fw-bold">Menunggu Persetujuan Admin</h2>
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="text-muted fs-5">
                        Anda memiliki 1 (satu) pengajuan Iklan VIP yang sedang kami tinjau.
                    </p>
                    <p>
                        Tim kami akan memverifikasi pembayaran Anda secepatnya. Anda akan dapat memposting iklan baru (Gratis atau VIP) setelah pengajuan saat ini disetujui atau ditolak.
                    </p>
                    <a href="{{ route('perusahaan.dashboard') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection