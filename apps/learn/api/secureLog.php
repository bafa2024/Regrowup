<?php

session_start();
$path=$_SERVER['DOCUMENT_ROOT'];

include $path.'/apps/work/controllers/LogsController.php';
$log=new LogsController();

if(isset($_POST['sw'])){

    $sw=$_POST['rl'];
    $ud=$_POST['ud'];
    $log->update_role($ud,$sw);
    if
    //session_unset();
    //session_destroy();
    //$res=$log->secure_login($ud);
    $res='';
    $pass=$res->fetch_assoc();
    if ($pass) {
        
        $_SESSION["user"] = $pass['username'];
        $_SESSION["vaild"]=$pass['id'];
        $_SESSION["name"] = $pass['name'];
        
        $_SESSION["password"]=$pass['password'];
        $_SESSION["pwd"]=$pass['password'];
        $_SESSION["userid"]=$pass['id'];
        $_SESSION["id"]=$pass['id'];
        $_SESSION['user_type']=$pass['user_type'];
        $_SESSION["email"] = $pass['email'];
        $_SESSION["country"] = $pass['country'];
        $_SESSION["profile_image"] = $pass['profile_image'];
        $_SESSION["phone"] = $pass['phone'];
        $_SESSION["business_type"] = $pass['business_type'];
        $_SESSION["log"] =   1;
        $_SESSION["name"] = $pass['name'];
        $_SESSION["role"] = $pass['role'];
        $role=$pass['role'];
        header("Location: /apps/work/ui/views/home/home.php");
    }    
}




if(isset($_POST['first_name']) && isset($_POST['password'])){

    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
    $country=$_POST['country'];
    $password=$_POST['password'];
    $signup=$log->store($first_name,$last_name,$email,$country,$password);
    
    if($signup){
        echo "OK";
    }
    
}

if(isset($_POST['username']) && isset($_POST['password'])){

    $username=$_POST['username'];
    $username=strtolower($username);
    $password=$_POST['password'];
    $password=strtolower($password);
    $result=$log->login($username,$password);
    $pass=$result->fetch_assoc();
    if ($pass) {
        
        $_SESSION["user"] = $pass['username'];
        $_SESSION["vaild"]=$pass['id'];
        $_SESSION["name"] = $pass['name'];
        
        /*
        $_SESSION["password"] = $pass['password'];
       
        $_SESSION["id"] = $pass['id'];
        $_SESSION["vaild"]=$pass['id'];
        */
       // return json_encode($pass);
       //return json_encode($pass['id']);
       //$res=$pass['name'];
    }
    /*
    else{
        $res="NO";
    }
    */
      //json_encode($pass);
      //$username=$_SESSION["user"];
     
      echo $pass ? "YES" : "NO";
    
}

if(isset($_POST['email'])){

    $username=$_POST['username'];
    $password=$_POST['password'];
    $result=$log->login($username,$password);
    $pass=$result->fetch_assoc();
    if ($pass) {
        
        $_SESSION["user"] = $pass['username'];
        $_SESSION["vaild"]=$pass['id'];
        $_SESSION["name"] = $pass['name'];
        
    }
   
      echo $pass ? "YES" : "NO";
    
}


if($_GET['act']=="logout"){
    
    session_unset();
    
    session_destroy();

    echo "NO";

}

if(isset($_POST['check'])){
    
    
$auth=$_SESSION['vaild'];
if(($auth==null)){
    echo 'NO';
}else{
    echo 'YES';
}
    
}
if(isset($_POST['mode'])){
    
    
    $auth="Dark";
    if(($auth==Dark)){
        echo 'YES';
    }else{
        echo 'NO';
    }
        
}


?>