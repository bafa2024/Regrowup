<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/CoursesController.php';

$courses=new CoursesController();

$courses->authCheck();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");


if(isset($_POST['create_course'])){


    
    if($courses->store()){

        $courses->alert_redirect("Course Created Successfully","/work/ui/views/create/create_course.php");
        
        

    }else{

        
        $courses->alert_redirect("Course Creation Failed","/work/ui/views/create/create_course.php");
    }
    
}



