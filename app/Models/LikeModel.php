<?php

namespace App\Models;

use App\Entities\Like;
use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table            = 'likes';
    protected $returnType       = Like::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'model_id', 'model_class', 'user_id'
    ];
}
