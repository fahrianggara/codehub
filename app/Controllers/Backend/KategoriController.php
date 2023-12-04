<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class KategoriController extends BaseController
{
    protected $categoryModel;
    
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $categories =  $this->categoryModel
            ->orderBy('(SELECT COUNT(*) FROM thread_categories WHERE category_id = categories.id)', 'desc')
            ->findAll();

        return view('backend/kategori/index', [
            'title' => 'Kategori Diskusi',
            'menu' => 'kategori',
            'categories' => $categories,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('backend/kategori/create', [
            'title' => 'Kategori',
            'menu' => 'kategori',
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
            $name = trim($request->getVar('name'));

            $path = 'images/categories';
            $blob = $request->getVar('blob_cover');
            $uploadResult = $blob ? uploadImageBlob($blob , $path) : ['fileName' => 'empty.png'];

            // cek apakah upload gagal
            if (isset($uploadResult['error'])) {
                return redirect()->back()->withInput()->with('error', $uploadResult['error']);
            }

            $this->categoryModel->insert([
                'name' => $name,
                'slug' => slug($name),
                'cover' => $uploadResult['fileName'],
            ]);

            return redirect()->route('admin.kategori')->with('success', 'Data kateogri berhasil ditambahkan.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }
    
    /**
     * Display edit form.
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $category = $this->categoryModel->find(decrypt($id));

        return view('backend/kategori/edit', [
            'title' => 'Edit Kategori',
            'menu' => 'kategori',
            'category' => $category
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
        $category = $this->categoryModel->find($id);

        if (!$this->validate($this->rules($id))) {
            return redirect()->back()->withInput();
        }

        if (isNull($category)) {
            return redirect()->route('admin.kategori')
                ->withInput()->with('error', 'Data kategori tidak ditemukan.');
        } 

        $this->db->transBegin();
        try {
            $name = trim($request->getVar('name'));

            $path = 'images/categories';
            $blob = $request->getVar('blob_cover');
            $old = $category->cover;

            // cek apakah ada perubahan cover
            $uploadResult = $blob ? uploadImageBlob($blob, $path, $old) : ['fileName' => $old];

            // cek apakah upload gagal
            if (isset($uploadResult['error'])) {
                return redirect()->back()->withInput()->with('error', $uploadResult['error']);
            }

            $this->categoryModel->save([
                'id' => $id,
                'name' => $name,
                'slug' => slug($name),
                'cover' => $uploadResult['fileName'],
            ]);
            
            return redirect()->route('admin.kategori')->with('success', 'Data kategori berhasil diubah.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }
    
    /**
     * Delete the specified resource in storage.
     *
     * @return void
     */
    public function destroy()
    {
        $this->db->transBegin();
        try {
            $id = decrypt(request()->getVar('id'));
            $category = $this->categoryModel->find($id);

            // cek apakah data kategori kosong
            if (isNull($category)) {
                return response()->setJSON([
                    'status' => 400,
                    'message' => 'Data kategori tidak ditemukan.',
                ]);
            } 

            // cek apakah didalam kategori tersebut ada thread
            if (count($category->threads) > 0) {
                return response()->setJSON([
                    'status' => 400,
                    'message' => 'Tidak dapat menghapus kategori yang memiliki diskusi.',
                ]);
            }

            deleteImage("images/categories", $category->cover); // hapus cover

            $this->categoryModel->delete($id); // hapus user

            session()->setFlashdata('success', 'Data tagar berhasil dihapus.');
            return response()->setJSON([
                'status' => 200,
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
     * Rules for validation.
     *
     * @return array
     */
    private function rules($id = null)
    {
        $unique = $id ? ",id,$id" : '';

        return [
            'name' => [
                'rules' => "required|min_length[4]|max_length[30]|is_unique[categories.slug$unique]",
                'errors' => [
                    'required' => 'Nama Kategori Tidak Boleh Kosong',
                    'min_length' => 'Nama Kategori minimal 4 karakter',
                    'max_length' => 'Nama Kategori maksimal 30 karakter',
                    'is_unique' => 'Nama Kategori sudah digunakan'
                ]
            ],
        ];
    }

}
