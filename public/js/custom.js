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
function alertifyLog(type, message, callback = null) 
{
    $('body').css('overflow', 'hidden');
    alertify.okBtn("Ok").alert(message, callback);
    $(document).find(".alertify .msg").addClass(`text-${type}`);
}

/**
 * Alertify confirm
 * 
 * @param {string} message
 * @param {function} confirmCallback
 * @param {function} cancelCallback
 */
function alertifyConfirm(message, confirmCallback, cancelCallback = null)
{
    $('body').addClass('modal-open');
    alertify.okBtn("Iya").cancelBtn("Batal").confirm(message, confirmCallback, cancelCallback);
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
function handleImageChange(e, modalCrop, sampleImage, formInput)
{
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
function handleCropImage(modalCrop, btnCrop, cropper, sampleImage, imageField, input)
{
    var aspectRatio, width, height;

    if (imageField == 'avatar') {
        aspectRatio = 1 / 1;
        width = 600;
        height = 600;
    } else {
        aspectRatio = 3 / 1;
        width = 1200;
        height = 400;
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

        modalCrop.find(".modal-title span").html(ucfirst(imageField));
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

!(function($) 
{
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
})(jQuery);