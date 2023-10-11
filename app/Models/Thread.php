<?php

namespace App\Models;

use CodeIgniter\Model;

class Thread extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'threads';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title', 'content', 'views', 'user_id'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
