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
    // protected $with             = ['threads', 'replies', 'likes', 'notifications', 'reports'];
    protected $allowedFields    = [
        'username', 'first_name', 'last_name', 'email', 'avatar', 'password',
        'link_fb', 'link_tw', 'link_ig', 'link_gh', 'link_li', 'role', 'banner'
    ];

    /**
     * Authentication user
     * 
     * @return object|null
     */
    public function authUser()
    {
        if (session()->has('logged_in')) {
            return $this->where('id', session()->get('id'))->first();
        }
    }
}
