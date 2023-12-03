<?php

namespace App\Entities;

use Carbon\Carbon;
use CodeIgniter\Entity\Entity;
use Config\Database;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'email_verified_at'];
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
     * Set password attribute
     *
     * @param  mixed $password
     * @return void
     */
    public function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }

    /**
     * Get photo attribute
     * 
     * @return void
     */
    public function getPhoto()
    {
        $path = 'images/avatars/' . $this->attributes['avatar'];
        return file_exists($path) ? base_url($path) : base_url('images/avatar.png');
    }

    /**
     * Get banner attribute
     * 
     * @return void
     */
    public function getPoster()
    {
        $path = 'images/banners/' . $this->attributes['banner'];
        return file_exists($path) ? base_url($path) : base_url('images/banner.png');
    }

    /**
     * Get full name attribute
     * 
     * @return string
     */
    public function getFullName()
    {
        $first_name = $this->attributes['first_name'];
        $last_name = $this->attributes['last_name'];
        $username = $this->attributes['username'];

        return ($first_name && $last_name) ? "$first_name $last_name" : $username;
    }

    /**
     * Get joined at attribute with Carbon
     * 
     * @return string
     */
    public function getJoinedAt()
    {
        return Carbon::parse($this->attributes['created_at'])->locale('id')->isoFormat('LL');
    }

    /**
     * Get threads attribute
     * 
     * @return object
     */
    public function getThreads($status = 'published')
    {
        $query = $this->db->table('threads')
            ->select('id, title, slug, content, status, user_id, views')
            ->where('user_id', $this->attributes['id']);

        if ($status !== 'all') {
            $threads = $query->where('status', $status)->get()->getResult();
        } else {
            $threads = $query->get()->getResult();
        }

        return $threads;
    }

    /**
     * Get count threads attribute
     *
     * @return int
     */
    public function getCountLiked()
    {
        $count = $this->db->table('likes')
            ->where('model_class', 'App\Models\ThreadModel')
            ->join('threads', 'threads.id = likes.model_id')
            ->where('threads.status', 'published')
            ->where('threads.user_id', $this->attributes['id'])
            ->countAllResults();

        return number_short($count);
    }

    // public function formatLikeCount()
    // {
    //     $likeCount = $this->like_count;

    //     if ($likeCount >= 1000) {
    //         return number_format($likeCount / 1000, 0, ',', '.') . ' rb';
    //     } else {
    //         return number_format($likeCount, 0, ',', '.');
    //     }
    // }

    // public function formatThreadCount()
    // {
    //     $threadCount = $this->thread_count;

    //     if ($threadCount >= 1000) {
    //         return number_format($threadCount / 1000, 0, ',', '.') . ' rb';
    //     } else {
    //         return number_format($threadCount, 0, ',', '.');
    //     }
    // }

}
