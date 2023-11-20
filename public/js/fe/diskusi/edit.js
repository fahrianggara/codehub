$(document).ready(function () {
    var modalDiskusi = $('.modal-diskusi-edit');
    var formDiskusi = modalDiskusi.find('form');
    var textarea = "#content-edit";
    var buttonSubmit = formDiskusi.find('button[type="submit"]');
    var buttonDiskusi = $(".btn-edit-diskusi");

    modalDiskusi.on('hidden.bs.modal', function () {
        tinymce.get('content-edit').setContent('');
        formDiskusi.find('select.form-control').val(null).trigger('change');
        formDiskusi.find('#tags-edit').empty().trigger('change');
    });

    buttonDiskusi.on("click", function (e) {   
        e.preventDefault();

        var id = $(this).data('id');
        var url = `${origin}/edit-thread`;

        $.ajax({
            type: "POST",
            url: url,
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

        initSelect2S(formDiskusi.find('#category-edit'), modalDiskusi, {
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
        formDiskusi.find('#category-edit').append(option).trigger('change');

        initSelect2M(formDiskusi.find('#tags-edit'), modalDiskusi, {
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
                formDiskusi.find('#tags-edit').append(selected).trigger('change');
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
                    if (res.validate) {
                        errors = Object.values(res.message);
                        alertify.alert(errors.join("<br><br>"));
                    } else {
                        alertify.alert(res.message);
                    }
                    
                    $(document).find(".alertify .msg").addClass("text-danger");
                } else {
                    modalDiskusi.modal('hide');
                    
                    alertifyLog('success', res.message, () => {
                        location.reload();
                    });
                }
            }
        });
    });
});