<?php

class Site_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function guncelle($id) {
		$this->veri_edit_dil("site", $id, "parent_id", "url");
    }

}
