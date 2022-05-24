<?php

class Sayfa_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function mesaj() {

    }

    function resim_yukle2($yol, $alt_klasor) {
        echo $this->add_image($yol, $alt_klasor);
    }

}
