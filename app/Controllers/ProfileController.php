<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProfileController extends BaseController
{
    protected $db, $userModel;
    
    /**
     * ProfileController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  mixed $username
     * @return void
     */
    public function index($username)
    {
        $user = $this->userModel->with(['threads'])->where('username', $username)->first();
        
        if (!$user) throw PageNotFoundException::forPageNotFound("Oops.. User dengan username $username tidak ditemukan!");
        
        return view('frontend/profile', [
            'title' => "Profile",
            'user' => $user,
        ]);
    }
}
