<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-9 col-lg-12">

            <form id="formCreate" action="<?= route_to('admin.pengguna.store') ?>" class="card" 
                autocomplete="off" method="post" enctype="multipart/form-data">

                <input type="hidden" name="blob_avatar">
                <input type="hidden" name="blob_banner">
                <input type="hidden" name="_method" value="POST">
                <?= csrf_field() ?>

                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2 py-1">Form Tambah Pengguna</span>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="first_name">Nama Depan</label>

                            <input type="text" name="first_name" id="first_name" 
                                class="form-control <?= validation_show_error('first_name') ? 'is-invalid' : '' ?>"
                                value="<?= old('first_name') ?>" placeholder="Masukkan Nama Depan Pengguna">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('first_name') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="last_name">Nama Belakang</label>

                            <input type="text" name="last_name" id="last_name" 
                                class="form-control <?= validation_show_error('last_name') ? 'is-invalid' : '' ?>" 
                                value="<?= old('last_name') ?>" placeholder="Masukkan Nama Belakang Pengguna">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('last_name') ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="username" required>Username</label>

                            <input type="text" name="username" id="username" 
                                class="form-control text-lowercase <?= validation_show_error('username') ? 'is-invalid' : '' ?>" 
                                value="<?= old('username') ?>" placeholder="Masukkan Username Pengguna">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('username') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" required>Email</label>

                            <input type="email" name="email" id="email" 
                                class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>"   
                                value="<?= old('email') ?>" placeholder="Masukkan Alamat Email Pengguna">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('email') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="role">Peran</label>
                            <select class="custom-select" name="role" id="role">
                                <option <?= selected_option(old('role'), 'admin') ?> value="admin">Admin</option>
                                <option <?= selected_option(old('role'), 'user') ?> value="user">User</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password" required>Kata Sandi</label>

                            <input type="password" name="password" id="password" 
                                class="form-control <?= validation_show_error('password') ? 'is-invalid' : '' ?>"
                                placeholder="Masukkan Kata Sandi Pengguna">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('password') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="avatar">Avatar</label>
                            <div class="custom-file">
                                <input type="file" id="avatar" name="avatar" 
                                    class="custom-file-input <?= validation_show_error('avatar') ? 'is-invalid' : '' ?>">
                                <label class="custom-file-label" for="avatar">Silahkan cari..</label>
                            </div>
                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('avatar') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="banner">Sampul</label>
                            <div class="custom-file">
                                <input type="file" id="banner" name="banner" 
                                    class="custom-file-input <?= validation_show_error('banner') ? 'is-invalid' : '' ?>">
                                <label class="custom-file-label" for="banner">Silahkan cari..</label>
                            </div>
                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('banner') ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-2 ">
                    <div class="d-flex align-items-center">
                        <a href="<?= route_to('admin.pengguna') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-sm btn-success ml-1">
                            Simpan Data
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

    <?= view('component/modal-crop', ['edit' => false]) ?>
    <script src="<?= base_url('js/be/pengguna/create.js') ?>"></script>

<?= $this->endSection() ?>
