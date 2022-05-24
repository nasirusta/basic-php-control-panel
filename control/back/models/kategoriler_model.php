<?php

class kategoriler_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function ekle() {
        $add = $this->veri_ekleme_dil("kategoriler", "ceviri", "url");
        if ($add == TRUE) {
            $v = $this->db->tek_veri("kategoriler ORDER BY id DESC LIMIT 1");
            mkdir("../public/images/uploads/kategoriler/" . $v["ceviri"], 0777);
            if (!empty($v["resim"]) AND file_exists('../public/images/uploads/kategoriler/' . $v["resim"])) {
                rename('../public/images/uploads/kategoriler/' . $v["resim"], '../public/images/uploads/kategoriler/' . $v["ceviri"] . '/' . $v["resim"]);
            }
        }
    }

    function update($id) {
        return $this->db->select_if("kategoriler", "id", $id);
    }

    function update_save($id) {
        $this->veri_edit_dil("kategoriler", $id, "ceviri", "url");
    }

    function delete($id) {
        $data["parent"] = $id;
        $sth = $this->db->control("kategoriler", $data);
        if ($sth == 0) {
            $kontrol["ceviri"] = $id;
            if ($this->db->control("kategoriler", $kontrol) != 0) {
                $data2["ceviri"] = "=@" . $id;
                $this->db->delete_if("kategoriler", $data2);
            }
            klasorsil('../public/images/uploads/kategoriler/' . $id);
            $this->db->delete("kategoriler", $id);
            go(url_b("kategoriler"));
        } else {
            echo "Bu i�erik silinemez! Bu i�eri�i silmek i�in, t�m alt i�erikleri silmelisiniz.";
            return FALSE;
        }
    }

    function dongu($param, $parentID = 0) {
        $return = array();
        foreach ($param as $value) {

            $returnSubSubArray = array();
            if (isset($value["children"])) {
                $returnSubSubArray = $this->dongu($value["children"], $value["id"]);
            }

            $return[] = array("id" => $value["id"], 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

    function sirala() {
        if (isset($_POST["tmp"])) {
            $ham_json3 = $_POST["tmp"];
            $json = json_decode($ham_json3, TRUE);
            $sth = $this->dongu($json);

            $i = 0;
            foreach ($sth as $row) {
                $i++;
                $data["parent"] = $row["parentID"];
                $data["sort"] = $i;
                $alan = "id = " . $row["id"];

                $this->db->update("kategoriler", $data, $alan);
            }
        }
    }

    function home($id) {
        $sth = $this->db->select_if("kategoriler", "id", $id);

        if ($sth["home"] == 0) {
            $data["home"] = 1;
        } else {
            $data["home"] = 0;
        }

        $alan = "id = " . $id;
        $this->db->update("kategoriler", $data, $alan);
    }

}
