<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/ExternalProjects.php';


$fr = new Bidding();

$fr->feeder_home("Python", 20);

//$fr->fetchNewProjects();