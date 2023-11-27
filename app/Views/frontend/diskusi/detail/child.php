<?php $user = $child->user;
$parent_user = $child->parent->user; ?>

<li>
    <div class="thread-reply-box">
<<<<<<< HEAD
        <div class="mb-2 mt-1 d-flex align-items-center justify-content-between">
            <a class="thread-author" href="<?= route_to('profile', $user->username) ?>">
=======
        <div class="thread-reply-box-header">
            <a class="thread-author" href="<?= route_to('profile',$user->username) ?>">
>>>>>>> ae34ca0c437169a6ee1f21e43f8ce10454eff978
                <img class="mr-2 profile-pic-detail" src="<?= $user->photo ?>">
                <div class="name-content">
                    <div class="author-name text-truncate">
                        <?= $user->username ?>
                        <?= isAuthor($thread, $user) ? '<i class="fas fa-pen"></i>' : '' ?>
                        <?= isYou($child) ? "<span class='badge-thread text-secondary'>KAMU</span>" : '' ?>
                    </div>
                    <div class="thread-count text-truncate">
                        <?= ago($child->created_at) ?>
                    </div>
                </div>
            </a>
            <div class="btn-group dropleft">
                <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <?php if (auth_check() && auth()->id === $child->user_id) : ?>
                        <a class="dropdown-item btn-edit-balasan" href="javascript:void(0);" data-id="<?= base64_encode($child->id) ?>">
                            <i class="fas text-warning fa-pen mr-2"></i> Edit
                        </a>

                        <a class="dropdown-item btn-hapus-balasan" href="javascript:void(0);" data-id="<?= base64_encode($child->id) ?>">
                            <i class="fas text-danger fa-trash mr-2"></i> Hapus
                        </a>

                        <div class="dropdown-divider"></div>
                    <?php endif ?>
                    <a id="btnLaporkan" class="dropdown-item btn-report-diskusi" href="javascript:void(0);" data-id="<?= base64_encode($child->id) ?>" data-model="<?= base64_encode(getClass($child)) ?>" data-logined="<?= auth_check() ?>" data-pelaku="<?= base64_encode($child->user_id) ?>">
                        <i class="fas text-warning fa-exclamation-triangle mr-2"></i>
                        Laporkan
                    </a>
                </div>
            </div>
        </div>
        <div class="thread-comment thread-reply-box-body d-block">
            <div class=" ">
                <a href="<?= route_to('profile', $parent_user->username) ?>" class="reply-username">@<?= $parent_user->username ?></a>
                <?= $child->content ?>
            </div>
<<<<<<< HEAD
        </div>
        <div class="thread-action d-flex justify-content-between align-items-center">
            <div></div>
            <div class="thread-tengah">
                <?= buttonLike($child) ?>
                <button class="btn btn-reply-thread-child" data-thread_id="<?= base64_encode($child->thread->id) ?>" data-reply_id="<?= base64_encode($child->id) ?>" data-child_id="<?= base64_encode($child->child_id) ?>" data-parent_id="<?= base64_encode($child->id)  ?>" data-username="<?= $user->username ?>">
                    <small>Balas</small>
                </button>
=======
            <div class="thread-action d-flex justify-content-between align-items-center">
                <div></div>
                <div class="thread-tengah">
                    <?= buttonLike($child) ?>
                    <button class="btn btn-reply-thread-child"
                        data-thread_id="<?= base64_encode($child->thread->id) ?>"
                        data-reply_id="<?= base64_encode($child->id) ?>"
                        data-child_id="<?= base64_encode($child->child_id) ?>"
                        data-parent_id="<?= base64_encode($child->id)  ?>"
                        data-username="<?= $user->username ?>">
                        <small>Balas</small>
                    </button>
                </div>
>>>>>>> ae34ca0c437169a6ee1f21e43f8ce10454eff978
            </div>
        </div>
    </div>
</li>