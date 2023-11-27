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

    public function getReports()
    {
        $query = $this->db->table('reports')
            ->select('reports.*, COUNT(reports.id) as total_reports')
            ->groupBy('reports.id')
            ->get();

        return $query->getResult();
    }

    public function saveReport($data)
    {
        return $this->insert($data);
    }
}
