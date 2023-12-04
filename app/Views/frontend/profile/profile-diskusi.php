<?php if ($threads) : ?>
    <ul class="list-group">
        <?php foreach ($threads as $thread) : ?>
            <?php $thread_id = encrypt($thread->id); ?>

            <li class="list-group-item ">
                <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">

                    <a class="thread-author d-flex align-items-center" href="javascript:void(0)">
                        <img class="mr-2 profile-pic-detail" src="<?= $thread->user->photo ?>">
                        <div class="name-content">
                            <span class="author-name"><?= $thread->user->username ?></span>
                            <span class="thread-count">
                                <?= ago($thread->created_at) ?>
                            </span>
                        </div>
                    </a>

                    <div class="btn-group dropleft">
                        <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right">
                            <?php if (auth_check()) : ?>
                                <?php if (auth()->id === $thread->user_id): ?>
                                    <a class="dropdown-item btn-edit-diskusi" href="javascript:void(0);" 
                                        data-id="<?= $thread_id ?>">
                                        <i class="fas text-warning fa-pen mr-2"></i> Edit
                                    </a>
                                <?php endif ?>

                                <?php if (auth()->id === $thread->user_id || auth()->role === 'admin'): ?>
                                    <a class="dropdown-item btn-hapus-diskusi" href="javascript:void(0);" 
                                        data-id="<?= $thread_id ?>">
                                        <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                    </a>
                                <?php endif ?>

                                <?php if (auth()->id === $thread->user_id) : ?>
                                    <?php if ($thread->status === 'published') : ?>
                                        <a class="dropdown-item btn-draft-diskusi" href="javascript:void(0);" data-id="<?= $thread_id ?>">
                                            <i class="fas text-secondary fa-archive mr-2"></i> Arsipkan
                                        </a>
                                    <?php else : ?>
                                        <a class="dropdown-item btn-publish-diskusi" href="javascript:void(0);" data-id="<?= $thread_id ?>">
                                            <i class="fas text-success fa-upload mr-2"></i> Publikasikan
                                        </a>
                                    <?php endif ?>
                                <?php endif ?>

                                <?php if ($thread->status === "published"): ?>
                                    <div class="dropdown-divider"></div>
                                <?php endif ?>
                            <?php endif ?>

                            <?php if ($thread->status === "published"): ?>
                                <a class="dropdown-item" href="<?= route_to('diskusi.show', $thread->slug) ?>">
                                    <i class="fas text-primary fa-external-link-alt mr-2"></i>
                                    Lihat
                                </a>

                                <a id="btnLaporkan" class="dropdown-item btn-report-diskusi" href="javascript:void(0);" 
                                    data-id="<?= $thread_id ?>" data-model="<?= encrypt(getClass($thread)) ?>"
                                    data-logined="<?= auth_check() ?>" data-pelaku="<?= encrypt($thread->user_id) ?>">
                                    <i class="fas text-warning fa-exclamation-triangle mr-2"></i>
                                    Laporkan
                                </a>
                            <?php endif ?>

                        </div>
                    </div>
                </div>

                <a class="thread-link" href="<?= $thread->status === "published" ? route_to('diskusi.show', $thread->slug) : 'javascript:void(0);' ?>">
                    <h3 class="thread-comment-title">
                        <?= $thread->title ?>
                    </h3>
                    <div class="thread-comment">
                        <?= text_limit($thread->content) ?>
                    </div>
                </a>

                <ul class="thread-categories">
                    <li>
                        <a href="<?= route_to("kategori.show", $thread->category->slug) ?>">
                            <i class="fas fa-bookmark"></i>
                            <?= $thread->category->name ?>
                        </a>
                    </li>

                    <?php if ($thread->tags) : ?>
                        <?php foreach ($thread->tags as $tag) : ?>
                            <li>
                                <a href="<?= route_to('tag.show', $tag->slug) ?>">
                                    <?= $tag->name ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php endif; ?>
                </ul>

                <div class="thread-action d-flex justify-content-between align-items-center">
                    <div></div>

                    <div class="thread-tengah">
                        <?= buttonLike($thread) ?>

                        <button <?= $thread->status === "draft" ? "disabled" : ''  ?> 
                            class="btn btn-reply-thread comment" data-id="<?= encrypt($thread->id) ?>"
                            data-url="<?= route_to('diskusi.reply-show') ?>">
                            <i class="far fa-comment"></i>
                            <small><?= number_short($thread->count_replies) ?></small>
                        </button>

                        <button class="btn views cursor-default">
                            <i class="fas fa-eye"></i>
                            <small><?= number_short($thread->views) ?></small>
                        </button>

                        <button <?= $thread->status === "draft" ? "disabled" : 'data-toggle="tooltip" title="Bagikan Diskusi"'  ?> 
                            class="btn btn-sm btn-share-diskusi" type="button" data-url="<?= base_url("d/$thread->slug") ?>">
                            <i class="bi bi-share-fill"></i>
                        </button>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

    <?= $pager->only(['status', 'order', 'category'])->links('user-thread', 'pg_profile') ?>
