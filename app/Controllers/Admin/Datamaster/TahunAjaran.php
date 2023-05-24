<?php


namespace App\Controllers\Admin\Datamaster;

use App\Models\KelasModel;
use App\Models\TaModel;
use CodeIgniter\RESTful\ResourceController;

class TahunAjaran extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TaModel();   
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $data['data'] = $this->model->findAll();

            return $this->response->setJSON($data);

        } else {
            helper('auth');
            $data['title'] = 'Data Tahun Ajaran';
            return view('admin/data-ta',$data);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
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
        $data = $this->request->getVar();
        $this->model->save($data);
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
