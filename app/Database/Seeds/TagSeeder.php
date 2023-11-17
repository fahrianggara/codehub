<?php

namespace App\Database\Seeds;

use App\Models\TagModel;
use CodeIgniter\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        $model = new TagModel();
        $model->insertBatch([
            [
                'name' => 'ngoding',
                'slug' => 'ngoding',
            ],
            [
                'name' => 'indonesia',
                'slug' => 'indonesia',
            ],
            [
                'name' => 'tips & trick',
                'slug' => 'tips-trick',
            ],
            [
                'name' => 'pusing',
                'slug' => 'pusing',
            ],
            [
                'name' => 'bug',
                'slug' => 'bug',
            ],
            [
                'name' => 'framework',
                'slug' => 'framework',
            ],
            [
                'name' => 'php',
                'slug' => 'php',
            ],
            [
                'name' => 'javascript',
                'slug' => 'javascript',
            ],
            [
                'name' => 'python',
                'slug' => 'python',
            ],
            [
                'name' => 'java',
                'slug' => 'java',
            ],
            [
                'name' => 'c++',
                'slug' => 'c++',
            ],
            [
                'name' => 'c#',
                'slug' => 'c#',
            ],
            [
                'name' => 'ruby',
                'slug' => 'ruby',
            ],
            [
                'name' => 'golang',
                'slug' => 'golang',
            ],
            [
                'name' => 'kotlin',
                'slug' => 'kotlin',
            ],
            [
                'name' => 'swift',
                'slug' => 'swift',
            ],
            [
                'name' => 'dart',
                'slug' => 'dart',
            ],
            [
                'name' => 'flutter',
                'slug' => 'flutter',
            ],
            [
                'name' => 'react',
                'slug' => 'react',
            ],
            [
                'name' => 'vue',
                'slug' => 'vue',
            ],
            [
                'name' => 'laravel',
                'slug' => 'laravel',
            ],
            [
                'name' => 'codeigniter',
                'slug' => 'codeigniter',
            ],
            [
                'name' => 'django',
                'slug' => 'django',
            ],
            [
                'name' => 'flask',
                'slug' => 'flask',
            ],
            [
                'name' => 'spring',
                'slug' => 'spring',
            ],
            [
                'name' => 'express',
                'slug' => 'express',
            ],
            [
                'name' => 'bootstrap',
                'slug' => 'bootstrap',
            ],
            [
                'name' => 'tailwind',
                'slug' => 'tailwind',
            ],
        ]);
    }
}
