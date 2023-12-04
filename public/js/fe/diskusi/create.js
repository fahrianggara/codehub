$(document).ready(function () {
    var modalDiskusi = $('.modal-diskusi-create');
    var formDiskusi = modalDiskusi.find('form');
    var textarea = "#content-create";
    var buttonSubmit = formDiskusi.find('button[type="submit"]');
    var buttonDiskusi = $(".btn-buat-diskusi");
    var logined = buttonDiskusi.data("logined");

    buttonDiskusi.on("click", function (e) {   
        e.preventDefault();

        if (!logined) {
            alertifyLog('default', 'Kamu harus login terlebih dahulu untuk membuat diskusi.', () => {
                $("body").css('overflow', 'auto');
            });
            return;
        }

        setTimeout(function () {
            modalDiskusi.modal('show');
        }, 140);

        initTinyMce(textarea);
        
        initSelect2S(formDiskusi.find('#category-create'), modalDiskusi, {
            url: `${origin}/get-categories`,
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (res) {
                return {
                    results: res.data
                };
            },
            cache: true,
        });

        initSelect2M(formDiskusi.find('#tags-create'), modalDiskusi, {
            url: `${origin}/get-tags`,
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (res) {
                return {
                    results: res.data,
                };
            },
            cache: true,
        });
    });

    $(document).on("click", '.modal-close-create', function (e) {
        e.preventDefault();

        if (tinymce.get('content-create').getContent() !== '') {
            alertifyConfirm('Diskusi yang kamu buat akan hilang, yakin ingin menutup modal ini?', function () {
                modalDiskusi.modal('hide');
            }, null, 'IYA TUTUP', 'BATAL');
        } else {
            modalDiskusi.modal('hide');
        }
    });

    modalDiskusi.on('hidden.bs.modal', function () {
        tinymce.get('content-create').setContent('');
        formDiskusi.find('select.form-control').val(null).trigger('change');
        formDiskusi.trigger('reset');
    });

    formDiskusi.on("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('content', tinymce.get('content-create').getContent());

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
                buttonSubmit.html('Buat Diskusi');
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
                    showLoader("Tunggu sebentar ya, diskusi kamu sedang dibuat...");
                    modalDiskusi.modal('hide');
                    location.reload();

                }
            }
        });
    });

});