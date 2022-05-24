<?php

class Files {

    public static function files_delete($file) {
        if(file_exists($file)) {
           unlink($file);
        }
    }

}
