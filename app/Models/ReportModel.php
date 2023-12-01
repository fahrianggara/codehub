<?php

namespace App\Models;

use App\Entities\Report;
use CodeIgniter\Model;


class ReportModel extends Model
{
    protected $table            = 'reports';
    protected $returnType       = Report::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'message', 'model_id', 'model_class', 'user_id', 'created_at'
    ];

    public function getReportsWithUserDetails($Id)
    {
        $builder = $this->db->table('reports');
        $builder->select('reports.*, users.full_name, users.username, users.avatar');
        $builder->join('users', 'users.id = reports.user_id');
        $builder->where('id', $Id);
        return $builder->get()->getRow();
    }

    public function saveReport($data)
    {
        return $this->insert($data);
    }

    public function countReportsByModelId($userId)
    {
        return $this->where('user_id', $userId)
            ->countAllResults();
    }

    
}
