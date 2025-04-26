<?php
include 'Controller.php';


class JobController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    
    public function apply_job()
    {

        $job_id = $_POST['job_id'];
        $user_id = $_POST['user_id'];
        $client_id = $_POST['client_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_email = $_POST['contact_email'];
        $contact_phone = $_POST['contact_phone'];
        $resume_file = $_POST['cv_resume'];
        $resume="";
        $person_specifications = $_POST['person_specifications'];
        $skill_requirements = $_POST['skill_requirements'];
        $qualifications_requirements = $_POST['qualifications_requirements'];
        $experience_requirements = $_POST['experience_requirements'];

        $sql = "INSERT INTO job_applications (job_id,user_id,client_id,first_name, last_name, contact_email, contact_phone, resume, person_specifications, skill_requirements, qualifications_requirements, experience_requirements) 
                VALUES ('$job_id','$user_id','$client_id','$first_name', '$last_name', '$contact_email', '$contact_phone', '$resume', '$person_specifications', '$skill_requirements', '$qualifications_requirements', '$experience_requirements')";
        
        $results = $this->run_query($sql);
    
        if ($results) {
            return true;
        } else {
            return false;
        }
    }
   
    //Saved Jobs 
    public function save_jobs($job_id,$user_id,$client_id)
    {

        $sql = "INSERT INTO saved_jobs (job_id,user_id,client_id) 
                VALUES ('$job_id','$user_id','$client_id')";
        
        $results = $this->run_query($sql);
    
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    //Check if job is saved

    public function check_if_saved($job_id,$user_id,$client_id)
    {
        $sql = "SELECT * FROM saved_jobs WHERE job_id='$job_id' AND user_id='$user_id' AND client_id='$client_id'";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function store($user_id, $job_title, $company, $industry, $subindustry, $location, $contract_type, $salary, $person_specifications, $skill_requirements, $qualifications_requirements, $experience_requirements, $job_description, $job_file)
    {
        $sql = "INSERT INTO jobs (user_id, job_title, company, industry, subindustry, location, contract_type, salary, person_specifications, skill_requirements, qualifications_requirements, experience_requirements, job_description, job_file) 
                VALUES ('$user_id', '$job_title', '$company', '$industry', '$subindustry', '$location', '$contract_type', '$salary', '$person_specifications', '$skill_requirements', '$qualifications_requirements', '$experience_requirements', '$job_description', '$job_file')";
        
        $results = $this->run_query($sql);
    
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    //Create a function to get all jobs

    public function list_jobs(){

        $sql="SELECT * FROM jobs ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/applications/apply_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Apply Now</a>                            
                            </a>
                            <a href="/apps/work/ui/views/applications/apply_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'&act=save" class="apply-btn">Save Job</a>                            
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

    public function clients_jobs_list(){

        $sql="SELECT * FROM jobs ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                        <a href="/apps/work/ui/views/manage/view_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Manage Job</a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }

    //Create a function to get all  saved jobs by user

    public function list__jobs($uid){

        
            $sql="SELECT * FROM jobs WHERE id='$uid' ORDER BY id DESC";
            $results = $this->run_query($sql);
            if ($results->num_rows > 0) {
                while ($row = $results->fetch_array()) {
                    
                    echo '
                    <div class="d-flex flex-column gap-3">
                    <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column gap-1">
                                <h3 class="mtext-black  fs-15 fw-800">
                                    '.$row['job_title'].'
                                </h3>
                                <h4 class="mtext-black text-uppercase fs-14 fw-400">
                                '.$row['company'].'
                                </h4>
                                <h5 class="mtext-black text-uppercase fs-14 fw-400">
                                '.$row['subindustry'].'
                                </h5>
                                <ul class="d-flex gap-4 ps-3">
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">
                                            '.$row['date_created'].'
                                        </h4>
                                    </li>
                                    <li>
                                        <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                    </li>
                                
                                </ul>
                            </div>
                            <div class="d-flex gap-2 align-items-center my-2">
                                <i class="fal fa-map-marker mytext-secondary"></i>
                                <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                            </div>
                            <p class="vclip d-block mytext-black fs-14">
                            '.$row['job_description'].'
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-3">
                                <a href="/apps/work/ui/views/manage/view_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">View Job</a>
                            </div>
                        </div>
                    </div>
                </div>';
                    
                }
            } else {
                echo "0 results";
            }

    }

    public function search_list__jobs($uid,$search){

        
        $sql="SELECT * FROM jobs WHERE id='$uid' AND job_title LIKE '%$search%'  ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                            
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/manage/view_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">View Job</a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }

}

    //Create a function to get all  saved jobs 

    public function saved_jobs($uid) {
        // Get all saved jobs by a user based on user id and return an array of job ids
        $sql = "SELECT * FROM saved_jobs WHERE user_id='$uid'";
        $results = $this->run_query($sql);
        $jobIds = array(); // Initialize an empty array to store the job IDs
        
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
            $ids[]= $row['job_id'];
            foreach ($ids as $id) {
            

                $this->list__jobs($id);
            
            }
        }
             // Return the array of job IDs
        } else {
            
            return null; // Return null when there are no saved jobs
        }
    }
  
    //Search saved jobs
    public function search_saved_jobs($uid,$search) {
        // Get all saved jobs by a user based on user id and return an array of job ids
        $sql = "SELECT * FROM saved_jobs WHERE user_id='$uid' ";
        $results = $this->run_query($sql);
        $jobIds = array(); // Initialize an empty array to store the job IDs
        
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
            $ids[]= $row['job_id'];
            foreach ($ids as $id) {
            

                
                $this->search_list__jobs($id,$search);
            
            }
        }
             
        } else {
            
            return null; // Return null when there are no saved jobs
        }
    }
    

   //Function to list applied jobs

   public function applied_jobs($uid) {
    // Get all saved jobs by a user based on user id and return an array of job ids
    $sql = "SELECT * FROM job_applications WHERE user_id='$uid'";
    $results = $this->run_query($sql);
    $jobIds = array(); // Initialize an empty array to store the job IDs
    
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_array()) {
        $ids[]= $row['job_id'];
        foreach ($ids as $id) {
        

            $this->list__jobs($id);
        
        }
    }
         // Return the array of job IDs
    } else {
        
        return null; // Return null when there are no saved jobs
    }
}

