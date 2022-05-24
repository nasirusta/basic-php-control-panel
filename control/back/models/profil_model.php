<?php

class Profil_Model extends Model{

    function __construct() {
        parent::__construct();
    }

    function update_save($id) {

        if (!empty($_FILES["avatar"]["name"])) {
            $this->user = $this->db->select_if("users", "id", $id);
            Files::files_delete("public/images/uploads/".$this->user["avatar"]);
            $data["avatar"] = $this->upload->resim_yukle($_FILES["avatar"], "back");
        }

        if (!empty($_POST["sifre"])) {
            $data["password"] = Hash::create("sha256", $_POST["sifre"], HASH_PASSWORD_KEY);
        }

        $data["login"] = $_POST["mail"];
        $alan          = "id = " . $id;

        $this->db->update("users", $data, $alan);
    }

}
