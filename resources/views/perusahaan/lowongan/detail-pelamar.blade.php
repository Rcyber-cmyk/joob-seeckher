@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Halaman --}}
    <div class="header-dashboard mb-4">
        <div>
            <h1>Detail Pelamar</h1>
            <p class="text-muted">{{ $lowongan->judul_lowongan }}</p>
        </div>
    </div>
    
    <div class="row g-4">
        {{-- Kolom Kiri: Informasi Dasar & Lamaran --}}
        <div class="col-lg-6">
            <div class="dashboard-section h-100 p-4">
                <h5 class="fw-bold mb-3">Informasi Pelamar</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <span class="fw-bold">Nama</span> : {{ $pelamar->user->name }}
                    </li>
                    <li class="mb-2">
                        <span class="fw-bold">Lokasi Rumah</span> : {{ $pelamar->alamat }}
                    </li>
                    <li class="mb-4">
                        <span class="fw-bold">No. Telp</span> : {{ $pelamar->no_hp }}
                    </li>
                </ul>

                <h5 class="fw-bold mb-3">Dokumen Lamaran</h5>
                <div class="d-flex mb-4">
                    <div class="me-4">
                        <span class="fw-bold d-block">Surat Lamaran</span>
                        <a href="#" class="btn btn-primary btn-sm mt-2">Lihat <i class="bi bi-box-arrow-up-right"></i></a>
                    </div>
                    <div>
                        <span class="fw-bold d-block">Resume</span>
                        <a href="#" class="btn btn-primary btn-sm mt-2">Lihat <i class="bi bi-box-arrow-up-right"></i></a>
                    </div>
                </div>

                <h5 class="fw-bold mb-3">Ringkasan Pelamar</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <span class="fw-bold">Gaji pokok yang diinginkan</span> : Rp 3.700.000,00
                    </li>
                    <li class="mb-2">
                        <span class="fw-bold">Pendidikan terakhir</span> : {{ $pelamar->lulusan }}
                    </li>
                    <li class="mb-2">
                        <span class="fw-bold">Lama mendalami peran</span> : {{ $pelamar->pengalaman_kerja }}
                    </li>
                    <li class="mb-2">
                        <span class="fw-bold">Bidang keahlian pelamar</span> :
                        @forelse ($pelamar->keahlian as $keahlian)
                            <span class="badge bg-secondary me-1">{{ $keahlian->nama_keahlian }}</span>
                        @empty
                            <span class="text-muted">Tidak ada keahlian</span>
                        @endforelse
                    </li>
                </ul>
            </div>
        </div>
        
        {{-- Kolom Kanan: Keahlian & Riwayat Karir --}}
        <div class="col-lg-6">
            <div class="dashboard-section h-100 p-4">
                <h5 class="fw-bold mb-3">Keahlian</h5>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-secondary">Membangun Tim</span>
                    <span class="badge bg-secondary">Bekerja Dalam Tim</span>
                    <span class="badge bg-secondary">Menguasai Laravel</span>
                    <span class="badge bg-secondary">Bekerja dalam Tekanan</span>
                    <span class="badge bg-secondary">Kerja Cepat</span>
                    <span class="badge bg-secondary">Analisis</span>
                    <span class="badge bg-secondary">Mudah Beradaptasi</span>
                </div>

                <h5 class="fw-bold mb-3">Riwayat Karir</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <span class="fw-bold">Posisi Pekerjaan</span> : Software engineer
                    </li>
                    <li class="mb-2">
                        <span class="fw-bold">Nama Perusahaan</span> : Universitas AKI
                    </li>
                    <li class="mb-2">
                        <span class="fw-bold">Mulai</span> : 16/9/2022
                    </li>
                    <li class="mb-2">
                        <span class="fw-bold">Berakhir</span> : 1/5/2025
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection