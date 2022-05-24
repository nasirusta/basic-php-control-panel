<?php

class Controller {

    public $dil_db_alanlari = array("parent_id", "ceviri");

    function __construct() {
        $this->view = new View();

        Session::init();
        if (Session::get('dil') == NULL) {
            Session::unset_ses('dil');
            Session::set('dil', 'tr');
        }
    }

    public $total_data = NULL;

    public function LoadModel($name, $yuz) {

        if ($yuz == "front") {
            $path = 'control/front/models/' . $name . '_model.php';
        } else {
            $path = 'back/models/' . $name . '_model.php';
        }

        if (file_exists($path)) {
            require $path;
            $modelName = $name . '_Model';
            $this->model = new $modelName();
            $this->view->user_info = $this->model->profil_info();
            $this->view->dil_say = $this->model->dil_say();
        } else {
            echo '<br /> Model dosyası yok';
        }
    }

    public function Login_Control() {
        Session::init();
        if (Session::get("login") == FALSE) {
            Session::destroy();
            go(URL . "/control/login");
            Exit;
        }
    }

    public function Session_Control($session, $url) {
        Session::init();
        if (Session::get($session) == FALSE) {
            Session::destroy();
            go($url);
            Exit;
        }
    }

    function liste($tablo, $by, $sort, $page, $limit, $where = FALSE) {
        $this->view->total_data[$tablo] = $this->model->total_data_get($tablo, $where) . "-" . $limit . "-" . $page;
        return $this->model->listele($tablo, $by, $sort, $page, $limit, $where);
    }

    function genel_liste($tablo, $order, $by, $where = false) {
        return $this->model->genel_liste($tablo, $order, $by, $where);
    }

    function add_image($modul = FALSE) {
        if ($modul != FALSE) {
            $this->model->resim_yukle("images/uploads" . "/" . str_replace("@", "/", $modul), SUB_PATH);
        } else {
            $this->model->resim_yukle("images/uploads", SUB_PATH);
        }
    }

    function delete_image($modul = FALSE) {
        if ($modul != FALSE) {
            $this->model->delete_image("images/uploads/" . str_replace("@", "/", $modul) . "/");
        } else {
            $this->model->delete_image("images/uploads/");
        }
    }

    function tekil_resim($modul, $yol) {
        $this->view->ozel_css[] = 'control/public/assets/tekil_resim/add_images_popup.css';
        $bol = explode("@", $yol);
        array_shift($bol);
        $birlestir = implode('@', $bol);
        $veri["modul"] = $modul;
        $veri["yol"] = $birlestir;
        $this->view->js_function("tekil_resim", $veri);
    }

    function coklu_resim($modul, $tablo, $alan, $durum) {
        $veri["modul"] = $modul;
        $veri["tablo"] = $tablo;
        $veri["alan"] = $alan;
        $veri["durum"] = $durum;
        $this->view->js_function("coklu_resim", $veri);
    }

    function coklu_resim_control() {
        $tablo = $_POST["tablo"];
        $modul = $_POST["modul"];
        $alan = $_POST["alan"];
        $this->model->resim_control_sil($modul, $tablo, $alan);
    }

    function coklu_resim_yukle($id = FALSE) {
        $resim = $_POST["resim"];
        $modul = $_POST["modul"];
        $tablo = $_POST["tablo"];
        $alan = $_POST["alan"];

        if ($id != FALSE) {
            $autoi = $id;
        } else {
            $autoi = $this->model->auto_increment($modul);
        }

        $this->model->resim_db_ekle($tablo, $resim, $alan, $autoi);
        echo $this->view->coklu_resim($modul, $resim);
    }

    function resim_kapak($id = FALSE) {
        $tablo = $_POST["tablo"];
        $resim = $_POST["resim"];
        $alan = $_POST["alan"];
        $modul = $_POST["modul"];

        if ($id != FALSE) {
            $autoi = $id;
        } else {
            $autoi = $this->model->auto_increment($modul);
        }

        $this->model->resim_kapak($tablo, $resim, $alan, $autoi);
    }

