$(document).ready(function () {
    var form = $('#formCreate');
    var avatar = form.find('[name="avatar"]');
    var banner = form.find('[name="banner"]');
    var modalCrop = $('.modal-crop-create');
    var btnCrop = modalCrop.find(".btn-crop"),
        sampleImage = modalCrop.find('.sample-image'),
        avatarCropper, bannerCropper;

    // Avatar Image
    avatar.on('change', function (e) {
        handleImageChange(e, modalCrop, sampleImage, avatar);

        avatarCropper = new Cropper(sampleImage[0], {
            aspectRatio: 1 / 1,
            viewMode: 1,
        });

        handleCropImage(modalCrop, btnCrop, avatarCropper, sampleImage, 'avatar', {
            file: avatar,
            blob: form.find('[name="blob_avatar"]'),
            label: form.find('.custom-file-label[for="avatar"]')
        });
    });

    // Banner Image
    banner.on('change', function (e) {
        handleImageChange(e, modalCrop, sampleImage, banner);

        bannerCropper = new Cropper(sampleImage[0], {
            aspectRatio: 3 / 1,
            viewMode: 1,
        });

        handleCropImage(modalCrop, btnCrop, bannerCropper, sampleImage, 'banner', {
            file: banner,
            blob: form.find('[name="blob_banner"]'),
            label: form.find('.custom-file-label[for="banner"]')
        });
    });
});