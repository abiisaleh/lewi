<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nis' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'unique'    => true,
                'auto_increment' => false
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'jk' => [
                'type' => 'ENUM("Laki-laki","Perempuan")'
            ],
            'tempt_lahir' => [
                'type' => 'TEXT',
            ],
            'tgl_lahir' => [
                'type' => 'DATE'
            ],
            'agama' => [
                'type' => 'ENUM("Islam", "Kristen", "Katolik", "Hindu", "Budha", "Konghucu")',
                'DEfAULT' => 'Kristen'
            ],
            'telp' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'telp_ortu' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'penghasilan_ortu' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true
            ],
            'tanggungan_ortu' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true
            ],
            'jarak_rumah' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true
            ],
            'kondisi_rumah' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM("Aktif", "Tidak Aktif")',
                'default' => 'Aktif',
            ],
        ]);
        $this->forge->addPrimaryKey('nim');
        $this->forge->createTable('siswa');
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}
