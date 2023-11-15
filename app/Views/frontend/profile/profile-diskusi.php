<!-- <div class="alert alert-warning">
    <i class="fas fa-info-circle mr-2"></i>
    <span>Belum ada diskusi</span>
</div> -->

<li class="list-group-item ">
    <div class="item-content mb-2 mt-1 d-flex align-items-center justify-content-between">
        <a class="d-flex align-items-center" href="javascript:void(0)">
            <img class="mr-2 profile-pic-detail" src="<?= base_url('images/avatar.png') ?>">
            <div class="name-content">
                fahrianggara
                <span class="thread-count">2 Jam yang lalu</span>
            </div>
        </a>
        <div class="btn-group dropleft">
            <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
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