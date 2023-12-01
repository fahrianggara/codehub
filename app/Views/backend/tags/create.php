<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-6 col-lg-12">

            <form id="formCreate" action="<?= route_to('admin.Tags.store') ?>" class="card" autocomplete="off" method="post">

                <input type="hidden" name="_method" value="POST">
                <?= csrf_field() ?>

                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2 py-1">Form Tambah Tagar</span>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-12 mb-2">
                            <label for="name">Nama Tagar</label>

                            <input type="text" name="name" id="name" class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>" value="<?= old('name') ?>" placeholder="Masukkan Nama Tag">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('name') ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer p-2 ">
                    <div class="d-flex align-items-center">
                        <a href="<?= route_to('admin.Tags') ?>" class="btn btn-sm btn-primary">
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
