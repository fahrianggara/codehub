<?php

namespace App\Entities;

use App\Models\ReportModel;
use App\Models\UserModel;
use CodeIgniter\Entity\Entity;

class Report extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [];
    
    /**
     * getUser
     *
     * @return void
     */
    public function getUser()
    {
        return (new UserModel())->where('id', $this->attributes['user_id'])->first();
    }

    /**
     * Count reports by model id, model class, user id and message
     * 
     * @return int
     */
    public function getCount()
    {
        return (new ReportModel())->where('model_id', $this->attributes['model_id'])
            ->where('model_class', $this->attributes['model_class'])
            ->where('user_id', $this->attributes['user_id'])
            ->where('message', $this->attributes['message'])
            ->countAllResults();
    }

    /**
     * Get Object
     * 
     * @return object
     */
    public function getObject()
    {
        $model_id = $this->attributes['model_id'];
        $model_class = $this->attributes['model_class'];

        return $model_class->find($model_id);
    }
}
