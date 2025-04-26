<?php
$path = realpath($_SERVER['DOCUMENT_ROOT'] . '/apps/work/controllers/ExternalProjects.php');

if ($path && file_exists($path)) {
    require_once $path;
} else {
    error_log("ExternalProjects.php not found at: $path");
    // Optionally handle the error
}



$fr = new Bidding();

$fr->feeder_home("Python", 20);