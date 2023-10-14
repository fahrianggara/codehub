<?php

namespace App\Models;

use App\Models\RoleModel;
use App\Entities\User;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class UserModel extends Model
{
    use ModelTrait;

    protected $table            = 'users';
    protected $returnType       = User::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'username', 'first_name', 'last_name', 'email', 'avatar', 'password', 'email_verified_at'
    ];

    /**
     * Assign a role to a user
     * 
     * @param int $id
     * @param string $role
     */
    public function assignRole($role)
    {
        $role = (new RoleModel())->where('name', $role)->first();

        if ($role) {
            $this->db->table('user_has_roles')->insert([
                'user_id' => $this->getInsertID(),
                'role_id' => $role->id
            ]);
        } else {
            throw new \Exception("Role $role tidak ditemukan.");
        }
    }
}
