<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;
use App\Models\PelanggaranSiswaModel;
use App\Models\SiswaModel;

class Pelanggaran extends BaseController
{
    protected $PelanggaranSiswaModel;

    public function __construct()
    {
        $this->PelanggaranSiswaModel = new PelanggaranSiswaModel();
    }

    public function index()
    {
        if ($this->request->isAjax()) {
            $data['data'] = $this->PelanggaranSiswaModel->siswa()->find();
            return $this->response->setJSON($data);
        } else {
            helper('auth');
            $data['title'] = 'Data Pelanggaran Siswa';
            return view('admin/pelanggaran', $data);
        }
    }

    public function save()
    {
        $data = $this->request->getPost();
        $data['tgl'] = date('Y-m-d');

        $this->PelanggaranSiswaModel->save($data);
    }
}