//search applied jobs

public function search_applied_jobs($uid,$search) {
    // Get all saved jobs by a user based on user id and return an array of job ids
    $sql = "SELECT * FROM job_applications WHERE user_id='$uid'";
    $results = $this->run_query($sql);
    $jobIds = array(); // Initialize an empty array to store the job IDs
    
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_array()) {
        $ids[]= $row['job_id'];
        foreach ($ids as $id) {
        

            $this->search_list__jobs($id,$search);
        
        }
    }
         // Return the array of job IDs
    } else {
        
        return null; // Return null when there are no saved jobs
    }
}



    public function  list_client_open_jobs($uid)
    {
        
        $sql="SELECT * FROM jobs WHERE user_id='$uid' ORDER BY id DESC";

        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/manage/view_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Manage Job</a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }

    public function  search_list_client_open_jobs($uid,$search)
    {
        
        $sql="SELECT * FROM jobs WHERE user_id='$uid' AND job_title LIKE '%$search%' ORDER BY id DESC";

        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/manage/view_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Manage Job</a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }



    public function  list_client_closed_jobs($uid)
    {
        
        $sql="SELECT * FROM jobs WHERE user_id='$uid' AND job_status='closed' ORDER BY id DESC";

        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/manage/view_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Manage Job</a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }


    public function  search_list_client_closed_jobs($uid,$search)
    {
        
        $sql="SELECT * FROM jobs WHERE user_id='$uid' AND job_title LIKE '%$search%' ORDER BY id DESC";

        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/manage/view_job.php?jo='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Manage Job</a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    

    }


    //Create a function to count get applications from contracts_applications table

    public function count_applications($job_id){

        //count the number of applications for a job based on the job id
        $sql="SELECT * FROM contracts_applications WHERE id='$job_id'";
        $results = $this->run_query($sql);
        $count = $results->num_rows;
        return $count;

    }


    //Create a function to list job applications 

    public function client_job_applications($uid){

        $sql="SELECT * FROM job_applications WHERE client_id='$uid' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['first_name'].' '.$row['last_name'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['contact_email'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['contact_phone'].'
                            </h5>
                            
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['person_specifications'].'
                        </p>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['skill_requirements'].'
                        </p>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['qualifications_requirements'].'
                        </p>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['experience_requirements'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/manage/view_job.php?ct='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Manage Contract</a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    


    }

    public function job_applications($uid){
        $sql="SELECT * FROM job_applications WHERE user_id='$uid' ORDER BY id DESC";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['first_name'].' '.$row['last_name'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['contact_email'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['contact_phone'].'
                            </h5>
                            
                        </div>
                    
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['person_specifications'].'
                        </p>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['skill_requirements'].'
                        </p>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['qualifications_requirements'].'
                        </p>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['experience_requirements'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/manage/view_job.php?ct='.$row['id'].'&cl='.$row['user_id'].'" class="apply-btn">Manage Contract</a>
                        </div>
                    </div>
                </div>
            </div>';
                
            }
        } else {
            echo "0 results";
        }
    


    }

    public function filter_jobs_search($search_query, $uid)
    {

        if ($search_query == "" or $search_query == null) {
            $sql = "SELECT * FROM jobs WHERE user_id='$uid'";
            $results = $this->run_query($sql);
        } elseif ($search_query != "" or $search_query != null) {
            $sql = "SELECT * FROM jobs WHERE user_id='$uid' AND title LIKE '%$search_query%' OR job_description LIKE '%$search_query%'";
            $results = $this->run_query($sql);
        } else {
            $sql = "SELECT * FROM jobs WHERE user_id='$uid'";
            $results = $this->run_query($sql);
        }

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                echo '
            <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
            <div class="flex-grow-1">
                <div class="d-flex flex-column gap-1">
                    <h3 class="mtext-black text-uppercase fs-18 fw-800">
                        ' . $row['title'] . '
                    </h3>
                    <h4 class="mtext-black text-uppercase fs-14 fw-400">
                    ' . $row['job_description'] . '
                    </h4>
                    <ul class="d-flex gap-4 ps-3">
                        <li>
                            <h4 class="mtext-black fs-14 fw-400">
                                
                            </h4>
                        </li>
                        <li>
                            <h4 class="mtext-black fs-14 fw-400">Local Service</h4>
                        </li>
                        <li>
                            
                        </li>
                    </ul>
                </div>
                <div class="d-flex gap-2 align-items-center my-2">
                    <i class="fal fa-map-marker mytext-secondary"></i>
                    
                </div>
                <p class="vclip d-block mytext-black fs-14">
                ' . $row['job_description'] . '
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="d-flex gap-3">
                    <a href="/apps/work/ui/views/services/apply.php" class="apply-btn">Apply Now</a>
                    
                        <a href="/apps/work/ui/views/services/apply.php"
                        class="mytext-black fs-14 border-0 bg-transparent">
                        <i class="fal fa-bookmark"></i>
                    </a>
                                            </div>
            </div>
        </div>
        ';

            }
        } else {
            echo "0 results";
        }

    }

   //write a function that filters the jobs based on the search query to find the jobs that match the search query based whole the parameters of the jobs

   public function search_jobs($search_query){

    $sql="SELECT * FROM jobs WHERE job_title LIKE '%$search_query%' 
    ";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/applications/apply_job.php?jo='.$row['id'].'" class="apply-btn">Apply Now</a>                            
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


   //Function for filter contract type
   public function filter_jobs_type($contract_type){

    $sql="SELECT * FROM jobs WHERE contract_type LIKE '%$contract_type%'
    ";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/applications/apply_job.php?jo='.$row['id'].'" class="apply-btn">Apply Now</a>                            
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

   //Function for filter contury

    public function filter_jobs_location($location){
   
        $sql="SELECT * FROM jobs WHERE location LIKE '%$location%'
    ";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_array()) {
                $job_apps=$this->count_applications($row['id']);
                echo '
                <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column flex-md-row gap-3 gap-md-4 p-4 rounded-3 post-box bg-white">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column gap-1">
                            <h3 class="mtext-black  fs-15 fw-800">
                                '.$row['job_title'].'
                            </h3>
                            <h4 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['company'].'
                            </h4>
                            <h5 class="mtext-black text-uppercase fs-14 fw-400">
                            '.$row['subindustry'].'
                            </h5>
                            <ul class="d-flex gap-4 ps-3">
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">
                                        '.$row['date_created'].'
                                    </h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$row['contract_type'].'</h4>
                                </li>
                                <li>
                                    <h4 class="mtext-black fs-14 fw-400">'.$job_apps.' applied</h4>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex gap-2 align-items-center my-2">
                            <i class="fal fa-map-marker mytext-secondary"></i>
                            <h5 class="mytext-black fs-14">'.$row['location'].'</h5>
                        </div>
                        <p class="vclip d-block mytext-black fs-14">
                        '.$row['job_description'].'
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3">
                            <a href="/apps/work/ui/views/applications/apply_job.php?jo='.$row['id'].'" class="apply-btn">Apply Now</a>                            
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





    //write a function to check if user has applied for a job

    public function check_if_applied($job_id, $user_id)
    {
        $sql = "SELECT * FROM job_applications WHERE job_id='$job_id' AND user_id='$user_id'";
        $results = $this->run_query($sql);
        if ($results->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    //write a function to get the job details by job id

    public function get_job_details($job_id)
    {
        $sql = "SELECT * FROM jobs WHERE id='$job_id'";
        $results = $this->run_query($sql);
        $res=$results->fetch_assoc();
        return $res;
    }

    //write a function to delete a job by job id

    public function delete_job($job_id)
    {
        $sql = "DELETE FROM jobs WHERE id='$job_id'";
        $results = $this->run_query($sql);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    //write a function to update a job by job id

    public function update_job(){

        $job_id = $_POST['job_id'];

        $job_title = $_POST['job_title'];
        $company = $_POST['company'];
        $industry = $_POST['industry'];
        $subindustry = $_POST['subindustry'];
        $location = $_POST['location'];
        $contract_type = $_POST['contract_type'];
        $salary = $_POST['salary'];
        $person_specifications = $_POST['person_specifications'];
        $skill_requirements = $_POST['skill_requirements'];
        $qualifications_requirements = $_POST['qualifications_requirements'];
        $experience_requirements = $_POST['experience_requirements'];
        $job_description = $_POST['description'];
        $job_file = $_FILES["file"];
        $directory = '/storage/jobs_files/'; // Specify the directory where you want to store the files
        $destination = "";
        $sql="UPDATE jobs SET job_title='$job_title',
        company='$company',
        industry='$industry',
        subindustry='$subindustry',
        location='$location',
        contract_type='$contract_type',
        salary='$salary',
        person_specifications='$person_specifications',
        skill_requirements='$skill_requirements',
        qualifications_requirements='$qualifications_requirements',
        experience_requirements='$experience_requirements',
        job_description='$job_description',
        job_file='$destination' WHERE id='$job_id'";

        $results = $this->run_query($sql);

        if ($results) {
            return true;
        } else {
            return false;
        }






    }

    //Write a function to job status 

    public function job_status($job_id, $status)
    {
        $sql = "UPDATE jobs SET job_status='$status' WHERE id='$job_id'";
        $results = $this->run_query($sql);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }



}