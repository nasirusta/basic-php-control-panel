<?php

class mesajlar extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
    }

    function index() {
        $this->view->form_alanlari = $this->liste("iletisim_form_alanlari", "id", "ASC", "pagen", 1000);
        $this->view->mesajlar = $this->liste("iletisim_mesajlar", "id", "ASC", "page", 10);
        $this->view->back_render_genel("mesajlar/index");
    }

    function oku($id) {
        $this->model->okundu($id);
        $this->view->form_alanlari = $this->liste("iletisim_form_alanlari", "id", "ASC", "pagen", 1000);
        $this->view->mesaj_oku = $this->model->esles("iletisim_mesajlar", "id", $id);
        $this->view->back_render_genel("mesajlar/oku");
    }

    function delete($id) {
        $this->model->delete($id);
    }

}
