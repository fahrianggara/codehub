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

    $('.btn-reply-thread-child').hover(function () {
        $(this).closest('.thread-reply-box').addClass('is-active');
    }, function () {
        $(this).closest('.thread-reply-box').removeClass('is-active');
    });

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

    buttonReply.on("click", function (e) {
        e.preventDefault();

        if (!logined) {
            alertifyLog('default', 'Kamu harus login terlebih dahulu untuk membalas diskusi ini.', () => {
                $("body").css('overflow', 'auto');
            });
            return;
        }

        const id = $(this).data("id");
        const url = $(this).data("url");

        $.ajax({
            type: "POST",
            url: url,
            data: {id: id},
            dataType: "json",
            success: function (res) {
                viewThread ? showWithViewThread(res, id) : showThread(res, id);
            }
        });
    });

    /**
     * Show thread without view thread (for page detail)
     * 
     * @param {object} res
     * @param {string} id
     * @param {boolean} child
     */
    function showThread(res, id)
    {
        modalReply.find("#thread_id").val(id);

        initTinyMce(textarea);

        modalReply.modal("show");
    }

    /**
     * Show thread with view thread (for page profile)
     * 
     * @param {object} res
     * @param {string} id
     */
    function showWithViewThread(res, id)
    {
        const {author, content, date, slug, title} = res.data;

        modalReply.find("#thread_id").val(id);
        modalReply.find("#title").text(`Diskusi - ${title}`);
        modalReply.find("#author").text(author);
        modalReply.find("#date").text(date);
        modalReply.find("#content").html(content);

        initTinyMce(textarea);

        modalReply.modal("show");
    }

    modalReply.on("shown.bs.modal", function () {
        modalBody.animate({
            scrollTop: modalBody.prop("scrollHeight")
        }, 1000);

        Prism.highlightAllUnder(modalBody[0]);
    }).on("hidden.bs.modal", function () {
        modalReply.find("#title").text("Balas Diskusi");
        tinymce.get('content-reply').setContent('');
    });

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
                        $("body").css('overflow', 'auto');
                    });
                } else {
                    modalReply.modal('hide');
                    location.reload();
                }
            }
        });
    });

});