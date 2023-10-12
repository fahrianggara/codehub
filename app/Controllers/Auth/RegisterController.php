<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class RegisterController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in'))
            return redirect()->to("{session()->get('role_name')}/dash");
            
        return view('auth/register', [
            'title' => 'Register'
        ]);
    }
}
