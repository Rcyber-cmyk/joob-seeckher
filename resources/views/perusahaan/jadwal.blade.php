@extends('perusahaan.layouts.app')

@section('content')
<style>
    /* Styling Header Halaman */
    .header-dashboard {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .header-dashboard h1 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--secondary-color);
    }

    .header-dashboard p {
        color: #777;
        margin-bottom: 0;
    }

    /* Styling Bagian Konten (Tabel dan Filter) */
    .dashboard-section {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }

    .form-control.rounded-pill {
        border-radius: 50px;
        border-color: #e0e0e0;
    }

    .btn-primary.rounded-pill {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        border-radius: 50px;
    }

    .btn-outline-secondary {
        border-color: #e0e0e0;
        color: #777;
    }
    
    /* Styling Dropdown Filter */
    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Styling Tabel */
    .table-responsive {
        overflow-x: auto;
    }

    .table th, .table td {
        white-space: nowrap;
        padding: 1rem;
    }
    
    .table thead th {
        color: #888;
        font-weight: 600;
    }

    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.5em 1em;
    }
    
    .badge-primary-custom {
        background-color: var(--primary-color) !important;
        color: white !important;
    }
    
    .badge-secondary-custom {
        background-color: var(--secondary-color) !important;
        color: white !important;
    }

    .btn-action {
        border-radius: 8px;
    }

    /* Dropdown untuk Aksi (Sukses/Batal) */
    .action-dropdown .dropdown-toggle {
        padding: 0.5rem 1rem;
        border-radius: 8px;
    }

    /* Styling Pagination */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 3px;
        color: var(--secondary-color);
    }
    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    /* Responsif untuk Mobile */
    @media (max-width: 768px) {
        .header-dashboard h1 {
            font-size: 1.5rem;
        }

        .dashboard-section {
            padding: 1.5rem;
        }

        /* Menggunakan tabel untuk tampilan mobile */
        .table-responsive {
            display: block;
        }

        .d-md-none {
            display: none !important;
        }

        .row.gy-3.gx-3 {
            flex-direction: column;
            gap: 1rem;
        }
        
        /* Dropdown filter di mobile */
        .col-lg-6.d-flex.flex-wrap.justify-content-lg-end.gap-2 {
            flex-direction: column;
        }
        .col-lg-6.d-flex.flex-wrap.justify-content-lg-end.gap-2 .dropdown,
        .col-lg-6.d-flex.flex-wrap.justify-content-lg-end.gap-2 .btn {
            width: 100%;
        }
    }
</style>

{{-- Header Halaman --}}
<div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div class="w-100 w-md-auto">
        <h1>📅 Jadwal Wawancara</h1>
        <p class="text-muted">Kelola jadwal rekrutmen Anda dengan mudah dan efisien.</p>
    </div>
</div>

{{-- Filter dan Pencarian --}}
<div class="dashboard-section p-4 mb-4">
    <div class="row gy-3 gx-3 align-items-center mb-4">
        <div class="col-12 col-lg-6">
            <form action="{{ route('perusahaan.jadwal.index') }}" method="GET" class="d-flex">
                <input class="form-control me-2 rounded-pill" type="search" placeholder="Cari posisi lowongan..." aria-label="Search" name="search" value="{{ $search ?? '' }}">
                <button class="btn btn-primary rounded-pill" type="submit">Cari</button>
            </form>
        </div>
        <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-lg-end gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $metode ?? 'Semua Metode' }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('perusahaan.jadwal.index', ['search' => $search, 'metode' => '']) }}">Semua Metode</a></li>
                    <li><a class="dropdown-item" href="{{ route('perusahaan.jadwal.index', ['search' => $search, 'metode' => 'Walk In Interview']) }}">Walk In Interview</a></li>
                    <li><a class="dropdown-item" href="{{ route('perusahaan.jadwal.index', ['search' => $search, 'metode' => 'Virtual Interview']) }}">Virtual Interview</a></li>
                </ul>
            </div>
            <a href="{{ route('perusahaan.jadwal.index') }}" class="btn btn-primary rounded-pill">Reset</a>
        </div>
    </div>

    {{-- Tabel Jadwal (Tampilan Default untuk semua ukuran) --}}
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
                                <span class="fw-bold text-dark">{{ $item->pelamar->user->name ?? 'Tidak diketahui' }}</span>
                            </div>
                        </td>
                        <td>{{ $item->lowongan->judul_lowongan ?? 'Tidak diketahui' }}</td>
                        <td>
                            <span class="d-block">{{ \Carbon\Carbon::parse($item->tanggal_interview)->format('d F Y') }}</span>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->waktu_interview)->format('H:i') }}</small>
                        </td>
                        <td>{{ $item->metode_wawancara }}</td>
                        <td>
                            @if ($item->status === 'terjadwal')
                                <span class="badge badge-primary-custom">Terjadwal</span>
                            @else
                                <span class="badge badge-secondary-custom">Selesai</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('perusahaan.jadwal.view', $item->id) }}" class="btn btn-sm btn-outline-secondary btn-action" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('perusahaan.jadwal.edit', $item->id) }}" class="btn btn-sm btn-outline-warning btn-action text-dark" title="Edit Jadwal">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-calendar-x fs-4 d-block mb-2"></i>
                            Tidak ada jadwal wawancara yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Pagination --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mt-4">
        <small class="text-muted">Menampilkan {{ $jadwal->firstItem() }}–{{ $jadwal->lastItem() }} dari {{ $jadwal->total() }} Jadwal</small>
        <nav>
            {{ $jadwal->appends(['search' => $search, 'metode' => $metode])->links() }}
        </nav>
    </div>
</div>
@endsection
