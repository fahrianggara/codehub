<?php

namespace App\Controllers\Backend;

use App\Models\TagModel;
use App\Models\ReplyModel;
use App\Models\ThreadModel;
use App\Models\CategoryModel;
use App\Controllers\BaseController;

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

    public function index()
    {
        $threads = $this->threadModel->orderBy('created_at', 'DESC')->findAll();

        return view('backend/diskusi/index', [
            'title' => 'Diskusi',
            'menu' => 'diskusi',
            'threads' => $threads,
        ]);
    }

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
}
