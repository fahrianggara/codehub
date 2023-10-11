<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateThreadTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'thread_id' => ['type' => 'INT', 'constraint' => 11],
            'tag_id' => ['type' => 'INT', 'constraint' => 11],
        ]);

        $this->forge->addKey(['thread_id', 'tag_id'], TRUE);
        $this->forge->addForeignKey('thread_id', 'threads', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('thread_tags');
    }

    public function down()
    {
        $this->forge->dropTable('thread_tags');
    }
}
