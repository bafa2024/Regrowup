<?php
//session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/Autowork.php';


$at = new Autowork();

//wget -O /dev/null https://wheeleder.com/api/autowork.php?task=makeautobids

$at->get_projects_data();