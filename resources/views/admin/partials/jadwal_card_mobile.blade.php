<?php 
// Variabel: $jadwal
$statusKey = strtolower($jadwal->status);
$statusClass = [
    'terjadwal' => 'badge-terjadwal',
    'selesai' => 'badge-selesai',
    'dibatalkan' => 'badge-batal',
    'pending' => 'badge-terjadwal',
];
?>
<div class="pelamar-item-mobile">
    <strong class="d-flex justify-content-between">
        {{ $jadwal->pelamar->nama_lengkap ?? 'Pelamar Dihapus' }}
        <span class="badge rounded-pill {{ $statusClass[$statusKey] ?? 'bg-secondary' }}">{{ ucfirst($jadwal->status) }}</span>
    </strong>
    
    <div data-label="Email:">{{ $jadwal->pelamar->user->email ?? 'N/A' }}</div>
    <div data-label="Tanggal:">
        {{ \Carbon\Carbon::parse($jadwal->tanggal_interview)->isoFormat('D MMM YYYY') }} - 
        {{ \Carbon\Carbon::parse($jadwal->waktu_interview)->format('H:i') }} WIB
    </div>
    <div data-label="Metode:">
        {{ $jadwal->metode_wawancara }}
        @if ($jadwal->metode_wawancara === 'Virtual Interview')
            (<a href="{{ $jadwal->link_zoom }}" target="_blank">Link</a>)
        @endif
    </div>
    
    <div class="mt-2 text-center">
        <a href="{{ route('admin.jadwalwawancara.show', $jadwal->id) }}" class="btn btn-sm btn-info text-white btn-action" title="Detail">
            <i class="bi bi-eye-fill"></i>
        </a>
        <button onclick="confirmDelete(this)" data-id="{{ $jadwal->id }}" class="btn btn-sm btn-danger text-white btn-action" title="Hapus">
            <i class="bi bi-trash-fill"></i>
        </button>
        <form id="delete-form-{{ $jadwal->id }}" action="{{ route('admin.jadwalwawancara.destroy', $jadwal->id) }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>