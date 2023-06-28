<?php $this->extend('admin/layout'); ?>

<?php $this->section('content'); ?>
<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Masukkan Data</h5>
            <form id="form-siswa">
                <div class="form-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <?= view_cell('SelectCell', ['name' => 'fkSiswa', 'text' => 'NIS/Nama', 'option' => ['-']]) ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <?= view_cell('SelectCell', ['name' => 'fkPelanggaran', 'text' => 'Pelanggaran', 'option' => ['-']]) ?>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success">Tambahkan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col">
    <?= view_cell('TableCell', 'id=tabel') ?>
</div>
</div>

<?php $this->endsection('content'); ?>

<?php $this->section('script'); ?>
<script>
    $('#inputfkSiswa').select2({
        ajax: {
            url: '/api/select2/siswa',
        },
        theme: "bootstrap-5",
    });

    $('#inputfkPelanggaran').select2({
        ajax: {
            url: '/api/select2/pelanggaran',
        },
        theme: "bootstrap-5",
    });

    var dataTable = $('#tabel').DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        },
        ajax: window.location.href,
        columns: [{
                "title": "Tanggal",
                "data": "tgl"
            },
            {
                "title": "NIS",
                "data": "nis"
            },
            {
                "title": "Nama",
                "data": "nama"
            },
            {
                "title": "Jenis Kelamin",
                "data": null,
                "render": function(data) {
                    return (data.jk == 'P') ? 'Perempuan' : 'Laki-laki'
                }
            },
            {
                "title": "Pelanggaran",
                "data": "pelanggaran"
            },
            {
                "title": "Skor",
                "data": "skor"
            },
            {
                "title": "Aksi",
                "width": "10%",
                "data": null,
                "render": function() {
                    return "<button class='btn btn-sm btn-danger btnDelete'>Hapus</button>"
                }
            },
        ],
        order: [
            [0, 'desc']
        ]
    })

    //Tambah siswa ke kelas
    $('#form-siswa').submit(function(e) {
        e.preventDefault()
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                fkSiswa: $('#inputfkSiswa').val(),
                fkPelanggaran: $('#inputfkPelanggaran').val(),
            },
            success: function(data) {
                dataTable.ajax.reload()
            }
        })
    })
</script>
<?php $this->endsection('script'); ?>