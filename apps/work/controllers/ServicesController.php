<?php
include 'Controller.php';


class ServicesController extends Controller{

    public function __construct(){
        parent::__construct();
    }


    public function list_services(){

        $sql="SELECT * FROM local_services ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
    
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['title'].'
                            </h3>
                        
                        
                        
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
                            </a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }


    public function search_services($search){

        $sql="SELECT * FROM local_services WHERE title LIKE '%$search%' OR service_option_name LIKE '%$search%' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
    
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['title'].'
                            </h3>
                        
                        
                        
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
                            </a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }

    
    public function filter_services($country){

        $sql="SELECT * FROM local_services WHERE location LIKE '%$country%' ";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
    
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['title'].'
                            </h3>
                        
                        
                        
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
                            </a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }

    
    
    public function store()
    {
        $user_id = $_SESSION['user_id'];
        $country = $_POST['country'];
        $title= $_POST['title'];
        $availability = json_encode($_POST['availability']);
        $service_options = json_encode($_POST['service_options']);
        $option_prices = json_encode($_POST['option_prices']);
        $description = $_POST['description'];
        //$service_file = $_FILES["file"]["name"]=null;
        $service_file =null;
        //$file = move_uploaded_file($_FILES["file"]["tmp_name"], $service_file);
        $service_status = $_POST['service_status'];
    
        $sql = "INSERT INTO local_services (user_id,title,availability, service_option_name,location, service_option_price, description, service_file, service_status)
                VALUES ('$user_id','$title','$availability', '$service_options','$country','$option_prices','$description', '$service_file', '$service_status')";
        $results = $this->run_query($sql);
        
        if ($results) {
            return true;
        } else {
            return false;
        }
    }
    

}
