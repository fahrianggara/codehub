<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class CustomRules
{    
    /**
     * Rules for thread title.
     *
     * @param  mixed $str
     * @param  mixed $error
     * @return bool
     */
    public function thread_title(string $str, ?string &$error = null): bool 
    {
        if (preg_match('/^[a-zA-Z0-9 ?!.,]+$/', $str)) {
            return true;
        }

        $error = "Judul diskusi tidak valid.";

        return false;
    }

    /**
     * Password with minimum 8 characters, at least one uppercase letter, one lowercase letter, one number and one special character.
     * 
     * @param  mixed $str
     * @param  mixed $error
     */
    public function password(string $str, ?string &$error = null): bool
    {
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/', $str)) {
            return true;
        }

        $error = "Password setidaknya satu huruf besar, satu huruf kecil, satu angka dan satu karakter khusus.";

        return false;
    }
}
