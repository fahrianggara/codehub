$(document).ready(function () 
{
    const form = $("form#login");
    const submit = form.find("button[type=submit]");
    const showPass = form.find("#show-pass");

    form.find('[type="password"]').on('input', function () {
        showPass.show(); // show eye icon
        if ($(this).val() === '') showPass.hide(); // hide eye icon
    });

    showPass.on('click', function() 
    {
        var input = form.find(".password");

        input.attr('type') === 'password'
            ? input.attr('type','text') 
            : input.attr('type','password');

        $(this).find('i').toggleClass("fa-eye fa-eye-slash");
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
                submit.html('Masuk');

                $("a").each(function () {
                    $(this).removeClass("disabled");
                });
            },
            success: function (res) {
                if (res.status === 400) {
                    var message = res.message;

                    if (res.validate) {
                        errors = Object.values(res.errors);
                        message = errors.join("<br><br>");
                    }

                    alertifyLog('danger', message, () => {
                        $("body").css('overflow', 'auto');
                    });
                } else {
                    showLoader(`Tunggu sebentar ya, ${res.message}...`);
                    setTimeout(() => {
                        window.location.href = res.redirect;
                    }, 1500);


                    // alertifyLog('success', res.message, () => {
                    //     window.location.href = res.redirect;

                    //     submit.attr("disabled", "disabled").html("<i class='fas fa-spinner fa-spin'></i> Loading...");

                    //     $("a").each(function () {
                    //         $(this).addClass("disabled");
                    //     });
                    // });
                }
            },
            error: function (err) {
                alert("Error: " + err.responseText);
            }
        });
    });
});