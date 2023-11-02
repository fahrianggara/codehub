<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "$title - CodeHUB" ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('plugins/bootstrap4/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/alertify/css/alerts.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/frontend.css') ?>">

    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
</head>

<body>
    <!-- Navbar -->
    <?= $this->include('layouts/frontend/navbar'); ?>

    <!-- Content -->
    <?= $this->renderSection('content'); ?>

    <!-- Footer -->
    <?= $this->include('layouts/frontend/footer'); ?>

    <!-- JS -->
    <script src="<?= base_url('plugins/bootstrap4/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('plugins/alertify/js/alerts.js') ?>"></script>
    <script src="<?= base_url('js/frontend.js') ?>"></script>
</body>

</html>