<?php

use App\Models\UserModel;
use Carbon\Carbon;

define("ENCRYPTION_KEY", 'q$v#%&/()=?QWERTY<>1234567890#!$^#^%#');

/**
 * encrypt
 *
 * @param  mixed $string
 * @return void
 */
function encrypt($string)
{
    return base64_encode(openssl_encrypt($string, 'AES-256-CBC', ENCRYPTION_KEY, 0, str_pad(substr(ENCRYPTION_KEY, 0, 16), 16, '0', STR_PAD_LEFT)));
}

/**
 * decrypt
 *
 * @param  mixed $encryptText
 * @return void
 */
function decrypt($encryptText)
{
    return openssl_decrypt(base64_decode($encryptText), 'AES-256-CBC', ENCRYPTION_KEY, 0, str_pad(substr(ENCRYPTION_KEY, 0, 16), 16, '0', STR_PAD_LEFT));
}

/**
 * Get user session data.
 * 
 * @return object
 */
function auth()
{
    $user = null;

    if (session()->get('logged_in') === true) {
        $userModel = new UserModel();
        $user = $userModel->where('id', session()->get('id'))->first();
    }

    if (!$user) {
        session()->destroy();
        header('Location: ' . base_url('login'));
        die;
    }

    return $user;
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
 * Selected option for form select.
 *
 * @param  mixed $oldval
 * @param  mixed $value
 * @return void
 */
function selected_option($oldval, $value)
{
    if ($oldval == $value) {
        return 'selected';
    }
}

/**
 * Upload image blob.
 *
 * @param  mixed $blob
 * @param  mixed $path
 * @param  mixed $oldImage
 * @return void
 */
function uploadImageBlob($blob, $path, $oldImage = null)
{
    $imgParts = explode(";base64,", $blob);
    $imgTypeAux = explode("image/", $imgParts[0]);
    $imgType = $imgTypeAux[1];
    $imgBase64 = base64_decode($imgParts[1]);

    if ($oldImage && file_exists("$path/$oldImage")) unlink("$path/$oldImage");

    $fileName = randomName() . '.' . $imgType;
    file_put_contents("$path/$fileName", $imgBase64);

    return $fileName;
}

/**
 * Delete image
 * 
 * @param string $path
 * @param string $filename
 * @return void
 */
function deleteImage($path, $filename)
{
    $pathUrl = "$path/$filename";
    if (file_exists($pathUrl)) unlink($pathUrl);
}

/**
 * Waktu format.
 *
 * @param string $time
 * @return string
 */
function waktu($time, $format = 'l, d F Y - H:i', $wib = true)
{
    $wib = $wib ? ' WIB' : '';
    return Carbon::parse($time)->locale('id')->translatedFormat($format) . $wib;
}

/**
 * Ago
 * 
 * @param string $time
 * @return string
 */
function ago($time)
{
    return Carbon::parse($time)->locale('id')->diffForHumans();
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

/**
 * Slug generator.
 * 
 * @param string $string
 * @return string
 */
function slug($string)
{
    $slug = strtolower($string);
    $slug = preg_replace('/\s+/', '-', $slug);
    $slug = preg_replace('/[^\w-]+/', '', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');

    return $slug;
}

/**
 * Text limit.
 * 
 * @param string $text
 * @param int $limit
 * @return string
 */
function text_limit($text, $limit = 230)
{
    if (strlen($text) > $limit) {
        $text = substr($text, 0, $limit);
    }

    return strip_tags($text);
}

/**
 * Get class name
 * 
 * @param object $object
 * @return string
 */
function getClass($object, $prefix = true)
{
    $prefix = $prefix ? 'Model' : '';
    return str_replace('Entities', 'Models', get_class($object)) . $prefix;
}

/**
 * Check if author of entity.
 * 
 * @param object $entity
 * @return bool
 */
function isAuthor($thread, $user)
{
    return $thread->user_id === $user->id;
}

/**
 * Check if you are admin.
 * 
 * @return bool
 */
function isAdmin()
{
    return auth_check() && auth()->role === 'admin';
}

/**
 * Check if you in thread detail page.
 * 
 * @param object $entity
 * @return bool
 */
function isYou($entity)
{
    return auth_check() && auth()->id === $entity->user_id;
}

/**
 * print
 * 
 * @param mixed $data
 * @return string
 */
function print_data($data)
{
    // alert
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    die;
}

/**
 * HTML button like
 * 
 * @param object $entity
 */
function buttonLike($entity)
{
    $textDanger = $entity->like ? 'text-danger' : '';
    $dataId = base64_encode($entity->id);
    $dataClass = base64_encode(getClass($entity));
    $countLikes = count($entity->likes);
    $icon = $entity->like ? 's fa-beat' : 'r';
    $logined = auth_check() ? true : false;

    return "
        <button class='btn-suka-diskusi btn love $textDanger'
            data-id='$dataId' data-class='$dataClass' data-logined='$logined'>
            <i class='fa$icon fa-heart'></i>
            <small>$countLikes</small>
        </button>
    ";
}

/**
 * data is null or false ?
 * 
 * @param mixed $data
 * @return bool
 */
function isNull($data)
{
    return !$data || is_array($data);
}
