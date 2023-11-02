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