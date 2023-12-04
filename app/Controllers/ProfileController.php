<?php

namespace App\Controllers;

use App\Models\ReplyModel;
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
        $get = $this->request->getVar();
        $user = $this->userModel->where('username', $username)->first();

        if (!$user) return redirect()->to('/');  // Jika user tidak ditemukan, redirect ke home

        $query = $this->threadModel->where('threads.user_id', $user->id);
        $statusSelected = (isset($get['status']) && in_array($get['status'], ['published', 'draft'])) ? $get['status'] : 'published';
        $orderSelected = (isset($get['order']) && in_array($get['order'], ['desc', 'asc', 'popular'])) ? $get['order'] : 'desc';
        $categorySelected = (isset($get['category']) && $get['category'] !== 'all') ? $get['category'] : 'all';

        if ($statusSelected === 'published') // Jika status published
        {
            if ($orderSelected === 'popular') { // Jika order popular
                $threads = $this->threadPopular($query, $orderSelected);
            }

            if ($categorySelected !== 'all') { // Jika category bukan all
                $threads = $this->threadCategory($query, $orderSelected, $categorySelected);
            }

            if ($orderSelected !== 'popular' && $categorySelected === 'all') { // Jika order bukan popular dan category all
                $threads = $this->threadDefault($query, $orderSelected);
            }
        } else { // Jika status draft
            if ((auth_check() && auth()->id !== $user->id) || !auth_check()) { // Jika bukan pemilik akun
                throw PageNotFoundException::forPageNotFound();
            }

            if ($orderSelected === 'popular') { // Jika order popular
                $threads = $this->threadPopular($query, $orderSelected, 'draft');
            }

            if ($categorySelected !== 'all') { // Jika category bukan all
                $threads = $this->threadCategory($query, $orderSelected, $categorySelected, 'draft');
            }

            if ($orderSelected !== 'popular' && $categorySelected === 'all') { // Jika order bukan popular dan category all
                $threads = $this->threadDefault($query, $orderSelected, 'draft');
            }
        }

        return view('frontend/profile', [
            'title' => "$user->full_name",
            'user' => $user,
            'has_sosial_media' => $user->link_fb || $user->link_tw || $user->link_ig || $user->link_gh || $user->link_li,
            'threads' => $threads,
            'pager' => $this->threadModel->pager,
            'status_selected' => $statusSelected,
            'order_selected' => $orderSelected,
            'category_selected' => $categorySelected,
            'selected_true' => $statusSelected !== 'published' || $orderSelected !== 'desc' || $categorySelected !== 'all',
            'categories' => $this->filteringCategories($user, $statusSelected),
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

        if (!$this->validate($this->rulesProfile($user_id))) {
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
                'username' => strtolower($username),
                'link_fb' => $request->getVar('link_fb'),
                'link_tw' => $request->getVar('link_tw'),
                'link_ig' => $request->getVar('link_ig'),
                'link_gh' => $request->getVar('link_gh'),
                'link_li' => $request->getVar('link_li'),
            ]);

            session()->setFlashdata('info', 'Profile kamu berhasil diubah.');

            return response()->setJSON([
                'status' => 200,
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

            $uploadResult = $blob ? uploadImageBlob($blob, $path, $oldAvatar) : ['fileName' => $oldAvatar];

            // Check if there was an error during image upload
            if (isset($uploadResult['error'])) {
                $this->response->setStatusCode(400);

                return response()->setJSON([
                    'status' => 400,
                    'message' => $uploadResult['error'],
                ]);
            }

            $avatarName = $uploadResult['fileName'];

            $this->userModel->save([
                'id' => auth()->id,
                'avatar' => $avatarName,
            ]);

            session()->setFlashdata('info', 'Foto profile kamu berhasil diubah.');

            return response()->setJSON([
                'status' => 200,
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

            if (check_photo('avatars', $avatar)) unlink("images/avatars/$avatar");

            $this->userModel->save([
                'id' => auth()->id,
                'avatar' => 'avatar.png',
            ]);

            session()->setFlashdata('info', 'Foto profile kamu berhasil dihapus.');

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

            $uploadResult = $blob ? uploadImageBlob($blob, $path, $oldBanner) : ['fileName' => $oldBanner];

            // Check if there was an error during image upload
            if (isset($uploadResult['error'])) {
                $this->response->setStatusCode(400);

                return response()->setJSON([
                    'status' => 400,
                    'message' => $uploadResult['error'],
                ]);
            }

            $this->userModel->save([
                'id' => auth()->id,
                'banner' => $uploadResult['fileName'],
            ]);

            session()->setFlashdata('info', 'Foto sampul kamu berhasil diubah.');

            return response()->setJSON([
                'status' => 200,
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

            if (check_photo('banners', $banner)) unlink("images/banners/$banner");

            $this->userModel->save([
                'id' => auth()->id,
                'banner' => 'banner.png',
            ]);

            session()->setFlashdata('info', 'Foto sampul kamu berhasil dihapus.');

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
                'status' => 200,
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

    /**
     * Rules profile
     *
     * @param  mixed $user_id
     * @return array
     */
    private function rulesProfile($user_id)
    {
        return [
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
                'rules' => "required|min_length[3]|max_length[20]|alpha_numeric|is_unique[users.username,id,{$user_id}]",
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'min_length' => 'Username minimal 3 karakter.',
                    'max_length' => 'Username maksimal 20 karakter.',
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
    }

    /**
     * Filtering categories
     *
     * @param  mixed $user
     * @return void
     */
    private function filteringCategories($user, $statusSelected)
    {
        $categories = [];
        $categorySlugs = [];  // Untuk tracking slug agar tidak ada slug yang sama
        $threads = $this->threadModel->where('user_id', $user->id)
            ->where('status', $statusSelected)
            ->findAll();

        foreach ($threads as $thread) {
            $categorySlug = $thread->category->slug;

            // Jika slug belum ada di array, maka tambahkan
            if (!in_array($categorySlug, $categorySlugs)) {
                $categories[] = [
                    'slug' => $categorySlug,
                    'name' => $thread->category->name,
                ];

                // Tambahkan slug ke array agar tidak ada slug yang sama
                $categorySlugs[] = $categorySlug;
            }
        }

        return $categories;
    }

    /**
     * threadDefault
     *
     * @param  mixed $query
     * @param  mixed $orderSelected
     * @param  mixed $status
     * @return void
     */
    private function threadDefault($query, $orderSelected, $status = 'published')
    {
        return $query->with(['users', 'replies'])
            ->where('status', $status)->orderBy('created_at', $orderSelected)
            ->paginate(10, 'user-thread');
    }

    /**
     * threadPopular
     *
     * @param  mixed $query
     * @param  mixed $orderSelected
     * @param  mixed $status
     * @return void
     */
    private function threadPopular($query, $orderSelected, $status = 'published')
    {
        return $query->with(['users', 'thread_categories', 'thread_tags', 'replies'])
            ->where('status', $status)
            ->orderBy('(SELECT COUNT(*) FROM replies WHERE thread_id = threads.id)', 'desc')
            ->orderBy('(SELECT COUNT(*) FROM likes WHERE model_id = threads.id)', 'desc')
            ->orderBy('views', 'desc')
            ->paginate(10, 'user-thread');
    }

    /**
     * threadCategory
     *
     * @param  mixed $query
     * @param  mixed $orderSelected
     * @param  mixed $categorySelected
     * @param  mixed $status
     * @return void
     */
    private function threadCategory($query, $orderSelected, $categorySelected, $status = 'published')
    {
        $builder = $query->with(['users', 'replies']) // Ambil semua relasi
            ->join('thread_categories', 'thread_categories.thread_id = threads.id')
            ->join('categories', 'categories.id = thread_categories.category_id')
            ->where('status',  $status)
            ->where('categories.slug', strtolower($categorySelected)) // Dijadikan lowercase agar slug tidak case sensitive
            ->groupBy('threads.id') // Group by agar tidak ada thread yang sama
            ->select('threads.*, MAX(thread_categories.id) as category_id, MAX(categories.slug) as category_slug'); // Ambil category terakhir

        if ($orderSelected === 'popular') {
            $builder->orderBy('(SELECT COUNT(*) FROM replies WHERE thread_id = threads.id)', 'desc')
                ->orderBy('(SELECT COUNT(*) FROM likes WHERE model_id = threads.id)', 'desc')
                ->orderBy('views', 'desc');
        } else {
            $builder->orderBy('threads.created_at', $orderSelected);
        }

        return $builder->paginate(10, 'user-thread');
    }

    public function reportDiskusi()
    {
        $reportModel = new ReplyModel();
        $reports = $reportModel->getReports();

        $data = [
            'message' => $this->request->getPost('message'),
            'user_id' => $this->request->getPost('user_id'),
            'model_id' => $this->request->getPost('model_id'),
            'model_class' => $this->request->getPost('model_class'),
        ];

        $reportModel->saveReport($data);

        // Tambahkan logika untuk menampilkan pesan sukses atau gagal
    }
}
