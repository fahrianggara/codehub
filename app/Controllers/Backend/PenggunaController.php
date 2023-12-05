<?php

namespace App\Controllers\Backend;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class PenggunaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = $this->userModel->orderBy('role', 'ASC')
            ->orderBy('created_at', 'DESC') // urutkan berdasarkan role dan waktu bergabung
            ->where('id !=', 1) // jangan tampilkan data admin
            ->where('id !=', auth()->id) // jangan tampilkan data yg sedang login
            ->findAll();

        return view('backend/pengguna/index', [
            'title' => 'Pengguna',
            'menu' => 'pengguna',
            'users' => $users
        ]);
    }

    /**
     * Create a new resource.
     * 
     * @return void
     */
    public function create()
    {
        return view('backend/pengguna/create', [
            'title' => 'Tambah Pengguna',
            'menu' => 'pengguna'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return void
     */
    public function store()
    {
        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $request = $this->request;
            $path = ['avatar' => 'images/avatars', 'banner' => 'images/banners'];
            $blob = ['avatar' => $request->getVar('blob_avatar'), 'banner' => $request->getVar('blob_banner')];

            $avatar = $blob['avatar'] ? uploadImageBlob($blob['avatar'], $path['avatar']) : ['fileName' => 'avatar.png'];
            $banner = $blob['banner'] ? uploadImageBlob($blob['banner'], $path['banner']) : ['fileName' => 'banner.png'];

            if (isset($avatar['error'])) {
                return redirect()->back()->withInput()->with('error', $avatar['error']);
            } elseif (isset($banner['error'])) {
                return redirect()->back()->withInput()->with('error', $banner['error']);
            }

            $this->userModel->insert([
                'first_name'    => $request->getVar('first_name'),
                'last_name'     => $request->getVar('last_name'),
                'username'      => strtolower($request->getVar('username')),
                'email'         => $request->getVar('email'),
                'password'      => password_hash($request->getVar('password'), PASSWORD_BCRYPT),
                'role'          => $request->getVar('role'),
                'avatar'        => $avatar['fileName'],
                'banner'        => $banner['fileName'],
            ]);

            return redirect()->route('admin.pengguna')->with('success', 'Data pengguna berhasil ditambahkan.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string|null $id
     * @return void
     */
    public function edit($id)
    {
        $user = $this->userModel->find(decrypt($id));

        if (isNull($user)) {
            return redirect()->route('admin.pengguna')->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('backend/pengguna/edit', [
            'title' => 'Edit Pengguna',
            'menu' => 'pengguna',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return void
     */
    public function update()
    {
        $request = $this->request;
        $id = decrypt($request->getVar('id'));
        $user = $this->userModel->find($id);

        if (isNull($user)) {
            return redirect()->route('admin.pengguna')->with('error', 'Data pengguna tidak ditemukan.');
        }

        if (!$this->validate($this->rules($id))) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $blob = ['avatar' => $request->getVar('blob_avatar'), 'banner' => $request->getVar('blob_banner')];
            $old = ['avatar' => $user->avatar, 'banner' => $user->banner];

            $avatar = $blob['avatar'] ? uploadImageBlob($blob['avatar'], 'images/avatars', $old['avatar']) : ['fileName' => $old['avatar']];
            $banner = $blob['banner'] ? uploadImageBlob($blob['banner'], 'images/banners', $old['banner']) : ['fileName' => $old['banner']];

            // cek apakah upload gagal
            if (isset($avatar['error'])) {
                return redirect()->back()->withInput()->with('error', $avatar['error']);
            } elseif (isset($banner['error'])) {
                return redirect()->back()->withInput()->with('error', $banner['error']);
            }

            $this->userModel->save([
                'id'            => $id,
                'first_name'    => $request->getVar('first_name'),
                'last_name'     => $request->getVar('last_name'),
                'username'      => strtolower($request->getVar('username')),
                'email'         => $request->getVar('email'),
                'role'          => $request->getVar('role'),
                'avatar'        => $avatar['fileName'], // ambil nama file dari array ['fileName' => 'nama_file.png'
                'banner'        => $banner['fileName'],
            ]);

            return redirect()->route('admin.pengguna')->with('success', 'Data pengguna berhasil diubah.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Destroy the specified resource in storage.
     * 
     * @return void
     */
    public function destroy()
    {
        if (!request()->isAJAX()) // jika bukan ajax request, lempar ke 404
            throw PageNotFoundException::forPageNotFound();

        $this->db->transBegin();
        try {
            $id = decrypt(request()->getVar('id'));
            $user = $this->userModel->find($id);

            if (isNull($user)) {
                return response()->setJSON([
                    'status' => 400,
                    'message' => 'Data pengguna tidak ditemukan.'
                ]);
            }

            deleteImage("images/avatars", $user->avatar); // hapus avatar
            deleteImage("images/banners", $user->banner); // hapus banner

            $this->userModel->delete($id); // hapus user

            return response()->setJSON([
                'status' => 200,
                'message' => 'Data pengguna berhasil dihapus.'
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
     * Message for validation
     * 
     * @param boolean $edit
     * @param string|null $id
     * @param string|null $tc_id
     * @return array
     */
    private function rules($id = null)
    {
        $unique = $id ? ",id,$id" : '';

        if ($id === null) {
            $rule_merge = [
                'password' => [
                    'rules' => 'required|min_length[8]|max_length[16]',
                    'errors' => [
                        'required' => 'Kata sandi harus diisi.',
                        'min_length' => 'Kata sandi minimal 8 karakter.',
                        'max_length' => 'Kata sandi maksimal 16 karakter.'
                    ]
                ],
            ];
        }

        $rule = [
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
                'rules' => "required|min_length[3]|max_length[25]|alpha_numeric|is_unique[users.username$unique]",
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'min_length' => 'Username minimal 3 karakter.',
                    'max_length' => 'Username maksimal 25 karakter.',
                    'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka.',
                    'is_unique' => 'Username sudah digunakan.'
                ]
            ],
            'email' => [
                'rules' => "required|valid_email|is_unique[users.email$unique]",
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Peran pengguna harus diisi.'
                ]
            ],
            'blob_avatar' => [
                'rules' => 'permit_empty',
            ],
            'blob_banner' => [
                'rules' => 'permit_empty',
            ],
        ];

        return array_merge($rule, $rule_merge ?? []);
    }
}
