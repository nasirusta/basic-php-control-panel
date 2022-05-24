<?php

class index extends Controller {

    function __construct() {
        parent::__construct();
        $this->LoadModel("index", "front");
        $this->dil = $this->get_lang();
        $this->view->lang_w($this->dil);
        $this->view->sosyal_medya = $this->genel_liste("sosyal_medya", "sira", "ASC");
        $this->langs_list();
    }

    function index() {
        $veriler["site_info"] = $this->model->site_info();
        $veriler["home"] = $this->genel_liste("content", "id", "ASC", "WHERE kategori = 220" . $this->langfnc("lang"));
		$veriler["about_us"] = $this->genel_liste("content", "id", "ASC", "WHERE kategori = 214" . $this->langfnc("lang"));
        $veriler["haberler"] = $this->genel_liste("content", "id", "ASC LIMIT 3", "WHERE kategori = 216" . $this->langfnc("lang"));
        $this->meta($veriler["site_info"]["title"], $veriler["site_info"]["meta_desc"], $veriler["site_info"]["meta_title"]);
        $this->view->front_render_genel("anasayfa/index", 0, $veriler);
    }

}
