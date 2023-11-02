<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view('frontend/home', [
            'title' => 'Beranda'
        ]);
    }
}
