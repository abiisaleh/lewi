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

        // $data['pelanggaran'] = model('PelanggaranSiswaModel')->whereIn('tgl', date('Y'))->selectCount('tgl');

        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }
}
