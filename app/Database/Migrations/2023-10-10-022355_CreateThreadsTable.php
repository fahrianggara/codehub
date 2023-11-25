<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateThreadsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'content' => ['type' => 'LONGTEXT'],
            'status' => ['type' => 'ENUM', 'constraint' => ['draft', 'published'], 'default' => 'published'],
            'views' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'user_id' => ['type' => 'INT', 'constraint' => 11],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('threads');
    }

    public function down()
    {
        $this->forge->dropTable('threads');
    }
}
