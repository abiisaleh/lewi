<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tingkat', 'jurusan', 'kode'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['countSiswa'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function wali()
    {
        return $this
            ->join('wali_kelas', 'kelas.id = wali_kelas.fkKelas', 'left')
            ->join('guru', 'wali_kelas.fkGuru = guru.nip', 'left')
            ->select('kelas.*, guru.nama as wali');
    }

    public function countSiswa(array $data)
    {
        $siswaModel = $this->db->table('kelas_siswa_ta');

        foreach ($data['data'] as &$Item) {
            if (is_string($Item)) {
                return $data;
            }
            $jumlahSiswa = $siswaModel->where('fkKelas', $Item['id'])->countAllResults();
            $Item['jumlah_siswa'] = $jumlahSiswa;
        }

        return $data;
    }
}
