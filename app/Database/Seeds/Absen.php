<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Absen extends Seeder
{
    public function run()
    {
        $data = [
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'alpa'],
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'alpa'],
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'alpa'],
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133003', 'fkKelasSiswaTa' => 5, 'tgl' => '2023-08-05', 'ket' => 'hadir'],

            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'alpa'],
            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133007', 'fkKelasSiswaTa' => 9, 'tgl' => '2023-08-05', 'ket' => 'hadir'],

            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'alpa'],
            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'alpa'],
            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
            ['fkSiswa' => '12133010', 'fkKelasSiswaTa' => 12, 'tgl' => '2023-08-05', 'ket' => 'hadir'],
        ];
        $this->db->table('absensi')->insertBatch($data);
    }
}
