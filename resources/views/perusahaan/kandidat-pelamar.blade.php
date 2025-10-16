@extends('perusahaan.layouts.app')

@section('content')
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="w-100 w-md-auto mb-3 mb-md-0">
            <h1>Selamat Datang, {{ Auth::user()->profilePerusahaan->nama_perusahaan ?? 'Perusahaan' }}!</h1>
            <p class="text-muted">Kelola proses rekrutmen Anda dengan mudah.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('perusahaan.cari-kandidat.index') }}" class="btn btn-success">
                <i class="bi bi-plus-circle-fill me-2"></i> Dapatkan Pelamar Terbaik
            </a>
            <a href="{{ route('perusahaan.lowongan.create') }}" class="btn btn-primary" style="background-color: var(--primary-color); border-color: var(--primary-color);">
                <i class="bi bi-plus-circle-fill me-2"></i> Buat Lowongan
            </a>
        </div>
    </div>

    {{-- Kartu Statistik Dinamis --}}
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-card d-flex flex-column info-lowongan">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="mb-0">Lowongan Aktif</h4>
                        <span class="card-value">{{ $lowonganAktifCount }}</span>
                    </div>
                    <div class="icon-placeholder"><i class="bi bi-house-door-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-card d-flex flex-column info-pelamar">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="mb-0">Total Pelamar</h4>
                        <span class="card-value">{{ $totalPelamarCount }}</span>
                    </div>
                    <div class="icon-placeholder"><i class="bi bi-people-fill"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-card d-flex flex-column info-wawancara">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="mb-0">Wawancara</h4>
                        <span class="card-value">{{ $wawancaraTerjadwalCount }}</span>
                    </div>
                    <div class="icon-placeholder"><i class="bi bi-calendar-event"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-card d-flex flex-column info-diterima">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="mb-0">Diterima</h4>
                        <span class="card-value">{{ $kandidatDiterimaCount }}</span>
                    </div>
                    <div class="icon-placeholder"><i class="bi bi-person-check-fill"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Daftar Kandidat Terbaru Dinamis --}}
        <div class="col-lg-6">
            <div class="dashboard-section h-100">
                <h5 class="mb-4">Kandidat Pelamar</h5>
                <div class="kandidat-list">
                    @forelse ($pelamarTerbaru as $pelamar)
                        <div class="kandidat-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{ $pelamar->foto_profil ? asset('storage/' . $pelamar->foto_profil) : asset('images/default-profile.png') }}" alt="Profile" class="profile-img me-3">
                                <div>
                                    <span class="name mb-0 fw-bold">{{ $pelamar->user->name }}</span>
                                    <span class="email d-none d-sm-block text-muted">{{ $pelamar->lulusan ?? 'Pendidikan belum diisi' }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center ms-auto">
                                <span class="date me-3 d-none d-md-block text-muted">Bergabung {{ $pelamar->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted p-4">
                            <i class="bi bi-person-x-fill fs-3"></i>
                            <p class="mt-2">Belum ada pelamar baru yang mendaftar.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Chart Dinamis --}}
        <div class="col-lg-6">
            <div class="dashboard-section h-100">
                <h5 class="mb-4">Aktivitas Lowongan</h5>
                @if($chartData->isNotEmpty())
                    <div class="d-flex flex-column flex-md-row align-items-center h-100">
                        <div class="chart-container flex-grow-1 mb-4 mb-md-0 me-md-4" style="max-height: 250px;">
                            <canvas id="lowonganChart"></canvas>
                        </div>
                        <div class="chart-legend w-100" style="max-width: 200px;">
                            @php
                                $colors = ['#071b2f', '#ff7a00', '#dc3545', '#198754', '#6c757d'];
                                $colorIndex = 0;
                                $total = $chartData->sum();
                            @endphp
                            @foreach($chartData as $status => $count)
                                <div class="chart-legend-item d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="chart-legend-color me-2" style="background-color: {{ $colors[$colorIndex++ % count($colors)] }};"></div>
                                        <span class="fw-semibold">{{ ucfirst($status) }}</span>
                                    </div>

                                    <span class="ms-auto text-muted">
                                        @if ($total > 0)
                                            {{ round(($count / $total) * 100) }}%
                                        @else
                                            0%
                                        @endif
                                    </span>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @else
                    <div class="text-center text-muted d-flex flex-column justify-content-center align-items-center h-100">
                        <i class="bi bi-pie-chart-fill fs-1"></i>
                        <p class="mt-3">Data aktivitas lowongan belum tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{-- Pastikan Anda sudah memuat Chart.js di layout utama Anda --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if($chartData->isNotEmpty())
        const data = {
            labels: @json($chartLabels),
            datasets: [{
                data: @json($chartValues),
                backgroundColor: ['#071b2f', '#ff7a00', '#dc3545', '#198754', '#6c757d'],
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' pelamar';
                            }
                        }
                    }
                }
            }
        };
        const lowonganChart = new Chart( document.getElementById('lowonganChart'), config );
    @endif
</script>
@endpush
