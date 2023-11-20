<?php

namespace App\Entities;

use Config\Database;
use CodeIgniter\Entity\Entity;

class Thread extends Entity
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
     * Get Category
     * 
     * @return object
     */
    public function getCategory()
    {
        return $this->db->table('categories')
            ->join('thread_categories', 'thread_categories.category_id = categories.id')
            ->where('thread_categories.thread_id', $this->attributes['id'])
            ->select('categories.id, categories.name, categories.slug, categories.cover')
            ->get()->getRow();
    }

    /**
     * Get tags
     * 
     * @return object
     */
    public function getTags()
    {
        return $this->db->table('tags')
            ->join('thread_tags', 'thread_tags.tag_id = tags.id')
            ->where('thread_tags.thread_id', $this->attributes['id'])
            ->select('tags.id, tags.name, tags.slug')
            ->get()->getResult();
    }

    /**
     * Get Likes
     * 
     * @return object
     */
    public function getLikes()
    {
        return $this->db->table('likes')
            ->where('model_id', $this->attributes['id'])
            ->where('model_class', "App\Models\ThreadModel")
            ->get()->getResult();
    }

    /**
     * Get Notifications
     * 
     * @return object
     */
    public function getNotifications()
    {
        return $this->db->table('notifications')
            ->where('model_id', $this->attributes['id'])
            ->where('model_class', "App\Models\ThreadModel")
            ->get()->getResult();
    }

    /**
     * Get Reports
     * 
     * @return object
     */
    public function getReports()
    {
        return $this->db->table('reports')
            ->where('model_id', $this->attributes['id'])
            ->where('model_class', "App\Models\ThreadModel")
            ->get()->getResult();
    }

    /**
     * Get like if user liked
     * 
     * @return bool
     */
    public function getLike()
    {
        if (auth_check()) {
            return $this->db->table('likes')
                ->where('model_id', $this->attributes['id'])
                ->where('model_class', "App\Models\ThreadModel")
                ->where('user_id', auth()->id)
                ->select('likes.id, likes.user_id, likes.model_id, likes.model_class')
                ->get()->getRow();
        }

        return false;
    }
}
