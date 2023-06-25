<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;

class Absensi extends BaseController
{
    public function index()
    {
        $data['kelas']['id'] = $this->request->getVar('kelas');

        if ($data['kelas']['id']) {
            session()->setFlashdata('kelas', $data['kelas']['id']);
            $kelas = model('KelasModel')->find($data['kelas']['id']);

            $data['subtitle'] = 'Kelas ' . $kelas['tingkat'] . ' ' . $kelas['jurusan'] . ' ' . $kelas['kode'];
        }
        if ($this->request->isAjax()) {
            $data['session'] = session()->getFlashdata('kelas');
            $idkelas = session()->get('kelas');
            $idTA = model('TaModel')->countAll();
            $data['data'] = model('SiswaModel')->absensi($idkelas, $idTA)->find();

            return $this->response->setJSON($data);
        } else {
            helper('auth');
            $data['title'] = 'Data Kehadiran Siswa';
            return view('admin/absensi', $data);
        }
    }

    public function save()
    {
        $data = $this->request->getVar();
        $data['tgl'] = date('Y-m-d');

        //cek data absensi
        $AbsensiModel = model('AbsensiModel');
        $absensi = $AbsensiModel
            ->where('fkSiswa', $data['fkSiswa'])
            ->where('fkKelasSiswaTa', $data['fkKelasSiswaTa'])
            ->where('tgl', $data['tgl'])
            ->first();
        if (is_null($absensi)) {
            return $AbsensiModel->insert($data);
        } else {
            $data['id'] = $absensi['id'];
            return $AbsensiModel->save($data);
        }
    }
}
