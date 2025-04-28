<?php
//session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/Autowork.php';

$at = new Autowork();

//wget -O /dev/null https://wheeleder.com/api/autowork.php?task=makeautobids

$at->get_projects_data();