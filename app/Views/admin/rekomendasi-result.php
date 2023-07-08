<div class="card">
    <div class="card-header pb-1">
        <div class="row">
            <div class="col py-1">
                <h4 class="result-title">Hasil</h4>
            </div>
            <div class="col-auto">
                <!-- Button trigger for basic modal -->
                <button type="button" class="btn btn-outline-secondary btn-sm block" data-bs-toggle="modal" data-bs-target="#default">
                    <i class="bi bi-terminal"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="card-content pb-4">
        <?php (count($siswa) < 3) ? $max = count($siswa) : $max = 3 ?>
        <?php for ($i = 0; $i < $max; $i++) : ?>
            <div class="recent-message d-flex px-4 py-3">
                <div class="avatar bg-danger my-2">
                    <span class="avatar-content"><?= $i + 1 ?></span>
                </div>
                <div class="name w-100 ms-4">
                    <h5 class="mb-1"><?= $siswa[$i]['nama'] ?></h5>
                    <h6 class="text-muted mb-0"><?= $siswa[$i]['nis'] ?></h6>
                </div>
                <div class="p-2">
                    <span class="badge bg-primary d-none d-sm-inline"><?= $siswa[$i]['hasil'] ?></span>
                </div>
            </div>
        <?php endfor ?>
    </div>
</div>