    function resim_sil() {
        $modul = $_POST["modul"];
        $tablo = $_POST["tablo"];
        $resim = $_POST["resim"];
        $this->model->resim_sil($modul, $tablo, $resim);
    }

    function ekleme_coklu_dil($modul = FALSE, $resim = FALSE, $tablo = FALSE, $alan = FALSE, $durum = FALSE) {
        if ($resim != FALSE) {
            if ($resim == "coklu_resim") {
                $this->coklu_resim($modul, $tablo, $alan, $durum);
            } else {
                $this->tekil_resim($modul, $resim);
            }
        }

        $this->view->dil_say = $this->model->dil_say();
        $this->view->data_list = $this->liste("add_language", "sira", "ASC", "page", 300);
        $this->model->eslestirme_liste($this->view->data_list, function($langs) {
            $this->view->data_array["dil"][] = $this->model->esles("langs", "id", $langs["language"]);
            return $this->view->data_array;
        });
    }

    function edit_coklu_dil($modul, $id, $parent_id, $resim = FALSE, $tablo = FALSE, $alan = FALSE, $durum = FALSE) {
        if ($resim != FALSE) {
            if ($resim == "coklu_resim") {
                $this->coklu_resim($modul, $tablo, $alan, $durum);
                $this->view->kayitli_resimler = $this->genel_liste($tablo, "id", "ASC", "WHERE " . $alan . " = " . $id);
                $this->view->modul_resimler = $modul;
            } else {
                $this->tekil_resim($modul, $resim);
            }
        }

        $this->view->dil_say = $this->model->dil_say();
        $this->view->data_list = $this->liste("add_language", "sira", "ASC", "page", 300);
        $this->model->eslestirme_liste($this->view->data_list, function($langs, $tablo, $ust_id) {
            $ids = $_GET["url"];
            $get_id_arr = explode("/", $ids);
            $get_id = end($get_id_arr);
            $get_url = $this->model->esles("langs", "id", $langs["language"]);
            $get_trans = $this->model->tek_veri($tablo, "WHERE " . $ust_id . " =" . $get_id . " AND lang = '" . $get_url["url"] . "'");
            $this->view->data_array["dil"][] = $get_url;
            $this->view->data_array["ceviri"][] = $get_trans;
            return $this->view->data_array;
        }, $modul, $parent_id);

        $this->view->data_array["ceviri"][0] = $this->model->esles($modul, "id", $id);
    }

    function urun_list($liste_sayisi, $where, $by = "id", $order = "DESC", $dil = "tr") {
        $x = -1;
        $this->view->urunun_dili_kod = $dil;
        $this->view->urun_list = $this->liste("urunler", $by, $order, "page", $liste_sayisi, $where);
        $this->model->eslestirme_liste($this->view->urun_list, function($urun) {
            global $x;
            $this->view->urun_array["kategori"][] = $this->model->esles("urun_kategoriler", "id", $urun["kategori"]);
            if ($this->view->urunun_dili_kod != "tr") {
                $kapak_bul = $this->model->veri_say("urun_foto", "WHERE urun = " . $urun["parent_id"] . " AND kapak = 1");
                if ($kapak_bul == 1) {
                    $kapak = $this->model->tek_veri("urun_foto", "WHERE urun = " . $urun["parent_id"] . " AND kapak = 1");
                    $this->view->urun_array["kapak"][]["resim"] = $kapak["resim"];
                } else {
                    $kapak = $this->model->tek_veri("urun_foto", "WHERE urun = " . $urun["parent_id"] . " ORDER BY id ASC LIMIT 1");
                    $this->view->urun_array["kapak"][]["resim"] = $kapak["resim"];
                }
            } else {
                $kapak_bul = $this->model->veri_say("urun_foto", "WHERE urun = " . $urun["id"] . " AND kapak = 1");
                if ($kapak_bul == 1) {
                    $kapak = $this->model->tek_veri("urun_foto", "WHERE urun = " . $urun["id"] . " AND kapak = 1");
                    $this->view->urun_array["kapak"][]["resim"] = $kapak["resim"];
                } else {
                    $kapak = $this->model->tek_veri("urun_foto", "WHERE urun = " . $urun["id"] . " ORDER BY id ASC LIMIT 1");
                    $this->view->urun_array["kapak"][]["resim"] = $kapak["resim"];
                }
            }
            return $this->view->urun_array;
        });
    }

