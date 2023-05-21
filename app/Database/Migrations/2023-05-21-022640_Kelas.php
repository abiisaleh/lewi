<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tingkat' => [
                'type'=> 'ENUM("X","XI","XII")'
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'length' => '10',
            ],
            'kode' => [
                'type' => 'CHAR',
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
