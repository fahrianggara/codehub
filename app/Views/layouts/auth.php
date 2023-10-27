<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "$title - CodeHUB" ?></title>

    <!-- CSS File -->
    <link rel="stylesheet" href="<?= base_url('plugins/bootstrap4/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/alertify/css/alerts.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/auth.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?= $this->renderSection('content') ?>

    <!-- JS File -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/bootstrap4/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('plugins/alertify/js/alerts.js') ?>"></script>
    <script src="<?= base_url('js/auth.js') ?>"></script>

    <?= $this->renderSection('js') ?>

</body>

</html>