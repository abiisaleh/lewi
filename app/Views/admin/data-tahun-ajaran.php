<?php $this->extend('admin/layout'); ?>

<?php $this->section('tools'); ?>
<button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#modal-add" id="btnTambah">
  <i class="bi bi-plus"></i> <span class="d-none d-sm-inline">Tambah</span> Data
</button>
<?php $this->endsection('tools'); ?>

<?php $this->section('content'); ?>
<?= view_cell('TableCell', 'id=tabel') ?>

<!--Basic Modal -->
<div class="modal modal-md fade text-left" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
              <div class="col-md-4">
                <label for="inputTahun">Tahun Ajaran</label>
              </div>
              <div class="col-md-8 form-group">
                <div class="row">
                  <div class="col-5">
                    <input type="number" id="inputTahun" class="form-control" name="tahun awal" placeholder="-" min="2000" maxlength="4" />
                  </div>
                  <div class="col-2">
                    <p class="mt-2 text-center">/</p>
                  </div>
                  <div class="col-5">
                    <input type="number" id="inputTahun2" class="form-control" name="tahun akhir" placeholder="-" min="2000" maxlength="4" />
                  </div>
                </div>
              </div>

              <?= view_cell('SelectCell', ['name' => 'semester', 'text' => 'Semester', 'option' => ['I', 'II']]) ?>

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
<?php $this->endsection('content'); ?>

<?php $this->section('script'); ?>
<script>
  var dataTable = $('#tabel').DataTable({
    autoWidth: false,
    processing: true,
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
    },
    ajax: window.location.href,
    columns: [{
        "title": "Tahun Ajaran",
        "data": null,
        "render": function(data) {
          return tahun_ajaran = data.tahun_awal + ' / ' + data.tahun_akhir
        },
      },
      {
        "title": "Semester",
        "data": "semester"
      },
      {
        "title": "Aktif",
        "data": null,
        "render": function(data) {
          return `
            <div class="form-check form-switch">
                <input class="form-check-input toogleAktif" type="checkbox" ${data.aktif == '1' ? 'checked disabled' : ''} >
            </div>
          `
        }
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
  $('#btnTambah').click(function() {
    $('#form-add')[0].reset()
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

  // Edit Data
  $('#tabel tbody').on('click', '.btnEdit', function() {
    var data = dataTable.row($(this).parents('tr')).data();

    $('#inputid').val(data.id);
    $('#inputTahun').val(data.tahun_akhir);
    $('#inputTahun2').val(data.tahun_awal);
    $('#inputSemester').val(data.semester);

    $('#modal-add').modal('show');
  });

  // Aktif Toogle
  $('#tabel tbody').on('click', '.toogleAktif', function() {
    var data = dataTable.row($(this).parents('tr')).data()
    var id = data.id
    var aktif = data.aktif == 0 ? 1 : 0

    if (confirm(`Aktifkan tahun ajaran ${data.tahun_awal} / ${data.tahun_akhir} semseter ${data.semester}?`)) {
      $.ajax({
        url: window.location.href + '/' + id,
        type: 'PUT',
        data: JSON.stringify({
          aktif: aktif
        }),
        success: function() {
          dataTable.ajax.reload()
        }
      })
    } else {
      this.checked = false
    }
  });
</script>
<?php $this->endsection('script'); ?>