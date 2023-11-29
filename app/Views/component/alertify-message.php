<?php if (session()->getFlashdata('success')) : ?>
    <div class="alertify-msg success" data-title="Berhasil" 
        data-message="<?= session()->getFlashdata('success') ?>"></div>
<?php elseif (session()->getFlashdata('error')) : ?>
    <div class="alertify-msg error" data-title="Gagal" 
        data-message="<?= session()->getFlashdata('error') ?>"></div>
<?php elseif (session()->getFlashdata('info')) : ?>
    <div class="alertify-msg info" data-title="Informasi"
        data-message="<?= session()->getFlashdata('info') ?>"></div>
<?php endif ?>