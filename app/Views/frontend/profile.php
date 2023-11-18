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
                                        <button class="btn btn-buat-diskusi mb-3">
                                            <i class="fas fa-plus"></i>
                                            <span>Diskusi Baru</span>
                                        </button>
                                    <?php endif ?>

                                    <div class="card">
                                        <div class="card-header accordion">
                                            <a href="#collapse-filter" class="btn btn-filter text-left p-0 ml-1 w-100" data-toggle="collapse"
                                                aria-expanded="false" aria-controls="collapse-filter">
                                                <span>Filter Diskusi</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </a>
                                        </div>

                                        <div class="collapse" id="collapse-filter">
                                            <div class="card-body">
                                                <form action="#">
                                                    <?php if (auth_check() && auth()->id === $user->id): ?>
                                                        <div class="form-group">
                                                            <label for="filter-status">Status</label>
                                                            <select name="filter-status" id="filter-status" class="custom-select">
                                                                <option value="">Publish</option>
                                                                <option value="">Draft</option>
                                                            </select>
                                                        </div>
                                                    <?php endif ?>

                                                    <div class="form-group">
                                                        <label for="filter-urutkan">Urutkan</label>
                                                        <select name="filter-urutkan" id="filter-urutkan" class="custom-select">
                                                            <option value="">Terbaru</option>
                                                            <option value="">Terlama</option>
                                                            <option value="">Populer</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="filter-category">Kategori</label>
                                                        <select name="filter-category" id="filter-category"
                                                            class="custom-select">
                                                            <option value="">Semua Kategori</option>
                                                            <option value="">Kategori 1</option>
                                                            <option value="">Kategori 2</option>
                                                            <option value="">Kategori 3</option>
                                                        </select>
                                                    </div>
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