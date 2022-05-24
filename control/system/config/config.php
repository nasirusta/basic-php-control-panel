<?php
date_default_timezone_set('Europe/Istanbul');

// Site URL
define('URL', 'http://xyz.com');

// Alt Klasör boş ise FALSE olmalı
define('SUB_PATH', FALSE);

// Front Libs root
define('LIBS_FRONT', 'control/system/libs/');

// Back Libs root
define('LIBS_BACK', 'system/libs/');

// Back assets root
define('back_assets', 'public/assets');

// Back images root
define('back_images', 'public/images');

// Front assets root
define('assets', 'public/assets');

// Front images root
define('images', 'public/images');

// Path
define('PATH', realpath("."));

//genel hash
define("HASH_GENERAL_KEY", "NasirUsta49");

//database passwords only
define("HASH_PASSWORD_KEY", "NasirUsta");

//Default avatar
define("default_avatar", "default-user.png");

define('DB_TYPE', 'mysql');
define('DB_HOST', '94.11.000.00');
define('DB_NAME', 'xxx');
define('DB_USER', 'xxx');
define('DB_PASS', 'xxx');

function const_class($yuz) {
    if ($yuz == FALSE) {
        define('yuz', PATH . '/control/system/libs/');
    } else {
        define('yuz', PATH . '/system/libs/');
    }
}

function loadClassName($className) {
    $classPath = yuz . $className . '.php';
    include_once($classPath);
}

function autoload($yuz = FALSE) {
    const_class($yuz);
    spl_autoload_register(function($className) {
        loadClassName($className);
    });
}
