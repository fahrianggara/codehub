<?php

namespace App\Controllers\Backend;

use App\Models\UserModel;
use App\Controllers\BaseController;

class PenggunaController extends BaseController
{    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = $this->userModel->orderBy('role', 'ASC')->orderBy('created_at', 'DESC')
            ->where('id !=', auth()->id)->findAll();

        return view('backend/pengguna/index', [
            'title' => 'Pengguna',
            'menu' => 'pengguna',
            'users' => $users
        ]);
    }
}
