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
            $data['data'] = $this->model->orderBy('id', 'DESC')->findAll();

            return $this->response->setJSON($data);
        } else {
            $data['title'] = 'Data Kelas';
            return view('admin/data-tahun-ajaran', $data);
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
        $data = $this->request->getPost();
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
        $this->model->where('aktif', 1)->set(["aktif" => 0])->update();

        $this->model->update($id, $this->request->getJSON());
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
