<?php
//session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/Autowork.php';

$at = new Autowork();

//wget -O /dev/null https://regrowup.site/aw

//$at->get_projects_data();
$at->get_all_projects();
//$at->fetch_new_projects("php");

//$at->get_projects_data();