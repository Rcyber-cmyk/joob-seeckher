@extends('perusahaan.layouts.app')


@section('content')
    {{-- Header Halaman --}}
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4 py-3 px-2 bg-light rounded shadow-sm">
        <div class="w-100 w-md-auto mb-3 mb-md-0">
            <h1 class="h3 fw-semibold mb-1">📅 Jadwal Wawancara</h1>
            <p class="text-muted mb-0">Kelola jadwal rekrutmen Anda dengan mudah dan efisien.</p>
        </div>
    </div>

    {{-- Tabel Jadwal --}}
        <div class="dashboard-section bg-white rounded shadow-sm p-3">
            <div class="row gy-2 gx-3">
            <div class="col-lg-6">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Cari pelamar atau posisi..." aria-label="Search">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
            <div class="col-lg-6 d-flex flex-wrap justify-content-lg-end gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Semua Metode
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Online</a></li>
                        <li><a class="dropdown-item" href="#">Offline</a></li>
                    </ul>
                </div>
                <button class="btn btn-primary" type="button">Filter</button>
            </div>
        </div></br>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>👤 Pelamar</th>
                        <th>📌 Posisi</th>
                        <th>📆 Jadwal</th>
                        <th>💻 Metode</th>
                        <th>📋 Status</th>
                        <th>⚙️ Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwal as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" alt="Profile" class="profile-img me-3">
                                    <span class="fw-bold">{{ $item->pelamar->user->name ?? 'Tidak diketahui' }}</span>
                                </div>
                            </td>
                            <td>{{ $item->lowongan->judul_lowongan ?? 'Tidak diketahui' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_interview)->format('d F Y') }} <br> {{ \Carbon\Carbon::parse($item->waktu_interview)->format('H:i') }}</td>
                            <td>{{ $item->metode_wawancara }}</td>
                            <td>
                                <span class="badge bg-primary">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2">Detail</a>
                                <button class="btn btn-sm btn-success">Selesai</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada jadwal wawancara yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-4">
            <small class="text-muted">Menampilkan 1–5 dari 53 Jadwal</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
