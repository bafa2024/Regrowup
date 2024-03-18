<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/Bidding.php';

$fr = new Bidding();

if ($_GET['task'] == "autobiding") {

    $fr->auto_bid_process();
    
}
