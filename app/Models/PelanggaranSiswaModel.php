<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranSiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pelanggaran_siswa';
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
        return $this
            ->join('pelanggaran', 'fkPelanggaran = pelanggaran.id', 'left')
            ->join('siswa', 'fkSiswa = nis')
            ->select('siswa.*, pelanggaran.nama as pelanggaran, skor, tgl');
    }

    public function skor($nis)
    {
        return $this
            ->join('pelanggaran', 'fkPelanggaran = pelanggaran.id')
            ->where('fkSiswa', $nis)
            ->selectSum('skor')
            ->first();
    }

    public function getGroupedMonths($tahun)
    {
        return $this->select("MONTH(`tgl`) AS bulan, COUNT(*) AS jumlah")
            ->where("YEAR(`tgl`)", $tahun)
            ->groupBy("MONTH(`tgl`)")
            ->get()
            ->getResult();
    }
}
