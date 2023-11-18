<div class="mobile-search-overlay"></div>

<div class="mobile-search">
    <div class="container-fluid d-flex">

        <button type="button" class="btn close-search">
            <i class="fas fa-arrow-left"></i>
        </button>

        <form class="w-100" action="#" method="post">
            <?= csrf_field() ?>
            <div class="form-group m-0">
                <input type="search" class="form-control mobile-search-input" placeholder="Cari Diskusi...">
            </div>
        </form>

    </div>
</div>

<div class="mobile-nav-overlay"></div>

<nav class="mobile-nav">

    <?php if (!session()->get('logged_in')): ?>
        <div class="mobile-nav-top">
            <div class="text">
                <h3>Masuk ke akunmu</h3>
                <p>Agar dapat mengakses semua fitur di CODEHUB.</p>
            </div>
            <div class="action">
                <a href="javascript:void(0)" class="login">Masuk</a>
                <a href="javascript:void(0)" class="register">Daftar</a>
            </div>
        </div>
    <?php endif ?>

    <ul class="mobile-nav-bottom <?= auth_check() ? 'logined' : '' ?>">
        <?php if (auth_check()): ?>
            <?php if (auth()->role === 'admin'): ?>
                <li class="nav-item d-block d-md-none">
                    <a href="<?= route_to('admin.dash') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M27.531 30h-8.062A2.472 2.472 0 0 1 17 27.531V17.469A2.472 2.472 0 0 1 19.469 15h8.062A2.472 2.472 0 0 1 30 17.469v10.062A2.472 2.472 0 0 1 27.531 30zm-8.062-13a.469.469 0 0 0-.469.469v10.062c0 .259.21.469.469.469h8.062c.259 0 .469-.21.469-.469V17.469a.469.469 0 0 0-.469-.469zM27.531 13h-8.062A2.472 2.472 0 0 1 17 10.531V4.469A2.472 2.472 0 0 1 19.469 2h8.062A2.472 2.472 0 0 1 30 4.469v6.062A2.472 2.472 0 0 1 27.531 13zm-8.062-9a.469.469 0 0 0-.469.469v6.062c0 .259.21.469.469.469h8.062c.259 0 .469-.21.469-.469V4.469A.469.469 0 0 0 27.531 4zM12.531 17H4.469A2.472 2.472 0 0 1 2 14.531V4.469A2.472 2.472 0 0 1 4.469 2h8.062A2.472 2.472 0 0 1 15 4.469v10.062A2.472 2.472 0 0 1 12.531 17zM4.469 4A.469.469 0 0 0 4 4.469v10.062c0 .259.21.469.469.469h8.062c.259 0 .469-.21.469-.469V4.469A.469.469 0 0 0 12.531 4zM12.531 30H4.469A2.472 2.472 0 0 1 2 27.531v-6.062A2.472 2.472 0 0 1 4.469 19h8.062A2.472 2.472 0 0 1 15 21.469v6.062A2.472 2.472 0 0 1 12.531 30zm-8.062-9a.469.469 0 0 0-.469.469v6.062c0 .259.21.469.469.469h8.062c.259 0 .469-.21.469-.469v-6.062a.469.469 0 0 0-.469-.469z" opacity="1" class=""></path></g></svg>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item d-block d-md-none">
                <a href="javascript:void(0)" class="btn-buat-diskusi in-navbar">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512"
                        xml:space="preserve" class="">
                        <g>
                            <path
                                d="M12.75 20a.75.75 0 0 1-.75.75 11.843 11.843 0 0 1-3.394-.48 7.225 7.225 0 0 1-4.749 1.48c-.144 0-.286 0-.423-.007a1.228 1.228 0 0 1-.749-2.162 4.124 4.124 0 0 0 1.455-2.155A8.3 8.3 0 0 1 2.25 12c0-5.151 4.01-8.75 9.75-8.75 5.272 0 9.165 3.081 9.686 7.667A8.878 8.878 0 0 1 21.75 12a.75.75 0 0 1-1.5 0 7.425 7.425 0 0 0-.05-.9c-.435-3.8-3.728-6.35-8.2-6.35-4.857 0-8.25 2.982-8.25 7.25a6.787 6.787 0 0 0 1.75 4.7.749.749 0 0 1 .19.625 5.391 5.391 0 0 1-1.507 2.914 5.326 5.326 0 0 0 3.68-1.329.748.748 0 0 1 .792-.2 10.208 10.208 0 0 0 3.345.543.75.75 0 0 1 .75.747zM21 16.75h-1.75V15a.75.75 0 0 0-1.5 0v1.75H16a.75.75 0 0 0 0 1.5h1.75V20a.75.75 0 0 0 1.5 0v-1.75H21a.75.75 0 0 0 0-1.5zM12.02 11h-.01a1.005 1.005 0 1 0 .01 0zm4 2a1 1 0 0 0 0-2h-.01a1 1 0 0 0 .01 2zm-8.01-2a1.005 1.005 0 1 0 .01 0z"
                                opacity="1" class="">
                            </path>
                        </g>
                    </svg>
                    <span class="nav-text">Buat Diskusi</span>
                </a>
            </li>
        <?php endif; ?>
        
        <li class="nav-item">
            <a href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512"
                    xml:space="preserve" class="">
                    <g>
                        <path
                            d="M12 0a12 12 0 1 0 12 12A12.013 12.013 0 0 0 12 0zm0 22a10 10 0 1 1 10-10 10.011 10.011 0 0 1-10 10z"
                            opacity="1" class=""></path>
                        <path d="M12 9a1 1 0 0 0-1 1v8a1 1 0 0 0 2 0v-8a1 1 0 0 0-1-1z" opacity="1" class=""></path>
                        <circle cx="12" cy="6" r="1" opacity="1" class=""></circle>
                    </g>
                </svg>
                <span class="nav-text">Tentang</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512"
                    xml:space="preserve" class="">
                    <g>
                        <path
                            d="M108 16H20C8.973 16 0 24.973 0 36v56c0 11.027 8.973 20 20 20h88c11.027 0 20-8.973 20-20V36c0-11.027-8.973-20-20-20zm12 76c0 6.617-5.383 12-12 12H20c-6.617 0-12-5.383-12-12V36c0-6.617 5.383-12 12-12h88c6.617 0 12 5.383 12 12zm-9.172-53.172L85.656 64l25.172 25.172a3.997 3.997 0 0 1 0 5.656C110.047 95.609 109.023 96 108 96s-2.047-.391-2.828-1.172L80 69.656 66.828 82.828C66.047 83.609 65.023 84 64 84s-2.047-.391-2.828-1.172L48 69.656 22.828 94.828C22.047 95.609 21.023 96 20 96s-2.047-.391-2.828-1.172a3.997 3.997 0 0 1 0-5.656L42.344 64 17.172 38.828c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0L64 74.344l41.172-41.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656z"
                            opacity="1">
                        </path>
                    </g>
                </svg>
                <span class="nav-text">Kontak</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
                    xml:space="preserve" fill-rule="evenodd" class="">
                    <g>
                        <path
                            d="M307.66 465.229c0-17.696-14.346-32.042-32.042-32.042h-39.236a32.042 32.042 0 0 0-32.042 32.042c0 17.696 14.346 32.042 32.042 32.042h39.236c17.696 0 32.042-14.346 32.042-32.042zM67.361 382.606c5.352.409 11.827.644 18.331.263a90.96 90.96 0 0 0 89.238 73.36h12.226a50.247 50.247 0 0 0-.008 18H174.93a108.957 108.957 0 0 1-107.569-91.623zm-9.156-19.153A69.812 69.812 0 0 1 0 294.613V252.07a69.812 69.812 0 0 1 69.811-69.812h4.647C81.886 88.502 160.328 14.729 256 14.729s174.114 73.773 181.542 167.529h4.647A69.812 69.812 0 0 1 512 252.07v42.543a69.812 69.812 0 0 1-69.811 69.812h-20.601c-8.544 0-15.47-6.927-15.47-15.47V196.847c0-82.908-67.21-150.118-150.118-150.118s-150.118 67.21-150.118 150.118v152.108c0 6.032-3.453 11.259-8.491 13.81-13.868 4.812-35.375 1.331-39.186.688z"
                            opacity="1" class="">
                        </path>
                    </g>
                </svg>
                <span class="nav-text">Bantuan</span>
            </a>
        </li>
    </ul>
