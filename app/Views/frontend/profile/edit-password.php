<form id="formChangePassword" class="card" autocomplete="off">

    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="POST">

    <div class="card-header">Ganti Password</div>

    <div class="card-body">
        <div class="form-group">
            <label for="oldpass" required>Password Lama</label>
            <input type="password" name="oldpass" id="oldpass" class="form-control"
                placeholder="Masukkan password sekarang">
            <div class="d-flex align-items-center justify-content-between mt-1">
                <span class="invalid-feedback d-block error-text m-0 w-75" id="oldpass_error"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="newpass" required>Password Baru</label>
            <input type="password" name="newpass" id="newpass" class="form-control"
                placeholder="Masukkan password baru">
            <div class="d-flex align-items-center justify-content-between mt-1">
                <span class="invalid-feedback d-block error-text m-0 w-75" id="newpass_error"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="confpass" required>Konfirmasi</label>
            <input type="password" name="confpass" id="confpass" class="form-control"
                placeholder="Masukkan password baru lagi">
            <div class="d-flex align-items-center justify-content-between mt-1">
                <span class="invalid-feedback d-block error-text m-0 w-75" id="confpass_error"></span>
            </div>
        </div>
    </div>

    <div class="card-footer p-2">
        <button type="submit" class="btn btn-warning">
            Perbarui
        </button>
        <button type="button" class="btn btn-secondary" id="buttonShowPassword">
            <i class="fas fa-eye"></i>
        </button>
    </div>
</form>