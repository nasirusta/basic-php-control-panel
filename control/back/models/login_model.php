<?php

class Login_Model extends Model{

    public $user_id;

    function __construct() {
        parent::__construct();
    }

    public function insert_login($param) {
        $this->user_mail = $this->db->select_if("users", "login", $param);
        $uyebul["uye"]   = $this->user_mail["id"];
        $this->db->insert("login_date", $uyebul);
        return $this->user_id = $this->user_mail["id"];
    }

    public function run() {
        $user_mail        = Post::set('mail');
        $user_password    = Hash::create_md5(Post::set('sifre'));
        $data["login"]    = $user_mail;

        if ($this->db->control("users", $data) != 0) {
            $this->insert_login($user_mail);
        }

        return $this->db->control("users", $data);
    }

}
