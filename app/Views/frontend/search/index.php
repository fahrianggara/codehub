<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content'); ?>

<section class="homepage first" id="homepage">
    <div class="thread container-fluid">
        <!-- row container -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-8 col-md-12 mb-3 pl-0 pl-md-normal order-lg-2 order-1">
                <!-- baris tengah -->
                <div class="most-liked position-relative">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 pr-2 pr-md-normal">
                            <div class="thread-header font-weight-light main mb-medium-2 list-group-item d-flex justify-content-between align-items-center">
                                <div class="most-title subject text-one-line">
                                    <?= count($threads) ?> Diskusi dalam Pencarian <span><?= $query ?></span>
                                </div>
                                <img class="logo-most ml-1" src="<?= base_url('images/logo/sm.png') ?>">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 pl-0 pl-md-normal">
                            <form id="formFilterDiskusi" action="<?= route_to('search') ?>" method="GET" class="mb-medium-2">
                                <div class="form-group m-0 w-100">
                                    <select name="order" id="filter-order" <?= count($threads) === 0 ? 'disabled' : '' ?> class="custom-select" style="height: 50px; padding: 0.75rem 1.25rem;">
                                        <option <?= selected_option($order_selected, 'desc') ?> value="desc">Terbaru</option>
                                        <option <?= selected_option($order_selected, 'asc') ?> value="asc">Terlama</option>
                                        <option <?= selected_option($order_selected, 'popular') ?> value="popular">Populer</option>
                                    </select>
                                </div>

                                <input type="submit" class="btn btn-primary d-none" value="Filter">
                            </form>
                        </div>
                    </div>


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

                        <?= $pager->only(['q', 'order'])->links('search-thread', 'pg_home') ?>
                    <?php else : ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">

                                <div class="no-result">
                                    <img src="<?= base_url('images/noresult.png') ?>" alt="No Result" class="img-fluid">
                                    <h3>Waduh.. kosong ?</h3>
                                    <p>Diskusi dengan kata kunci <span><?= $query ?></span> tidak ada nih, coba cari kata kunci yang lain.</p>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('js') ?>

<?= view('frontend/diskusi/reply-modal', ['view_thread' => true]) ?>
<?= view('frontend/diskusi/laporan') ?>

<?php if (auth_check()) : ?>
    <?= view('frontend/diskusi/edit', ['detail' => false]) ?>
    <script src="<?= base_url('js/fe/diskusi/delete.js') ?>"></script>
<?php endif ?>

<script>
    $(document).ready(function() {
        const formFilter = $('#formFilterDiskusi');
        const filterOrder = $('#filter-order');

        filterOrder.change(function() {
            const searchTerm = "<?= $query ?>";
            const order = filterOrder.val();
            const newUrl = `/search?q=${searchTerm}&order=${order}`;

            window.location.href = newUrl; // redirect
            showLoader("Tunggu sebentar ya, sedang merubah urutan diskusi..");
        });
    });
</script>

<?= $this->endSection(); ?>