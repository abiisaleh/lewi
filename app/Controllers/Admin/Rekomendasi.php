<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;
use App\Models\NilaiModel;
use App\Models\PelanggaranSiswaModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;

class Rekomendasi extends BaseController
{
    protected $SiswaModel;
    protected $SiswaKelasModel;
    protected $NilaiModel;
    protected $AbsensiModel;
    protected $PelanggaranSiswaModel;

    public function __construct()
    {
        $this->SiswaModel = new SiswaModel();
        $this->SiswaKelasModel = new SiswaKelasModel();
        $this->NilaiModel = new NilaiModel();
        $this->AbsensiModel = new AbsensiModel();
        $this->PelanggaranSiswaModel = new PelanggaranSiswaModel();
    }

    public function beasiswa()
    {
        $data['title'] = 'Rekomendasi Beasiswa';

        return view('admin/rekomendasi-beasiswa', $data);
    }

    public function beasiswa_get()
    {
        //cari siswa berdasarkan tingkat dan jurusan
        $tingkat = $this->request->getPost('tingkat');
        $jurusan = $this->request->getPost('jurusan');
        $TA = model('TaModel')->countAll();

        //bobot kriteria
        $kriteria = [
            ['nama' => 'Nilai Semester',    'bobot' => 0.41],
            ['nama' => 'Peringkat',         'bobot' => 0.24],
            ['nama' => 'penghasilan_ortu',  'bobot' => 0.16],
            ['nama' => 'tanggungan_ortu',   'bobot' => 0.10],
            ['nama' => 'jarak_rumah',       'bobot' => 0.06],
            ['nama' => 'kondisi_rumah',     'bobot' => 0.03],
        ];

        //ambil semua data siswa yang berkaitan
        $siswa = $this->SiswaKelasModel->JurusanKelas($tingkat, $jurusan, $TA)->find();

        foreach ($siswa as &$Siswa) {
            //nilai rata-rata,
            $Siswa['Nilai Semester'] = $this->NilaiModel->RataRata($Siswa['nis'])->first()['nilai'];

            //peringkat kelas,
            $Peringkat = $this->SiswaKelasModel->where('fkSiswa', $Siswa['nis'])->where('fkTA', $TA)->first()['peringkat'];

            //konversi peringkat
            if ($Peringkat == 0)
                $Siswa['Peringkat'] = 0;
            elseif ($Peringkat == 1)
                $Siswa['Peringkat'] = 100;
            elseif ($Peringkat == 2)
                $Siswa['Peringkat'] = 90;
            elseif ($Peringkat == 3)
                $Siswa['Peringkat'] = 80;
            elseif ($Peringkat == 4)
                $Siswa['Peringkat'] = 70;
            elseif ($Peringkat == 5)
                $Siswa['Peringkat'] = 60;
            elseif ($Peringkat == 6)
                $Siswa['Peringkat'] = 50;
            elseif ($Peringkat == 7)
                $Siswa['Peringkat'] = 40;
            else
                $Siswa['Peringkat'] = 30;


            //penghasilan orang tua, 
            //tanggungan orang tua, 
            //status rumah
            //jarak rumah ke sekolah.
            $result = $this->SiswaModel
                ->select('penghasilan_ortu,tanggungan_ortu,jarak_rumah,kondisi_rumah')
                ->find($Siswa['nis']);

            $Siswa['penghasilan_ortu'] = round(100 * $result['penghasilan_ortu'] / 3, 2);
            $Siswa['tanggungan_ortu']  = round(100 * $result['tanggungan_ortu'] / 3, 2);
            $Siswa['jarak_rumah']      = round(100 * $result['jarak_rumah'] / 3, 2);
            $Siswa['kondisi_rumah']    = round(100 * $result['kondisi_rumah'] / 2, 2);

            //hitung nilai x bobot kriteria 
            $Siswa['hasil'] = 0;

            foreach ($kriteria as $Kriteria) {
                //hitung masing-masing kriteria
                $Siswa['hasil_' . $Kriteria['nama']] = $Siswa[$Kriteria['nama']] * $Kriteria['bobot'];
                //jumlahkn tiap hasil dan hitung hasil akhir
                $Siswa['hasil'] += round($Siswa['hasil_' . $Kriteria['nama']], 2);
            }
        }

        // Menggunakan fungsi usort() untuk mengurutkan data berdasarkan hasil
        usort($siswa, fn ($a, $b) => $b['hasil'] - $a['hasil']);

        return $this->response->setJSON([
            'result' => view('admin/rekomendasi-result', ['siswa' => $siswa]),
            'perhitungan' => view('admin/rekomendasi-perhitungan-beasiswa', ['kriteria' => $kriteria, 'siswa' => $siswa])
        ]);
    }

