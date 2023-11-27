

<?php if ($threads): ?>
    <ul class="list-group">
        <?php foreach ( $threads as $thread ): ?>
            <?php $thread_id = base64_encode($thread->id) ?>

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
                        <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                            data-display="static">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right">

                            <?php if (auth_check() && auth()->id === $user->id): ?>
                                <a class="dropdown-item btn-edit-diskusi" href="javascript:void(0);"
                                    data-id="<?= $thread_id ?>">
                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                </a>

                                <a class="dropdown-item btn-hapus-diskusi" href="javascript:void(0);"
                                    data-id="<?= $thread_id ?>">
                                    <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                </a>

                                <?php if ($thread->status === 'published'): ?> 
                                    <a class="dropdown-item btn-draft-diskusi" href="javascript:void(0);"
                                        data-id="<?= $thread_id ?>">
                                        <i class="fas text-secondary fa-archive mr-2"></i> Arsipkan
                                    </a>
                                <?php else: ?> 
                                    <a class="dropdown-item btn-publish-diskusi" href="javascript:void(0);"
                                        data-id="<?= $thread_id ?>">
                                        <i class="fas text-success fa-upload mr-2"></i> Publikasikan
                                    </a>
                                <?php endif ?>

                                <div class="dropdown-divider"></div>
                            <?php endif ?>

                            <a class="dropdown-item btn-share-diskusi" href="javascript:void(0);">
                                <i class="fas text-info fa-share mr-2"></i>
                                Bagikan
                            </a>
                            
                            <a class="dropdown-item" href="<?= route_to('diskusi.show', $thread->slug) ?>">
                                <i class="fas text-primary fa-external-link-alt mr-2"></i>
                                Lihat
                            </a>

                            <a class="dropdown-item btn-report-diskusi" href="javascript:void(0);">
                                <i class="fas text-warning fa-exclamation-triangle mr-2"></i>
                                Laporkan
                            </a>
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
                        <a href="javascript:void(0)">
                            <i class="fas fa-bookmark"></i>
                            <?= $thread->category->name ?? 'Kategori' ?>
                        </a>
                    </li>

                    <?php if ($thread->tags): ?>
                        <?php foreach ($thread->tags as $tag): ?>
                            <li>
                                <a href="javascript:void(0)">
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

                        <button class="btn btn-reply-thread comment" data-id="<?= base64_encode($thread->id) ?>"
                            data-url="<?= route_to('diskusi.reply-show') ?>">
                            <i class="far fa-comment"></i>
                            <small><?= $thread->count_replies ?></small>
                        </button>

                        <button class="btn views cursor-default">
                            <i class="fas fa-eye"></i>
                            <small><?= $thread->views ?></small>
                        </button>
                    </div>
                </div>
            </li>
        <?php endforeach ?>                   
    </ul>

    <?= $pager->only(['status', 'order', 'category'])->links('user-thread', 'pg_profile') ?>
<?php else: ?>
    <div class="alert alert-warning">
        <i class="fas fa-info-circle mr-2"></i>
        <span>Belum ada diskusi yang di <?= $displayStatus = ($status_selected === 'draft') ? 'arsip' : (($status_selected === 'published') ? 'publikasikan' : ''); ?>.</span>
    </div>
<?php endif ?>

<?= $this->section('js') ?>
    <?= view('frontend/diskusi/reply-modal', ['view_thread' => true]) ?>

    <?php if (auth_check()): ?>
        <?= view('frontend/diskusi/edit', ['detail' => false]) ?>
        <script src="<?= base_url('js/fe/diskusi/delete.js') ?>"></script>
        <script src="<?= base_url('js/fe/diskusi/status.js') ?>"></script>
    <?php endif ?>

    <script>
        $(".thread-link[href='javascript:void(0);']").on('click', function(e) {
            e.preventDefault();
            alertifyLog("Dark", "Diskusi belum dipublikasikan.");
        });
    </script>

<?= $this->endSection() ?>