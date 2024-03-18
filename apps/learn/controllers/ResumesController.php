<?php
include 'Controller.php';


class ResumesController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    
    
    public function store(){

        $user_id=$_SESSION['user_id'];
        
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $dob=$_POST['dob'];
        $address=$_POST['address'];
        $description=$_POST['description'];
        $skill=$_POST['skill'];
        $qualification=$_POST['qualification'];
        $experience=$_POST['work_exp'];
        $dest=$_FILES["pic"]["name"];
        $file=move_uploaded_file($_FILES["pic"]["tmp_name"],$dest);
        $status=$_POST['status'];

    
        $sql="INSERT INTO resumes(user_id,photo,first_name,last_name,dob,address,bio,skills,qualifications,experience,status) 
        VALUES('$user_id','$file','$firstname','$lastname','$dob','$address','$description','$skill','$qualification','$experience','$status')";

        $results=$this->run_query($sql);
        if($results){
            return true;
        }else{
            return false;
        }
        
    }


    
}


