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
<tr>
    <td>
        <strong class="d-block">{{ $jadwal->pelamar->nama_lengkap ?? 'Pelamar Dihapus' }}</strong>
        <small class="text-muted">{{ $jadwal->pelamar->user->email ?? 'Email N/A' }}</small>
    </td>
    <td>
        <strong class="d-block">{{ \Carbon\Carbon::parse($jadwal->tanggal_interview)->isoFormat('D MMM YYYY') }}</strong>
        <small class="text-muted">{{ \Carbon\Carbon::parse($jadwal->waktu_interview)->format('H:i') }} WIB</small>
    </td>
    <td>
        <strong class="d-block">{{ $jadwal->metode_wawancara }}</strong>
        <small class="text-muted">
            @if ($jadwal->metode_wawancara === 'Virtual Interview')
                <a href="{{ $jadwal->link_zoom }}" target="_blank">Link Zoom</a>
            @else
                {{ \Illuminate\Support\Str::limit($jadwal->lokasi_interview ?? 'Lokasi fisik', 20) }}
            @endif
        </small>
    </td>
    <td>
        <span class="badge rounded-pill {{ $statusClass[$statusKey] ?? 'bg-secondary' }}">{{ ucfirst($jadwal->status) }}</span>
    </td>
    <td class="text-center">
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
    </td>
</tr>