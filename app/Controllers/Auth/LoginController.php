<?php

namespace App\Controllers\Auth;

use App\Models\UserModel;
use App\Controllers\BaseController;
use Config\Services;

class LoginController extends BaseController
{    
    /**
     * Display login page.
     *
     * @return void
     */
    public function index()
    {
        if (session()->get('logged_in'))
            return redirect()->to("{session()->get('role_name')}/dash");

        return view('auth/login', [
            'title' => 'Login',
            'validation' => Services::validation()
        ]);
    }
}
