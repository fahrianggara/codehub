<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'last_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'avatar' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'avatar.png'],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'banner' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'banner.png'],
            'link_fb' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'link_tw' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'link_ig' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'link_gh' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'link_li' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true], // LinkedIn
            'role' => ['type' => 'ENUM', 'constraint' => ['admin', 'user'], 'default' => 'user'],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
