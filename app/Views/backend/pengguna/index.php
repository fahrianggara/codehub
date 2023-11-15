<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2">Daftar pengguna di CODEHUB</span>
                        <a href="<?= route_to('admin.pengguna') ?>" class="btn btn-sm btn-success">
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
                                <th>Bergabung Pada</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class="user-info">
                                            <img src="<?= $user->photo ?>">
                                            <div class="user-name">
                                                <span><?= $user->full_name ?></span>
                                                <small><?= $user->username ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $user->email ?></td>
                                    <td><?= ucfirst($user->role) ?></td>
                                    <td><?= waktu($user->created_at, 'l, d F Y', false) ?></td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button class="btn btn-sm btn-more dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="<?= base_url("admin/pengguna/edit/" . base64_encode($user->id)) ?>" class="dropdown-item py-1">
                                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                </a>
                                                <button type="button" value="<?= base64_encode($user->id) ?>" class="dropdown-item py-1 btn-delete"
                                                    data-name="<?= $user->full_name ?>" data-username="<?= $user->username ?>" 
                                                    data-action="<?= route_to('admin.pengguna.destroy') ?>">
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
    const table = $("#tablePengguna").DataTable();
</script>

<?= $this->endSection() ?>