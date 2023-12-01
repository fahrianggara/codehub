$(document).ready(function () {
    var modalReply = $(".modal-diskusi-reply");
    var modalBody = modalReply.find(".modal-body");
    var buttonReply = $(".btn-reply-thread");
    var buttonReplyChild = $(".btn-reply-thread-child");
    var textarea = "#content-reply";
    var viewThread = modalReply.data("view-thread");
    var formReply = modalReply.find("form");
    var buttonSubmit = formReply.find("button[type=submit]");
    var logined = modalReply.data("logined");

    // hover button reply thread
    $('.btn-reply-thread-child, .btn-share-diskusi').hover(function () {
        $(this).closest('.thread-reply-box').addClass('is-active');
    }, function () {
        $(this).closest('.thread-reply-box').removeClass('is-active');
    });

    // Button Reply Child
    buttonReplyChild.on("click", function (e) {
        e.preventDefault();

        if (!logined) {
            alertifyLog('default', 'Kamu harus login terlebih dahulu untuk membalas diskusi ini.', () => {
                $("body").css('overflow', 'auto');
            });
            return;
        }

        modalReply.find("#title").append(` @${$(this).data("username")}`);
        modalReply.find("#thread_id").val($(this).data("thread_id"));
        modalReply.find("#parent_id").val($(this).data("parent_id"));
        modalReply.find("#child_id").val($(this).data("child_id"));

        initTinyMce(textarea);

        modalReply.modal("show");
    });

    // Button reply thread
    buttonReply.on("click", function (e) {
        e.preventDefault();

        if (!logined) {
            alertifyLog('default', 'Kamu harus login terlebih dahulu untuk membalas diskusi ini.', () => {
                $("body").css('overflow', 'auto');
            });
            return;
        }

        const id = $(this).data("id");
        modalReply.find("#thread_id").val(id);

        if (!viewThread) { // Jika tidak ada data thread yang di reply button
            initTinyMce(textarea);
            modalReply.modal("show");
        } else { // Jika ada data thread yang di reply button
            $.ajax({
                type: "POST",
                url: $(this).data("url"),
                data: {id: id},
                dataType: "json",
                success: function (res) {
                    const {author, content, date, title} = res.data;

                    modalReply.find("#thread_id").val(id);
                    modalReply.find("#title").text(`Diskusi - ${title}`);
                    modalReply.find("#author").text(author);
                    modalReply.find("#date").text(date);
                    modalReply.find("#content").html(content);

                    initTinyMce(textarea);

                    modalReply.modal("show");
                }
            });
        }
    });

    // Button Close Modal
    $(document).on("click", '.modal-close-reply', function (e) {
        e.preventDefault();

        if (tinymce.get('content-reply').getContent() !== '') {
            alertifyConfirm('Balasan diskusi yang kamu buat akan hilang, yakin ingin menutup modal ini?', function () {
                modalReply.modal('hide');
            }, null, 'IYA TUTUP', 'BATAL');
        } else {
            modalReply.modal('hide');
        }
    });

    // modal on show and hidden
    modalReply.on("shown.bs.modal", function () {
        modalBody.animate({
            scrollTop: modalBody.prop("scrollHeight")
        }, 1000);

        Prism.highlightAllUnder(modalBody[0]);
    }).on("hidden.bs.modal", function () {
        modalReply.find("#title").text("Balas Diskusi");
        tinymce.get('content-reply').setContent('');
        formReply.trigger('reset');
    });

    // Form Reply
    formReply.on("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('content', tinymce.get('content-reply').getContent());

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
                buttonSubmit.html('Kirim Balasan <i class="fas fa-paper-plane"></i>');
            },
            success: function (res) {
                if (res.status === 400) {
                    var message = res.message;

                    if (res.validate) {
                        errors = Object.values(res.errors);
                        message = errors.join("<br><br>");
                    }

                    alertifyLog('danger', message, () => {
                        if (res.reload) {
                            location.reload();
                            showLoader("Tunggu sebentar ya, sedang memuat ulang halaman...");
                        }

                        $("body").css('overflow', 'auto');
                    });
                } else {
                    showLoader("Tunggu sebentar ya, balasan sedang dikirim...");
                    modalReply.modal('hide');
                    location.reload();
                }
            }
        });
    });

});