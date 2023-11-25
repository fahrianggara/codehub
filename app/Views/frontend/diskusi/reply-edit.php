<?= $this->section('js') ?>

<div class="modal fade modal-balasan-edit" role="dialog"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="POST" autocomplete="off" action="<?= route_to('diskusi.update') ?>">
            <?= csrf_field() ?>

            <input type="hidden" name="reply_id" id="id-edit-reply">

            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    <i class="fas fa-comment text-primary mr-1"></i>
                    Edit Balasan
                </p>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group mb-0">
                    <textarea name="content" class="form-control" rows="3" id="content-edit-reply"
                        placeholder="Masukkan konten diskusi.."></textarea>
                </div>
            </div>

            <div class="modal-footer p-1">
                <button type="submit" class="btn btn-warning">
                    Edit Balasan
                </button>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('js/fe/diskusi/reply-edit.js') ?>"></script>

<?= $this->endSection() ?>
