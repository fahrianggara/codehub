<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class KategoriController extends BaseController
{
    protected $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
    }
    public function index()
    // Nampilin Index.php di section Category Backend
    {
        $categories =  $this->categoryModel->findAll();
        return view('backend/kategori/index', [
            'title' => 'Kategori',
            'menu' => 'kategori',
            'categories' => $categories,
        ]);
    }
    // Nyimpen hasil Create
    public function store()
    {
        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput();
        }
        $this->db->transBegin();
        try {
            $request = $this->request;
            $cover = $request->getVar('blob_cover') ? uploadImageBlob($request->getVar('blob_cover'), 'images/categories') : 'empty.png';
            $this->categoryModel->insert([
                'name' => $request->getVar('name'),
                'slug' => slug($request->getVar('name')),
                'cover' => $cover
            ]);
            return redirect()->route('admin.kategori')->with('success', 'Data kateogri berhasil ditambahkan.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }
    // create
    public function create()
    {
        return view('backend/kategori/create', [
            'title' => 'Kategori',
            'menu' => 'kategori',
        ]);
    }
    // Ketentuan Buat setiap Kolom
    private function rules()
    {
        return [
            'name' => [
                'rules' => 'required|min_length[4]|max_length[28]',
                'errors' => [
                    'required' => 'Nama Kategori Tidak Boleh Kosong',
                    'min_length' => 'Nama Kategori minimal 4 karakter',
                    'max_length' => 'Nama Kategori maksimal 28 karakter'
                ]
            ],
        ];

    }
    // edit
    public function edit($id)
    {
        $categories = $this->categoryModel->find(base64_decode($id));

        return view('backend/kategori/edit', [
            'title' => 'Edit Kategori',
            'menu' => 'kategori',
            'categories' => $categories
        ]);
    }
    // update
    public function update()
    {
        $request = $this->request;
        $id = base64_decode($request->getVar('id'));
        $categories = $this->categoryModel->find($id);

        if (!$this->validate($this->rules($id))) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $cover = $request->getVar('blob_cover') ? uploadImageBlob($request->getVar('blob_cover'), 'images/categories', $categories->cover) : $categories->cover;
           

            $this->categoryModel->save([
                'id'            => $id,
                'name'    => $request->getVar('name'),
                'cover'        => $cover,
               
            ]);

            return redirect()->route('admin.kategori')->with('success', 'Data kategori berhasil diubah.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    // hapus
    public function destroy()
    {
        if (!request()->isAJAX()) // jika bukan ajax request, lempar ke 404
            // throw PageNotFoundException::forPageNotFound();

        $this->db->transBegin();
        try {
            $id = base64_decode(request()->getVar('id'));
            $categories = $this->categoryModel->find($id);

            deleteImage("images/cover", $categories->cover); // hapus cover
            

            $this->categoryModel->delete($id); // hapus user

            return response()->setJSON([
                'status' => 200,
                'message' => 'Data kategori berhasil dihapus.'
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


 
