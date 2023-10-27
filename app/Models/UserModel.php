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
    
    /**
     * Get role name by user id
     *
     * @param  mixed $user_id
     * @return void
     */
    public function getRoleName($user_id)
    {
        $role = $this->db->table('user_has_roles')
            ->select('roles.name')
            ->join('roles', 'roles.id = user_has_roles.role_id')
            ->where('user_id', $user_id)
            ->get()
            ->getRowArray();

        return $role['name'];
    }
}
