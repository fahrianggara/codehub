
<div class="modal fade modal-logout">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Hmmm <?= auth()->full_name ?>, apakah kamu yakin ingin keluar dari CODEHUB?
            </div>
            <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                <a href="<?= route_to('logout') ?>" type="button" class="btn btn-danger btn-logout">
                    Keluar

                    <form id="logout-form" action="<?= route_to('logout') ?>" method="POST" class="d-none">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js') ?>

<script>
    const logoutButton = document.querySelectorAll('#logoutButton');
    const logoutModal = $(".modal-logout");

    for (let i = 0; i < logoutButton.length; i++) {
        logoutButton[i].addEventListener('click', function(e) {
            e.preventDefault();

            logoutModal.modal('show');
        });
    }

    $('.btn-logout').on('click', function(e) {
        e.preventDefault();
        $('#logout-form').submit();
    });
</script>

<?= $this->endSection() ?>