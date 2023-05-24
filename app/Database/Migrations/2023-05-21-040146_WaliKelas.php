<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WaliKelas extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'fkGuru' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'fkKelas' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'fkTA' => [
                'type' => 'INT',
                'constraint' => 3,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('wali_kelas');
    }

    public function down()
    {
        $this->forge->dropTable('wali_kelas');
    }
}
