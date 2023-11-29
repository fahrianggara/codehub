<?php

namespace App\Entities;

use App\Models\ReplyModel;
use App\Models\UserModel;
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

    public function getUser()
    {
        $userModel = new UserModel();
        return $userModel->where('id', $this->attributes['user_id'])->first();
    }

    /**
     * Get Category
     * 
     * @return object
     */
    public function getCategory()
    {
        $obj = "";

        $category = $this->db->table('categories')
            ->join('thread_categories', 'thread_categories.category_id = categories.id')
            ->where('thread_categories.thread_id', $this->attributes['id'])
            ->select('categories.id, categories.name, categories.slug, categories.cover')
            ->get()->getRow();

        if ($category) {
            $obj = $category;
        } else {
            $obj = (object) [
                'name' => "Uncategorized",
                'slug' => "uncategorized",
                'cover' => base_url('images/empty.png'),
            ];
        }

        return $obj;
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

    /**
     * get replies main
     * 
     * @return object
     */
    public function getReplies()
    {
        $replies = new ReplyModel();

        return $replies->where('thread_id', $this->attributes['id'])
            ->where('parent_id', null)
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    /**
     * Count replies
     * 
     * @param bool $withOwner
     * @return int
     */
    public function getCountReplies($withOwner = false)
    {
        $replies = new ReplyModel();
        $builder = $replies->where('thread_id', $this->attributes['id']);

        if ($withOwner) {
            $output = $builder->where('user_id !=', $this->attributes['user_id']);
        } else {
            $output = $builder;
        }

        return $output->countAllResults();
    }
}
