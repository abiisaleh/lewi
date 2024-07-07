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
        helper('auth');
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $kelas = $this->request->getGet('tingkat');
        $ta = $this->request->getGet('ta') ?? $this->TAmodel->countAllResults();
        $data['allTA'] = $this->TAmodel->findAll();
        $data['ta'] = $this->TAmodel->find($ta);

        if ($this->request->isAjax()) {
            $dataWali = $this->WaliKelasModel
                ->guru()
                ->where('fkTA', $ta)
                ->findAll();

            $dataKelas = $this->KelasModel->findAll();

            foreach ($dataKelas as &$kelas) {
                $kelas['jumlah_siswa'] = $this->SiswaKelasModel->where('fkKelas', $kelas['id'])->where('fkTA', $ta)->countAllResults();

                foreach ($dataWali as $wali) {
                    if ($kelas['id'] == $wali['fkKelas']) {
                        $kelas['wali'] = $wali['nama'];
                        $kelas['jadwal'] = ($wali['jadwal'] == '') ? null : $wali['jadwal'];
                    } else {
                        $kelas['wali'] = null;
                        $kelas['jadwal'] = null;
                    }
                }
            }

            $data['data'] = $dataKelas;

            return $this->response->setJSON($data);
        } else {
            $data['title'] = 'Data Akademik';
            $tahun = $this->TAmodel->find($ta);

            $data['subtitle'] = 'Semester ' . $tahun['semester'] . ' T.A. ' . $tahun['tahun_awal'] . '/' . $tahun['tahun_akhir'];
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
        $idTA = str_split($id)[0];
        $idKelas = str_split($id)[2];

        $data['data'] = $this->SiswaKelasModel->where('fkKelas', $idKelas)->where('fkTA', $idTA)->siswa()->find();
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
        $data = $this->request->getPost();
        $this->TAmodel->insert($data);
        return redirect()->back();
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $idTA = str_split($id)[0];
        $idKelas = str_split($id)[2];

        $kelas = $this->KelasModel->find($idKelas);

        $data['title'] = 'Data Akademik';
        $data['subtitle'] = 'Kelas ' . $kelas['tingkat'] . ' ' . $kelas['jurusan'] . ' ' . $kelas['kode'];
        $data['kelas'] = $kelas;
        $data['ta'] = $idTA;
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
        $this->SiswaKelasModel->delete($id);
    }

    public function walikelas()
    {
        $data = $this->request->getPost();

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
