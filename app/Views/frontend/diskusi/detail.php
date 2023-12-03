<?= $this->extend('layouts/frontend') ?>

<?= $this->section('meta') ?>

<meta name="robots" content="index, follow">
<meta name="title" content="<?= $thread->title ?>">
<meta name="description" content="<?= text_limit($thread->content, 200) ?>">
<meta name="author" content="<?= $user->full_name ?>">
<meta name="keywords" content="codehub,<?= "$category->name," ?><?= $thread->tags ? implode(',', array_column($thread->tags, 'name')) : '' ?>">
<meta property="og:type" content="article">
<meta property="og:title" content="<?= $thread->title ?>">
<meta property="og:description" content="<?= text_limit($thread->content, 200) ?>">
<meta property="og:url" content="<?= base_url("d/$thread->slug") ?>">
<meta property="og:image" content="<?= base_url('images/og.png') ?>">
<meta property="og:site_name" content="Codehub">
<link rel="canonical" href="<?= base_url("d/$thread->slug") ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
    $count = $thread->getCountReplies(true);
    $count = $count ? ". $count orang membalas diskusi ini." : "."
?>

<section class="homepage first" id="homepage">
    <div class="thread container-fluid">
        <div class="row justify-content-center">

            <div class="col-xl-3 col-lg-4 col-md-12 mb-3 pr-3 pr-md-normal order-lg-1 order-3">
                <div class="sticky">

                    <button class="btn btn-reply-thread in-side mb-3" type="button" data-id="<?= encrypt($thread->id) ?>">
                        <i class="fas fa-comment mr-2"></i> Balas Diskusi Ini..
                    </button>

                    <?php if ($threads) : ?>
                        <div class="thread-header mb-2 list-group-item">
                            <?= count($threads) ?> Diskusi Lainnya
                        </div>

                        <ul class="list-group mb-3">
                            <?php foreach ($threads as $t) : ?>
                                <li class="thread-most-item list-group-item d-flex align-items-center">
                                    <a href="<?= route_to('diskusi.show', $t->slug) ?>" class="">
                                        <div class="text-content">
                                            <span class="name"><?= $t->title ?></span>
                                            <span class="thread-count">
                                                <?= text_limit($t->content, 200) ?>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($categories) : ?>
                        <div class="thread-header mb-2 list-group-item">
                            <?= count($categories) ?> Kategori Teratas
                        </div>

                        <ul class="list-group mb-3">
                            <?php foreach ($categories as $c) : ?>
                                <li class="thread-most-item list-group-item d-flex align-items-center">
                                    <a href="<?= route_to("kategori.show", $c->slug) ?>">
                                        <img class="mr-2" src="<?= $c->photo ?>">
                                        <div class="text-content">
                                            <span class="name"><?= $c->name; ?></span>
                                            <span class="thread-count"><?= count($c->threads) ?> Diskusi Digunakan</span>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>

                </div>
            </div>

            <div class="col-xl-7 col-lg-8 col-md-12 mb-3 pl-0 pl-md-normal order-lg-2 order-1">
                <div class="thread-header-panel">
                    <div class="thread-message">
                        <span>
                            <?= $user->username ?> memulai diskusi <?= ago($thread->created_at) ?><?= $count ?>
                        </span>
                    </div>
                    <div class="thread-info">
                        <ul>
                            <li><i class="fas fa-eye"></i> <?= number_short($thread->views) ?></li>
                            <li><i class="fas fa-comments"></i> <?= number_short($thread->count_replies) ?></li>
                            <li><a href="<?= route_to("kategori.show", $category->slug) ?>"><?= $category->name ?></a></li>
                        </ul>
                    </div>
                </div>

                <ul class="list-group thread-reply">
                    <li class="thread-list">
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
                                        <?php if (isAuthor($thread, $user) && (auth_check() && auth()->id === $thread->user_id)) : ?>
                                            <a class="dropdown-item btn-edit-diskusi" href="javascript:void(0);" data-id="<?= encrypt($thread->id) ?>">
                                                <i class="fas text-warning fa-pen mr-2"></i> Edit
                                            </a>

                                            <div class="dropdown-divider"></div>
                                        <?php endif ?>
                                        <a id="btnLaporkan" class="dropdown-item btn-report-diskusi" href="javascript:void(0);" data-id="<?= encrypt($thread->id) ?>" data-model="<?= encrypt(getClass($thread)) ?>" data-logined="<?= auth_check() ?>" data-pelaku="<?= encrypt($thread->user_id) ?>">
                                            <i class="fas text-warning fa-exclamation-triangle mr-2"></i>
                                            Laporkan
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="thread-reply-box-body">
                                <div>
                                    <h3 class="thread-comment-title detail m-0 mb-2">
                                        <?= $thread->title ?>
                                    </h3>
                                    <div class="thread-comment d-block">
                                        <?= $thread->content ?>
                                    </div>
                                </div>

                                <div class="thread-action d-flex justify-content-between align-items-center">
                                    <ul class="thread-categories">
                                        <li class="d-none"></li>
                                        <?php if ($thread->tags) : ?>
                                            <?php foreach ($thread->tags as $tag) : ?>
                                                <li class="mb-0">
                                                    <a href="<?= route_to('tag.show', $tag->slug) ?>">
                                                        <?= $tag->name ?>
                                                    </a>
                                                </li>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="thread-tengah">
                                        <?= buttonLike($thread) ?>
                                        <button class="btn btn-sm btn-share-diskusi" type="button" data-toggle="tooltip" title="Bagikan Diskusi"
                                            data-url="<?= base_url("d/$thread->slug") ?>">
                                            <i class="bi bi-share-fill"></i>
                                        </button>
                                    </div>
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
                        <button class="btn-reply-thread" type="button" data-id="<?= encrypt($thread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
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

<button class="btn-reply-thread fixed" type="button" data-id="<?= encrypt($thread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
    <i class="fas fa-comment"></i>
</button>

<?= view('frontend/diskusi/reply-modal', ['view_thread' => false]) ?>

<script src="<?= base_url('js/fe/diskusi/reply-delete.js') ?>"></script>

<?= $this->endSection() ?>