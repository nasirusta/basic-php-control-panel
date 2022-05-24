<?php

class Model {

    protected $db, $upload, $mail_sinifi;

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $this->upload = new Uploads();
    }

    public function profil_info() {
        return $this->db->select_if("users", "id", Session::get("user_id"));
    }

    function menuler() {
        $x = -1;
        $sth = $this->db->liste("menu", "sort", "ASC");
        foreach ($sth as $key => $value) {
            $x++;
            $return[]["id"] = $value["id"];

            if ($value["type"] == "category") {
                $label_id = $this->db->select_if("kategoriler", "id", $value["label_id"]);
            } elseif ($value["type"] == "article") {
                $label_id = $this->db->select_if("yazilar", "id", $value["label_id"]);
            }
            $return[$x]["link"] = $value["url_tr"];
            $return[$x]["label"] = $label_id["baslik"];
            $return[$x]["type"] = $value["type"];
        }
        return $return;
    }

    function site_info($alan = FALSE) {
        if ($alan == FALSE) {
            return $this->db->select_if("site", "id", 1);
        } else {
            $veri = $this->db->select_if("site", "id", 1);
            return $veri[$alan];
        }
    }

    function add_image($path = FALSE, $alt_klasor = FALSE) {
        $time_al = rand(100680000, 20670100);
        if ($alt_klasor != FALSE) {
            $klasor = '/' . $alt_klasor . '/public/' . $path . '/';
        } else {
            $klasor = '/public/' . $path . '/';
        }
        $targetFolder = $klasor;
        $verifyToken = 'saymer' . @$_POST['timestamp'] . 'saymer';
        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
            $fileTypes = array('jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG');
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            $gorseladi = $time_al . '.' . $fileParts['extension'];
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $targetFile = rtrim($targetPath, '/') . '/' . $gorseladi;

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                return $gorseladi;
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }

    function resim_yukle($yol, $alt_klasor = FALSE) {
        echo $this->add_image($yol, $alt_klasor);
    }

    function delete_image($yol) {
        $resim = $_POST["id"];
        $sil = '../public/' . $yol . $resim;
        if (file_exists($sil)) {
            unlink($sil);
        }
    }

    public function query($page, $limit = 3, $table, $sort, $where = FALSE, $by = "id") {
        $page = isset($_GET[$page]) ? (int) $_GET[$page] : 1;
        $start = ($page > 1) ? ($page * $limit) - $limit : 0;

        if ($where == FALSE) {
            return $this->db->liste($table, $by, "" . $sort . " LIMIT " . $start . "," . $limit . "");
        } else {
            return $this->db->liste($table, $by, "" . $sort . " LIMIT " . $start . "," . $limit . "", "WHERE " . $where . "");
        }
    }

    public function listele($table, $by, $sort, $page, $limit, $where = FALSE) {
        return $this->query($page, $limit, $table, $sort, $where, $by);
    }

    public function total_data_get($table, $where = FALSE) {
        if ($where == FALSE) {
            return $this->db->veri_say($table);
        } else {
            return $this->db->veri_say($table, "WHERE " . $where . "");
        }
    }

    function esles($table, $by, $arr) {
        return $this->db->select_if($table, $by, $arr);
    }

    public function eslestirme_liste($param, $callfunc, $a = false, $b = false) {
        foreach ($param as $key => $value) {
            if (is_callable($callfunc)) {
                call_user_func_array($callfunc, array($value, $a, $b));
            }
        }
    }

    function tables() {
        return $this->db->list_tables();
    }

    function show_tables($param) {
        return $this->db->show_create_tables($param);
    }

    function mesaj_mail($konu, $body, $mail_adresi = FALSE) {
        $mail_alanlar = $this->esles("iletisim_mail_alanlar", "id", 1);
        require 'PHPMailer/class.phpmailer.php';
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->IsSMTP(true);
        $mail->From = $mail_alanlar["hesap"];
        $mail->Sender = $mail_alanlar["hesap"];
        $mail->AddReplyTo = ($mail_alanlar["hesap"]);
        $mail->FromName = $mail_alanlar["isim"];
        $mail->Host = $mail_alanlar["sunucu"];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $mail_alanlar["sifreleme_yontemi"];
        $mail->Port = $mail_alanlar["port"];

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->CharSet = 'UTF-8';
        $mail->Username = $mail_alanlar["hesap"];
        $mail->Password = $mail_alanlar["hesap_sifre"];
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject = $konu;
        $mail->AddAddress("nasirusta@hotmail.com.tr");
        $mail->Body = $body;
        if (!$mail->send()) {
            echo $mail->ErrorInfo;
        } else {
            return TRUE;
        }
    }

    function kolon_ekle($table, $alan, $tip = "VARCHAR(255)", $yer = "AFTER", $deger = "id") {
        $this->db->kolon_ekle($table, $alan, $tip, $yer, $deger);
    }

    function kolon_duzenle($table, $alan_1, $alan_2, $tip = "VARCHAR(255)") {
        $this->db->kolon_duzenle($table, $alan_1, $alan_2, $tip);
    }

    function kolon_sil($table, $alan) {
        $this->db->kolon_sil($table, $alan);
    }

    function tablo_icerik($data_arr, $content_arr) {
        foreach ($data_arr as $key => $value) {
            $arr[$key]["title"] = $value["title"];
        }

        foreach ($content_arr as $key2 => $value2) {
            $arr[$key2]["icerik"] = $value2;
        }
        return $arr;
    }

    function mail_tablosu($basliklar = array(), $mesaj = FALSE) {

        $th = NULL;
        foreach ($basliklar as $value) {
            $th .= "<th>" . $value["title"] . "</th>";
        }

        $td = NULL;
        foreach ($basliklar as $value2) {
            $td .= "<td align='center' valign='middle'>" . $value2["icerik"] . "</td>";
        }

        $tablo = "<table width='100%' border='1' cellpadding='1' cellspacing='1'>"
                . "<thead>"
                . "<tr>" . $th . "</tr>"
                . "</thead>"
                . "<tbody>"
                . "<tr>" . $td . "</tr>"
                . "</tbody>"
                . "</table>";
        if ($mesaj != FALSE) {
            $tablo .= "<strong>Mesaj</strong> : " . $mesaj;
        }
        return $tablo;
    }

    function dil_say() {
        return $this->db->veri_say("add_language");
    }

    function veri_say($tablo, $where = FALSE) {
        return $this->db->veri_say($tablo, $where);
    }

    function genel_liste($tablo, $order, $by, $where = FALSE) {
        return $this->db->genel_liste($tablo, $order, $by, $where);
    }

    public function tek_veri($tablo, $where = FALSE) {
        return $this->db->tek_veri($tablo, $where);
    }

    function post_serialize($post = array(), $unset = FALSE) {
        if ($unset == TRUE) {
            $unset_array = explode(",", $unset);
            foreach ($unset_array as $value) {
                unset($post[$value]);
            }
        }
        return $post;
    }

    function url_control_ekle($table, $arr, $veri_url_al) {
        $veri_url_al = permalink($veri_url_al);
        $url_say = $this->veri_say($table, "WHERE " . $arr . " = '" . $veri_url_al . "'");
        if ($url_say != 0) {
            $data[$arr] = $veri_url_al . "-" . $this->db->lastInsertId();
        } else {
            $data[$arr] = $veri_url_al;
        }
        return $data[$arr];
    }

    function url_control_edit($table, $arr, $veri_url_al, $id) {
        $veri_url_al = permalink($veri_url_al);
        $kontrol["id"] = "!=" . $id;
        $kontrol[$arr] = $veri_url_al;
        if ($this->db->control($table, $kontrol) != 0) {
            $data[$arr] = $veri_url_al . "-" . $id;
        } else {
            $data[$arr] = $veri_url_al;
        }
        return $data[$arr];
    }

    function seri_ekleme($dil = FALSE, $unset = FALSE) {
        $veriler = $this->post_serialize($_POST, $unset);
        foreach ($veriler as $key => $value) {
            $bol_arr = explode("_", $key);
            if ($dil == TRUE) {
                if (count($bol_arr) != 1) {
                    if (end($bol_arr) == $dil) {
                        array_pop($bol_arr);
                        $new_key = implode("_", $bol_arr);
                        $data[$new_key] = $_POST[$key];
                    }
                } else {
                    $data[$key] = $_POST[$key];
                }
                $data["lang"] = $dil;
            } else {
                $data[$key] = $_POST[$key];
            }
        }
        return $data;
    }

    function veri_ekleme_dil($tablo, $parent_id, $url = "url", $unset_post = FALSE, $array_post = FALSE) {
        if ($array_post != FALSE) {
            $result_array = "";
            foreach ($_POST[$array_post] as $value) {
                $result_array .= $value . ",";
            }
            $unset_arr = $array_post . "," . $unset_post;
            $data = $this->seri_ekleme("tr", $unset_arr);
        } else {
            $data = $this->seri_ekleme("tr", $unset_post);
            $unset_arr = $unset_post;
        }
        if ($array_post != FALSE) {
            $data[$array_post] = rtrim($result_array, ",");
        }
        $data[$url] = $this->url_control_ekle($tablo, $url, $data["baslik"]);
        $tarih = date('d-m-Y H:i:s',time());
        $data["createdAt"] = $tarih;
        $ekle = $this->db->insert($tablo, $data);

        if ($this->dil_say() != 0) {
            if ($ekle === TRUE) {
                $son = $this->db->tek_veri($tablo, "ORDER BY id DESC LIMIT 1");

                $last_id = $son["id"];
                
                $sth = $this->db->liste("add_language", "sira", "ASC", "WHERE id != '1'");
                foreach ($sth as $value) {
                    $aso = $this->db->select_if("langs", "id", $value["language"]);
                    $data = $this->seri_ekleme($aso["url"], $unset_arr);
                    $data[$url] = $this->url_control_ekle($tablo, $url, $data["baslik"]);
                    $data[$parent_id] = $last_id;
                    $data["createdAt"] = $tarih;
                    if ($array_post != FALSE) {
                        $data[$array_post] = rtrim($result_array, ",");
                    }
                    $this->db->insert($tablo, $data);
                }
            }
        }

        if ($ekle == TRUE) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function veri_edit_dil($tablo, $id, $parent_id, $url = "url", $unset_post = FALSE, $array_post = FALSE) {
        if ($array_post != FALSE) {
            $result_array = "";
            foreach ($_POST[$array_post] as $value) {
                $result_array .= $value . ",";
            }
            $unset_arr = $array_post . "," . $unset_post;
            $data = $this->seri_ekleme("tr", $unset_arr);
        } else {
            $data = $this->seri_ekleme("tr", $unset_post);
            $unset_arr = $unset_post;
        }
        if ($array_post != FALSE) {
            $data[$array_post] = rtrim($result_array, ",");
        }
        $data[$url] = $this->url_control_edit($tablo, $url, $data["baslik"], $id);
        $tarih = date('d-m-Y H:i:s',time());
        $data["createdAt"] = $tarih;
        $alan = "id = " . $id;
        $edit = $this->db->update($tablo, $data, $alan);

        if ($this->dil_say() != 0) {
            if ($edit === TRUE) {
                $sth = $this->db->liste("add_language", "sira", "ASC", "WHERE id != '1'");
                foreach ($sth as $value) {
                    $aso = $this->db->select_if("langs", "id", $value["language"]);
                    $ust_veri = $this->db->tek_veri($tablo, "WHERE " . $parent_id . " = " . $id . " AND lang = '" . $aso["url"] . "'");
                    $data = $this->seri_ekleme($aso["url"], $unset_arr);
                    $data[$url] = $this->url_control_edit($tablo, $url, $data["baslik"], $ust_veri["id"]);
                    $alan2 = $parent_id . " = " . $id . " AND lang = '" . $aso["url"] . "'";
                    if ($array_post != FALSE) {
                        $data[$array_post] = rtrim($result_array, ",");
                    }
                    $this->db->update($tablo, $data, $alan2);

                    $ekli_dil_veri = $this->veri_say($tablo, "WHERE " . $parent_id . " = " . $id . " AND lang = '" . $aso["url"] . "'");
                    if ($ekli_dil_veri == 0) {
                        $data = $this->seri_ekleme($aso["url"], $unset_arr);
                        $data[$url] = $this->url_control_ekle($tablo, $url, $data["baslik"]);
                        $data[$parent_id] = $id;
                        $this->db->insert($tablo, $data);
                    }
                }
            }
        }

        if ($edit == TRUE) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function veri_sil_dil($tablo, $id, $parent_id) {
        $kontrol[$parent_id] = $id;
        if ($this->db->control($tablo, $kontrol) != 0) {
            $data2[$parent_id] = "=@" . $id;
            $this->db->delete_if($tablo, $data2);
        }
        $this->db->delete($tablo, $id);
    }

    function durum($modul, $id) {
        $sth = $this->db->select_if($modul, "id", $id);

        if ($sth["durum"] == 0) {
            $data["durum"] = 1;
        } else {
            $data["durum"] = 0;
        }

        $alan = "id = " . $id;
        $this->db->update($modul, $data, $alan);
    }

    function sirala_sort($modul, $alan, $post) {
        if (is_array($_POST[$post])) {
            foreach ($_POST[$post] as $key => $value) {
                $data[$alan] = $key;
                $alan = "id = " . $value;
                $this->db->update($modul, $data, $alan);
            }
            $returnMsg = array('islemSonuc' => true, 'islemMsj' => '��eriklerin s�rala i�lemi g�ncellendi');
        } else {
            $returnMsg = array('islemSonuc' => false, 'islemMsj' => '��erik s�ralama i�leminde hata olu�tu');
        }
        if (isset($returnMsg)) {
            echo json_encode($returnMsg);
        }
    }

    function auto_increment($tablo) {
        return $this->db->auto_increment($tablo);
    }

    function resim_db_ekle($tablo, $resim, $alan, $auto_id) {
        Session::init();
        $data["resim"] = $resim;
        $data[$alan] = $auto_id;
        $data["token"] = Session::session_id();
        $this->db->insert($tablo, $data);
    }

    function resim_kapak($tablo, $resim, $alan, $id) {
        $say = $this->veri_say($tablo, "WHERE " . $alan . " = " . $id . " AND kapak = 1");
        if ($say == 0) {
            $data["kapak"] = 1;
            $alan = "resim = '" . $resim . "'";
            $this->db->update($tablo, $data, $alan);
        } else {
            $data["kapak"] = 0;
            $alan = $alan . " = " . $id;
            $this->db->update($tablo, $data, $alan);
            $data2["kapak"] = 1;
            $alan2 = "resim = '" . $resim . "'";
            $this->db->update($tablo, $data2, $alan2);
        }
    }

    function resim_sil($modul, $tablo, $resim) {
        $sil = 'public/images/uploads/' . $modul . '/' . $resim;
        if (file_exists($sil)) {
            unlink($sil);
        }
        $data["resim"] = "=@" . $resim;
        $this->db->delete_if($tablo, $data);
    }

    function resim_control_sil($modul, $tablo, $alan) {
        Session::init();
        $session_id = Session::session_id();
        $tablo = $_POST["tablo"];
        $resimler = $this->genel_liste($tablo, "id", "ASC", "WHERE token = '" . $session_id . "'");
        foreach ($resimler as $resim) {
            $veri = $this->veri_say($modul, "WHERE id = " . $resim[$alan]);
            if ($veri == 0) {
                $sil = '../public/images/uploads/' . $modul . '/' . $resim["resim"];
                if (file_exists($sil)) {
                    unlink($sil);
                }
                $this->db->delete_where($tablo, "token = '" . $session_id . "' AND " . $alan . " = " . $resim[$alan]);
            }
        }
    }

    function where_in($table, $id, $bol = FALSE) {
        return $this->db->where_in($table, $id, $bol);
    }

    function add_to_cart() {
        $data["urun"] = Post::set("urun_id");
        $data["uye"] = Post::set("uye_id");
        $data["session_id"] = Session::session_id();

        if (isset($_POST["adet"])) {
            $data["adet"] = Post::set("adet");
        } else {
            $data["adet"] = 1;
        }

        if (isset($_POST["session_id"])) {
            if ($data["session_id"] == Post::set("session_id")) {
                $say = $this->db->veri_say("sepet", "WHERE urun = " . Post::set("urun_id") . " AND uye = " . $data["uye"] . " AND session_id = '" . $data["session_id"] . "'");
                if ($say == 0) {
                    $this->db->insert("sepet", $data);
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 3;
            }
        }
    }

    function delete_cart($urun_id, $uye_id, $session_id) {
        $sil = $this->db->delete_where("sepet", "urun = " . $urun_id . " AND uye = " . $uye_id . " AND session_id = '" . $session_id . "'");
        if ($sil == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_cart() {
        $cart = $_POST["cart_id"];
        $adet = $_POST["adet"];

        foreach ($cart as $key => $cart_id) {
            $data["adet"] = $adet[$key];
            $alan = "id = " . $cart_id . " AND session_id = '" . Session::session_id() . "'";
            $this->db->update("sepet", $data, $alan);
        }
    }

    function added_list() {
        $x = -1;
        $sth = $this->db->liste("add_language", "sira", "ASC");
        foreach ($sth as $value) {
            $x++;
            $aso = $this->db->select_if("langs", "id", $value["language"]);

            $dongu[]["lang"] = $aso["lang"];
            $dongu[$x]["sira"] = $value["sira"];
            $dongu[$x]["flag"] = $aso["flag"];
            $dongu[$x]["url"] = $aso["url"];
            $dongu[$x]["code"] = $aso["code"];
            $dongu[$x]["id"] = $value["id"];
        }
        if (isset($dongu)) {
            return $dongu;
        }
    }

    function add_product_vitrin($urun) {
        $data["urun"] = $urun;
        $this->db->insert("vitrin", $data);
    }

}
