<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    protected $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
    }
    public function index(): string
    {
        $categories =  $this->categoryModel->findAll();
        return view('frontend/home', [
            'title' => 'Beranda',
            'categories' => $categories,
        ]);
    }
}
