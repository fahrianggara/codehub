<?php $this->extend('layouts/frontend') ?>

<?php $this->section('content'); ?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="logo-nav">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand ml-2" href="javascript:void(0);">
                    <img src="images/logo/logo.png" alt="logo image">
                </a>
            </div>

            <div class="icon-nav d-block d-lg-none"> <!-- Untuk mobile -->
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell-fill"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-header">
                            Notifikasi
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <figure>
                            <img src="https://i.pravatar.cc/500?img=32" alt="avatar" class="rounded-circle" width="30" height="30">
                        </figure>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-header">
                            Hello, Username!
                        </div>
                        <a class="dropdown-item" href="javascript:void(0);">
                            Profile
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);">
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i class="bi bi-box-arrow-right mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="javascript:void(0);">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);">Support</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="javascript:void(0);" role="button"
							data-toggle="dropdown" aria-expanded="false">
							Dropdown
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="javascript:void(0);">Action</a>
							<a class="dropdown-item" href="javascript:void(0);">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="javascript:void(0);">Something else here</a>
						</div> -->
                    </li>
                    <li>
                        <form class="form-inline my-2 my-lg-0 form-search">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                                <input type="search" class="form-control" placeholder="Cari Diskusi..." aria-label="Hello, Username!" aria-describedby="basic-addon1">
                            </div>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="icon-nav d-none d-lg-block"> <!-- Untuk desktop -->
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell-fill"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-header">
                            Notifikasi
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <figure>
                            <img src="https://i.pravatar.cc/500?img=32" alt="avatar" class="rounded-circle" width="30" height="30">
                            <!-- <span class="name">Username</span>
								<i class="bi bi-chevron-down"></i> -->
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-header">
                            Hello, Username!
                        </div>
                        <a class="dropdown-item" href="javascript:void(0);">
                            Profile
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);">
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i class="bi bi-box-arrow-right mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </nav>
    <section class="hero" id="home">
        <!--  Content Area-->
        <!-- row container -->
        <div class="content container-fluid ">
            <div class="row">
                <!-- barisn kiri -->
                <div class="mt-3 col-md-3 px-4 col-sm-6">
                    <!-- Category title -->
                    <div class="most-topic mb-2">
                        <div class="most-topic list-group-item">Most Topic Search
                        </div>
                    </div>
                    <!-- Sub Category -->
                    <ul class="list-group">

                        <li class="list-group-item d-flex align-items-center">
                            <a href="" style="color: black; text-decoration: none !important">
                                <div class="item-content d-flex">
                                    <img class="mr-2" src="images/menu/piton.png" alt="uler">
                                    <div class="text-content">Python
                                        <span class="thread-count">13 thread || 20k post</span>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <div class="item-content d-flex">
                                <img class="mr-2" src="images/menu/piton.png" alt="uler">
                                <div class="text-content">Python
                                    <span class="thread-count">13 thread || 20k post</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="item-content d-flex">
                                <img class="mr-2" src="images/menu/piton.png" alt="uler">
                                <div class="text-content">Python
                                    <span class="thread-count">13 thread || 20k post</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="item-content d-flex">
                                <img class="mr-2" src="images/menu/piton.png" alt="uler">
                                <div class="text-content">Python
                                    <span class="thread-count">13 thread || 20k post</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- Category title 2 -->
                    <div class="mt-3 mb-2 most-topic">
                        <div class="list-group-item">Most Topic Account
                        </div>
                    </div>
                    <!-- sub category 2 -->
                    <ul class="list-group">
                        <li class="list-group-item d-flex align-items-center">
                            <div class="item-content  d-flex">
                                <img class="mr-2" src="images/menu/piton.png" alt="uler">
                                <div class="text-content">Python
                                    <span class="thread-count">13 thread || 20k post</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="item-content  d-flex">
                                <img class="mr-2" src="images/menu/piton.png" alt="uler">
                                <div class="text-content">Python
                                    <span class="thread-count">13 thread || 20k post</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="item-content  d-flex">
                                <img class="mr-2" src="images/menu/piton.png" alt="uler">
                                <div class="text-content">Python
                                    <span class="thread-count">13 thread || 20k post</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="item-content  d-flex">
                                <img class="mr-2" src="images/menu/piton.png" alt="uler">
                                <div class="text-content">Python
                                    <span class="thread-count">13 thread || 20k post</span>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
                <!-- baris tengah -->
                <div class="brs2 col-md-6 col-sm-6">
                    <div class="mt-3 most-liked">
                        <div class="header list-group-item d-flex justify-content-between align-items-center">
                            <div class="most-title">Most <span>Liked</span></div>
                            <img class="logo-most" src="images/menu/codelogo.png" style="width: 30px; height: 30px;">
                        </div>
                        <!-- tread-->
                        <ul class="list-group mt-2">
                            <li class="list-group-item">
                                <div class="item-content mb-2">
                                    <a class="d-flex align-items-center" href="" style="color: black; text-decoration: none !important">
                                        <img class="mr-2 profile-pic-detail" src="images/menu/gojo.jpg " alt="uler">
                                        <div class="name-content">Sultan Jordy Priadi
                                            <span class="thread-count">PHP || Hari Ini 10.00</span>
                                        </div>
                                    </a>
                                </div>
                                <a href="" style="color: black; text-decoration: none !important">
                                    <div class="thread-comment text-truncate">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                        tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatibus numquam, sint, ipsam expedita excepturi iste iusto omnis neque facere qui quam odit esse impedit repellat repudiandae quasi, corrupti accusantium!.
                                    </div>
                                </a>
                                <div class="thread-action d-flex justify-content-between align-items-center">
                                    <div class=""></div>
                                    <div class="thread-tengah d-flex">
                                        <button class="btn love ">
                                            <i class="bi bi-heart"></i>
                                            <small>1</small>
                                        </button>
                                        <button class="btn comment  ">
                                            <i class="bi bi-chat"></i>
                                            <small>1</small>
                                        </button>

                                        <button class="btn share  ">
                                            <i class="bi bi-share"></i>
                                        </button>

                                    </div>
                                </div>

                            </li>
                            <li class="list-group-item">
                                <div class="item-content mb-2">
                                    <a class="d-flex align-items-center" href="" style="color: black; text-decoration: none !important">
                                        <img class="mr-2 profile-pic-detail" src="images/menu/gojo.jpg " alt="uler">
                                        <div class="name-content">Sultan Jordy Priadi
                                            <span class="thread-count">PHP || Hari Ini 10.00</span>
                                        </div>
                                    </a>
                                </div>
                                <a href="" style="color: black; text-decoration: none !important">
                                    <div class="thread-comment">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                        tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt.
                                    </div>
                                </a>
                                <div class="thread-action d-flex justify-content-between align-items-center">
                                    <div class=""></div>
                                    <div class="thread-tengah d-flex">
                                        <button class="btn love ">
                                            <i class="bi bi-heart"></i>
                                            <small>1</small>
                                        </button>
                                        <button class="btn comment  ">
                                            <i class="bi bi-chat"></i>
                                            <small>1</small>
                                        </button>

                                        <button class="btn share  ">
                                            <i class="bi bi-share"></i>
                                        </button>

                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>

                    <!-- recomen -->
                    <div class="mt-3 recomendation ">
                        <div class="header list-group-item d-flex justify-content-between">
                            <div class="most-title">Recomen<span>dation</span></div><img src="images/menu/codelogo.png" style="width: 30px; height: 30px;">
                        </div>
                    </div>
                </div>
                <!-- baris kanan -->
                <div class="col-md-3 mt-2 ">
                    <ul class="list-group mt-2">
                        <li class="list-group-item">
                            <div class="title-kanan mt-1 mb-3 ">New Post</div>
                            <div class="item-content mb-2">
                                <a class="d-flex align-items-center" href="" style="color: black; text-decoration: none !important">
                                    <img class="mr-2 profile-pic-detail-kanan" src="images/menu/gojo.jpg " alt="uler">
                                    <div class="name-content-kanan">Sultan Jordy Priadi
                                        <span class="thread-count">PHP || Hari Ini 10.00</span>
                                    </div>
                                </a>
                            </div>
                            <a href="" style="color: black; text-decoration: none !important">
                                <div class="thread-comment-kanan">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt.
                                </div>
                            </a>
                            <div class="thread-action d-flex justify-content-between align-items-center">
                                <div class=""></div>
                                <div class="thread-kanan d-flex">
                                    <button class="btn love-kanan ">
                                        <i class="bi bi-heart"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn comment-kanan  ">
                                        <i class="bi bi-chat"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn share-kanan  ">
                                        <i class="bi bi-share"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="item-content mb-2">
                                <a class="d-flex align-items-center" href="" style="color: black; text-decoration: none !important">
                                    <img class="mr-2 profile-pic-detail-kanan" src="images/menu/gojo.jpg " alt="uler">
                                    <div class="name-content-kanan">Sultan Jordy Priadi
                                        <span class="thread-count">PHP || Hari Ini 10.00</span>
                                    </div>
                                </a>
                            </div>
                            <a href="" style="color: black; text-decoration: none !important">
                                <div class="thread-comment-kanan">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt.
                                </div>
                            </a>
                            <div class="thread-action d-flex justify-content-between align-items-center">
                                <div class=""></div>
                                <div class="thread-kanan d-flex">
                                    <button class="btn love-kanan ">
                                        <i class="bi bi-heart"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn comment-kanan ">
                                        <i class="bi bi-chat"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn share-kanan  ">
                                        <i class="bi bi-share"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                </div>
            </div>
        </div>

        <?php $this->endSection(); ?>