<?php

use Faker\Provider\Base;
?>
<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content'); ?>

<section class="homepage" id="homepage">
    <div class="thread container-fluid">  <!-- row container -->
        <div class="row">
            
            <div class="col-md-3 mb-3"> <!-- barisn kiri -->
                <div class="thread-header mb-3 list-group-item">
                    Most Topic Search
                </div>

                <ul class="list-group mb-3">
                    <li class="thread-most-item list-group-item d-flex align-items-center">
                        <a href="#" class="">
                            <img class="mr-2" src="https://source.unsplash.com/random/1200x630">
                            <div class="text-content">Python
                                <span class="thread-count">13 thread || 20k post</span>
                            </div>
                        </a>
                    </li>
                    <li class="thread-most-item list-group-item d-flex align-items-center">
                        <a href="#" class="">
                            <img class="mr-2" src="https://source.unsplash.com/random/1200x630">
                            <div class="text-content">Python
                                <span class="thread-count">13 thread || 20k post</span>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="thread-header mb-3 list-group-item">
                    Most Topic Account
                </div>

                <ul class="list-group">
                    <li class="thread-most-item list-group-item d-flex align-items-center">
                        <a href="#" class="">
                            <img class="mr-2" src="https://source.unsplash.com/random/1200x630">
                            <div class="text-content">Python
                                <span class="thread-count">13 thread || 20k post</span>
                            </div>
                        </a>
                    </li>
                    <li class="thread-most-item list-group-item d-flex align-items-center">
                        <a href="#" class="">
                            <img class="mr-2" src="https://source.unsplash.com/random/1200x630">
                            <div class="text-content">Python
                                <span class="thread-count">13 thread || 20k post</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-6 mb-3"> <!-- baris tengah -->
                <div class="most-liked mb-3">
                    <div class="thread-header main mb-3 list-group-item d-flex justify-content-between align-items-center">
                        <div class="most-title">Most <span>Liked</span></div>
                        <img class="logo-most" src="<?= base_url('images/logo/sm.png') ?>">
                    </div>

                    <ul class="list-group mt-2">
                        <li class="list-group-item">
                            <div class="item-content mb-2">
                                <a class="d-flex align-items-center" href="#">
                                    <img class="mr-2 profile-pic-detail" src="<?= base_url('images/avatar.png') ?>">
                                    <div class="name-content">Sultan Jordy Priadi
                                        <span class="thread-count">Lorem Ipsum Dolor || 2 Jam yang lalu</span>
                                    </div>
                                </a>
                            </div>
                            <a href="#">
                                <div class="thread-comment text-truncate">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatibus numquam, sint, ipsam expedita excepturi iste iusto omnis neque facere qui quam odit esse impedit repellat repudiandae quasi, corrupti accusantium!.
                                </div>
                            </a>
                            <div class="thread-action d-flex justify-content-between align-items-center">
                                <div></div>
                                <div class="thread-tengah">
                                    <button class="btn love">
                                        <i class="bi bi-heart"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn comment">
                                        <i class="bi bi-chat"></i>
                                        <small>1</small>
                                    </button>

                                    <button class="btn share">
                                        <i class="bi bi-share"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="item-content mb-2">
                                <a class="d-flex align-items-center" href="#">
                                    <img class="mr-2 profile-pic-detail" src="<?= base_url('images/avatar.png') ?>">
                                    <div class="name-content">Sultan Jordy Priadi
                                        <span class="thread-count">PHP || 2 Jam yang lalu</span>
                                    </div>
                                </a>
                            </div>
                            <a href="#">
                                <div class="thread-comment text-truncate">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis adipisci hic
                                    tempore dolore illo iste possimus tenetur nesciunt aliquid deserunt Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatibus numquam, sint, ipsam expedita excepturi iste iusto omnis neque facere qui quam odit esse impedit repellat repudiandae quasi, corrupti accusantium!.
                                </div>
                            </a>
                            <div class="thread-action d-flex justify-content-between align-items-center">
                                <div></div>
                                <div class="thread-tengah">
                                    <button class="btn love">
                                        <i class="bi bi-heart"></i>
                                        <small>1</small>
                                    </button>
                                    <button class="btn comment">
                                        <i class="bi bi-chat"></i>
                                        <small>1</small>
                                    </button>

                                    <button class="btn share">
                                        <i class="bi bi-share"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 mb-3"> <!-- baris kanan -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="title-kanan mt-1 mb-3">New Post</div>
                        <div class="item-content mb-2">
                            <a class="d-flex align-items-center" href="">
                                <img class="mr-2 profile-pic-detail-kanan" src="<?= base_url('images/avatar.png') ?>">
                                <div class="name-content-kanan">Sultan Jordy Priadi
                                    <span class="thread-count">PHP || 2 Jam yang lalu</span>
                                </div>
                            </a>
                        </div>
                        <a href="">
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
                            <a class="d-flex align-items-center" href="">
                                <img class="mr-2 profile-pic-detail-kanan" src="<?= base_url('images/avatar.png') ?>">
                                <div class="name-content-kanan">Sultan Jordy Priadi
                                    <span class="thread-count">PHP || 2 Jam yang lalu</span>
                                </div>
                            </a>
                        </div>
                        <a href="">
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
</section>

<?= $this->endSection(); ?>