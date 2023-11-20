<?php

namespace App\Models;

use App\Entities\Tag;
use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table            = 'tags';
    protected $returnType       = Tag::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'slug',
    ];

    public function getTags()
    {
        return $this->findAll();
    }

    public function getTag($id)
    {
        return $this->find($id);
    }

    public function createTag($data)
    {
        return $this->insert($data);
    }

    public function updateTag($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTag($id)
    {
        return $this->delete($id);
    }
}

