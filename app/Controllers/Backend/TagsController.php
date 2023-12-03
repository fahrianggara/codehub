<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class TagsController extends BaseController
{
    protected $tagModel;
    
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tagModel = new \App\Models\TagModel(); // Sesuaikan dengan nama model yang Anda gunakan
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $tags = $this->tagModel
            ->orderBy('(SELECT COUNT(*) FROM thread_tags WHERE tag_id = tags.id)', 'desc')
            ->orderBy('(SELECT status FROM threads WHERE id = (SELECT thread_id FROM thread_tags WHERE tag_id = tags.id LIMIT 1))', 'desc')
            ->findAll();

        return view('backend/tags/index', [
            'title' => 'Tagar Diskusi',
            'menu' => 'tags',
            'tags' => $tags,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('backend/tags/create', [
            'title' => 'Tambah Tag',
            'menu' => 'tags'
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

            $this->tagModel->insert([
                'name' => $request->getVar('name'),
                'slug' => slug($this->request->getVar('name'))
            ]);

            return redirect()->route('admin.Tags')->with('success', 'Data tagar berhasil ditambahkan.');
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
            $tag = $this->tagModel->find($id);

            // Jika tagar tidak ditemukan
            if (isNull($tag)) {
                return response()->setJSON([
                    'status' => 400,
                    'message' => 'Data tagar tidak ditemukan.',
                ]);
            }

            // Jika tagar masih digunakan pada diskusi
            if (count($tag->threads) > 0) {
                return response()->setJSON([
                    'status' => 400,
                    'message' => 'Tidak dapat menghapus tagar yang memiliki diskusi.',
                ]);
            }

            $this->tagModel->delete($id); // hapus tag

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
     * rules
     *
     * @param  mixed $id
     * @return void
     */
    private function rules($id = null)
    {
        $unique = $id ? ",id,$id" : '';
        return [
            'name' => [
                'rules' => "required|is_unique[tags.slug$unique]",
                'errors' => [
                    'required' => 'Nama tagar harus diisi.',
                    'is_unique' => 'Nama tagar sudah digunakan.'
                ]
            ],
        ];
    }
}
