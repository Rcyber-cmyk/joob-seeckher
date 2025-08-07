@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Dashboard --}}
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4 py-3 px-2 bg-light rounded shadow-sm">
        <div class="w-100 w-md-auto mb-3 mb-md-0">
            <h1 class="h3 fw-semibold mb-1">📄 Lowongan Saya</h1>
            <p class="text-muted mb-0">Kelola proses rekrutmen Anda dengan mudah dan efisien.</p>
        </div>
        <a href="{{ route('perusahaan.lowongan.create') }}" class="btn btn-primary d-flex align-items-center btn-post shadow-sm">
            <i class="bi bi-plus-circle-fill me-2"></i> Buat Lowongan
        </a>
    </div>
        
        {{-- Tabel Lowongan --}}
        <div class="dashboard-section bg-white rounded shadow-sm p-3">
        <div class="row gy-2 gx-3">
            <div class="col-lg-6">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Cari nama lowongan..." aria-label="Search">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div></br>
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
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Aktif</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">Tidak Aktif</span>
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
                                    <a href="{{ route('perusahaan.lowongan.view', $item->id) }}" class="btn btn-sm btn-outline-info" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('perusahaan.lowongan.edit', $item->id) }}" class="btn btn-sm btn-outline-warning text-dark" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('perusahaan.lowongan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
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
@endsection
