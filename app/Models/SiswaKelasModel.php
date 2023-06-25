<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaKelasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelas_siswa_ta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

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
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function siswa()
    {
        return $this->join('siswa', 'fkSiswa = nis');
    }

    public function Kelas($nis)
    {
        $TA = $this->db->table('TA')->countAll();

        return $this
            ->join('kelas', 'kelas_siswa_ta.fkKelas = kelas.id')
            ->join('TA', 'kelas_siswa_ta.fkTA = TA.id')
            ->join('wali_kelas', 'kelas_siswa_ta.fkKelas = kelas.id')
            ->join('guru', 'fkGuru = nip')
            ->where('kelas_siswa_ta.fkTA', $TA)
            ->where('fkSiswa', $nis)
            ->select('kelas.*, TA.tahun as tahun_ajaran, kelas_siswa_ta.id, guru.nama as wali_kelas');
    }
}
