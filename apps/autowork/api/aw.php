<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/ExternalProjects.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/ExternalProjects.php';

$fr = new Bidding();

//$fr->feeder_home("Python", 20);

//$fr->fetchNewProjects();
//$fr->list_elites(" ", 20);

if(isset($_GET['t']=="mb")){
    $fr->multibids();
}
