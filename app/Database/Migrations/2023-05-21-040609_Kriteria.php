<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'kriteria' => [
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'bobot_prestasi' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'bobot_beasiswa' => [
                'type' => 'INT',
                'constraint' => 3
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kriteria');
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}
