<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/apps/work/controllers/FeedController.php';
$feed=new FeedController();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");


if($_GET['act']=="create"){
    
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

        $name=$decode["name"];
        $age=$decode["age"];
        $country=$decode["country"];
        $student->add_student($name,$age,$country);
}


if($_GET['act']=="count"){
    $student->count_students();
}

if($_GET['act']=="list"){
    $feed->view_feeds();
}

if($_GET['act']=="delete"){
    $id=$_GET['id'];
    $student->delete_student($id);
}

if($_GET['act']=="search"){
    $query=$_GET['ajax'];
    $student->search_student($query);
}

if($_GET['act']=="view"){
    $query=$_GET['std'];
    $student->view_student($query);
}

if($_GET['act']=="edit"){
    $id=$_GET['id'];
   $student->edit_student($id);

}

if($_GET['act']=="update"){

    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);
    
        $id=$decode['id'];
        $name=$decode['name'];
        $age=$decode['age'];
        $country=$decode['country'];
        $student->update_student($id,$name,$age,$country);
    
}



