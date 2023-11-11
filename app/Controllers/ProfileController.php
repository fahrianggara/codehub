<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProfileController extends BaseController
{
    protected $db, $userModel;
    
    /**
     * ProfileController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  mixed $username
     * @return void
     */
    public function index($username)
    {
        $user = $this->userModel->where('username', $username)->first();
        
        if (!$user) throw PageNotFoundException::forPageNotFound();
        
        return view('frontend/profile', [
            'title' => "Profile",
            'user' => $user,
        ]);
    }

    /**
     * Change password user.
     * 
     * @return void
     */
    public function changePassword()
    {
        $request = $this->request;

        if (!$request->isAJAX()) 
            return PageNotFoundException::forPageNotFound();

        $oldpass = $request->getVar('oldpass');
        $newpass = $request->getVar('newpass');

        $rules = [
            'oldpass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kata sandi lama harus diisi.',
                ]
            ],
            'newpass' => [
                'rules' => 'required|min_length[8]|max_length[16]',
                'errors' => [
                    'required' => 'Kata sandi baru harus diisi.',
                    'min_length' => 'Kata sandi minimal 8 karakter.',
                    'max_length' => 'Kata sandi maksimal 16 karakter.'
                ]
            ],
            'confpass' => [
                'rules' => 'required|matches[newpass]',
                'errors' => [
                    'required' => 'Konfirmasi kata sandi harus diisi.',
                    'matches' => 'Konfirmasi kata sandi tidak sesuai.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return response()->setJSON([
                'status' => 400,
                'val' => true,
                'message' => $this->validator->getErrors()
            ]);
        }

        if (!password_verify($oldpass, auth()->password)) {
            return response()->setJSON([
                'status' => 400,
                'message' => 'Kata sandi lama tidak sesuai.'
            ]);
        }

        $this->db->transBegin();
        try {
            $this->userModel->save([
                'id' => auth()->id,
                'password' => password_hash($newpass, PASSWORD_BCRYPT),
            ]);

            session()->destroy(); // destroy session

            return response()->setJSON([
                'status'=> 200,
                'message' => 'Kata sandi kamu berhasil diubah. Silahkan login kembali.',
                'redirect' => route_to('login')
            ]);
        } catch (\Throwable $th) {
            $this->db->transRollback();

            return response()->setJSON([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        } finally {
            $this->db->transCommit();
        }
    }
}
