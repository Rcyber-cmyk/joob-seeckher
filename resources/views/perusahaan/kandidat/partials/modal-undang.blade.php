<div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="inviteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inviteModalLabel">Undang Kandidat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="inviteForm">
                    @csrf
                    <input type="hidden" name="pelamar_id" id="pelamarIdInput">
                    <p>Anda akan mengundang <strong id="pelamarName"></strong> untuk melamar pada posisi:</p>
                    
                    <div class="mb-3">
                        <label for="lowonganIdSelect" class="form-label">Pilih Lowongan Aktif</label>
                        <select class="form-select" name="lowongan_id" id="lowonganIdSelect" required>
                            <option value="" disabled selected>-- Pilih Posisi --</option>
                            @forelse ($lowonganAktif as $lowongan)
                                <option value="{{ $lowongan->id }}">{{ $lowongan->judul_lowongan }}</option>
                            @empty
                                <option value="" disabled>Anda tidak memiliki lowongan aktif</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pesanInput" class="form-label">Pesan (Opsional)</label>
                        <textarea class="form-control" name="pesan" id="pesanInput" rows="4" placeholder="Contoh: Halo, kami melihat profil Anda dan tertarik untuk mengundang Anda melamar..."></textarea>
                    </div>

                    <div class="alert" id="form-feedback" style="display: none;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="sendInviteBtn">Kirim Undangan</button>
            </div>
        </div>
    </div>
</div>
