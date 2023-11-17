<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $model = new UserModel();
        $model->insert([
            'first_name'    => "Mimin",
            'last_name'     => "Admin",
            'username'      => "mimin",
            'email'         => "mimin@mail.com",
            'password'      => password_hash("password", PASSWORD_BCRYPT),
            'role'          => "admin",
            'avatar'        => "avatar.png",
            'banner'        => "banner.png",
        ]);
    }
}
