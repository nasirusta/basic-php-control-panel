<?php

class Sosyal_Medya_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function ekle() {
        $data = $this->seri_ekleme();
        $this->db->insert("sosyal_medya", $data);
    }

    function update_save($id) {
        $data = $this->seri_ekleme();
        $alan = "id = ".$id;
        $this->db->update("sosyal_medya", $data, $alan);
    }

    function delete($id) {
        $this->db->delete("sosyal_medya", $id);
        go(url_b("sosyal-medya"));
    }

}
