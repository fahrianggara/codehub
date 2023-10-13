<?= $this->extend('layouts/auth'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-6 col-xl-6">
            <form class="card" action="/register" method="post">
                <?php csrf_field(); ?>

                <div class="card-header">
                    <h4 class="m-0">Register</h4>
                </div>

                <div class="card-body">

                    <?php if (isset($validation)): ?>
                        <div class="alert alert-default-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">Nama Awalan</label>
                                <input type="text" class="form-control" id="first_name" placeholder="Masukkan nama awalan.."
                                    name="first_name" value="<?= old('first_name') ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Nama Akhiran</label>
                                <input type="text" class="form-control" id="last_name" placeholder="Masukkan nama akhiran.."
                                    name="last_name" value="<?= old('last_name') ?>">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan username.."
                            name="username" value="<?= old('username') ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" 
                            placeholder="Masukkan email kamu.." name="email" value="<?= old('email') ?>">
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Masukkan password.."
                                    name="password">
                            </div>
                        </div>

                        <div class="col-md-6 mb-0">
                            <label for="confirmpassword">Confirmation</label>
                            <input type="password" class="form-control" id="confirmpassword"
                                placeholder="Konfirmasi Password.." name="confirmpassword">
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mb-3">Register</button>
                    <p class="text-center mb-2">
                        Sudah punya akun? <a href="/login">Login</a>
                    </p>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>