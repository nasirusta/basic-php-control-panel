<?php

class sayfa extends Controller {
	

	
    function __construct() {
        parent::__construct();
        $this->LoadModel("sayfa", "front");
        $this->dil = $this->get_lang();
        $this->view->lang_w($this->dil);
        $this->view->sosyal_medya = $this->genel_liste("sosyal_medya", "sira", "ASC");
        $this->langs_list();
    }

    function article($url = FALSE) {
        $veriler["site_info"] = $this->model->site_info();
        if ($url != FALSE) {
			$veriler["home"] = $this->genel_liste("content", "id", "ASC", "WHERE kategori = 220" . $this->langfnc("lang"));
            $veriler["content"] = $this->model->tek_veri("content", "WHERE kategori = 220 AND url = '".$url."'");
            $this->meta($veriler["site_info"]["title"] . " | " . $veriler["content"]["baslik"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $veriler["content"]["baslik"]);
        } else {
			go(url_f());
        }
        $this->view->front_render_genel("article/index", 0, $veriler);
    }

    function news($url = FALSE) {
        $bol = explode("-", $url);
        $id = end($bol);
        $veriler["site_info"] = $this->model->site_info();
        if ($url != FALSE) {
			$veriler["home"] = $this->genel_liste("content", "id", "ASC", "WHERE kategori = 216" . $this->langfnc("lang"));
            $veriler["content"] = $this->model->tek_veri("content", "WHERE kategori = 216 AND id = ".$id);
            $this->meta($veriler["site_info"]["title"] . " | " . $veriler["content"]["baslik"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $veriler["content"]["baslik"]);
        } else {
			go(url_f());
        }
        $this->view->front_render_genel("news/index", 0, $veriler);
    }

    function about_us($url = FALSE) {
        $veriler["site_info"] = $this->model->site_info();
        $veriler["about_us"] = $this->genel_liste("content", "id", "ASC", "WHERE kategori = 214" . $this->langfnc("lang"));
        $bol = explode("-", $url);
        $id = end($bol);
        if ($url == FALSE) {
            $veriler["content"] = $this->model->tek_veri("content", "WHERE kategori = 214" . $this->langfnc("lang") . " ORDER BY sort LIMIT 1");
            $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["about_us"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["about_us"]);
        } else {
            if ($this->dil == "tr") {
                $veriler["content"] = $this->model->tek_veri("content", "WHERE id = " . $id);
            } else {
                $veriler["content"] = $this->model->tek_veri("content", "WHERE parent_id = " . $id . $this->langfnc("lang"));
            }
            $this->meta($veriler["site_info"]["title"] . " | " . $veriler["content"]["baslik"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $veriler["content"]["baslik"]);
        }
        $this->view->front_render_genel("about_us/index", 0, $veriler);
    }

    function projects() {
        $veriler["site_info"] = $this->model->site_info();
        $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["projects"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["projects"]);
        $this->view->front_render_genel("projects/index", 0, $veriler);
    }

    function our_news() {
        $veriler["site_info"] = $this->model->site_info();
        $veriler["haberler"] = $this->genel_liste("content", "id", "ASC", "WHERE kategori = 216" . $this->langfnc("lang"));
        $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["our-news"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["our-news"]);
        $this->view->front_render_genel("our_news/index", 0, $veriler);
    }

    function login_register() {
        $veriler["site_info"] = $this->model->site_info();
        $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["login-register"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["login-register"]);
        $this->view->front_render_genel("login_register/index", 0, $veriler);
    }

    function register() {
        $veriler["site_info"] = $this->model->site_info();
        $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["register"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["register"]);
        $this->view->front_render_genel("login_register/kayit_ol", 0, $veriler);
    }

    function faq() {
        $veriler["faq"] = $this->genel_liste("content", "id", "ASC", "WHERE kategori = 218" . $this->langfnc("lang"));
        $veriler["site_info"] = $this->model->site_info();
        $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["faq"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["faq"]);
        $this->view->front_render_genel("faq/index", 0, $veriler);
    }

    function projects_guide() {
        $veriler["projects_guide"] = $this->genel_liste("content", "id", "ASC", "WHERE kategori = 227" . $this->langfnc("lang"));
        $veriler["site_info"] = $this->model->site_info();
        $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["projects_guide"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["projects_guide"]);
        $this->view->front_render_genel("projects_guide/index", 0, $veriler);
    }

    function kinnetwork() {
        $veriler["site_info"] = $this->model->site_info();
        $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["kinnetwork"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["kinnetwork"]);
        $this->view->front_render_genel("kinnetwork/index", 0, $veriler);
    }

    function contact_us() {
        $veriler["site_info"] = $this->model->site_info();
        $this->meta($veriler["site_info"]["title"] . " | " . $this->view->lang_w["contact-us"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["title"] . " | " . $this->view->lang_w["contact-us"]);
        $this->view->front_render_genel("contact_us/index", 0, $veriler);
    }

    function user_log_chack() {
		
		if($_POST["user"] == 1){
			return $this->view->firebas = 1;
		}else{
			return $this->view->firebas = 0;
		}
    }

}




