</nav>

<header id="header">
    <nav>
        <div class="nav-top">
            <div class="container-fluid">
                <ul>
                    <li class="nav-item">
                        <a href="javascript:void(0)"><span class="nav-text">Tentang</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)"><span class="nav-text">Kontak</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)"><span class="nav-text">Bantuan</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container-fluid">
            <div class="nav-bottom">
                <div class="navbar-left">

                    <button class="mobile-nav-toggle btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="navbar-brand">
                        <a href="<?= base_url('/') ?>">
                            <img src="<?= base_url('images/logo/sm.png') ?>" alt="logo">
                            <span class="logo-text d-none d-lg-block">codehub</span>
                        </a>
                    </div>

                </div>

                <form class="form-search" action="#" method="post" autocomplete="off">
                    <?= csrf_field() ?>

                    <div class="form-group m-0">
                        <input type="search" class="form-control" placeholder="Cari Diskusi...">
                        <button type="submit" class="btn btn-search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <div class="navbar-right">
                    <ul>
                        <?php if (auth_check()): ?>
                            <?php if (auth()->role === 'admin'): ?>
                                <li class="nav-item">
                                    <a href="<?= route_to('admin.dash') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 32 32" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M27.531 30h-8.062A2.472 2.472 0 0 1 17 27.531V17.469A2.472 2.472 0 0 1 19.469 15h8.062A2.472 2.472 0 0 1 30 17.469v10.062A2.472 2.472 0 0 1 27.531 30zm-8.062-13a.469.469 0 0 0-.469.469v10.062c0 .259.21.469.469.469h8.062c.259 0 .469-.21.469-.469V17.469a.469.469 0 0 0-.469-.469zM27.531 13h-8.062A2.472 2.472 0 0 1 17 10.531V4.469A2.472 2.472 0 0 1 19.469 2h8.062A2.472 2.472 0 0 1 30 4.469v6.062A2.472 2.472 0 0 1 27.531 13zm-8.062-9a.469.469 0 0 0-.469.469v6.062c0 .259.21.469.469.469h8.062c.259 0 .469-.21.469-.469V4.469A.469.469 0 0 0 27.531 4zM12.531 17H4.469A2.472 2.472 0 0 1 2 14.531V4.469A2.472 2.472 0 0 1 4.469 2h8.062A2.472 2.472 0 0 1 15 4.469v10.062A2.472 2.472 0 0 1 12.531 17zM4.469 4A.469.469 0 0 0 4 4.469v10.062c0 .259.21.469.469.469h8.062c.259 0 .469-.21.469-.469V4.469A.469.469 0 0 0 12.531 4zM12.531 30H4.469A2.472 2.472 0 0 1 2 27.531v-6.062A2.472 2.472 0 0 1 4.469 19h8.062A2.472 2.472 0 0 1 15 21.469v6.062A2.472 2.472 0 0 1 12.531 30zm-8.062-9a.469.469 0 0 0-.469.469v6.062c0 .259.21.469.469.469h8.062c.259 0 .469-.21.469-.469v-6.062a.469.469 0 0 0-.469-.469z" opacity="1" class=""></path></g></svg>
                                        <span class="nav-text">Dashboard</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li class="nav-item">
                                <a href="javascript:void(0)" class="btn-buat-diskusi in-navbar">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
                                        viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"
                                        class="">
                                        <g>
                                            <path
                                                d="M12.75 20a.75.75 0 0 1-.75.75 11.843 11.843 0 0 1-3.394-.48 7.225 7.225 0 0 1-4.749 1.48c-.144 0-.286 0-.423-.007a1.228 1.228 0 0 1-.749-2.162 4.124 4.124 0 0 0 1.455-2.155A8.3 8.3 0 0 1 2.25 12c0-5.151 4.01-8.75 9.75-8.75 5.272 0 9.165 3.081 9.686 7.667A8.878 8.878 0 0 1 21.75 12a.75.75 0 0 1-1.5 0 7.425 7.425 0 0 0-.05-.9c-.435-3.8-3.728-6.35-8.2-6.35-4.857 0-8.25 2.982-8.25 7.25a6.787 6.787 0 0 0 1.75 4.7.749.749 0 0 1 .19.625 5.391 5.391 0 0 1-1.507 2.914 5.326 5.326 0 0 0 3.68-1.329.748.748 0 0 1 .792-.2 10.208 10.208 0 0 0 3.345.543.75.75 0 0 1 .75.747zM21 16.75h-1.75V15a.75.75 0 0 0-1.5 0v1.75H16a.75.75 0 0 0 0 1.5h1.75V20a.75.75 0 0 0 1.5 0v-1.75H21a.75.75 0 0 0 0-1.5zM12.02 11h-.01a1.005 1.005 0 1 0 .01 0zm4 2a1 1 0 0 0 0-2h-.01a1 1 0 0 0 .01 2zm-8.01-2a1.005 1.005 0 1 0 .01 0z"
                                                opacity="1" class="">
                                            </path>
                                        </g>
                                    </svg>
                                    <span class="nav-text">Buat Diskusi</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (!auth_check()): ?>
                            <li class="nav-button mr-0">
                                <a href="<?= route_to('login') ?>" class="login">
                                    <span class="nav-text">Masuk</span>
                                </a>
                                <a href="<?= route_to('register') ?>" class="register">
                                    <span class="nav-text">Daftar</span>
                                </a>
                            </li>
                        <?php endif ?>

                        <li class="nav-item nav-profile d-block d-md-none">
                            <button type="button" class="btn btn-search" id="btn-search">
                                <i class="fas fa-search"></i>
                            </button>
                        </li>

                        <?php if (auth_check()): ?>
                            <li class="nav-profile nav-item">
                                <div class="btn-group">
                                    
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <figure class="position-relative">
                                            <img src="<?= auth()->photo ?>" alt="avatar"
                                                class="rounded-circle avatar">
                                            <!-- <span class="badge badge-danger notification-alert"> </span> -->
                                        </figure>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                        <div class="dropdown-header">
                                            <?= auth()->full_name ?>
                                        </div>
                                        <a class="dropdown-item" href="<?= base_url(auth()->username) ?>">
                                            <i class="fas fa-user mr-2"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="fas fa-bell mr-2"></i>
                                            Notifikasi
                                            <!-- <span class="badge badge-pill badge-danger ml-auto">6</span> -->
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a id="logoutButton" class="dropdown-item" href="javascript:void(0);">
                                            <i class="fas fa-sign-out-alt text-danger mr-2"></i> Logout
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endif ?>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>