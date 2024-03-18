<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/personal/controllers/DbController.php';

$db = new Db();

// Insert Note
if($_GET['key']=="createdb") {

    $db->tasks();
    $db->daily_routine();
    $db->goals($table = "goals");

}



?>
