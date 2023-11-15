<div class="modal fade modal-crop-<?= $edit ? 'edit' : 'create' ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    <i class="fas fa-crop text-primary mr-1"></i>
                    Potong Gambar <span></span>
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
                <button type="button" class="btn btn-primary btn-crop crop">Potong</button>
            </div>
        </div>
    </div>
</div>