<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content'); ?>

<section class="section-bg section-profile-top first <?= !auth_check() ? 'logined' : '' ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="profile-container">
                    <?= $this->include('frontend/profile/profile-header') ?>
                </div>

            </div>
        </div>
    </div>
</section>

<section style="padding-top: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3" id="thread-profile">

                <div class="card mb-1">
                    <div class="card-body p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link profile-tab active" href="#" data-toggle="tab" data-target="#tab-post">
                                    Diskusi 
                                    <?= $user->threads ? "(" . count($user->threads) . ")" : '' ?>
                                </a>
                            </li>
                            <?php if (auth_check() && auth()->id === $user->id): ?>
                            <li class="nav-item">
                                <a class="nav-link profile-tab" href="#" data-toggle="tab" data-target="#tab-security">
                                    Keamanan
                                </a>
                            </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-post" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 col-md-5 mb3">
                                <div class="sticky">
                                    <?php if (auth_check() && auth()->id === $user->id): ?>
                                        <button class="btn btn-buat-diskusi mb-3" data-logined="<?= auth_check() ?>">
                                            <i class="fas fa-plus"></i>
                                            <span>Diskusi Baru</span>
                                        </button>
                                    <?php endif ?>

                                    <div class="card">
                                        <div class="card-header accordion">
                                            <a href="#collapse-filter" class="btn btn-filter text-left p-0 ml-1 w-100" data-toggle="collapse"
                                                aria-expanded="<?= $selected_true ? 'true' : 'false' ?>" aria-controls="collapse-filter">
                                                <span>Filter Diskusi</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </a>
                                        </div>

                                        <div class="collapse <?= $selected_true ? 'show' : '' ?>" id="collapse-filter">
                                            <div class="card-body">
                                                <form action="#thread-profile" id="formFilterDiskusi" method="GET">
                                                    <?php if (auth_check() && auth()->id === $user->id): ?>
                                                        <div class="form-group">
                                                            <label for="filter-status">Status</label>
                                                            <select name="status" id="filter-status" class="custom-select">
                                                                <option <?= selected_option($status_selected, 'published') ?> value="published">Publik</option>
                                                                <option <?= selected_option($status_selected, 'draft') ?> value="draft">Arsip</option>
                                                            </select>
                                                        </div>
                                                    <?php endif ?>

                                                    <div class="form-group">
                                                        <label for="filter-order">Urutkan</label>
                                                        <select name="order" id="filter-order" <?= !$user->threads ? 'disabled' : '' ?> class="custom-select">
                                                            <option <?= selected_option($order_selected, 'desc') ?> value="desc">Terbaru</option>
                                                            <option <?= selected_option($order_selected, 'asc') ?> value="asc">Terlama</option>
                                                            <option <?= selected_option($order_selected, 'popular') ?> value="popular">Populer</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="filter-category">Kategori</label>
                                                        <select name="category" id="filter-category" <?= !$user->threads ? 'disabled' : '' ?> class="custom-select">
                                                            <option value="all" selected>Semua Kategori</option>
                                                            <?php foreach ($categories as $category): ?>
                                                                <option <?= selected_option($category_selected, $category['slug']) ?> 
                                                                    value="<?= $category['slug'] ?>">
                                                                    <?= $category['name'] ?>
                                                                </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>

                                                    <?php if ($selected_true): ?>
                                                        <button type="button" class="btn btn-warning btn-block btn-reset-filter"
                                                            data-url="<?= base_url($user->username) ?>#thread-profile">
                                                            Reset Filter
                                                        </button>
                                                    <?php endif ?>

                                                    <input type="submit" class="btn btn-primary d-none" value="Filter">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-7">
                                <div class="thread">
                                    <?= $this->include('frontend/profile/profile-diskusi') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (auth_check() && auth()->id === $user->id): ?>
                        <div class="tab-pane fade" id="tab-security" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $this->include('frontend/profile/edit-password') ?>
                                </div>
                                <div class="col-lg-6"></div>
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

<script>
    $(document).ready(function () {
        const formFilter = $('#formFilterDiskusi');
        const filterStatus = $('#filter-status');
        const filterOrder = $('#filter-order');
        const filterCategory = $('#filter-category');
        const btnResetFilter = $('.btn-reset-filter');

        filterStatus.change(function () {
            formFilter.submit();
        });

        filterOrder.change(function () {
            formFilter.submit();
        });

        filterCategory.change(function () {
            formFilter.submit();
        });

        btnResetFilter.click(function () {
            window.location.href = $(this).data('url');
            // add loading
            $(this).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
        });
    });
</script>

<?= $this->endSection(); ?>
