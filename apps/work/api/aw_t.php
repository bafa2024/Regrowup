<?php
//session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/ExternalProjects.php';


$fr = new Bidding();

$fr->feeder_home("Python", 20);