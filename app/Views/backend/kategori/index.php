<?= $this->extend('layouts/backend') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2">Daftar Kategori di CODEHUB</span>
                        <a href="<?= route_to('admin.kategori.create') ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-plus mr-1"></i>
                            Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tableKategori" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>Kategori URL</th>
                                <th>Sampul</th>
                                <th>Diskusi Dipakai</th>
                                <th>Dibuat Pada</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($categories as $category) : ?>
                                <?php $id = encrypt($category->id); ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $category->name ?></td>
                                    <td>
                                        <?php if ($category->threads): ?>
                                                <a href="<?= route_to('kategori.show', $category->slug) ?>" target="_blank" class="url-slug"><?= $category->slug ?></a>
                                            <?php else: ?>
                                                <?= $category->slug ?>
                                            <?php endif; ?>
                                        </td>
                                    <td>
                                        <img src="<?= $category->photo ?>" alt="" class="img-fluid" width="80" style="border-radius: 6px;">
                                    </td>
                                    <td><?= count($category->threads) ?></td>
                                    <td><?= waktu($category->created_at, 'l, d F Y', false) ?></td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="<?= route_to('admin.kategori.edit', $id) ?>" class="dropdown-item py-1">
                                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                </a>
                                                <button type="button" value="<?= $id ?>" class="dropdown-item py-1 btn-delete" data-name=" <?= $category->name ?>" data-id="<?= $category->id ?>" data-action="<?= route_to('admin.kategori.destroy') ?>">
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
    const table = $("#tableKategori").DataTable({
        language: {
            url: `${origin}/plugins/datatables/datatables-language/idn.json`
        },
    });

    btnDelete.on("click", function(e) {
        e.preventDefault();
        const id = $(this).val();
        const name = $(this).data("name");
        const message = `Apakah kamu yakin ingin menghapus Kategori <strong>${name}</strong>?`;
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