<?php

class Rezervasyon_Talepleri_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function okundu($id) {
        $data["durum"] = 1;
        $alan = "id = " . $id;
        $this->db->update("rezervasyon", $data, $alan);
    }

    function delete($id) {
        $this->db->delete("rezervasyon", $id);
    }

}
