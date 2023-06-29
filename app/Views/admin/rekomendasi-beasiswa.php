<?php $this->extend('admin/layout'); ?>

<?php $this->section('content'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Kelas</h5>
            </div>
            <div class="card-body">
                <form class="form form-horizontal row" method="POST" id="form-kelas">
                    <div class="row">
                        <div class="form-body">
                            <div class="row">
                                <?= view_cell('SelectCell', ['name' => 'tingkat', 'text' => 'Tingkat', 'option' => ['X', 'XI', 'XII']]) ?>
                                <?= view_cell('SelectCell', ['name' => 'jurusan', 'text' => 'Jurusan', 'option' => ['', 'IPA', 'IPS', 'BAHASA']]) ?>
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
    </div>

    <div class="col-md-6 animate__bounceIn d-none" id="result"></div>
</div>

<!--Basic Modal -->
<div class="modal modal-lg fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Perhitungan</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<?php
$this->endsection('content');
$this->section('script');
?>

<script>
    $('#form-kelas').submit(function(event) {
        // Mencegah pengiriman form secara default
        event.preventDefault();

        // Mengambil data form
        var formData = $(this).serialize();

        // Mengirim data form ke server menggunakan Ajax
        $.ajax({
            type: 'POST',
            url: window.location.href, // Ganti dengan URL tujuan pengiriman form
            data: formData,
            success: function(response) {
                // Menghandle respon sukses dari server
                $('#result').empty()
                $('.modal-body').empty()
                $('#result').addClass('d-none')

                setTimeout(function() {
                    // Perintah yang akan dijalankan setelah penundaan
                    // Contoh: Mengubah teks pada elemen dengan ID tertentu setelah 1 detik
                    $('#result').append(response.result)
                    $('.modal-body').append(response.perhitungan)
                    $('#result').removeClass('d-none')
                }, 500);
            },
            error: function(xhr, status, error) {
                // Menghandle respon error dari server
                console.log(xhr.responseText);
                alert('Terjadi kesalahan: ' + xhr.statusText);
            }
        });
    });
</script>

<?php $this->endsection('script'); ?>

<?php $this->section('style'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<?php $this->endsection('style'); ?>