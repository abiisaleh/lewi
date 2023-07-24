<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'siswa';
    protected $primaryKey       = 'nis';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nis', 'nama', 'alamat', 'jk', 'temt_lahir', 'agama', 'telp', 'telp_ortu', 'penghasilan_ortu', 'tanggungan_ortu', 'jarak_rumah', 'kondisi_rumah'];

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

    public function search($query)
    {
        return $this->like('nama', $query)->orLike('nis', $query);
    }

    function kelas()
    {
        //cek tahun ajaran terbaru
        $TA = $this->db->table('TA')->countAllResults();

        return $this
            ->join('kelas_siswa_ta', 'fkSiswa = nis')
            ->join('kelas', 'fkKelas = kelas.id')
            ->where('fkTA', $TA)
            ->select('siswa.*, jurusan, kelas_siswa_ta.id as id_kelas');
    }

    function nilai($idKelas)
    {
        return $this
            ->join('kelas_siswa_ta', 'fkSiswa = nis')
            ->join('nilai', 'nilai.fkSiswa = nis', 'left')
            ->where('kelas_siswa_ta.fkKelas', $idKelas)
            ->select('siswa.*')
            ->selectAvg('nilai')
            ->groupBy('nis');
    }

    function absensi($idKelas, $idTA)
    {
        return $this
            ->join('kelas_siswa_ta', 'fkSiswa = nis')
            ->where('kelas_siswa_ta.fkKelas', $idKelas)
            ->where('kelas_siswa_ta.fkTA', $idTA);
    }
}
