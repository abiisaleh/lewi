<?php

namespace App\Models;

use CodeIgniter\Model;

class WaliKelasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'wali_kelas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['fkGuru', 'fkKelas', 'jadwal', 'fkTA'];

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

    public function kelas($nip)
    {
        $TA = $this->db->table('TA')->countAllResults();

        $walikelas = $this
            ->where('fkGuru', $nip)
            ->where('fkTA', $TA)
            ->first()['fkKelas'] ?? null;

        return $walikelas;
    }
}
