<?php

class dosya_yonetimi extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
        $this->view->js[] = 'views/genel/dosya_yonetimi/js/dosya_yonetimi.js';
        $this->view->css[] = 'views/genel/dosya_yonetimi/css/file-manager.css';
    }

    function index() {
        $this->view->back_render_genel("dosya_yonetimi/index");
    }

    function makedir() {
        $this->model->makedir();
    }

    function upload() {
        $this->model->upload();
    }

    function tasima() {
        $this->model->tasima();
    }

    function yeniden_adlandir() {
        $this->model->yeniden_adlandir();
    }

    function ziple() {
        $this->model->ziple();
    }

    function sil() {
        $this->model->sil();
    }

}
