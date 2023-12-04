$(document).ready(function () {
    var btnBannerHapus = $("#buttonBannerHapus");

    btnBannerHapus.on("click", function(e) {
        e.preventDefault();

        $('body').addClass('modal-open');

        var cancel = (e) => {
            e.preventDefault();
            $('body').removeClass('modal-open');
        };

        var confirm = (e) => {
            e.preventDefault();

            $.ajax({
                type: "DELETE",
                url: `${origin}/destroy-banner`,
                success: function (res) {
                    if (res.status === 400) {
                        alertifyLog('danger', res.message, (e) => {
                            $('body').css('overflow', 'auto');
                        });
                    } else {
                        showLoader("Tunggu sebentar ya, foto sampul kamu sedang dihapus...");
                        location.reload();
                    }
                }
            });
        };

        alertifyConfirm('Hapus foto sampul?', confirm, cancel, 'IYA HAPUS');
    });
});

$(document).ready(function () {
    var modal = $("#modalEditBanner");
    var cropper, cropButton = modal.find('.btn-crop');
    var form = $("#formEditBanner");
    var btnBannerUpload = $("#buttonBannerUpload");
    var base64image = form.find('[name="base64image"]');
    var fileInput = form.find('[type="file"');
    var sampleImage = modal.find('.sample-image');

    btnBannerUpload.on("click", function(e) {
        e.preventDefault();

        fileInput.click(); // Trigger input file

        fileInput.on('change', function() {
            var fileChoose = this.files[0];

            if (!validateImageType(fileChoose)) { // Check type
                $(this).val(''); // Hapus file
                alertError('Format gambar harus berupa: jpeg, jpg dan png.');
                return;
            }

            if (!validateImageSize(fileChoose, 1)) {
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
            aspectRatio: 3/1,
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
            var canvas = cropper.getCroppedCanvas({
                width: 1200,
                height: 400,
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
    });

    form.on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: `${origin}/edit-banner`,
            data: {
                base64image: base64image.val()
            },
            success: function (res) {
                modal.modal('hide');

                if (res.status === 400) {
                    cropButton.attr('disabled', false).html('Potong & Simpan');
                } else {
                    showLoader("Tunggu sebentar ya, foto sampul kamu sedang diupload...");
                    location.reload();
                }
            }
        });
    });
});