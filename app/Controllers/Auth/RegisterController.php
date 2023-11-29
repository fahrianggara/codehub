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
        // jika ada request ajax
        if ($this->request->isAJAX()) {
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
        $request = $this->request; // Load request..

        if (!$this->validate($this->rules())) {
            return response()->setJSON([
                'status' => 400, // Bad request
                'validate' => true,
                'errors' => $this->validation->getErrors(),
            ]);
        }

        $this->db->transBegin(); // Begin transaction..
        try {
            $email = $request->getPost('email');

            // Insert user..
            $this->userModel->insert([
                'username' => 'user' . rand(100000, 999999),
                'email' => $email,
                'password' => password_hash($request->getVar('password'), PASSWORD_BCRYPT),
                'role' => 'user'
            ]);

            // Commit transaction..
            $this->db->transCommit();

            // return response success..
            return response()->setJSON([
                'status' => 200,
                'message' => 'Register berhasil, silahkan login.',
                'redirect' => base_url('login'),
            ]);
        } catch (\Exception $e) { // Catch exception
            $this->db->transRollback();  // Rollback transaction..

            // return response error..
            return response()->setJSON([
                'status' => 400,
                'message' => $e->getMessage()
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
        $username = explode('@', $email); // explode email
        $username = $username[0]; // get username
        return $username . rand(0, 99999);
    }

    /**
     * Validate register form
     * 
     * @return array
     */
    private function rules()
    {
        return [
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[16]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.',
                    'min_length' => 'Password minimal 8 karakter.',
                    'max_length' => 'Password maksimal 16 karakter.'
                ]
            ],
            'c-password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong.',
                    'matches' => 'Konfirmasi Password tidak sama dengan Password.'
                ]
            ]
        ];
    }
}
