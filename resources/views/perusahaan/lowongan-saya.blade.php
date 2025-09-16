@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Dashboard --}}
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4 py-3 px-3 bg-white rounded shadow-sm">
        <div class="w-100 w-md-auto mb-3 mb-md-0">
            <h1 class="h3 fw-semibold mb-1" style="color: var(--secondary-color);">📄 Lowongan Saya</h1>
            <p class="text-muted mb-0">Kelola proses rekrutmen Anda dengan mudah dan efisien.</p></br>
        </div>
        <a href="{{ route('perusahaan.lowongan.create') }}" class="btn btn-primary d-flex align-items-center btn-post" style="background-color: var(--primary-color); border-color: var(--primary-color);">
            <i class="bi bi-plus-circle-fill me-2"></i> Buat Lowongan
        </a>
    </div>

    {{-- Tabel Lowongan (Desktop & Tablet) --}}
    <div class="dashboard-section bg-white rounded shadow-sm p-4 d-none d-md-block">
        <div class="row mb-3 align-items-center">
            <div class="col-md-6 col-lg-4">
                <form class="d-flex" action="{{ route('perusahaan.lowongan-saya.index') }}" method="GET">
                    <input class="form-control me-2 rounded-pill" type="search" placeholder="Cari nama lowongan..." aria-label="Search" name="search" value="{{ $search ?? '' }}">
                    <button class="btn btn-primary rounded-pill" type="submit" style="background-color: var(--secondary-color); border-color: var(--secondary-color);">Cari</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">📌 Posisi</th>
                        <th scope="col">📶 Status</th>
                        <th scope="col">👥 Jumlah Pelamar</th>
                        <th scope="col">📅 Tanggal Posting</th>
                        <th scope="col">⚙️ Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lowongan as $item)
                        <tr>
                            <td>
                                <span class="fw-bold text-dark d-block">{{ $item->judul_lowongan }}</span>
                                <small class="text-muted d-block">{{ $item->domisili ?? 'Tidak tersedia' }}</small>
                            </td>
                            <td>
                                @if ($item->is_active)
                                    <span class="badge bg-success text-white rounded-pill px-3 py-2">Aktif</span>
                                @else
                                    <span class="badge bg-danger text-white rounded-pill px-3 py-2">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('perusahaan.lowongan.pelamar.index', ['lowongan_id' => $item->id]) }}" class="text-primary fw-semibold text-decoration-none">
                                    {{ $item->lamaran_count ?? 0 }} Pelamar
                                </a>
                            </td>
                            <td>
                                <span class="text-dark">{{ $item->created_at->format('d M Y') }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('perusahaan.lowongan.view', $item->id) }}" class="btn btn-sm btn-info text-white" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('perusahaan.lowongan.edit', $item->id) }}" class="btn btn-sm btn-warning text-dark" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('perusahaan.lowongan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger text-white" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-folder-x fs-4 d-block mb-2"></i>
                                Tidak ada lowongan yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Card Lowongan (Mobile) --}}
    <div class="d-md-none">
        <div class="row mb-3">
            <div class="col-12">
                <form class="d-flex" action="{{ route('perusahaan.lowongan-saya.index') }}" method="GET">
                    <input class="form-control me-2 rounded-pill" type="search" placeholder="Cari nama lowongan..." aria-label="Search" name="search" value="{{ $search ?? '' }}">
                    <button class="btn btn-primary rounded-pill" type="submit" style="background-color: var(--secondary-color); border-color: var(--secondary-color);">Cari</button>
                </form>
            </div>
        </div>
        @forelse ($lowongan as $item)
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="flex-grow-1">
                            <h5 class="card-title fw-bold text-dark mb-0">{{ $item->judul_lowongan }}</h5>
                            <small class="text-muted d-block">{{ $item->domisili ?? 'Tidak tersedia' }}</small>
                        </div>
                        <div>
                            @if ($item->is_active)
                                <span class="badge bg-success text-white rounded-pill">Aktif</span>
                            @else
                                <span class="badge bg-danger text-white rounded-pill">Tidak Aktif</span>
                            @endif
                        </div>
                    </div>
                    <ul class="list-unstyled mb-2 small text-muted">
                        <li><i class="bi bi-calendar me-2"></i><span>Posting: {{ $item->created_at->format('d M Y') }}</span></li>
                        <a href="{{ route('perusahaan.lowongan.pelamar.index', ['lowongan_id' => $item->id]) }}" class="text-primary fw-semibold text-decoration-none">
                                    {{ $item->lamaran_count ?? 0 }} Pelamar
                                </a>
                    </ul>
                    <div class="d-flex flex-wrap gap-2 justify-content-end">
                        <a href="{{ route('perusahaan.lowongan.view', $item->id) }}" class="btn btn-sm btn-info text-white" title="Lihat">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('perusahaan.lowongan.edit', $item->id) }}" class="btn btn-sm btn-warning text-dark" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('perusahaan.lowongan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger text-white" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center" role="alert">
                <i class="bi bi-folder-x fs-4 d-block mb-2"></i>
                Tidak ada lowongan yang ditemukan.
            </div>
        @endforelse
    </div>
@endsection
