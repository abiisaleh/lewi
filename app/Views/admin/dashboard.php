<?php $this->extend('admin/layout'); ?>

<?php $this->section('content'); ?>
<div class="row">

    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon purple mb-2">
                            <div>
                                <i class="bi bi-collection-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Jurusan</h6>
                        <h6 class="font-extrabold mb-0"><?= number_format($totalJurusan) ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                            <div>
                                <i class="bi bi-house-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Kelas</h6>
                        <h6 class="font-extrabold mb-0"><?= number_format($totalKelas) ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon green mb-2">
                            <div>
                                <i class="bi bi-person-workspace"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Guru</h6>
                        <h6 class="font-extrabold mb-0"><?= number_format($totalGuru) ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon red mb-2">
                            <div>
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Siswa</h6>
                        <h6 class="font-extrabold mb-0"><?= number_format($totalSiswa) ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Pelanggaran <?= date('Y') ?></h4>
            </div>
            <div class="card-body">
                <div id="chart-pelanggaran"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Kehadiran</h4>
                <p class="text-sm text-muted"><i class="bi bi-calendar"></i> <?= date('d M Y') ?></p>
            </div>
            <div class="card-body">
                <div id="chart-kehadiran"></div>
            </div>
        </div>
    </div>

</div>
<?php $this->endsection('content'); ?>

<?php $this->section('style'); ?>
<link rel="stylesheet" href="assets/css/main/app.css">
<link rel="stylesheet" href="assets/css/main/app-dark.css">

<link rel="stylesheet" href="assets/css/shared/iconly.css">
<?php $this->endsection('style'); ?>

<?php $this->section('script'); ?>
<script src="assets/js/app.js"></script>
<script src="assets/js/bootstrap.js"></script>

<script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard.js"></script>

<script>
    var optionsPelanggaran = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled: false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity: 1
        },
        plotOptions: {},
        series: [{
            name: 'pelanggaran',
            data: <?= $pelanggaran ?>
        }],
        colors: '#435ebe',
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        },
    }
    let optionsKehadiran = {
        series: [70, 30, 20, 20],
        labels: ['Hadir', 'Sakit', 'Izin', 'Alpa'],
        colors: ['#435ebe', '#ffd145', '#55c6e8', '#ff7976'],
        chart: {
            type: 'donut',
            width: '100%',
            height: '350px'
        },
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '30%'
                }
            }
        }
    }

    var chartPelanggaran = new ApexCharts(document.getElementById('chart-pelanggaran'), optionsPelanggaran);
    var chartKehadiran = new ApexCharts(document.getElementById('chart-kehadiran'), optionsKehadiran)

    chartPelanggaran.render();
    chartKehadiran.render()
</script>
<?php $this->endsection('script'); ?>