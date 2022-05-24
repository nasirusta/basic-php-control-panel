<?php

class dosya_yonetimi_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function makedir() {
        $dir_name = $_POST["dir"];
        if (!empty($_POST["up_root"])) {
            $up_root = "../" . $_POST["up_root"] . "/";
        } else {
            $up_root = "../public/";
        }

        if (File_Manager::make_dir($up_root, $dir_name) == TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function upload() {
        $dosya = $_FILES["myfile"];
        if (empty($_GET["path"])) {
            $path = "../public/";
        } else {
            $path = "../" . $_GET["path"] . "/";
        }

        if (Uploads::upload_file($dosya, $path) == TRUE) {
            echo 'Dosya BaÅŸarÄ±yla YÃ¼klendi.';
        } else {
            echo 'Dosya YÃ¼kleme BaÅŸarÄ±sÄ±z!';
        }
    }

    /*
     * Kullanýmý
      $kaynak = "../css/style.css";        tek dosya kopyalama
      $kaynak = "../public/bu_deneme/nas2/";                 tüm klasörü kopyalama
      $hedef = "../public/bu_deneme/nas4/";         hedef dizini belirtiyoruz
      $this->HerseyiKopyala($kaynak, $hedef);   deðiþkenlerimizi fonksiyona gönderiyoruz
     */

    function HerseyiKopyala($kaynak, $hedef) {
        if (is_dir($kaynak)) {
            if (!file_exists($hedef)) {
                @mkdir($hedef);
            }
            $Dizin = dir($kaynak);
            while (FALSE !== ( $giris = $Dizin->read() )) {
                if ($giris == '.' || $giris == '..') {
                    continue;
                }
                $Giris = $kaynak . '/' . $giris;
                if (is_dir($Giris)) {
                    HerseyiKopyala($Giris, $hedef . '/' . $giris);
                    continue;
                }
                copy($Giris, $hedef . '/' . $giris);
            }
            $Dizin->close();
        } else {
            copy($kaynak, $hedef);
        }
    }

    function tasima() {
        $dizin = @$_POST["dizin"];
        $secilen = @$_POST["secilen"];
        $secilen_dizi = explode(',', $secilen);

        foreach ($secilen_dizi as $value) {
            $tasinacak_yer = $value . "/";
            $tasinan_yer = $dizin . "/";
            $array_1 = explode('/', $tasinacak_yer);
            $last_1 = $array_1[count($array_1) - 2];
            $hedef_ara = $tasinan_yer . $last_1 . "/";

            if ($tasinacak_yer != $tasinan_yer) {
                if (@rename($tasinacak_yer, $hedef_ara)) {
                    echo 'Dizinler Basariyla Tasindi';
                } else {
                    echo 'Bir Hata Olustu!';
                }
            }
        }
    }

    function yeniden_adlandir() {
        $rename_full = $_POST["rename_full"];
        $rename = $_POST["rename"];
        $rename_full_array = explode(',', $rename_full);
        $rename_array = explode(',', $rename);

        foreach ($rename_full_array as $key => $value) {
            $yeniad_arr = $rename_array[$key];
            $new_arr = explode('/', $value);
            array_pop($new_arr);
            $root = implode("/", $new_arr);
            $yeniad = $root . "/" . $yeniad_arr;
            rename($value, $yeniad);
        }
    }

    function FileListForZip($start) {
        $liste = glob($start);
        $array = NULL;
        foreach ($liste as $file) {
            if (is_file($file)) {
                $array .= $file . "|";
            }
            if (is_dir($file)) {
                $array .= $this->FileListForZip($file . "/*");
            }
        }
        return $array;
    }

    function ziple() {
        $get_zip = @$_POST["get_zip"];
        $get_zip_array = explode(',', $get_zip);
        $zip = new ZipArchive();

        foreach ($get_zip_array as $post_value) {
            $get_dizi = rtrim($this->FileListForZip($post_value), "|");
            $new_array = explode('|', $get_dizi);
            foreach ($new_array as $value) {
                $hedef_al = str_replace($post_value, "", $value);
                $gelen_dizin = str_replace($value, "", $post_value);
                $gelen_dizin_arr = explode('/', $gelen_dizin);
                $secilen_dizin = end($gelen_dizin_arr);
                $hedef = $secilen_dizin . $hedef_al;
                $zip->open($gelen_dizin . ".zip", ZIPARCHIVE::CREATE);
                $zip->addFile($value, $hedef);
            }
        }
        $zip->close();
    }

    function KlasorSil($dir) {
        if (substr($dir, strlen($dir) - 1, 1) != '/')
            $dir .= '/';
        if ($handle = opendir($dir)) {
            while ($obj = readdir($handle)) {
                if ($obj != '.' && $obj != '..') {
                    if (is_dir($dir . $obj)) {
                        if (!$this->KlasorSil($dir . $obj))
                            return false;
                    } elseif (is_file($dir . $obj)) {
                        if (!unlink($dir . $obj))
                            return false;
                    }
                }
            }
            closedir($handle);
            if (!@rmdir($dir))
                return false;
            return true;
        }
        return false;
    }

    function sil() {
        $get_sil_array = explode(',', $_POST["get_sil"]);
        foreach ($get_sil_array as $value) {
            $this->KlasorSil($value);
        }
    }

}
