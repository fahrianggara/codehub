<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class LoginController extends BaseController
{    
    /**
     * Display login page.
     *
     * @return void
     */
    public function index()
    {
        if ($this->request->isAJAX()) { // Check if request is AJAX
            return $this->login();
        }

        return view('auth/login', [
            'title' => 'Login',
            'validation' => $this->validation
        ]);
    }

    /**
     * Handle login request.
     * 
     * @return void
     */
    private function login()
    {
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
                'errors' => $this->validation->getErrors(),
            ]);
        }

        $this->db->transBegin();
        try {
            $username = $request->getVar('username'); // username or email
            $password = $request->getVar('password');
            
            // check inputan username jika ada @ maka dianggap email
            if (strpos($username, '@') === false) {
                $user = $this->checkUser($username);
                if (!$user) 
                    return response()->setJSON(['status' => 400, 'message' => "Username $username tidak ditemukan!"]);
            } else {
                $user = $this->checkUser($username);
                if (!$user) 
                    return response()->setJSON(['status' => 400, 'message' => "Email $username tidak ditemukan!"]);
            }

            // check password
            if (!password_verify($password, $user->password)) {
                return response()->setJSON([
                    'status' => 400,
                    'message' => 'Password salah!'
                ]);
            }

            // commit transaction
            $this->db->transCommit(); 

            // set session auth
            session()->set([
                'id' => $user->id,
                'role' => 'user',
                'logged_in' => true
            ]);

            // response success
            return response()->setJSON([
                'status' => 200,
                'message' => 'Login berhasil! Kamu akan diarahkan ke halaman profile.',
                'redirect' => base_url("/$user->username"),
            ]);
        } catch (\Exception $th) {
            $this->db->transRollback();

            return response()->setJSON([
                'status' => 400,
                'message' => $th->getMessage()
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
        session()->destroy(); // destroy session
        return redirect()->back();
    }

    /**
     * Private function checking user
     * 
     * @param string $username
     * @return object|null
     */
    public function checkUser($username)
    {
        return $this->userModel->where('username', $username)->first();
    }
}
