<?php $this->extend('layouts/frontend') ?>

<?php $this->section('content'); ?>


<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card" style="width: 20rem;">
        <img src="<?= $user->getAvatar() ?>" class="card-img-top" alt="Foto Profil">
        <div class="card-body">
            <h5 class="card-title"><?= $user->getFullName() ?></h5>
            <p class="card-text mb-1">Email: <?= $user->email ?></p>
            <p class="card-text mb-1">Bergabung: <?= $user->getJoinedAt() ?></p>
            <p class="card-text mb-1">Role: <?= ucfirst($user->getRole()->name) ?></p>
            <p class="card-text mb-3">Total Diskusi: <?= count($user->threads) ?></p>
            <a href="javascript:void(0);" class="btn btn-primary">Lihat Profil</a>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>