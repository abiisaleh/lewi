<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Prestasi extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'fkSiswa' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'fkKelasSiswaTa' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'prestasi' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('prestasi');
    }

    public function down()
    {
        $this->forge->dropTable('prestasi');
    }
}
