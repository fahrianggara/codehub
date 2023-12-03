<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "$title - Codehub" ?></title>

    <link rel="apple-touch-icon" href="<?= base_url('favicon/apple-touch-icon.png') ?>" sizes="180x180">
    <link rel="icon" href="<?= base_url('favicon/favicon-32x32.png') ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?= base_url('favicon/favicon-16x16.png') ?>" sizes="16x16" type="image/png">
    <link rel="shortcut icon" href="<?= base_url('favicon/favicon.ico') ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/alertify/css/alerts.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/bootstrap4/icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/cropperjs/cropper.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/backend.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/content.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/custom.css') ?>">
    <style>
        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 25px !important;
            margin-left: 3px !important;
        }

        .select2-container .select2-search--inline .select2-search__field {
            margin-left: 2px !important;
            margin-top: 6px !important;
            width: 100% !important;
        }
    </style>
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?= $this->include('component/flash-message') ?>

        <?= $this->include('layouts/backend/navbar') ?>

        <?= $this->include('layouts/backend/sidebar') ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h5 class="m-0"><?= $title ?></h5>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content mt-2">
                <?= $this->renderSection('content') ?>
            </section>
        </div>

        <?= $this->include('layouts/backend/footer') ?>
    </div>

    <?= $this->include('auth/logout'); ?>

    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/bootstrap4/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('plugins/tinymce5/jquery.tinymce.min.js') ?>"></script>
    <script src="<?= base_url('plugins/tinymce5/tinymce.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('plugins/datatables/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('plugins/alertify/js/alerts.js') ?>"></script>
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('plugins/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('plugins/moment/locale/id.js') ?>"></script>
    <script src="<?= base_url('plugins/cropperjs/cropper.js') ?>"></script>
    <script src="<?= base_url('plugins/prism/prism.js') ?>"></script>
    <script src="<?= base_url('js/backend.js') ?>"></script>
    <script src="<?= base_url('js/custom.js') ?>"></script>
    <?= $this->include('frontend/diskusi/create') ?>

    <?= $this->renderSection('js') ?>
</body>

</html>