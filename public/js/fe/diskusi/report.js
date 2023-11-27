$(document).ready(function () {
    var modalLaporan = $('.modal-laporan-diskusi');
    var formLaporan = modalLaporan.find('form');
    var buttonSubmit = formLaporan.find('button[type="submit"]');
    var buttonLaporan = $(".btn-report-diskusi");
    var logined = buttonLaporan.data("logined");

    modalLaporan.on("hidden.bs.modal", function (e) {
        formLaporan.trigger("reset");
    });

    buttonLaporan.on("click", function (e) {
        e.preventDefault();

        if (!logined) {
            alertifyLog('default', 'Kamu harus login terlebih dahulu untuk melaporkan diskusi.', () => {
                $("body").css('overflow', 'auto');
            });
            return;
        }

        formLaporan.find("#pelaku_id").val($(this).data("pelaku"));
        formLaporan.find("#model_id").val($(this).data("id"));
        formLaporan.find("#model_class").val($(this).data("model"));

        modalLaporan.modal("show");
    });

    formLaporan.on("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            beforeSend: function () {
                buttonSubmit.attr('disabled', true);
                buttonSubmit.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            },
            complete: function () {
                buttonSubmit.attr('disabled', false);
                buttonSubmit.html('Buat Laporan');
            },
            success: function (res) {
                if (res.status === 400) {
                    if (res.validate) {
                        errors = Object.values(res.message);
                        alertify.alert(errors.join("<br><br>"));
                    } else {
                        alertify.alert(res.message);
                    }
                    
                    $(document).find(".alertify .msg").addClass("text-danger");
                } else {
                    alertifyLog('success', res.message, () => {
                        modalLaporan.modal('hide');
                        $("body").css('overflow', 'auto');
                    });
                }
            }
        });
    });
})