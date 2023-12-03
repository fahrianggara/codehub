<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2">Daftar pengguna di CODEHUB</span>
                        <a href="<?= route_to('admin.pengguna.create') ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-plus mr-1"></i>
                            Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tablePengguna" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pengguna Info</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Total Diskusi</th>
                                <th>Bergabung Pada</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($users as $user): ?>
                                <?php $id = encrypt($user->id); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class="user-info">
                                            <img src="<?= $user->photo ?>">
                                            <div class="user-name">
                                                <span><?= $user->full_name ?></span>
                                                <a href="<?= base_url("$user->username") ?>" target="_blank" style="font-size: 12px;">
                                                    <?= $user->username ?>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $user->email ?></td>
                                    <td><?= ucfirst($user->role) ?></td>
                                    <td>
                                        <?php if ($user->threads) : ?>
                                            <p class="m-0"><?= count($user->getThreads('all')) ?> Diskusi</p>
                                            <p class="m-0 d-inline-block">
                                                <?= count($user->threads) ?> 
                                                <span class="badge badge-success">Publik</span>
                                            </p>
                                            <p class="m-0 d-inline-block">
                                                <?= count($user->getThreads('draft')) ?> 
                                                <span class="badge badge-secondary">Arsip</span>
                                            </p>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Belum ada diskusi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= waktu($user->created_at, 'l, d F Y', false) ?></td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button class="btn btn-sm btn-more dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="<?= route_to('admin.pengguna.edit', $id) ?>" class="dropdown-item py-1">
                                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                </a>
                                                <button type="button" value="<?= $id ?>" class="dropdown-item py-1 btn-delete"
                                                    data-username="<?= $user->username ?>" data-action="<?= route_to('admin.pengguna.destroy') ?>">
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

    btnDelete.on("click", function (e) {
        e.preventDefault();

        const id = $(this).val();
        const username = $(this).data("username");
        const message = `Apakah kamu yakin ingin menghapus pengguna <strong>${username}</strong>?`;
        const confirm = (e) => {
            e.preventDefault();

            $.ajax({
                url: $(this).data("action"),
                type: "POST",
                data: {id},
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