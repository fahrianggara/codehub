<?php

namespace App\Models;

use App\Entities\Thread;
use CodeIgniter\Model;

class ThreadModel extends Model
{
    protected $table            = 'threads';
    protected $returnType       = Thread::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'title', 'content', 'views', 'user_id'
    ];
}
