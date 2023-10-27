<?php

namespace App\Controllers\Auth;

use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Entities\User;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;
use Config\Services;

class RegisterController extends BaseController
{    
    
    /**
     * Display register page
     *
     * @return void
     */
    public function index()
    {       
        if ($this->request->isAJAX()) { // Check if request is AJAX
            return $this->register();
        }

        return view('auth/register', [
            'title' => 'Register'
        ]);
    }

    /**
     * Register user
     *
     * @return void
     */
    private function register()
    {
        $validation = Services::validation(); // Load validation library
        $validate = $this->validateRegisterForm(); // Load validation rules
        $request = $this->request; // Load request..
        $db = db_connect(); // Load db connection..

        if (!$this->validate($validate)) {
            return response()->setJSON([
                'status' => 400, // Bad request
                'error' => $validation->getErrors(),
            ]);
        }

        $db->transBegin(); // Begin transaction..
        try {
            $userModel = new UserModel();
            $user = new User();

            $user->username = $this->generateUsername($request->getPost('email'));
            $user->email = $request->getPost('email');
            $user->password = $request->getPost('password');
            $user->email_verified_at = date('Y-m-d H:i:s');

            $userModel->save($user);
            $userModel->assignRole('user');

            $db->transCommit();

            return response()->setJSON([
                'status' => 200, // OK
                'message' => 'Register berhasil, silahkan login.',
                'redirect' => base_url('login'),
            ]);
        } catch (\Exception $e) { // Catch exception
            $db->transRollback();  // Rollback transaction..

            return response()->setJSON([
                'status' => 400, // Internal server error
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Generate username
     * 
     * @param string $email
     * @return string
     */
    public function generateUsername($email)
    {
        $username = explode('@', $email);
        $username = $username[0];

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) $username = $username . rand(0, 999);

        return $username;
    }

    /**
     * Validate register form
     * 
     * @return array
     */
    private function validateRegisterForm()
    {
        return [
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[16]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 8 karakter',
                    'max_length' => 'Password maksimal 16 karakter'
                ]
            ],
            'confirmpass' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Password tidak sama'
                ]
            ]
        ];
    }
}
