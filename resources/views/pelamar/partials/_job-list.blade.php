{{-- Simpan sebagai /resources/views/pelamar/lowongan/partials/_job-list.blade.php --}}
<div class="job-list-container">
    @forelse($lowonganList as $lowongan)
    <div class="job-list-card {{ $loop->first ? 'active' : '' }}" data-id="{{ $lowongan->id }}">
        <div class="d-flex">
            <img src="{{ $lowongan->perusahaan->logo ? asset('storage/' . $lowongan->perusahaan->logo) : 'https://placehold.co/60x60/e9ecef/343a40?text=' . substr($lowongan->perusahaan->nama_perusahaan, 0, 1) }}" alt="Logo" class="company-logo-list">
            <div class="ms-3">
                <h6 class="job-title-list">{{ $lowongan->judul_lowongan }}</h6>
                <p class="company-name-list text-muted mb-2">{{ $lowongan->perusahaan->nama_perusahaan }}</p>
                <div class="job-tags">
                    <span class="badge job-tag">Remote</span>
                    <span class="badge job-tag">Full Time</span>
                    <span class="badge job-tag">12 Juta/Bulan</span>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center p-5">
        <p>Tidak ada lowongan yang cocok dengan kriteria Anda.</p>
    </div>
    @endforelse
</div>
<div class="mt-4 d-flex justify-content-center">
    {{ $lowonganList->appends(request()->query())->links() }}
</div>
