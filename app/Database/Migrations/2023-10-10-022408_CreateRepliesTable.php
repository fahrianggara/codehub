<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRepliesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'content' => ['type' => 'TEXT'],
            'approved' => ['type' => 'BOOLEAN', 'default' => 1],
            'thread_id' => ['type' => 'INT', 'constraint' => 11],
            'user_id' => ['type' => 'INT', 'constraint' => 11],
            'parent_id' => ['type' => 'INT', 'constraint' => 11],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('thread_id', 'threads', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('parent_id', 'replies', 'id', 'CASCADE');
        $this->forge->createTable('replies');
    }

    public function down()
    {
        $this->forge->dropTable('replies');
    }
}
