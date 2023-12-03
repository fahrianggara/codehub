<?php if ($TopThreads): ?>
    <ul class="list-group">
        <?php foreach ($TopThreads as $topThread) : ?>
            <li class="list-group-item">
                <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">

                    <a class="thread-author d-flex align-items-center" href="<?= base_url("{$topThread->user->username}") ?>">
                        <img class="mr-2 profile-pic-detail-kanan" src="<?= $topThread->user->photo ?>">
                        <div class="name-content-kanan text-truncate">
                            <span class="author-name">
                                <?= $topThread->user->username ?>
                                <?= isYou($topThread) ? "<span class='badge-thread text-main'>KAMU</span>" : '' ?>
                            </span>
                            <span class="thread-count"><?= ago($topThread->created_at) ?></span>
                        </div>
                    </a>

                    <div class="btn-group dropleft d-block d-lg-none">
                        <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <?php if (auth_check()) : ?>
                                <?php if (auth()->id === $topThread->user_id): ?>
                                    <a class="dropdown-item btn-edit-diskusi" href="javascript:void(0);" 
                                        data-id="<?= encrypt($topThread->id) ?>">
                                        <i class="fas text-warning fa-pen mr-2"></i> Edit
                                    </a>
                                <?php endif ?>

                                <?php if (auth()->id === $topThread->user_id || auth()->role === 'admin'): ?>
                                    <a class="dropdown-item btn-hapus-diskusi" href="javascript:void(0);" 
                                        data-id="<?= encrypt($topThread->id) ?>">
                                        <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                    </a>

                                    <div class="dropdown-divider"></div>
                                <?php endif ?>
                            <?php endif ?>

                            <a class="dropdown-item" href="javascript:void(0);">
                                <i class="fas text-primary fa-external-link-alt mr-2"></i>
                                Lihat
                            </a>
                            <a id="btnLaporkan" class="dropdown-item btn-report-diskusi" href="javascript:void(0);" data-id="<?= encrypt($topThread->id) ?>" 
                                data-model="<?= encrypt(getClass($topThread)) ?>" 
                                data-logined="<?= auth_check() ?>" 
                                data-pelaku="<?= encrypt($topThread->user_id) ?>">
                                <i class="fas text-warning fa-exclamation-triangle mr-2"></i>
                                Laporkan
                            </a>
                        </div>
                    </div>
                </div>

                <a class="thread-link" href="<?= route_to('diskusi.show', $topThread->slug) ?>">
                    <h3 class="thread-comment-kanan-title">
                        <?= $topThread->title ?>
                    </h3>
                    <div class="thread-comment-kanan">
                        <?= text_limit($topThread->content) ?>
                    </div>
                </a>

                <ul class="thread-categories d-flex d-lg-none">
                    <li>
                        <a href="<?= route_to("kategori.show", $topThread->category->slug) ?>">
                            <i class="fas fa-bookmark"></i>
                            <?= $topThread->category->name ?>
                        </a>
                    </li>
                    <?php if ($topThread->tags) : ?>
                        <?php foreach ($topThread->tags as $tag) : ?>
                            <li>
                                <a href="<?= route_to('tag.show', $tag->slug) ?>">
                                    <?= $tag->name ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php endif; ?>
                </ul>

                <div class="thread-action d-flex justify-content-between align-items-center">
                    <div class=""></div>
                    <div class="thread-kanan">
                        <?= buttonLike($topThread) ?>

                        <button class="btn btn-reply-thread comment" data-id="<?= encrypt($topThread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
                            <i class="far fa-comment"></i>
                            <small><?= number_short($topThread->count_replies) ?></small>
                        </button>

                        <button class="btn views cursor-default">
                            <i class="fas fa-eye"></i>
                            <small><?= number_short($topThread->views) ?></small>
                        </button>

                        <button class="btn btn-sm btn-share-diskusi" type="button" data-toggle="tooltip" title="Bagikan Diskusi" data-url="<?= base_url("d/$topThread->slug") ?>">
                            <i class="bi bi-share-fill"></i>
                        </button>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
<?php else: ?>
    <div class="alert alert-warning">
        <small>Belum ada diskusi yang dibuat.</small>
    </div>
<?php endif ?>