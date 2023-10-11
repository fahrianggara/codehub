<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserHasRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => ['type' => 'INT', 'constraint' => 11],
            'role_id' => ['type' => 'INT', 'constraint' => 11],
        ]);

        $this->forge->addKey(['user_id', 'role_id'], TRUE);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_has_roles');
    }

    public function down()
    {
        $this->forge->dropTable('user_has_roles');
    }
}
