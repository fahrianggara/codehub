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
            <p class="card-text mb-1">Total Diskusi: <?= count($user->threads) ?></p>
            <p class="card-text mb-0">Sedang Login? <?= session()->get('logged_in') == 1 ? 'Ya' : "Tidak" ?></p>

            <?php if (session()->get('logged_in')): ?>
                <form action="<?= base_url('logout') ?>" method="post" class="mt-3">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?= base_url('login') ?>" class="btn btn-primary btn-sm mt-3">Login</a>
            <?php endif; ?>
            
        </div>
    </div>
</div>

<?php $this->endSection(); ?>