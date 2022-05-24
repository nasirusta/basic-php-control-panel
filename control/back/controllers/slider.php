<?php

class slider extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
    }

    function index() {
        $this->view->js[] = 'views/genel/slider/js/sort.js';
        $this->view->slider = $this->liste("slider", "sira", "ASC", "page", 3, "lang = 'tr'");
        $this->view->back_render_genel("slider/index");
    }

    function ekle() {
		$this->view->js[] = 'views/genel/slider/js/sort.js';
        $this->ekleme_coklu_dil("slider", "tekil_resim@slider");
        $this->view->back_render_genel("slider/ekle");
    }

    function insert() {
        $this->model->ekle();
        go(url_b("slider"));
    }

    function update($id) {
        $this->edit_coklu_dil("slider", $id, "parent_id", "tekil_resim@slider");
        $this->view->back_render_genel("slider/duzenle");
    }

    function updatesave($id) {
        $this->model->update_save($id);
        go(url_b("slider"));
    }

    function delete($id) {
        $this->model->delete($id);
    }

    function durum($id) {
        $this->model->durum("slider", $id);
        go(url_b("slider"));
    }

    function sirala() {
        $this->model->sirala();
    }

}
