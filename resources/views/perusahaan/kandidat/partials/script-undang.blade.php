<script>
document.addEventListener('DOMContentLoaded', function () {
    const inviteModal = document.getElementById('inviteModal');
    if(inviteModal) {
        const inviteForm = document.getElementById('inviteForm');
        const sendInviteBtn = document.getElementById('sendInviteBtn');
        const feedbackDiv = document.getElementById('form-feedback');

        inviteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const pelamarId = button.getAttribute('data-pelamar-id');
            const pelamarName = button.getAttribute('data-pelamar-name');

            const modalTitle = inviteModal.querySelector('.modal-title');
            const pelamarNameEl = inviteModal.querySelector('#pelamarName');
            const pelamarIdInput = inviteModal.querySelector('#pelamarIdInput');

            modalTitle.textContent = 'Undang ' + pelamarName;
            pelamarNameEl.textContent = pelamarName;
            pelamarIdInput.value = pelamarId;
        });

        sendInviteBtn.addEventListener('click', function () {
            const pelamarId = document.getElementById('pelamarIdInput').value;
            const formData = new FormData(inviteForm);
            const actionUrl = `/perusahaan/kandidat/${pelamarId}/undang`;
            
            sendInviteBtn.disabled = true;
            sendInviteBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Mengirim...';
            feedbackDiv.style.display = 'none';

            fetch(actionUrl, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value, 'Accept': 'application/json' },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                feedbackDiv.style.display = 'block';
                if (data.success) {
                    feedbackDiv.className = 'alert alert-success';
                    feedbackDiv.textContent = data.message;
                    inviteForm.reset();
                    setTimeout(() => { bootstrap.Modal.getInstance(inviteModal).hide(); }, 2000);
                } else {
                    feedbackDiv.className = 'alert alert-danger';
                    feedbackDiv.textContent = data.message || 'Terjadi kesalahan.';
                }
            })
            .catch(error => {
                feedbackDiv.style.display = 'block';
                feedbackDiv.className = 'alert alert-danger';
                feedbackDiv.textContent = 'Terjadi kesalahan jaringan.';
                console.error('Error:', error);
            })
            .finally(() => {
                sendInviteBtn.disabled = false;
                sendInviteBtn.innerHTML = 'Kirim Undangan';
            });
        });
    }
});
</script>
