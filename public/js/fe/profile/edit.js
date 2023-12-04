$(document).ready(function () {
    var modal = $('#modalEditProfile');
    var btnModal = $(".btn-profile");
    var form = modal.find('form');
    var submit = form.find('button[type="submit"]');

    modal.on('hidden.bs.modal', function () {
        form.find(".form-control").removeClass("is-invalid");
        form.find(".error-text").html("");
        form[0].reset();
    });

    btnModal.on('click', function (e) {
        e.preventDefault();

        modal.modal('show');

        // value show
        var input = form.find('input');
        for (let i = 0; i < input.length; i++) {
            var name = $(input[i]).attr('name');
            var value = $(input[i]).val();
            $(`#${name}`).val(value);
        }
    });

    form.on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: `${origin}/edit-profile`,
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function () {
                submit.attr("disabled", "disabled");
                submit.html("<i class='fas fa-spinner fa-spin'></i> Loading...");
                $('[data-dismiss="modal"]').attr("disabled", true);
            },
            complete: function () {
                submit.removeAttr("disabled");
                submit.html('Perbarui');
                $('[data-dismiss="modal"]').removeAttr("disabled");
            },
            success: function (res) {
                if (res.status === 400) {
                    if (res.validation) {
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
                    showLoader("Tunggu sebentar ya, profile kamu sedang diperbarui...");
                    modal.modal('hide');
                    location.href = res.redirect;
                }
            },
            error: function (err) {
                alert("Terjadi kesalahan! Lihat di console untuk detailnya.");
                console.log(err.responseText);
            }
        });
    });
});