<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11],
            'model_id' => ['type' => 'INT', 'constraint' => 11],
            'model_class' => ['type' => 'VARCHAR', 'constraint' => 255],
            'type' => ['type' => 'ENUM', 'constraint' => ['t_reply', 't_like']], // t = thread.
            'readed_at' => ['type' => 'datetime', 'null' => true],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications');
    }
}
