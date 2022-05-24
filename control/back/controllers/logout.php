<?php

class logout extends Controller {

    function __construct() {
        parent::__construct();
        Session::destroy();
        go(URL . "/control/login");
        exit;
    }

}
