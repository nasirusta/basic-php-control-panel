<?php

class iletisim_yonetimi_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function turler() {
        $dongu = $this->db->liste("iletisim_bilgileri_kategori", "id", "ASC");
        $select = '<select name="type[]" class="form-control type">';
        foreach ($dongu as $value) {
            $select .= '<option value="' . $value["id"] . '">' . $value["title"] . '</option>';
        }
        $select .= '</select>';
        echo $select;
    }

    function kaydet() {
        $data["title"] = $_POST["title"];
        $data["code"] = permalink($data["title"]);
        $data["content"] = $_POST["icerik"];
        $data["type"] = $_POST["type"];

        if ($this->db->insert("iletisim_bilgileri", $data) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function update() {
        $data["title"] = $_POST["title"];
        $data["code"] = permalink($data["title"]);
        $data["content"] = $_POST["icerik"];
        $data["type"] = $_POST["type"];
        $alan = "id = " . $_POST["rec_id"];

        if ($this->db->update("iletisim_bilgileri", $data, $alan) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function sil() {
        $rec_id = $_POST["rec_id"];
        if ($this->db->delete("iletisim_bilgileri", $rec_id) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function alan_ekle() {
        $data["title"] = $_POST["alan_title"];
        $data["code"] = permalink($data["title"]);
        if ($_POST["alan_zorunlu"] == 1) {
            $data["zorunlu"] = "Evet";
        } else {
            $data["zorunlu"] = "Hayir";
        }

        $this->kolon_ekle("iletisim_mesajlar", $data["code"]);

        if ($this->db->insert("iletisim_form_alanlari", $data) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function alan_update() {
        $data["title"] = $_POST["alan_title"];
        $data["code"] = permalink($data["title"]);
        $alan = "id = " . $_POST["rec_id"];
        if ($_POST["alan_zorunlu"] == 1) {
            $data["zorunlu"] = "Evet";
        } else {
            $data["zorunlu"] = "Hayir";
        }

        $eski_alan = $this->esles("iletisim_form_alanlari", "id", $_POST["rec_id"]);
        $this->kolon_duzenle("iletisim_mesajlar", $eski_alan["code"], $data["code"]);
        if ($this->db->update("iletisim_form_alanlari", $data, $alan) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function alan_sil() {
        $rec_id = $_POST["rec_id"];
        $eski_alan = $this->esles("iletisim_form_alanlari", "id", $_POST["rec_id"]);
        $this->kolon_sil("iletisim_mesajlar", $eski_alan["code"]);
        if ($this->db->delete("iletisim_form_alanlari", $rec_id) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function mail_form() {
        $data["isim"] = $_POST["isim"];
        $data["mail_adresi"] = $_POST["mail_adresi"];
        $data["sunucu"] = $_POST["sunucu"];
        $data["hesap"] = $_POST["hesap"];
        $data["hesap_sifre"] = $_POST["hesap_sifre"];
        $data["sifreleme_yontemi"] = $_POST["sifreleme_yontemi"];
        $data["port"] = $_POST["port"];

        if ($this->db->update("iletisim_mail_alanlar", $data, "id = 1") === TRUE) {
            go(url_b("iletisim-yonetimi"));
        } else {
            echo 'Hata!';
        }
    }

    function sirala() {

        if (is_array($_POST["sira"])) {
            foreach ($_POST["sira"] as $key => $value) {
                $data["sort"] = $key;
                $alan = "id = " . $value;
                $this->db->update("iletisim_bilgileri", $data, $alan);
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
