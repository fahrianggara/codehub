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
            <img src="<?= base_url('images/logo/lg.png') ?>" alt="CodeHUB Logo">
        </div>

        <div class="wrapper">
            <p class="wrapper-title">Masuk ke akun kamu</p>

            <form action="<?= base_url('login') ?>" class="wrapper-form" autocomplete="off" method="POST">
                <?= csrf_field(); ?>

                <div class="form-group input">
                    <div class="form-icon left"><i class="fas fa-user"></i></div>

                    <input type="text" class="form-control" name="username" id="username">

                    <label for="username">Username atau Email</label>
                </div>

                <div class="form-group input">
                    <div class="form-icon left"><i class="fas fa-lock"></i></div>

                    <input type="password" id="password" name="password" class="form-control password">

                    <label for="password">Password</label>

                    <div class="form-icon right" id="show-pass">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>

                <div class="form-group forgot">
                    <a href="#" class="forgot-password">
                        Lupa password?
                    </a>
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

<!-- =============================================== 
# JavaScript
=============================================== -->

<?= $this->section('js'); ?>

    <script>
        $(document).ready(function () {
            $('[type="password"]').on('input', function () {
                $('#show-pass').show(); // show eye icon
                if ($(this).val() === '') $('#show-pass').hide(); // hide eye icon
            });

            $("#show-pass").on('click', function() 
            {
                var input = $(".password");

                input.attr('type') === 'password'
                    ? input.attr('type','text') 
                    : input.attr('type','password');

                $(this).find('i').toggleClass("fa-eye fa-eye-slash");
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
            // Login form handler
            // ===============================================

            const form = $("form");
            const submit = form.find("button[type=submit]");

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
                        submit.html('Masuk');
                    },
                    success: function (res) {
                        if (res.status === 400) {
                            if (res.val === true) {
                                errors = [];

                                $.each(res.errors, function (key, val) {
                                    errors.push(val);
                                });

                                alertify.alert(errors.join("<br><br>"));
                            } else {
                                alertify.alert(res.message);
                            }

                            $(document).find(".alertify .msg").addClass("text-danger");
                        } else {
                            alertify.alert(res.message, function () {
                                location.href = res.redirect; // Redirect to profile page

                                submit.attr("disabled", "disabled");
                                submit.html("<i class='fas fa-spinner fa-spin'></i> Loading...");

                                form.trigger("reset");
                            });

                            $(document).find(".alertify .msg").addClass("text-success");
                        }
                    },
                    error: function (err) {
                        alert("Error: " + err.responseText);
                    }
                });
            });
        });
    </script>

<?= $this->endSection(); ?>