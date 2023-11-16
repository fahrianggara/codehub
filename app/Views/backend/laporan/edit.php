<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-9 col-lg-12">

            <form id="formEditReport" action="<?= route_to('admin.laporan.update') ?>" class="card" autocomplete="off" method="post" enctype="multipart/form-data">

                <!-- Tambahkan CSRF Field -->
                <?= csrf_field() ?>

                <?php if (!empty($report)) : ?>
                    <input type="hidden" name="id" value="<?= $report->id ?>">

                    <div class="card-header p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="ml-2 py-1">Form Edit Laporan</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="message">Pesan</label>
                                <textarea name="message" id="message" class="form-control" placeholder="Masukkan Pesan Laporan"><?= $report->message ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_id">ID User</label>
                                <input type="text" name="user_id" id="user_id" class="form-control" value="<?= $report->user_id ?>" placeholder="Masukkan ID User" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="model_id">ID Model</label>
                                <input type="text" name="model_id" id="model_id" class="form-control" value="<?= $report->model_id ?>" placeholder="Masukkan ID Model">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="model_class">Class Model</label>
                                <input type="text" name="model_class" id="model_class" class="form-control" value="<?= $report->model_class ?>" placeholder="Masukkan Class Model">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="created_at">Laporan Dibuat</label>
                                <input type="text" name="created_at" id="created_at" class="form-control" value="<?= $report->created_at ?>" placeholder="Masukkan Tanggal Laporan Dibuat" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer p-2 ">
                        <div class="d-flex align-items-center">
                            <a href="<?= route_to('admin.laporan') ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-sm btn-warning ml-1">
                                Perbarui Laporan
                            </button>
                        </div>
                    </div>
                <?php else : ?>
                    <p>Laporan tidak ditemukan.</p>
                <?php endif; ?>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Tambahkan Script JavaScript sesuai kebutuhan -->
<script src="<?= base_url('path/to/your/script.js') ?>"></script>
<?= $this->endSection() ?>