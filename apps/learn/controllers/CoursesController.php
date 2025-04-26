<?php
include 'Controller.php';


class CoursesController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function list_courses(){

        $sql="SELECT * FROM courses ORDER BY id DESC";
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
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['discipline'].'
                            </h4>
                        
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['price'].'
                                    </h4>
                                </li>
                                
                            </ul>
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
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

    public function search_courses($search){

        $sql="SELECT * FROM courses WHERE title LIKE '%$search%' OR discipline LIKE '%$search%' OR description LIKE '%$search%' ORDER BY id DESC";
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
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['discipline'].'
                            </h4>
                        
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['price'].'
                                    </h4>
                                </li>
                                
                            </ul>
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
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


    public function filter_courses_country($country){

        $sql="SELECT * FROM courses WHERE country LIKE '%$country%'";
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
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['discipline'].'
                            </h4>
                        
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['price'].'
                                    </h4>
                                </li>
                                
                            </ul>
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
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


    public function filter_courses_level($level){

        $sql="SELECT * FROM courses WHERE level LIKE '%$level%'";
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
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['discipline'].'
                            </h4>
                        
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['price'].'
                                    </h4>
                                </li>
                                
                            </ul>
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
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


    public function filter_courses_descipline($descipline){

        $sql="SELECT * FROM courses WHERE descipline LIKE '%$descipline%'";
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
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['discipline'].'
                            </h4>
                        
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['price'].'
                                    </h4>
                                </li>
                                
                            </ul>
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
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

    public function filter_courses_price($price){

        $sql="SELECT * FROM courses WHERE price LIKE '%$price%'";
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
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['discipline'].'
                            </h4>
                        
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['price'].'
                                    </h4>
                                </li>
                                
                            </ul>
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/work/ui/views/purchases/pur_course.php?cr='.$row['id'].'" class="apply-btn">Buy Now</a>                            
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




    
    
    public function store(){

        $user_id=$_SESSION['user_id'];
        $title=$_POST['title'];
        $discipline=$_POST['discipline'];
        $level=$_POST['level'];
        $description=$_POST['description'];
        $link=$_POST['link'];
        $price=$_POST['price'];
        $experience=$_POST['experience'];
        $picture=$_FILES["picture"]["name"];
        $picture_file=move_uploaded_file($_FILES["picture"]["tmp_name"],$picture);
        $dest=$_FILES["file"]["name"];
        $file=move_uploaded_file($_FILES["file"]["tmp_name"],$dest);
        $status=$_POST['status'];
        $country=$_POST['country'];
        $sql="INSERT INTO courses(user_id,title,discipline,level,description,link,price,picture,file,status,country) 
        VALUES('$user_id','$title','$discipline','$level','$description','$link','$price','$picture_file','$file','$status','$country')";
        $results=$this->run_query($sql);
        if($results){
            return true;
        }else{
            return false;
        }
        
    }

    



}
