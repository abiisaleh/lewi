<?php $this->extend('admin'); ?>

<?php $this->section('tools'); ?>
<button class="btn btn-primary" type="button">
    <i class="bi bi-printer"></i> Print
</button>
<?php $this->endsection('tools'); ?>

<?php $this->section('content'); ?>
<div class="row">
    <div class="col-md-4">
        <?= view_cell('SelectKelasCell', 'btn=Tampilkan') ?>
    </div>
    <div class="col-md-8">
        <?= view_cell('TableCell') ?>
    </div>
</div>

<!-- modal add -->
<div class="modal fade text-left" id="modal-add">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah Data
                </h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal row" id="form-add">
                    <?= csrf_field(); ?>
                    <div class="form-body">
                        <div class="row">

                            <?= view_cell('SelectCell', ['name' => 'mapel', 'text' => 'Mata Pelajaran', 'option' => ['I', 'II', 'III', 'IV']]) ?>
                            <?= view_cell('SelectCell', ['name' => 'hari', 'text' => 'Hari', 'option' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']]) ?>
                            <?= view_cell('InputCell', 'name=timestart,text=Jam Mulai,type=time') ?>
                            <?= view_cell('InputCell', 'name=timeend,text=Jam Selesai,type=time') ?>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                    Reset
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->endsection('content'); ?>

<?php $this->section('script'); ?>
<script>
    var dataTable = $('.table').DataTable({
        autoWidth: false,
        processing: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        },
        ajax: window.location.href,
        columns: [{
                "title": "Hari",
            },
            {
                "title": "Mata Pelajaran"
            },
            {
                "title": "Jam"
            },
            {
                "title": "Aksi",
                "data": null,
                "render": "<button class='btn btn-sm btn-danger btnHapus'>Hapus</button> <button class='btn btn-sm btn-warning btnEdit'>Edit</button>"
            }
        ],
    })
</script>
<?php $this->endsection('script'); ?>