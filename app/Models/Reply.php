<?php

namespace App\Models;

use CodeIgniter\Model;

class Reply extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'replies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'content', 'approved', 'thread_id', 'user_id', 'parent_id'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
