<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateThreadCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true], // tambahkan field id
            'thread_id' => ['type' => 'INT', 'constraint' => 11],
            'category_id' => ['type' => 'INT', 'constraint' => 11],
        ]);

        $this->forge->addKey('id', true); // set primary key
        $this->forge->addForeignKey('thread_id', 'threads', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('thread_categories');
    }

    public function down()
    {
        $this->forge->dropTable('thread_categories');
    }
}
