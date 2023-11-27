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
<<<<<<< Updated upstream
                            </a>
                                <img class="mr-2" src="<?= base_url('images/empty.png') ?>">

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
                        <li class="list-group-item ">
                            <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                <a class="d-flex align-items-center" href="javascript:void(0)">
                                    <img class="mr-2 profile-pic-detail" src="<?= base_url('images/avatar.png') ?>">
                                    <div class="name-content">
                                        sultanjordy
                                        <span class="thread-count">2 Jam yang lalu</span>
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
                            <a href="javascript:void(0)">
                                <h3 class="thread-comment-title">
                                    Lorem ipsum dolor
                                </h3>
                                <div class="thread-comment">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt Lorem ipsum
                                    dolor sit amet consectetur adipisicing elit. Illo voluptatibus numquam, sint, ipsam
                                    expedita excepturi iste iusto omnis neque facere qui quam odit esse impedit repellat
                                    repudiandae quasi, corrupti accusantium!.
                                </div>
                            </a>
                            <ul class="thread-categories">
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
                                    <a href="javascript:void(0)">learning html</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">ngoding</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">indonesia</a>
                                </li>
                            </ul>
                            <div class="thread-action d-flex justify-content-between align-items-center">
                                <div></div>
                                <div class="thread-tengah">
                                    <button class="btn love text-danger">
                                        <i class="fas fa-heart fa-beat"></i>
                                        <small>23</small>
                                    </button>
                                    <button class="btn comment">
                                        <i class="far fa-comment"></i>
                                        <small>5</small>
                                    </button>
                                    <button class="btn views cursor-default">
                                        <i class="fas fa-eye"></i>
                                        <small>100</small>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item ">
                            <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                <a class="d-flex align-items-center" href="javascript:void(0)">
                                    <img class="mr-2 profile-pic-detail" src="<?= base_url('images/avatar.png') ?>">
                                    <div class="name-content">
                                        sultanjordy
                                        <span class="thread-count">2 Jam yang lalu</span>
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
                            <a href="javascript:void(0)">
                                <h3 class="thread-comment-title">
                                    Lorem ipsum dolor
                                </h3>
                                <div class="thread-comment">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt Lorem ipsum
                                    dolor sit amet consectetur adipisicing elit. Illo voluptatibus numquam, sint, ipsam
                                    expedita excepturi iste iusto omnis neque facere qui quam odit esse impedit repellat
                                    repudiandae quasi, corrupti accusantium!.
                                </div>
                            </a>
                            <ul class="thread-categories">
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
                                    <a href="javascript:void(0)">learning html</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">ngoding</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">indonesia</a>
                                </li>
                            </ul>
                            <div class="thread-action d-flex justify-content-between align-items-center">
                                <div></div>
                                <div class="thread-tengah">
                                    <button class="btn love text-danger">
                                        <i class="fas fa-heart fa-beat"></i>
                                        <small>23</small>
                                    </button>
                                    <button class="btn comment">
                                        <i class="far fa-comment"></i>
                                        <small>5</small>
                                    </button>
                                    <button class="btn views cursor-default">
                                        <i class="fas fa-eye"></i>
                                        <small>100</small>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item ">
                            <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                <a class="d-flex align-items-center" href="javascript:void(0)">
                                    <img class="mr-2 profile-pic-detail" src="<?= base_url('images/avatar.png') ?>">
                                    <div class="name-content">
                                        sultanjordy
                                        <span class="thread-count">2 Jam yang lalu</span>
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
                            <a href="javascript:void(0)">
                                <h3 class="thread-comment-title">
                                    Lorem ipsum dolor
                                </h3>
                                <div class="thread-comment">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt Lorem ipsum
                                    dolor sit amet consectetur adipisicing elit. Illo voluptatibus numquam, sint, ipsam
                                    expedita excepturi iste iusto omnis neque facere qui quam odit esse impedit repellat
                                    repudiandae quasi, corrupti accusantium!.
                                </div>
                            </a>
                            <ul class="thread-categories">
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
                                    <a href="javascript:void(0)">learning html</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">ngoding</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">indonesia</a>
                                </li>
                            </ul>
                            <div class="thread-action d-flex justify-content-between align-items-center">
                                <div></div>
                                <div class="thread-tengah">
                                    <button class="btn love text-danger">
                                        <i class="fas fa-heart fa-beat"></i>
                                        <small>23</small>
                                    </button>
                                    <button class="btn comment">
                                        <i class="far fa-comment"></i>
                                        <small>5</small>
                                    </button>
                                    <button class="btn views cursor-default">
                                        <i class="fas fa-eye"></i>
                                        <small>100</small>
                                    </button>
                                </div>
                            </div>
                        </li>
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
                        <li class="list-group-item">
                            <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                <a class="d-flex align-items-center" href="javascript:void(0)">
                                    <img class="mr-2 profile-pic-detail-kanan" src="<?= base_url('images/avatar.png') ?>">
                                    <div class="name-content-kanan text-truncate">sultanjordy
                                        <span class="thread-count">2 Jam yang lalu</span>
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
                                    Lorem ipsum dolor
                                </h3>
                                <div class="thread-comment-kanan">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt.
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
                                    <button class="btn love">
                                        <i class="far fa-heart"></i>
                                        <small>50</small>
                                    </button>
                                    <button class="btn comment">
                                        <i class="far fa-comment"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn views">
                                        <i class="fas fa-eye"></i>
                                        <small>100</small>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                <a class="d-flex align-items-center" href="javascript:void(0)">
                                    <img class="mr-2 profile-pic-detail-kanan" src="<?= base_url('images/avatar.png') ?>">
                                    <div class="name-content-kanan text-truncate">sultanjordy
                                        <span class="thread-count">2 Jam yang lalu</span>
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
                                    Lorem ipsum dolor
                                </h3>
                                <div class="thread-comment-kanan">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt.
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
                                    <button class="btn love">
                                        <i class="far fa-heart"></i>
                                        <small>50</small>
                                    </button>
                                    <button class="btn comment">
                                        <i class="far fa-comment"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn views">
                                        <i class="fas fa-eye"></i>
                                        <small>100</small>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                <a class="d-flex align-items-center" href="javascript:void(0)">
                                    <img class="mr-2 profile-pic-detail-kanan" src="<?= base_url('images/avatar.png') ?>">
                                    <div class="name-content-kanan text-truncate">sultanjordy
                                        <span class="thread-count">2 Jam yang lalu</span>
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
                                    Lorem ipsum dolor
                                </h3>
                                <div class="thread-comment-kanan">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt.
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
                                    <button class="btn love">
                                        <i class="far fa-heart"></i>
                                        <small>50</small>
                                    </button>
                                    <button class="btn comment">
                                        <i class="far fa-comment"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn views">
                                        <i class="fas fa-eye"></i>
                                        <small>100</small>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>