<?php

class user_category extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
    }

    function index() {
        $this->view->categorys = $this->liste("user_category", "id", "ASC", "page", 30);
        $this->view->back_render_genel("user_category/index");
    }

    function ekle() {
        $this->view->back_render_genel("user_category/ekle");
    }

    function insert() {
        $this->model->ekle();
        go(url_b("user-category"));
    }

    function update($id) {
        $this->view->yazi_info = $this->model->esles("user_category", "id", $id);
        $this->view->back_render_genel("user_category/duzenle");
    }

    function updatesave($id) {
        $this->model->update_save($id);
        go(url_b("user-category"));
    }

    function delete($id) {
        $this->model->delete($id);
    }

}
