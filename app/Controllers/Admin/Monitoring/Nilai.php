<?php

namespace App\Controllers\Admin\Monitoring;

use App\Models\MapelModel;
use App\Models\NilaiModel;
use App\Models\SiswaModel;
use CodeIgniter\RESTful\ResourceController;

class Nilai extends ResourceController
{
    protected $NilaiModel;
    protected $SiswaModel;
    protected $MapelModel;

    public function __construct()
    {
        $this->NilaiModel = new NilaiModel();
        $this->SiswaModel = new SiswaModel();
        $this->MapelModel = new MapelModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
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
            $data['data'] = $this->SiswaModel->nilai(session()->get('kelas'))->find();

            return $this->response->setJSON($data);
        } else {
            helper('auth');
            $data['title'] = 'Data Nilai Siswa';
            return view('admin/nilai', $data);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        helper('auth');

        $siswa = $this->SiswaModel->kelas()->find($id);

        $data['title'] = 'Data Nilai Siswa';
        $data['siswa'] = $siswa;

        //cari jurusan siswa
        $jurusan = $siswa['jurusan'];

        //ambil mapel umum + jurusan siswa
        $data['mapel'] = $this->MapelModel->whereIn('jurusan', ['Umum', $jurusan])->find();

        //tampila view nilai
        return view('admin/nilai-siswa', $data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = $this->request->getVar();

        //ambil key dari data yang dikirim
        $keys = array_keys($data);

        //variabel yang bukan mapel
        $notMapel = ['csrf_test_name', '_method', 'fkKelas', 'fkSiswa'];

        //lakukan perulangan untuk tiap mapel
        foreach ($keys as $mapel) {
            if (!in_array($mapel, $notMapel)) {
                //cek siswa
                $nilai = $this->NilaiModel
                    ->where('fkSiswa', $data['fkSiswa'])
                    ->where('fkKelas', $data['fkKelas'])
                    ->where('fkMapel', $mapel)
                    ->first();

                if (!is_null($nilai)) {
                    $value['id'] = $nilai['id'];
                }

                $value['fkSiswa'] = $data['fkSiswa'];
                $value['fkKelas'] = $data['fkKelas'];
                $value['fkMapel'] = $mapel;
                $value['nilai'] = $data[$mapel];

                $this->NilaiModel->save($value);
            }
        }

        return redirect()->back();
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
