<?php

class Hash {

    public static function create($algo, $data, $salt) {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return hash_final($context);
    }

    public static function create_md5($string, $tur = 1) {
        $return = NULL;
        for ($x = 0; $x < $tur; $x++) {
            $return .= md5($string . HASH_GENERAL_KEY);
        }
        return $return;
    }

}
