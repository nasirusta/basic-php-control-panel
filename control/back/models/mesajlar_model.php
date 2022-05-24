<?php

class Mesajlar_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function okundu($id) {
        $data["durum"] = 1;
        $alan = "id = " . $id;
        $this->db->update("iletisim_mesajlar", $data, $alan);
    }

    function delete($id) {
        $this->db->delete("iletisim_mesajlar", $id);
        go(url_b("mesajlar"));
    }

}
