<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/BlogController.php';
$blog=new BlogController();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");


if(isset($_POST['save'])){
    //($blog->save() ? "Uploaded" : $blog->error);
    if($blog->save()){
        
        $blog->alert_redirect("Blog Posted Successfully","/work/ui/views/browse/browse_blogs.php");
        
    }else{
        echo $blog->error;
    }
}



/*
if($_GET['act']=="create"){
    
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);
    $user_id=$decode['user_id'];
    $title=$decode['title'];
    $content=$decode['content'];
    $blog->add_blog($user_id,$title,$content);

}


if($_GET['act']=="count"){
    
    $student->count_students();
    
}
if($_GET['act']=="list"){
    
    $student->view_students();
    
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

*/

