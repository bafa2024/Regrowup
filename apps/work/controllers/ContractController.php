<?php
include 'Controller.php';


class ContractController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function post_contract($uid, $title, $duration, $availability,$type,$price,$week_hours,$skills, $description, $contract_status)
    {
        $sql = "INSERT INTO contracts(user_id,title,duration,availability,type,price,week_hours,skills,description,status) 
        VALUES ('$uid','$title','$duration','$availability','$type','$price','$week_hours','$skills','$description','$contract_status')";
        $result = $this->run_query($sql);
        //$id = $this->run_query->insert_id;
        if ($result) {
            
            return true;
        } else {
            return false;
        }
    }

    public function contracts()
    {

        $results = $this->run_query("SELECT * FROM contracts ORDER BY id DESC");
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {

                echo 
                '
                
            
               <div class="row g-0">
              <div class="col-2">
                <img src=""  style="width:200px;height:200px;" class="img-fluid  border" alt="Pic">
                </div>
            <div class="col-md-8">
             <div class="card-body">
        <h5 class="card-title">'.$row['title'].'</h5>
        <p class="card-text">' . $row['description'] . '</p>
        <p class="card-text"><small class="text-muted"><div class="row">
        

        
        <p class="card-text">Budget: '.$row['price'].' '.$row['currency'].'</p>
        <p class="card-text">Timeline: '.$row['duration'].'</p>
        
        <a href="/work/ui/views/applications/apply_contract.php?ct='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Apply Now</a>    
        </div>
         </div>
        </div>
    
    
       ';
        
            

        }
        } else {
            echo "0 results";
        }

    }

    public function project($id){
        $sql="SELECT * FROM contracts WHERE id='$id'";
        $results = $this->run_query($sql);
        $res=$results->fetch_assoc();
        return $res;
        
    }

    public function recordTraffic() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $page = $_SERVER['REQUEST_URI'];
        $timestamp = date('Y-m-d H:i:s');

        $query = "INSERT INTO website_traffic (ip, user_agent, referrer, page, timestamp)
                  VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->run_query->prepare($query);
        $stmt->bind_param("sssss", $ip, $userAgent, $referrer, $page, $timestamp);
        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }

    public function apply_contracts(){

        $uid=$_SESSION['user_id'];
        $contract_id=$_POST['contract_id'];
        $client_id=$_POST['client_id'];
        $description=$_POST['description'];
        $charges=$_POST['charges'];

        $duration=$_POST['duration'];
        $milestones=json_encode($_POST['milestones']);
        $milestones_amount=json_encode($_POST['milestone_prices']);
        $sql = "INSERT INTO contracts_applications(applicant_id,contract_id,client_id,description,charges,duration,milestones,milestone_amount)
        VALUES ('$uid','$contract_id','$client_id','$description','$charges','$duration','$milestones','$milestones_amount')";
        $result = $this->run_query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }



    }


    public function filter_contracts($search_query)
    {

        $search_query1 = $search_query[0];
        $search_query2 = $search_query[1];
        $search_query3 = $search_query[2];


        if ($search_query1 == "" && $search_query2 == "" && $search_query3 == "") {
            $sql = "SELECT * FROM contracts ORDER BY id DESC";
            $results = $this->run_query($sql);
        } elseif ($search_query1 == null && $search_query2 == null && $search_query3 == null) {
            $sql = "SELECT * FROM contracts ORDER BY id DESC";
            $results = $this->run_query($sql);
        } else if ($search_query1 != null && $search_query2 == null && $search_query3 == null) {
            $sql = "SELECT * FROM contracts WHERE  title LIKE '%$search_query1%'";
            $results = $this->run_query($sql);
        } elseif ($search_query1 == null && $search_query2 != null && $search_query3 == null) {
            $sql = "SELECT * FROM contracts WHERE  location LIKE '%$search_query2%'";
            $results = $this->run_query($sql);
        } elseif ($search_query1 == null && $search_query2 == null && $search_query3 != null) {
            $range = explode("-", $search_query3);
            $num1 = (int) $range[0];
            $num2 = (int) $range[1];
            $sql = "SELECT * FROM contracts WHERE  price BETWEEN '$num1' AND '$num2'";
            $results = $this->run_query($sql);
        }

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                echo '<div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
            <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                    <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        ' . $row['title'] . '
                    </h3>
                
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    <i class="fal fa-map-marker mytext-secondary"></i>
                    <h5 class="mytext-black fs-14">' . $row['price'] . '</h5>
                </div>
                <p class="vclip d-block mytext-black fs-14">
                ' . $row['description'] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
                    <a href="/work/ui/views/applications/apply_contract.php?ct='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Apply Now</a>
                    
                    
                    </div>
            </div>
        </div>';

            }
        } else {
            echo "0 results";
        }


    }


    public function filter_freelancers($search_query)
    {

        $search_query1 = $search_query[0];
        $search_query2 = $search_query[1];
        $search_query3 = $search_query[2];


        if ($search_query1 == "" && $search_query2 == "" && $search_query3 == "") {
            $sql = "SELECT * FROM users WHERE role='Professional' ORDER BY id DESC";
            $results = $this->run_query($sql);
        } elseif ($search_query1 == null && $search_query2 == null && $search_query3 == null) {
            $sql = "SELECT * FROM users WHERE  role='Professional'";
            $results = $this->run_query($sql);
        } else if ($search_query1 != null && $search_query2 == null && $search_query3 == null) {
            $sql = "SELECT * FROM users WHERE  role='Professional' AND title LIKE '%$search_query1%'";
            $results = $this->run_query($sql);
        } elseif ($search_query1 == null && $search_query2 != null && $search_query3 == null) {
            $sql = "SELECT * FROM users WHERE  role='Professional' AND location LIKE '%$search_query2%'";
            $results = $this->run_query($sql);
        } elseif ($search_query1 == null && $search_query2 == null && $search_query3 != null) {
            $range = explode("-", $search_query3);
            $num1 = (int) $range[0];
            $num2 = (int) $range[1];
            $sql = "SELECT * FROM users WHERE  role='Professional' AND price BETWEEN '$num1' AND '$num2'";
            $results = $this->run_query($sql);
        }

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                echo '<div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                <div class="flex-grow-1">
                    <div class="d-flex flex-column gap-1">
                        <h3 class="mtext-black text-uppercase fs-18 fw-800">
                            ' . $row['first_name'] .' '.$row['last_name']. ' 
    
                        </h3>
                    
                        <p>   
                        <img src="'.$row['profile_image'].'" alt="profile" class="rounded-circle" width="50" height="50">
                        </p>
                    </div>
                    <div class="d-flex gap-2 align-items-center my-2">
                        <i class="fal fa-map-marker mytext-secondary"></i>
                        <h5 class="mytext-black fs-14">'.$row['country'].'</h5>
                    </div>
                
                </div>
                <div class="flex-shrink-0">
                    <div class="d-flex gap-3">
                        <a href="/work/ui/views/freelancing/hire.php" class="apply-btn">Hire Now</a>
                        
                            <a href="/work/ui/views/applications/apply_contract.php"
                            class="mytext-black fs-14 border-0 bg-transparent">
                            <i class="fal fa-bookmark"></i>
                        </a>
                                                </div>
                </div>
            </div>';

            }
        } else {
            echo "0 results";
        }


    }


    public function freelancers()
    {

        $results = $this->run_query("SELECT * FROM users WHERE role='Professional' ORDER BY id DESC");
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
             
                echo 
                '
                
                
               <div class="row g-0 bordered">
              <div class="col-2">
                <img src="'.$row['profile_image'].'"  style="width:200px;height:200px;" class="img-fluid  bordered" alt="Upload Profile Pic">
                </div>
            <div class="col-md-8">
             <div class="card-body bordered">
        <h5 class="card-title">'.$row['first_name'].' '.$row['last_name'].'</h5>
        <p class="card-text">'.$row['bio'].'</p>
        <p class="card-text"><small class="text-muted"><div class="row">
        <div class="hotel_a">
         <div class="stars-outer">
           <div class="stars-inner"></div>
           </div>
         </div>

        
        <p class="card-text">'.$row['country'].'</p>
        <p class="card-text"><small class="text-muted"><a href="/work/ui/views/freelancing/hire.php?fr='.$row['id'].'" class="apply-btn">Hire Now</a></small></p>
            </div>
         </div>
        </div>
       
    
       ';
            

        }
        } else {
            echo "0 results";
        }

    }

    public function delete_contracts($uid, $cid)
    {
        
        $sql ="DELETE FROM contracts WHERE user_id='$uid' AND id='$cid'";
        $result = $this->run_query($sql);
        if($result){
            return true;
        }else{
            return false;
        }

    }

    public function open_contracts($uid)
    {
        
        $sql ="SELECT * FROM contracts WHERE user_id='$uid' AND status!='1' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
            
                echo '<div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
            <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                    <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        ' . $row['title'] . '
                    </h3>
                
                
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    <i class="fal fa-map-marker mytext-secondary"></i>
                    <h5 class="mytext-black fs-14">'.$row['price'].'</h5>
                </div>
                <p class="vclip d-block mytext-black fs-14">
                ' . $row['description'] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
                <form action="/api/contractAPI.php" method="post">
                <input type="hidden" name="contract" value="'.$row["id"].'">
                
                <input type="hidden" name="client" value="'.$row["user_id"].'">
                <select name="act" class="form-control" aria-label="Default select example">

                <option selected>Action</option>
                <option value="0">Edit</option>
                <option value="1">Delete</option>
                
                </select>
                <button class="btn btn-sm rounded" name="ct_action">Save</button>
                 </form>
                </div>
            </div>
            </div>
        </div>';

        }
        } else {
            echo "0 results";
        }

    }
    public function open_contracts_fr()
    {
        
        $sql ="SELECT * FROM contracts WHERE status!=1 ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
            
                echo '<div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
            <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                    <h3 class="mtext-black  fs-18 fw-800">
                        ' . $row['title'] . '
                    </h3>
                
                
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    <p>Budget: </p>
                    <h5 class="mytext-black fs-14">'.$row['price'].'</h5>
                </div>
                <p class="vclip d-block mytext-black fs-18">
                ' . $row['description'] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
            
                <div class="d-flex gap-3">
                <a href="/work/ui/views/applications/apply_contract.php?ct='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Apply Now</a>
                <a href="/work/ui/views/manage/view_contract.php?ct='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">View Contract</a>
                </div>
                </div>
            </div>
        </div>';

        }
        } else {
            echo "0 results";
        }

    }

    public function open_contracts_cl($uid)
    {
        
        $sql ="SELECT * FROM contracts WHERE user_id='$uid' AND status!='1' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
            
                echo '<div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
            <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                    <h3 class="mtext-black t fs-18 fw-800">
                        ' . $row['title'] . '
                    </h3>
                
                
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    <p>Budget: </p>
                    <h5 class="mytext-black fs-14">'.$row['price'].'</h5>
                </div>
                <p class="vclip d-block mytext-black fs-18">
                ' . $row['description'] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
            
                <div class="d-flex gap-3">
            
                <a href="/work/ui/views/manage/view_contract.php?ct='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Manage Contract</a>
                </div>
                </div>
            </div>
        </div>';

        }
        } else {
            echo "0 results";
        }

    }
    
    public function ongoing_contracts($uid)
{
    $sql = "SELECT * FROM contracts WHERE user_id='$uid' ORDER BY id DESC";
    $results = $this->run_query($sql);

    if ($results->num_rows > 0) {
        while ($row = $results->fetch_array()) {
            $final_status = $row['final_status'];
            $fr_status = $row['fr_status'];

            if ($final_status === null || $final_status === 0 || $fr_status === 1) {
                echo '
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    
                        <div class="row">
                            <div class="col-9">
                                <div class="row">
                                    <a href="/work/ui/views/manage/project.php?ct=' . $row['id'] . '&cl=' . $row['user_id'] . '" class="">
                                        <p class="">' . $row["title"] . '</p>
                                    </a>
                                </div>
                                <div class="row">
                                    <p class="">' . $row["description"] . '</p>
                                </div>
                            </div>
                            <div class="col-2">
                            <div class="flex-shrink-0">
                                <a href="/work/ui/views/manage/project.php?ct=' . $row['id'] . '&cl=' . $row['user_id'] . '" class="btn btn-primary">Manage</a>
                            </div>
                          <a href="/work/ui/views/chat/chat.php?dest='.$row["user_id"].'&sender='.$row["awarded_to"].'" class="btn btn-primary">Chat</a>
                          </div>
                        </div>
                    </div>
                ';
            }
        }
    } else {
        echo "0 results";
    }
}

    public function ongoing_contracts_fr($uid){
    $sql = "SELECT * FROM contracts WHERE awarded_to='$uid' AND fr_status=1 ORDER BY id DESC";
    $results = $this->run_query($sql);

    if ($results->num_rows > 0) {
        while ($row = $results->fetch_array()) {
            $final_status = $row['final_status'];
            $fr_status = $row['fr_status'];

            if ($final_status === null || $final_status === 0 || $fr_status === 1) {
                echo '
                    <div class="d-flex flex-column flex-md-row p-4 rounded-3 post-box bg-white">
                    
                        <div class="row">
                            <div class="col-10">
                                <div class="row">
                                    <a href="/work/ui/views/manage/project.php?ct=' . $row['id'] . '&cl=' . $row['user_id'] . '" class="">
                                        <p class="">' . $row["title"] . '</p>
                                    </a>
                                </div>
                                <div class="row">
                                    <p class="">' . $row["description"] . '</p>
                                </div>
                            </div>
                            
                            </div>
                            <div class="col-2">
                            <div class="flex-shrink-0">
                                <a href="/work/ui/views/manage/project.php?ct=' . $row['id'] . '&cl=' . $row['user_id'] . '" class="btn btn-primary">Manage</a>
                            </div>
                          <a href="/work/ui/views/chat/chat.php?dest='.$row["user_id"].'&sender='.$row["awarded_to"].'" class="btn btn-primary">Chat</a>
                          </div>
                        </div>
                    </div>
                ';
            }
        }
    } else {
        echo "0 results";
    }
}

    public function completed_contracts($uid)
    {
        
        $sql ="SELECT * FROM contracts WHERE user_id='$uid' AND final_status='1' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
            
                echo '<div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
            <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                    <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        ' . $row['title'] . '
                    </h3>
                
                
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    <i class="fal fa-map-marker mytext-secondary"></i>
                    <h5 class="mytext-black fs-14">'.$row['price'].'</h5>
                </div>
                <p class="vclip d-block mytext-black fs-14">
                ' . $row['description'] . '
                </p>
            </div>
            <div class="flex-shrink-0">
            <div class="d-flex gap-3">
            
            <div class="d-flex gap-3">
            <a href="/work/ui/views/profile/users_reviews.php?reviewer='.$row["user_id"].'&reviewee='.$row["awarded_to"].'&ct='.$row['id'].'" class="btn btn-primary">Feedback</a>
            
            </div>
            </div>
        </div>
    
        </div>';

        }
        } else {
            echo "0 results";
        }

    }

    public function completed_contracts_fr($uid)
    {
        
        $sql ="SELECT * FROM contracts WHERE awarded_to='$uid' AND final_status='1' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
            
                echo '<div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
            <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                    <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        ' . $row['title'] . '
                    </h3>
                
                
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    <i class="fal fa-map-marker mytext-secondary"></i>
                    <h5 class="mytext-black fs-14">'.$row['price'].'</h5>
                </div>
                <p class="vclip d-block mytext-black fs-14">
                ' . $row['description'] . '
                </p>
            </div>
            <div class="flex-shrink-0">
            <div class="d-flex gap-3">
            <a href="/work/ui/views/profile/users_reviews.php?reviewer='.$row["awarded_to"].'&reviewee='.$row["user_id"].'&ct='.$row['id'].'" class="btn btn-primary">Feedback</a>
            
            </div>
        </div>
    
        </div>';

        }
        } else {
            echo "0 results";
        }

    }

    public function contract_applications($uid)
    {
        
        $sql="SELECT * FROM contracts_applications WHERE applicant_id='$uid' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                echo '
            <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
              <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                    <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        ' . $row["charges"] . '
                    </h3>
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    
                    <h5 class="mytext-black fs-14">'.$row["duration"].'</h5>
                </div>
                <p class="vclip d-block mytext-black fs-14">
                ' . $row["description"] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
            
                <div class="d-flex gap-3">
            
                <a href="/work/ui/views/applications/view_application.php?app_id='.$row['id'].'&cl='.$row['client_id'].'" class="apply-btn">Manage</a>
                </div>
                </div>
            </div>
        </div>';

        }
        } else {
            echo "0 results";
        }

    }

    public function cl_contract_applications($uid)
    {
        
        $sql="SELECT * FROM contracts_applications WHERE client_id='$uid'  AND status IS NULL  ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                echo '

                <div class="row  bordered rounded-2">

                <div class="col-2">
                '.$this->get_applicant_details($row["applicant_id"]).'

                </div>

                <div class="col-6">

                
                <h5 class="">'.$row["duration"].'</h5>

                

                

                <h3 class="">
                ' . $row["charges"] . '
            </h3>
                

                
                <p class="">
                ' . $row["description"] . '
                </p>

            


                </div>
                <div class="col-3">

                <div class="flex-shrink-0">
                <div class="">
            
            
            
                <a href="/work/ui/views/chat/chat.php?dest='.$row["applicant_id"].'&sender='.$row["client_id"].'" class="btn btn-secondary">Chat</a>
                <form action="/api/contractAPI.php" method="post"  class="form-group">
                <input type="hidden" name="contract_id" value="'.$row["contract_id"].'">
                <input type="hidden" name="applicant_id" value="'.$row["applicant_id"].'">
                <input type="hidden" name="client_id" value="'.$row["client_id"].'">
                <select name="action" class="form-control" aria-label="Default select example">
                <option selected>Action</option>
                <option value="1">Accept</option>
                <option value="2">Reject</option>
                
                </select>
                
                </div>
                <button class="btn btn-primary" name="mg_action">Save</button>
                 </form>
                </div>
                </div>

                </div>';

        }
        } else {
            echo "0 results";
        }

    }

    public function awarded_contracts($uid)
    {
        
        $sql="SELECT * FROM contracts_applications WHERE client_id='$uid' AND status='1'  ORDER BY id DESC";

        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                echo '
            <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
              <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        <a href="/work/ui/views/profile/profile.php?ui='.$row["applicant_id"].'">Applicant Profile</a>
                    </h3>
                    <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        ' . $row["charges"] . '
                    </h3>
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    
                    <h5 class="mytext-black fs-14">'.$row["duration"].'</h5>
                </div>
                <p class="vclip d-block mytext-black fs-14">
                ' . $row["description"] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
                <a href="/work/ui/views/chat/chat.php?dest='.$row["applicant_id"].'&sender='.$row["client_id"].'" class="btn btn-secondary">Chat</a>
                <form action="/api/contractAPI.php" method="post">
                <input type="hidden" name="contract_id" value="'.$row["contract_id"].'">
                <input type="hidden" name="applicant_id" value="'.$row["applicant_id"].'">
                <input type="hidden" name="client_id" value="'.$row["client_id"].'">
                <select name="action" class="form-control" aria-label="Default select example">
                <option selected>Action</option>
                <option value="1">Keep</option>
                <option value="2">Cancel</option>
                
                </select>
                
            </div>
            <button class="btn btn-primary" name="mg_action">Save</button>
                 </form>
                    
                </div>
        </div>';

        }
        } else {
            echo "0 results";
        }

    }

    public function fr_offers($uid)
    {
        
        $sql="SELECT * FROM contracts WHERE awarded_to='$uid' AND status='1' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                echo '
            <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
              <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                <h3 class="mtext-black text-uppercase fs-18 fw-800">
                    
                    </h3>
                    <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        ' . $row["title"] . '
                    </h3>
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    
                    <h5 class="mytext-black fs-14">'.$row["price"].'</h5>
                </div>
                <p class="vclip d-block mytext-black fs-14">
                ' . $row["description"] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
                <a href="/work/ui/views/chat/chat.php?sender='.$row["awarded_to"].'&dest='.$row["user_id"].'" class="btn btn-sm">Chat</a>
                <form action="/api/contractAPI.php" method="post">
                <input type="hidden" name="contract_id" value="'.$row["id"].'">
                <input type="hidden" name="applicant_id" value="'.$row["awarded_to"].'">
                <input type="hidden" name="client_id" value="'.$row["user_id"].'">
                <select name="act" class="form-control" aria-label="Default select example">
                <option selected>Action</option>
                <option value="1">Accept</option>
                <option value="2">Reject</option>
                
                </select>
                <button type="submit" class="btn btn-sm rounded" name="action_offer">Save</button>
                 </form>
                    
                </div>
            </div>
        </div>';

        }
        } else {
            echo "0 results";
        }

    }


    public function award_contract($client_id,$contract_id,$applicant_id)
    {
        $sql="UPDATE contracts_applications SET status='1' WHERE contract_id='$contract_id' AND applicant_id='$applicant_id' AND client_id='$client_id';";
        $sql .="UPDATE contracts SET status='1',awarded_to='$applicant_id' WHERE id='$contract_id' AND user_id='$client_id'";
        $res=$this->run_multi_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function cancel_awarded_contract($client_id,$contract_id,$applicant_id)
    {
        $sql="UPDATE contracts_applications SET status='0' WHERE contract_id='$contract_id' AND applicant_id='$applicant_id' AND client_id='$client_id';";
        $sql .="UPDATE contracts SET status='0',awarded_to='$applicant_id' WHERE id='$contract_id' AND user_id='$client_id'";
        $res=$this->run_multi_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function accept_contract($client_id,$contract_id,$applicant_id)
    {
        $sql="UPDATE contracts_applications SET status='1' WHERE contract_id='$contract_id' AND applicant_id='$applicant_id' AND client_id='$client_id';";
        $sql .="UPDATE contracts SET fr_status='1',awarded_to='$applicant_id' WHERE id='$contract_id' AND user_id='$client_id'";
        $res=$this->run_multi_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function contract_final($contract_id,$action)
    {
        
        $sql ="UPDATE contracts SET final_status='$action' WHERE id='$contract_id'";
        $res=$this->run_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function offers_actions($contract,$uid){

        $sql="UPDATE contracts SET fr_status='1' WHERE id='$contract' AND awarded_to='$uid'";
        $res=$this->run_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }


    public function my_contracts($uid){

        $sql="SELECT * FROM contracts WHERE awarded_to='$uid' AND final_status!='1' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                echo '
            <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
              <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
            
                <p class="">
                ' . $row["description"] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
                
                <form action="/api/contractAPI.php" method="post">
                <input type="hidden" name="contract_id" value="'.$row["id"].'">
                <input type="hidden" name="applicant_id" value="'.$row["awarded_to"].'">
                <input type="hidden" name="client_id" value="'.$row["user_id"].'">
                <select name="act" class="form-control" aria-label="Default select example">
                <option selected>Action</option>
                <option value="1">Completed</option>

                <option value="2">Ended</option>
                <option value="3">Cancelled</option>
                <option value="4">Disputed</option>
                <option value="5">Rejected</option>
                <option value="6">Refunded</option>
                <option value="7">Returned</option>

                
                </select>
                <button class="btn btn-primary" name="final_action">Save</button>
                 </form>
                    
                </div>
             </div>
           </div>
        </div>';

        }
        } else {
            echo "0 results";
        }

        

    }

    
    
    public function add_milestone(){
        $contract=$_POST["contract"];
        $client=$_POST["client"];
        $name=$_POST["name"];
        $ml_payment=$_POST["ml_payment"];
        $due_date=$_POST["due_date"];
        $description=$_POST["description"];
        $status=0;
        $freelancer=$_SESSION["user_id"];
        $sql="INSERT INTO milestones(contract,client,freelancer,name,due_date,ml_payment,description,status) 
        VALUES ('$contract','$freelancer','$client','$name','$due_date','$ml_payment','$description','$status')";
        $res=$this->run_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function add_task(){

        $contract=$_POST["contract"];
        $milestone=$_POST["milestone"];
        $client=$_POST["client"];
        $name=$_POST["name"];
        $due_date=$_POST["due_date"];
        $description=$_POST["description"];
        $status=0;
        $freelancer=$_SESSION["user_id"];
        $sql="INSERT INTO tasks(contract,milestone,client,freelancer,due_date,name,description,status)
            VALUES ('$contract','$milestone','$client','$freelancer','$due_date','$name','$description','$status')";
        $res=$this->run_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }

        
    }

    //Mark task as completed
    public function task_completed($id){
        $sql="UPDATE tasks SET status='1' WHERE id='$id'";
        $res=$this->run_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    //Update the task
    public function update_task($id){
        $name=$_POST["name"];
        $description=$_POST["description"];
        $due_date=$_POST["due_date"];
        $status=0;
        $sql="UPDATE tasks SET name='$name',description='$description',due_date='$due_date',status='$status' WHERE id='$id'";
        $res=$this->run_query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    


    public function tasks($ml,$contract){

        //$sql="SELECT * FROM tasks WHERE milestone='$ml' AND contract='$contract' ORDER BY id DESC ";
        $sql="SELECT * FROM tasks WHERE contract='$contract' ORDER BY id DESC ";
        $results = $this->run_query($sql);
        while ($res = $results->fetch_assoc()) {
           //Check if task is completed put a check mark
              if($res["status"]==1){
                $check='<i class="fas fa-check-circle text-success"></i>';
                }else{
                    $check='';
                }
            echo '
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                
                <div class="fw-bold">'.$check.'  '.$res["name"].'</div>
                '.$res["description"].'
              </div>
             
              <a href="/work/ui/views/manage/task.php?ts='.$res["id"].'" class="btn btn-sm rounded border">Action</a>
            </li>
            
          ';
    

            
            
        }
        
    }

    public function tasks_action($id){

        $sql="SELECT * FROM tasks WHERE id='$id' ORDER BY id DESC";
        $results = $this->run_query($sql);
        while ($res = $results->fetch_array()) {

            echo '
            <div class="">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="taskEditModalLabel">Task Actions</h1>
    
      </div>
      <div class="modal-body">
      <form method="POST" action="/api/contractAPI.php">
      
      <input type="hidden" name="milestone" value="'.$res["milestone"].'">
      <input type="hidden" name="task" value="'.$res["id"].'">

          <div class="mb-3">
      
          <label for="recipient-name" class="col-form-label">Task Name:</label>
          <input type="text" class="form-control" id="name" name="name" value="'.$res["name"].'">
        </div>
        <div class="mb-3">
    

          <label for="recipient-name" class="col-form-label">Due Date:</label>
          <input type="date" class="form-control" id="due_date" name="due_date" value="'.$res["due_date"].'">
        </div>
        <div class="mb-3">
          <label for="message-text" class="col-form-label">Details:</label>
          <textarea class="form-control" id="description" name="description">'.$res["description"].'</textarea>
        </div>
          
          <div class="modal-footer">
    

        <button type="submit" class="btn btn-primary"  name="complete_task">Complete </button>
        <button type="submit" class="btn btn-primary"  name="update_task">Update </button>
        <button type="submit" class="btn btn-primary"  name="delete_task">Delete </button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
          ';
    

            
            
        }
        
    }

    public function milestone_action($id){

        $sql="SELECT * FROM milestones WHERE id='$id' ORDER BY id DESC";
        $results = $this->run_query($sql);
        while ($res = $results->fetch_array()) {

            echo '
            <div class="">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="taskEditModalLabel">Milestone Actions</h1>
    
      </div>
      <div class="modal-body">
      <form method="POST" action="/api/contractAPI.php">
      


      <input type="hidden" name="milestone" value="'.$res["id"].'">
      <input type="hidden" name="contract" value="'.$res["contract"].'">
      <input type="hidden" name="client" value="'.$res["client"].'">

          <div class="mb-3">
      
          <label for="recipient-name" class="col-form-label">Milestone Name:</label>
          <input type="text" class="form-control" id="name" name="name" value="'.$res["name"].'">
        </div>
        <div class="mb-3">
    

          <label for="recipient-name" class="col-form-label">Due Date:</label>
          <input type="date" class="form-control" id="due_date" name="due_date" value="'.$res["due_date"].'">
        </div>
        <div class="mb-3">
          <label for="message-text" class="col-form-label">Details:</label>
          <textarea class="form-control" id="description" name="description">'.$res["description"].'</textarea>
        </div>
        <div class="mb-3">
          <label for="message-text" class="col-form-label">Milestone Payment:</label>
          <input class="form-control" id="ml_payment" name="ml_payment" value="'.$res["ml_payment"].'">
        </div>
          
          <div class="modal-footer">
    

        <button type="submit" class="btn btn-primary"  name="complete_milestone">Complete </button>
        <button type="submit" class="btn btn-primary"  name="update_milestone">Update </button>
        <button type="submit" class="btn btn-primary"  name="delete_milestone">Delete </button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
          ';
    

            
            
        }
        
    }


    public function milestones($contract){

        $sql="SELECT * FROM milestones WHERE contract='$contract' ORDER BY id DESC";
        $results = $this->run_query($sql);
        while ($res = $results->fetch_array()) {

    
            echo '
            <ul>
            <li><a href="/work/ui/views/manage/milestone.php?ml='.$res["id"].'&ct='.$res['contract'].'&cl='.$res['client'].'"> <p class="card-title">'.$res["name"].'</p></a></li>
            

            </ul>';


            
            
        }
        
    }

    public function proposal($id,$freelancer){
            
            $sql="SELECT * FROM contracts_applications WHERE contract_id='$id' AND applicant_id='$freelancer'  ORDER BY id DESC";
            $results = $this->run_query($sql);
            $res=$results->fetch_assoc();
            return $res;
                
    }



    public function payments($contract){

        $sql="SELECT * FROM milestones WHERE contract='$contract' ORDER BY id DESC";
        $results = $this->run_query($sql);
        $res=$results->fetch_assoc();
        if($res != null || $res != ""){
            
            
        
        $inprogress=$this->var($res["ml_payment_inprogress"]);
        $released=$this->var($res["ml_payment_released"]);
        
        //Write if its empty or null make it 0
        
       
      
     
        
    }else{
        $inprogress=0.00;
        $released=0.00;
    }
    $proposal=$this->proposal($contract,$_SESSION['user_id']);
    

        echo '
        <ul>
            <li>Total Payment: '.$this->var($proposal["charges"]).'($)</li>
            <li>In Process: '.$inprogress.'($)</li>
            <li>Released: '.$released.'($)</li>
        </ul>';
    }


    //Get the contract details
    public function get_contract($ct){
            
            $sql="SELECT * FROM contracts WHERE id='$ct'";
            $results = $this->run_query($sql);
            while ($res = $results->fetch_array()) {
    
                echo '
                <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Contract Actions</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/api/contractAPI.php">
          <div class="mb-3">
      
            <label for="recipient-name" class="col-form-label">Contract Title:</label>
            <input type="text" class="form-control" id="name" name="name" value="'.$res['title'].'">
          </div>
          <div class="mb-3">
      
          <label for="recipient-name" class="col-form-label">Budget($):</label>
          <input type="text" class="form-control" id="price" name="price" value="'.$res['price'].'">
        </div>
          <div class="mb-3">
          <input type="hidden" name="contract" value="'.$res['id'].'">
            <input type="hidden" name="client" value="'.$res['user_id'].'">
            <input type="hidden" name="freelancer" value="'.$res['awarded_to'].'">

            

            <label for="recipient-name" class="col-form-label">Duration:</label>
            <input type="number" class="form-control" id="due_date" name="due_date" value="'.$res['duration'].'">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Details:</label>
            <textarea class="form-control" id="description" name="description">'.$res['description'].'</textarea>
          </div>
          <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" name="cancel_contract">Cancel</button>
        <button type="submit" class="btn btn-primary"  name="complete_contract">Complete </button>
        <button type="submit" class="btn btn-secondary" name="delete_contract">Delete</button>
         <button type="submit" class="btn btn-primary"  name="update_contract">Update </button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
                ';
        
    
                
                
            }
            
    }


    //Mark the contract as completed

    public function complete_contract($id){

        
     
        $sql="UPDATE contracts SET final_status='1' WHERE id='$id'";
        $results = $this->run_query($sql);
        if($results){
            return true;

        }else{
            return false;
        }

    }

    //Delete the contract

    public function delete_contract($id){
     
        $sql="DELETE FROM contracts WHERE id='$id'";
        $results = $this->run_query($sql);
        if($results){
            return true;

        }else{
            return false;
        }

    }

    //Delete the task

    public function delete_task($id){
     
        $sql="DELETE FROM tasks WHERE id='$id'";
        $results = $this->run_query($sql);
        if($results){
            return true;
        }else{
            return false;
        }

    }
    
    //Delete the milestone

    public function delete_milestone($id){
     
        $sql="DELETE FROM milestones WHERE id='$id'";
        $results = $this->run_query($sql);
        if($results){
            return true;
        }else{
            return false;
        }

    }
  


   //Update the milestone

    public function update_milestone($id){
      $name=$_POST['name'];
        $due_date=$_POST['due_date'];
        $ml_payment=$_POST['ml_payment'];
        $description=$_POST['description'];
        $contract=$_POST['contract'];

     $sql="UPDATE milestones SET name='$name',due_date='$due_date',ml_payment='$ml_payment',description='$description' WHERE id='$id'";
     $results = $this->run_query($sql);
     if($results){
          return true;
     }else{
          return false;
     }

    }

    //Mark complete the milestone

    public function complete_milestone($id){
     
        $sql="UPDATE milestones SET status='1' WHERE id='$id'";
        $results = $this->run_query($sql);
        if($results){
            return true;

        }else{
            return false;
        }

    }
    

    //List milestones 
    public function list_milestones($contract){
        $sql="SELECT * FROM milestones WHERE contract='$contract' ORDER BY id DESC";
        $results = $this->run_query($sql);
        while ($res = $results->fetch_array()) {

    
            echo '
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                
                <table>
                <thead>
                <tr>
                <th>Name</th>
                <th></th>
                <th></th>
                <th>Due Date</th>
                <th></th>
                <th></th>
                <th>Payment($)</th>
                
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>'.$res["name"].'</td>
                <td></td>
                <td></td>
                <td>'.$res["due_date"].'</td>
                <td></td>
                <td></td>
                <td>'.$res["ml_payment"].'</td>
                
                </table>
              </div>
             
              <a href="/api/contractAPI.php?act=release_req&ml='.$res["id"].'&ct='.$contract.'" class="btn btn-sm rounded border">Request Release</a>
            </li>';
       }
   }


   public function list_milestones_client($contract){
    $sql="SELECT * FROM milestones WHERE contract='$contract' ORDER BY id DESC";
    $results = $this->run_query($sql);
    while ($res = $results->fetch_array()) {


        echo '
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            
            <table>
            <thead>
            <tr>
            <th>Name</th>
            <th></th>
            <th></th>
            <th>Due Date</th>
            <th></th>
            <th></th>
            <th>Payment($)</th>
            
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>'.$res["name"].'</td>
            <td></td>
            <td></td>
            <td>'.$res["due_date"].'</td>
            <td></td>
            <td></td>
            <td>'.$res["ml_payment"].'</td>
            
            </table>
          </div>
         
          <a href="/api/contractAPI.php?act=release&ml='.$res["id"].'&ct='.$contract.'" class="btn btn-sm rounded border">Release Milestone</a>
        </li>';
   }
}
   //Request release of milestone
    public function release_milestone_request($id){
      
     $sql="UPDATE milestones SET release_request='1' WHERE id='$id'";
     $results = $this->run_query($sql);
     if($results){
          return true;
    
     }else{
          return false;
     }
    }

    public function release_milestone($id){
      
        $sql="UPDATE milestones SET release_status='1' WHERE id='$id'";
        $results = $this->run_query($sql);
        if($results){
             return true;
       
        }else{
             return false;
        }
    }

    //Check if client has a financial profile

    public function check_client_financial_profile($id){
        $sql="SELECT * FROM financial_profile WHERE user_id='$id'";
        $results = $this->run_query($sql);
        $res = $results->fetch_assoc();
        $stripe_connect=$res['stripe_connect_id'];
        if($stripe_connect!="" || $stripe_connect!=null){
            return true;
        }else{
            return false;
        }
        
    }

    //Check if freelancer has a financial profile

    public function check_fr_financial_profile($id){
        $sql="SELECT * FROM financial_profile WHERE user_id='$id'";
        $results = $this->run_query($sql);
        $res = $results->fetch_assoc();
        $stripe_customer=$res['stripe_customer_id'];
        if($stripe_customer!="" || $stripe_customer!=null){
            return true;
        }else{
            return false;
        }
        
    }

    //Create financial profile for client

    public function create_financial_profile_client($id){
        $sql="INSERT INTO financial_profile (user_id) VALUES ('$id')";
        $results = $this->run_query($sql);
        if($results){
            return true;
        }else{
            return false;
        }
        
    }

    //Pay freelancer

    public function pay_freelancer($id,$amount){
        $sql="INSERT INTO balance (user_id,current_balance) VALUES ('$id','$amount')";
        $results = $this->run_query($sql);
        if($results){
            return true;
        }else{
            return false;
        }
        
    }

    //Get contract details

    public function get_contract_details($id){
        $sql="SELECT * FROM contracts WHERE id='$id'";
        $results = $this->run_query($sql);
        $res = $results->fetch_assoc();
        return $res;
    }

    //Get milestone details

    public function get_milestone_details($id){
        $sql="SELECT * FROM milestones WHERE id='$id'";
        $results = $this->run_query($sql);
        $res = $results->fetch_assoc();
        return $res;
    }
   //Write a function to check if an applicant has already applied for a contract

    public function check_if_applied($contract,$user){
     $sql="SELECT * FROM contracts_applications WHERE contract_id='$contract' AND applicant_id='$user'";
     $results = $this->run_query($sql);
     $res = $results->fetch_assoc();
     if($res){
          return true;
     }else{
          return false;
     }
    }


    //Write a function to get applicant details like profile picture, name, skills, and country

    public function get_applicant_details($id){
     $sql="SELECT * FROM users WHERE id='$id'";
     $results = $this->run_query($sql);
     $res = $results->fetch_assoc();
     echo ' 
            <img src="'.$res["profile_image"].'" class="" alt="..." style="width:50px;height:50px;">
            <h5 class="">'.$res["first_name"].' '.$res["last_name"].'</h5>
            <p class="">'.$res["country"].'</p>
        ';
    }

    //Write a function to get contract details like title, description, skills, and country

    public function getContract($id){

        //Get contract details

        $sql="SELECT * FROM contracts WHERE id='$id'";
        $results = $this->run_query($sql);
        $res = $results->fetch_assoc();
        return $res;

    }


}