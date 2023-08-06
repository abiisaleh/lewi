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
                                <div class="col-md-4">
                                    <label for="inputfkSiswa">Siswa</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <fieldset class="form-group">
                                        <select class="form-select" id="inputfkSiswa" name="fkSiswa">
                                            <?php foreach ($siswa as $item) : ?>
                                                <option value="<?= $item['nis'] ?>"><?= $item['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="inputprestasi">Prestasi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="inputprestasi" class="form-control" name="prestasi" placeholder="-" />
                                </div>
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
                "title": "Prestasi",
                "data": "prestasi"
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

    //Tambah prestasi siswa
    $('#form-siswa').submit(function(e) {
        e.preventDefault()
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                fkSiswa: $('#inputfkSiswa').val(),
                prestasi: $('#inputprestasi').val(),
            },
            success: function(data) {
                dataTable.ajax.reload()
            }
        })
    })

    //Hapus Data
    $('#tabel tbody').on('click', '.btnDelete', function() {
        var data = dataTable.row($(this).parents('tr')).data()
        var id = data.id

        if (confirm('Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: window.location.href + '/' + id,
                type: 'DELETE',
                success: function() {
                    dataTable.ajax.reload()
                }
            })
        }
    })
</script>
<?php $this->endsection('script'); ?>