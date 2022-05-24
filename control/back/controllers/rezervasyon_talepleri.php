<?php

class rezervasyon_talepleri extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
    }

    function index() {
        $this->view->rezervasyon_talepleri = $this->liste("rezervasyon", "id", "ASC", "page", 50);
        $this->view->back_render_genel("rezervasyon_talepleri/index");
    }

    function oku($id) {
        $this->model->okundu($id);
        $this->view->rezervasyon_oku = $this->model->esles("rezervasyon", "id", $id);
        $this->view->back_render_genel("rezervasyon_talepleri/oku");
    }

    function delete($id) {
        $this->model->delete($id);
		go(url_b("rezervasyon-talepleri"));
    }

}
