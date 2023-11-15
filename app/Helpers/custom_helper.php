<?php

use App\Models\UserModel;
use Carbon\Carbon;

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

    $fileName = randomName() . '.' . $imgType;
    file_put_contents("$path/$fileName", $imgBase64);

    return $fileName;
}

/**
 * Waktu format.
 *
 * @param string $time
 * @return string
 */
function waktu($time, $format = 'l, d F Y - H:i', $wib = true) {
    $wib = $wib ? ' WIB' : '';
    return Carbon::parse($time)->locale('id')->translatedFormat($format) . $wib;
}

/**
 * Random name string.
 * 
 * @param int $length
 * @return string
 */
function randomName($length = 15)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomName = '';

    for ($i = 0; $i < $length; $i++) {
        $randomName .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomName;
}