    public function prestasi()
    {
        $data['title'] = 'Rekomendasi Prestasi';
        return view('admin/rekomendasi-prestasi', $data);
    }

    public function prestasi_get()
    {
        //cari siswa berdasarkan tingkat dan jurusan
        $tingkat = $this->request->getPost('tingkat');
        $jurusan = $this->request->getPost('jurusan');
        $TA = model('TaModel')->countAll();

        //bobot kriteria
        $kriteria = [
            ['nama' => 'Nilai Semester',    'bobot' => 0.52],
            ['nama' => 'Peringkat',         'bobot' => 0.27],
            ['nama' => 'kehadiran',         'bobot' => 0.15],
            ['nama' => 'pelanggaran',       'bobot' => 0.06],
        ];

        //ambil semua data siswa yang berkaitan
        $siswa = $this->SiswaKelasModel->JurusanKelas($tingkat, $jurusan, $TA)->find();

        foreach ($siswa as &$Siswa) {
            //nilai rata-rata,
            $Siswa['Nilai Semester'] = $this->NilaiModel->RataRata($Siswa['nis'])->first()['nilai'];

            //peringkat kelas,
            $Peringkat = $this->SiswaKelasModel->where('fkSiswa', $Siswa['nis'])->where('fkTA', $TA)->first()['peringkat'];
            $Siswa['peringkat_kelas'] = $Peringkat;

            // dd($Peringkat);

            //konversi peringkat
            if ($Peringkat == 0)
                $Siswa['Peringkat'] = 0;
            elseif ($Peringkat == 1)
                $Siswa['Peringkat'] = 100;
            elseif ($Peringkat == 2)
                $Siswa['Peringkat'] = 90;
            elseif ($Peringkat == 3)
                $Siswa['Peringkat'] = 80;
            elseif ($Peringkat == 4)
                $Siswa['Peringkat'] = 70;
            elseif ($Peringkat == 5)
                $Siswa['Peringkat'] = 60;
            elseif ($Peringkat == 6)
                $Siswa['Peringkat'] = 50;
            elseif ($Peringkat == 7)
                $Siswa['Peringkat'] = 40;
            else
                $Siswa['Peringkat'] = 30;

            //presentasi kehadiran
            $Siswa['kehadiran'] = $this->AbsensiModel->kehadiran($Siswa['nis'], $TA);

            //pelanggaran
            $Siswa['pelanggaran'] = $this->PelanggaranSiswaModel->skor($Siswa['nis'])['skor'];

            //hitung nilai x bobot kriteria 
            $Siswa['hasil'] = 0;

            foreach ($kriteria as $Kriteria) {
                //hitung masing-masing kriteria
                $Siswa['hasil_' . $Kriteria['nama']] = round($Siswa[$Kriteria['nama']] * $Kriteria['bobot'], 2);
                //jumlahkn tiap hasil dan hitung hasil akhir
                $Siswa['hasil'] += $Siswa['hasil_' . $Kriteria['nama']];
            }
        }

        // Menggunakan fungsi usort() untuk mengurutkan data berdasarkan hasil
        usort($siswa, fn ($a, $b) => $b['hasil'] - $a['hasil']);

        return $this->response->setJSON([
            'result' => view('admin/rekomendasi-result', ['siswa' => $siswa]),
            'perhitungan' => view('admin/rekomendasi-perhitungan-prestasi', ['kriteria' => $kriteria, 'siswa' => $siswa])
        ]);
    }
}
