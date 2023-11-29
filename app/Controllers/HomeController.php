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

        $threads = $this->threadModel->orderBy('created_at', 'DESC')->findAll();

        return view('frontend/home', [
            'title' => 'Beranda',
            'categories' => $categories,
            'threads' => $threads,
        ]);

        $categories = $this->categoryModel
            ->select('threads.id as thread_id, COUNT(*) as discussion_count, categories.*')
            ->join('thread_categories', 'thread_categories.category_id = categories.id')
            ->join('threads', 'threads.id = thread_categories.thread_id')
            ->groupBy('threads.id, categories.id') // Sesuaikan dengan kolom yang dikelompokkan
            ->orderBy('discussion_count', 'desc') // Menggunakan alias pada fungsi agregat
            ->findAll(3);

        return view('frontend/home', [
            'title' => "Beranda",
            'categories' => $categories

        ]);
    }
}
