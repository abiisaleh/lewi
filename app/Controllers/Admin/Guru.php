<?php


namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

class Guru extends ResourceController
{
    protected $modelName = 'App\Models\GuruModel';

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
            $data['title'] = 'Data Guru';
            return view('admin/guru', $data);
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
        $userModel = model('UserModel');

        $data = $this->request->getVar();
        $guru = $this->model->find($data['nip']);

        $user = [
            'email' => $data['nip'] . '@demo.com',
            'username' => $data['nip'],
            'password' => $data['nip'],
        ];

        if (is_null($guru)) {
            $this->model->insert($data);

            //buatkan data user
            $userModel
                ->withGroup('guru')
                ->insert($user);
        } else {
            $this->model->save($data);

            //ubah data user
            $user = $userModel
                ->withGroup('guru')
                ->save($user);
        }
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

    public function select2()
    {
        $query = $this->request->getVar('q');

        if ($query) {
            $array = $this->model->search($query)->findAll();
        } else {
            $array = $this->model->findAll();
        }

        $newArray = array_map(function ($item) {
            return ['text' => $item['nama'], 'id' => $item['nip']];
        }, $array);

        $data['results'] = $newArray;

        return $this->response->setJSON($data);
    }
}
