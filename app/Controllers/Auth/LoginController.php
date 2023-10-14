<?php

namespace App\Controllers\Auth;

use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Entities\User;
use Config\Services;

class LoginController extends BaseController
{    
    /**
     * Display login page.
     *
     * @return void
     */
    public function index()
    {
        return view('auth/login', [
            'title' => 'Login',
            'validation' => Services::validation()
        ]);
    }

    /**
     * Handle login request.
     * 
     * @return void
     */
    public function login()
    {
        $validation = Services::validation();
        $db = db_connect();
        $request = $this->request;

        $validate = [
            'username' => [
                'rules' => 'required',
                'errors' => ['required' => 'Username/Email tidak boleh kosong!']
            ],
            'password' => [
                'rules' => 'required',
                'errors' => ['required' => 'Password tidak boleh kosong!']
            ]
        ];

        if (!$this->validate($validate)) {
            return response()->setJSON([
                'status' => 400,
                'val' => true,
                'errors' => $validation->getErrors(),
            ]);
        }

        $db->transBegin();
        try {
            $userModel = new UserModel();
            $username = $request->getVar('username'); // username or email
            $password = $request->getVar('password');
            
            // check inputan username jika ada @ maka dianggap email
            if (strpos($username, '@') === false) {
                $user = $userModel->where('username', $username)->first();

                if (!$user) {
                    return response()->setJSON([
                        'status' => 400,
                        'message' => 'Username tidak ditemukan!'
                    ]);
                }
            } else {
                $user = $userModel->where('email', $username)->first();

                if (!$user) {
                    return response()->setJSON([
                        'status' => 400,
                        'message' => 'Email tidak ditemukan!'
                    ]);
                }
            }

            if (!password_verify($password, $user->password)) {
                return response()->setJSON([
                    'status' => 400,
                    'message' => 'Password salah!'
                ]);
            }

            $db->transCommit();

            $this->setSession($user, $userModel);

            return response()->setJSON([
                'status' => 200,
                'message' => 'Login berhasil! Kamu akan diarahkan ke halaman profile.',
                'redirect' => base_url("/$user->username"),
            ]);

        } catch (\Exception $e) {
            $db->transRollback();

            return response()->setJSON([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle logout request.
     * 
     * @return void
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->back();
    }

    /**
     * Set session after login.
     * 
     * @param object $user
     * @return void
     */
    public function setSession($user, $userModel)
    {
        session()->set([
            'id' => $user->id,
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'role' => $userModel->getRoleName($user->id),
            'logged_in' => true
        ]);
    }
}
