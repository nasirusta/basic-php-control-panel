<?php

class index extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
        $this->view->css[] = 'views/genel/index/css/index.css';
        $this->view->js[] = 'views/genel/index/js/index.js';
    }

    function index() {
        $this->view->okunmadi = $this->model->veri_say("iletisim_mesajlar", "WHERE durum = 0");
        $this->view->back_render_genel("index/index");
    }

}
