<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (in_groups(['admin', 'guru'])) {
            return redirect()->to('admin');
        }

        $data['title'] = '';
        return view('user/index', $data);
    }

    public function siswa()
    {
        $nis = $this->request->getPost('nis');

        $data['title'] = 'Data Siswa';
        $data['siswa'] = model('SiswaModel')->find($nis);
        $data['kelas'] = model('SiswaKelasModel')->kelas($nis)->first();
        $data['skorPelanggaran'] = model('PelanggaranSiswaModel')->skor($nis);
        $data['pelanggaran'] = model('PelanggaranSiswaModel')->join('pelanggaran', 'pelanggaran.id = fkPelanggaran')->where('fkSiswa', $nis)->find();
        $data['nilai'] = model('SiswaModel')->find($nis);
        $data['absen'] = model('AbsensiModel')->where('fkSiswa', $nis)->where('tgl', date('Y-m-d'))->find($nis) ?? '';

        return view('user/siswa', $data);
    }
}
