<div class="modal fade" id="modalEditBanner" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    <i class="fas fa-crop text-primary mr-1"></i>
                    Potong Foto Sampul
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

<form id="formEditBanner" action="#" method="POST">
    <input type="hidden" name="base64image">
    <input type="file" name="banner" class="d-none file">
    <button type="submit" class="d-none"></button>
</form>

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        var btnBannerHapus = $("#buttonBannerHapus");

        btnBannerHapus.on("click", function(e) {
            e.preventDefault();

            alertify.confirm('Hapus foto sampul?', (e) => {
                e.preventDefault();

                $.ajax({
                    type: "DELETE",
                    url: `${origin}/destroy-banner`,
                    success: function (res) {
                        if (res.status === 400) {
                            alertError(res.message);
                        } else {
                            alertify.alert(res.message, () => {
                                location.reload();
                            });

                            $(document).find(".alertify .msg").addClass("text-success");
                        }
                    }
                });
            }, (e) => {
                e.preventDefault();
            });
        });
    });
</script>

<script>
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

                if (!validateImageType(fileChoose, true)) { // Check type
                    $(this).val(''); // Hapus file
                    alertError('Format gambar harus berupa: jpeg, jpg dan png.');
                    return;
                }

                if (!validateImageSize(fileChoose, 2)) {
                    $(this).val('');
                    alertError('Ukuran gambar maksimal harus 2 MB.');
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
                        alertify.alert(res.message, () => {
                            location.reload();
                        });

                        $(document).find(".alertify .msg").addClass("text-success");
                    }
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>