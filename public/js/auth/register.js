$(document).ready(function () 
{
    const form = $('form#register');
    const submit = form.find('button[type="submit"]');
    const showPass = form.find("#show-pass");

    form.find('.form-control:not([type="email"])').on('input', function () {
        showPass.show(); // show eye icon

        var password = form.find('#password').val();
        var cPassword = form.find('#c-password').val();

        if (password === '' && cPassword === '') showPass.hide();
    });
    
    showPass.click(function () {
        var inputFields = form.find('#password, #c-password');
        var isPasswordVisible = (inputFields.attr('type') === 'password');

        inputFields.attr('type', isPasswordVisible ? 'text' : 'password');

        $(this).find('i')
            .removeClass(isPasswordVisible ? 'fa-eye' : 'fa-eye-slash')
            .addClass(isPasswordVisible ? 'fa-eye-slash' : 'fa-eye');
    });

    $(document).ready(function () {
        form.find('.form-control').on('focus', function () {
            $(this).parent().find('label').addClass('active');
        });

        form.find('.form-control').on('blur', function () {
            if ($(this).val() === '') $(this).parent().find('label').removeClass('active');
        });
    });

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

                $("a").each(function () {
                    $(this).addClass("disabled");
                });
            },
            complete: function () {
                submit.removeAttr("disabled");
                submit.html('Daftar');

                $("a").each(function () {
                    $(this).removeClass("disabled");
                });
            },
            success: function (res) {
                if (res.status === 400) {
                    if (res.val === true) {
                        errors = [];

                        $.each(res.message, function (key, val) {
                            errors.push(val);
                        });

                        alertify.alert(errors.join("<br><br>"));
                    } else {
                        alertify.alert(res.message);
                    }

                    $(document).find(".alertify .msg").addClass("text-danger");
                } else {
                    alertify.alert(res.message, function () {
                        window.location.href = res.redirect;

                        submit.attr("disabled", "disabled");
                        submit.html("<i class='fas fa-spinner fa-spin'></i> Loading...");

                        $("a").each(function () {
                            $(this).addClass("disabled");
                        });
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