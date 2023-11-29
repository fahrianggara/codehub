<?= $this->section('js') ?>

<div class="modal fade modal-diskusi-reply" role="dialog" data-view-thread="<?= $view_thread ?? false ?>"
    aria-hidden="true" data-backdrop="static" data-keyboard="false" data-logined="<?= auth_check() ? true : false ?>">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content" method="POST" autocomplete="off" action="<?= route_to('diskusi.reply') ?>">
            
            <?= csrf_field() ?>
            <input type="hidden" name="thread_id" id="thread_id">
            <input type="hidden" name="child_id" id="child_id">
            <input type="hidden" name="parent_id" id="parent_id">

            <div class="modal-header p-2">
                <div class="modal-header-responsive">
                    <div class="modal-title d-flex align-items-center ml-2">
                        <i class="fas fa-comment text-primary mr-1"></i>
                        <?php if ($view_thread): ?>
                            <div id="title" class="mx-1 text-truncate"></div>
                        <?php else: ?>
                            <div id="title" class="mx-1 text-truncate">Balas Diskusi</div>
                        <?php endif ?>
                    </div>
                </div>
                <button type="button" class="btn btn-primary modal-close-reply">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <?php if ($view_thread): ?>
                    <div class="form-group thread">
                        <ul class="list-group mt-2">
                            <li class="list-group-item ">
                                <div class="item-content mb-2 d-flex align-items-center justify-content-between">
                                    <div class="name-content d-flex flex-row align-items-center">
                                        <span id="author" class="mr-1"></span> • <span id="date" class="thread-count ml-1"></span>
                                    </div>
                                </div>
                                <div id="content" class="thread-comment d-block"></div>
                            </li>
                        </ul>
                    </div>
                <?php endif ?>

                <div class="form-group mb-0">
                    <?= $view_thread ? '<label for="content-reply">Komentar</label>' : '' ?>
                    <textarea name="content" class="form-control" rows="3" id="content-reply"
                        placeholder="Masukkan komentar anda.."></textarea>
                </div>
            </div>

            <div class="modal-footer p-1">
                <button type="submit" class="btn btn-success">
                    Kirim Balasan <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('js/fe/diskusi/reply.js') ?>"></script>

<?= $this->endSection() ?>
