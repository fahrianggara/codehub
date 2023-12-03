<?php if ($threads) : ?>
    <ul class="list-group mt-2">
        <?php foreach ($threads as $thread) : ?>
            <?php $thread_id = encrypt($thread->id) ?>

            <li class="list-group-item ">
                <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">

                    <a class="thread-author d-flex align-items-center" href="<?= route_to("profile", $thread->user->username) ?>">
                        <img class="mr-2 profile-pic-detail" src="<?= $thread->user->photo ?>">
                        <div class="name-content">
                            <span class="author-name">
                                <?= $thread->user->username ?>
                                <?= isYou($thread) ? "<span class='badge-thread text-main'>KAMU</span>" : '' ?>
                            </span>
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

                                    <div class="dropdown-divider"></div>
                                <?php endif ?>
                            <?php endif ?>

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
                        </div>
                    </div>
                </div>

                <a class="thread-link" href="<?= route_to('diskusi.show', $thread->slug) ?>">
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

                        <button <?= $thread->status === "draft" ? "disabled" : ''  ?> class="btn btn-reply-thread comment" data-id="<?= encrypt($thread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
                            <i class="far fa-comment"></i>
                            <small><?= number_short($thread->count_replies) ?></small>
                        </button>

                        <button class="btn views cursor-default">
                            <i class="fas fa-eye"></i>
                            <small><?= number_short($thread->views) ?></small>
                        </button>

                        <button class="btn btn-sm btn-share-diskusi" type="button" data-toggle="tooltip" title="Bagikan Diskusi"
                            data-url="<?= base_url("d/$thread->slug") ?>">
                            <i class="bi bi-share-fill"></i>
                        </button>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

    <?= $pager->links('thread', 'pg_home') ?>
<?php else : ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="no-result" style="margin-top: 20px; margin-bottom: 30px;">
                <img src="<?= base_url('images/nodiscussion.png') ?>" alt="Tidak ada Diskusi" class="img-fluid">
                <h3>Apa.. Diskusi Kosong ?</h3>
                <p>
                    Hmm.. sepertinya belum ada yang membuat diskusi di CODEHUB.
                    Yuk, buat diskusi pertama kamu sekarang!
                </p>
                <a href="javascript:void(0);" class="btn btn-buat-diskusi in-home" data-logined="<?= auth_check() ?>">
                    <i class="fas fa-plus"></i>
                    Buat Diskusi
                </a>
            </div>
        </div>
    </div>
<?php endif ?>