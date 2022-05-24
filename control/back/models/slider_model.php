<?php

class Slider_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function ekle() {
        $this->veri_ekleme_dil("slider", "parent_id", "url");
    }

    function update_save($id) {
        $this->veri_edit_dil("slider", $id, "parent_id", "url");
    }

    function delete($id) {
        $this->veri_sil_dil("slider", $id, "parent_id");
        go(url_b("slider"));
    }

    function sirala() {

        if (is_array($_POST["sld"])) {
            foreach ($_POST["sld"] as $key => $value) {
                $data["sira"] = $key;
                $alan = "id = " . $value;
                $this->db->update("slider", $data, $alan);
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
