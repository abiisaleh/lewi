<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;
use App\Models\WaliKelasModel;

class Absensi extends BaseController
{
    protected $WaliKelasModel;

    public function __construct()
    {
        $this->WaliKelasModel = new WaliKelasModel();
    }

    public function index()
    {
        $data['kelas']['id'] = $this->WaliKelasModel->kelas(user()->username);

        if ($data['kelas']['id']) {
            $kelas = model('KelasModel')->find($data['kelas']['id']);

            $data['subtitle'] = 'Kelas ' . $kelas['tingkat'] . ' ' . $kelas['jurusan'] . ' ' . $kelas['kode'];
        }
        if ($this->request->isAjax()) {
            // $data['session'] = session()->getFlashdata('kelas');
            $idkelas = $this->WaliKelasModel->kelas(user()->username);
            $idTA = model('TaModel')->countAll();
            $data['data'] = model('SiswaModel')->absensi($idkelas, $idTA)->find();

            return $this->response->setJSON($data);
        } else {
            $data['title'] = 'Data Kehadiran Siswa';
            return view('admin/absensi', $data);
        }
    }

    public function save()
    {
        $data = $this->request->getPost();
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
