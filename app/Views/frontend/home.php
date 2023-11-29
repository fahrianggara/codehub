<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content'); ?>

<section class="homepage first" id="homepage">
    <div class="thread container-fluid">
        <!-- row container -->
        <div class="row">

            <div class="col-lg-3 col-md-12 mb-3 order-lg-1 order-3">
                <!-- barisn kiri -->
                <div class="sticky">
                    <div class="thread-header mb-3 list-group-item">
                        3 Kategori Teratas
                    </div>

                    <ul class="list-group mb-3">
                        <?php foreach ($categories as $category) : ?>
                            <li class="thread-most-item list-group-item d-flex align-items-center">
                                <a href="javascript:void(0)" class="">
                                    <img class="mr-2" src="<?= base_url('images/categories/' . $category->cover) ?>">
                                    <div class="text-content">
                                        <span class="name"><?= $category->name; ?></span>
                                        <span class="thread-count"><?= count($category->getThreads()) ?> Diskusi Digunakan</span>
                                    </div>
                                </a>

                            </li>
                        <?php endforeach ?>

                    </ul>

                    <div class="thread-header mb-3 list-group-item">
                        3 Pengguna Teratas
                    </div>

                    <ul class="list-group">
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <img class="mr-2 rounded-circle" src="<?= base_url('images/avatar.png') ?>">
                                <div class="text-content">
                                    <span class="name">ilhamramadan</span>
                                    <span class="thread-count">20 Diskusi, 20rb Disukai</span>
                                </div>
                            </a>
                        </li>
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <img class="mr-2 rounded-circle" src="<?= base_url('images/avatar.png') ?>">
                                <div class="text-content">
                                    <span class="name">dimasucup</span>
                                    <span class="thread-count">15 Diskusi, 10rb Disukai</span>
                                </div>
                            </a>
                        </li>
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <img class="mr-2 rounded-circle" src="<?= base_url('images/avatar.png') ?>">
                                <div class="text-content">
                                    <span class="name">fakhriakmal</span>
                                    <span class="thread-count">13 Diskusi, 8rb Disukai</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-3 order-lg-2 order-1">
                <!-- baris tengah -->
                <div class="most-liked">
                    <div class="thread-header main mb-3 list-group-item d-flex justify-content-between align-items-center">
                        <div class="most-title">Diskusi <span>Baru</span></div>
                        <img class="logo-most" src="<?= base_url('images/logo/sm.png') ?>">
                    </div>

                    <ul class="list-group mt-2">

                        <?php foreach ($threads as $thread) : ?>
                            <li class="list-group-item ">
                                <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                    <a class="d-flex align-items-center" href="javascript:void(0)">
                                        <img class="mr-2 profile-pic-detail" src="<?= $thread->user->photo ?>">
                                        <div class="name-content">
                                            <?= $thread->user->username ?>
                                            <span class="thread-count"><?= ago($thread->created_at) ?></span>
                                        </div>
                                    </a>
                                    <div class="btn-group dropleft">
                                        <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="fas text-info fa-share mr-2"></i>
                                                Bagikan
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="fas text-primary fa-external-link-alt mr-2"></i>
                                                Lihat
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);">
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
                                        <a href="<?= route_to("kategori.show", $thread->category->slug) ?>">
                                            <i class="fas fa-bookmark"></i>
                                            <?= $thread->category->name ?>
                                        </a>
                                    </li>
                                    <?php if ($thread->tags) : ?>
                                        <?php foreach ($thread->tags as $tag) : ?>
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

                                        <button <?= $thread->status === "draft" ? "disabled" : ''  ?> class="btn btn-reply-thread comment" data-id="<?= encrypt($thread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
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

                    <!-- pagination in here -->
                </div>
            </div>

            <div class="col-lg-3 col-md-12 mb-3 order-lg-3 order-2">
                <!-- baris kanan -->
                <div class="sticky">
                    <div class="thread-header mb-3 list-group-item">
                        3 Diskusi Teratas
                    </div>

                    <ul class="list-group">
                        <?php foreach ($TopThreads as $topThread) : ?>
                            <li class="list-group-item">
                                <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                    <a class="d-flex align-items-center" href="javascript:void(0)">
                                        <img class="mr-2 profile-pic-detail-kanan" src="<?= $topThread->user->photo ?>">
                                        <div class="name-content-kanan text-truncate"><?= $topThread->user->username ?>
                                            <span class="thread-count"><?= ago($topThread->created_at) ?></span>
                                        </div>
                                    </a>
                                    <div class="btn-group dropleft d-block d-lg-none">
                                        <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-display="static">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="fas text-info fa-share mr-2"></i>
                                                Bagikan
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="fas text-primary fa-external-link-alt mr-2"></i>
                                                Lihat
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="fas text-warning fa-exclamation-triangle mr-2"></i>
                                                Laporkan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)">
                                    <h3 class="thread-comment-kanan-title">
                                        <?= $topThread->title ?>
                                    </h3>
                                    <div class="thread-comment-kanan">
                                        <?= text_limit($topThread->content) ?>
                                    </div>
                                </a>
                                <ul class="thread-categories d-flex d-lg-none">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fas fa-bookmark"></i>
                                            Lorem Ipsum
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">python</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">python</a>
                                    </li>
                                </ul>
                                <div class="thread-action d-flex justify-content-between align-items-center">
                                    <div class=""></div>
                                    <div class="thread-kanan">
                                        <?= buttonLike($topThread) ?>

                                        <button <?= $topThread->status === "draft" ? "disabled" : ''  ?> class="btn btn-reply-thread comment" data-id="<?= encrypt($topThread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
                                            <i class="far fa-comment"></i>
                                            <small><?= $topThread->count_replies ?></small>
                                        </button>

                                        <button class="btn views cursor-default">
                                            <i class="fas fa-eye"></i>
                                            <small><?= $topThread->views ?></small>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>