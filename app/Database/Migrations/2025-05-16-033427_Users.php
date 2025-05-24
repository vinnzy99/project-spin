<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => '11','unsigned' => true, 'auto_increment' => true],
            'username'  => ['type' => 'VARCHAR', 'constraint' => '100'],
            'no_agen'   => ['type' => 'VARCHAR', 'constraint' => '100'],
            'no_telp'   => ['type' => 'VARCHAR', 'constraint' => '20'],
            'turn_left' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'total_spin' => ['type' => 'INT','constraint' => 11,'default' => 0,],
            'status' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

