<?php

class User_Category_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function ekle() {
        $data = $this->seri_ekleme();
        $this->db->insert("user_category", $data);
    }

    function update_save($id) {
        $data = $this->seri_ekleme();
        $alan = "id = ".$id;
        $this->db->update("user_category", $data, $alan);
    }

    function delete($id) {
        $this->db->delete("user_category", $id);
        go(url_b("user-category"));
    }

}
