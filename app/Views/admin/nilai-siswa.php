<?php $this->extend('admin/layout'); ?>

<?php $this->section('content'); ?>
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?= $siswa['nama'] ?></h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal row" method="post" id="form-add">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="fkKelas" value="<?= $siswa['id_kelas'] ?>">
                    <input type="hidden" name="fkSiswa" value="<?= $siswa['nis'] ?>">
                    <div class="form-body">
                        <div class="row">

                            <?php $NilaiModel = model('NilaiModel') ?>

                            <?php foreach ($mapel as $Mapel) : ?>
                                <?php $nilai = $NilaiModel->where('fkSiswa', $siswa['nis'])->where('fkKelas', $siswa['id_kelas'])->where('fkMapel', $Mapel['id'])->first(); ?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="input<?= $Mapel['id'] ?>"><?= $Mapel['pelajaran'] ?></label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="number" id="input<?= $Mapel['id'] ?>" class="form-control" name="<?= $Mapel['id'] ?>" placeholder="-" value="<?= (is_null($nilai)) ? '0' : $nilai['nilai'] ?>" min="0" max="100" />
                                    </div>
                                </div>
                            <?php endforeach; ?>


                            <div class=" col-sm-12 d-flex justify-content-end mt-2">
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
<?php $this->endsection('script'); ?>