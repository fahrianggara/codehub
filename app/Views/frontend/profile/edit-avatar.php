<div class="modal fade" id="modalEditAvatar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    <i class="fas fa-crop text-primary mr-1"></i>
                    Potong Foto Profile
                </p>
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="img-container">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid sample-image">
                    </div>
                </div>
            </div>

            <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-crop">Potong & Simpan</button>
            </div>
        </div>
    </div>
</div>

<form id="formEditAvatar" action="#" method="POST">
    <input type="hidden" name="base64image">
    <input type="file" name="avatar" class="d-none file">
    <button type="submit" class="d-none"></button>
</form>

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        var modal = $("#modalEditAvatar");
        var cropper, cropButton = modal.find('.btn-crop');
        var form = $("#formEditAvatar");
        var btnAvatar = $("#buttonAvatar");
        var base64image = form.find('[name="base64image"]');
        var fileInput = form.find('[type="file"');
        var sampleImage = modal.find('.sample-image');
        var imageType = null;

        btnAvatar.on("click", function(e) {
            e.preventDefault();

            fileInput.click(); // Trigger input file

            fileInput.on('change', function() {
                var fileChoose = this.files[0];

                if (!validateImageType(fileChoose)) { // Check type
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
                        alertify.alert(res.message, () => {
                            location.reload();
                        });

                        $(document).find(".alertify .msg").addClass("text-success");
                    }
                }
            });
        });
        
        /**
         * Crop image with out type gif
         */
        function cropImageWithOutTypeGif() {  
            var canvas = cropper.getCroppedCanvas({
                width: 1000,
                height: 1000,
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
                        workerScript: "<?= base_url('plugins/cropperjs/gif/gif.worker.js') ?>"
                    },
                    src: sampleImage[0].src,
                    background: '#fff',
                    maxWidth: 600,
                    maxHeight: 600,
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
</script>

<?= $this->endSection() ?>