<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Run extends Seeder
{
    public function run()
    {
        $this->call('CategorySeeder');
        $this->call('TagSeeder');
        $this->call('AdminSeeder');
    }
}
