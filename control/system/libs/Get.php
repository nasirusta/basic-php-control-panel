<?php

class Get {

    public function _Set($param) {
        return $param = htmlentities(strip_tags(htmlspecialchars(addslashes($_GET[$param]))));
    }

    public function _Get($param) {
        return $this->_Set($param);
    }

}
