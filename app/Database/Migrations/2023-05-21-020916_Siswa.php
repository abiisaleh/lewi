<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'unique'    => true,
                'auto_increment' => false   
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'length' => 30, 
            ],
            'fkKelas' => [
                'type' => 'INT',
                'length' => 3,
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'jkel' => [
                'type' => 'ENUM("L","P")'
            ],
            'temp_lahir' => [
                'type' => 'TEXT'
            ],
            'tgl_lahir' => [
                'type' => 'DATE'
            ],
            'agama' => [
                'type' => 'ENUM("Islam, "Kristen", "Katolik", "Hindu", "Budha", "Konghucu")'
            ],
            'telp' => [
                'type' => 'VARCHAR',
                'length' => 16,
            ],
            'telp_ortu' => [
                'type' => 'VARCHAR',
                'length' => 16,
            ]
        ]);
        $this->forge->addPrimaryKey('nim');
        $this->forge->createTable('siswa');
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}
