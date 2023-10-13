<?php

namespace App\Entities;

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
}
