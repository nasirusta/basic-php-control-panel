<?php

class Users_Model extends Model{

    function __construct() {
        parent::__construct();
    }

    public function user_cat_list() {
        return $this->db->liste("user_category", "id", "ASC");
    }

    public function users_list() {
        return $this->db->liste("users", "id", "ASC");
    }

    public function cat() {
        foreach ($this->users_list() as $key => $value) {
            $this->cat[] = $this->db->select_if("user_category", "id", $value["role"]);
        }
        return $this->cat;
    }

    public function last_login() {
        foreach ($this->users_list() as $key => $value) {
            $this->last_loginv[] = $this->db->select_if("login_date", "uye", $value["id"]);
        }
        return $this->last_loginv;
    }

    public function adduser() {

        if (!empty($_FILES["avatar"]["name"])) {
            $data["avatar"] = $this->upload->resim_yukle($_FILES["avatar"], "back");
        } else {
            $data["avatar"] = "default-user.png";
        }

        $data["login"]    = $_POST["mail"];
        $data["password"] = Hash::create("sha256", $_POST["sifre"], HASH_PASSWORD_KEY);
        $data["role"] 	  = $_POST["yetki"];

        $this->db->insert("users", $data);
    }

    function update($id) {
        return $this->db->select_if("users", "id", $id);
    }

    function update_save($id) {

        if (!empty($_FILES["avatar"]["name"])) {
            $data["avatar"] = $this->upload->resim_yukle($_FILES["avatar"], "back");
        }

        if (!empty($_POST["sifre"])) {
            $data["password"] = Hash::create("sha256", $_POST["sifre"], HASH_PASSWORD_KEY);
        }

        $data["login"] = $_POST["mail"];
        $data["role"]  = $_POST["yetki"];
        $alan          = "id = " . $id;

        $this->db->update("users", $data, $alan);
    }

    function delete($id) {
        $this->db->delete("users", $id);
    }

    public function usercount() {
        return $this->veri_say("users", "WHERE role = 3");
    }

}
