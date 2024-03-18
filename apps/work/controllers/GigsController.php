<?php
include 'Controller.php';


class GigsController extends Controller{

    public function __construct(){
        parent::__construct();
        
        
    }

    
    
    public function store_gigs_step1(){
    

        $user_id=$_SESSION['user_id'];
        $gigtitle=$_POST['gigtitle'];
        $category=$_POST['category'];
        $subcategory=$_POST['subcategory'];
        $location=$_POST['location']=$_POST['country'];

        $basicpackage=$_POST['basicpackage'];
        $standardpackage=$_POST['standardpackage'];
        $premiumpackage=$_POST['premiumpackage'];

        $basicdescribe=$_POST['basicdescribe'];
        $standardescribe=$_POST['standardescribe'];
        $premiumdescribe=$_POST['premiumdescribe'];

        $basic_delieverytime=$_POST['basic_delieverytime'];
        $standard_delieverytime="standard_delieverytime";
        $premium_delieverytime=$_POST['premium_delieverytime'];

        $basic_revisions=$_POST['basic_revisions'];
        $standard_revisions=$_POST['standard_revisions'];
        $premium_revisions=$_POST['premium_revisions'];

        $basicdouble=$_POST['basicdouble'];
        $standarddouble=$_POST['standarddouble'];
        $premiumdouble=$_POST['premiumdouble'];

        $basichigh=$_POST['basichigh'];
        $standardhigh=$_POST['standardhigh'];
        $premiumhigh=$_POST['premiumhigh'];

        $basic_price=$_POST['basic_price'];
        $standard_price=$_POST['standard_price'];
        $premium_price=$_POST['premium_price'];
    

        $sql="INSERT INTO gigs(user_id,gigtitle,category,subcategory,location,basicpackage,
        standardpackage,premiumpackage,basicdescribe,standardescribe,premiumdescribe,basic_delieverytime,
        standard_delieverytime,premium_delieverytime,basic_revisions,standard_revisions,premium_revisions,
        basicdouble,standarddouble,premiumdouble,basichigh,standardhigh,premiumhigh,basic_price,
        standard_price,premium_price)
        VALUES('$user_id','$gigtitle','$category','$subcategory','$location','$basicpackage',
        '$standardpackage','$premiumpackage','$basicdescribe','$standardescribe','$premiumdescribe','
        $basic_delieverytime','$standard_delieverytime','$premium_delieverytime','$basic_revisions',
        '$standard_revisions','$premium_revisions','$basicdouble','$standarddouble','$premiumdouble',
        '$basichigh','$standardhigh','$premiumhigh','$basic_price','$standard_price','$premium_price')";
        $results=$this->run_query($sql);
        if($results){
        
            $gig = mysqli_insert_id($this->run_query);
            return $gig;
        }else{
            return false;
        }
        
    }
   
    public function store_gigs_step2(){
    

        $user_id=$_SESSION['user_id'];
        $gig_id=$_POST['gig_id'];
        $step2_description=$_POST['step2_description'];
        $questions=$_POST['question'];
        $answers=$_POST['answer'];
        $requirement=$_POST['requirement'];
        $gigimages=$_POST['image'];
        $gigfiles=$_POST['video'];
    
        $gigimages=move_uploaded_file($_FILES["image"]["tmp_name"],$_FILES["image"]["name"]);
        $gigfiles=move_uploaded_file($_FILES["video"]["tmp_name"],$_FILES["video"]["name"]);
    
        $gig_status=1;
        $sql="UPDATE gigs SET step2_description='$step2_description',questions='$questions',answers='$answers',
        requirement='$requirement',gigimages='$gigimages',gigsvideo='$gigfiles',gig_status='$gig_status' WHERE id='$gig_id'";
        $results=$this->run_query($sql);
        if($results){
            return true;
        }else{
            return false;
        }
        
    }

    public function get_gigs($uid){
        $sql="SELECT * FROM gigs WHERE gig_status=1 AND user_id='$uid' ORDER BY id DESC";
        $results=$this->run_query($sql);
        $rows=mysqli_num_rows($results);
        
    }

    public function view_gigs($uid){

        $sql="SELECT * FROM gigs WHERE user_id='$uid'";
        $results = $this->run_query($sql);

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                echo '<div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-3 my-1">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <img class="w-100" src="'.$row["gigimages"].'">
                                <ul
                                    class="mtext-black ls-none d-flex gap-2 ps-3 flex-wrap align-items-center text-uppercase fs-16 fw-600 my-1">
                                    <li>
                                        <div
                                            class="user-pic w-40 h-40 rounded-circle overflow-hidden ofit flex-shrink-0 ">
                                            <img src="/ui/profileimage/user.jpg"
                                                alt="logo">
                                                                                        </div>
                                    </li>
                                    <li> '.$row["gigtitle"].'</li>
                                </ul>




                                <ul class="d-flex gap-4 ps-3 flex-wrap">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                        '.$row["date_created"].'
                                        </h4>
                                    </li>
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">full time</h4>
                                    </li>

                                </ul>
                            </div>

                            <p class="vclip d-block mytext-black fs-14 mt-1">
                            '.$row["step2_description"].'
                            </p>
                            <hr>
                            <p class="vclip d-block mytext-black fs-14 mt-1">
                                Starting At <strong>'.$row["basic_price"].'</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }


    //list gigs 

    public function list_gigs(){

        $sql="SELECT * FROM gigs ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
    
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['gigtitle'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['category'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subcategory'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['basic_price'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['step2_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/purchases/pur_gig.php?gig='.$row['id'].'&u='.$row['user_id'].'" class="apply-btn">Buy Now</a>                            
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

    public function createGigPurchaseTable($table = "gig_purchase")
    {
        $this->deleteTable($table);
        $this->createTable(
            $table,
            '
            id INT AUTO_INCREMENT PRIMARY KEY,
            gig_id INT,
            freelancer_id INT,
            client_id INT,
            order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            
            status VARCHAR(20),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            '
        );
    }

    //Create gig purchase function here , inlcude the order_date and due_date

    public function purchase_gig($gig_id,$freelancer_id,$client_id,$price,$payment,$order_date)
    {
        $sql = "INSERT INTO gig_purchase (gig_id,freelancer_id,client_id,price,payment_method,order_date) VALUES ('$gig_id','$freelancer_id','$client_id','$price','$payment','$order_date')";
        $results = $this->run_query($sql);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    //Get the gig details

    public function get_gig_details($gig_id)
    {
        $sql = "SELECT * FROM gigs WHERE id='$gig_id'";
        $results = $this->run_query($sql);
        $row = mysqli_fetch_assoc($results);
        return $row;
    }

    //Get the payment details of a user 

    public function get_payment_details($user_id, $key)
    {
        $sql = "SELECT * FROM payment_methods WHERE user_id='$user_id'";
        $results = $this->run_query($sql);
        $row = $results->fetch_assoc();
        
        $card_details = json_decode($row['card_details'], true); // Decode JSON as associative array
        
        if (isset($card_details[$key])) {
            return $card_details[$key];
        } else {
            return null; // or any default value you want to return if the key doesn't exist
        }
    }
    
}




    








