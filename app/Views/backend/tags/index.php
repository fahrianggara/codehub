<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2">Daftar Tagar Diskusi pada CODEHUB</span>
                        <a href="<?= route_to('admin.Tags.create') ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-plus mr-1"></i>
                            Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tableTags" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tagar</th>
                                <th>Tagar URL</th>
                                <th>Diskusi Dipakai</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($tags as $tag) : ?>
                                <?php $id = encrypt($tag->id); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $tag->name ?></td>
                                    <td>
                                        <?php if ($tag->threads): ?>
                                            <a href="<?= route_to('tag.show', $tag->slug) ?>" target="_blank" class="url-slug"><?= $tag->slug ?></a>
                                        <?php else: ?>
                                            <?= $tag->slug ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= count($tag->threads) ?></td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                <button type="button" value="<?= $id ?>" class="dropdown-item py-1 btn-delete" data-id="<?= $tag->id ?>" 
                                                    data-action="<?= route_to('admin.Tags.destroy') ?>" data-tag-name="<?= $tag->name ?>"
                                                    style="border-radius: 8px;">
                                                    <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                </button>
                                            </button>
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
    const table = $("#tableTags").DataTable({
        language: {
            url: `${origin}/plugins/datatables/datatables-language/idn.json`
        },
    });

    btnDelete.on("click", function(e) {
        e.preventDefault();

        const id = $(this).val();
        const tagName = $(this).data("tag-name");
        const message = `Apakah kamu yakin ingin menghapus tag <strong>${tagName}</strong>?`;
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

<?= $this->endSection() ?>
