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
                "title": "Nilai rata-rata",
                "data": "nilai"
            },
            {
                "title": "Peringkat",
                "data": "peringkat"
            },
            {
                "title": "Aksi",
                "width": "10%",
                "data": null,
                "render": function(data) {
                    var url = '<?= base_url('admin/monitor/nilai') ?>' + '/' + data.nis
                    return "<a class='btn btn-sm btn-success' href='" + url + "'>Detail</a>"
                }
            },
        ],
    })
</script>
<?php $this->endsection('script'); ?>