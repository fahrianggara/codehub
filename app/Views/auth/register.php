<?= $this->extend('layouts/auth'); ?>

<?= $this->section('content'); ?>

    <div class="wrapper">
        <form action="">
    
            <div class="header">
                <h1>Register</h1>
            </div>
    
            <div class="input-box">
                <input type="text" placeholder="Masukan email" required>
                <i class="bi bi-envelope-fill"></i>
            </div>
    
            <div class="input-box">
                <input type="password" id="password" placeholder="Masukan password" required>
                <i class="bi bi-lock-fill"></i>
               
                <div class="hide-pw">
                    <span id="show-password" class="show-password">
                        <i class="bi bi-eye-slash"></i></span>
                </div>
            </div>

            <div class="input-box">
                <input type="password" id="konfirm-pass" placeholder="Konfirmasi password" required>
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
        $(document).ready(function() {
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