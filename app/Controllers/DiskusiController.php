<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ReportModel;
use App\Models\TagModel;
use App\Models\ThreadModel;
use App\Controllers\BaseController;
use App\Models\ReplyModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use HTMLPurifier_Config, HTMLPurifier;
use Carbon\Carbon;

class DiskusiController extends BaseController
{
    protected $categoryModel, $tagModel, $threadModel, $replyModel;

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
        $this->replyModel = new ReplyModel();
    }

    /**
     * Show the specified resource.
     * 
     * @param string $slug
     * @return void
     */
    public function show($slug)
    {
        $thread = $this->threadModel->published()
            ->with(['users'])->where('slug', $slug)->first();

        $categories =  $this->categoryModel
            ->join('thread_categories', 'thread_categories.category_id = categories.id')
            ->groupBy('categories.id')
            ->join('threads', 'threads.id = thread_categories.thread_id')
            ->where('threads.status', 'published')
            ->select('categories.*, COUNT(category_id) as count')
            ->orderBy('count', 'desc')
            ->findAll(3);

        if (!$thread) throw PageNotFoundException::forPageNotFound();

        $this->threadModel->incrementViews($thread->id);
        $threads = $this->threadModel->published()->where('id !=', $thread->id)
            ->orderBy('RAND()')->findAll(3);

        return view('frontend/diskusi/detail', [
            'title' => $thread->title,
            'thread' => $thread,
            'threads' => $threads,
            'user' => $thread->user,
            'category' => $thread->category,
            'categories' => $categories,
        ]);
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

            // handle duplicate thread title
            $thread = $this->threadModel->where('title', trim($title))
                ->where('user_id', auth()->id)
                ->where('created_at >', Carbon::now()->subMinutes()) 
                ->first();

            if (!$thread) {
                $this->threadModel->insert([
                    'title' => $title,
                    'slug' => slug($title) . '-' . rand(10000, 99999),
                    'content' => $purifier->purify($post['content']),
                    'status' => 'published',
                    'views' => 0,
                    'user_id' => auth()->id
                ]);
            }

            $insertId = $this->db->insertID();

            if (isset($post['tag_ids'])) {
                $tags = [];
                
                foreach ($post['tag_ids'] as $tag) {
                    $slug = slug($tag);
                    $pattern = '/[#@$%^*()+=\-[\]\';,.\/{}|":<>?~\\_\\\\]/';
                    $script = preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $tag);
    
                    if (empty($slug) || $script) continue; // skip if tag empty (only symbol)
                    $tag = preg_replace($pattern, '', $tag); // remove symbol
    
                    $this->threadModel->tagNotExist($tag);
                    $tagModel = $this->tagModel->where('slug', $slug)->first();
    
                    if ($tagModel) $tags[] = $tagModel->id;
                }
    
                if (!empty($tags)) $this->threadModel->syncTags($insertId, $tags);
            }

            $this->threadModel->syncCategories($insertId, $post['category_id']);
            
            session()->setFlashdata('info', 'Diskusi berhasil dibuat.');

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
            $id = decrypt($post['id']);
            $thread = $this->threadModel->select('id, title, content')->find($id);

            return response()->setJSON([
                'status' => 200,
                'thread' => $thread,
                'category' => $thread->category,
                'tags' => $thread->tags
            ]);
        } else if (isset($post['reply_id'])) {
            $id = decrypt($post['reply_id']);
            $reply = $this->replyModel->select('id, content')->find($id);

            return response()->setJSON([
                'status' => 200,
                'reply' => $reply,
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
        $id = decrypt(isset($post['id']) ? $post['id'] : $post['reply_id']);
        $hasReplyId = isset($post['reply_id']);

        if (!$this->validate($this->rules($id, $hasReplyId))) {
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

            if (isset($post['reply_id'])) {
                $this->replyModel->update($id, [
                    'content' => $purifier->purify($post['content']),
                ]);

                session()->setFlashdata('info', 'Balasan berhasil diperbarui.');

                return response()->setJSON([
                    'status' => 200,
                    'message' => 'Balasan berhasil diperbarui.'
                ]);
            }

            $thread = $this->threadModel->find($id);
            $title = $purifier->purify($post['title']);

            // get last number slug example: lorem-ipsum-dolor-sit-amet-12345
            $lastSlug = explode('-', $thread->slug);
            $numberId = end($lastSlug);

            // jika terakhir explode bukan angka, maka set random number
            if (!is_numeric($numberId)) {
                $numberId = rand(10000, 99999);
            }

            $this->threadModel->update($id, [
                'title' => $title,
                'slug' => slug($title) . '-' . $numberId,
                'content' => $purifier->purify($post['content']),
            ]);

            if (isset($post['tag_ids'])) {
                $tags = [];

                foreach ($post['tag_ids'] as $tag) {
                    $slug = slug($tag);
                    $pattern = '/[#@$%^*()+=\-[\]\';,.\/{}|":<>?~\\_\\\\]/';
                    $script = preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $tag);

                    if (empty($slug) || $script) continue; // skip if tag empty (only symbol)
                    $tag = preg_replace($pattern, '', $tag); // remove symbol

                    $this->threadModel->tagNotExist($tag);
                    $tagModel = $this->tagModel->where('slug', slug($tag))->first();

                    if ($tagModel) $tags[] = $tagModel->id;
                }

                if (!empty($tags)) $this->threadModel->syncTags($id, $tags);
            } else {
                $this->db->table('thread_tags')->where('thread_id', $id)->delete();
            }

            $this->threadModel->syncCategories($id, $post['category_id']);

            session()->setFlashdata('info', 'Diskusi berhasil diperbarui.');

            return response()->setJSON([
                'status' => 200,
                'message' => 'Diskusi berhasil diperbarui.',
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
            $id = decrypt($post['id']);
            $thread = $this->threadModel->find($id);

            if ($thread->likes) {
                $this->threadModel->deleteLikes($thread->id);
            } else if ($thread->reports) {
                $this->threadModel->deleteReports($thread->id);
            }

            $this->threadModel->delete($id);

            session()->setFlashdata('info', 'Diskusi berhasil dihapus.');

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
     * Show reply the specified resource from storage.
     * 
     * @return void
     */
    public function replyShow()
    {
        $post = $this->request->getPost();

        if (isset($post['id'])) {
            $id = decrypt($post['id']);
            $thread = $this->threadModel->with(['users', 'replies'])->find($id);

            $data = [
                'title' => $thread->title,
                'slug' => $thread->slug,
                'content' => $thread->content,
                'author' => $thread->user->username,
                'date' => ago($thread->created_at),
            ];

            return response()->setJSON([
                'status' => 200,
                'data' => $data
            ]);
        }

        return false;
    }

    /**
     * Reply the specified resource from storage.
     * 
     * @return void
     */
    public function reply()
    {
        $post = $this->request->getPost();
        $childId = $post['child_id'];
        $parentId = $post['parent_id'];

        $rule = [
            'content' => [
                'rules' => "required|min_length[10]|max_length[20000]|string",
                'errors' => [
                    'required' => 'Konten diskusi harus diisi.',
                    'min_length' => 'Konten diskusi minimal 10 karakter.',
                    'max_length' => 'Konten diskusi maksimal 20000 karakter.',
                    'string' => 'Konten diskusi hanya boleh berisi huruf dan spasi.',
                ]
            ]
        ];

        if (!$this->validate($rule)) {
            return response()->setJSON([
                'status' => 400,
                'validate' => true,
                'errors' => $this->validation->getErrors(),
            ]);
        }

        $checkParent = $this->replyModel->find(decrypt($parentId));
        $checkChild = $this->replyModel->find(decrypt($childId));

        if (($parentId !== "" && !$checkParent) || ($childId !== "" && !$checkChild)) {
            return response()->setJSON([
                'status' => 400,
                'message' => 'Balasan tidak ditemukan.',
                'reload' => true // reload page
            ]);
        } 

        $this->db->transBegin();
        try {
            $this->replyModel->save([
                'content' => $post['content'],
                'approved' => 1,
                'thread_id' => decrypt($post['thread_id']),
                'user_id' => auth()->id,
                'child_id' => $childId !== "" ? decrypt($childId) : null,
                'parent_id' => $parentId !== "" ? decrypt($parentId) : null,
            ]);

            session()->setFlashdata('info', 'Balasan berhasil dikirim.');

            return response()->setJSON([
                'status' => 200,
                'message' => 'Balasan berhasil dikirim.'
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
     * Reply delete the specified resource from storage.
     * 
     * @return void
     */
    public function replyDestroy()
    {
        $post = $this->request->getPost();

        $this->db->transBegin();
        try {
            $id = decrypt($post['id']);
            $reply = $this->replyModel->find($id);

            // jika ada child, maka hapus childnya
            if ($reply->childs) {
                foreach ($reply->childs as $child) {
                    if ($child->likes) {
                        $this->replyModel->deleteLikes($child);
                    }

                    $this->replyModel->delete($child->id);
                }
            }

            if ($reply->likes) {
                $this->replyModel->deleteLikes($reply);
            }

            $this->replyModel->delete($id);

            session()->setFlashdata('info', 'Balasan berhasil dihapus.');

            return response()->setJSON([
                'status' => 200,
                'message' => 'Balasan berhasil dihapus.'
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
     * Like the specified resource from storage.
     * 
     * @return void
     */
    public function like()
    {
        $post = $this->request->getPost();
        $explode = explode('-', decrypt($post['model']));
        $idModel = $explode[0];
        $classModel = $explode[1];
        
        // $idModel = decrypt($post['id']);
        // $classModel = decrypt($post['class']); // value: App\Models\ThreadModel or App\Models\ReplyModel

        // pengecekan jika tidak ada data di database
        $model = new $classModel;
        $check = $model->find($idModel);

        // Jika model adalah thread ber status draft dan bukan milik user yang login, maka tidak boleh like
        $threadDraft = $classModel === "App\Models\ThreadModel" && $check->status === 'draft' && $check->user_id !== auth()->id;

        if (!$check || $threadDraft) {
            return response()->setJSON([
                'status' => 400,
                'reload' => true, // reload page
                'message' => 'Diskusi tidak ditemukan.'
            ]);
        }

        $this->db->transBegin();
        try {
            $model = new $classModel;
            $likeStatus = $model->likeOrUnlikeThread($idModel, $classModel);

            if ($likeStatus === 'unlike') {
                $array = ['btnClassAttr' => 'btn-suka-diskusi btn love', 'iconClassAttr' => 'far fa-heart'];
            } else {
                $array = ['btnClassAttr' => 'btn-suka-diskusi btn love text-danger', 'iconClassAttr' => 'fas fa-heart fa-beat'];
            }

            return response()->setJSON([
                'status' => 200,
                'btnClassAttr' => $array['btnClassAttr'],
                'iconClassAttr' => $array['iconClassAttr'],
                'likeStatus' => $likeStatus
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
            $id = decrypt($post['id']);

            $this->threadModel->update($id, ['status' => 'draft']);

            session()->setFlashdata('info', 'Diskusi berhasil di arsipkan.');

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
            $id = decrypt($post['id']);

            $this->threadModel->update($id, ['status' => 'published']);

            session()->setFlashdata('info', 'Diskusi berhasil di publikasikan.');

            return response()->setJSON([
                'status' => 200,
                'message' => 'Diskusi berhasil di publikasikan.'
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
                ->orderBy('(SELECT COUNT(*) FROM thread_categories WHERE category_id = categories.id)', 'desc')
                ->findAll(20);
        } else {
            $categories = $this->categoryModel
                ->orderBy('(SELECT COUNT(*) FROM thread_categories WHERE category_id = categories.id)', 'desc')
                ->like('name', $post['search'])
                ->findAll(10);
        }

        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id,
                'text' => $category->name,
                'count' => count($category->threads)
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
            $tags = $this->tagModel
                ->orderBy('(SELECT COUNT(*) FROM thread_tags WHERE tag_id = tags.id)', 'desc')
                ->findAll(20);
        } else {
            $tags = $this->tagModel
                ->orderBy('(SELECT COUNT(*) FROM thread_tags WHERE tag_id = tags.id)', 'desc')
                ->like('name', $post['search'])->findAll(10);
        }

        foreach ($tags as $tag) {
            $data[] = [
                'id' => $tag->name,
                'text' => $tag->name,
                'count' => count($tag->threads)
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
    private function rules($id = null, $hasReplyId = false)
    {
        $unique = $id ? ",id,$id" : '';

        if (!$hasReplyId) { // jika bukan edit balasan
            $ruleDiskusi = [
                'title' => [
                    'rules' => "required|min_length[3]|max_length[100]|string|thread_title|is_unique[threads.slug$unique]",
                    'errors' => [
                        'required' => 'Judul diskusi harus diisi.',
                        'min_length' => 'Judul diskusi minimal 3 karakter.',
                        'max_length' => 'Judul diskusi maksimal 100 karakter.',
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
            ];
        }

        $defaultRule = [
            'content' => [
                'rules' => "required|min_length[10]|max_length[20000]|string",
                'errors' => [
                    'required' => 'Konten diskusi harus diisi.',
                    'min_length' => 'Konten diskusi minimal 10 karakter.',
                    'max_length' => 'Konten diskusi maksimal 20000 karakter.',
                    'string' => 'Konten diskusi hanya boleh berisi huruf dan spasi.',
                ]
            ]
        ];

        return array_merge($ruleDiskusi ?? [], $defaultRule);
    }
    
    /**
     * Report the specified resource from storage.
     *
     * @return void
     */
    public function report()
    {
        if (!$this->validate([
            'message' => [
                'rules' => "required|in_list[Spamming,Kebencian,Penghinaan & Pelecehan,Kekerasan]",
                'errors' => [
                    'required' => 'Silahkan pilih masalah-nya untuk dilaporkan.',
                    'in_list' => 'Silahkan pilih masalah-nya untuk dilaporkan.'
                ]
            ]
        ])) {
            return response()->setJSON([
                'status' => 400,
                'validate' => true,
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->transBegin();
        try {
            $post = $this->request->getPost();

            $user_id = decrypt($post['pelaku_id']);
            $model_id = decrypt($post['model_id']);
            $model_class = decrypt($post['model_class']);

            $reportModel = new ReportModel();

            $reportModel->insert([
                'message' => $post['message'],
                'user_id' => $user_id,
                'model_id' => $model_id,
                'model_class' => $model_class,
            ]);

            session()->setFlashdata('info', 'Terimakasih sudah melaporkan.');

            return response()->setJSON([
                'status' => 200,
                'message' => 'Berhasil membuat laporan.'
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
