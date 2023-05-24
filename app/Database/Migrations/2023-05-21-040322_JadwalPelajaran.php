<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalPelajaran extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'fkMapel' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkKelas' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'hari' => [
                'type' => 'ENUM("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu")',
            ],
            'jam_mulai' => [
                'type' => 'TIME'
            ],
            'jam_selesai' => [
                'type' => 'TIME'
            ],
            'fkTA' => [
                'type' => 'INT',
                'constraint' => 3
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal');
    }
}
