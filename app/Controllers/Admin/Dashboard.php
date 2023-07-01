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

        $data['kehadiran'] = model('AbsensiModel')->where('tgl', date('Y:m:d'))->selectCount('ket')->find();

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
