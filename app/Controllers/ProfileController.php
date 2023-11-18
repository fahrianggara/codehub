<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Models\ThreadModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProfileController extends BaseController
{
    protected $db, $userModel, $threadModel;
    
    /**
     * ProfileController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
        $this->threadModel = new ThreadModel();
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

        if (!$user) // redirect to home if user not found
            return redirect()->to('/'); 

        $threads = $this->threadModel->where('user_id', $user->id)->where('status', 'published')
            ->with(['users', 'thread_categories', 'thread_tags', 'replies'])
            ->orderBy('created_at','desc')
            ->paginate(10, 'user-thread');
        
        return view('frontend/profile', [
            'title' => "Profile",
            'user' => $user,
            'has_sosial_media' => $user->link_fb || $user->link_tw || $user->link_ig || $user->link_gh || $user->link_li,
            'threads' => $threads,
            'pager' => $this->threadModel->pager,
        ]);
    }

    /**
     * Edit profile
     * 
     * @return void
     */
    public function editProfile()
    {
        $request = $this->request;
        $user_id = auth()->id;
        $rules = [
            'first_name' => [
                'rules' => 'permit_empty|min_length[3]|max_length[30]|alpha_space|string',
                'errors' => [
                    'min_length' => 'Nama depan minimal 3 karakter.',
                    'max_length' => 'Nama depan maksimal 30 karakter.',
                    'alpha_space' => 'Nama depan hanya boleh berisi huruf dan spasi.',
                    'string' => 'Nama depan hanya boleh berisi huruf dan spasi.'
                ]
            ],
            'last_name' => [
                'rules' => 'permit_empty|min_length[3]|max_length[30]|alpha_space|string',
                'errors' => [
                    'min_length' => 'Nama belakang minimal 3 karakter.',
                    'max_length' => 'Nama belakang maksimal 30 karakter.',
                    'alpha_space' => 'Nama belakang hanya boleh berisi huruf dan spasi.',
                    'string' => 'Nama belakang hanya boleh berisi huruf dan spasi.'
                ]
            ],
            'username' => [
                'rules' => "required|min_length[3]|max_length[25]|alpha_numeric|is_unique[users.username,id,{$user_id}]",
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'min_length' => 'Username minimal 3 karakter.',
                    'max_length' => 'Username maksimal 25 karakter.',
                    'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka.',
                    'is_unique' => 'Username sudah digunakan.'
                ]
            ],
            'link_fb' => ['rules' => 'permit_empty|valid_url', 'errors' => ['valid_url' => 'Link tidak valid.']],
            'link_tw' => ['rules' => 'permit_empty|valid_url', 'errors' => ['valid_url' => 'Link tidak valid.']],
            'link_ig' => ['rules' => 'permit_empty|valid_url', 'errors' => ['valid_url' => 'Link tidak valid.']],
            'link_gh' => ['rules' => 'permit_empty|valid_url', 'errors' => ['valid_url' => 'Link tidak valid.']],
            'link_li' => ['rules' => 'permit_empty|valid_url', 'errors' => ['valid_url' => 'Link tidak valid.']],
        ];

        if (!$this->validate($rules)) {
            return response()->setJSON([
                'status' => 400,
                'validation' => true,
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->transBegin();
        try {

            $username = $request->getVar('username');

            $this->userModel->save([
                'id' => $user_id,
                'first_name' => $request->getVar('first_name'),
                'last_name' => $request->getVar('last_name'),
                'username' => $username,
                'link_fb' => $request->getVar('link_fb'),
                'link_tw' => $request->getVar('link_tw'),
                'link_ig' => $request->getVar('link_ig'),
                'link_gh' => $request->getVar('link_gh'),
                'link_li' => $request->getVar('link_li'),
            ]);

            return response()->setJSON([
                'status'=> 200,
                'message' => 'Profile kamu berhasil diubah!',
                'redirect' => base_url($username)
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

    /**
     * Edit avatar
     * 
     * @return void
     */
    public function editAvatar()
    {
        $this->db->transBegin();
        try {
            $oldAvatar = auth()->avatar;
            $path = 'images/avatars/';
            $blob = $this->request->getVar('base64image');

            $avatarName = $blob ? uploadImageBlob($blob, $path, $oldAvatar) : $oldAvatar;
            
            $this->userModel->save([
                'id' => auth()->id,
                'avatar' => $avatarName,
            ]);

            return response()->setJSON([
                'status'=> 200,
                'message' => 'Foto profile kamu berhasil diubah!',
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

    /**
     * Destroy avatar
     * 
     * @return void
     */
    public function destroyAvatar()
    {
        $this->db->transBegin();
        try {
            $avatar = auth()->avatar;

            if (check_photo('avatars', $avatar)) 
                unlink("images/avatars/$avatar");

            $this->userModel->save([
                'id'=> auth()->id,
                'avatar' => 'avatar.png',
            ]);

            return response()->setJSON([
                'status' => 200,
                'message' => 'Foto profile kamu berhasil dihapus!',
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

    /**
     * Edit banner
     * 
     * @return void
     */
    public function editBanner()
    {
        $this->db->transBegin();
        try {
            $oldBanner = auth()->banner;
            $path = 'images/banners/';
            $blob = $this->request->getVar('base64image');

            $bannerName = $blob ? uploadImageBlob($blob, $path, $oldBanner) : $oldBanner;
            
            $this->userModel->save([
                'id' => auth()->id,
                'banner' => $bannerName,
            ]);

            return response()->setJSON([
                'status'=> 200,
                'message' => 'Foto sampul kamu berhasil diubah!',
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

    /**
     * Destroy banner
     * 
     * @return void
     */
    public function destroyBanner()
    {
        $this->db->transBegin();
        try {
            $banner = auth()->banner;

            if (check_photo('banners', $banner)) 
                unlink("images/banners/$banner");

            $this->userModel->save([
                'id'=> auth()->id,
                'banner' => 'banner.png',
            ]);

            return response()->setJSON([
                'status' => 200,
                'message' => 'Foto sampul kamu berhasil dihapus!',
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

    /**
     * Edit password user.
     * 
     * @return void
     */
    public function editPassword()
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
