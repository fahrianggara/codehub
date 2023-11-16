<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

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
        ]);
    }
}
