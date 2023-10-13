<?= $this->extend('layouts/auth'); ?>

<?= $this->section('content'); ?>

<?php
$flashDataUsername = session()->getFlashdata('errUsername');
$flashDataPassword = session()->getFlashdata('errPassword');
?>

<div class="wrapper">
        <form action="">
    
            <div class="header-login">
                <h1>Log<a>in</a></h1>
            </div>
    
            <div class="input-box">
                <input type="text" placeholder="Username" required>
                <i class="bi bi-person-fill"></i>
            </div>
    
            <div class="input-box">
                <input type="password" id="password" placeholder="Password" required>
                <i class="bi bi-lock-fill"></i>
               
                <div class="hide-pw">
                    <span id="show-password" class="show-password" onclick="togglePasswordVisibility()">
                        <i class="bi bi-eye-slash"></i></span>
                </div>
            </div>
    
            <div class="remember-forgot">
                <a href="#">Lupa Password?</a>
            </div>
    
            <button type="submit" class="button">Login</button>
    
            <div class="register-link">
                <p>Belum punya akun?<a href="#">Register</a></p>
            </div>
            
        </form>
    
</div>



<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function() {
        $("#show-password").hide(); // Sembunyikan logo mata awalnya

        $("#password").on("input", function() {
            var passwordField = $("#password");
            var showPasswordIcon = $("#show-password");

            if (passwordField.val() !== "") {
                showPasswordIcon.show();
            } else {
                showPasswordIcon.hide();
            }
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