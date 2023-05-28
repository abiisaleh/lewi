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
            return view('admin/akademik', $data);
        }

        //ganti wali kelas
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //pilih kelas
        if ($id == 'kelas') {
            $tingkat = $this->request->getVar('tingkat');
            $jurusan = $this->request->getVar('jurusan');
            $kode = $this->request->getVar('kode');

            $kelasModel = model('KelasModel');

            $data = $kelasModel
                ->where('tingkat', $tingkat)
                ->where('jurusan', $jurusan)
                ->where('kode', $kode)
                ->find();
            d($data);
        }
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
}
