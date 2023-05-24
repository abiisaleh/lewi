<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ThnAjaran extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'tahun' => [
                'type'=> 'VARCHAR',
                'constraint' => 9
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
