<?php $this->extend('admin/layout'); ?>

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
</script>
<?php $this->endsection('script'); ?>