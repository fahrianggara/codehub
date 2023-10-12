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
        'message', 'model_id', 'model_class', 'user_id'
    ];
}
