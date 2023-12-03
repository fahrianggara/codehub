<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <a href="<?= route_to('admin.pengguna') ?>" class="small-box">
                <div class="inner">
                    <h3><?= $pengguna_count ?></h3>

                    <p>Pengguna</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-users"></i>
                </div>
                <span class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></span>
            </a>
        </div>

        <div class="col-lg-4 col-md-6">
            <a href="<?= route_to('admin.kategori') ?>" class="small-box">
                <div class="inner">
                    <h3><?= $kategori_count ?></h3>

                    <p>Kategori Diskusi</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-bookmark"></i>
                </div>
                <span class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></span>
            </a>
        </div>

        <div class="col-lg-4 col-md-6">
            <a href="<?= route_to('admin.Tags') ?>" class="small-box">
                <div class="inner">
                    <h3><?= $tag_count ?></h3>

                    <p>Tagar Diskusi</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-tags"></i>
                </div>
                <span class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></span>
            </a>
        </div>

        <div class="col-lg-4 col-md-6">
            <a href="<?= route_to('admin.laporan') ?>" class="small-box">
                <div class="inner">
                    <h3><?= $laporan_count ?></h3>

                    <p>Laporan Diskusi</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-file-alt"></i>
                </div>
                <span class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></span>
            </a>
        </div>

        <div class="col-lg-4 col-md-6">
            <a href="<?= route_to('admin.diskusi') ?>" class="small-box">
                <div class="inner">
                    <h3><?= $diskusi_count ?></h3>

                    <p>Diskusi</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-comments"></i>
                </div>
                <span class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></span>
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>