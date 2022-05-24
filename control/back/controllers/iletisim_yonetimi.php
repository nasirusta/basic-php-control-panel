<?php

class iletisim_yonetimi extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
        $this->view->js[] = 'views/genel/iletisim/js/iletisim.js';
        $this->view->css[] = 'views/genel/iletisim/css/iletisim.css';
    }

    function index() {
		$this->view->js[] = 'views/genel/iletisim/js/sort.js';
        $this->view->kayitlar = $this->liste("iletisim_bilgileri", "sort", "ASC", "page", 1000);
        $this->model->eslestirme_liste($this->view->kayitlar, function($kayitlar) {
            $this->view->data_array["grup"][] = $this->model->esles("iletisim_bilgileri_kategori", "id", $kayitlar["type"]);
            return $this->view->data_array;
        });

        $this->view->form_alanlari = $this->liste("iletisim_form_alanlari", "id", "ASC", "pagen", 1000);
        $this->view->mail_form = $this->model->esles("iletisim_mail_alanlar", "id", 1);
        $this->view->back_render_genel("iletisim/index");
    }

    function get_tur() {
        $this->model->turler();
    }

    function kaydet() {
        $this->model->kaydet();
    }

    function update() {
        $this->model->update();
    }

    function sil() {
        $this->model->sil();
    }

    function alan_ekle() {
        $this->model->alan_ekle();
    }

    function alan_update() {
        $this->model->alan_update();
    }

    function alan_sil() {
        $this->model->alan_sil();
    }

    function mail_form() {
        $this->model->mail_form();
    }

    function sirala() {
        $this->model->sirala();
    }

}
