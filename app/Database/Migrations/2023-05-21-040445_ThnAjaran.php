<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ThnAjaran extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'tahun_awal' => [
                'type' => 'INT',
                'constraint' => 4
            ],
            'tahun_akhir' => [
                'type' => 'INT',
                'constraint' => 4
            ],
            'semester' => [
                'type' => 'ENUM("I","II")',
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('TA');
    }

    public function down()
    {
        $this->forge->dropTable('TA');
    }
}
