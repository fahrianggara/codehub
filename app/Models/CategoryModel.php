<?php

namespace App\Models;

use App\Entities\Category;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $returnType       = Category::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'slug', 'cover'
    ];
}
