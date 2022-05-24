<?php

class Bootstrap {

    private $url, $controller = NULL;

    function __construct($param) {
        Session::init();
        $this->getURL();
        $this->control($param);
        $this->call_methods();
    }

    private function getURL() {
        $url = isset($_GET["url"]) ? $_GET["url"] : NULL;
        return $this->url = explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
    }

    private function control($yuz) {
        if (empty($this->url[0])) {
            $this->url[0] = "index";
        }

        $url_0 = str_replace("-", "_", $this->url[0]);

        if ($yuz == "front") {
            $file = "control/front/controllers/" . $url_0 . ".php";
        } elseif ($yuz == "back") {
            $file = "back/controllers/" . $url_0 . ".php";
        }

        if (file_exists($file)) {
            require $file;
            $this->controller = new $url_0;
            $this->controller->LoadModel($url_0, $yuz);
        } else {
            @require "control/front/controllers/yazi.php";
            $this->controller = new yazi();
            $this->controller->LoadModel("yazi", "front");
        }
    }

    /*
      /* http://localhost/Controller/Method(Param1,Param2,Param3)
      /*
     * $url[0] = Controller
     * $url[1] = Method
     * $url[2] = Param
     * $url[3] = Param
     * $url[4] = Param
     * 
     */

    // Callings methods

    private function call_methods() {
        // if $url[1] is empty = null
        $url_1 = isset($this->url[1]) ? $this->url[1] : NULL;
        $length = count($this->url);
        $url_1 = @str_replace("-", "_", $this->url[1]);

        if ($length > 1) {
            if (!method_exists($this->controller, $url_1)) {
                echo 'Method yok';
                return FALSE;
            }
        }

        switch ($length) {
            case 5 : $this->controller->$url_1($this->url[2], $this->url[3], $this->url[4]);
                break;
            case 4 : $this->controller->$url_1($this->url[2], $this->url[3]);
                break;
            case 3 : $this->controller->$url_1($this->url[2]);
                break;
            case 2 : $this->controller->$url_1();
                break;

            default: $this->controller->index();
                break;
        }
    }

}
