<div class="job-detail-inner-container p-4 p-lg-5">
    @if($detailLowongan)
    <div id="job-detail-content">
        
        {{-- HEADER DETAIL --}}
        <div class="d-flex align-items-start mb-4 border-bottom pb-4">
            <img id="detail-logo" src="{{ $detailLowongan->perusahaan?->logo_perusahaan ? asset('storage/' . $detailLowongan->perusahaan->logo_perusahaan) : 'https://placehold.co/80x80/e9ecef/343a40?text=' . substr($detailLowongan->perusahaan?->nama_perusahaan ?? 'N/A', 0, 1) }}" 
                 alt="Logo" class="company-logo-detail rounded-3 border p-1 bg-white me-4" style="width: 80px; height: 80px; object-fit: contain;">
            
            <div class="flex-grow-1">
                <h2 class="fw-bold mb-1 text-dark">{{ $detailLowongan->judul_lowongan }}</h2>
                <div class="mb-2 text-muted">
                    <span class="fw-semibold text-dark">{{ $detailLowongan->perusahaan?->nama_perusahaan ?? '-' }}</span>
                    <span class="mx-2">•</span>
                    <span><i class="bi bi-geo-alt-fill text-orange me-1"></i> {{ $detailLowongan->domisili ?? '-' }}</span>
                </div>
                
                <div class="d-flex gap-2 mt-3">
                    {{-- Tombol Aksi --}}
                    @if($sudahMelamar)
                        <button class="btn btn-success btn-lg disabled px-4 rounded-pill">
                            <i class="bi bi-check-circle-fill me-2"></i> Sudah Dilamar
                        </button>
                    @else
                        <a href="{{ route('lowongan.lamar.form', $detailLowongan->id) }}" class="btn btn-orange btn-lg px-5 rounded-pill fw-bold shadow-sm">
                            Lamar Sekarang
                        </a>
                    @endif

                    <form action="{{ route('lowongan.toggleSimpan', $detailLowongan->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-lg rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;" title="Simpan Lowongan">
                            @if(in_array($detailLowongan->id, $saved_lowongan_ids))
                                <i class="bi bi-bookmark-fill text-orange"></i>
                            @else
                                <i class="bi bi-bookmark"></i>
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- KOLOM UTAMA (Deskripsi & Info) --}}
            <div class="col-lg-8">
                
                {{-- DESKRIPSI PEKERJAAN --}}
                <section class="mb-5">
                    <h5 class="fw-bold text-dark mb-3 border-start border-4 border-warning ps-3">Deskripsi Pekerjaan</h5>
                    <div class="job-description text-secondary lh-lg">
                        {!! nl2br(e($detailLowongan->deskripsi_pekerjaan)) !!}
                    </div>
                </section>

                {{-- KUALIFIKASI / PERSYARATAN --}}
                <section class="mb-5">
                     <h5 class="fw-bold text-dark mb-3 border-start border-4 border-warning ps-3">Kualifikasi & Persyaratan</h5>
                     <div class="bg-light p-4 rounded-3 border">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Pendidikan Terakhir</small>
                                <p class="fw-medium mb-0"><i class="bi bi-mortarboard-fill me-2 text-primary"></i> {{ $detailLowongan->pendidikan_terakhir ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Nilai Min.</small>
                                <p class="fw-medium mb-0"><i class="bi bi-award-fill me-2 text-primary"></i> {{ $detailLowongan->nilai_pendidikan_terakhir ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Usia</small>
                                <p class="fw-medium mb-0">
                                    <i class="bi bi-person-fill me-2 text-primary"></i> 
                                    @if($detailLowongan->usia_min > 0) {{ $detailLowongan->usia_min }} - @endif
                                    {{ $detailLowongan->usia ?? 'Tidak dibatasi' }} Tahun
                                </p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Gender</small>
                                <p class="fw-medium mb-0"><i class="bi bi-gender-ambiguous me-2 text-primary"></i> {{ $detailLowongan->gender ?? 'Semua Gender' }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Pengalaman Kerja</small>
                                <p class="fw-medium mb-0">
                                    <i class="bi bi-briefcase-fill me-2 text-primary"></i> 
                                    {{ $detailLowongan->pengalaman_kerja ?? '0' }} - {{ $detailLowongan->pengalaman_kerja_maks > 0 ? $detailLowongan->pengalaman_kerja_maks : '~' }} Tahun
                                </p>
                            </div>
                        </div>
                     </div>
                </section>

                {{-- KEAHLIAN --}}
                @if($detailLowongan->keahlian_bidang_pekerjaan)
                <section class="mb-5">
                    <h5 class="fw-bold text-dark mb-3 border-start border-4 border-warning ps-3">Keahlian Dibutuhkan</h5>
                    <div class="d-flex flex-wrap gap-2">
                        {{-- Jika keahlian dipisah koma, bisa di-explode --}}
                        @foreach(explode(',', $detailLowongan->keahlian_bidang_pekerjaan) as $skill)
                            <span class="badge bg-white border text-dark py-2 px-3 rounded-pill fw-normal shadow-sm">
                                {{ trim($skill) }}
                            </span>
                        @endforeach
                    </div>
                </section>
                @endif

            </div>

            {{-- KOLOM SIDEBAR DETAIL (Ringkasan) --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm bg-light rounded-3">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 text-uppercase text-muted small">Ringkasan Pekerjaan</h6>
                        
                        <div class="mb-3">
                            <small class="text-muted d-block">Diposting pada</small>
                            <span class="fw-medium">{{ $detailLowongan->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Tipe Pekerjaan</small>
                            <span class="fw-medium">{{ $detailLowongan->tipe_pekerjaan ?? 'Full Time' }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Lokasi</small>
                            <span class="fw-medium">{{ $detailLowongan->domisili }}</span>
                        </div>
                        <hr>
                        <div class="mb-0">
                            <small class="text-muted d-block">Terakhir Diupdate</small>
                            <span class="fw-medium">{{ $detailLowongan->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                {{-- Info Perusahaan Singkat (Opsional) --}}
                <div class="mt-4 p-3 border rounded-3 bg-white">
                    <div class="d-flex align-items-center mb-2">
                        <img src="{{ $detailLowongan->perusahaan?->logo_perusahaan ? asset('storage/' . $detailLowongan->perusahaan->logo_perusahaan) : asset('images/default-logo.png') }}" 
                             alt="Logo" class="rounded-circle border p-1 me-2" style="width: 40px; height: 40px;">
                        <h6 class="mb-0 fw-bold">{{ $detailLowongan->perusahaan->nama_perusahaan }}</h6>
                    </div>
                    <p class="small text-muted mb-2 line-clamp-3">{{ Str::limit($detailLowongan->perusahaan->deskripsi, 100) }}</p>
                    <a href="#" class="text-decoration-none text-orange small fw-bold" data-bs-toggle="modal" data-bs-target="#companyProfileModal">
                        Lihat Profil Perusahaan <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    {{-- ========================================================== --}}
    {{-- MODAL PROFIL PERUSAHAAN (POPUP)                            --}}
    {{-- ========================================================== --}}
    @if($detailLowongan && $detailLowongan->perusahaan)
    <div class="modal fade" id="companyProfileModal" tabindex="-1" aria-labelledby="companyProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                
                {{-- Header Modal (Logo & Nama) --}}
                <div class="modal-header border-bottom-0 flex-column align-items-center pt-5 pb-3" style="background-color: #f8f9fa;">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                    <img src="{{ $detailLowongan->perusahaan->logo_perusahaan ? asset('storage/' . $detailLowongan->perusahaan->logo_perusahaan) : asset('images/default-logo.png') }}" 
                        alt="Logo" class="rounded-4 shadow-sm mb-3 bg-white p-2" style="width: 100px; height: 100px; object-fit: contain;">
                    
                    <h3 class="modal-title fw-bold text-dark" id="companyProfileModalLabel">{{ $detailLowongan->perusahaan->nama_perusahaan }}</h3>
                    
                    {{-- Status Premium Badge (Opsional) --}}
                    @if($detailLowongan->perusahaan->is_premium ?? false) 
                        <span class="badge bg-warning text-dark mt-2"><i class="bi bi-patch-check-fill"></i> Verified Partner</span>
                    @endif
                </div>

                {{-- Body Modal --}}
                <div class="modal-body p-4 p-lg-5">
                    
                    {{-- Deskripsi Perusahaan --}}
                    <div class="mb-5">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3 letter-spacing-1">Tentang Perusahaan</h6>
                        <p class="text-secondary" style="line-height: 1.8;">
                            {{ $detailLowongan->perusahaan->deskripsi ?? 'Belum ada deskripsi perusahaan.' }}
                        </p>
                    </div>

                    <div class="row g-4">
                        {{-- Kontak & Web --}}
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <h6 class="fw-bold mb-3"><i class="bi bi-globe2 text-orange me-2"></i> Kontak & Web</h6>
                                <ul class="list-unstyled mb-0 text-muted small">
                                    <li class="mb-2 d-flex">
                                        <span class="fw-medium me-2" style="min-width: 80px;">Website:</span> 
                                        @if($detailLowongan->perusahaan->situs_web)
                                            <a href="{{ $detailLowongan->perusahaan->situs_web }}" target="_blank" class="text-decoration-none text-break">{{ $detailLowongan->perusahaan->situs_web }}</a>
                                        @else
                                            -
                                        @endif
                                    </li>
                                    <li class="d-flex">
                                        <span class="fw-medium me-2" style="min-width: 80px;">Telepon:</span> 
                                        <span>{{ $detailLowongan->perusahaan->no_telp_perusahaan ?? '-' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill text-orange me-2"></i> Lokasi Kantor</h6>
                                <p class="text-muted small mb-1">
                                    {{ $detailLowongan->perusahaan->alamat_jalan ?? '' }}
                                </p>
                                <p class="text-muted small mb-0 fw-medium">
                                    {{ $detailLowongan->perusahaan->alamat_kota ?? '' }} 
                                    {{ $detailLowongan->perusahaan->kode_pos ? ', ' . $detailLowongan->perusahaan->kode_pos : '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">

                    {{-- Meta Data (Created/Updated) --}}
                    <div class="d-flex justify-content-between text-muted small">
                        <span><i class="bi bi-clock-history me-1"></i> Bergabung sejak: {{ $detailLowongan->perusahaan->created_at->format('d M Y') }}</span>
                        <span>Update terakhir: {{ $detailLowongan->perusahaan->updated_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Footer Modal --}}
                <div class="modal-footer border-top-0 pb-4 pe-5">
                    <button type="button" class="btn btn-light px-4 fw-medium" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>
    @endif
    @else
    <div class="d-flex justify-content-center align-items-center h-100 text-center p-5" style="min-height: 500px;">
        <div>
            <img src="{{ asset('images/select-job.svg') }}" alt="Select Job" style="width: 200px; opacity: 0.7;" class="mb-4">
            <h4 class="text-muted fw-bold">Pilih Lowongan</h4>
            <p class="text-muted">Klik salah satu lowongan di sebelah kiri untuk melihat detail lengkapnya di sini.</p>
        </div>
    </div>
    @endif
</div>