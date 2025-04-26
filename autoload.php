<?php
spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $root = $_SERVER['DOCUMENT_ROOT']; // or dirname(__DIR__) if outside root
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Autoloader couldn't find: $file");
    }
});
