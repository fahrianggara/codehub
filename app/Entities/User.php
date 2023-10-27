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
     * Get picture attribute
     * 
     * @param  mixed $picture
     * @return void
     */
    public function getAvatar()
    {
        $path = base_url('images/avatars/' . $this->attributes['avatar']);
        return file_exists($path) ? $path : base_url('images/avatar.png');
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
     * Get role attribute
     * 
     * @return string
     */
    public function getRole()
    {
        $user_id = $this->attributes['id'];
        
        $db = \Config\Database::connect();
        $builder = $db->table('roles');

        $builder->select('roles.*');
        $builder->join('user_has_roles', 'user_has_roles.role_id = roles.id');
        $builder->where('user_has_roles.user_id', $user_id);
        
        return $builder->get()->getRowObject();
    }

}