    function menu_header($tablo, $dil, $ceviri, $ust = 0) {
        $menu = $this->genel_liste("menu", "sort", "ASC", "WHERE parent = " . $ust);
        foreach ($menu as $key => $value) {
            if ($dil != "tr") {
                $alan_2 = $this->model->tek_veri($tablo, "WHERE " . $ceviri . " = " . $value["label_id"] . " AND lang = '" . $dil . "'");
                $menu_header[$key] = array(
                    "id" => $value["id"],
                    "baslik" => $alan_2["baslik"],
                    "url" => $alan_2["url"],
                    "parent" => $value["parent"],
                    "ust" => 0
                );

                $sub_count = $this->model->veri_say("menu", "WHERE parent = " . $value["id"]);
                if ($sub_count != 0) {
                    $menu_header[$key]["ust"] = $this->menu_header($tablo, $dil, $ceviri, $value["id"]);
                }
            } else {
                $alan = $this->model->tek_veri($value["type"], "WHERE id = " . $value["label_id"]);
                $menu_header[$key] = array(
                    "id" => $value["id"],
                    "baslik" => $alan["baslik"],
                    "url" => $alan["url"],
                    "parent" => $value["parent"],
                    "ust" => 0
                );

                $sub_count = $this->model->veri_say("menu", "WHERE parent = " . $value["id"]);
                if ($sub_count != 0) {
                    $menu_header[$key]["ust"] = $this->menu_header($tablo, $dil, $ceviri, $value["id"]);
                }
            }
        }
        return $menu_header;
    }

    function query_vitrin($par) {
        $index = -1;

        function query($that, $param) {
            global $index;
            $result = $that->genel_liste("kategoriler", "id", "ASC", "WHERE parent = " . $param);
            foreach ($result as $value) {
                $index++;
                $kat_say = $that->model->veri_say("kategoriler", "WHERE parent = " . $value["id"]);
                $that->topla3[$index]["baslik"] = $value["baslik"] . " - " . $kat_say;
                $that->topla3[$index]["kat_say"] = $kat_say;
                $that->topla3[$index]["id"] = $value["id"];
                $that->topla3[$index]["parent"] = $value["parent"];
                if ($value["parent"] = !0) {
                    query($that, $value["id"]);
                }
            }
            return $that->topla3;
        }

        return query($this, $par);
    }

    function urun_kapak_set($dil, $id) {
        $urun = $this->model->tek_veri("urunler", "WHERE id = " . $id);

        if ($dil != "tr") {
            $kapak_bul = $this->model->veri_say("urun_foto", "WHERE urun = " . $urun["parent_id"] . " AND kapak = 1");
            if ($kapak_bul == 1) {
                $kapak = $this->model->tek_veri("urun_foto", "WHERE urun = " . $urun["parent_id"] . " AND kapak = 1");
                $main_img = $kapak["resim"];
            } else {
                $kapak = $this->model->tek_veri("urun_foto", "WHERE urun = " . $urun["parent_id"] . " ORDER BY id ASC LIMIT 1");
                $main_img = $kapak["resim"];
            }
        } else {
            $kapak_bul = $this->model->veri_say("urun_foto", "WHERE urun = " . $urun["id"] . " AND kapak = 1");
            if ($kapak_bul == 1) {
                $kapak = $this->model->tek_veri("urun_foto", "WHERE urun = " . $urun["id"] . " AND kapak = 1");
                $main_img = $kapak["resim"];
            } else {
                $kapak = $this->model->tek_veri("urun_foto", "WHERE urun = " . $urun["id"] . " ORDER BY id ASC LIMIT 1");
                $main_img = $kapak["resim"];
            }
        }
        return $main_img;
    }

