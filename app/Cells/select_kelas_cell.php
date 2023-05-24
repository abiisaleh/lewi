<div class="card">
    <div class="card-header">
        <h5 class="card-title">Kelas</h5>
    </div>
    <div class="card-body">
        <form class="form form-horizontal row" id="form-add">
            <div class="row">
                <?= csrf_field(); ?>
                <div class="form-body">
                    <div class="row">
                        <?= view_cell('SelectCell', ['name' => 'tingkat', 'text' => 'Tingkat', 'option' => ['X', 'XI', 'XII']]) ?>
                        <?= view_cell('SelectCell', ['name' => 'jurusan', 'text' => 'Jurusan', 'option' => ['IPA', 'IPS', 'BAHASA']]) ?>
                        <?= ($kode == true) ?  view_cell('SelectCell', ['name' => 'kode', 'text' => 'Kode', 'option' => ['1', '2', '3']]) : '' ?>
                    </div>
                </div>
            </div>
    </div>
    <div class="card-footer">
        <div class="d-grid gap-2 mx-auto">
            <button type="submit" id="btnResult" class="btn btn-primary me-1 mb-1">
                Tampilkan
            </button>
        </div>
        </form>
    </div>
</div>