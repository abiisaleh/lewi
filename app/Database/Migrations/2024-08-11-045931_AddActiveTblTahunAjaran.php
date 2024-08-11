<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActiveTblTahunAjaran extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ta', [
            'aktif' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('ta', 'aktif');
    }
}
