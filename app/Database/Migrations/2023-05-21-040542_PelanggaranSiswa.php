<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PelanggaranSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'fkSiswa' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkPelanggaran' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'tgl' => [
                'type' => 'DATETIME'
            ],
            'fkKelasSiswaTa' => [
                'type' => 'INT',
                'constraint' => 3
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pelanggaran_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggaran_siswa');
    }
}
