<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>

    <link rel="apple-touch-icon" href="<?= base_url('favicon/apple-touch-icon.png') ?>" sizes="180x180">
    <link rel="icon" href="<?= base_url('favicon/favicon-32x32.png') ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?= base_url('favicon/favicon-16x16.png') ?>" sizes="16x16" type="image/png">
    <link rel="shortcut icon" href="<?= base_url('favicon/favicon.ico') ?>" type="image/x-icon">

    <!-- CSS File -->
    <link rel="stylesheet" href="<?= base_url('css/error.css') ?>">
</head>

<body>
    <section>
        <div class="container">
            <div class="content">
                <h1><span>5</span>00</h1>
                <h2>Hmm.. Apa yang terjadi?</h2>
                <p>
                    Tenang, ini bukan kesalahan kamu kok. So.. silahkan tunggu beberapa saat lagi 
                    atau refresh halaman ini. Dan jika masih sama, silahkan hubungi kami.
                </p>
                <div class="action">
                    <a href="javascript:void(0);" class="btn" onclick="window.location.reload();">
                        Refresh Halaman
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>