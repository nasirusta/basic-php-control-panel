<?php

class content extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
        $this->view->css[] = 'views/genel/content/css/style.css';
        $this->table = 'content';
    }

    function yazilar($cat, $modul = 'content') {
        $this->view->js[] = 'views/genel/' . $modul . '/js/sort.js';
        foreach ($this->tablo_liste() as $dil){
            $this->view->yazilar[$dil["url"]] = $this->genel_liste($this->table, "sort", "ASC", "WHERE kategori = " . $cat . " AND lang = '".$dil["url"]."'");
        }
        $this->view->modul = $modul;
        $this->view->kategori = $this->model->tek_veri("kategoriler", "WHERE id = " . $cat);
        $this->view->back_render_genel($modul . "/yazilar");
    }

    function ekle($cat, $modul = 'content') {
        $this->ekleme_coklu_dil($this->table, "tekil_resim@kategoriler@" . $cat);
        $veriler["modul"] = $modul;
        $veriler["kategori"] = $this->model->tek_veri("kategoriler", "WHERE id = " . $cat);
        if ($_POST) {
            $this->model->ekle($this->table);
            go(url_b("content/yazilar/" . $cat . "/" . $modul));
        }
        $this->view->back_render_genel($modul . "/ekle", 0, $veriler);
    }

    function update($cat, $modul = 'content', $id = FALSE) {
        $this->edit_coklu_dil($this->table, $id, "parent_id", "tekil_resim@kategoriler@" . $cat);
        $veriler["id"] = $id;
        $veriler["modul"] = $modul;
        $veriler["kategori"] = $this->model->tek_veri("kategoriler", "WHERE id = " . $cat);
        if ($_POST) {
            $this->model->update_save($this->table,$id);
            go(url_b("content/yazilar/" . $cat . "/" . $modul));
        }
        $this->view->back_render_genel($modul . "/duzenle", 0, $veriler);
    }

    function delete($id, $cat, $modul = 'content') {
        $this->model->delete($this->table,$id);
        go(url_b("content/yazilar/" . $cat . "/" . $modul));
    }

    function sirala() {
        $this->model->sirala($this->table);
    }

}
