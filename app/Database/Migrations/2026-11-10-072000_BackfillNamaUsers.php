<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BackfillNamaUsers extends Migration
{
    public function up()
    {
        $this->db->query(
            'UPDATE users
             SET nama = (SELECT guru.nama FROM guru WHERE guru.nip = users.username)
             WHERE (nama IS NULL OR nama = ?)
               AND EXISTS (SELECT 1 FROM guru WHERE guru.nip = users.username)',
            ['']
        );

        $this->db->query(
            'UPDATE users
             SET nama = (SELECT siswa.nama FROM siswa WHERE siswa.nis = users.username)
             WHERE (nama IS NULL OR nama = ?)
               AND EXISTS (SELECT 1 FROM siswa WHERE siswa.nis = users.username)',
            ['']
        );
    }

    public function down()
    {
    }
}
