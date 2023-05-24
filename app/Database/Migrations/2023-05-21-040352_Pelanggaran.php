<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggaran extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'jenis' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'skor' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'ket' => [
                'type' => 'TEXT',
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggaran');
    }
}
