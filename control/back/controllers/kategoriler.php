<?php

class kategoriler extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
        $this->view->js[] = '../public/assets/plugins/nestable/jquery.nestable.js';
        $this->view->js[] = 'views/genel/kategoriler/js/nestable.js';
        $this->view->js[] = 'views/genel/kategoriler/js/kategoriler.js';
        $this->view->css[] = 'views/genel/kategoriler/css/style.css';
    }

    function index() {
        $this->view->data_list = $this->liste("kategoriler", "sort", "ASC", "page", 300, "lang = 'tr'");
        $this->view->back_render_genel("kategoriler/index");
    }

    function ekle() {
        $this->ekleme_coklu_dil("kategoriler", "tekil_resim@kategoriler");
        $this->view->back_render_genel("kategoriler/ekle");
    }

    function run() {
        $this->model->ekle();
        go(url_b("kategoriler"));
    }

    function update($id) {
        $this->edit_coklu_dil("kategoriler", $id, "ceviri", "tekil_resim@kategoriler@".$id);
        $this->view->back_render_genel("kategoriler/duzenle");
    }

    function updatesave($id) {
        $this->model->update_save($id);
        go(url_b("kategoriler"));
    }

    function delete($id) {
        $this->model->delete($id);
    }

    function sirala() {
        $this->model->sirala();
    }

    function home($id) {
        $this->model->home($id);
        go(url_b("kategoriler"));
    }

}
