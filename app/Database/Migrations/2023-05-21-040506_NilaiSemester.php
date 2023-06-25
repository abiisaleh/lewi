<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiSemester extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'fkSiswa' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkKelas' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkMapel' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'nilai' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'peringkat' => [
                'type' => 'INT',
                'constraint' => 3
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('nilai');
    }

    public function down()
    {
        $this->forge->dropTable('nilai');
    }
}
