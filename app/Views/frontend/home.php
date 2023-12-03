<?= $this->extend('layouts/frontend') ?>

<?= $this->section('meta') ?>

<meta name="robots" content="index, follow">
<meta name="title" content="Codehub">
<meta name="description" content="<?= "Adalah website keren buat bantuin para developer awam/lanjut untuk menambah keahlian di dunia pemrograman dengan tukeran informasi, kolaborasi, dan belajar tentang dunia IT seperti Pemrograman." ?>">
<meta name="author" content="Codehub">
<meta name="keywords" content="codehub,forum,diskusi">
<meta property="og:type" content="website">
<meta property="og:title" content="Codehub">
<meta property="og:description" content="<?= "Adalah website keren buat bantuin para developer awam/lanjut untuk menambah keahlian di dunia pemrograman dengan tukeran informasi, kolaborasi, dan belajar tentang dunia IT seperti Pemrograman." ?>">
<meta property="og:url" content="<?= base_url("/") ?>">
<meta property="og:image" content="<?= base_url('images/og.png') ?>">
<meta property="og:site_name" content="Codehub">
<link rel="canonical" href="<?= base_url("/") ?>">

<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<section class="homepage first" id="homepage">
    <div class="thread container-fluid">
        <!-- row container -->
        <div class="row">

            <div class="col-lg-3 col-md-12 mb-3 order-lg-1 order-3">
                <!-- barisn kiri -->
                <div class="sticky">
                    <div class="thread-header mb-3 list-group-item">
                        3 Kategori Teratas
                    </div>

                    <ul class="list-group mb-3">
                        <?php if ($categories): ?>
                            <?php foreach ($categories as $category) : ?>
                                <li class="thread-most-item list-group-item d-flex align-items-center">
                                    <a href="<?= route_to("kategori.show", $category->slug) ?>">
                                        <img class="mr-2" src="<?= $category->photo ?>">
                                        <div class="text-content">
                                            <span class="name"><?= $category->name; ?></span>
                                            <span class="thread-count"><?= count($category->getThreads()) ?> Diskusi Digunakan</span>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <small>Silahkan membuat diskusi terlebih dahulu.</small>
                            </div>
                        <?php endif ?>
                    </ul>

                    <div class="thread-header mb-3 list-group-item">
                        3 Pengguna Teratas
                    </div>

                    <ul class="list-group">
                        <?php if ($TopUsers): ?>
                            <?php foreach ($TopUsers as $topUser) : ?>
                                <li class="thread-most-item list-group-item d-flex align-items-center">
                                    <a href="javascript:void(0)" class="">
                                        <img class="mr-2 rounded-circle" src="<?= $topUser->photo ?>">
                                        <div class="text-content">
                                            <a href="<?= base_url("{$topUser->username}") ?>">
                                                <span class="name"><?= $topUser->username ?></span>
                                            </a>
                                            <span class="thread-count">
                                                <?= number_short(count($topUser->threads)) ?> Diskusi, 
                                                <?= $topUser->count_liked ?> Disukai
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <small>Belum ada pengguna yang terdaftar.</small>
                            </div>
                        <?php endif ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-3 order-lg-2 order-1">
                <!-- baris tengah -->
                <div class="most-liked">
                    <div class="thread-header main mb-3 list-group-item d-flex justify-content-between align-items-center">
                        <div class="most-title">Diskusi <span>Baru</span></div>
                        <img class="logo-most" src="<?= base_url('images/logo/sm.png') ?>">
                    </div>

                    <?= view('frontend/home/diskusi.php') ?> <!-- view diskusi -->
                </div>
            </div>

            <div class="col-lg-3 col-md-12 mb-3 order-lg-3 order-2">
                <!-- baris kanan -->
                <div class="sticky">
                    <div class="thread-header mb-3 list-group-item">
                        3 Diskusi Teratas
                    </div>

                    <?= view('frontend/home/top-diskusi.php') ?> <!-- view top diskusi -->
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('js') ?>

<button class="btn-buat-diskusi fixed" type="button" data-logined="<?= auth_check() ?>">
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""> <g><path d="M12.75 20a.75.75 0 0 1-.75.75 11.843 11.843 0 0 1-3.394-.48 7.225 7.225 0 0 1-4.749 1.48c-.144 0-.286 0-.423-.007a1.228 1.228 0 0 1-.749-2.162 4.124 4.124 0 0 0 1.455-2.155A8.3 8.3 0 0 1 2.25 12c0-5.151 4.01-8.75 9.75-8.75 5.272 0 9.165 3.081 9.686 7.667A8.878 8.878 0 0 1 21.75 12a.75.75 0 0 1-1.5 0 7.425 7.425 0 0 0-.05-.9c-.435-3.8-3.728-6.35-8.2-6.35-4.857 0-8.25 2.982-8.25 7.25a6.787 6.787 0 0 0 1.75 4.7.749.749 0 0 1 .19.625 5.391 5.391 0 0 1-1.507 2.914 5.326 5.326 0 0 0 3.68-1.329.748.748 0 0 1 .792-.2 10.208 10.208 0 0 0 3.345.543.75.75 0 0 1 .75.747zM21 16.75h-1.75V15a.75.75 0 0 0-1.5 0v1.75H16a.75.75 0 0 0 0 1.5h1.75V20a.75.75 0 0 0 1.5 0v-1.75H21a.75.75 0 0 0 0-1.5zM12.02 11h-.01a1.005 1.005 0 1 0 .01 0zm4 2a1 1 0 0 0 0-2h-.01a1 1 0 0 0 .01 2zm-8.01-2a1.005 1.005 0 1 0 .01 0z" opacity="1" class=""></path></g></svg>
</button>

<?= view('frontend/diskusi/reply-modal', ['view_thread' => true]) ?>
<?= view('frontend/diskusi/laporan') ?>

<?php if (auth_check()) : ?>
    <?= view('frontend/diskusi/edit', ['detail' => false]) ?>
    <script src="<?= base_url('js/fe/diskusi/delete.js') ?>"></script>
<?php endif ?>

<script src="<?= base_url('js/fe/diskusi/create.js') ?>"></script>

<?= $this->endSection() ?>