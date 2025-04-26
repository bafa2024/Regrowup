<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/LogsController.php';
$log=new LogsController();




if(isset($_POST['cr'])){

    $input=file_get_contents("php://input");

    $data_arr = explode("&", $input);

        foreach ($data_arr as $d) {
            
            echo $d."<br>";
            
            
        }

}






?>