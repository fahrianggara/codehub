<?php

use App\Models\UserModel;

/**
 * Get user session data.
 * 
 * @return object
 */
function auth() 
{
    if (session()->get('logged_in') === true) {
        $userModel = new UserModel();
        $user = $userModel->where('id', session()->get('id'))->first();
    }

    return $user ?? null;
}

/**
 * Auth Check
 * 
 * @return bool
 */
function auth_check()
{
    return session()->get('logged_in') === true;
}