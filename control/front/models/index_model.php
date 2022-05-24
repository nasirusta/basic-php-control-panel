<?php

class index_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function rezervasyon() {
        $data = $this->post_serialize($_POST, "modeller");
        Session::init();
        $data["token"] = Session::session_id();
        $modeller = NULL;
        foreach ($_POST["modeller"] as $val) {
            $modeller .= $val . ",";
        }
        $data["modeller"] = rtrim($modeller, ",!");
        $ekle = $this->db->insert("rezervasyon", $data);

        if ($ekle == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

}
