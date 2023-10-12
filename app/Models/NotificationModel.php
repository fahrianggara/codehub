<?php

namespace App\Models;

use App\Entities\Notification;
use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table            = 'notifications';
    protected $returnType       = Notification::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'user_id', 'model_id', 'model_class', 'message', 'readed_at'
    ];
}
