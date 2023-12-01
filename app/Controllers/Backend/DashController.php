<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\TagModel;
use App\Models\UserModel;
use App\Models\ReportModel;
use App\Models\ThreadModel;

class DashController extends BaseController
{    
    /**
     * Display dashboard page.
     *
     * @return void
     */
    public function index()
    {
        return view('backend/dash', [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'kategori_count' => (new CategoryModel())->countAll(),
            'tag_count' => (new TagModel())->countAll(),
            'pengguna_count' => (new UserModel())->countAll(),
            'laporan_count' => (new ReportModel())->countAll(),
            'diskusi_count' => (new ThreadModel())->countAll(),
        ]);
    }
}
