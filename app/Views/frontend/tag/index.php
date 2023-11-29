<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content'); ?>

<section class="homepage first" id="homepage">
    <div class="thread container-fluid">
        <!-- row container -->
        <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-4 col-md-12 mb-3 pr-3 pr-md-normal order-lg-1 order-3">
                <div class="sticky">

                    <div class="thread-header mb-3 list-group-item">
                        Tagar Lainnya
                    </div>

                    <ul class="list-tags mb-3">
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'php') ?>">
                                php
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'javascript') ?>">
                                javascript
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'codeigniter') ?>">
                                codeigniter
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'laravel') ?>">
                                laravel
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'mysql') ?>">
                                mysql
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'html') ?>">
                                html
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'css') ?>">
                                css
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'bootstrap') ?>">
                                bootstrap
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'jquery') ?>">
                                jquery
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'vuejs') ?>">
                                vuejs
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'reactjs') ?>">
                                reactjs
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'tips-trik') ?>">
                                tips & trik
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'tutorial') ?>">
                                tutorial
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'ngoding') ?>">
                                ngoding
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'programming') ?>">
                                programming
                            </a>
                        </li>
                        <li data-toggle="tooltip" title="1 Diskusi">
                            <a href="<?= route_to('tag.show', 'web-dev') ?>">
                                web dev
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-7 col-lg-8 col-md-12 mb-3 pl-0 pl-md-normal order-lg-2 order-1">
                <!-- baris tengah -->
                <div class="most-liked">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 pr-2 pr-md-normal">
                            <div class="thread-header font-weight-light main mb-medium-2 list-group-item d-flex justify-content-between align-items-center">
                                <div class="most-title subject"><?= count($threads) ?> Diskusi dalam # <span><?= $tag->name ?></span></div>
                                <img class="logo-most" src="<?= base_url('images/logo/sm.png') ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 pl-0 pl-md-normal">
                            <form id="formFilterDiskusi" action="#" method="GET" class="mb-medium-2">
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

                                            <?php if (auth_check() && auth()->id === $thread->user->id) : ?>
                                                <a class="dropdown-item btn-edit-diskusi" href="javascript:void(0);" data-id="<?= $thread_id ?>">
                                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                </a>

                                                <a class="dropdown-item btn-hapus-diskusi" href="javascript:void(0);" data-id="<?= $thread_id ?>">
                                                    <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                </a>

                                                <div class="dropdown-divider"></div>
                                            <?php endif ?>

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

                                        <button <?= $thread->status === "draft" ? "disabled" : ''  ?> class="btn btn-reply-thread comment" 
                                            data-id="<?= encrypt($thread->id) ?>" data-url="<?= route_to('diskusi.reply-show') ?>">
                                            <i class="far fa-comment"></i>
                                            <small><?= $thread->count_replies ?></small>
                                        </button>

                                        <button class="btn views cursor-default">
                                            <i class="fas fa-eye"></i>
                                            <small><?= $thread->views ?></small>
                                        </button>

                                        <button class="btn btn-sm btn-share-diskusi" type="button" data-toggle="tooltip" 
                                            title="Bagikan Diskusi">
                                            <i class="bi bi-share-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>

                    <?= $pager->only(['order'])->links('tag-thread', 'pg_home') ?>
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