<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{

    protected $categoryModel, $threadModel, $userModel;



    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
        $this->threadModel = new \App\Models\ThreadModel();
    }

    public function index()
    {
        $categories =  $this->categoryModel->getTopCategories(3);
        $threads = $this->threadModel->orderBy('created_at', 'DESC')->published()->findAll();
        $TopThreads = $this->threadModel->published()
            ->orderBy('(SELECT COUNT(*) FROM replies WHERE thread_id = threads.id)', 'desc')
            ->orderBy('(SELECT COUNT(*) FROM likes WHERE model_id = threads.id)', 'desc')
            ->orderBy('views', 'desc')->findAll(3);

        return view('frontend/home', [
            'title' => 'Beranda',
            'categories' => $categories,
            'threads' => $threads,
            'TopThreads' => $TopThreads,
        ]);
    }
}
