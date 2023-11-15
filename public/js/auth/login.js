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

    const form = $("form#login");
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

                        $("a").each(function () {
                            $(this).addClass("disabled");
                        });
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