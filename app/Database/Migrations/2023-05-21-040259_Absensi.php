<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Absensi extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'fkSiswa' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkWali' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'tgl' => [
                'type' => 'DATETIME',
            ],
            'ket' => [
                'type' => 'ENUM("hadir","sakit","izin","tanpa keterangan")',
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('absensi');
    }

    public function down()
    {
        $this->forge->dropTable('absensi');
    }
}
