<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content'); ?>

<section class="section-bg section-profile-top first <?= !auth_check() ? 'logined' : '' ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="profile-container">
                    <div class="profile-header">
                        <div class="profile-banner-container">
                            <div class="profile-banner banner-default">
                                <img src="<?= $user->poster ?>" alt="banner">

                                <div class="action">
                                    <?php if (auth_check() && auth()->id === $user->id): ?>
                                    <button class="btn btn-sm btn-banner">
                                        <i class="fas fa-camera"></i>
                                        <span>Edit Sampul</span>
                                    </button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                        <div class="profile-user">
                            <div class="profile-info">
                                <figure class="profile-avatar">
                                    <img src="<?= $user->photo ?>" alt="avatar" class="bg-white">

                                    <?php if (auth_check() && auth()->id === $user->id): ?>
                                    <button class="btn btn-sm btn-avatar">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                    <?php endif ?>
                                </figure>

                                <div class="profile-name">
                                    <h3 class="name"><?= $user->full_name ?></h3>
                                    <span class="username">@<?= $user->full_name ?></span>

                                    <ul class="user-sosmed">
                                        <?php if ($user->link_fb): ?>
                                        <li class="sosmed-item">
                                            <a href="<?= $user->link_fb ?>" target="_blank" class="sosmed-link">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <?php endif ?>

                                        <?php if ($user->link_tw): ?>
                                        <li class="sosmed-item">
                                            <a href="<?= $user->link_tw ?>" target="_blank" class="sosmed-link">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <?php endif ?>

                                        <?php if ($user->link_ig): ?>
                                        <li class="sosmed-item">
                                            <a href="<?= $user->link_ig ?>" target="_blank" class="sosmed-link">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <?php endif ?>

                                        <?php if ($user->link_gh): ?>
                                        <li class="sosmed-item">
                                            <a href="<?= $user->link_gh ?>" target="_blank" class="sosmed-link">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        </li>
                                        <?php endif ?>

                                        <?php if ($user->link_li): ?>
                                        <li class="sosmed-item">
                                            <a href="<?= $user->link_li ?>" target="_blank" class="sosmed-link">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        </li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="action">
                                <?php if (auth_check() && auth()->id === $user->id): ?>
                                <button class="btn btn-sm btn-warning btn-profile">
                                    <i class="fas fa-pen"></i>
                                    <span>Edit Profile</span>
                                </button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section style="padding-top: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">

                <div class="card mb-1">
                    <div class="card-body p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-toggle="tab" data-target="#tab-post">
                                    Diskusi (10)
                                </a>
                            </li>
                            <?php if (auth_check() && auth()->id === $user->id): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="tab" data-target="#tab-security">
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
                            <div class="col-lg-4 col-md-5 mb-3">
                                <?php if (auth_check() && auth()->id === $user->id): ?>
                                    <button class="btn btn-add-post mb-3">
                                        <i class="fas fa-plus"></i>
                                        <span>Diskusi Baru</span>
                                    </button>
                                <?php endif ?>

                                <div class="card">
                                    <div class="card-header">
                                        Filter Diskusi
                                    </div>
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

                                            <div class="form-group">
                                                <label for="filter-date">Tanggal</label>
                                                <input type="text" name="filter-date" id="filter-date"
                                                    class="custom-select" placeholder="DD/MM/YYYY - DD/MM/YYYY">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-7">
                                <div class="thread">
                                    <ul class="list-group">
                                        <!-- <div class="alert alert-warning">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            <span>Belum ada diskusi</span>
                                        </div> -->
                                        <li class="list-group-item ">
                                            <div
                                                class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
                                                <a class="d-flex align-items-center" href="javascript:void(0)">
                                                    <img class="mr-2 profile-pic-detail"
                                                        src="<?= base_url('images/avatar.png') ?>">
                                                    <div class="name-content">
                                                        fahrianggara
                                                        <span class="thread-count">2 Jam yang lalu</span>
                                                    </div>
                                                </a>
                                                <div class="btn-group dropleft">
                                                    <button class="btn btn-sm btn-more dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"
                                                        data-display="static">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if (auth_check() && auth()->id === $user->id): ?>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i class="fas text-secondary fa-archive mr-2"></i> Draft
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                        <?php endif ?>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i class="fas text-info fa-share mr-2"></i>
                                                            Bagikan
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i class="fas text-primary fa-external-link-alt mr-2"></i>
                                                            Lihat
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i
                                                                class="fas text-warning fa-exclamation-triangle mr-2"></i>
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
                                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis
                                                    adipisci hic
                                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo
                                                    voluptatibus numquam, sint, ipsam expedita excepturi iste iusto
                                                    omnis neque facere qui quam odit esse impedit repellat repudiandae
                                                    quasi, corrupti accusantium!.
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
                                                    <a href="javascript:void(0)">python</a>
                                                </li>
                                            </ul>
                                            <div
                                                class="thread-action d-flex justify-content-between align-items-center">
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

                    <?php if (auth_check() && auth()->id === $user->id): ?>
                    <div class="tab-pane fade" id="tab-security" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <form class="card">
                                    <div class="card-header">
                                        Ganti Password
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="old-password">Password Lama</label>
                                            <input type="password" name="old-password" id="old-password"
                                                class="form-control" placeholder="Masukkan password sekarang">
                                        </div>
                                        <div class="form-group">
                                            <label for="new-password">Password Baru</label>
                                            <input type="password" name="new-password" id="new-password"
                                                class="form-control" placeholder="Masukkan password baru">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm-password">Konfirmasi</label>
                                            <input type="password" name="confirm-password" id="confirm-password"
                                                class="form-control" placeholder="Masukkan password baru lagi">
                                        </div>
                                    </div>
                                    <div class="card-footer p-2">
                                        <button type="submit" class="btn btn-success">
                                            <span>Ganti Password</span>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-show-pass">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </form>
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
        $('input[name="filter-date"]').daterangepicker({
            drops: 'up',
            locale: {
                cancelLabel: 'Clear'
            },
        });

        $('input[name="filter-date"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('')
        });
        $('input[name="filter-date"]').val('');
        $('input[name="filter-date"]').attr('placeholder', 'DD/MM/YYYY - DD/MM/YYYY');


        $('.btn-show-pass').click(function () {
            var inputFields = $('#old-password, #new-password, #confirm-password');
            var icon = $(this).find('i');
            var isPasswordVisible = (inputFields.attr('type') === 'password');

            inputFields.attr('type', isPasswordVisible ? 'text' : 'password');
            icon.removeClass(isPasswordVisible ? 'fa-eye' : 'fa-eye-slash')
                .addClass(isPasswordVisible ? 'fa-eye-slash' : 'fa-eye');
        });
    });
</script>
<?= $this->endSection(); ?>