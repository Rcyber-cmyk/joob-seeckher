@extends('pelamar.layouts.app')

@section('title', 'Notifikasi Undangan')

@section('content')
<div class="container py-5" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                <h3 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-bell-fill text-warning me-2"></i> Undangan Interview & Penawaran
                </h3>
            </div>

            @forelse($undangan as $item)
                {{-- Card Item Undangan --}}
                <div class="card mb-3 shadow-sm border-0 animate__animated animate__fadeInUp" 
                     style="border-left: 5px solid {{ $item->status == 'terkirim' ? '#ffc107' : '#22374e' }} !important;">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            {{-- Logo Perusahaan --}}
                            <div class="col-md-2 text-center mb-3 mb-md-0">
                                <img src="{{ $item->perusahaan->logo_perusahaan ? asset('storage/'.$item->perusahaan->logo_perusahaan) : 'https://placehold.co/100x100/png?text=Company' }}" 
                                     alt="Logo" class="rounded-circle img-fluid border" style="width: 80px; height: 80px; object-fit: cover;">
                            </div>

                            {{-- Detail Pesan --}}
                            <div class="col-md-7 mb-3 mb-md-0">
                                <h5 class="fw-bold text-dark mb-1">{{ $item->perusahaan->nama_perusahaan }}</h5>
                                <p class="text-muted mb-2 small">
                                    <i class="bi bi-calendar-event me-1"></i> Diterima: {{ $item->created_at->diffForHumans() }}
                                </p>
                                
                                <div class="alert alert-light border mb-0 p-3 rounded-3">
                                    <p class="mb-1 fw-bold text-primary">
                                        <i class="bi bi-briefcase me-1"></i> Posisi: {{ $item->lowongan->judul_lowongan }}
                                    </p>
                                    @if($item->pesan)
                                        <hr class="my-2">
                                        <p class="mb-0 text-muted fst-italic small">"{{ $item->pesan }}"</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="col-md-3 text-center text-md-end">
                                @if($item->status == 'terkirim' || $item->status == 'dilihat')
                                    <span class="badge bg-warning text-dark mb-2">Undangan Baru</span>
                                    <a href="{{ route('pelamar.notifikasi.read', $item->id) }}" class="btn btn-primary w-100 mb-2">
                                        Lihat Lowongan
                                    </a>
                                @else
                                    <span class="badge bg-secondary mb-2">Sudah Direspon</span>
                                    <button class="btn btn-outline-secondary w-100" disabled>Selesai</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Tampilan Jika Kosong --}}
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="Empty" style="width: 150px; opacity: 0.5;" class="mb-4">
                    <h4 class="text-muted fw-bold">Belum ada undangan masuk</h4>
                    <p class="text-muted">Tetap semangat! Lengkapi profilmu agar perusahaan tertarik.</p>
                    <a href="{{ route('lowongan.index') }}" class="btn btn-primary px-4 mt-2">Cari Lowongan Lain</a>
                </div>
            @endforelse

        </div>
    </div>
</div>
@endsection