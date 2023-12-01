<aside class="main-sidebar sidebar-light-primary elevation-1">

    <a href="<?= base_url('/') ?>" class="brand-link text-center d-flex align-items-center">
        <img src="<?= base_url('images/logo/sm.png') ?>" alt="CODEHUB Logo" class="brand-image" 
            style="opacity: .8">
        <span class="brand-text font-weight-bolder">CODEHUB</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="<?= auth()->photo ?>" class="img-circle profile-photo" alt="<?= auth()->username ?> Avatar">
            </div>
            <div class="info">
                <a href="<?= route_to('profile', auth()->username) ?>" class="d-block">
                    <?= auth()->full_name ?>
                </a>
                <small class="text-secondary">
                    <?= auth()->username ?>
                </small>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-header">Menu</li>

                <li class="nav-item">
                    <a href="<?= route_to('admin.dash') ?>"
                        class="nav-link <?= $menu === 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/') ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url(auth()->username) ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notifikasi
                        </p>
                    </a>
                </li> -->

                <li class="nav-header">Master Data</li>

                <li class="nav-item">
                    <a href="<?= route_to('admin.pengguna') ?>"
                        class="nav-link <?= $menu === 'pengguna' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Pengguna
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= route_to('admin.diskusi') ?>"
                        class="nav-link <?= $menu === 'diskusi' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Diskusi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= route_to('admin.kategori') ?>"
                        class="nav-link <?= $menu === 'kategori' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>
                            Kategori Diskusi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= route_to('admin.Tags') ?>"
                        class="nav-link <?= $menu === 'tags' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Tagar Diskusi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= route_to('admin.laporan') ?>"
                        class="nav-link <?= $menu === 'laporan' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan Diskusi
                        </p>
                    </a>
                </li>

                <li class="nav-header">Aksi</li>

                <li class="nav-item">
                    <a href="<?= route_to('logout') ?>" class="nav-link bg-danger" id="logoutButton">
                        <i class="nav-icon fas fa-sign-out-alt "></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>
