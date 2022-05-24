<?php

class profil extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
		$this->view->js[] = 'views/genel/users/js/index.js';
    }

    function index() {
        $this->view->back_render_genel("profil/index");
    }

    function userupdatesave() {
        $this->model->update_save(Session::get("user_id"));
        go(URL."/control/profil");
    }

}
