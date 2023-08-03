<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;
use App\Models\PelanggaranSiswaModel;

class Pelanggaran extends BaseController
{
    protected $PelanggaranSiswaModel;

    public function __construct()
    {
        $this->PelanggaranSiswaModel = new PelanggaranSiswaModel();
    }

    public function index()
    {
        $lastTA = model('TaModel')->countAllResults();
        $ta = model('TaModel')->find($lastTA);

        $data['kelas']['id'] = model('WaliKelasModel')->kelas(user()->username);
        $kelas = model('KelasModel')->find($data['kelas']['id']);

        if ($this->request->isAjax()) {
            // $data['data'] = $this->PelanggaranSiswaModel->siswa()->find();

            //tiap wali hanya bisa lihat data muridnya
            $data['data'] = $this->PelanggaranSiswaModel->siswa()->wali(user()->username)->find();


            return $this->response->setJSON($data);
        } else {
            $data['title'] = 'Data Pelanggaran Siswa';
            $data['subtitle'] = 'Semester ' . $ta['semester'] . ' Tahun Ajaran ' . $ta['tahun_awal'] . '/' . $ta['tahun_akhir'] . ' <br> Kelas ' . $kelas['tingkat'] . ' ' . $kelas['jurusan'] . ' ' . $kelas['kode'];

            return view('admin/pelanggaran', $data);
        }
    }

    public function save()
    {
        $data = $this->request->getPost();
        $data['tgl'] = date('Y-m-d H:i:s');

        //ambil data kelas siswa ta
        $data['fkKelasSiswaTa'] =  model('SiswaKelasModel')->Kelas($data['fkSiswa'])->find()[0]['id'];

        $this->PelanggaranSiswaModel->save($data);

        //kirim notifikasi ke orangtua
        $siswa = model('SiswaModel')->find($data['fkSiswa']);
        $pelanggaran = model('PelanggaranModel')->find($data['fkPelanggaran'])['nama'];
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
                CURLOPT_POSTFIELDS => 'id=' . $telp . '&message=Kami dari SMA YPPK Jayapura ingin menginformasikan bahwa anak ibu yang bernama ' . $siswa['nama'] . ' melakukan pelanggaran yaitu ' . $pelanggaran,
            ));

            curl_exec($curl);
            curl_close($curl);
        } catch (\Throwable $th) {
            //throw $th;
            $this->response->setBody('gagal mengirim pesan');
        }
    }

    public function delete($id)
    {
        $this->PelanggaranSiswaModel->delete($id);
    }
}
