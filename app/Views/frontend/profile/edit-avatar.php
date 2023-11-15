<div class="modal fade" id="modalEditAvatar" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    <i class="fas fa-crop text-primary mr-1"></i>
                    Potong Foto Profile
                </p>
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="img-container">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid sample-image">
                    </div>
                </div>
            </div>

            <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-crop">Potong & Simpan</button>
            </div>
        </div>
    </div>
</div>

<form id="formEditAvatar" action="#" method="POST">
    <input type="hidden" name="base64image">
    <input type="file" name="avatar" class="d-none file">
    <button type="submit" class="d-none"></button>
</form>