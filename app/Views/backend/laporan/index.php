<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2">Daftar pengguna di CODEHUB</span>

                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tablePengguna" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pesan</th>
                                <th>Data User</th>
                                <th>ID Model</th>
                                <th>Class Model</th>
                                <th>Laporan Dibuat</th>
                                <th>Total Pelapor</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($reports as $report) : ?>
                                <?php $id = base64_encode($report->id); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $report->message ?></td>

                                    <?php $userInfo = $userModel->find($report->user_id); ?>
                                    <td>
                                        <?php if ($userInfo) : ?>
                                            <div class="user-info">
                                                <img src="<?= esc($userInfo->photo) ?>" alt="Avatar">
                                                <div class="user-name">
                                                    <span><?= esc($userInfo->fullname) ?></span>
                                                    <small><?= esc($userInfo->username) ?></small>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            Pengguna tidak ditemukan
                                        <?php endif; ?>
                                    </td>

                                    <td><?= $report->model_id ?></td>
                                    <td><?= ucfirst($report->model_class) ?></td>
                                    <td><?= waktu($report->created_at, 'l, d F Y', false) ?></td>
                                    <td><?= $reportModel->countReportsByModelId($report->model_id) ?></td>

                                    <td>
                                        <div class="btn-group dropleft">
                                            <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="<?= route_to('admin.laporan.edit', $id) ?>" class="dropdown-item py-1">
                                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                </a>
                                                <button type="button" value="<?= $id ?>" class="dropdown-item py-1 btn-delete" data-id="<?= $report->id ?>" data-action="<?= route_to('admin.laporan.destroy') ?>">
                                                    <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
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

<script>
    const btnDelete = $(".btn-delete");
    const table = $("#tablePengguna").DataTable({
        language: {
            url: `${origin}/plugins/datatables/datatables-language/idn.json`
        },
    });

    btnDelete.on("click", function(e) {
        e.preventDefault();

        const id = $(this).val();
        const username = $(this).data("username");
        const message = `Apakah kamu yakin ingin menghapus pengguna <strong>${username}</strong>?`;
        const confirm = (e) => {
            e.preventDefault();

            $.ajax({
                url: $(this).data("action"),
                type: "POST",
                data: {
                    id
                },
                dataType: "JSON",
                success: (res) => {
                    if (res.status === 400) {
                        alertError(res.message);
                    } else {
                        alertifyLog('success', res.message, () => {
                            location.reload();
                        });
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
</script>

<?= $this->endSection() ?>