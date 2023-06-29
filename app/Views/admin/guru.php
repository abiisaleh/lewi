<?php $this->extend('admin/layout'); ?>

<?php $this->section('tools'); ?>
<button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#modal-add">
  <i class="bi bi-plus"></i> <span class="d-none d-sm-inline">Tambah</span> Data
</button>
<?php $this->endsection('tools'); ?>

<?php $this->section('content'); ?>
<?= view_cell('TableCell') ?>

<!--Basic Modal -->
<div class="modal fade text-left" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">
          Tambah Data
        </h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <form class="form form-horizontal row" id="form-add">
          <div class="form-body">
            <div class="row">

              <?= view_cell('InputCell', 'name=nip,text=NIP') ?>
              <?= view_cell('InputCell', 'name=nama,text=Nama') ?>
              <?= view_cell('SelectCell', ['name' => 'gol', 'text' => 'Gol.', 'option' => ['I', 'II', 'III', 'IV']]) ?>
              <?= view_cell('SelectCell', ['name' => 'ruang', 'text' => 'Ruang', 'option' => ['a', 'b', 'c', 'd']]) ?>
              <?= view_cell('InputCell', 'name=tempt_lahir,text=Tempat Lahir') ?>
              <?= view_cell('InputCell', 'name=tgl_lahir,text=Tanggal Lahir,type=date') ?>
              <?= view_cell('SelectCell', ['name' => 'jk', 'text' => 'Jenis Kelamin', 'option' => ['Laki-laki', 'Perempuan']]) ?>
              <?= view_cell('InputCell', 'name=telp,text=Telp,type=number') ?>

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
    colReorder: true,
    ajax: window.location.href,
    columns: [{
        "title": "Nama",
        "data": "nama"
      },
      {
        "title": "NIP",
        "data": "nip"
      },
      {
        "title": "Gol/ruang",
        "data": null,
        "render": function(data, type, row) {
          return data.gol + '/' + data.ruang
        }
      },
      {
        "title": "JK",
        "data": "jk"
      },
      {
        "title": "Tgl Lahir",
        "data": "tgl_lahir"
      },
      {
        "title": "Telp",
        "data": "telp"
      },
      {
        "title": "Aksi",
        "width": "15%"
      },
    ],
    columnDefs: [{
      "targets": -1,
      "data": null,
      "defaultContent": "<button class='btn btn-sm btn-danger btnHapus'>Hapus</button> <button class='btn btn-sm btn-warning btnEdit'>Edit</button>"
    }],
  })

  //Tambah Data
  $('#form-add').submit(function(e) {
    e.preventDefault()
    $.ajax({
      url: window.location.href,
      type: 'POST',
      data: $(this).serialize(),
      success: function() {
        $('#modal-add').modal('hide')
        dataTable.ajax.reload()
        $('#form-add').reset()
      }
    })
  })

  //Hapus Data
  $('.table tbody').on('click', '.btnHapus', function() {
    var data = dataTable.row($(this).parents('tr')).data()
    var id = data.nip

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

  // Edit Data
  $('.table tbody').on('click', '.btnEdit', function() {
    var data = dataTable.row($(this).parents('tr')).data();

    $('#inputnip').val(data.nip);
    $('#inputnama').val(data.nama);
    $('#inputgol').val(data.gol);
    $('#inputruang').val(data.ruang);
    $('#inputtempt_lahir').val(data.tempt_lahir);
    $('#inputtgl_lahir').val(data.tgl_lahir);
    $('#inputjk').val(data.jk);
    $('#inputtelp').val(data.telp);

    $('#modal-add').modal('show');
  });
</script>
<?php $this->endsection('script'); ?>