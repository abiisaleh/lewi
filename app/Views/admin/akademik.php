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
        <form class="form form-horizontal row" method="post" enctype="multipart/form-data" id="form-add">
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
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal Wali Kelas -->
<div>
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
</div>

<!-- Modal Jadwal -->
<div>
  <div class="modal fade text-left" id="modal-jadwal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel1">
            Jadwal pelajaran
          </h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="mx-2">
            <form class="form form-horizontal row" id="form-jadwal">
              <!-- Basic file uploader -->
              <input type="file" class="basic-filepond" name="filepond">
              <p class="card-text">Unggah jadwal pelajaran dengan format <code>.pdf</code></p>
            </form>
          </div>
        </div>
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
  // Filepond: Basic
  FilePond.create(document.querySelector(".basic-filepond"), {
    credits: null,
    allowImagePreview: false,
    allowMultiple: false,
    allowFileEncode: false,
    required: false,
  });

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
        "title": "Jadwal",
        "data": null,
        "render": function(data) {
          return '<a href="uploads/' + data.jadwal + '">' + data.jadwal + '</a>'
        }
      },
      {
        "title": "Aksi",
        "width": "20%",
        "data": null,
        "render": function(data) {
          return `
          <button class='btn btn-sm btn-warning btnWali'>wali</button>
          <a class='btn btn-sm btn-danger' href='` + window.location.href + '/' + data.id + `/edit'>siswa</a>
          <button class="btn btn-sm btn-primary btnJadwal">jadwal</button>
          `
        }

      },
    ]
  })

  // Edit Walikelas
  $('#tabel tbody').on('click', '.btnWali', function() {
    var data = dataTable.row($(this).parents('tr')).data();

    $('#inputfkKelas').val(data.id);
    $('#inputfkGuru').val(data.wali);

    $('#modal-wali').modal('show');
  });

  // Upload jadwal
  $('#tabel tbody').on('click', '.btnJadwal', function() {
    var data = dataTable.row($(this).parents('tr')).data();

    FilePond.setOptions({
      server: {
        process: {
          url: '<?= base_url('admin/jadwal') ?>',
          method: 'POST',
          withCredentials: false,
          headers: {},
          timeout: 7000,
          onload: null,
          onerror: null,
          ondata: function(formData) {
            // Append additional data to the FormData object
            formData.append('fkKelas', data.id);

            // Return the modified FormData object
            return formData;
          }
        }
      }
    });


    $('#modal-jadwal').modal('show');
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