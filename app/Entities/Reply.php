<?php

namespace App\Entities;

use App\Models\ThreadModel;
use App\Models\ReplyModel;
use App\Models\UserModel;
use CodeIgniter\Entity\Entity;
use Config\Database;

class Reply extends Entity
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
     * Get user
     * 
     * @return object
     */
    public function getUser()
    {
        $userModel = new UserModel();
        return $userModel->where('id', $this->attributes['user_id'])->first();
    }

    /**
     * Get thread
     * 
     * @return object
     */
    public function getThread()
    {
        $threadModel = new ThreadModel();
        
        return $threadModel->published()
            ->where('id', $this->attributes['thread_id'])
            ->first();
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
            ->where('model_class', "App\Models\ReplyModel")
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
                ->where('model_class', "App\Models\ReplyModel")
                ->where('user_id', auth()->id)
                ->select('likes.id, likes.user_id, likes.model_id, likes.model_class')
                ->get()->getRow();
        }

        return false;
    }

    /**
     * Get child replies
     * 
     * @return object
     */
    public function getChilds()
    {
        $replies = new ReplyModel();

        return $replies->where('child_id', $this->attributes['id'])
            ->where('parent_id !=', null)
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    /**
     * Get child reply
     * 
     * @return object
     */
    public function getChild()
    {
        $replies = new ReplyModel();

        return $replies->where('id', $this->attributes['child_id'])
            ->first();
    }

    /**
     * get parent reply
     * 
     * @return object
     */
    public function getParent()
    {
        $replies = new ReplyModel();

        return $replies->where('id', $this->attributes['parent_id'])
            ->first();
    }
}
