<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class TagsController extends BaseController
{
    protected $tagModel;

    public function __construct()
    {
        $this->tagModel = new \App\Models\TagModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }

    public function index()
    {
        $tags = $this->tagModel->findAll();
        // dd($tags); // check dulu

        return view('backend/tags/index', [
            'title' => 'Tags',
            'menu' => 'tags',
            'tags' => $tags,
        ]);
    }

    public function create()
    {
        return view('backend/tags/create', [
            'title' => 'Tambah Tag',
            'menu' => 'tags'
        ]);
    }

    public function store()
    {
        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput();
            
        }

        $this->db->transBegin();
        try {
            $request = $this->request;

            $this->tagModel->insert([
                'name' => $request->getVar('name'),
                'slug' => slug($this->request->getVar('name'))
            ]);

            return redirect()->route('admin.Tags')->with('success', 'Data tag berhasil ditambahkan.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    private function rules($id=null)
    {
        $unique = $id ? ",id,$id" : '';
        return [
            'name' => [
                'rules' => "required|is_unique[tags.slug$unique]",
                'errors' => [
                    'required' => 'Nama tag harus diisi.',
                    'is_unique' => 'Nama tag sudah digunakan.'
                ]
            ],
        ];
    }

    public function destroy()
    {
        $this->db->transBegin();

        try {
            $id = base64_decode(request()->getVar('id'));
            $tag = $this->tagModel->find($id);

            $this->tagModel->delete($id); // hapus tag

            return response()->setJSON([
                'status' => 200,
                'message' => 'Data tag berhasil dihapus.'
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
