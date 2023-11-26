<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Category extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];

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
    }
