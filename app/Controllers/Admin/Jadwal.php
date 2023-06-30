<?php

namespace App\Controllers\Admin;

use App\Models\JadwalModel;
use CodeIgniter\RESTful\ResourceController;

class Jadwal extends ResourceController
{
    protected $modelName = 'App\Models\WaliKelasModel';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
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
        $fkKelas = $this->request->getPost('fkKelas');

        $TA = model('TaModel')->countAll();
        // Cek data id wali kelas.
        $data = $this->model
            ->where('fkKelas', $fkKelas)
            ->where('fkTA', $TA)
            ->first();

        $jadwal = $this->request->getFile('filepond');
        $jadwalName = $jadwal->getRandomName();
        $jadwal->move('uploads', $jadwalName);

        //simpan di tabel wali_kelas
        $data['fkKelas'] = $fkKelas;
        $data['fkTA'] = $TA;
        $data['jadwal'] = $jadwalName;
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
        //
    }
}
