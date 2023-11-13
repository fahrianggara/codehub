<?php 
    $height991 = "160px";
    $height576 = "120px";

    if (!auth_check()) {
        $height991 = $has_sosial_media ? "125px" : "85px";
        $height576 = $has_sosial_media ? "100px" : "60px";
    } else {
        $height991 = $has_sosial_media ? "160px" : "115px";
        $height576 = $has_sosial_media ? "120px" : "80px";
    }
?>

<?= $this->section('css') ?>
    <style>
        @media (max-width: 991.98px) {
            .profile-user {
                flex-direction: column;
                height: calc(100px + <?= $height991 ?>);
                bottom: 60px;
            }
        }

        @media (max-width: 576.98px) {
            .profile-user {
                height: calc(100px + <?= $height576 ?>);
            }
        }
    </style>
<?= $this->endSection() ?>

<div class="profile-header">
    <div class="profile-banner-container">
        <div class="profile-banner banner-default">
            <img src="<?= $user->poster ?>" alt="banner">

            <div class="action">
                <?php if (auth_check() && auth()->id === $user->id): ?>
                    <button id="buttonBanner" class="btn btn-sm">
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
                    <button id="buttonAvatar" class="btn btn-sm btn-avatar">
                        <i class="fas fa-camera"></i>
                    </button>
                <?php endif ?>
            </figure>

            <div class="profile-name" <?= !$has_sosial_media ? "style='top:10px !important'" : '' ?>/>
                <h3 class="name"><?= $user->full_name ?></h3>
                <span class="username">@<?= $user->full_name ?></span>

                <?php if ($has_sosial_media): ?>
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
                <?php endif ?>
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

<?= $this->section('js') ?>

    <?= $this->include('frontend/profile/edit-avatar') ?>
    
<?= $this->endSection() ?>
