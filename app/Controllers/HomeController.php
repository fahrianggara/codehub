<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\ReplyModel;

class HomeController extends BaseController
{
    protected $reportModel, $replyModel, $categoryModel, $threadModel, $userModel;
    
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->reportModel = new ReportModel();
        $this->replyModel = new ReplyModel();
        $this->categoryModel = new \App\Models\CategoryModel();
        $this->threadModel = new \App\Models\ThreadModel();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $categories =  $this->categoryModel
            ->join('thread_categories', 'thread_categories.category_id = categories.id')
            ->join('threads', 'threads.id = thread_categories.thread_id')
            ->groupBy('categories.id')
            ->select('categories.*')
            ->where('threads.status', 'published')
            ->orderBy('COUNT(thread_categories.category_id)', 'desc')
            ->findAll(3);

        $threads = $this->threadModel->orderBy('created_at', 'DESC')->published()->paginate(10, 'thread');

        $TopThreads = $this->threadModel->published()
            ->orderBy('(SELECT COUNT(*) FROM replies WHERE thread_id = threads.id)', 'desc')
            ->orderBy('(SELECT COUNT(*) FROM likes WHERE model_id = threads.id)', 'desc')
            ->orderBy('views', 'desc')->findAll(3);

        $TopUsers = $this->userModel
            ->join('threads', 'threads.user_id = users.id')
            ->join('likes', 'likes.model_id = threads.id')
            ->where('threads.status', 'published')
            ->where('likes.model_class', 'App\Models\ThreadModel')
            ->groupBy('users.id')
            ->select('users.*, COUNT(likes.model_id) as like_count, COUNT(threads.id) as thread_count')
            ->orderBy('thread_count', 'desc')
            ->orderBy('like_count', 'desc')
            ->orderBy('users.created_at', 'asc')
            ->findAll(3);

        return view('frontend/home', [
            'title' => 'Beranda',
            'categories' => $categories,
            'threads' => $threads,
            'pager' => $this->threadModel->pager,
            'TopThreads' => $TopThreads,
            'TopUsers' => $TopUsers,
        ]);
    }
}
