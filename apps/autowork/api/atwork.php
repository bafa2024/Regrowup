<?php
//session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/Autowork.php';

$at = new Autowork();

//wget -O /dev/null https://regrowup.site/aw

//$pids=$at->fetch_new_projects();

$pids=$at->get_projects_data();

//$at->fetch_new_projects();

$at->get_all_projects($pids);
