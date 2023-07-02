<nav class="main-navbar">
    <div class="container">
        <ul class="mx-auto menu">
            <li class="menu-item active">
                <a href="#home" class='menu-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Beranda</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#cari" class='menu-link'>
                    <i class="bi bi-search"></i>
                    <span>Cari Siswa</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#profile" class='menu-link'>
                    <i class="bi bi-stack"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#about" class='menu-link'>
                    <i class="bi bi-life-preserver"></i>
                    <span>Tentang</span>
                </a>
            </li>

            <div class="ms-auto">
                <?php if (logged_in()) : ?>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-light"><?= (ucfirst(user()->username)) ?></h6>
                                    <p class="mb-0 text-sm text-light"><?= (in_groups('admin')) ? 'admin' : ((in_groups('guru')) ? 'guru' : 'siswa') ?></p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="./assets/compiled/jpg/1.jpg" />
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem">
                            <li>
                                <h6 class="dropdown-header">Hello, <?= user()->username ?>!</h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="user"><i class="icon-mid bi bi-person me-2"></i> My
                                    Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i> Settings</a>
                            </li>
                            <?php if (in_groups('admin')) : ?>
                                <li>
                                    <a class="dropdown-item" href="admin"><i class="icon-mid bi bi-speedometer me-2"></i> Dashboard</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout"><i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </div>
                <?php else : ?>
                    <div>
                        <a href="login" class="btn btn-outline-light">Masuk</a>
                    </div>
                <?php endif; ?>
            </div>

        </ul>
    </div>
</nav>