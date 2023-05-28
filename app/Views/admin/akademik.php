<?php $this->extend('admin'); ?>

<?php $this->section('tools'); ?>
<button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-target="#modal-add">
  <i class="bi bi-plus"></i> <span class="d-none d-sm-inline">Tahun Ajaran Baru</span> <span class="d-sm-none">TA</span>
</button>

<!-- Modal -->
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
<?php $this->endsection('tools'); ?>

<?php $this->section('content'); ?>
<div class="row">
  <div class="col-md-4">
    <?= view_cell('SelectKelasCell') ?>
  </div>
  <div class="col-md-8">
    <div class="col-12">
      <div class="card">
        <div class="card-content pb-4 mt-4">
          <div class="recent-message d-flex px-4 py-3">
            <div class="avatar bg-success my-2 me-1">
              <span class="avatar-content">HS</span>
            </div>
            <div class="name w-100 ms-4">
              <h5 class="mb-1">Hank Schrader</h5>
              <h6 class="text-muted mb-0">Wali Kelas</h6>
            </div>
            <div class="d-none d-sm-inline">
              <button class="btn btn-warning" id="editwali">Ganti</button>
              <!-- Modal Wali Kelas -->
              <div class="modal fade text-left" id="modal-wali">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="titlekelas"></h5>
                      <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                      </button>
                    </div>
                    <form class="form form-horizontal row" enctype="multipart/form-data" id="form-add">
                      <div class="form-body">
                        <div class="modal-body">
                          <?= csrf_field(); ?>
                          <input type="text" value="kelas" name="kelas" hidden>
                          <div class="row">

                            <?= view_cell('SelectCell', ['name' => 'guru', 'text' => 'Wali Kelas', 'option' => ['-']]) ?>

                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
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
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Siswa</h5>
          <form>
            <div class="form-body">
              <div class="row">
                <?= view_cell('SelectCell', ['name' => 'siswa', 'text' => 'NIS/Nama', 'option' => ['-']]) ?>
                <button class="btn btn-success">Tambahkan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <?= view_cell('TableCell', 'id=tabel') ?>
  </div>
</div>

<?php $this->endsection('content'); ?>

<?php $this->section('script'); ?>
<script>
  $('#inputsiswa').select2({
    ajax: {
      url: '/api/select2/siswa',
    },
    theme: "bootstrap-5",
  });

  $('#inputguru').select2({
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
    ajax: '',
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
        "title": "Aksi",
        "width": "15%"
      },
    ],
    columnDefs: [{
      "targets": -1,
      "data": null,
      "defaultContent": "<button class='btn btn-sm btn-danger btnDelete'>keluar</button>"
    }],
  })

  //wali
  $('#editwali').click(function() {
    kelas = $('#inputtingkat').val() + ' ' + $('#inputjurusan').val() + ' ' + $('#inputkode').val()

    $('#titlekelas').text(kelas)

    $('#modal-wali').modal('show');
  })
</script>
<?php $this->endsection('script'); ?>