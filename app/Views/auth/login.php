<?= $this->extend('layouts/auth'); ?>

<!-- =============================================== 
# Content
=============================================== -->

<?= $this->section('content'); ?>

    <?php
        $flashDataUsername = session()->getFlashdata('errUsername');
        $flashDataPassword = session()->getFlashdata('errPassword');
    ?>

    <section>
        <div class="brand">
            <a href="<?= base_url('/') ?>">
                <img src="<?= base_url('images/logo/sm.png') ?>" alt="logo">
                <span class="logo-text">codehub</span>
            </a>
        </div>

        <div class="wrapper">
            <p class="wrapper-title">Masuk ke akun kamu</p>

            <form id="login" action="<?= base_url('login') ?>" class="wrapper-form" autocomplete="off" method="POST">
                <?= csrf_field(); ?>

                <div class="form-group input">
                    <div class="form-icon left"><i class="fas fa-user"></i></div>

                    <input type="text" class="form-control" name="username" id="username">

                    <label class="font-weight-normal" for="username">Username atau Email</label>
                </div>

                <div class="form-group input">
                    <div class="form-icon left"><i class="fas fa-lock"></i></div>

                    <input type="password" id="password" name="password" class="form-control password">

                    <label class="font-weight-normal" for="password">Password</label>

                    <div class="form-icon right" id="show-pass">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-block">
                        Masuk
                    </button>
                </div>
            </form>
        </div>

        <div class="footer">
            <p>Belum punya akun? <a href="<?= base_url('register') ?>">Daftar</a></p>
        </div>
    </section>

<?= $this->endSection(); ?>