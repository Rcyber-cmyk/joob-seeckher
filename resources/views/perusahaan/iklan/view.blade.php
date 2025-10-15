<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasang Iklan Lowongan Baru</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }
        .page-header {
            background: linear-gradient(135deg, #071b2f, #0d3053);
            color: white;
            padding: 2rem 1rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
        .card-header-custom {
            background-color: #071b2f;
            color: white;
            font-weight: 600;
        }
        .paket-pilihan .card {
            transition: all 0.25s ease-in-out;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .paket-pilihan .card:hover {
            transform: translateY(-4px);
            border-color: #ff7b00;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12) !important;
        }
        .paket-pilihan input[type="radio"]:checked + .card {
            border-color: #ff7b00;
            box-shadow: 0 0 0 3px rgba(255, 123, 0, 0.3) !important;
        }
        .image-preview-container {
            width: 100%;
            max-width: 180px;
            height: 160px;
            border: 2px dashed #ccc;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #fafafa;
            flex-direction: column;
            text-align: center;
            padding: 8px;
        }
        .image-preview-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .btn-orange {
            background-color: #ff7b00;
            border: none;
        }
        .btn-orange:hover {
            background-color: #e56f00;
        }
    </style>
</head>
<body>

    <div class="container py-4">
        
        {{-- Header --}}
        <div class="page-header text-center shadow-sm">
            <h1 class="fw-bold mb-2">Pasang Iklan Lowongan Baru</h1>
            <p class="mb-0">Isi detail di bawah untuk menjangkau ribuan kandidat berkualitas</p>
        </div>

        {{-- Form --}}
        <form action="#" method="POST" enctype="multipart/form-data">
            {{-- @csrf --}}

            <div class="row g-4">
                
                {{-- Kolom Kiri --}}
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header card-header-custom">
                            <i class="bi bi-file-earmark-text me-2"></i> Detail Iklan
                        </div>
                        <div class="card-body p-4">

                            {{-- Nama Perusahaan --}}
                            <div class="mb-3">
                                <label for="nama_perusahaan" class="form-label fw-semibold">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="nama_perusahaan" 
                                       value="Nama Perusahaan Diambil dari Profil" readonly>
                                <div class="form-text">Nama perusahaan otomatis dari profil Anda</div>
                            </div>

                            {{-- Judul Lowongan --}}
                            <div class="mb-3">
                                <label for="judul_lowongan" class="form-label fw-semibold">Judul Lowongan</label>
                                <input type="text" class="form-control" id="judul_lowongan" name="judul_lowongan" 
                                       placeholder="Contoh: Senior Web Developer" required>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi Lowongan</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="7"
                                          placeholder="Tulis deskripsi pekerjaan, kualifikasi, benefit, dll" required></textarea>
                            </div>

                            {{-- Upload File --}}
                            <div class="mb-3">
                                <label for="file_iklan" class="form-label fw-semibold">Poster / Banner Iklan (Opsional)</label>
                                <input class="form-control" type="file" id="file_iklan" name="file_iklan" accept="image/png, image/jpeg, application/pdf">
                                <div class="form-text">Format: JPG, PNG, atau PDF. Maks 2MB</div>
                            </div>

                            {{-- Preview --}}
                            <div class="mt-3">
                                <label class="form-label fw-semibold">Preview</label>
                                <div class="image-preview-container" id="previewContainer">
                                    <img src="" alt="Image Preview" class="d-none" id="imagePreview">
                                    <span class="preview-text" id="previewText"><i class="bi bi-image fs-1 text-muted"></i></span>
                                    <span class="preview-file-name d-none" id="fileName"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-lg-4">
                    {{-- Pilihan Paket --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header card-header-custom">
                            <i class="bi bi-star-fill me-2"></i>Pilih Paket Iklan
                        </div>
                        <div class="card-body p-3 paket-pilihan">

                            {{-- Gratis --}}
                            <label for="paket_gratis" class="w-100">
                                <input type="radio" name="paket" id="paket_gratis" value="gratis" class="d-none" checked>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="fw-bold">GRATIS</h6>
                                        <p class="small text-muted mb-1">Aktif 15 hari • Jangkauan standar</p>
                                        <div class="text-end fw-bold fs-6">Rp 0</div>
                                    </div>
                                </div>
                            </label>

                            {{-- VIP --}}
                            <label for="paket_vip" class="w-100">
                                <input type="radio" name="paket" id="paket_vip" value="vip" class="d-none">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="fw-bold text-warning">VIP</h6>
                                            <span class="badge bg-warning text-dark">Populer</span>
                                        </div>
                                        <p class="small text-muted mb-1">Promosi di halaman utama • Aktif 30 hari</p>
                                        <div class="text-end fw-bold fs-6">Rp 150.000</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <p class="small text-muted">Pastikan semua data sudah benar. Iklan ditinjau tim sebelum dipublikasikan.</p>
                            <div class="d-grid gap-2">
                                <a href="javascript:history.back()" class="btn btn-secondary btn-lg fw-semibold">
                                    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-orange btn-lg fw-semibold text-white">
                                    <i class="bi bi-send-fill me-2"></i> Kirim & Pasang Iklan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file_iklan');
        const imagePreview = document.getElementById('imagePreview');
        const previewText = document.getElementById('previewText');
        const fileNameDisplay = document.getElementById('fileName');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                imagePreview.classList.add('d-none');
                previewText.classList.add('d-none');
                fileNameDisplay.classList.add('d-none');

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewText.innerHTML = '<i class="bi bi-file-earmark-text fs-1 text-muted"></i>';
                    fileNameDisplay.textContent = file.name;
                    previewText.classList.remove('d-none');
                    fileNameDisplay.classList.remove('d-none');
                }
            } else {
                imagePreview.classList.add('d-none');
                fileNameDisplay.classList.add('d-none');
                previewText.innerHTML = '<i class="bi bi-image fs-1 text-muted"></i>';
                previewText.classList.remove('d-none');
                imagePreview.src = '';
                fileNameDisplay.textContent = '';
            }
        });
    });
    </script>

</body>
</html>