    function iletisim_info() {
        $this->view->iletisim_info = $this->liste("iletisim_bilgileri", "sort", "ASC", "page", 1000);
        $this->model->eslestirme_liste($this->view->iletisim_info, function($iletisim_info) {
            $this->view->iletisim_array["grup"][] = $this->model->esles("iletisim_bilgileri_kategori", "id", $iletisim_info["type"]);
            return $this->view->iletisim_array;
        });
    }

    function set_lang($code) {
        return Session::set('dil', $code);
    }

    function lang($get) {
        $this->set_lang($get);
        go(url_f());
    }

    function get_lang() {
        $this->lang = Session::get('dil');
        return $this->lang;
    }

    function active_lang() {
        $this->view->active_lang = $this->model->tek_veri("langs", "WHERE url = '" . $this->get_lang() . "'");
        return $this->view->active_lang;
    }

    function add_cart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["urun_id"])) {
                $this->model->add_to_cart();
            }
        } else {
            go(url_f());
        }
    }

    function add_cart_fnc($control) {
        $send["control"] = $control;
        if (Session::get('uye_id') != FALSE) {
            $send["uye"] = Session::get('uye_id');
        } else {
            $send["uye"] = 0;
        }
        $this->view->js_function("add_cart", $send, 1);
        $session_id = Session::session_id();

        $this->view->sepet_list = array();
        if ($this->model->veri_say("sepet", "WHERE session_id = '" . $session_id . "'") != 0) {
            $sepet = $this->genel_liste("sepet", "id", "ASC", "WHERE session_id = '" . $session_id . "'");
            foreach ($sepet as $x => $value) {
                $urun = $this->model->esles("urunler", "id", $value["urun"]);
                $ek["adet"] = $value["adet"];
                $ek["kapak"] = $this->urun_kapak_set("tr", $urun["id"]);
                $vergi = $this->model->esles("vergiler", "id", $urun["vergi"]);
                $this->view->sepet_list["urun"][$x] = $urun;
                array_push($this->view->sepet_list["urun"][$x], $ek);
            }
            $this->view->sepet_list["cart_count"] = $this->model->veri_say("sepet", "WHERE session_id = '" . $session_id . "'");
        } else {
            $this->view->sepet_list["cart_count"] = 0;
        }
        return $this->view->sepet_list;
    }

    function delete_cart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["urun_id"])) {
                $urun_id = Post::set("urun_id");
                $uye_id = Post::set("uye_id");
                $session_id = Session::session_id();
                if ($this->model->delete_cart($urun_id, $uye_id, $session_id) == TRUE) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                go(url_f());
            }
        }
    }

    function langs_list() {
        foreach ($this->model->added_list() as $x => $value) {
            if ($value["url"] != $this->get_lang()) {
                $this->view->lang_list[$x]["lang"] = $value["lang"];
                $this->view->lang_list[$x]["url"] = $value["url"];
                $this->view->lang_list[$x]["flag"] = $value["flag"];
            }
        }
        $this->active_lang();
    }

    function langfnc($alan) {
        return " AND " . $alan . " = '" . $this->dil . "'";
    }

    function meta($title, $description, $meta_title) {
        $this->view->title = $title;
        $this->view->meta_title = $meta_title;
        $this->view->meta_description = $description;
    }

    function tablo_liste() {
        $tablo_liste = $this->genel_liste("add_language", "sira", "ASC");
        foreach ($tablo_liste as $value) {
            $this->view->tablo_liste[] = $this->model->tek_veri("langs", "WHERE id = " . $value["language"]);
        }
        return $this->view->tablo_liste;
    }

}
