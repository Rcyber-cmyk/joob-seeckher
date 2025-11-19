<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita Baru - Job Recruitment</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* === CSS UTAMA (KONSISTEN) === */
        :root {
            --orange: #f97316; --orange-dark: #ea580c; --dark-blue: #0f172a; 
            --slate: #475569; --bg-main: #f1f5f9; --white: #ffffff;
            --sidebar-width: 260px; --default-border-radius: 1rem;
            --default-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --border-color: #e2e8f0; 
        }
        
        body { background-color: var(--bg-main); font-family: 'Poppins', sans-serif; color: var(--dark-blue); overflow-x: hidden; }
        .sidebar { width: var(--sidebar-width); background-image: linear-gradient(180deg, var(--orange-dark) 0%, var(--orange) 100%); padding: 1.5rem 1rem; position: fixed; top: 0; left: 0; height: 100vh; z-index: 1100; display: flex; flex-direction: column; transition: var(--default-transition); }
        .sidebar .logo { font-weight: 700; font-size: 1.8rem; text-align: center; margin-bottom: 2rem; letter-spacing: 1px; color: var(--white); }
        .sidebar .nav { overflow-y: auto; overflow-x: hidden; flex-grow: 1; }
        .sidebar .user-profile { margin-top: 1rem; background-color: rgba(0,0,0,0.15); padding: 0.75rem; border-radius: var(--default-border-radius); flex-shrink: 0; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.85); padding: 0.6rem 1.2rem; margin-bottom: 0.2rem; border-radius: 0.75rem; display: flex; align-items: center; font-weight: 500; font-size: 0.9rem; transition: var(--default-transition); text-decoration: none; }
        .sidebar .nav-link i { margin-right: 1rem; font-size: 1.25rem; }
        .sidebar .nav-link:hover { background-color: rgba(255, 255, 255, 0.1); color: var(--white); }
        .sidebar .nav-link.active { background-color: var(--white); color: var(--orange-dark); font-weight: 600; }
        .sidebar .user-profile .d-flex .fw-bold { font-size: 0.9rem; }
        .sidebar .user-profile .d-flex small { font-size: 0.8rem; }
        .sidebar .user-profile .d-flex img { width: 32px; height: 32px; margin-right: 0.75rem !important; }
        .sidebar .user-profile .nav-link.mt-2 { margin-top: 0.5rem !important; padding: 0.5rem 0.75rem; font-size: 0.9rem; margin-bottom: 0 !important; }
        .main-wrapper { transition: var(--default-transition); }
        @media (min-width: 992px) { .main-wrapper { margin-left: var(--sidebar-width); } .sidebar { transform: translateX(0); } }
        @media (max-width: 991.98px) { .sidebar { transform: translateX(-100%); } .sidebar.active { transform: translateX(0); box-shadow: 0 0 40px rgba(0,0,0,0.3); } }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); z-index: 1099; }
        .sidebar-overlay.active { display: block; }
        .main-content { padding: 2.5rem; }
        .page-header { margin-bottom: 0; position: sticky; top: 0; z-index: 1050; background-color: var(--bg-main); padding: 2.5rem; border-bottom: 1px solid var(--border-color); }
        .card-base { background-color: var(--white); border-radius: var(--default-border-radius); padding: 2rem; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.03), 0 2px 4px -2px rgb(0 0 0 / 0.03); transition: var(--default-transition); }
        .form-label { font-weight: 600; color: var(--dark-blue); }
        .form-control, .form-select { border-radius: 0.5rem; padding: 0.75rem 1rem; font-size: 0.95rem; border-color: #cbd5e1; }
        .form-control:focus, .form-select:focus { box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25); border-color: var(--orange); }
        .btn-orange { background-color: var(--orange); border-color: var(--orange); color: var(--white); font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 0.75rem; transition: var(--default-transition); }
        .btn-orange:hover { background-color: var(--orange-dark); border-color: var(--orange-dark); color: var(--white); }
        .img-preview { max-width: 200px; height: auto; border-radius: 0.75rem; border: 3px solid var(--border-color); margin-bottom: 1rem; }
        @media (max-width: 767.98px) {
            .main-content { padding: 1.5rem; }
            .page-header { padding: 1.5rem 1rem; }
            .card-base { padding: 1.5rem; }
            .btn-orange { width: 100%; padding: 0.65rem; }
        }
    </style>
