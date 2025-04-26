<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/ResumesController.php';

$resume=new ResumesController();

$resume->authCheck();

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");



if(isset($_POST['create_resume'])){


    
    if($resume->store()){
        
        header("Location: /apps/work/ui/views/services/services.php");

    }else{
        echo "Error";
    }
}


