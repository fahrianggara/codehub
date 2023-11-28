<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Config\Database;


class Category extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Get photo attribute
     * 
     * @return void
     */
    public function getPhoto()
    {
        $path = 'images/categories/' . $this->attributes['cover'];
        return file_exists($path) ? base_url($path) : base_url('images/empty.png');
    }

    // get thread
    public function getThreads()
    {
        return $this->db->table('threads')
            ->join('thread_categories', 'thread_categories.thread_id = threads.id')
            ->where('thread_categories.category_id', $this->attributes['id'])
            ->where('status', 'published')
            ->get()->getResult();
    }
}
