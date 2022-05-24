<?php

class dil_yonetimi extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
        $this->view->js[] = 'views/genel/dil_yonetimi/js/langs.js';
    }

    function index() {
        $this->view->added_list = $this->model->added_list();
        $this->view->back_render_genel("dil_yonetimi/index");
    }

    function ekle() {
        $this->view->lang_list = $this->model->dil_list();
        $this->view->back_render_genel("dil_yonetimi/ekle");
    }

    function ekleok() {
        $this->model->ekleok();
		go(url_b("dil-yonetimi"));
    }

    function sil() {
        $this->model->sil();
    }

    function sirala() {
        $this->model->sirala();
    }

}
