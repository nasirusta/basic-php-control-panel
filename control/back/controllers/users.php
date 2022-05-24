<?php

class users extends Controller {

    function __construct() {
        parent::__construct();
        parent::Login_Control();
        $this->view->js[] = 'views/genel/users/js/index.js';
    }

    function index() {
        $this->view->user_cat_liste = $this->model->user_cat_list();
        $this->view->users_list = $this->model->users_list();
        $this->view->cat = $this->model->cat();
        $this->view->last_loginv = $this->model->last_login();
        $this->view->admincount = $this->model->usercount();
        $this->view->back_render_genel("users/index");
    }

    function adduser() {
        $this->view->user_cat_liste = $this->model->user_cat_list();
        $this->view->back_render_genel("users/adduser");
    }

    function adduserok() {
        $this->model->adduser();
        go(URL."/control/users/adduser");
    }

    function userupdate($id) {
        $this->view->user_cat_liste = $this->model->user_cat_list();
        $this->view->user_info = $this->model->update($id);
        $this->view->back_render_genel("users/userupdate");
    }

    function userupdatesave($id) {
        $this->model->update_save($id);
        go(URL."/control/users/userupdate/".$id);
    }
    
    function delete($id) {
        $this->model->delete($id);
    }

}

