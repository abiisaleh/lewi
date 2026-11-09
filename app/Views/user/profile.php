<?php $this->extend('user/layout'); ?>

<?php $this->section('content'); ?>
<?php $errors = session('errors') ?? []; ?>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informasi Akun</h4>
            </div>
            <div class="card-body">
                <?php if (session('message')) : ?>
                    <div class="alert alert-success"><?= esc(session('message')) ?></div>
                <?php endif; ?>
                <?php if (session('error')) : ?>
                    <div class="alert alert-danger"><?= esc(session('error')) ?></div>
                <?php endif; ?>
                <?php if ($errors !== []) : ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="profile" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" id="username" class="form-control" value="<?= esc($profileUser->username) ?>" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?= esc(old('nama', $name)) ?>" maxlength="100" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password baru</label>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="pass_confirm">Konfirmasi password baru</label>
                        <input type="password" id="pass_confirm" name="pass_confirm" class="form-control" autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endsection(); ?>
