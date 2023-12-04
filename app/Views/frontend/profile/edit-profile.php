<div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form action="#" class="modal-content" autocomplete="off" method="POST">
            <?= csrf_field(); ?>

            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    Edit Profile
                </p>
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="first_name">Nama Depan</label>

                            <input type="text" class="form-control" id="first_name" placeholder="Masukkan nama depan"
                                name="first_name" value="<?= $user->first_name; ?>">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span class="invalid-feedback d-block error-text m-0 w-75" id="first_name_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Nama Belakang</label>

                            <input type="text" class="form-control" id="last_name" placeholder="Masukkan nama belakang"
                                name="last_name" value="<?= $user->last_name; ?>">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span class="invalid-feedback d-block error-text m-0 w-75" id="last_name_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" required>Username</label>

                            <input type="text" class="form-control text-lowercase" id="username" placeholder="Masukkan username"
                                name="username" value="<?= $user->username; ?>">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span class="invalid-feedback d-block error-text m-0 w-75" id="username_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>

                            <input type="text" class="form-control" placeholder="Masukkan email"
                                value="<?= $user->email; ?>" disabled readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="link_fb">Facebook</label>

                            <input type="url" class="form-control" id="link_fb" placeholder="Link facebook kamu"
                                name="link_fb" value="<?= $user->link_fb; ?>">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span class="invalid-feedback d-block error-text m-0 w-75" id="link_fb_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link_tw">Twitter</label>

                            <input type="url" class="form-control" id="link_tw" placeholder="Link twitter kamu"
                                name="link_tw" value="<?= $user->link_tw; ?>">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span class="invalid-feedback d-block error-text m-0 w-75" id="link_tw_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link_ig">Instagram</label>

                            <input type="url" class="form-control" id="link_ig" placeholder="Link instagram kamu"
                                name="link_ig" value="<?= $user->link_ig; ?>">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span class="invalid-feedback d-block error-text m-0 w-75" id="link_ig_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link_gh">Github</label>

                            <input type="url" class="form-control" id="link_gh" placeholder="Link github kamu"
                                name="link_gh" value="<?= $user->link_gh; ?>">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span class="invalid-feedback d-block error-text m-0 w-75" id="link_gh_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link_li">LinkedIn</label>

                            <input type="url" class="form-control" id="link_li" placeholder="Link linkedin kamu"
                                name="link_li" value="<?= $user->link_li; ?>">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span class="invalid-feedback d-block error-text m-0 w-75" id="link_li_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>
        </form>
    </div>
</div>