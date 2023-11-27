<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content') ?>

<section class="homepage first" id="homepage">
    <div class="thread container-fluid">
        <div class="row justify-content-center">

            <div class="col-xl-3 col-lg-4 col-md-12 mb-3 order-lg-1 order-3">
                <div class="sticky">
<<<<<<< HEAD
                    <button class="btn btn-reply-thread in-side mb-3" type="button" data-id="<?= base64_encode($thread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
=======
                    <button class="btn btn-reply-thread in-side mb-3" type="button" 
                        data-id="<?= encrypt($thread->id) ?>">
                        <i class="fas fa-comment mr-2"></i> Balas Diskusi Ini..
                    </button>

                    <div class="thread-header mb-2 list-group-item">
                        Diskusi Lainnya
                    </div>

                    <ul class="list-group mb-3">
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <div class="text-content">
                                    <span class="name">Lorem ipsum dolor, sit amet consectetur?</span>
                                    <span class="thread-count">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, magnam.
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <div class="text-content">
                                    <span class="name">Lorem ipsum dolor sit amet.</span>
                                    <span class="thread-count">Lorem ipsum dolor sit, amet consectetur adipisicing
                                        elit.
                                        Dolorem, impedit.</span>
                                </div>
                            </a>
                        </li>
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <div class="text-content">
                                    <span class="name">Lorem, ipsum dolor sit amet consectetur adipisicing
                                        elit.</span>
                                    <span class="thread-count">Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit.
                                        Cumque, dolor!</span>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="thread-header mb-2 list-group-item">
                        3 Kategori Teratas
                    </div>

                    <ul class="list-group mb-3">
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <img class="mr-2" src="<?= base_url('images/empty.png') ?>">
                                <div class="text-content">
                                    <span class="name">Artificial Intelligence</span>
                                    <span class="thread-count">50 Diskusi digunakan</span>
                                </div>
                            </a>
                        </li>
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <img class="mr-2" src="<?= base_url('images/empty.png') ?>">
                                <div class="text-content">
                                    <span class="name">Machine Learning</span>
                                    <span class="thread-count">40 Diskusi digunakan</span>
                                </div>
                            </a>
                        </li>
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <img class="mr-2" src="<?= base_url('images/empty.png') ?>">
                                <div class="text-content">
                                    <span class="name">Web Programming</span>
                                    <span class="thread-count">35 Diskusi digunakan</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-7 col-lg-8 col-md-12 mb-3 order-lg-2 order-1">
                <div class="thread-header-panel">
                    <div class="thread-message">
                        <span><?= $user->username ?> memulai diskusi ini <?= ago($thread->created_at) ?>.</span>
                    </div>
                    <div class="thread-info">
                        <ul>
                            <li><i class="fas fa-eye"></i> <?= $thread->views ?></li>
                            <li><i class="fas fa-comments"></i> <?= $thread->count_replies ?></li>
                            <li><a href="<?= route_to("kategori.show", $category->slug) ?>"><?= $category->name ?></a></li>
                        </ul>
                    </div>
                </div>

                <ul class="list-group thread-reply">
                    <li>
                        <div class="thread-reply-box">
                            <div class="thread-reply-box-header">
                                <a class="thread-author" href="<?= route_to('profile', $user->username) ?>">
                                    <img class="mr-2 profile-pic-detail" src="<?= $user->photo ?>">
                                    <div class="name-content">
                                        <div class="author-name text-truncate">
                                            <?= $user->username ?>
                                            <?= isAuthor($thread, $user) ? '<i class="fas fa-pen"></i>' : '' ?>
                                            <?= isYou($thread) ? "<span class='badge-thread text-secondary'>KAMU</span>" : '' ?>
                                        </div>
                                        <div class="thread-count text-truncate"><?= ago($thread->created_at) ?></div>
                                    </div>
                                </a>    
                                <div class="btn-group dropleft">
                                    <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php if (isAuthor($thread, $user) && (auth_check() && auth()->id === $thread->user_id)): ?>
                                            <a class="dropdown-item btn-edit-diskusi" href="javascript:void(0);"
                                                data-id="<?= encrypt($thread->id) ?>">
                                                <i class="fas text-warning fa-pen mr-2"></i> Edit
                                            </a>

                                            <div class="dropdown-divider"></div>
                                        <?php endif ?>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="fas text-info fa-share mr-2"></i>
                                            Bagikan
                                        </a>
                                        <a id="btnLaporkan" class="dropdown-item btn-report-diskusi" href="javascript:void(0);" data-id="<?= base64_encode($thread->id) ?>" data-model="<?= base64_encode(getClass($thread)) ?>" data-logined="<?= auth_check() ?>" data-pelaku="<?= base64_encode($thread->user_id) ?>">
                                            <i class="fas text-warning fa-exclamation-triangle mr-2"></i>
                                            Laporkan
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="thread-reply-box-body">
                                <div>
                                    <h3 class="thread-comment-title m-0 mb-2">
                                        <?= $thread->title ?>
                                    </h3>
                                    <div class="thread-comment d-block">
                                        <?= $thread->content ?>
                                    </div>
                                </div>
<<<<<<< HEAD
                            </div>
                            <div class="thread-action d-flex justify-content-between align-items-center">
                                <ul class="thread-categories">
                                    <li class="d-none"></li>
                                    <?php if ($thread->tags) : ?>
                                        <?php foreach ($thread->tags as $tag) : ?>
                                            <li class="mb-0">
                                                <a href="javascript:void(0)">
                                                    <?= $tag->name ?>
                                                </a>
                                            </li>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </ul>
                                <div class="thread-tengah">
                                    <?= buttonLike($thread) ?>
=======
                                <div class="thread-action d-flex justify-content-between align-items-center">
                                    <ul class="thread-categories">
                                        <li class="d-none"></li>
                                        <?php if ($thread->tags): ?>
                                            <?php foreach ($thread->tags as $tag): ?>
                                                <li class="mb-0">
                                                    <a href="javascript:void(0)">
                                                        <?= $tag->name ?>
                                                    </a>
                                                </li>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="thread-tengah">
                                        <?= buttonLike($thread) ?>
                                    </div>
>>>>>>> ae34ca0c437169a6ee1f21e43f8ce10454eff978
                                </div>
                            </div>
                        </div>
                    </li>

                    <?php if ($thread->replies) : ?>
                        <?php foreach ($thread->replies as $reply) : ?>
                            <?= view('frontend/diskusi/detail/reply', ['reply' => $reply, 'thread' => $thread]) ?>
                        <?php endforeach ?>
                    <?php endif; ?>

                    <li>
                        <button class="btn-reply-thread" type="button" data-id="<?= encrypt($thread->id) ?>" 
                            data-url="<?= route_to('diskusi.reply-show') ?>">
                            <img src="<?= auth_check() ? auth()->photo : base_url('images/avatar.png') ?>"> 
                            Balas Diskusi Ini..
                        </button>
                    </li>
                </ul>

            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->include('frontend/diskusi/laporan') ?>

<?php if (auth_check()) : ?>
    <?= view('frontend/diskusi/reply-edit') ?>
    <?= view('frontend/diskusi/edit', ['detail' => true]) ?>
<?php endif; ?>

    <button class="btn-reply-thread fixed" type="button" data-id="<?= encrypt($thread->id) ?>" 
        data-url="<?= route_to('diskusi.reply-show') ?>">
        <i class="fas fa-comment"></i>
    </button>

<?= view('frontend/diskusi/reply-modal', ['view_thread' => false]) ?>

<script src="<?= base_url('js/fe/diskusi/reply-delete.js') ?>"></script>

<?= $this->endSection() ?>