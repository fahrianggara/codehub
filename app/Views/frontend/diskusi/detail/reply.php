<?php $user = $reply->user; ?>

<li class="thread-list">
    <div class="thread-reply-box main-reply">
        <div class="thread-reply-box-header">
            <a class="thread-author" href="<?= route_to('profile',$user->username) ?>">
                <img class="mr-2 profile-pic-detail" src="<?= $user->photo ?>">
                <div class="name-content">
                    <div class="author-name text-truncate">
                        <?= $user->username ?> 
                        <?= isAuthor($thread, $user) ? '<i class="fas fa-pen"></i>' : '' ?>
                        <?= isYou($reply) ? "<span class='badge-thread text-secondary'>KAMU</span>" : '' ?>
                    </div>
                    <div class="thread-count text-truncate">
                        <?= ago($reply->created_at) ?>
                    </div>
                </div>
            </a>
            <div class="btn-group dropleft">
                <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false" data-display="static">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <?php if (auth_check()): ?>
                        <?php if (auth()->id === $reply->user_id): ?>
                            <a class="dropdown-item btn-edit-balasan" href="javascript:void(0);"
                                data-id="<?= encrypt($reply->id) ?>">
                                <i class="fas text-warning fa-pen mr-2"></i> Edit
                            </a>
                        <?php endif ?>

                        <?php if (auth()->id === $reply->user_id || auth()->role === 'admin'): ?>
                            <a class="dropdown-item btn-hapus-balasan" href="javascript:void(0);"
                                data-id="<?= encrypt($reply->id) ?>">
                                <i class="fas text-danger fa-trash mr-2"></i> Hapus
                            </a>
                            <div class="dropdown-divider"></div>
                        <?php endif ?>
                    <?php endif ?>
                    
                    <a id="btnLaporkan" class="dropdown-item btn-report-diskusi" href="javascript:void(0);" 
                        data-id="<?= encrypt($reply->id) ?>" data-model="<?= encrypt(getClass($reply)) ?>" 
                        data-logined="<?= auth_check() ?>" data-pelaku="<?= encrypt($reply->user_id) ?>">
                        <i class="fas text-warning fa-exclamation-triangle mr-2"></i>
                        Laporkan
                    </a>
                </div>
            </div>
        </div>
        <div class="thread-reply-box-body">
            <div class="thread-comment d-block">
                <?= $reply->content ?>
            </div>
            <div class="thread-action d-flex justify-content-between align-items-center">
                <div></div>
                <div class="thread-tengah">
                    <?= buttonLike($reply) ?>
                    <button class="btn btn-reply-thread-child" 
                        data-thread_id="<?= encrypt($reply->thread->id) ?>" 
                        data-reply_id="<?= encrypt($reply->id) ?>"
                        data-child_id="<?= encrypt($reply->id) ?>"
                        data-parent_id="<?= encrypt($reply->id ?? null)  ?>"
                        data-username="<?= $user->username ?>">
                        <small>Balas</small>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php if ($reply->childs): ?> <!-- if reply has childs -->
        <ul class="thread-reply thread-sub">
            <?php foreach($reply->childs as $child): ?>
                <?= view('frontend/diskusi/detail/child', ['child' => $child]) ?>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>
</li>