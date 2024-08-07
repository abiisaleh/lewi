<?php $this->extend('user/layout'); ?>

<?php $this->section('content'); ?>

<section class="row mb-5">
    <?php if (is_null($siswa)) : ?>
        <div class="col">
            <div class="alert alert-danger" role="alert">
                Data siswa dengan nis <strong><?= request()->getVar('nis') ?></strong> tidak ditemukan.
            </div>
        </div>
    <?php else : ?>
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-3">Biodata</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <p>NIS</p>
                                </div>
                                <div class="col-7">
                                    <p>: <?= $siswa['nis'] ?></p>
                                </div>

                                <div class="col-5">
                                    <p>Nama</p>
                                </div>
                                <div class="col-7">
                                    <p>: <?= $siswa['nama'] ?></p>
                                </div>

                                <div class="col-5">
                                    <p>Jenis kelamin</p>
                                </div>
                                <div class="col-7">
                                    <p>: <?= ($siswa['jk'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></p>
                                </div>

                                <div class="col-5">
                                    <p>Tempat, tanggal lahir</p>
                                </div>
                                <div class="col-7">
                                    <p>: <?= $siswa['tempt_lahir'] ?>, <?= $siswa['tgl_lahir'] ?></p>
                                </div>
                            </div>
                            <p class="card-text">* <a href="login">Masuk</a> sebagai siswa untuk mengubah data.</p>
                        </div>
                    </div>
                </div>
                <?php if (!is_null($kelas)) : ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-3">Akademik</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <p>Kelas</p>
                                    </div>
                                    <div class="col-7">
                                        <p>: <?= $kelas['tingkat'] ?> <?= $kelas['jurusan'] ?> <?= $kelas['kode'] ?></p>
                                    </div>

                                    <div class="col-5">
                                        <p>Wali kelas</p>
                                    </div>
                                    <div class="col-7">
                                        <p>: <?= $kelas['wali_kelas'] ?></p>
                                    </div>

                                    <div class="col-5">
                                        <p>Kehadiran</p>
                                    </div>
                                    <div class="col-7">
                                        : <span class="badge bg-success ">Hadir</span>
                                    </div>

                                    <div class="col-5">
                                        <p>Skor pelanggaran</p>
                                    </div>
                                    <div class="col-7">
                                        <p>: <?= $skorPelanggaran['skor'] ?? 0 ?></p>
                                    </div>
                                </div>
                                <p class="card-text">Download <a href="jadwal">jadwal pelajaran</a></p>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <!-- <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Nilai Rata-rata</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-nilai"></div>
                        </div>
                    </div>
                </div> -->

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pelanggaran</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pelanggaaran</th>
                                        <th>Skor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i =  1;
                                    foreach ($pelanggaran as $Pelanggaran) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $Pelanggaran['nama'] ?></td>
                                            <td><?= $Pelanggaran['skor'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Prestasi</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Prestasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i =  1;
                                    foreach ($prestasi as $Prestasi) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $Prestasi['prestasi'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12" id="rekomendasi-prestasi"></div>
                <div class="col-12" id="rekomendasi-beasiswa"></div>

            </div>
        </div>

    <?php endif ?>
</section>
<?php $this->endsection(); ?>

<?php $this->section('script'); ?>
<script>
    $('.table').DataTable({
        searching: false,
        lengthChange: false,
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        },
    })

    var nilai = {
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
            name: 'sales',
            data: [50, 60, 75, 80, 60, 100]
        }],
        colors: '#435ebe',
        xaxis: {
            categories: ["X Sem. I", "X Sem. II", "IX Sem. I", "IX Sem. II", "XII Sem. I", "XII Sem. I"],
        },
    }

    var chartNilai = new ApexCharts(document.querySelector("#chart-nilai"), nilai);
    chartNilai.render();

    //rekomendasi prestasi
    $.ajax({
        type: 'POST',
        url: '<?= base_url('api/rekomendasi/prestasi') ?>', // Ganti dengan URL tujuan pengiriman form
        data: {
            tingkat: '<?= $kelas['tingkat'] ?>',
            jurusan: '<?= $kelas['jurusan'] ?>'
        },
        success: function(response) {
            $('#rekomendasi-prestasi').append(response.result)
            $('.modal-body').append(response.perhitungan)
            $('#rekomendasi-prestasi .result-title').text('Siswa Berprestasi')
        },
        error: function(xhr, status, error) {
            // Menghandle respon error dari server
            console.log(xhr.responseText);
            alert('Terjadi kesalahan: ' + xhr.statusText);
        }
    });

    //rekomendasi prestasi
    $.ajax({
        type: 'POST',
        url: '<?= base_url('api/rekomendasi/beasiswa') ?>', // Ganti dengan URL tujuan pengiriman form
        data: {
            tingkat: '<?= $kelas['tingkat'] ?>',
            jurusan: '<?= $kelas['jurusan'] ?>'
        },
        success: function(response) {
            $('#rekomendasi-beasiswa').append(response.result)
            $('.modal-body').append(response.perhitungan)
            $('#rekomendasi-beasiswa .result-title').text('Siswa Beasiswa')
        },
        error: function(xhr, status, error) {
            // Menghandle respon error dari server
            console.log(xhr.responseText);
            alert('Terjadi kesalahan: ' + xhr.statusText);
        }
    });
</script>
<?php $this->endsection(); ?>