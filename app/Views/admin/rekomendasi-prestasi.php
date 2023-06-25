<?php $this->extend('admin/layout'); ?>

<?php $this->section('content'); ?>
<div class="row">
    <div class="col-md-6">
        <?= view_cell('SelectKelasCell', ['kode' => false, 'btn' => 'Proses']) ?>
    </div>

    <div class="col-md-6 animate__bounceIn d-none" id="result">
        <div class="card">
            <div class="card-header pb-1">
                <h4>Hasil</h4>
            </div>
            <div class="card-content pb-4">
                <div class="recent-message d-flex px-4 py-3">
                    <div class="avatar bg-danger my-2">
                        <span class="avatar-content">1</span>
                    </div>
                    <div class="name w-100 ms-4">
                        <h5 class="mb-1">Hank Schrader</h5>
                        <h6 class="text-muted mb-0">123123909</h6>
                    </div>
                    <div class="p-2">
                        <span class="badge bg-primary d-none d-sm-inline">34</span>
                    </div>
                </div>
                <div class="recent-message d-flex px-4 py-3">
                    <div class="avatar bg-warning my-2">
                        <span class="avatar-content">2</span>
                    </div>
                    <div class="name w-100 ms-4">
                        <h5 class="mb-1">Dean Winchester</h5>
                        <h6 class="text-muted mb-0">@imdean</h6>
                    </div>
                    <div class="p-2">
                        <span class="badge bg-primary d-none d-sm-inline">34</span>
                    </div>
                </div>
                <div class="recent-message d-flex px-4 py-3">
                    <div class="avatar bg-success my-2">
                        <span class="avatar-content">3</span>
                    </div>
                    <div class="name w-100 ms-4">
                        <h5 class="mb-1">John Dodol</h5>
                        <h6 class="text-muted mb-0">@dodoljohn</h6>
                    </div>
                    <div class="p-2">
                        <span class="badge bg-primary d-none d-sm-inline b-1">34</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->endsection('content');
$this->section('script');
?>

<script>
    $('#btnResult').click(function() {
        event.preventDefault();
        $('#result').removeClass('d-none')
    })
</script>

<?php $this->endsection('script'); ?>

<?php $this->section('style'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<?php $this->endsection('style'); ?>