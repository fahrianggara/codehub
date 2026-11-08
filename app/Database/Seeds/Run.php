<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Run extends Seeder
{
    public function run()
    {
        // Master data
        $this->call('CategorySeeder');
        $this->call('TagSeeder');
        
        // Users (admin + regular users)
        $this->call('UserSeeder');
        
        // Content
        $this->call('ThreadSeeder');
        $this->call('ReplySeeder');
        
        // Relations
        $this->call('ThreadRelationSeeder');
        
        // Interactions
        $this->call('LikeSeeder');
        $this->call('NotificationSeeder');
    }
}
