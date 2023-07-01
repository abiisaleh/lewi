<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['totalJurusan'] = 3;
        $data['totalKelas']   = model('KelasModel')->countAll();
        $data['totalGuru']    = model('GuruModel')->countAll();
        $data['totalSiswa']   = model('SiswaModel')->where('status', 'Aktif')->countAll();



        $kehadiran = model('AbsensiModel')->getKehadiran();

        $hasil = array(
            'alpa' => 0,
            'hadir' => 0,
            'izin' => 0,
            'sakit' => 0
        );

        foreach ($kehadiran as $item) {
            $ket = $item->ket;
            $jumlah = $item->jumlah;

            // Periksa apakah 'ket' ada di dalam array $hasil sebelum menambahkan jumlahnya
            if (array_key_exists($ket, $hasil)) {
                $hasil[$ket] += $jumlah;
            }
        }

        $urutan_ket = array('alpa', 'hadir', 'izin', 'sakit');
        $hasil_akhir = array();

        foreach ($urutan_ket as $ket) {
            $hasil_akhir[] = $hasil[$ket];
        }

        $resultString = '[' . implode(', ', $hasil_akhir) . ']';
        $data['kehadiran'] = $resultString;




        $pelanggaran = model('PelanggaranSiswaModel')->getGroupedMonths(date('Y'));
        $result = array_fill(0, 12, 0); // Membuat array baru dengan 12 elemen yang diinisialisasi dengan nilai 0

        foreach ($pelanggaran as $item) {
            $bulan = $item->bulan;
            $jumlah = $item->jumlah;

            $result[$bulan - 1] = $jumlah;
        }

        // Mengonversi array ke dalam bentuk numerik
        $result = array_map('intval', $result);
        //konvert ke string
        $resultString = '[' . implode(', ', $result) . ']';
        $data['pelanggaran'] = $resultString;


        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }
}
