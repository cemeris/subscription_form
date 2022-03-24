<?php
define('CLASS_DIR', PRIVATE_DIR . 'classes/');
include PRIVATE_DIR . 'config.php';

spl_autoload_register(function ($class) {
    $file = CLASS_DIR . str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
});

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}