</head>
<body>
    @php
        // Data Dummy untuk Tambah (semua null/kosong)
        class BeritaDummy { public $id = null; public $judul = null; public $kutipan = null; public $kategori_id = null; public $is_featured = false; public $published_at = null; public $gambar = null; public $isi_berita = null;}
        // Variabel $kategoris harus diisi dari controller
        class KategoriDummy { public $id; public $nama_kategori; public function __construct($id, $nama) { $this->id = $id; $this->nama_kategori = $nama; }}
        class AuthDummy { public function user() { return (object)['name' => 'Admin Utama']; }}

        $auth = new AuthDummy();
        $berita = new BeritaDummy(); // Inisiasi berita kosong
        $kategoris = collect([
            new KategoriDummy(1, 'Karir'), new KategoriDummy(2, 'Tips & Trik'), new KategoriDummy(3, 'Teknologi'),
        ]);
        
        // Kunci API TinyMCE (Ganti dengan kunci domain Anda)
        $tiny_api_key = 'hucfdotzsvymtyc12zjsg9id86z78xoxoekvo3whpn1fjcu5';
        // Note: Error handling for $errors has been removed in this final clean paste.
    @endphp
    
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <aside class="sidebar" id="sidebar">
        <div class="logo">JobRec</div>
        <nav class="nav flex-column"> 
            <a class="nav-link {{ Request::routeIs('admin.homepage') ? 'active' : '' }}" href="{{ route('admin.homepage') }}"><i class="bi bi-house-door-fill"></i> Home</a>
            
            <a class="nav-link {{ Request::routeIs('admin.pelamar.index') ? 'active' : '' }}" href="{{ route('admin.pelamar.index') }}"><i class="bi bi-people-fill"></i> Pelamar</a>
            
            @php
                // Tentukan apakah ada sub-menu Perusahaan yang aktif.
                $isPerusahaanActive = Request::routeIs('admin.perusahaan.*') || 
                                      Request::routeIs('admin.kandidat.index') || 
                                      Request::routeIs('admin.iklan.*');
            @endphp
            
            {{-- Tombol Toggler Utama: Perusahaan --}}
            <a class="nav-link {{ $isPerusahaanActive ? 'active' : '' }}" 
               data-bs-toggle="collapse" 
               href="#perusahaanSubmenu" 
               role="button" 
               aria-expanded="{{ $isPerusahaanActive ? 'true' : 'false' }}" 
               aria-controls="perusahaanSubmenu">
                 <i class="bi bi-building-fill"></i> Perusahaan
                 <i class="bi {{ $isPerusahaanActive ? 'bi-chevron-down' : 'bi-chevron-right' }} ms-auto" style="font-size: 0.8rem;"></i>
            </a>

            {{-- Konten Submenu --}}
            <div class="collapse {{ $isPerusahaanActive ? 'show' : '' }}" id="perusahaanSubmenu">
                <a class="nav-link ps-5 {{ Request::routeIs('admin.perusahaan.index') ? 'active' : '' }}" href="{{ route('admin.perusahaan.index') }}">
                    <i class="bi bi-diagram-3-fill"></i> List Perusahaan
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.kandidat.index') ? 'active' : '' }}" href="{{ route('admin.kandidat.index') }}">
                    <i class="bi bi-person-check-fill"></i> Kandidat
                </a>
                <a class="nav-link ps-5 {{ Request::routeIs('admin.iklan.*') ? 'active' : '' }}" href="{{ route('admin.iklan.index') }}">
                    <i class="bi bi-megaphone-fill"></i> Iklan Lowongan
                </a>
            </div>

            <a class="nav-link {{ Request::routeIs('admin.pelamar.ranking') ? 'active' : '' }}" href="{{ route('admin.pelamar.ranking') }}"><i class="bi bi-bar-chart-line-fill"></i> Auto-Ranking</a>
            
            {{-- Tautan Berita aktif di halaman ini --}}
            <a class="nav-link active" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>
            
            <a class="nav-link {{ Request::routeIs('admin.notifikasi.index') ? 'active' : '' }}" href="{{ route('admin.notifikasi.index') }}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
        </nav>
        <div class="user-profile">
            <div class="d-flex align-items-center text-white">
                <img src="https://placehold.co/40x40/ffffff/f97316?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="User">
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="opacity-75">Admin</small>
                </div>
            </div>
            <a class="nav-link mt-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
        </div>
    </aside>

    <main class="main-wrapper">
        
        {{-- Page Header --}}
        <div class="page-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-0 fw-bold">Tambah Berita <span style="color: var(--orange);">Baru</span></h2>
                <p class="text-secondary small mb-0">Masukkan detail konten berita yang akan dipublikasikan.</p>
            </div>
            <button class="btn btn-link d-lg-none" type="button" id="sidebar-toggler">
                <i class="bi bi-list fs-2" style="color: var(--dark-blue);"></i>
            </button>
        </div>

        <div class="main-content">
            
            {{-- Form Tambah Berita - Menggunakan route store --}}
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="card-base">
                    <h5 class="mb-4 fw-semibold border-bottom pb-3">Informasi Berita</h5>

                    <div class="row g-4">
                        {{-- Judul --}}
                        <div class="col-12">
                            <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required placeholder="Contoh: 5 Tips Sukses Melamar Pekerjaan">
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="col-md-6">
                            <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    {{-- Menggunakan $kategori->nama_kategori sesuai struktur yang ada --}}
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $berita->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Featured Checkbox --}}
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check form-check-inline pt-2">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $berita->is_featured ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label form-label" for="is_featured" style="font-weight: 500;">Jadikan Berita Unggulan (Featured)</label>
                            </div>
                        </div>
                        
                        {{-- Kutipan Singkat (Baru Ditambahkan) --}}
                        <div class="col-12">
                            <label for="kutipan" class="form-label">Kutipan Singkat <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('kutipan') is-invalid @enderror" id="kutipan" name="kutipan" rows="3" required>{{ old('kutipan', $berita->kutipan ?? '') }}</textarea>
                            <div class="form-text">Maksimal 255 karakter. Digunakan sebagai deskripsi singkat di halaman list.</div>
                            @error('kutipan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Gambar Utama --}}
                        <div class="col-12">
                            <label for="gambar" class="form-label">Gambar Utama <span class="text-danger">*</span></label>
                            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" required>
                            <div class="form-text">Pilih gambar sampul untuk berita. Max 2MB.</div>
                            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                        {{-- Isi Berita (WYSIWYG) - Nama field yang benar: isi_berita --}}
                        <div class="col-12">
                            <label for="isi_berita" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('isi_berita') is-invalid @enderror" id="isi_berita" name="isi_berita">{{ old('isi_berita', $berita->isi_berita ?? '') }}</textarea>
                            @error('isi_berita')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                        {{-- Status Publikasi --}}
                        <div class="col-12">
                            <label for="published_at" class="form-label">Tanggal Publikasi (Opsional)</label>
                            <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', $berita->published_at ?? '') }}">
                            <div class="form-text">Kosongkan untuk menyimpannya sebagai **Draft**. Isi untuk publikasi segera atau terjadwal.</div>
                            @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                    </div> {{-- end row g-4 --}}
                    
                    <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary me-3 px-4 rounded-3">Batal</a>
                        <button type="submit" class="btn btn-orange">
                            <i class="fas fa-plus-circle me-1"></i> Simpan Berita
                        </button>
                    </div>

                </div> {{-- end card-base --}}
            </form>
            
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- TinyMCE Script (Wajib untuk Isi Berita) --}}
    <script src="https://cdn.tiny.cloud/1/{{ $tiny_api_key }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        // === TINYMCE INITIATION (WYSIWYG Editor) ===
        tinymce.init({
            api_key: '{{ $tiny_api_key }}',
            selector: '#isi_berita',
            
            plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
            
            toolbar: [
                'undo redo | formatselect | fontfamily fontsize blocks',
                'bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
                'link image media table | anchor searchreplace | insertdatetime removeformat | code fullscreen help'
            ],
            
            menubar: true,
            height: 500,
            
            font_formats: 
                "Poppins=Poppins,sans-serif;Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;Alegreya Sans=Alegreya Sans, sans-serif;Tahoma=Tahoma, sans-serif;",
            table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
        });
        
        // === Mobile Sidebar Toggle Script ===
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggler = document.getElementById('sidebar-toggler');

            if (toggler) {
                toggler.addEventListener('click', () => {
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                });
            }
            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>