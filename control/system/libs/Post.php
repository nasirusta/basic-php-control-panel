<?php

class Post {

    public static function set($name) {
        $post_verisi = $_POST[$name];
        $post_verisi = addslashes($post_verisi);
        $post_verisi = strip_tags($post_verisi);
        $post_verisi = htmlspecialchars($post_verisi, ENT_QUOTES, "UTF-8");
        return $post_verisi;
    }

}
