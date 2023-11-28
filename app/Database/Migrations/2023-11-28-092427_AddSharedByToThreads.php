<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSharedByToThreads extends Migration
{
    public function up()
    {
        $this->forge->addColumn('threads', [
            'shared_by' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('threads', 'shared_by');
    }
}
