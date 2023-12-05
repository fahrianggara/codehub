<?php

namespace App\Entities;

use Config\Database;
use App\Models\ThreadModel;
use CodeIgniter\Entity\Entity;

class Tag extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];
    protected $db;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Get threads
     * 
     * @return int
     */
    public function getThreads()
    {
        return $this->db->table('threads')
            ->join('thread_tags', 'thread_tags.thread_id = threads.id')
            ->where('thread_tags.tag_id', $this->attributes['id'])
            ->where('status', 'published')
            ->get()->getResult();
    }
}
