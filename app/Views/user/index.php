<?php $this->extend('user/layout'); ?>

<?php $this->section('content'); ?>
<!-- HOME -->
<div class="row mb-5" id="beranda">
    <div class="col-md-8 mx-auto text-center pt-3 pb-5">
        <h2>Sistem Informasi Monitoring pada SMA YPPK Taruna Dharma</h2>
        <p class="pt-2 pb-5 px-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deleniti perspiciatis ea enim quidem beatae reiciendis ab ipsam repudiandae dolore aliquid voluptas labore nihil magni qui, impedit dolor quo nostrum nam.</p>

        <form action="siswa" method="GET">
            <div class="d-flex">
                <div class="col-lg-8 col-10 mx-auto">
                    <div class="input-group shadow-lg">
                        <input type="text" class="form-control" placeholder="Masukkan NIS" name="nis">
                        <button class="btn btn-primary" type="submit" id="btnCari"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END HOME -->

<!-- PROFILE -->
<div class="row mb-5">
    <div class="col py-3">
        <div class="card">
            <div class="card-content">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <img class="img-fluid rounded-end" src="assets/static/images/bg/001.jpg" alt="Card image cap">
                    </div>
                    <div class="col-md-6 order-lg-first p-3">
                        <div class="card-body">
                            <h4 class="card-title">Profile</h4>
                            <p class="card-text">
                                SMA YPPK Taruna Dharma Jayapura adalah Satuan Pendidikan Swasta Katolik di bawah naungan Yayasan Pendidikan dan Persekolahan Katolik Santu Fransiskus Asisi Peovinsi Papua. Sekolah ini didirikan tanggal 9 Januari 1978.
                            </p>
                            <a href="profile">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <h3 class="text-center">Profile</h3> -->
    </div>
</div>
<!-- END PROFILE -->

<!-- ABOUT -->
<div class="row mb-5">
    <h3 class="text-center pb-3">Tentang</h3>
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-auto">
                            <div class="stats-icon blue mb-2">
                                <div>
                                    <i class="bi bi-facebook"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-right">
                            <h6 class="text-muted font-semibold">Facebook</h6>
                            <h6 class="font-extrabold mb-0">@smayppktarunadharma</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-auto">
                            <div class="stats-icon purple mb-2">
                                <div>
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-right">
                            <h6 class="text-muted font-semibold">Kontak</h6>
                            <h6 class="font-extrabold mb-0">(62)81 2489 2355</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-auto">
                            <div class="stats-icon red mb-2">
                                <div>
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-right">
                            <h6 class="text-muted font-semibold">Alamat</h6>
                            <h6 class="font-extrabold mb-0">Kotaraja, Jaypura</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ABOUT -->
<?php $this->endsection(); ?>