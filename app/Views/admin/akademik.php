<?php $this->extend('admin/layout'); ?>

<?php $this->section('tools'); ?>
<button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#modal-add">
  <i class="bi bi-plus"></i> <span class="d-none d-sm-inline">Tahun Ajaran Baru</span> <span class="d-sm-none">TA</span>
</button>

<!-- Modal Tahun Akademik -->
<div class="modal fade text-left" id="modal-add">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">
          Tahun Ajaran
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

              <?= view_cell('InputCell', ['name' => 'judul', 'text' => 'Tahun Ajaran']) ?>

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
</div>

<!-- Modal Wali Kelas -->
<div class="modal fade text-left" id="modal-wali" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">
          Wali Kelas
        </h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <form class="form form-horizontal row" id="form-wali">
          <?= csrf_field(); ?>
          <input type="hidden" id="inputfkKelas">
          <div class="form-body">
            <div class="row">
              <?= view_cell('SelectCell', ['name' => 'fkGuru', 'text' => 'Nama Guru', 'option' => ['-']]) ?>
              <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">
                  Simpan
                </button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $this->endsection('tools'); ?>

<?php $this->section('content'); ?>
<div class="row">
  <div class="col-12">
    <?= view_cell('TableCell', 'id=tabel') ?>
  </div>
</div>

<?php $this->endsection('content'); ?>

<?php $this->section('script'); ?>
<script>
  $('#inputfkGuru').select2({
    ajax: {
      url: '/api/select2/guru',
    },
    theme: "bootstrap-5",
    dropdownParent: $('#modal-wali'),
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
        "title": "Kelas",
        "data": null,
        "render": function(data) {
          var kelas = data.tingkat + ' ' + data.jurusan + ' ' + data.kode
          return kelas
        },
      },
      {
        "title": "Wali Kelas",
        "data": "wali"
      },
      {
        "title": "Jumlah Siswa",
        "data": "jumlah_siswa",
      },
      {
        "title": "Aksi",
        "width": "20%",
        "data": null,
        "render": function(data) {
          return `
          <button class='btn btn-sm btn-warning btnEdit'>wali</button>
          <a class='btn btn-sm btn-danger' href='` + window.location.href + '/' + data.id + `/edit'>siswa</a>
          <a class='btn btn-sm btn-primary' href='` + window.location.href + '/jadwal/' + data.id + `'>jadwal</a>
          `
        }

      },
    ]
  })

  // Edit Data
  $('#tabel tbody').on('click', '.btnEdit', function() {
    var data = dataTable.row($(this).parents('tr')).data();

    $('#inputfkKelas').val(data.id);
    $('#inputfkGuru').val(data.wali);

    $('#modal-wali').modal('show');
  });

  //Simpan Data Wali
  $('#form-wali').submit(function(e) {
    e.preventDefault()
    $.ajax({
      url: window.location.href + '/walikelas',
      type: 'POST',
      data: {
        fkKelas: $('#inputfkKelas').val(),
        fkGuru: $('#inputfkGuru').val(),
      },
      success: function() {
        $('#modal-wali').modal('hide')
        dataTable.ajax.reload()
        $('#form-wali')[0].reset()
      }
    })
  })
</script>
<?php $this->endsection('script'); ?>