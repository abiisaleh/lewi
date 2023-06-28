<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelasSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'fkKelas' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkSiswa' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'peringkat' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'fkTA' => [
                'type' => 'INT',
                'constraint' => 3
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kelas_siswa_ta');
    }

    public function down()
    {
        $this->forge->dropTable('kelas_siswa_ta');
    }
}
