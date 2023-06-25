<?php $this->extend('admin/layout'); ?>

<?php $this->section('content'); ?>
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-3">Upload Jadwal</h5>
        <div class="form-body">
          <p class="card-text">Unggah jadwal pelajaran dengan format <code>.pdf</code></p>
          <!-- Basic file uploader -->
          <input type="file" class="basic-filepond">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title mb-3">Siswa</h5>
      <form id="form-siswa">
        <div class="form-body">
          <div class="row">
            <div class="col-sm-10">
              <div class="row">
                <?= view_cell('SelectCell', ['name' => 'fkSiswa', 'text' => 'NIS/Nama', 'option' => ['-']]) ?>
              </div>
            </div>
            <div class="col-sm-2">
              <button class="btn btn-success">Tambahkan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col">
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

  $('#inputfkSiswa').select2({
    ajax: {
      url: '/api/select2/siswa',
    },
    theme: "bootstrap-5",
  });

  var dataTable = $('#tabel').DataTable({
    responsive: true,
    autoWidth: false,
    processing: true,
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
    },
    ajax: '<?= base_url('admin/akademik/' . $kelas['id']) ?>',
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

  //Tambah siswa ke kelas
  $('#form-siswa').submit(function(e) {
    e.preventDefault()
    $.ajax({
      url: '<?= base_url('admin/akademik/siswa') ?>',
      type: 'POST',
      data: {
        fkKelas: '<?= $kelas['id'] ?>',
        fkSiswa: $('#inputfkSiswa').val(),
      },
      success: function() {
        dataTable.ajax.reload()
      }
    })
  })
</script>
<?php $this->endsection('script'); ?>