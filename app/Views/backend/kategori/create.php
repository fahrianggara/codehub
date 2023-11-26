<?= $this->extend('layouts/backend') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-9 col-lg-12">
            <form id="formCreate" action="<?= route_to('admin.kategori.store') ?>" class="card" autocomplete="off" method="post" enctype="multipart/form-data">
                <input type="hidden" name="blob_cover">
                <input type="hidden" name="_method" value="POST">
                <?= csrf_field() ?>
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2 py-1">Form Tambah Kategori</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Nama Kategori</label>
                            <input type="text" name="name" id="name" class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>" value="<?= old('name') ?>" placeholder="Masukkan Nama Depan Pengguna">
                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('name') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="cover">Cover</label>
                            <div class="custom-file">
                                <input type="file" id="cover" name="cover" class="custom-file-input <?= validation_show_error('cover') ? 'is-invalid' : '' ?>">
                                <label class="custom-file-label" for="cover">Silahkan cari..</label>
                            </div>
                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('cover') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-2 ">
                    <div class="d-flex align-items-center">
                        <a href="<?= route_to('admin.kategori') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-sm btn-success ml-1">
                            Simpan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= view('component/modal-crop', ['edit' => false]) ?>
<script>
    $(document).ready(function() {
        var form = $('#formCreate');
        var cover = form.find('[name="cover"]');
        var modalCrop = $('.modal-crop-create');
        var btnCrop = modalCrop.find(".btn-crop"),
            sampleImage = modalCrop.find('.sample-image'),
            avatarCropper, bannerCropper;
        // Avatar Image
        cover.on('change', function(e) {
            handleImageChange(e, modalCrop, sampleImage, cover);
            avatarCropper = new Cropper(sampleImage[0], {
                aspectRatio: 16 / 9,
                viewMode: 1,
            });
            handleCropImage(modalCrop, btnCrop, avatarCropper, sampleImage, 'cover', {
                file: cover,
                blob: form.find('[name="blob_cover"]'),
                label: form.find('.custom-file-label[for="cover"]')
            });
        });
    });
</script>
<?= $this->endSection() ?>