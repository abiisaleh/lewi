<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'absensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['fkSiswa', 'fkKelasSiswaTa', 'tgl', 'ket'];

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

    public function kehadiran($nis, $TA)
    {
        $absensi = $this
            ->join('kelas_siswa_ta', 'kelas_siswa_ta.id = fkKelasSiswaTa')
            ->where('absensi.fkSiswa', $nis)
            ->where('fkTA', $TA);

        $pertemuan = $absensi
            ->countAllResults();

        $hadir = $absensi
            ->where('ket', 'hadir')
            ->countAllResults();


        return $pertemuan - $hadir;
    }
}
