<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\TagModel;
use App\Models\ThreadModel;
use App\Controllers\BaseController;
use HTMLPurifier_Config, HTMLPurifier;

class DiskusiController extends BaseController
{
    protected $categoryModel, $tagModel, $threadModel;
    
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->threadModel = new ThreadModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel = new TagModel();
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return void
     */
    public function store()
    {
        $post = $this->request->getPost();

        if (!$this->validate($this->rules())) {
            return response()->setJSON([
                'status' => 400,
                'validate' => true,
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->transBegin();
        try {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $title = $purifier->purify($post['title']);
            
            $this->threadModel->insert([
                'title'=> $title,
                'slug' => slug($title),
                'content' => $purifier->purify($post['content']),
                'status' => 'published',
                'views' => 0,
                'user_id' => auth()->id
            ]);

            $insertId = $this->db->insertID();

            $tags = [];
            foreach ($post['tag_ids'] as $tag) {
                $this->threadModel->tagNotExist($tag);
                $tags[] = $this->tagModel->where('slug', slug($tag))->first()->id;
            }

            $this->threadModel->syncCategories($insertId, $post['category_id']);
            $this->threadModel->syncTags($insertId, $tags);
            
            return response()->setJSON([
                'status' => 200,
                'message' => 'Diskusi berhasil dibuat.'
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
     * Edit the specified resource.
     * 
     * @return void
     */
    public function edit()
    {
        $post = $this->request->getPost();

        if (isset($post['id'])) {
            $id = base64_decode($post['id']);
            $thread = $this->threadModel->select('id, title, content')->find($id);

            return response()->setJSON([
                'status' => 200,
                'thread' => $thread,
                'category' => $thread->category,
                'tags' => $thread->tags
            ]);
        }
        
        return false;
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return void
     */
    public function update()
    {
        $post = $this->request->getPost();
        $id = base64_decode($post['id']);

        if (!$this->validate($this->rules($id))) {
            return response()->setJSON([
                'status' => 400,
                'validate' => true,
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->transBegin();
        try {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $title = $purifier->purify($post['title']);

            $this->threadModel->update($id, [
                'title'=> $title,
                'slug' => slug($title),
                'content' => $purifier->purify($post['content']),
            ]);

            $tags = [];
            foreach ($post['tag_ids'] as $tag) {
                $this->threadModel->tagNotExist($tag);
                $tags[] = $this->tagModel->where('slug', slug($tag))->first()->id;
            }

            $this->threadModel->syncCategories($id, $post['category_id']);
            $this->threadModel->syncTags($id, $tags);

            return response()->setJSON([
                'status' => 200,
                'message' => 'Diskusi berhasil diperbarui.'
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
     * Delete the specified resource from storage.
     * 
     * @return void
     */
    public function destroy()
    {
        $post = $this->request->getPost();

        $this->db->transBegin();
        try {
            $id = base64_decode($post['id']);
            $thread = $this->threadModel->with(['likes', 'notifications', 'reports'])->find($id);

            if ($thread->likes) {
                $this->threadModel->deleteLikes($thread);
            } else if ($thread->notifications) {
                $this->threadModel->deleteNotifications($thread);
            } else if ($thread->reports) {
                $this->threadModel->deleteReports($thread);
            }

            $this->threadModel->delete($id);
            
            return response()->setJSON([
                'status' => 200,
                'message' => 'Diskusi berhasil dihapus.'
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
     * Draft the specified resource from storage.
     * 
     * @return void
     */
    public function draft()
    {
        $post = $this->request->getPost();

        $this->db->transBegin();
        try {
            $id = base64_decode($post['id']);

            $this->threadModel->update($id, ['status' => 'draft']);
            
            return response()->setJSON([
                'status' => 200,
                'message' => 'Diskusi berhasil di arsip.'
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
     * Publish the specified resource from storage.
     * 
     * @return void
     */
    public function publish()
    {
        $post = $this->request->getPost();

        $this->db->transBegin();
        try {
            $id = base64_decode($post['id']);

            $this->threadModel->update($id, ['status' => 'published']);
            
            return response()->setJSON([
                'status' => 200,
                'message' => 'Diskusi berhasil di publish.'
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
     * Get categories
     *
     * @return void
     */
    public function getCategories()
    {
        $post = $this->request->getPost();
        $data = [];

        if (empty($post['search'])) {
            $categories = $this->categoryModel
                ->orderBy('name','asc')
                ->findAll(5);
        } else {
            $categories = $this->categoryModel->orderBy('name','asc')
                ->like('name', $post['search'])->findAll(5);
        }

        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id,
                'text'=> $category->name,
            ];
        }

        return response()->setJSON([
            'status' => 200,
            'data' => $data
        ]);
    }

    /**
     * Get tags
     * 
     * @return void
     */
    public function getTags()
    {
        $post = $this->request->getPost();
        $data = [];

        if (empty($post['search'])) {
            $tags = $this->tagModel->findAll(5);
        } else {
            $tags = $this->tagModel->like('name', $post['search'])
                ->findAll(5);
        }

        foreach ($tags as $tag) {
            $data[] = [
                'id' => $tag->slug,
                'text'=> $tag->name,
            ];
        }

        return response()->setJSON([
            'status' => 200,
            'data' => $data
        ]);
    }

    /**
     * Rules validation
     * 
     * @return array
     */
    private function rules($id = null)
    {
        $unique = $id ? ",id,$id" : '';

        return [
            'title' => [
                'rules' => "required|min_length[3]|max_length[100]|string|alpha_numeric_space|is_unique[threads.slug$unique]",
                'errors' => [
                    'required' => 'Judul diskusi harus diisi.',
                    'min_length' => 'Judul diskusi minimal 3 karakter.',
                    'max_length' => 'Judul diskusi maksimal 100 karakter.',
                    'alpha_numeric_space' => 'Judul hanya boleh berisi huruf dan angka.',
                    'is_unique' => 'Judul diskusi sudah ada.',
                ]
            ],
            'category_id' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Kategori diskusi harus dipilih.',
                ]
            ],
            'tag_ids' => ['rules' => "permit_empty"],
            'content' => [
                'rules' => "required|min_length[10]|max_length[10000]|string",
                'errors' => [
                    'required' => 'Konten diskusi harus diisi.',
                    'min_length' => 'Konten diskusi minimal 10 karakter.',
                    'max_length' => 'Konten diskusi maksimal 10000 karakter.',
                    'string' => 'Konten diskusi hanya boleh berisi huruf dan spasi.',
                ]
            ]
        ];
    }
}
