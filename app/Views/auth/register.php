<?= $this->extend('layouts/auth'); ?>

<?= $this->section('content'); ?>

<!-- <div class="logo">
    <img src="<?= base_url('images/logo/codehub.png') ?>" alt="Logo">
</div> -->

<div class="wrapper">
    <form id="form-register" action="<?= base_url('register') ?>" method="POST">
        <?= csrf_field(); ?>

        <div class="header">
            <h1>Register</h1>
        </div>

        <div class="input-box">
            <input type="text" placeholder="Masukan email" name="email">
            <i class="bi bi-envelope-fill"></i>
        </div>

        <div class="input-box">
            <input type="password" id="password" placeholder="Masukan password" name="password">
            <i class="bi bi-lock-fill"></i>

            <div class="hide-pw">
                <span id="show-password" class="show-password">
                    <i class="bi bi-eye-slash"></i></span>
            </div>
        </div>

        <div class="input-box">
            <input type="password" id="konfirm-pass" placeholder="Konfirmasi password" name="confirmpass">
            <i class="bi bi-lock-fill"></i>
        </div>

        <button type="submit" class="button">Submit</button>

        <div class="register-link">
            <p>Sudah punya akun? <a href="/login">Login</a></p>
        </div>

    </form>

</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>
    $(document).ready(function () {
        const form = $('#form-register');
        const submit = form.find('button[type="submit"]');

        // ajax register
        form.on("submit", function (e) {
            e.preventDefault();

            $.ajax({
                type: $(this).attr("method"),
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function () {
                    submit.attr("disabled", "disabled");
                    submit.html('Loading..');
                },
                complete: function () {
                    submit.removeAttr("disabled");
                    submit.html('Submit');
                },
                success: function (res) {
                    if (res.status === 400) {
                        errors = [];

                        $.each(res.error, function (key, val) {
                            errors.push(val);
                        });

                        alertify.alert(errors.join("<br><br>"));
                        $(document).find(".alertify .msg").addClass("text-danger");
                    } else {
                        alertify.alert(res.message, function () {
                            window.location.href = "/login";
                        });
                        $(document).find(".alertify .msg").addClass("text-success");
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        // Show password
        $('#show-password').click(function () {
            var inputFields = $('#password, #konfirm-pass');
            var icon = $(this).find('i');
            var isPasswordVisible = (inputFields.attr('type') === 'password');

            inputFields.attr('type', isPasswordVisible ? 'text' : 'password');
            icon.removeClass(isPasswordVisible ? 'bi-eye-slash' : 'bi-eye')
                .addClass(isPasswordVisible ? 'bi-eye' : 'bi-eye-slash');
        });
    });
</script>


<?= $this->endSection(); ?>