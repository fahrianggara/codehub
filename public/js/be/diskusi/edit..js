$(document).ready(function () {
    var modalDiskusi = $('.modal-diskusi-edit');
    var formDiskusi = modalDiskusi.find('form');
    var textarea = "#content-edit";
    var buttonSubmit = formDiskusi.find('button[type="submit"]');
    var buttonDiskusi = $(".btn-edit-diskusi");
    var categoryInput = formDiskusi.find('#category-edit');
    var tagsInput = formDiskusi.find('#tags-edit');
    var urlEdit = `${origin}/edit-thread`;

    modalDiskusi.on('hidden.bs.modal', function () {
        tinymce.get('content-edit').setContent('');
        formDiskusi.find('select.form-control').val(null).trigger('change');
        tagsInput.empty().trigger('change');
    });

    buttonDiskusi.on("click", function (e) {   
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: urlEdit,
            data: {id: id},
            dataType: "json",
            success: function (res) {
                showThread(res, id);
            }
        });
    });

    /**
     * Show thread
     * 
     * @param {object} res
     * @param {string} id
     */
    function showThread(res, id)
    {
        const {title, content} = res.thread;
        const category = res.category;
        const tags = res.tags;

        $('#id-edit').val(id);
        $('#title-edit').val(title);
        $("#content-edit").val(content);
        
        initTinyMce(textarea, false, 380);
        tinymce.get('content-edit').setContent(content);

        initSelect2S(categoryInput, modalDiskusi, {
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
                    results: res.data,
                };
            },
            cache: true,
        });

        // Set selected category
        var option = new Option(category.name, category.id, true, true);
        categoryInput.append(option).trigger('change');

        initSelect2M(tagsInput, modalDiskusi, {
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
        });

        // Set selected tags
        if (tags.length > 0) {
            tags.forEach(function (tag) {
                const selected = new Option(tag.name, tag.name, true, true);
                tagsInput.append(selected).trigger('change');
            });
        }

        modalDiskusi.modal('show');
    }

    formDiskusi.on("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('content', tinymce.get('content-edit').getContent());

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
                buttonSubmit.html('Edit Diskusi');
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
                    showLoader("Tunggu sebentar ya, diskusi kamu sedang diperbarui...");
                    modalDiskusi.modal('hide');
                    location.reload();
                }
            }
        });
    });
});