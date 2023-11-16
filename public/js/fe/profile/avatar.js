$(document).ready(function () {
    var btnAvatarHapus = $("#buttonAvatarHapus");

    btnAvatarHapus.on("click", function(e) {
        e.preventDefault();

        $('body').addClass('modal-open');

        alertify.confirm('Hapus foto profile?', (e) => {
            e.preventDefault();

            $.ajax({
                type: "DELETE",
                url: `${origin}/destroy-avatar`,
                success: function (res) {
                    if (res.status === 400) {
                        alertError(res.message);
                    } else {
                        alertifyLog('success', res.message, () => {
                            location.reload();
                        });
                    }
                }
            });
        }, (e) => {
            e.preventDefault();
            $('body').removeClass('modal-open');
        });
    });
});

$(document).ready(function () {
    var modal = $("#modalEditAvatar");
    var cropper, cropButton = modal.find('.btn-crop');
    var form = $("#formEditAvatar");
    var btnAvatarUpload = $("#buttonAvatarUpload");
    var base64image = form.find('[name="base64image"]');
    var fileInput = form.find('[type="file"');
    var sampleImage = modal.find('.sample-image');
    var imageType = null;

    btnAvatarUpload.on("click", function(e) {
        e.preventDefault();

        fileInput.click(); // Trigger input file

        fileInput.on('change', function() {
            var fileChoose = this.files[0];

            if (!validateImageType(fileChoose, true)) { // Check type
                $(this).val(''); // Hapus file
                alertError('Format gambar harus berupa: jpeg, jpg dan png.');
                return;
            }

            if (!validateImageSize(fileChoose)) {
                $(this).val('');
                alertError('Ukuran gambar maksimal harus 1 MB.');
                return;
            }

            var reader = new FileReader(); // Membaca file
            reader.onload = function (e) { // Setelah selesai dibaca
                sampleImage.attr('src', e.target.result); // Set gambar
                modal.modal('show'); // Menampilkan modal\
            };

            reader.readAsDataURL(fileChoose); // Membaca file sebagai URL
            imageType = fileChoose.type;
        });
    });
    
    modal.on('shown.bs.modal', function () {
        if (cropper) cropper.destroy();

        cropper = new Cropper(sampleImage[0], {
            aspectRatio: 1,
            viewMode: 1,
        });
    }).on('hidden.bs.modal', function () {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        form.trigger('reset');
    });

    cropButton.off("click").on('click', function (e) {
        if (cropper) {
            if (imageType === 'image/gif') {
                cropImageWithTypeGif();
            } else {
                cropImageWithOutTypeGif()
            }
        }
    });

    form.on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: `${origin}/edit-avatar`,
            data: {
                base64image: base64image.val()
            },
            success: function (res) {
                modal.modal('hide');

                if (res.status === 400) {
                    cropButton.attr('disabled', false).html('Potong & Simpan');
                } else {
                    alertifyLog('success', res.message, () => {
                        location.reload();
                    });
                }
            }
        });
    });
    
    /**
     * Crop image with out type gif
     */
    function cropImageWithOutTypeGif() {  
        var canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 500,
        });

        canvas.toBlob((blob) => {
            var reader = new FileReader();
            reader.readAsDataURL(blob);

            reader.onloadend = function () {
                base64image.val(reader.result);
            };
        });

        cropButton.attr('disabled', true)
            .html('<i class="fa fa-spinner fa-spin"></i> Loading...');

        setTimeout(function () {
            form.submit();
        }, 350);
    }

    /**
     * Crop image with type gif
     */
    function cropImageWithTypeGif() {
        CropperjsGif.crop(
            {
                encoder: {
                    workers: 2,
                    quality: 10,
                    workerScript: `${origin}/plugins/cropperjs/gif/gif.worker.js`
                },
                src: sampleImage[0].src,
                background: '#fff',
                maxWidth: 500,
                maxHeight: 500,
                onerror: function (code, error) {
                    alertify.alert(error);
                }
            },
            cropper,
            (blob) => {
                var reader = new FileReader();
                reader.onloadend = function () {
                    base64image.val(reader.result);
                };
                reader.readAsDataURL(blob);

                cropButton.attr('disabled', true)
                    .html('<i class="fa fa-spinner fa-spin"></i> Loading...');

                setTimeout(function () {
                    form.submit();
                }, 350);
            }
        );
    }
});