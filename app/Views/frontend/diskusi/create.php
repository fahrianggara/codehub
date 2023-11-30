<?= $this->section('js') ?>

<div class="modal fade modal-diskusi-create" role="dialog"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="POST" autocomplete="off" action="<?= route_to('diskusi.store') ?>">
            <?= csrf_field() ?>

            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    <i class="fas fa-comment text-primary mr-1"></i>
                    Diskusi Baru
                </p>
                <button type="button" class="btn btn-primary modal-close-create">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group mb-2">
                    <input type="text" name="title" class="form-control text-dark" id="title-create"
                        placeholder="Judul diskusi">
                </div>
                <div class="form-group mb-2">
                    <select name="category_id" class="form-control" 
                        placeholder="Pilih Kategori Diskusi" id="category-create">
                    </select>
                </div>
                <div class="form-group mb-2">
                    <select multiple="multiple" name="tag_ids[]" class="form-control" 
                        placeholder="Pilih Tagar Diskusi" id="tags-create">
                    </select>
                </div>
                <div class="form-group mb-0">
                    <textarea name="content" class="form-control" rows="3" id="content-create"
                        placeholder="Masukkan konten diskusi.."></textarea>
                </div>
            </div>

            <div class="modal-footer p-1">
                <button type="submit" class="btn btn-success">
                    Buat Diskusi
                </button>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('js/fe/diskusi/create.js') ?>"></script>

<?= $this->endSection() ?>