<?php else : ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="no-result" style="margin-top: 20px; margin-bottom: 30px;">
                <img src="<?= base_url('images/nodiscussion.png') ?>" alt="Tidak ada Diskusi" class="img-fluid">

                <?php if ($status_selected === 'published'): ?> <!-- jika status published -->
                    <?php if (auth_check() && $user->id === auth()->id) : ?> <!-- jika sedang login -->
                        <?php if ($user->getThreads('all')) : ?> <!-- jika ada tapi di draft -->
                            <h3>Apa.. Kosong ?</h3>
                            <p>Hmm.. sepertinya belum ada diskusi yang kamu publikasikan disini. Silahkan publish diskusi kamu yang di arsipkan atau engga buat diskusi baru.</p>
                            <a href="javascript:void(0);" class="btn btn-buat-diskusi in-home" data-logined="<?= auth_check() ?>">
                                <i class="fas fa-plus"></i>
                                Buat Diskusi
                            </a>
                        <?php else: ?> <!-- jika belum ada -->
                            <h3>Duh.. Masih kosong disini :(</h3>
                            <p>Yuk <?= $user->full_name ?>, buat diskusi pertama kamu di Codehub. Harus sopan ya isi kontennya..</p>
                            <a href="javascript:void(0);" class="btn btn-buat-diskusi in-home" data-logined="<?= auth_check() ?>">
                                <i class="fas fa-plus"></i>
                                Buat Diskusi
                            </a>
                        <?php endif ?>
                    <?php else : ?> <!-- jika guest atau orang lain -->
                        <h3>Yahh.. Kosong :(</h3>
                        <p>
                            Sepertinya belum ada diskusi yang di buat oleh <?= $user->full_name ?>.
                        </p>
                    <?php endif ?>
                <?php else: ?> <!-- jika status arsip -->
                    <h3>Kosong disini ?</h3>
                    <p>Hmm.. sepertinya belum ada diskusi yang kamu arsipkan disini.</p>
                <?php endif ?>
                
            </div>
        </div>
    </div>
    <!-- <div class="alert alert-warning">
        <i class="fas fa-info-circle mr-2"></i>
        <span>Belum ada diskusi yang di <?= $displayStatus = ($status_selected === 'draft') ? 'arsip' : (($status_selected === 'published') ? 'publikasikan' : ''); ?>.</span>
    </div> -->
<?php endif ?>

<?= $this->section('js') ?>

    <?= view('frontend/diskusi/reply-modal', ['view_thread' => true]) ?>
    <?= view('frontend/diskusi/laporan') ?>

    <?php if (auth_check()) : ?>
        <?= view('frontend/diskusi/edit', ['detail' => false]) ?>
        <script src="<?= base_url('js/fe/diskusi/delete.js') ?>"></script>
        <script src="<?= base_url('js/fe/diskusi/status.js') ?>"></script>
    <?php endif ?>

    <script>
        $(".thread-link[href='javascript:void(0);']").on('click', function(e) { // for status draft
            e.preventDefault();
            alertifyLog("Dark", "Diskusi belum dipublikasikan.", () => {
                $("body").css("overflow", "auto");
            });
        });
    </script>

<?= $this->endSection() ?>