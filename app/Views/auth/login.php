<?= $this->extend('layouts/auth'); ?>

<?= $this->section('content'); ?>

<?php
    $flashDataUsername = session()->getFlashdata('errUsername');
    $flashDataPassword = session()->getFlashdata('errPassword');
?>

<!-- <div class="logo">
    <img src="<?= base_url('images/logo/codehub.png') ?>" alt="Logo">
</div> -->

<div class="wrapper">

    <form action="">
        <div class="header">
            <h1>Login</h1>
        </div>

        <div class="input-box">
            <input type="text" class="" placeholder="Username atau Email"
                name="username" id="username" value="<?= old('username'); ?>">
            <i class="bi bi-person-fill"></i>
        </div>

        <div class="input-box">
            <input type="password" class="" id="password" placeholder="Password" name="password">
            <i class="bi bi-lock-fill"></i>

            <div class="hide-pw">
                <span id="show-password" class="show-password" style="display:none;"
                    onclick="togglePasswordVisibility()">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
        </div>

        <div class="remember-forgot">
            <a href="#">Lupa Password?</a>
        </div>

        <button type="submit" class="button">Submit</button>

        <div class="register-link">
            <p>Belum punya akun? <a href="/register">Register</a></p>
        </div>
        
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>
    $(document).ready(function() {
        $("#password").on("input", function() {
            var passwordField = $("#password");
            var showPasswordIcon = $("#show-password");
            passwordField.val() !== "" ? showPasswordIcon.show() : showPasswordIcon.hide();
        });

        $("#show-password").on("click", function() {
            var passwordField = $("#password");
            var showPasswordIcon = $("#show-password i");

            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                showPasswordIcon.removeClass("bi-eye-slash").addClass("bi-eye");
            } else {
                passwordField.attr("type", "password");
                showPasswordIcon.removeClass("bi-eye").addClass("bi-eye-slash");
            }
        });
    });
</script>

<?= $this->endSection(); ?>