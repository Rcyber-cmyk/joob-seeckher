@extends('perusahaan.layouts.app')

@section('content')
    {{-- Header Dashboard yang Responsif, Dibuat Seragam untuk Semua Ukuran --}}
    <div class="header-dashboard d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="w-100 w-md-auto mb-3 mb-md-0">
            <h1>Selamat Datang PT {{ Auth::user()->profilePerusahaan->nama_perusahaan ?? 'Perusahaan' }}</h1>
            <p class="text-muted">Kelola Proses Rekrutmen Anda Dengan Mudah</p>
        </div>
        <a href="{{ route('perusahaan.lowongan.create') }}" class="btn btn-primary d-flex align-items-center btn-post">
            <i class="bi bi-plus-circle-fill me-2"></i> Buat Lowongan
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="info-card d-flex flex-column info-lowongan">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="mb-0">Lowongan Aktif</h4>
                        <span class="card-value">5</span>
                    </div>
                    <div class="icon-placeholder">
                        <i class="bi bi-house-door-fill"></i>
                    </div>
                </div>
                <span class="change-text fw-semibold">+2% Dari Bulan Lalu</span>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="info-card d-flex flex-column info-pelamar">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="mb-0">Total Pelamar</h4>
                        <span class="card-value">142</span>
                    </div>
                    <div class="icon-placeholder">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <span class="change-text fw-semibold">+2% Dari Bulan Lalu</span>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="info-card d-flex flex-column info-wawancara">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="mb-0">Wawancara Terjadwal</h4>
                        <span class="card-value">8</span>
                    </div>
                    <div class="icon-placeholder">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                </div>
                <span class="change-text fw-semibold">+2% Dari Bulan Lalu</span>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="info-card d-flex flex-column info-diterima">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h4 class="mb-0">Kandidat Diterima</h4>
                        <span class="card-value">13</span>
                    </div>
                    <div class="icon-placeholder">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                </div>
                <span class="change-text fw-semibold">+2% Dari Bulan Lalu</span>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="dashboard-section h-100">
                <h5 class="mb-4">Kandidat Terbaru</h5>
                <div class="kandidat-list">
                    <div class="kandidat-item d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="profile-img me-3">
                        <div class="flex-grow-1">
                            <h6 class="name mb-0">Arsura gaur</h6>
                            <span class="email">arsuragaur@gmail.com</span>
                        </div>
                        <span class="date me-3 d-none d-md-block">12 Dec, 2020</span>
                        <span class="status new">Baru</span>
                    </div>
                    <div class="kandidat-item d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="profile-img me-3">
                        <div class="flex-grow-1">
                            <h6 class="name mb-0">James Mullican</h6>
                            <span class="email">jamesmullican@gmail.com</span>
                        </div>
                        <span class="date me-3 d-none d-md-block">10 Dec, 2020</span>
                        <span class="status new">Baru</span>
                    </div>
                    <div class="kandidat-item d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="profile-img me-3">
                        <div class="flex-grow-1">
                            <h6 class="name mb-0">Anne Jacob</h6>
                            <span class="email">annejacob@gmail.com</span>
                        </div>
                        <span class="date me-3 d-none d-md-block">10 Dec, 2020</span>
                        <span class="status new">Baru</span>
                    </div>
                    <div class="kandidat-item d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="profile-img me-3">
                        <div class="flex-grow-1">
                            <h6 class="name mb-0">James Mullican</h6>
                            <span class="email">jamesmullican@gmail.com</span>
                        </div>
                        <span class="date me-3 d-none d-md-block">10 Dec, 2020</span>
                        <span class="status new">Baru</span>
                    </div>
                    <div class="kandidat-item d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="profile-img me-3">
                        <div class="flex-grow-1">
                            <h6 class="name mb-0">Anne Jacob</h6>
                            <span class="email">annejacob@gmail.com</span>
                        </div>
                        <span class="date me-3 d-none d-md-block">10 Dec, 2020</span>
                        <span class="status new">Baru</span>
                    </div>
                    <div class="kandidat-item d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="profile-img me-3">
                        <div class="flex-grow-1">
                            <h6 class="name mb-0">Arsura gaur</h6>
                            <span class="email">arsuragaur@gmail.com</span>
                        </div>
                        <span class="date me-3 d-none d-md-block">12 Dec, 2020</span>
                        <span class="status new">Baru</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="dashboard-section h-100">
                <h5 class="mb-4">Aktivitas Lowongan</h5>
                <div class="d-flex align-items-center">
                    <div class="chart-container flex-grow-1">
                        <canvas id="lowonganChart"></canvas>
                    </div>
                    <div class="chart-legend">
                        <div class="chart-legend-item d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="chart-legend-color me-2" style="background-color: #dc3545;"></div>
                                <span>Ditolak</span>
                            </div>
                            <span class="ms-auto">25%</span>
                        </div>
                        <div class="chart-legend-item d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="chart-legend-color me-2" style="background-color: #ff7a00;"></div>
                                <span>Wawancara</span>
                            </div>
                            <span class="ms-auto">45%</span>
                        </div>
                        <div class="chart-legend-item d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="chart-legend-color me-2" style="background-color: #071b2f;"></div>
                                <span>Diterima</span>
                            </div>
                            <span class="ms-auto">30%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const data = {
        labels: ['Diterima', 'Wawancara', 'Ditolak'],
        datasets: [{
            data: [30, 45, 25],
            backgroundColor: ['#071b2f', '#ff7a00', '#dc3545'],
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
                            return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                        }
                    }
                }
            }
        }
    };
    const lowonganChart = new Chart( document.getElementById('lowonganChart'), config );
</script>
@endpush
