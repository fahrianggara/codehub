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

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        const formChangePassword = $('#formChangePassword');
        const buttonSubmit = formChangePassword.find('button[type=submit]');
        const buttonShowPassword = $('#buttonShowPassword');

        buttonShowPassword.click(function () {
            const inputFields = $('#oldpass, #newpass, #confpass');
            const icon = $(this).find('i');
            const isPasswordVisible = (inputFields.attr('type') === 'password');

            inputFields.attr('type', isPasswordVisible ? 'text' : 'password');
            icon.removeClass(isPasswordVisible ? 'fa-eye' : 'fa-eye-slash')
                .addClass(isPasswordVisible ? 'fa-eye-slash' : 'fa-eye');
        });

        $('a[data-toggle="tab"]:not(.active)').on('click', function() {
            formChangePassword.trigger('reset');
            formChangePassword.find('.form-control').removeClass('is-invalid').removeClass('is-valid');
            formChangePassword.find('span.error-text').text('');
        });

        formChangePassword.on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: `${origin}/edit-password`,
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function () {
                    buttonSubmit.attr('disabled', true);
                    buttonSubmit.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                    formChangePassword.find('span.error-text').text('');
                    formChangePassword.find('.form-control').removeClass('is-invalid');
                },
                success: function (res) {  
                    if (res.status === 400) {
                        if (res.val === true) {
                            $.each(res.message, function (key, value) {
                                $(`#${key}_error`).html(value);
                                $(`#${key}`).addClass('is-invalid');
                            });
                        } else {
                            alertify.alert(res.message);
                        }

                        $(document).find(".alertify .msg").addClass("text-danger");
                    } else {
                        alertify.alert(res.message, function () {
                            location.href = res.redirect ?? location.reload;
                        });

                        $(document).find(".alertify .msg").addClass("text-success");
                    }
                },
                complete: function () {
                    buttonSubmit.attr('disabled', false);
                    buttonSubmit.html('Perbarui');
                },
                error: function (err) {
                    alert(`Error: ${err.responseText}`);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>