<?php

namespace App\Controllers\Admin\Monitoring;

use CodeIgniter\RESTful\ResourceController;

class Prestasi extends ResourceController
{
    protected $modelName = 'App\Models\PrestasiModel';
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $idkelas = model('WaliKelasModel')->kelas(user()->username);

        $lastTA = model('TaModel')->countAllResults();
        $ta = model('TaModel')->find($lastTA);


        if ($idkelas) {
            $kelas = model('KelasModel')->find($idkelas);

            $data['subtitle'] = 'Semester ' . $ta['semester'] . ' Tahun Ajaran ' . $ta['tahun_awal'] . '/' . $ta['tahun_akhir'] . ' <br> Kelas ' . $kelas['tingkat'] . ' ' . $kelas['jurusan'] . ' ' . $kelas['kode'];
        }
        if ($this->request->isAjax()) {
            //data prestasi non akademik
            $data['data'] = $this->model->kelas($idkelas, $ta['id'])->find();

            return $this->response->setJSON($data);
        } else {
            $data['title'] = 'Prestasi Non Akademik Siswa';
            //data siswa
            $data['siswa'] = model('SiswaModel')->kelas()->where('fkKelas', $idkelas)->find();

            return view('admin/prestasi', $data);
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

        //ambil data kelas siswa ta
        $data['fkKelasSiswaTa'] =  model('SiswaKelasModel')->Kelas($data['fkSiswa'])->find()[0]['id'];

        $this->model->save($data);

        //kirim notifikasi ke orangtua
        $siswa = model('SiswaModel')->find($data['fkSiswa']);
        $prestasi = $data['prestasi'];
        $telp = substr_replace($siswa['telp_ortu'], "62", 0, 1);

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://web-production-d03d.up.railway.app/message/text?key=ranubot',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'id=' . $telp . '&message=Kami dari SMA YPPK Jayapura ingin menginformasikan bahwa anak ibu yang bernama ' . $siswa['nama'] . ' mendapatkan prestasi yaitu ' . $prestasi,
            ));

            curl_exec($curl);
            curl_close($curl);
        } catch (\Throwable $th) {
            //throw $th;
            $this->response->setBody('gagal mengirim pesan');
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
}
