<?php $this->extend('admin'); ?>

<?php $this->section('tools'); ?>
<div class="float-start float-sm-end">
  <button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#modal-add">
    <i class="bi bi-plus"></i> Tambah Data
  </button>
</div>
<?php $this->endsection('tools'); ?>

<?php $this->section('content'); ?>
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="tabel"></table>
    </div>
  </div>
</div>

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
        <form class="form form-horizontal row" enctype="multipart/form-data" id="form-add">
          <?= csrf_field(); ?>
          <input type="text" id="inputid" name="id" hidden>
          <div class="form-body">
            <div class="row">

              <?= view_cell('InputCell', 'name=pelajaran,text=Pelajaran') ?>
              <?= view_cell('SelectCell', ['name' => 'jurusan', 'text' => 'Jurusan', 'option' => ['IPA', 'IPS', 'BAHASA']]) ?>

              <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">
                  Submit
                </button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                  Reset
                </button>
              </div>
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
  var dataTable = $('#tabel').DataTable({
    responsive: true,
    autoWidth: false,
    processing: true,
    ajax: window.location.href,
    columns: [{
        "title": "#",
        "data": "id"
      },
      {
        "title": "Pelajaran",
        "data": "pelajaran"
      },
      {
        "title": "Jurusan",
        "data": "jurusan"
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
        $('#form-add')[0].reset()
      }
    })
  })

  //Hapus Data
  $('#tabel tbody').on('click', '.btnHapus', function() {
    var data = dataTable.row($(this).parents('tr')).data()
    var id = data.nis

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
  $('#tabel tbody').on('click', '.btnEdit', function() {
    var data = dataTable.row($(this).parents('tr')).data();

    $('#inputid').val(data.id);
    $('#inputjudul').val(data.judul);
    $('#inputpenulis').val(data.penulis);
    $('#inputpenerbit').val(data.penerbit);
    $('#inputrilis').val(data.rilis);
    $('#inputkategori').val(data.fk_kategori);

    $('#modal-add').modal('show');
  });
</script>
<?php $this->endsection('script'); ?>