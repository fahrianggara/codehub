$(document).ready(function () {
    var modalBalasan = $('.modal-balasan-edit');
    var formBalasan = modalBalasan.find('form');
    var buttonSubmit = formBalasan.find('button[type="submit"]');
    var textarea = "#content-edit-reply";
    var buttonReply = $(".btn-edit-balasan");
    var urlEdit = `${origin}/edit-thread`;

    modalBalasan.on('hidden.bs.modal', function () {
        tinymce.get('content-edit').setContent('');
    });

    buttonReply.on("click", function (e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: urlEdit,
            data: {reply_id: id},
            dataType: "json",
            success: function (res) {
                const {content} = res.reply;

                $('#id-edit-reply').val(id);
                $("#content-edit-reply").val(content);

                initTinyMce(textarea, false, 380);
                tinymce.get('content-edit-reply').setContent(content);

                modalBalasan.modal('show');
            }
        });
    });

    formBalasan.on("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('content', tinymce.get('content-edit-reply').getContent());

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
                buttonSubmit.html('Edit Balasan');
            },
            success: function (res) {
                if (res.status === 400) {
                    var message = res.message;

                    if (res.validate) {
                        errors = Object.values(res.message);
                        message = errors.join("<br><br>");
                    }

                    alertifyLog('danger', message, () => {
                        $("body").css('overflow', 'auto');
                    });
                } else {
                    showLoader("Tunggu sebentar ya, balasan kamu sedang diperbarui...");
                    modalBalasan.modal('hide');
                    location.reload();
                }
            }
        });
    });
});