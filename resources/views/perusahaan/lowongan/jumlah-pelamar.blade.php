@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Halaman --}}
<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        {{-- JUDUL DINAMIS --}}
        <h1 class="fw-bold">Pelamar untuk Lowongan</h1>
        <p class="text-muted fs-6">{{ $lowongan->judul_lowongan }}</p>
    </div>
    <a href="{{ route('perusahaan.lowongan-saya.index') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

{{-- Filter Section --}}
<div class="filter-section mb-4 d-flex flex-column flex-md-row gap-3">
    <div class="dropdown">
        <button class="btn btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Level Skor
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Skor A</a></li>
            <li><a class="dropdown-item" href="#">Skor B</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <button class="btn btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Lihat Status
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Pending</a></li>
            <li><a class="dropdown-item" href="#">Diterima</a></li>
        </ul>
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="info-card info-total p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-uppercase fw-bold small text-muted">Total Pelamar</h6>
                    {{-- DATA DINAMIS --}}
                    <div class="fs-3 fw-bold">{{ $total_pelamar }}</div>
                </div>
                <div class="icon-circle"><i class="bi bi-people-fill"></i></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="info-card info-diterima p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-uppercase fw-bold small text-muted">Pelamar Diterima</h6>
                     {{-- DATA DINAMIS --}}
                    <div class="fs-3 fw-bold">{{ $pelamar_diterima }}</div>
                </div>
                <div class="icon-circle"><i class="bi bi-check-circle-fill"></i></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="info-card info-ditolak p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-uppercase fw-bold small text-muted">Pelamar Ditolak</h6>
                     {{-- DATA DINAMIS --}}
                    <div class="fs-3 fw-bold">{{ $pelamar_ditolak }}</div>
                </div>
                <div class="icon-circle"><i class="bi bi-x-circle-fill"></i></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="info-card info-nilai p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-uppercase fw-bold small text-muted">Rata-Rata Skor</h6>
                     {{-- DATA DINAMIS --}}
                    <div class="fs-3 fw-bold">{{ round($pelamar->avg('skor_ranking') ?? 0) }}%</div>
                </div>
                <div class="icon-circle"><i class="bi bi-percent"></i></div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Pelamar --}}
<div class="dashboard-section p-3 bg-white rounded shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>NO</th>
                    <th>Kandidat</th>
                    <th>Skor Ranking</th> {{-- KOLOM BARU --}}
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelamar as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $item->pelamar->foto_profil ? asset('storage/' . $item->pelamar->foto_profil) : asset('images/default-profile.png') }}" 
                                    alt="Profile" class="rounded-circle me-3" width="40" height="40" style="object-fit: cover;">
                                <div>
                                    <span class="fw-semibold d-block">{{ $item->pelamar->user->name }}</span>
                                    {{-- Link Detail dipindah ke sini agar lebih intuitif --}}
                                    <a href="{{ route('perusahaan.pelamar.detail', ['lowongan_id' => $lowongan->id, 'pelamar_id' => $item->pelamar->id]) }}" class="small text-primary text-decoration-none">
                                        Lihat Detail <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                        
                        {{-- ========================== KOLOM SKOR E-RANKING (BARU) ========================== --}}
                        <td>
                            @php
                                $score = round($item->skor_ranking);
                                $bgColor = 'bg-danger'; // Default merah
                                if ($score >= 75) {
                                    $bgColor = 'bg-success'; // Hijau untuk skor tinggi
                                } elseif ($score >= 50) {
                                    $bgColor = 'bg-warning'; // Kuning untuk skor sedang
                                }
                            @endphp
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-2" style="width: 40px;">{{ $score }}%</span>
                                <div class="progress flex-grow-1" style="height: 10px;">
                                    <div class="progress-bar {{ $bgColor }}" role="progressbar" style="width: {{ $score }}%;" aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge
                                @if ($item->status === 'pending') bg-warning
                                @elseif ($item->status === 'diterima') bg-success
                                @else bg-danger
                                @endif
                            ">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('perusahaan.wawancara.create', ['lowongan_id' => $lowongan->id, 'pelamar_id' => $item->pelamar->id]) }}" class="btn btn-info btn-sm text-white">
                                Jadwal
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada pelamar ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center mt-4 p-3">
            <div class="d-flex justify-content-end mt-4">
                {{ $pelamar->links() }}
            </div>
        </div>
    </div>
@endsection