<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VRSXCYJEJC"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-VRSXCYJEJC');
    </script>
    
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="ID">
    <meta name="og:locale" content="id_ID">
    <?= $this->renderSection('meta') ?>
    <title><?= "$title - Codehub" ?></title>

    <!-- Title -->
    <link rel="apple-touch-icon" href="<?= base_url('favicon/apple-touch-icon.png') ?>" sizes="180x180">
    <link rel="icon" href="<?= base_url('favicon/favicon-32x32.png') ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?= base_url('favicon/favicon-16x16.png') ?>" sizes="16x16" type="image/png">
    <link rel="shortcut icon" href="<?= base_url('favicon/favicon.ico') ?>" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('plugins/bootstrap4/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/bootstrap4/icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/alertify/css/alerts.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/cropperjs/cropper.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/content.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/frontend.css') ?>">

    <?= $this->renderSection('css'); ?>
</head>

<body>
    <!-- Loader -->
    <div class="loader-overlay">
        <div class="loader-container">
            <div class="loader"></div>
            <span class="loader-text"></span>
        </div>
    </div>

    <!-- Popup Share -->
    <?= $this->include('component/popup-share') ?>
    
    <!-- alert flash message -->
    <?= $this->include('component/alertify-message') ?>

    <!-- Navbar -->
    <?= $this->include('layouts/frontend/navbar'); ?>

    <!-- Content -->
    <?= $this->renderSection('content'); ?>

    <!-- Footer -->
    <?= $this->include('layouts/frontend/footer'); ?>

    <?php if (auth_check()) : ?>
        <?= $this->include('auth/logout'); ?>
    <?php endif; ?>

    <!-- JS -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/bootstrap4/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('plugins/tinymce5/jquery.tinymce.min.js') ?>"></script>
    <script src="<?= base_url('plugins/tinymce5/tinymce.min.js') ?>"></script>
    <script src="<?= base_url('plugins/alertify/js/alerts.js') ?>"></script>
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('plugins/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('plugins/moment/locale/id.js') ?>"></script>
    <script src="<?= base_url('plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <script src="<?= base_url('plugins/cropperjs/cropper.js') ?>"></script>
    <script src="<?= base_url('plugins/cropperjs/gif/cropperjs-gif-all.js') ?>"></script>
    <script src="<?= base_url('plugins/prism/prism.js') ?>"></script>
    <script src="<?= base_url('js/frontend.js') ?>"></script>
    <script src="<?= base_url('js/custom.js') ?>"></script>

    <script src="<?= base_url('js/fe/diskusi/like.js') ?>"></script>
    <?= $this->include('frontend/diskusi/create') ?>

    <!-- Render Js -->
    <?= $this->renderSection('js'); ?>
</body>

</html>