<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\ReplyModel;

class HomeController extends BaseController
{

    protected $reportModel;
    protected $replyModel;
    protected $categoryModel, $threadModel, $userModel;



    public function __construct()
    {
        $this->reportModel = new ReportModel();
        $this->replyModel = new ReplyModel();
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

    public function reportDiskusi()
    {
        $reportModel = new ReportModel();
        $reports = $reportModel->getReports();

        $data = [
            'message' => $this->request->getPost('message'),
            'user_id' => $this->request->getPost('user_id'),
            'model_id' => $this->request->getPost('model_id'),
            'model_class' => $this->request->getPost('model_class'),
        ];

        $reportModel->saveReport($data);

        // Tambahkan logika untuk menampilkan pesan sukses atau gagal
    }
}
