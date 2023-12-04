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
                        alertifyLog('danger', res.message, (e) => {
                            $('body').css('overflow', 'auto');
                        });
                    }
                } else {
                    alertifyLog('success', res.message, () => {
                        showLoader("Tunggu sebentar ya, kamu sedang diarahkan ke halaman login...");
                        location.href = res.redirect ?? location.reload;
                    });
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