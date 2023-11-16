<?= $this->extend('layouts/auth'); ?>

<!-- =============================================== 
# Content
=============================================== -->

<?= $this->section('content'); ?>

    <section>
        <div class="brand">
            <a href="<?= base_url('/') ?>">
                <img src="<?= base_url('images/logo/sm.png') ?>" alt="logo">
                <span class="logo-text d-none d-lg-block">codehub</span>
            </a>
        </div>

        <div class="wrapper">
            <p class="wrapper-title">Daftar ke CODEHUB</p>

            <form id="register" action="<?= base_url('register') ?>" class="wrapper-form" 
                autocomplete="off" method="POST">
                <?= csrf_field(); ?>
                
                <div class="form-group input">
                    <div class="form-icon left">
                        <i class="fas fa-envelope"></i>
                    </div>

                    <input type="email" id="email" class="form-control" name="email">

                    <label class="font-weight-normal" for="email">Email</label>
                </div>

                <div class="form-group input">
                    <div class="form-icon left">
                        <i class="fas fa-lock"></i>
                    </div>

                    <input type="password" id="password" class="form-control password" name="password">

                    <label class="font-weight-normal" for="password">Password</label>

                    <div class="form-icon right" id="show-pass">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>

                <div class="form-group input">
                    <div class="form-icon left">
                        <i class="fas fa-lock"></i>
                    </div>

                    <input type="password" id="c-password" class="form-control" name="c-password">

                    <label class="font-weight-normal" for="c-password">Konfirmasi</label>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-block">
                        daftar
                    </button>
                </div>
            </form>
        </div>

        <div class="footer">
            <p>Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk</a></p>
        </div>
    </section>

<?= $this->endSection(); ?>