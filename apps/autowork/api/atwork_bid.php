<?php
//session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/Autowork.php';

$at = new Autowork();

//wget -O /dev/null https://regrowup.site/aw

//wget -O /dev/null https://regrowup.site/aw_bid

$at->bid_on_projects();