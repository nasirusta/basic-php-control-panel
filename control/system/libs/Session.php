<?php

class Session {

    public static function init() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function session_id() {
        return session_id();
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }else{
			return NULL;
		}
    }

    public static function unset_ses($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        //unset($_SESSION);
        session_destroy();
    }

}
