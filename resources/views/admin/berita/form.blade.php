@section('styles')
    {{-- Anda mungkin perlu CSS kustom untuk editor WYSIWYG di sini --}}
@endsection

<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Konten</h6>
            </div>
            <div class="card-body">
                {{-- Judul Berita --}}
                <div class="form-group">
                    <label for="judul" class="font-weight-bold">Judul Berita</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required>
                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Kategori --}}
                <div class="form-group">
                    <label for="kategori_id" class="font-weight-bold">Kategori</label>
                    <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $cat)
                            <option value="{{ $cat->id }}" {{ old('kategori_id', $berita->kategori_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Kutipan (Excerpt) --}}
                <div class="form-group">
                    <label for="kutipan" class="font-weight-bold">Kutipan Singkat (Maks 2-3 baris)</label>
                    <textarea class="form-control @error('kutipan') is-invalid @enderror" id="kutipan" name="kutipan" rows="3" required>{{ old('kutipan', $berita->kutipan ?? '') }}</textarea>
                    @error('kutipan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Isi Berita (WYSIWYG Editor) --}}
                <div class="form-group">
                    <label for="isi_berita" class="font-weight-bold">Isi Berita Lengkap</label>
                    {{-- ID isi_berita digunakan oleh TinyMCE/CKEditor --}}
                    <textarea class="form-control @error('isi_berita') is-invalid @enderror" id="isi_berita" name="isi_berita" rows="10" required>{{ old('isi_berita', $berita->isi_berita ?? '') }}</textarea>
                    @error('isi_berita') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengaturan Publikasi & Media</h6>
            </div>
            <div class="card-body">
                
                {{-- Gambar Utama --}}
                <div class="form-group">
                    <label for="gambar" class="font-weight-bold">Gambar Utama</label>
                    <input class="form-control-file @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar">
                    @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if($berita->gambar && $berita->exists)
                        <small class="text-muted d-block mt-2">Gambar saat ini:</small>
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="img-fluid rounded mt-2" style="max-width: 100%; height: auto;">
                    @endif
                </div>

                <hr class="my-4">

                {{-- Featured --}}
                <div class="form-group form-check">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $berita->is_featured ?? 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label font-weight-bold" for="is_featured">
                        Jadikan Berita Utama (Featured)
                    </label>
                </div>

                {{-- Jadwal Publikasi --}}
                <div class="form-group">
                    <label for="published_at" class="font-weight-bold">Jadwal Terbit</label>
                    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', isset($berita) && $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->format('Y-m-d\TH:i') : '') }}">
                    <small class="form-text text-muted">Kosongkan jika ingin simpan sebagai Draft.</small>
                    @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                @if(!$berita->published_at)
                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" id="publish_now" name="publish_now" value="1" {{ old('publish_now') ? 'checked' : '' }}>
                        <label class="form-check-label font-weight-bold text-success" for="publish_now">
                            Publikasi Sekarang
                        </label>
                    </div>
                @endif
                
                <button type="submit" class="btn btn-primary w-100 mt-3 shadow-sm">
                    <i class="fas fa-save mr-1"></i> {{ $berita->exists ? 'Update Berita' : 'Simpan Berita' }}
                </button>
            </div>
        </div>
    </div>
</div>