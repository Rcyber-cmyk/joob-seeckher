@extends('perusahaan.layouts.app')

@section('content')
<style>
    /* --- Umum --- */
    .dashboard-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .dashboard-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .header-dashboard {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-dashboard img {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary-color);
    }

    /* Badge Keahlian */
    .badge-skill {
        background-color: var(--primary-color);
        color: #fff;
        font-size: 0.85rem;
        padding: 0.4rem 0.75rem;
        border-radius: 20px;
    }

    /* List Info */
    .list-info li {
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px dashed #e0e0e0;
    }

    .list-info .fw-bold {
        color: var(--secondary-color);
    }

    /* Mobile Responsif */
    @media (max-width: 768px) {
        .header-dashboard {
            flex-direction: column;
            text-align: center;
        }
        .header-dashboard img {
            margin-bottom: 0.5rem;
        }
    }

    .ranking-breakdown-card {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .score-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: conic-gradient(var(--primary-color) 0deg, #e9ecef 0deg);
        position: relative;
        transition: background 0.5s ease-in-out;
    }
    .score-circle::before {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        background: #f8f9fa;
        border-radius: 50%;
    }
    .score-text {
        position: relative;
        font-size: 2rem;
        font-weight: 700;
        color: var(--secondary-color);
    }
    .score-text small {
        font-size: 1rem;
        color: #6c757d;
    }
    .criterion-list .list-group-item {
        background-color: transparent;
        border-color: #e0e0e0;
    }
    .criterion-name {
        font-weight: 600;
    }
    .criterion-contribution {
        font-weight: 700;
        color: var(--primary-color);
    }
</style>

{{-- Header --}}
<div class="header-dashboard mb-3">
    <div>
        {{-- Asumsi Auth::user()->profilePerusahaan sudah terload di layout --}}
        <img src="{{ Auth::user()->profilePerusahaan->logo_perusahaan ? asset('storage/' . Auth::user()->profilePerusahaan->logo_perusahaan) : asset('images/default-company-profile.png') }}" alt="Logo Perusahaan">
        <p class="text fw-bold mb-0">{{ $lowongan->judul_lowongan }}</p>
    </div>
    <div>
        <h1 class="mb-1">Detail Pelamar</h1>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary w-100">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    {{-- Informasi Pelamar --}}
    <div class="col-lg-6">
        <div class="dashboard-section p-4 h-100">
            <h5 class="fw-bold mb-3"><i class="bi bi-person-circle me-2"></i> Informasi Pelamar</h5>
            <ul class="list-unstyled list-info">
                <li><span class="fw-bold">Nama</span> : {{ $pelamar->user->name }}</li>
                <li><span class="fw-bold">Lokasi</span> : {{ $pelamar->domisili }}</li>
                <li><span class="fw-bold">Gender</span> : {{ $pelamar->gender }}</li>
                <li><span class="fw-bold">Usia</span> : {{ \Carbon\Carbon::parse($pelamar->tanggal_lahir)->age }} Tahun</li>
            </ul>

            <h5 class="fw-bold mt-4 mb-3"><i class="bi bi-file-earmark-text me-2"></i> Dokumen Lamaran</h5>
            <div class="d-flex flex-wrap gap-3">
                
                {{-- LINK SURAT LAMARAN --}}
                @if ($lamaran->surat_lamaran_path)
                    <a href="{{ asset('storage/' . $lamaran->surat_lamaran_path) }}" 
                       target="_blank" 
                       class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-file-earmark-text me-1"></i> Surat Lamaran (Lihat)
                    </a>
                @else
                    <button class="btn btn-outline-secondary btn-sm" disabled>
                        <i class="bi bi-file-earmark-text me-1"></i> Surat Lamaran (Tidak Ada File)
                    </button>
                    {{-- Opsi: Jika tidak ada file, tampilkan teks surat lamaran --}}
                    @if ($lamaran->surat_lamaran_text)
                        <button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#suratText" aria-expanded="false" aria-controls="suratText">
                            <i class="bi bi-journal-text me-1"></i> Baca Teks Surat
                        </button>
                    @endif
                @endif

                {{-- LINK RESUME (CV) --}}
                @if ($lamaran->resume_path)
                    <a href="{{ asset('storage/' . $lamaran->resume_path) }}" 
                       target="_blank" 
                       class="btn btn-outline-success btn-sm">
                        <i class="bi bi-file-earmark-richtext me-1"></i> Resume (Lihat)
                    </a>
                @else
                    <button class="btn btn-outline-secondary btn-sm" disabled>
                        <i class="bi bi-file-earmark-richtext me-1"></i> Resume (Tidak Ada File)
                    </button>
                @endif
            </div>

            {{-- Collapsible Text Surat Lamaran (Hanya muncul jika ada teks) --}}
            @if ($lamaran->surat_lamaran_text)
                <div class="collapse mt-3" id="suratText">
                    <div class="card card-body bg-light">
                        <h6 class="fw-bold">Teks Surat Lamaran:</h6>
                        <p style="white-space: pre-wrap;">{{ $lamaran->surat_lamaran_text }}</p>
                    </div>
                </div>
            @endif


            <h5 class="fw-bold mt-4 mb-3"><i class="bi bi-card-list me-2"></i> Ringkasan Pelamar</h5>
            <ul class="list-unstyled list-info">
                <li><span class="fw-bold">Pendidikan terakhir</span> : {{ $pelamar->lulusan }}</li>
                <li><span class="fw-bold">Nilai</span> : {{ $pelamar->nilai_akhir }}</li>
                <li><span class="fw-bold">Pengalaman kerja</span> : {{ $pelamar->pengalaman_kerja }} Tahun</li>
                <li>
                    <span class="fw-bold">Bidang keahlian</span> :
                    @forelse ($pelamar->keahlian as $keahlian)
                        <span class="badge-skill me-1">{{ $keahlian->nama_keahlian }}</span>
                    @empty
                        <span class="text-muted">Tidak ada keahlian</span>
                    @endforelse
                </li>
            </ul>
        </div>
    </div>

    {{-- Keahlian & Riwayat Karir & E-RANKING --}}
    <div class="col-lg-6">
        {{-- ========================== BLOK DETAIL E-RANKING ========================== --}}
        <div class="dashboard-section ranking-breakdown-card p-4 mb-4">
            <h5 class="fw-bold mb-4 text-center"><i class="bi bi-graph-up-arrow me-2"></i> Rincian Skor E-Ranking</h5>
            <div class="d-flex justify-content-center mb-4">
                <div class="score-circle" id="scoreCircle" data-score="{{ round($rankingDetails['final_score']) }}">
                    <div class="score-text">
                        {{ round($rankingDetails['final_score']) }}<small>/100</small>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush criterion-list">
                @foreach($rankingDetails['breakdown'] as $key => $details)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span class="criterion-name">{{ ucfirst($key) }}</span>
                        <small class="d-block text-muted">Bobot: {{ $details['weight'] }}% | Skor: {{ round($details['score']) }}/100</small>
                    </div>
                    <span class="criterion-contribution">+{{ number_format($details['contribution'], 2) }} Poin</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scoreCircle = document.getElementById('scoreCircle');
        const score = scoreCircle.dataset.score;
        const degree = (score / 100) * 360;
        // Atur gradient setelah halaman dimuat untuk efek animasi
        setTimeout(() => {
            scoreCircle.style.background = `conic-gradient(var(--primary-color) ${degree}deg, #e9ecef 0deg)`;
        }, 100);
    });
</script>
@endpush