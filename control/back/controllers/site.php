<?php

class site extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
    }

    function index($id) {
		if($id != 1){
			$id = 1;
		}

		$this->edit_coklu_dil("site", $id, "parent_id", "tekil_resim@site");
        $this->view->back_render_genel("genel_ayarlar/index");
    }

    function guncelle($id) {
        $this->model->guncelle($id);
        go(url_b("site/index/1"));
    }

}
