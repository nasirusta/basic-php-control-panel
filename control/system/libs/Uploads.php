<?php

require 'Hash.php';

class Uploads {

    public static function resim_yukle($file, $hedef) {
		$file_formats = array('image/jpeg', 'image/jpg', 'image/png', 'image/x-png', 'image/gif');
        if (!empty($file)) {
            if (is_array($file)) {
                if (in_array($file["type"], $file_formats)) {

                    $filename = $file["name"];
                    $efilename = explode('.', $filename);
                    $uzanti = $efilename[count($efilename) - 1];
                    $isim = Hash::create("md5", $file["name"], HASH_PASSWORD_KEY);
                    $yeniad = "" . $isim . "." . $uzanti . "";

                    move_uploaded_file($file["tmp_name"], $hedef. $yeniad);
                    return $yeniad;
                } else {
                    die("Dosya Formatı Uygun Değil!");
                }
            } else {
                die("Dosya Yüklenemedi!");
            }
        }
    }

    public static function upload_file($file, $hedef) {
        $hedef .= $file["name"];
        if (move_uploaded_file($file["tmp_name"], $hedef)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
