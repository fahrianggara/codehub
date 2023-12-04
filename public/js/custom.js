const toastAlert = $('.toast-alert');
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

if (toastAlert.length) {
    var message = toastAlert.data('message');
    var icon = toastAlert.attr('class').split(' ')[1];

    Toast.fire({
        icon: icon,
        title: message
    });
}

// Flash data alertify
const alertifyAlert = $(".alertify-msg");

if (alertifyAlert.length) {
    const message = alertifyAlert.data('message');
    const type = alertifyAlert.attr('class').split(' ')[1];

    switch (type) {
        case 'success':
            alertify.success(message).delay(3000);
            break;
        case 'error':
            alertify.error(message).delay(3000);
            break;
        case 'info':
            alertify.log(message).delay(3000);
            break;
    }
}

/**
 * Show loader overlay
 * 
 * @param {string} message
 */
function showLoader(message = null) {
    var loaderOverlay = $(document).find(".loader-overlay");

    if (message) {
        loaderOverlay.find(".loader-text").html(message);
        loaderOverlay.addClass("show");
        $("body").css("overflow", "hidden");
    }
}

/**
 * Validate image type
 */
function validateImageType(image, gif = false) {
    var valid_images = ['image/jpeg', 'image/png', 'image/jpg'];
    if (gif) valid_images.push('image/gif');
    return valid_images.includes(image.type);
}

/**
 * Validate image size
 */
function validateImageSize(image, size = 1) {
    var max_size = size * 1024 * 1024; // 1 MB
    return image.size <= max_size;
}

/**
 * Alertify log
 * 
 * @param {string} type
 * @param {string} message
 * @param {function} callback
 */
function alertifyLog(type, message, callback = null) {
    $('body').css('overflow', 'hidden');
    alertify.okBtn("Ok").alert(message, callback);
    $(document).find(".alertify .msg").addClass(`text-${type}`);

    // remove another alertify
    $(document).find(".alertify").not(":last").remove();
}

/**
 * Alertify confirm
 * 
 * @param {string} message
 * @param {function} confirmCallback
 * @param {function} cancelCallback
 */
function alertifyConfirm(message, confirmCallback, cancelCallback = null, btnOk = 'IYA', btnCancel = 'BATAL', type = 'dark') {
    $('body').addClass('modal-open');
    alertify.okBtn(btnOk).cancelBtn(btnCancel).confirm(message, confirmCallback, cancelCallback);
    $(document).find(".alertify .msg").addClass(`text-${type}`);
    $(document).find(".alertify").not(":last").remove();
}

/**
 * Alertify error
 */
function alertError(message) {
    alertify.delay(3000).error(message);
}

/**
 * Capitalize first letter
 */
function ucfirst(string) {
    return string[0].toUpperCase() + string.slice(1);
}

/**
 * Handle image change
 *
 * @param {object} e
 * @param {object} modalCrop
 * @param {string} sampleImage
 * @param {object} formInput
 */
function handleImageChange(e, modalCrop, sampleImage, formInput) {
    var fileChoose = e.target.files[0];

    if (!validateImageType(fileChoose, false)) { // Check type
        formInput.val(''); // Hapus file
        alertError('Format gambar harus berupa: jpeg, jpg dan png.');
        return;
    }

    if (!validateImageSize(fileChoose)) {
        formInput.val('');
        alertError('Ukuran gambar maksimal harus 1 MB.');
        return;
    }

    var reader = new FileReader(); // Membaca file
    reader.onload = function (e) { // Setelah selesai dibaca
        sampleImage.attr('src', e.target.result); // Set gambar
        modalCrop.modal('show'); // Menampilkan modal\
    };

    reader.readAsDataURL(fileChoose); // Membaca file sebagai URL
}

/**
 * Handle crop image
 * 
 * @param modalCrop
 * @param btnCrop
 * @param cropper
 * @param sampleImage
 * @param imageField // avatar or banner
 * @param {object} input
 */
function handleCropImage(modalCrop, btnCrop, cropper, sampleImage, imageField, input) {
    modalCrop.find(".modal-title span").html(ucfirst(imageField));

    var aspectRatio, width, height;

    if (imageField == 'avatar') {
        aspectRatio = 1 / 1;
        width = 600;
        height = 600;
    } else if (imageField == 'banner') {
        aspectRatio = 3 / 1;
        width = 1200;
        height = 400;
    } else {
        aspectRatio = 16 / 9;
        width = 1080;
        height = 566;
    }

    modalCrop.on('shown.bs.modal', function () {
        if (cropper) {
            cropper.destroy();
            cropper = null;
            $(document).find(".cropper-container").remove();
        }

        cropper = new Cropper(sampleImage[0], {
            aspectRatio: aspectRatio,
            viewMode: 1,
        });
    }).on('hidden.bs.modal', function () {
        if (cropper) {
            cropper.destroy();
            cropper = null;
            $(document).find(".cropper-container").remove();
        }

        input.file.val("");
    });

    btnCrop.off("click").on('click', function (e) {
        var successText = `<i class='fas fa-check-circle text-success mr-1'></i> Gambar ${imageField} berhasil di potong.`;
        var canvas = cropper.getCroppedCanvas({
            width: width,
            height: height,
        });

        canvas.toBlob((blob) => {
            var reader = new FileReader();
            reader.readAsDataURL(blob);

            reader.onloadend = function () {
                var base64data = reader.result;

                input.file.val("");
                input.blob.val(base64data);
                input.label.html(successText);

                modalCrop.modal('hide');
            };
        });

        alertify.log(`Berhasil memotong gambar ${imageField}`).delay(3000);
    });
}

