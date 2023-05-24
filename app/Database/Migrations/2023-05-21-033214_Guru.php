<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => 18,

            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'gol' => [
                'type' => 'ENUM("I","II","III","IV")'
            ],
            'ruang' => [
                'type' => 'ENUM("a","b","c","d")'
            ],
            'tempt_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 30, 
            ],
            'tgl_lahir' => [
                'type' => 'DATE'
            ],
            'jk' => [
                'type' => 'ENUM("L","P")'
            ],
            'telp' => [
                'type' => 'VARCHAR',
                'constraint' => 16
            ]
        ]);
        $this->forge->addPrimaryKey('nip');
        $this->forge->createTable('guru');
    }

    public function down()
    {
        $this->forge->dropTable('guru');
    }
}
