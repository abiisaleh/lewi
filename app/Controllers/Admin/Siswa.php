<?php


namespace App\Controllers\Admin;

use App\Models\SiswaModel;
use CodeIgniter\RESTful\ResourceController;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class Siswa extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SiswaModel();
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
            $data['title'] = 'Data Siswa';
            return view('admin/siswa', $data);
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
        $guru = $this->model->find($data['nis']);

        //simpan data guru
        if (is_null($guru)) {
            $this->model->insert($data);
        } else {
            $this->model->save($data);
        }

        //buatkan data user
        $users = model(UserModel::class);
        $user = new User([
            'email' => $data['nis'] . '@demo.com',
            'username' => $data['nis'],
            'password' => $data['nis'],
        ]);
        $user->activate();
        $users
            ->withGroup('siswa')
            ->save($user);
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
        $query = $this->request->getGet('q');

        if ($query) {
            $array = $this->model->search($query)->findAll();
        } else {
            $array = $this->model->findAll();
        }

        $newArray = array_map(function ($item) {
            return ['text' => $item['nama'], 'id' => $item['nis']];
        }, $array);

        $data['results'] = $newArray;

        return $this->response->setJSON($data);
    }
}
