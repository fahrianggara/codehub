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

/**
 * Checking if user has photo profile.
 * 
 * @param string $photo
 * @return bool
 */
function check_photo($pathImage, $photo)
{
    return file_exists("images/$pathImage/$photo") ? true : false;
}

/**
 * Upload image blog.
 *
 * @param  mixed $blob
 * @param  mixed $path
 * @param  mixed $oldImage
 * @return void
 */
function uploadImageBlob($blob, $path, $oldImage)
{
    $imgParts = explode(";base64,", $blob);
    $imgTypeAux = explode("image/", $imgParts[0]);
    $imgType = $imgTypeAux[1];
    $imgBase64 = base64_decode($imgParts[1]);

    if (file_exists("$path/$oldImage")) unlink("$path/$oldImage");

    $fileName = time() . '.' . $imgType;
    file_put_contents("$path/$fileName", $imgBase64);

    return $fileName;
}