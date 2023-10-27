<?= $this->extend('layouts/auth'); ?>

<!-- =============================================== 
# Content
=============================================== -->

<?= $this->section('content'); ?>

    <section>
        <div class="brand">
            <img src="<?= base_url('images/logo/lg.png') ?>" alt="CodeHUB Logo">
        </div>

        <div class="wrapper">
            <p class="wrapper-title">Daftar ke CodeHUB</p>

            <form action="<?= base_url('register') ?>" class="wrapper-form" autocomplete="off" method="POST">
                <?= csrf_field(); ?>
                
                <div class="form-group input">
                    <div class="form-icon left">
                        <i class="fas fa-envelope"></i>
                    </div>

                    <input type="email" id="email" class="form-control" name="email">

                    <label for="email">Email</label>
                </div>

                <div class="form-group input">
                    <div class="form-icon left">
                        <i class="fas fa-lock"></i>
                    </div>

                    <input type="password" id="password" class="form-control password">

                    <label for="password">Password</label>

                    <div class="form-icon right" id="show-pass">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>

                <div class="form-group input">
                    <div class="form-icon left">
                        <i class="fas fa-lock"></i>
                    </div>

                    <input type="password" id="c-password" class="form-control">

                    <label for="c-password">Konfirmasi</label>
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

<!-- =============================================== 
# JavaScript
=============================================== -->

<?= $this->section('js'); ?>

    <script>
        $(document).ready(function () {
            $('.form-control:not([type="email"])').on('input', function () {
                $('#show-pass').show(); // show eye icon
    
                var password = $('#password').val();
                var cPassword = $('#c-password').val();
    
                if (password === '' && cPassword === '') $('#show-pass').hide();
            });
            
            $('#show-pass').click(function () {
                var inputFields = $('#password, #c-password');
                var isPasswordVisible = (inputFields.attr('type') === 'password');
    
                inputFields.attr('type', isPasswordVisible ? 'text' : 'password');
    
                $(this).find('i')
                    .removeClass(isPasswordVisible ? 'fa-eye' : 'fa-eye-slash')
                    .addClass(isPasswordVisible ? 'fa-eye-slash' : 'fa-eye');
            });
    
            $(document).ready(function () {
                $('.form-control').on('focus', function () {
                    $(this).parent().find('label').addClass('active');
                });
    
                $('.form-control').on('blur', function () {
                    if ($(this).val() === '') $(this).parent().find('label').removeClass('active');
                });
            });

            // ===============================================
            // Register form handler
            // ===============================================

            const form = $('form');
            const submit = form.find('button[type="submit"]');

            form.on("submit", function (e) {
                e.preventDefault();

                $.ajax({
                    type: $(this).attr("method"),
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function () {
                        submit.attr("disabled", "disabled");
                        submit.html("<i class='fas fa-spinner fa-spin'></i> Loading...");
                    },
                    complete: function () {
                        submit.removeAttr("disabled");
                        submit.html('Daftar');
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
                                window.location.href = res.redirect;

                                submit.attr("disabled", "disabled");
                                submit.html("<i class='fas fa-spinner fa-spin'></i> Loading...");

                                form.trigger("reset");
                            });
                            $(document).find(".alertify .msg").addClass("text-success");
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });
        });
    </script>

<?= $this->endSection(); ?>