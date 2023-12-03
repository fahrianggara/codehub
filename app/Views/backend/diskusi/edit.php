<?= $this->section('js') ?>

<div class="modal fade modal-diskusi-edit" role="dialog"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="POST" autocomplete="off" action="<?= route_to('diskusi.update') ?>">
            <?= csrf_field() ?>

            <input type="hidden" name="id" id="id-edit">

            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    <i class="fas fa-comment text-primary mr-1"></i>
                    Diskusi Edit
                </p>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <?php if ($detail): ?>
                    <input type="hidden" name="title" id="title-edit">    
                <?php else: ?>
                    <div class="form-group mb-2">
                        <input type="text" name="title" class="form-control text-dark" id="title-edit"
                            placeholder="Judul diskusi">
                    </div>
                <?php endif; ?>

                <div class="form-group mb-2">
                    <select name="category_id" class="form-control" 
                        placeholder="Pilih Kategori Diskusi" id="category-edit">
                    </select>
                </div>
                <div class="form-group mb-2">
                    <select multiple="multiple" name="tag_ids[]" class="form-control" 
                        placeholder="Pilih Tagar Diskusi" id="tags-edit">
                    </select>
                </div>

                <div class="form-group mb-0">
                    <textarea name="content" class="form-control" rows="3" id="content-edit"
                        placeholder="Masukkan konten diskusi.."></textarea>
                </div>
            </div>

            <div class="modal-footer p-1">
                <button type="submit" class="btn btn-warning">
                    Edit Diskusi
                </button>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('js/fe/diskusi/edit.js') ?>"></script>

<?= $this->endSection() ?>
