<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateThreadTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'thread_id' => ['type' => 'INT', 'constraint' => 11],
            'tag_id' => ['type' => 'INT', 'constraint' => 11],
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey('thread_id', 'threads', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('thread_tags');
    }

    public function down()
    {
        $this->forge->dropTable('thread_tags');
    }
}
