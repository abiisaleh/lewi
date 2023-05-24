<?php $this->extend('admin'); ?>

<?php $this->section('tools'); ?>
<div class="float-start float-sm-end">
  <button type="button" class="btn btn-primary block" id="addTrigger" data-bs-toggle="modal" data-bs-target="#modal-add">
    <i class="bi bi-plus"></i> Tambah Data
  </button>
</div>
<?php $this->endsection('tools'); ?>

<?php $this->section('content'); ?>
<?= view_cell('TableCell') ?>

<!--Basic Modal -->
<div class="modal modal-lg fade text-left" id="modal-add">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-add-title">
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
              <div class="col-md-6">
                <div class="row">
                  <?= view_cell('InputCell', 'name=nis,text=NIS') ?>
                  <?= view_cell('InputCell', 'name=nama,text=Nama') ?>
                  <?= view_cell('InputCell', 'name=alamat,text=Alamat') ?>
                  <?= view_cell('InputCell', 'name=tempt_lahir,text=Tempat Lahir') ?>
                  <?= view_cell('InputCell', 'name=tgl_lahir,text=Tanggal Lahir,type=date') ?>
                  <?= view_cell('SelectCell', ['name' => 'jk', 'text' => 'Jenis Kelamin', 'option' => ['L', 'P']]) ?>
                  <?= view_cell('SelectCell', ['name' => 'agama', 'text' => 'Agama', 'option' => ['Kristen', 'Islam', 'Katholik', 'Hindu', 'Budha', 'Konghuchu']]) ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <?= view_cell('InputCell', 'name=telp,text=Telp,type=number') ?>
                  <?= view_cell('InputCell', 'name=telp_ortu,text=Telp Ortu.,type=number') ?>
                  <div class="col-md-4">
                    <label for="inputpenghasilan">Penghasilan Ortu</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <fieldset class="form-group">
                      <select class="form-select" id="inputpenghasilan" name="penghasilan_ortu">
                        <option>-</option>
                        <option value="1">
                          < 3,5 Juta</option>
                        <option value="2">3,5 Juta - 5 Juta</option>
                        <option value="3">> 5 Juta</option>
                      </select>
                    </fieldset>
                  </div>

                  <div class="col-md-4">
                    <label for="inputtanggungan">Tangunggan Ortu</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <fieldset class="form-group">
                      <select class="form-select" id="inputtanggungan" name="tanggungan_ortu">
                        <option>-</option>
                        <option value="1">1 Anak</option>
                        <option value="2">2 Anak</option>
                        <option value="3">> 2 Anak</option>
                      </select>
                    </fieldset>
                  </div>

                  <div class="col-md-4">
                    <label for="inputjarak">Jarak ke sekolah</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <fieldset class="form-group">
                      <select class="form-select" id="inputjarak" name="jarak_rumah">
                        <option>-</option>
                        <option value="1">
                          < 500m</option>
                        <option value="2">500m - 1km</option>
                        <option value="3">> 1km</option>
                      </select>
                    </fieldset>
                  </div>

                  <div class="col-md-4">
                    <label for="inputrumah">Kondisi rumah</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <fieldset class="form-group">
                      <select class="form-select" id="inputrumah" name="kondisi_rumah">
                        <option>-</option>
                        <option value="1">Layak</option>
                        <option value="2">Tidak Layak</option>
                      </select>
                    </fieldset>
                  </div>
                </div>
              </div>

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
  var dataTable = $('.table').DataTable({
    responsive: true,
    autoWidth: false,
    processing: true,
    ajax: window.location.href,
    columns: [{
        "title": "NIS",
        "data": "nis"
      },
      {
        "title": "Nama",
        "data": "nama"
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
        "title": "Agama",
        "data": "agama"
      },
      {
        "title": "Telp",
        "data": null,
        "width": "20%",
        "render": function(data) {
          return data.telp + ' (siswa) <br>' + data.telp_ortu + ' (ortu)'
        }
      },
      {
        "title": "Alamat",
        "data": "alamat"
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

  //Reset & Ubah nama modal
  $('#addTrigger').click(function() {
    $('#modal-add-title').text('Tambah Data');
    $('#form-add')[0].reset();
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
  $('.table tbody').on('click', '.btnHapus', function() {
    var data = dataTable.row($(this).parents('tr')).data()

    if (data == undefined) {
      data = dataTable.row($(this)).data();
    }

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
  $('.table tbody').on('click', '.btnEdit', function() {
    var data = dataTable.row($(this).parents('tr')).data();

    if (data == undefined) {
      data = dataTable.row($(this)).data();
    }

    $('#modal-add-title').text('Ubah Data');

    $('#inputnis').val(data.nis);
    $('#inputnama').val(data.nama);
    $('#inputalamat').val(data.alamat);
    $('#inputjk').val(data.jk);
    $('#inputtempt_lahir').val(data.tempt_lahir);
    $('#inputtgl_lahir').val(data.tgl_lahir);
    $('#inputagama').val(data.agama);
    $('#inputtelp').val(data.telp);
    $('#inputtelp_ortu').val(data.telp_ortu);
    $('#inputpenghasilan').val(data.penghasilan_ortu);
    $('#inputtanggungan').val(data.tanggungan_ortu);
    $('#inputjarak').val(data.jarak_rumah);
    $('#inputrumah').val(data.kondisi_rumah);

    $('#modal-add').modal('show');
  });
</script>
<?php $this->endsection('script'); ?>