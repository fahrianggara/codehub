<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $model = new CategoryModel();

        $model->insertBatch([
            [
                'name' => 'Asking',
                'slug' => 'asking',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Solved',
                'slug' => 'solved',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Fixing Bug',
                'slug' => 'fixing-bug',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Artificial Intelligence',
                'slug' => 'artificial-intelligence',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Machine Learning',
                'slug' => 'machine-learning',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Bahasa Pemrograman',
                'slug' => 'bahasa-pemrograman',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Framework',
                'slug' => 'framework',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'UI/UX',
                'slug' => 'ui-ux',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Tips & Trick',
                'slug' => 'tips-trick',
                'cover' => 'empty.png', // add this line
            ],
            [
                'name' => 'Tutorial',
                'slug' => 'tutorial',
                'cover' => 'empty.png', // add this line
            ]
        ]);
    }
}
