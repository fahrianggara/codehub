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

        if (!$this->validate($this->rules())) {
            return response()->setJSON([
                'status' => 400,
                'validate' => true,
                'errors' => $this->validation->getErrors(),
            ]);
        }

        $this->db->transBegin();
        try {
            $username = $request->getVar('username'); // username or email
            $password = $request->getVar('password');
            
            // check inputan username jika ada @ maka dianggap email
            if (strpos($username, '@') === false) { // <-- Username
                $user = $this->checkUser('username', $username);
                if (!$user) 
                    return response()->setJSON(['status' => 400, 'message' => "Username $username tidak ditemukan!"]);
            } else { // <-- Email
                $user = $this->checkUser('email', $username);
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
                'role' => $user->role,
                'logged_in' => true
            ]);

            switch ($user->role) {
                case 'admin':
                    return response()->setJSON([
                        'status' => 200,
                        'message' => "kamu akan diarahkan ke halaman dashboard admin",
                        'redirect' => route_to("admin.dash"),
                    ]);
                    break;
                case "user":
                    return response()->setJSON([
                        'status' => 200,
                        'message' => "kamu akan diarahkan ke halaman profile kamu",
                        'redirect' => base_url("$user->username"),
                    ]);
                    break;
                default:
                    session()->destroy();
                    return response()->setJSON([
                        'status' => 400,
                        'message' => "role $user->role tidak ditemukan!",
                        'redirect' => route_to("login"),
                    ]);
                    break;
            }
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
     * Rules validation
     * 
     * @return array
     */
    private function rules()
    {
        return [
            'username' => [
                'rules' => 'required',
                'errors' => ['required' => 'Username atau Email tidak boleh kosong.']
            ],
            'password' => [
                'rules' => 'required',
                'errors' => ['required' => 'Password tidak boleh kosong.']
            ]
        ];
    }

    /**
     * Private function checking user
     * 
     * @param string $field
     * @param string $username
     * @return object|null
     */
    public function checkUser($field, $username)
    {
        return $this->userModel->where($field, $username)->first();
    }
}
