<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class buktifoto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'no_agen'     => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'deskripsi'   => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'path_foto'   => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('bukti_foto');
    }

    public function down()
    {
        $this->forge->dropTable('bukti_foto');
    }
}

