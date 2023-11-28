<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>

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
                <h1>4<span>0</span>4</h1>
                <h2>Oh Tidak! Kamu Tersesat.</h2>
                <p>
                    Huhuhu.. halaman yang kamu cari tidak ditemukan:( mungkin halaman yang kamu cari sudah dihapus. 
                    Jika kamu merasa ini adalah kesalahan, silahkan hubungi kami.
                </p>
                <div class="action">
                    <a href="javascript:void(0);" class="btn" onclick="goBack('<?= base_url('/') ?>')">Kembali</a>
                    <a href="<?= base_url('/') ?>" class="btn">Beranda</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        var goBack = function goBack(fallback) {
            var useFallback = true;

            window.addEventListener("beforeunload", function() {
                useFallback = false;
            });

            window.history.back();

            setTimeout(function () {  
                if (useFallback) window.location.href = fallback;
            }, 100);
        }
    </script>
</body>

</html>