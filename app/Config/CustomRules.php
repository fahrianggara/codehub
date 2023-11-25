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
}
