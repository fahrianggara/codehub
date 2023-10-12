<?= $this->extend('layouts/auth'); ?>

<?= $this->section('content'); ?>

<?php 
    $flashDataUsername = session()->getFlashdata('errUsername');
    $flashDataPassword = session()->getFlashdata('errPassword');
?>

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5 col-lg-5 col-xl-5">
            <form class="card" action="/login" method="post">
                <?= csrf_field(); ?>

                <div class="card-header">
                    <h4 class="m-0">Login</h4>
                </div>

                <div class="card-body">

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-default-success" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="username">Username</label>

                        <input type="text" class="form-control <?= $flashDataUsername ? 'is-invalid' : '' ?>" 
                            id="username" placeholder="Masukkan username.." 
                            name="username" value="<?= old('username') ?>">

                        <?php if ($flashDataUsername): ?>
                            <div class="invalid-feedback"><?= $flashDataUsername ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-0">
                        <label for="password">Password</label>

                        <input type="password" class="form-control <?= $flashDataPassword ? 'is-invalid' : '' ?>" 
                            id="password" placeholder="Masukkan password.." name="password">

                        <?php if ($flashDataPassword): ?>
                            <div class="invalid-feedback"><?= $flashDataPassword ?></div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mb-3">Login</button>
                    <p class="text-center mb-2">Belum punya akun? <a href="/register">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>