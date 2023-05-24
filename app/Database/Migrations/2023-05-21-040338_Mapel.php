<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mapel extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'pelajaran' => [
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'jurusan' => [
                'type' => 'ENUM("Umum","IPA","IPS","Bahasa")'
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('mapel');
    }

    public function down()
    {
        $this->forge->dropTable('mapel');
    }
}
