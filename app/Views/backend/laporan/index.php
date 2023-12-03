<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2">Daftar laporan di CODEHUB</span>

                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tablePengguna" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pesan</th>
                                <th>Author dari Objek</th>
                                <th>Objek</th>
                                <th>Objek ID</th>
                                <th>Total Dilapor</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($reports as $report) : ?>
                                <?php $user = (new App\Models\UserModel)->find($report->user_id); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $report->message ?></td>
                                    <td>
                                        <div class="user-info">
                                            <img src="<?= $user->photo ?>">
                                            <div class="user-name">
                                                <span><?= $user->full_name ?></span>
                                                <a href="<?= base_url("{$user->username}") ?>" target="_blank" style="font-size: 12px;">
                                                    <?= $user->username ?>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $exp = explode('\\', $report->model_class);
                                        $model = $exp[2];
                                        $model = explode('Model', $model)[0];
                                        $model = $model === 'Thread' ? 'Diskusi' : 'Balasan / Komentar';
                                        ?>

                                        <p class="mb-0"><?= $model ?></p>
                                        <a href="javascript:void(0)" class="url-slug btn-laporan" data-url="<?= route_to('admin.laporan.object-show') ?>" 
                                            data-model_id="<?= $report->model_id ?>" data-model_class="<?= $report->model_class ?>">
                                            Lihat...
                                        </a>
                                    </td>
                                    <td><?= $report->model_id ?></td>
                                    <td><?= $report->count ?></td>
                                    <td>
                                        <button type="button" value="<?= encrypt($report->id) ?>" class="btn btn-sm btn-danger btn-delete" data-action="<?= route_to('admin.laporan.destroy') ?>">
                                            <i class="fas  fa-trash mr-1"></i> Hapus Laporan
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<div class="modal fade modal-laporan" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header p-2">
                <div class="modal-header-responsive">
                    <div class="modal-title d-flex align-items-center ml-2">
                        <div id="title" class="mx-1 text-truncate">Objek Konten</div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="report-object">
                    <span id="author" class="mr-1">Mimin Admin</span> • <span id="date" class="ml-1">1 hari yang lalu</span>
                    <div id="content">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit magni quae voluptate porro nam iste minus natus, recusandae vitae voluptas adipisci aliquam dolorem officia ratione voluptatum necessitatibus sit neque eaque. Sit esse quas corporis doloribus dicta id officiis. Deserunt saepe maxime eaque? Dignissimos neque saepe assumenda tempora! Voluptates maiores quisquam officia, quasi facere corrupti voluptate sint mollitia autem doloremque asperiores.
                        </p>
                        <blockquote>
                            Dolor a vel laborum dignissimos ab animi, totam non suscipit, laboriosam illo aspernatur magnam in sit provident officia minima incidunt et ratione modi sapiente? Recusandae explicabo pariatur facilis aut eius.Cum fugiat aliquam iure, quisquam soluta saepe fugit eum ad velit doloremque officiis ducimus aperiam labore eos voluptatibus temporibus consequuntur, accusamus numquam dolores ab eius. Dolor iste soluta delectus maiores.
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="modal-footer p-1">
                <button type="button" class="btn btn-danger btn-hapus-author">
                    <i class="fas fa-user mr-1"></i> Hapus Author
                </button>
                <button type="button" class="btn btn-danger btn-hapus-objek">
                    <i class="fas fa-comments mr-1"></i> Hapus Objek
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const btnLaporan = $(".btn-laporan");
    const modalLaporan = $(".modal-laporan");
    const btnDelete = $(".btn-delete");
    const table = $("#tablePengguna").DataTable({
        language: {
            url: `${origin}/plugins/datatables/datatables-language/idn.json`
        },
    });

    // Button Delete Click
    btnDelete.on("click", function(e) {
        e.preventDefault();

        const id = $(this).val();
        const message = `Apakah kamu yakin ingin menghapus laporan ini?`;
        const confirm = (e) => {
            e.preventDefault();

            $.ajax({
                url: $(this).data("action"),
                type: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: (res) => {
                    if (res.status === 400) {
                        alertifyLog('danger', res.message, (e) => {
                            $('body').css('overflow', 'auto');
                        });
                    } else {
                        location.reload();
                    }
                },
                error: (xhr, status, error) => {
                    alertError("Maaf, terjadi kesalahan pada server. Lihat di console untuk detailnya.");
                    console.log(xhr.responseText);
                }
            });
        }

        alertifyConfirm(message, confirm, (e) => {
            $('body').removeClass('modal-open');
        });
    });

    // Button Laporan Click
    btnLaporan.on("click", function(e) {
        e.preventDefault();

        const modelId = $(this).data("model_id");
        const modelClass = $(this).data("model_class");

        $.ajax({
            type: "POST",
            url: $(this).data("url"),
            data: {
                model_id: modelId,
                model_class: modelClass
            },
            dataType: "json",
            success: function (res) {
                const {author, content, date, user_id} = res.data;
                
                if (user_id === "<?= encrypt(auth()->id) ?>") { // jika author sama dengan user yang login
                    modalLaporan.find(".btn-hapus-author").remove();
                } else {
                    if (modalLaporan.find(".btn-hapus-author").length > 1) {
                        modalLaporan.find(".btn-hapus-author").first().remove();
                    }
                }

                modalLaporan.find(".btn-hapus-author").attr('data-user_id', user_id)
                modalLaporan.find(".btn-hapus-objek").attr('data-model_id', modelId).attr('data-model_class', modelClass);
                modalLaporan.find("#author").text(author);
                modalLaporan.find("#date").text(date);
                modalLaporan.find("#content").html(content);

                modalLaporan.modal("show");
            }
        });
    });

    modalLaporan.on("shown.bs.modal", function () {
        const btnHapusAuthor = $(this).find(".btn-hapus-author");
        const btnHapusObjek = $(this).find(".btn-hapus-objek");
        const cancelCb = () => {
            $('body').css('overflow', 'auto');
        };

        Prism.highlightAllUnder(modalLaporan[0]); // Prism Highlight

        // Button Hapus Author Click
        btnHapusAuthor.off('click').on("click", function (e) {  
            e.preventDefault();

            message = `Apakah kamu yakin ingin menghapus author dari objek ini? Jika kamu menghapus,
            maka semua yang berkaitan dengan author ini (diskusi, like, komentar) akan dihapus juga.`;

            alertifyConfirm(message, (e) => {
                e.preventDefault();

                deleteTarget({
                    user_id: $(this).data("user_id"),
                });
            }, cancelCb, 'HAPUS', 'BATAL', 'danger');
        });

        // Button Hapus Objek Click
        btnHapusObjek.off('click').on("click", function (e) {  
            e.preventDefault();

            message = `Apakah kamu yakin ingin menghapus objek ini? Jika kamu menghapus, 
                maka semua yang berkaitan dengan objek ini (like) akan dihapus juga.`;

            alertifyConfirm(message, (e) => {
                e.preventDefault();

                deleteTarget({
                    model_id: $(this).data("model_id"),
                    model_class: $(this).data("model_class"),
                });
            }, cancelCb, 'HAPUS', 'BATAL', 'danger');
        });
    }).on("hidden.bs.modal", function () {
        $(this).find(".modal-footer").prepend(`
            <button type="button" class="btn btn-danger btn-hapus-author">
                <i class="fas fa-user mr-1"></i> Hapus Author
            </button>
        `);
    });

    /**
     * Button delete target click
     */
    function deleteTarget(data)
    {
        $.ajax({
            type: "POST",
            url: "<?= route_to('admin.laporan.object-destroy') ?>",
            data: data,
            dataType: "json",
            success: function (res) {
                if (res.status === 400) {
                    alertifyLog('danger', res.message, (e) => {
                        $('body').css('overflow', 'auto');
                    });
                } else {
                    location.reload();
                }
            }
        });
    }
</script>

<?= $this->endSection() ?>