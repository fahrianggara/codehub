<?php

namespace App\Models;

use App\Entities\Tag;
use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table            = 'tags';
    protected $returnType       = Tag::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'slug'
    ];
}
