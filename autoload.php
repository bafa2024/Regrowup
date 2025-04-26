<?php
// autoload.php

spl_autoload_register(function ($class) {
    // Normalize namespace to directory separator
    $path = str_replace('\\', '/', $class);

    // Dynamically detect the project folder
    $documentRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
    $scriptName = dirname($_SERVER['SCRIPT_NAME']); // like /wheeleder or / if live root
    $projectFolder = trim($scriptName, '/');

    // Full base path
    $baseDir = $documentRoot . (!empty($projectFolder) ? '/' . $projectFolder : '') . '/';

    // Full path to the file
    $file = $baseDir . $path . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Autoloader: Cannot find class file for $class at $file");
    }
});
