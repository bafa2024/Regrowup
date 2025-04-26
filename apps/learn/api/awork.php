<?php
//session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/AWork.php';

// Main execution
$awork = new AWork();
$awork->autoBidding();


