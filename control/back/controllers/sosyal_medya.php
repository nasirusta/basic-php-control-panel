<?php

class sosyal_medya extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
    }

    function index() {
        $this->view->sosyal_medya = $this->liste("sosyal_medya", "sira", "ASC", "page", 30);
        $this->view->back_render_genel("sosyal_medya/index");
    }

    function ekle() {
        $this->view->back_render_genel("sosyal_medya/ekle");
    }

    function insert() {
        $this->model->ekle();
        go(url_b("sosyal-medya"));
    }

    function update($id) {
        $this->view->sosyal_medya = $this->model->esles("sosyal_medya", "id", $id);
        $this->view->back_render_genel("sosyal_medya/duzenle");
    }

    function updatesave($id) {
        $this->model->update_save($id);
        go(url_b("sosyal-medya"));
    }

    function delete($id) {
        $this->model->delete($id);
    }

}