/**
 * Initialize TinyMCE 5
 * 
 * @param {object} textarea
 * @param {boolean} menubar
 * @param {integer} height
 */
function initTinyMce(textarea, menubar = false, height = 200) {
    tinyMCE.init({
        selector: textarea,
        convert_urls: false,
        height: height,
        width: '100%',
        menubar: menubar,
        plugins: [
            "codemirror", "link", "lists", "codesample", "paste", "wordcount", "autoresize"
        ],
        codesample_global_prismjs: true,
        codesample_languages: [
            { text: 'HTML/XML', value: 'markup' },
            { text: 'JavaScript', value: 'javascript' },
            { text: 'CSS', value: 'css' },
            { text: 'PHP', value: 'php' },
            { text: 'Ruby', value: 'ruby' },
            { text: 'Python', value: 'python' },
            { text: 'Java', value: 'java' },
            { text: 'C', value: 'c' },
            { text: 'C#', value: 'csharp' },
            { text: 'C++', value: 'cpp' },
            { text: 'SQL', value: 'sql' },
            { text: 'Go', value: 'go' },
            { text: 'TypeScript', value: 'typescript' },
            { text: 'Scala', value: 'scala' },
            { text: 'Swift', value: 'swift' },
            { text: 'Kotlin', value: 'kotlin' },
            { text: 'Dart', value: 'dart' },
            { text: 'Bash/Shell', value: 'bash' },
        ],
        toolbar: "bold italic underline blockquote strikeout bullist numlist link codesample",
        noneditable_noneditable_class: "mceNonEditable",
        codemirror: {
            indentOnInit: true, // Whether or not to indent code on init.
            saveCursorPosition: true, // Insert caret marker
        },
        init_instance_callback: function (editor) {
            $(editor.getContainer()).find('button.tox-statusbar__wordcount').click();  // if you use jQuery
        },
        setup: function (editor) {
            editor.ui.registry.addButton('strikeout', {
                icon: 'sourcecode',
                tooltip: "Format as code",
                onAction: function () {
                    editor.execCommand('mceToggleFormat', false, 'code');
                }
            });
        }
    });
}

/**
 * Init select2 single
 *
 * @param {object} select example: $('#select')
 * @param {object} dropdown example: $('#modal')
 * @param {object} ajax
 */
function initSelect2S(select, dropdownParent, ajax = null) {
    let dropdownVal = null

    if (dropdownParent) dropdownVal = dropdownParent;

    select.select2({
        placeholder: select.attr('placeholder') ? select.attr('placeholder') : 'Silahkan pilih..',
        allowClear: true,
        width: '100%',
        dropdownParent: dropdownVal,
        ajax: ajax,
        templateResult: function (state) {
            if (!state.id) return state.text;
            count = state.count ? state.count : 0;
            return $(`<span>${state.text} <span class="badge badge-pill badge-primary ml-1">${count}</span></span>`);
        },
    });
}

/**
 * Init select2 multiple
 *
 * @param {object} select example: $('#select')
 * @param {object} dropdown example: $('#modal')
 * @param {object} ajax
 */
function initSelect2M(select, dropdownParent, ajax = null) {
    let dropdownVal = null

    if (dropdownParent) dropdownVal = dropdownParent;

    select.select2({
        placeholder: select.attr('placeholder') ? select.attr('placeholder') : 'Silahkan pilih..',
        allowClear: true,
        width: '100%',
        dropdownParent: dropdownVal,
        tags: true,
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term.indexOf('<') == 0 || term === '') return null;

            return {
                id: term,
                text: term,
                newTag: true
            }
        },
        ajax: ajax,
        templateResult: function (state) {
            if (!state.id) return state.text;
            count = state.count ? state.count : 0;
            return $(`<span>${state.text} <span class="badge badge-pill badge-primary ml-1">${count}</span></span>`);
        },
    });
}

!(function ($) {
    "use strict";

    moment.locale('id');

    $(".modal").on('shown.bs.modal', function () {
        $(this).find("input:visible:first").focus();
    });

    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    }).on('click', function () {
        $(this).tooltip('hide');
    });

    setTimeout(() => {
        history.replaceState('', document.title, window.location.origin + window
            .location.pathname + window
                .location.search);
    }, 500);
})(jQuery);