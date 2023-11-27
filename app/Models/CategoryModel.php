<?php

namespace App\Models;

use App\Entities\Category;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $returnType       = Category::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'slug', 'cover'
    ];
    // public function threads()
    // {
    //     return $this->hasMany('App\Models\ThreadModel', 'category_id', 'id');
    // }

    public function getCategoriesWithThreads()
    {
        return $this->with('threads')->findAll();
    }
}
