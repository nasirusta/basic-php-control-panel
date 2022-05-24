<?php

class login extends Controller{

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->back_render_genel('login/index', 1);
    }

    function run() {
        if ($this->model->run() == TRUE) {
            Session::init();
            Session::set('login', TRUE);
            Session::set('user_id', $this->model->user_id);
            go(URL."/control");
        } else {
            echo 'no';
        }
    }

}
