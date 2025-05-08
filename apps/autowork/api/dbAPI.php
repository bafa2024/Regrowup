<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/autowork/controllers/DbController.php';

$db = new Db();

// Insert Note
if($_GET['key']=="createdb") {


    //$db->projects();
    //$db->new_projects();
    $db->bidding_projects();
    //$db->external_projects_bidden();
    //$db->auto_bid();
    
    //$db->create_cities_table();
    //$db->external_elite_projects();
    
    

}



?>
