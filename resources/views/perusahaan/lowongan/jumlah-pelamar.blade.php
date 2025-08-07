@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Halaman --}}
<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold">Lihat Lowongan</h1>
        <p class="text-muted fs-6">Senior UI/UX Designer</p>
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
    @php
        $cards = [
            ['title' => 'Total Pelamar', 'value' => 140, 'icon' => 'people-fill', 'class' => 'info-total'],
            ['title' => 'Pelamar Diterima', 'value' => 60, 'icon' => 'check-circle-fill', 'class' => 'info-diterima'],
            ['title' => 'Pelamar Ditolak', 'value' => 25, 'icon' => 'x-circle-fill', 'class' => 'info-ditolak'],
            ['title' => 'Rata Rata Nilai', 'value' => '75%', 'icon' => 'percent', 'class' => 'info-nilai'],
        ];
    @endphp

    @foreach($cards as $card)
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="info-card {{ $card['class'] }} p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-uppercase fw-bold small text-muted">{{ $card['title'] }}</h6>
                    <div class="fs-3 fw-bold">{{ $card['value'] }}</div>
                </div>
                <div class="icon-circle">
                    <i class="bi bi-{{ $card['icon'] }}"></i>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Tabel Pelamar --}}
<div class="dashboard-section p-3 bg-white rounded shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>NO</th>
                    <th>Kandidat</th>
                    <th>Detail Pelamar</th>
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
                                <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle me-3" width="40" height="40">
                                <span class="fw-semibold">{{ $item->pelamar->user->name }}</span>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('perusahaan.pelamar.detail', ['lowongan_id' => $lowongan->id, 'pelamar_id' => $item->pelamar->id]) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-file-earmark-person"></i>
                            </a>
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
            <small class="text-muted">Menampilkan 1-5 dari 53 Lowongan</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection