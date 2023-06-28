<?php $this->extend('admin/layout'); ?>

<?php $this->section('tools'); ?>
<button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#modal-add">
    <i class="bi bi-gear"></i> <span class="d-none d-sm-inline">Pilih</span> Kelas
</button>

<!--Basic Modal -->
<div class="modal modal-sm fade text-left" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">
                    Data Kelas
                </h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal row" enctype="multipart/form-data" id="form-add">
                    <div class="form-body">
                        <div class="row">
                            <?= view_cell('SelectCell', ['name' => 'kelas', 'text' => 'Kelas', 'option' => ['-']]) ?>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    Submit
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->endsection('tools'); ?>

<?php $this->section('content'); ?>
<?= view_cell('TableCell', 'id=tabel') ?>
<?php $this->endsection('content'); ?>

<?php $this->section('script'); ?>
<script>
    var dataTable = $('#tabel').DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        },
        ajax: window.location.href,
        // ajax: 'http://localhost:8080/admin/akademik',
        columns: [{
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
                "title": "Keterangan",
                "data": null,
                "render": function(data) {
                    return `
                    <fieldset class="form-group">
                        <select class="form-select" name="ket" id="inputKeterangan">
                            <option></option>
                            <option>hadir</option>
                            <option>alpa</option>
                            <option>sakit</option>
                            <option>izin</option>         
                        </select>
                    </fieldset>
                    `
                }
            },
        ],
    })

    // Edit Data
    $('#tabel tbody').on('change', 'select', function() {
        var data = dataTable.row($(this).parents('tr')).data();

        $.ajax({
            url: '<?= base_url('admin/monitor/absensi') ?>',
            method: 'POST',
            data: {
                'fkSiswa': data.nis,
                'fkKelasSiswaTa': data.id,
                'ket': $(this).val(),
            }
        })
    });

    //select2 kelas
    $('#inputkelas').select2({
        ajax: {
            url: '/api/select2/kelas',
        },
        theme: "bootstrap-5",
    });
</script>
<?php $this->endsection('script'); ?>