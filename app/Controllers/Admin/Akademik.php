<?php


namespace App\Controllers\Admin;

use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use App\Models\TaModel;
use App\Models\WaliKelasModel;
use CodeIgniter\RESTful\ResourceController;

class Akademik extends ResourceController
{
    protected $TAmodel;
    protected $KelasModel;
    protected $WaliKelasModel;
    protected $SiswaKelasModel;

    public function __construct()
    {
        $this->TAmodel = new TaModel();
        $this->KelasModel = new KelasModel();
        $this->WaliKelasModel = new WaliKelasModel();
        $this->SiswaKelasModel = new SiswaKelasModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $kelas = $this->request->getVar('tingkat');

        if ($this->request->isAjax()) {
            $data['data'] = $this->KelasModel->wali()->findAll();

            return $this->response->setJSON($data);
        } else {
            helper('auth');
            $data['title'] = 'Data Akademik';
            $data['subtitle'] = 'Semester I T.A. 2019/2020';
            return view('admin/akademik', $data);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data['data'] = $this->SiswaKelasModel->where('fkKelas', $id)->siswa()->find();
        return $this->response->setJSON($data);
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
        helper('auth');

        $kelas = $this->KelasModel->find($id);

        $data['title'] = 'Data Akademik';
        $data['subtitle'] = 'Kelas ' . $kelas['tingkat'] . ' ' . $kelas['jurusan'] . ' ' . $kelas['kode'];
        $data['kelas'] = $kelas;
        return view('admin/akademik-siswa', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
    }

    public function walikelas()
    {
        $data = $this->request->getPost();
        $data['fkTA'] = $this->TAmodel->countAllResults();

        // Cek data wali kelas.
        $data['id'] = $this->WaliKelasModel
            ->where('fkKelas', $data['fkKelas'])
            ->where('fkTA', $data['fkTA'])
            ->first();

        if (!is_null($data['id'])) {
            $data['id'] = $data['id']['id'];
        }

        $this->WaliKelasModel->save($data);
    }

    public function siswa()
    {
        $data = $this->request->getPost();
        $data['fkTA'] = $this->TAmodel->countAllResults();

        // Cek data siswa di kelas.
        $siswa = $this->SiswaKelasModel
            ->where('fkKelas', $data['fkKelas'])
            ->where('fkTA', $data['fkTA'])
            ->where('fkSiswa', $data['fkSiswa'])
            ->first();

        if (is_null($siswa)) {
            $this->SiswaKelasModel->save($data);
        }
    }
}
