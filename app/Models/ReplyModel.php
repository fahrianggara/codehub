<?php

namespace App\Models;

use App\Entities\Reply;
use CodeIgniter\Model;

class ReplyModel extends Model
{
    protected $table            = 'replies';
    protected $returnType       = Reply::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'content', 'approved', 'thread_id', 'user_id', 'parent_id'
    ];
}
