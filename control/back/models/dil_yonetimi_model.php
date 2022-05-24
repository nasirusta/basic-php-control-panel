<?php

class Dil_Yonetimi_Model extends Model{

    function __construct() {
        parent::__construct();
    }

    function dil_list() {
        $x   = -1;
        $sth = $this->db->liste("langs", "id", "ASC");
        foreach ($sth as $value){
            $x++;
            $dongu[]["lang"]  = $value["lang"];
            $dongu[$x]["id"]  = $value["id"];
            $data["language"] = $value["id"];
            $control          = $this->db->control("add_language", $data);

            if ($control != 0) {
                $dongu[$x]["add_id"] = 1;
            } else {
                $dongu[$x]["add_id"] = 0;
            }
        }
        if ( isset($dongu) ) {
            return $dongu;
        }
    }

    function ekleok() {
        $data = $this->seri_ekleme();
        $this->db->insert("add_language", $data);
    }

    function sil() {
        $id = $_POST["id"];
        $this->db->delete("add_language", $id);
    }

    function sirala() {

        if (is_array($_POST["lang"])) {
            foreach ($_POST["lang"] as $key => $value) {
                $data["sira"] = $key;
                $alan = "id = " . $value;
                $this->db->update("add_language", $data, $alan);
            }
            $returnMsg = array('islemSonuc' => true, 'islemMsj' => 'İçeriklerin sırala işlemi güncellendi');
        } else {
            $returnMsg = array('islemSonuc' => false, 'islemMsj' => 'İçerik sıralama işleminde hata oluştu');
        }
        if (isset($returnMsg)) {
            echo json_encode($returnMsg);
        }
    }

}
