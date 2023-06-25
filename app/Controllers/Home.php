<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = '';
        return view('user/index', $data);
    }

    public function siswa()
    {
        $nis = $this->request->getVar('nis');

        $data['title'] = 'Data Siswa';
        $data['siswa'] = model('SiswaModel')->find($nis);
        $data['kelas'] = model('SiswaKelasModel')->kelas($nis)->first();
        $data['pelanggaran'] = model('PelanggaranSiswaModel')->skor($nis);
        $data['nilai'] = model('SiswaModel')->find($nis);

        return view('user/siswa', $data);
    }
}
