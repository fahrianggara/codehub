<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content'); ?>

<section class="homepage first" id="homepage">
    <div class="thread container-fluid">
        <!-- row container -->
        <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-4 col-md-12 mb-3 order-lg-1 order-3">
                <div class="sticky">

                    <div class="thread-header mb-2 list-group-item">
                        Kategori Lainnya
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
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <img class="mr-2" src="<?= base_url('images/empty.png') ?>">
                                <div class="text-content">
                                    <span class="name">Web Programming</span>
                                    <span class="thread-count">35 Diskusi digunakan</span>
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
                        <li class="thread-most-item list-group-item d-flex align-items-center">
                            <a href="javascript:void(0)" class="">
                                <img class="mr-2" src="<?= base_url('images/empty.png') ?>">
                                <div class="text-content">
                                    <span class="name">Web Programming</span>
                                    <span class="thread-count">35 Diskusi digunakan</span>
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
                <!-- baris tengah -->
                <div class="most-liked">
                    <div class="row">
                        <div class="col-lg-9 col-md-12">
                            <div class="thread-header main mb2 list-group-item d-flex justify-content-between align-items-center">
                                <div class="most-title"><?= count($threads) ?> Diskusi - <span><?= $category->name ?></span></div>
                                <img class="logo-most" src="<?= base_url('images/logo/sm.png') ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <form id="formFilterDiskusi" action="#" method="GET" class="mb2">
                                <div class="form-group m-0 w-100">
                                    <select name="order" id="filter-order" class="custom-select" style="height: 50px; padding: 0.75rem 1.25rem;">
                                        <option <?= selected_option($order_selected, 'desc') ?> value="desc">Terbaru</option>
                                        <option <?= selected_option($order_selected, 'asc') ?> value="asc">Terlama</option>
                                        <option <?= selected_option($order_selected, 'popular') ?> value="popular">Populer</option>
                                    </select>
                                </div>

                                <input type="submit" class="btn btn-primary d-none" value="Filter">
                            </form>
                        </div>
                    </div>
                    

                    <ul class="list-group mt-2">
                        <?php foreach ($threads as $thread) : ?>
                            <?php $thread_id = encrypt($thread->id) ?>

                            <li class="list-group-item ">
                                <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">

                                    <a class="thread-author d-flex align-items-center" 
                                        href="<?= route_to("profile", $thread->user->username) ?>">
                                        <img class="mr-2 profile-pic-detail" src="<?= $thread->user->photo ?>">
                                        <div class="name-content">
                                            <span class="author-name">
                                                <?= $thread->user->username ?>
                                                <?= isYou($thread) ? "<span class='badge-thread text-secondary'>KAMU</span>" : '' ?>
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

                                            <?php if (auth_check() && auth()->id === $thread->user->id) : ?>
                                                <a class="dropdown-item btn-edit-diskusi" href="javascript:void(0);" data-id="<?= $thread_id ?>">
                                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                </a>

                                                <a class="dropdown-item btn-hapus-diskusi" href="javascript:void(0);" data-id="<?= $thread_id ?>">
                                                    <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                </a>

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

                                <a class="thread-link" href="<?= route_to('diskusi.show', $thread->slug) ?>">
                                    <h3 class="thread-comment-title">
                                        <?= $thread->title ?>
                                    </h3>
                                    <div class="thread-comment">
                                        <?= text_limit($thread->content) ?>
                                    </div>
                                </a>

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

                                <div class="thread-action d-flex justify-content-between align-items-center">
                                    <div></div>

                                    <div class="thread-tengah">
                                        <?= buttonLike($thread) ?>

                                        <button <?= $thread->status === "draft" ? "disabled" : ''  ?> class="btn btn-reply-thread comment" 
                                            data-id="<?= encrypt($thread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
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

                    <?= $pager->only(['order'])->links('category-thread', 'pg_home') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('js') ?>

<?= view('frontend/diskusi/reply-modal', ['view_thread' => true]) ?>

    <?php if (auth_check()): ?>
        <?= view('frontend/diskusi/edit', ['detail' => false]) ?>
        <script src="<?= base_url('js/fe/diskusi/delete.js') ?>"></script>
    <?php endif ?>

    <script>
        $(document).ready(function () {
            const formFilter = $('#formFilterDiskusi');
            const filterOrder = $('#filter-order');

            filterOrder.change(function () {
                formFilter.submit();
            });
        });
    </script>

<?= $this->endSection(); ?>