<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = User::class;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username', 'first_name', 'last_name', 'email', 'avatar', 'password'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


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
