<?php

namespace App\Models;

use App\Models\RoleModel;
use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
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
     * Get avatar user by user_id
     * 
     * @param  mixed $user_id
     * @return void
     */
    public function avatar($user_id)
    {
        $builder = $this->db->table('users');
        $builder->select('users.avatar');
        $builder->where('users.id', $user_id);
        $query = $builder->get()->getRow();

        $path = base_url("images/avatars/{$query->avatar}");

        return file_exists($path) ? $path : base_url('images/avatar.png');
    }

        
    /**
     * Get role user by user_id
     *
     * @param  mixed $user_id
     * @return void
     */
    public function role($user_id)
    {
        $builder = $this->db->table('roles');

        $builder->select('roles.*');
        $builder->join('user_has_roles', 'user_has_roles.role_id = roles.id');
        $builder->where('user_has_roles.user_id', $user_id);
        
        return $builder->get()->getRow();
    }

    /**
     * Get threads by user_id
     * 
     * @param  mixed $user_id
     * @return void
     */
    public function threads($user_id)
    {
        $builder = $this->db->table('threads');
        $builder->select('threads.*');
        $builder->where('threads.user_id', $user_id);

        return $builder->get()->getResult();
    }
}
