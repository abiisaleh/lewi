<p>Tabel Kriteria</p>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Kriteria (C)</th>
            <th>Bobot (W)</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($kriteria as $Kriteria) : ?>
            <tr>
                <td scope="row"><?= $i++ ?></td>
                <td><?= $Kriteria['nama'] ?></td>
                <td><?= $Kriteria['bobot'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<p>Daftar siswa</p>
<table class="table table-sm">
    <thead>
        <tr>
            <th scope="row">Nama</th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>C4</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($siswa as $Siswa) : ?>
            <tr>
                <td scope="row"><?= $Siswa['nama'] ?></td>
                <td><?= $Siswa['Nilai Semester'] ?? 0 ?></td>
                <td><?= $Siswa['peringkat_kelas'] ?></td>
                <td><?= $Siswa['kehadiran'] ?></td>
                <td><?= $Siswa['pelanggaran'] ?? 0 ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<p>Hasil</p>
<table class="table table-sm">
    <thead>
        <tr>
            <th>Nama</th>
            <th>C1 x W1</th>
            <th>C2 x W2</th>
            <th>C3 x W3</th>
            <th>C4 x W4</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($siswa as $Siswa) : ?>
            <tr>
                <td scope="row"><?= $Siswa['nama'] ?></td>
                <td><?= $Siswa['hasil_Nilai Semester'] ?></td>
                <td><?= $Siswa['hasil_Peringkat'] ?></td>
                <td><?= $Siswa['hasil_kehadiran'] ?></td>
                <td><?= $Siswa['hasil_pelanggaran'] ?></td>
                <td><?= $Siswa['hasil'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>