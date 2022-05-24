<?php

class Content_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function ekle($table) {
        $this->veri_ekleme_dil($table, "parent_id", "url");
    }

    function update_save($table, $id) {
        $this->veri_edit_dil($table, $id, "parent_id", "url");
    }

    function delete($table, $id) {
        $this->veri_sil_dil($table, $id, "parent_id");
    }

    function sirala($table) {
        if (is_array($_POST["sld"])) {
            foreach ($_POST["sld"] as $key => $value) {
                $alt_veri = $this->tek_veri($table, "WHERE id = " . $value);

                $data["sort"] = $key;
                $alan = "id = " . $value . " AND lang = '" . $alt_veri["lang"] . "' AND kategori = ".$alt_veri["kategori"];
                $this->db->update($table, $data, $alan);

                $data2["sort"] = $key;
                $alan2 = "parent_id = " . $value . " AND lang = '" . $alt_veri["lang"] . "' AND kategori = ".$alt_veri["kategori"];;
                $this->db->update($table, $data2, $alan2);
            }
            $returnMsg = $_POST["sld"];
        } else {
            $returnMsg = array('islemSonuc' => false, 'islemMsj' => 'İçerik sıralama işleminde hata oluştu');
        }
        if (isset($returnMsg)) {
            echo json_encode($returnMsg);
        }
    }

}
