$(document).ready(function () {
    var btnAvatarHapus = $("#buttonAvatarHapus");

    btnAvatarHapus.on("click", function(e) {
        e.preventDefault();

        var cancel = (e) => {
            e.preventDefault();
            $('body').removeClass('modal-open');
        };

        var confirm = (e) => {
            e.preventDefault();

            $.ajax({
                type: "DELETE",
                url: `${origin}/destroy-avatar`,
                success: function (res) {
                    if (res.status === 400) {
                        alertError(res.message);
                    } else {
                        showLoader("Tunggu sebentar ya, foto profile kamu sedang dihapus...");
                        location.reload();
                    }
                }
            });
        };

        alertifyConfirm('Hapus foto profile?', confirm, cancel, 'IYA HAPUS');
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
            cropButton.attr('disabled', true)
                .html('<i class="fa fa-spinner fa-spin"></i> Loading...');

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
                    alertifyLog('danger', res.message, (e) => {
                        $('body').css('overflow', 'auto');
                    });
                    cropButton.attr('disabled', false).html('Potong & Simpan');
                } else {
                    showLoader("Tunggu sebentar ya, foto profile kamu sedang diupload...");
                    location.reload();
                }
            }
        });
    });
    
    /**
     * Crop image with out type gif
     */
    function cropImageWithOutTypeGif() {  
        var canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
        });

        canvas.toBlob((blob) => {
            var reader = new FileReader();
            reader.readAsDataURL(blob);

            reader.onloadend = function () {
                base64image.val(reader.result);
            };
        });

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
                maxWidth: 180,
                maxHeight: 180,
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

                setTimeout(function () {
                    form.submit();
                }, 350);
            }
        );
    }
});