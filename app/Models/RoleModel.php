<?php

namespace App\Models;

use App\Entities\Role;
use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'roles';
    protected $returnType       = Role::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name'
    ];
}
