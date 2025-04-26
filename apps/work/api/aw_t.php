<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/wheeleder/apps/work/controllers/ExternalProjects.php';
use Apps\Work\Controllers\Bidding;

$fr = new Bidding();

//$fr->feeder_home("Python", 20);

$fr->fetchNewProjects();