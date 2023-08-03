<?php

namespace App\Controllers\Admin\Monitoring;

use App\Models\MapelModel;
use App\Models\NilaiModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use App\Models\WaliKelasModel;
use CodeIgniter\RESTful\ResourceController;

class Nilai extends ResourceController
{
    protected $NilaiModel;
    protected $SiswaModel;
    protected $MapelModel;
    protected $SiswaKelasModel;
    protected $WaliKelasModel;

    public function __construct()
    {
        $this->NilaiModel = new NilaiModel();
        $this->SiswaModel = new SiswaModel();
        $this->MapelModel = new MapelModel();
        $this->SiswaKelasModel = new SiswaKelasModel();
        $this->WaliKelasModel = new WaliKelasModel();
        helper('auth');
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['kelas']['id'] = $this->WaliKelasModel->kelas(user()->username);

        $lastTA = model('TaModel')->countAllResults();
        $ta = model('TaModel')->find($lastTA);


        if ($data['kelas']['id']) {
            $kelas = model('KelasModel')->find($data['kelas']['id']);

            $data['subtitle'] = 'Semester ' . $ta['semester'] . ' Tahun Ajaran ' . $ta['tahun_awal'] . '/' . $ta['tahun_akhir'] . ' <br> Kelas ' . $kelas['tingkat'] . ' ' . $kelas['jurusan'] . ' ' . $kelas['kode'];
        }
        if ($this->request->isAjax()) {
            //ambil data kelas berdasarkan wali kelas yang login
            $kelas = $this->WaliKelasModel->kelas(user()->username);

            // $data['session'] = session()->getFlashdata('kelas');
            $data['data'] = $this->SiswaModel->nilai($kelas)->find();

            //cek peringkat
            if (!is_null($data['data'])) {
                usort($data['data'], fn ($a, $b) => $b['nilai'] - $a['nilai']);

                $TA = model('TaModel')->countAll();
                $peringkat = 0;
                foreach ($data['data'] as &$Siswa) {
                    $peringkat += 1;
                    //simpan data pringkat
                    $Siswa['peringkat'] = $peringkat;

                    $idKelasSiswa = $this->SiswaKelasModel
                        ->where('fkKelas', $kelas)
                        ->where('fkSiswa', $Siswa['nis'])
                        ->where('fkTA', $TA)
                        ->first()['id'];

                    $this->SiswaKelasModel
                        ->save([
                            'id' => $idKelasSiswa,
                            'peringkat' => $peringkat
                        ]);
                }
            }

            return $this->response->setJSON($data);
        } else {
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
        $data = $this->request->getPost();

        //ambil key dari data yang dikirim
        $keys = array_keys($data);

        //variabel yang bukan mapel
        $notMapel = ['csrf_test_name', '_method', 'fkKelasSiswaTa', 'fkSiswa'];

        //lakukan perulangan untuk tiap mapel
        foreach ($keys as $mapel) {
            if (!in_array($mapel, $notMapel)) {
                //cek siswa
                $nilai = $this->NilaiModel
                    ->where('fkSiswa', $data['fkSiswa'])
                    ->where('fkKelasSiswaTa', $data['fkKelasSiswaTa'])
                    ->where('fkMapel', $mapel)
                    ->first();

                if (!is_null($nilai)) {
                    $value['id'] = $nilai['id'];
                }

                $value['fkSiswa'] = $data['fkSiswa'];
                $value['fkKelasSiswaTa'] = $data['fkKelasSiswaTa'];
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
