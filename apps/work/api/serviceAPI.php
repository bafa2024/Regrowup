<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/ServicesController.php';

$service=new ServicesController();

$service->authCheck();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");


if(isset($_POST['post_service'])){


    
    if($service->store()){
        
        $service->alert_redirect("Service Posted Successfully","/apps/work/ui/views/browse/browse_services.php");

    }else{
        
        $service->alert_redirect("Error Posting Service","/apps/work/ui/views/post/post_services.php");
    }
}


