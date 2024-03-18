<?php
include 'Controller.php';


class Admin extends Controller{

 public function __construct(){
     parent::__construct();
 }


    public function view_users()
    {

        $sql = "SELECT * FROM users ORDER BY id DESC";
        $run_sql = mysqli_query($this->run_query, $sql);
        $output = [];
        if (mysqli_num_rows($run_sql) > 0) {
            while ($row = mysqli_fetch_assoc($run_sql)) {
                $output[] = $row;
            }
        } else {
            $output["empty"] = "empty";
        }
        echo json_encode($output);
        // print_r($output);
    }

        

        public function display_website_traffic(){
            $sql="SELECT * FROM website_traffic ORDER BY created_at DESC";
            $run_sql=$this->run_query($sql);
            $i=1;
            if($run_sql->num_rows>0){

                echo '<table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">IP Address</th>
                    <th scope="col">User Agent</th>
                    <th scope="col">Page URL</th>
                    <th scope="col">Country</th>
                    <th scope="col">City</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Timezone</th>
                    <th scope="col">Referrer</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                  </tr> 
                </thead>
                <tbody>';
                while($row=$run_sql->fetch_assoc()){
                    echo '<tr>
                    <th scope="row">'.$i++.'</th>
                    <td>'.$row['ip_address'].'</td>
                    <td>'.$row['user_agent'].'</td>
                    <td>'.$row['page_url'].'</td>
                    <td>'.$row['country'].'</td>
                    <td>'.$row['city'].'</td>
                    <td>'.$row['latitude'].'</td>
                    <td>'.$row['longitude'].'</td>
                    <td>'.$row['timezone'].'</td>
                    <td>'.$row['referrer'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td>'.$row['updated_at'].'</td>
                  </tr>';
                }
                
            }else{
                
            }
        }


        


        




 public function adminCheck(){
     $auth = $_SESSION['user_id'];
     $sql = "SELECT * FROM users WHERE id='$auth'";
     $results = $this->run_query($sql);
     $user = $results->fetch_assoc();
     $role = $user['user_type'];
     if ($role == 'admin') {
         return true;
     }else{
         return false;
     }
 }

    public function users($role)
    {
        $sql = "SELECT * FROM users WHERE user_type='$role'";
        $results = $this->run_query($sql);

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {

                echo '
                <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['first_name'].''.$row['last_name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['country'].'</td>
                <td>'.$row['date_created'].'</td>
                <td>'.$row['last_login'].'</td>
                <td>'.$row['last_login_ip'].'</td>
                <td>
                <a class="btn btn-primary" href="?act=suspend&uid='.$row['id'].'">Suspend</a>
                
                <a class="btn btn-danger" href="?act=delete&uid='.$row['id'].'">Delete</a>
                
                </td>
            </tr>
                     ';
            }
        } else {
            return false;
        }

    }

    public function memeberships(){

        $sql = "SELECT * FROM user_subscriptions";
        $results = $this->run_query($sql);

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {

                echo '
                <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['customer_name'].'</td>
                <td>'.$row['customer_email'].'</td>
                <td>'.$row['plan_id'].'</td>
                <td>'.$row['plan_period_start'].'</td>
                <td>'.$row['plan_period_end'].'</td>
                <td>'.$row['status'].'</td>
                <td>
                <a class="btn btn-primary" href="?act=suspend&uid='.$row['user_id'].'">Suspend</a>
                
                <a class="btn btn-danger" href="?act=delete&uid='.$row['user_id'].'">Delete</a>
                
                </td>
            </tr>
                     ';
            }
        } else {
            return false;
        }

    }

    public function user_suspend($id)
    {
        $sql = "UPDATE users SET status='suspended' WHERE id='$id'";
        $results = $this->run_query($sql);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }
    public function user_delete($id)
    {
        $sql="DELETE  FROM users WHERE id='{$id}'";
        $run_sql=$this->run_query($sql);
        if($run_sql){
            echo json_encode(["success"=>true,"message"=>"User Deleted Succcessfully"]);
        }else{
            echo json_encode(["success"=>false,"message"=>"Server Problem"]);
        }
    }


    public function add_user($full_name,$email,$phone,$country,$password,$role){
        $sql="INSERT INTO users(name,email,phone,country,password,role) 
        VALUES('{$full_name}','{$email}','{$phone}','{$country}','{$password}','{$role}')";
        $run_sql=$this->run_query($sql);
        if($run_sql){
            echo json_encode(["success"=>true,"message"=>"User Added Succcessfully"]);
        }else{
            echo json_encode(["success"=>false,"message"=>"Server Problem"]);
        }
    }

    public function all_users(){
        $sql="SELECT * FROM users";
        $run_sql=$this->run_query($sql);
        if($run_sql->num_rows>0){
            while($row=$run_sql->fetch_assoc()){
                $output[]=$row;
            }
            echo json_encode($output);
        }else{
            echo json_encode(["empty"=>"empty"]);
        }
    }


    public function count_users(){
        $sql="SELECT * FROM users";
        $run_sql=$this->run_query($sql);
        $result=$run_sql->num_rows;
        echo json_encode($result);
    }


    public function edit_user($id){

        $sql="SELECT * FROM users WHERE id='{$id}'";
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













}


