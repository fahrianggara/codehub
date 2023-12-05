<?php

use App\Models\UserModel;
use Carbon\Carbon;

define("ENCRYPTION_KEY", 'q$v#%&/()=?QWERTY<>1234567890#!$^#^%#@_)^^$#fweHR#@$GM<>?:}|{P+_)(*&^%$#@!~`');

/**
 * encrypt
 *
 * @param  mixed $string
 * @return string
 */
function encrypt($string)
{
    return base64_encode(openssl_encrypt($string, 'AES-256-CBC', ENCRYPTION_KEY, 0, str_pad(substr(ENCRYPTION_KEY, 0, 16), 16, '0', STR_PAD_LEFT)));
}

/**
 * decrypt
 *
 * @param  mixed $encryptText
 * @return string
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
    $imgBase64 = base64_decode($imgParts[1]);

    // invalid base64 format
    if ($imgBase64 === false) {
        return ['error' => 'Invalid base64 format.'];
    }

    // check image type
    $imgInfo = getimagesizefromstring($imgBase64);
    $mime = $imgInfo['mime'];

    // invalid image type
    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    if (!in_array($mime, $allowedMimes)) {
        return ['error' => 'Invalid image type.'];
    }
    
    // delete old image
    if ($oldImage && file_exists("$path/$oldImage")) {
        unlink("$path/$oldImage");
    }

    // upload image and return filename
    $imgType = explode('/', $mime)[1];
    $fileName = randomName() . '.' . $imgType;
    file_put_contents("$path/$fileName", $imgBase64);

    return ['success' => true, 'fileName' => $fileName];
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
function text_limits($text, $limit = 20)
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
    $getClass = getClass($entity);
    $model = encrypt("$entity->id-$getClass");
    $countLikes = number_short(count($entity->likes));
    $icon = $entity->like ? 's fa-beat' : 'r';
    $logined = auth_check() ? true : false;

    return "
        <button class='btn-suka-diskusi btn love $textDanger'
            data-model='$model' data-logined='$logined'>
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

/**
 * count custom example: 1000 -> 1k
 * 
 * @param int $count
 * @return string
 */
function number_short($n, $precision = 1, $lang = 'id')
{
    $n = (int) $n;
    $lg = ['K' => 'rb', 'M' => 'jt', 'B' => 'M', 'T' => 'T'];
    if ($lang == 'en') $lg = ['K' => 'K', 'M' => 'M', 'B' => 'B', 'T' => 'T'];

    if ($n < 900) {
        // 0 - 900
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        // 0.9k-850k
        $n_format = number_format($n / 1000, $precision);
        $suffix = $lg['K'];
    } else if ($n < 900000000) {
        // 0.9m-850m
        $n_format = number_format($n / 1000000, $precision);
        $suffix = $lg['M'];
    } else if ($n < 900000000000) {
        // 0.9b-850b
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = $lg['B'];
    } else {
        // 0.9t+
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = $lg['T'];
    }
    // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ($precision > 0) {
        $dotzero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dotzero, '', $n_format);
    }

    return $n_format . $suffix;
}

/**
 * purifier
 *
 * @param  mixed $string
 * @return string
 */
function purifier($string)
{
    $config = \HTMLPurifier_Config::createDefault();
    $purifier = new \HTMLPurifier($config);
    return $purifier->purify($string);
}
