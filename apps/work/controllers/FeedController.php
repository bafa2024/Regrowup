<?php
include 'Controller.php';


class FeedController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add_student($name,$age,$country){
        $sql="INSERT INTO students(std_name,std_age,std_country) VALUES('{$name}','{$age}','{$country}')";
        $run_sql=$this->run_query($sql);
        if($run_sql){
            echo json_encode(["success"=>true,"message"=>"Student Added Succcessfully"]);
        }else{
            echo json_encode(["success"=>false,"message"=>"Server Problem"]);
        }
    }

    public function search_student($query){
        $stmt = $this->run_query->prepare("SELECT * FROM `students` WHERE `st_name` LIKE ? OR `st_country` LIKE ?");
        $stmt->execute(["%".$query."%", "%".$query."%"]);
        $results = $stmt->fetchAll();
        if (isset($_POST["ajax"])) { 
            echo json_encode($results); 
        }
    }

    public function view_students(){

        $sql="SELECT * FROM students ORDER BY id DESC";
        $results = $this->run_query($sql);
        $output = [];
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $output[] = $row;
            }
        } else {
            $output["empty"] = "empty";
        }
        echo json_encode($output);

    }
    public function view_feeds(){

        $sql="SELECT * FROM contracts ORDER BY id DESC";
        $results = $this->run_query($sql);
        $output = [];
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $output[] = $row;
            }
        } else {
            $output["empty"] = "empty";
        }
        echo json_encode($output);

    }
    public function view_student($name){

        $sql="SELECT * FROM students WHERE std_name LIKE '%$name%' ORDER BY id DESC";
        $results = $this->run_query($sql);
        $output = [];
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $output[] = $row;
            }
        } else {
            $output["empty"] = "empty";
        }
        echo json_encode($output);

    }

    public function count_students(){
        $sql="SELECT * FROM students";
        $run_sql=$this->run_query($sql);
        $result=$run_sql->num_rows;
        echo json_encode($result);
    }

    public function delete_student($id){
        
        $sql="DELETE  FROM students WHERE id='{$id}'";
        $run_sql=$this->run_query($sql);
        if($run_sql){
            echo json_encode(["success"=>true,"message"=>"Student Delete Succcessfully"]);
        }else{
            echo json_encode(["success"=>false,"message"=>"Server Problem"]);
        }
    }

    public function edit_student($id){

        $sql="SELECT * FROM students WHERE id='{$id}'";
        $run_sql=$this->run_query($sql);
        $output=[];
        if($run_sql->num_rows > 0){
            while($row=$run_sql->fetch_assoc()){
                $output[]=$row;
            }
        }else{
            $output["empty"]="empty";
        }
        echo json_encode($output);

    }

    public function update_student($id,$name,$age,$country){

        $sql="UPDATE students SET std_name='{$name}', std_age='{$age}', std_country='{$country}' WHERE id='{$id}'";
        $run_sql=$this->run_query($sql);
    
        if($run_sql){
            echo json_encode(["success"=>true,"message"=>"Student Update Succcessfully"]);
        }else{
            echo json_encode(["success"=>false,"message"=>"Server Problem"]);
        }

    }




}