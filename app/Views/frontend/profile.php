<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content'); ?>

<section class="section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="profile-container">
                    <div class="profile-header">
                        <div class="profile-banner-container">
                            <div class="profile-banner banner-default">
                                <img src="<?= base_url('images/banner.png') ?>" alt="banner">

                                <div class="action">
                                    <button class="btn btn-sm btn-banner">
                                        <i class="fas fa-camera"></i>
                                        <span>Edit Sampul</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="profile-user">
                            <div class="profile-info">
                                <figure class="profile-avatar">
                                    <img src="https://i.pravatar.cc/500?img=32" alt="avatar">

                                    <button class="btn btn-sm btn-avatar">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </figure>

                                <div class="profile-name">
                                    <h3 class="name">Ilham Ramadan</h3>
                                    <span class="username">@ilhamramadhan</span>
                                    <ul class="user-sosmed">
                                        <li class="sosmed-item">
                                            <a href="javascript:void(0);" class="sosmed-link">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="sosmed-item">
                                            <a href="javascript:void(0);" class="sosmed-link">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="sosmed-item">
                                            <a href="javascript:void(0);" class="sosmed-link">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li class="sosmed-item">
                                            <a href="javascript:void(0);" class="sosmed-link">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="action">
                                <button class="btn btn-sm btn-warning btn-profile">
                                    <i class="fas fa-pen"></i>
                                    <span>Edit Profile</span>
                                </button>
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
                                <a class="nav-link active" href="#" data-toggle="tab" 
                                    data-target="#tab-post">
                                    Postingan (10)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="tab" 
                                    data-target="#tab-security">
                                    Keamanan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-post" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 col-md-5 mb-3">
                                <button class="btn btn-add-post mb-3">
                                    <span>Buat Diskusi</span>
                                </button>

                                <div class="card">
                                    <div class="card-header">
                                        Filter Diskusi
                                    </div>
                                    <div class="card-body">
                                        <form action="#">
                                            <div class="form-group">
                                                <label for="filter-status">Status</label>
                                                <select name="filter-status" id="filter-status"
                                                    class="custom-select">
                                                    <option value="">Publish</option>
                                                    <option value="">Draft</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="filter-urutkan">Urutkan</label>
                                                <select name="filter-urutkan" id="filter-urutkan"
                                                    class="custom-select">
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
                                <div class="thread-container">
                                    <ul class="thread-list">

                                        <!-- <div class="alert alert-warning">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            <span>Belum ada diskusi</span>
                                        </div> -->

                                        <li class="thread-item">
                                            <a href="javascript:void(0);" class="thread-category">
                                                Lorem Ipsum Dolor
                                            </a>
                                            <div class="thread-header">
                                                <div class="thread-author">
                                                    <figure class="avatar">
                                                        <img src="https://i.pravatar.cc/500?img=32" alt="avatar"
                                                            class="rounded-circle">
                                                    </figure>
                                                    <div class="info">
                                                        <h6 class="name">
                                                            Ilham Ramadan
                                                        </h6>
                                                        <time class="date">2 jam yang lalu</time>
                                                    </div>
                                                </div>
                                                <div class="btn-group dropleft">
                                                    <button class="btn btn-sm btn-more dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
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
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i
                                                                class="fas text-primary fa-external-link-alt mr-2"></i>
                                                            Lihat
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i class="fas text-info fa-flag mr-2"></i> Laporkan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="thread-body">
                                                <ul class="thread-tags">
                                                    <li class="tag-item">
                                                        <a href="javascript:void(0);" class="tag-link">
                                                            <span class="tag-name">HTML</span>
                                                        </a>
                                                    </li>
                                                    <li class="tag-item">
                                                        <a href="javascript:void(0);" class="tag-link">
                                                            <span class="tag-name">Lorem Ipsum</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <a href="javascript:void(0);" class="thread-title">
                                                    <h3>
                                                        Lorem ipsum dolor sit amet
                                                    </h3>
                                                    <div class="thread-content">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Sint
                                                        ducimus veritatis
                                                        atque quo repellat voluptate, necessitatibus sed at animi
                                                        voluptatibus.
                                                        Consequuntur architecto molestias at aperiam recusandae
                                                        repellat
                                                        reiciendis, enim incidunt!
                                                    </div>
                                                </a>

                                                <div class="thread-action">
                                                    <div></div>
                                                    <div>
                                                        <button class="btn btn-sm btn-like text-danger"
                                                            data-toggle="tooltip" title="Suka">
                                                            <i class="fas fa-heart"></i>
                                                            <span>10</span>
                                                        </button>
                                                        <button class="btn btn-sm btn-comment" data-toggle="tooltip"
                                                            title="Komentar">
                                                            <i class="fas fa-comment"></i>
                                                            <span>10</span>
                                                        </button>
                                                        <button class="btn btn-sm btn-share" data-toggle="tooltip"
                                                            title="Share">
                                                            <i class="fas fa-share"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

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
                locale: { cancelLabel: 'Clear' },
            });

            $('input[name="filter-date"]').on('cancel.daterangepicker', function (ev, picker) { $(this).val('') });
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