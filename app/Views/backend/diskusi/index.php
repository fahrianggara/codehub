<?= $this->extend('layouts/backend') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2">Daftar Diskusi di CODEHUB</span>
                        <button class="btn btn-buat-diskusi btn-sm btn-success" data-logined="<?= auth_check() ?>">
                            <i class="fas fa-plus"></i>
                            <span>Diskusi Baru</span>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tableDiskusi" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pembuat</th>
                                <th>Kategori</th>
                                <th>Diskusi</th>
                                <th>Status</th>
                                <th>Dibuat Pada</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($threads as $thread) : ?>
                                <?php $id = encrypt($thread->id); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class="user-info">
                                            <img src="<?= $thread->user->photo ?>">
                                            <div class="user-name">
                                                <span><?= $thread->user->full_name ?></span>
                                                <a href="<?= base_url("{$thread->user->username}") ?>" target="_blank" style="font-size: 12px;">
                                                    <?= $thread->user->username ?>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $thread->category->name ?></td>
                                    <td>
                                        <button type="button" class="btn" style="background-color: transparent !important" data-toggle="modal" data-target="#DiskusiId<?= $thread->id ?>">
                                            <a style="color: #14b8a6;">Lihat...</a>
                                        </button>
                                    </td>
                                    <td><?= $thread->status ?></td>
                                    <td><?= waktu($thread->created_at, 'l, d F Y', false) ?></td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item btn-edit-diskusi" href="javascript:void(0);" data-id="<?= $id ?>">
                                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                </a>

                                                <button type="button" value="<?= $id ?>" class="dropdown-item py-1 btn-delete" data-name=" <?= $thread->name ?>" data-id="<?= $thread->id ?>" data-action="<?= route_to('admin.diskusi.destroy') ?>">
                                                    <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                </button>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade modal-laporan" role="dialog" id="DiskusiId<?= $thread->id ?>">

                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header p-2">
                                                <div class="modal-header-responsive">
                                                    <div class="modal-title d-flex align-items-center ml-2">
                                                        <div id="title" class="mx-1 text-truncate">Diskusi</div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-lg-6">
                                                        <div class="user-info">
                                                            <img src="<?= $thread->user->photo ?>">
                                                            <div class="user-name">
                                                                <span><?= $thread->user->full_name ?> • <span class="small"><?= ago($thread->created_at) ?></span></span>
                                                                <a href="<?= base_url("{$thread->user->username}") ?>" target="_blank" style="font-size: 12px;">
                                                                    <?= $thread->user->username ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="content">
                                                    <a class="thread-link" href="<?= $thread->status === "published" ? route_to('diskusi.show', $thread->slug) : 'javascript:void(0);' ?>">
                                                        <h3 class="thread-comment-title text-capitalize text-dark">
                                                            <?= $thread->title ?>
                                                        </h3>
                                                    </a>
                                                    <div class="tag d-flex mb-2">
                                                        <div class="category mr-2">
                                                            <a href="<?= route_to("kategori.show", $thread->category->slug) ?>">
                                                                <i class="fas fa-bookmark"></i>
                                                                <?= $thread->category->name ?>
                                                            </a>
                                                        </div>
                                                        <div class="tags d-flex">
                                                            <?php if ($thread->tags) : ?>
                                                                <?php foreach ($thread->tags as $tag) : ?>
                                                                    <a href="javascript:void(0)" class="mr-2">
                                                                        # <?= $tag->name ?>
                                                                    </a>
                                                                <?php endforeach ?>
                                                            <?php endif; ?>
                                                        </div>

                                                    </div>
                                                    <div class="thread-comment">
                                                        <?= ($thread->content) ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer p-1">
                                                <div class="col-lg-6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div></div>

                                                        <div class="thread-tengah">
                                                            <?= buttonLike($thread) ?>

                                                            <button class="btn btn-reply-thread comment" data-id="<?= encrypt($thread->id) ?>">
                                                                <a class="thread-link" href="<?= $thread->status === "published" ? route_to('diskusi.show', $thread->slug) : 'javascript:void(0);' ?>">
                                                                    <i class="far fa-comment"></i>
                                                                </a>
                                                                <small><?= number_short($thread->count_replies) ?></small>
                                                            </button>

                                                            <button class="btn views cursor-default">
                                                                <i class="fas fa-eye"></i>
                                                                <small><?= number_short($thread->views) ?></small>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<?= view('backend/diskusi/edit', ['detail' => false]) ?>

<script>
    const btnDelete = $(".btn-delete");
    const table = $("#tableDiskusi").DataTable({
        language: {
            url: `${origin}/plugins/datatables/datatables-language/idn.json`
        },
    });

    btnDelete.on("click", function(e) {
        e.preventDefault();
        const id = $(this).val();
        const name = $(this).data("name");
        const message = `Apakah kamu yakin ingin menghapus Diskusi <strong>${name}</strong>?`;
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
</script>
<?= $this->endSection()  ?>