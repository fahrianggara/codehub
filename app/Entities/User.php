<?php

namespace App\Entities;

use Carbon\Carbon;
use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'email_verified_at'];
    protected $casts   = [];
    
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
        $path = 'images/banners/'. $this->attributes['banner'];
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
}
