<header class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="/"><img src="./assets/compiled/png/logo.png" alt="Logo" style="height:40px" /></a>
            </div>
            <div class="header-top-right">

                <?php if (logged_in()) : ?>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600"><?= (ucfirst(user()->username)) ?></h6>
                                    <p class="mb-0 text-sm text-gray-600"><?= (in_groups('admin')) ? 'admin' : ((in_groups('guru')) ? 'guru' : 'siswa') ?></p>
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
                        <a href="login" class="btn btn-primary">Masuk</a>
                    </div>
                <?php endif; ?>


                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <?= $this->include('user/_navbar'); ?>
</header>