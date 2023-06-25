<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Login - Digilib</title>

	<link rel="shortcut icon" href="./assets/compiled/png/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="./assets/compiled/css/app.css" />
	<link rel="stylesheet" href="./assets/compiled/css/app-dark.css" />
	<link rel="stylesheet" href="./assets/compiled/css/auth.css" />
</head>

<body>
	<script src="assets/static/js/initTheme.js"></script>
	<div id="auth">
		<div class="row h-100">
			<div class="col-lg-5 col-12">
				<div id="auth-left">
					<div class="auth-logo">
						<a href="index.html"><img src="./assets/compiled/png/logo.png" alt="Logo" /></a>
					</div>
					<h1 class="auth-title mt-5"><?= lang('Auth.loginTitle') ?></h1>

					<?= view('App\Views\Auth\_message_block') ?>

					<form action="<?= url_to('login') ?>" method="post">
						<?= csrf_field() ?>
						<?php if ($config->validFields === ['email']) : ?>
							<div class="form-group position-relative has-icon-left mb-4">
								<input type="text" name="login" class="form-control form-control-xl <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" />
								<div class="form-control-icon">
									<i class="bi bi-person"></i>
								</div>
								<div class="invalid-feedback">
									<?= session('errors.login') ?>
								</div>
							</div>
						<?php else : ?>
							<div class="form-group position-relative has-icon-left mb-4">
								<input type="text" name="login" class="form-control form-control-xl <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="nama pengguna" />
								<div class="form-control-icon">
									<i class="bi bi-person"></i>
								</div>
								<div class="invalid-feedback">
									<?= session('errors.login') ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="form-group position-relative has-icon-left mb-4">
							<input type="password" name="password" class="form-control form-control-xl <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" />
							<div class="form-control-icon">
								<i class="bi bi-shield-lock"></i>
							</div>
							<div class="invalid-feedback">
								<?= session('errors.password') ?>
							</div>
						</div>
						<?php if ($config->allowRemembering) : ?>
							<div class="form-check form-check-lg d-flex align-items-end">
								<input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault" <?php if (old('remember')) : ?> checked <?php endif ?> />
								<label class="form-check-label text-gray-600" for="flexCheckDefault">
									<?= lang('Auth.rememberMe') ?>
								</label>
							</div>
						<?php endif; ?>
						<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
							<?= lang('Auth.loginAction') ?>
						</button>
					</form>
					<div class="text-center mt-3 text-lg fs-4">
						<?php if ($config->allowRegistration) : ?>
							<p class="text-gray-600">
								Belum punya akun. <a href="<?= url_to('register') ?>" class="font-bold"><?= lang('Auth.needAnAccount') ?></a>
							</p>
						<?php endif; ?>
						<?php if ($config->activeResetter) : ?>
							<p>
								<a class="font-bold" href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a>
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-lg-7 d-none d-lg-block">
				<div id="auth-right"></div>
			</div>
		</div>
	</div>
</body>

</html>