<?php



trait PullProjects 
{

    use Discovery;
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function feeder_home($query,$limit){
        
        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&min_avg_price=".$this->min_bg_fixed."&limit=".$limit."&query=" . $query;
        
        $resp=$this->api_call($url);

        $obj = json_decode($resp);

        $pros = $obj->result->projects;

        foreach ($pros as $project) {
            $pid = $project->id;
            $min_bg = $project->budget->minimum;
            $max_bg = $project->budget->maximum;
            $title = $project->title;
            $seo_url=$project->seo_url;
            $status=$project->status;
            $description=$project->preview_description;
        
            $url = "https://www.freelancer.com/projects/" . $pid;
            $p_url="/api/autowork.php?task=mbid&p=".$pid;
            $multi_bid="/api/autowork.php?task=bid";
            
            echo 
                '
                <div class="card shadow" style="width: 80%;">
            <div class="card-body">
              <h5 class="card-title">' . $title . '</h5>
              <h7 class="card-title">' . $seo_url . '</h7>
              <p class="card-text">' . $description . '</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">' . $min_bg . '</li>
              <li class="list-group-item">' . $max_bg . '</li>
              <li class="list-group-item">' . $status . '</li>
            </ul>
            <div class="card-body">
              <a href="' . $url . '" class="card-link" target="_blank">Project URL</a>
              <a href="' . $p_url . '" class="card-link" target="_blank">Bid</a>
              <a href="' . $multi_bid . '" class="card-link" target="_blank">MultiBid</a>
            </div>
          </div>';
        
        }

    }

    



    public function autobid_onprojects($query){

        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=" . $query . "&limit=20";
        
        $resp = $this->api_call($url);

        $obj = json_decode($resp);
        $pros = $obj->result->projects;
        $i=1;
        foreach ($pros as $project) {
            $i++;
            $ownerId = $project->owner_id;
            $pid = $project->id;
            $title = $project->title;
            $description = $project->preview_description;
            $max_bg = $project->budget->maximum;
            $charges = $max_bg / 2;
            $msg = $this->msg;

            //$fl=$this->fetch_elite_projects($pid);
            $this->createBid($pid, $charges, $title, $this->bidder, $this->duration);
            //$projectlink="https://www.freelancer.com/projects/".$pid.".html";
            //echo $i." <a href='$projectlink' target='_blank'>$title</a>".$fl."<br>";
            //echo $fl;
        }

    }


    public function filter_elite_projects($query){

        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=" . $query . "&limit=20";
        
        $resp = $this->api_call($url);

        $obj = json_decode($resp);
        $pros = $obj->result->projects;
        $i=1;
        foreach ($pros as $project) {
            $i++;
            $ownerId = $project->owner_id;
            $pid = $project->id;
            $title = $project->title;
            $description = $project->preview_description;
            $max_bg = $project->budget->maximum;
            $charges = $max_bg / 2;
            $msg = $this->msg;
            $projectlink="https://www.freelancer.com/projects/".$pid.".html";

            $fl=$this->fetch_elite_projects($pid);

            if($fl==1){
                echo $i." <a href='$projectlink' target='_blank'>$title</a>".$fl."<br>";
            }


            
        }

    }

    

    public function feeder($query){
    
        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&min_avg_price=".$this->min_bg_fixed."&limit=".$this->limit."&query=" . $query;
        
        $resp=$this->api_call($url);

        $obj = json_decode($resp);

        $pros = $obj->result->projects;

        foreach ($pros as $project) {
            $pid = $project->id;
            $min_bg = $project->budget->minimum;
            $max_bg = $project->budget->maximum;
            $title = $project->title;
            $seo_url=$project->seo_url;
            $status=$project->status;
            $description=$project->preview_description;
            $country = $project->currency->country;

            $fl=$this->fetch_elite_projects($pid);

            

            $url = "https://www.freelancer.com/projects/" . $pid;
            $p_url="/api/autowork.php?task=bd&p=".$pid;
            $multi_bid="/api/fr_cronjob.php?task=makebid";
        
                echo 
                '
                <div class="card shadow" style="width: 80%;">
            
            <div class="card-body">
              <h5 class="card-title">' . $title . '</h5>
              <h7 class="card-title">' . $seo_url . '</h7>
              <p class="card-text">' . $description . '</p>
             
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Min Budget:' . $min_bg . '</li>
              <li class="list-group-item">Max Budget:' . $max_bg . '</li>
              <li class="list-group-item">Status:' . $status . '</li>
              <li class="list-group-item">Country:' . $country . '</li>
              <li class="list-group-item">Flag:' . $fl . '</li>
            </ul>
            <div class="card-body">
              <a href="' . $url . '" class="card-link" target="_blank">Project URL</a>
              <a href="' . $p_url . '" class="card-link" target="_blank">Bid</a>
              <a href="' . $multi_bid . '" class="card-link" target="_blank">MultiBid</a>
            </div>
          </div>';    

        }

    }


    public function checkNewProjects($query)
    {
        // Fetch the projects
        $response = $this->fetch($query);
        //$response = $this->fetch_all('');

        // Parse the response as JSON
        $data = json_decode($response, true);

        // Check if there are any projects
        if (isset($data['result']['projects']) && !empty($data['result']['projects'])) {
            $projects = $data['result']['projects'];

            // Count the number of projects
            $projectCount = 0;

            // Display the list of projects and check if proposed
        
            foreach ($projects as $project) {
                // Check if you have proposed on the project
                if (!($this->proposed_checkup($project['id']))) {

                
                    $client_id = $project['owner_id'];
                    $pid = $project['id'];
                    $title = $project['title'];
                    $flag = json_encode($project['upgrades']);

                    $details=json_encode($projects);
                
                    $link = "https://www.freelancer.com/projects/" . $project['id'] . ".html";
                    $status="new";
                    $max_bg = $project['budget']['minimum'];
                    $min_bg = $project['budget']['minimum'];

                

                    $type = $project['type'];

                //   $this->storeProjects($pid,$client_id,$status,$link,$max_bg,$min_bg,$type);

                

                }
            }

            // Display the project count
            echo "Total projects: " . $pid . "<br>";
            echo "Total new projects: " . $title . "<br>";
            echo "Total new client: " . $client_id . "<br>";
            echo "Link: <a href=" .$link . " target='_blank'>View</a><br>";
        } 
    }



    //Write a function to fetch the project by api call and create feeder from the API calling result
    public function projects($query)
    {
        // Fetch the projects
        $response = $this->fetch($query);
        //$response = $this->fetch_all('');

        // Parse the response as JSON
        //$data = json_decode($response, true);
        $data = json_decode($response);

        // Check if there are any projects
        if (isset($data['result']['projects']) && !empty($data['result']['projects'])) {
            $projects = $data['result']['projects'];

            // Count the number of projects
            $projectCount = 0;

            // Display the list of projects and check if proposed
        
            foreach ($projects as $project) {
                // Check if you have proposed on the project
                    $client_id = $project['owner_id'];
                    $pid = $project['id'];
                    $title = $project['title'];
                    $flag = json_encode($project['upgrades']);
                    $details=json_encode($projects);
                    $link = "https://www.freelancer.com/projects/" . $project['id'] . ".html";
                    $status="new";
                    $max_bg = $project['budget']['minimum'];
                    $min_bg = $project['budget']['minimum'];
                    $charges = $min_bg;
                    $type = $project['type'];
                    $this->createBid($pid, $charges, $title, $this->bidder, $this->duration);
    
            }    
        } 
    }

    
    
    


    public function proposal(){
    
    echo '
        <div class="card shadow" style="width: 100%;">
            <div class="card-body">
              <textarea class="">'. $this->msg .'</textarea>
            </div>
          </div>
    
        ';
    
    }


    public function project_details($pid){

        $url = "https://www.freelancer.com/api/projects/0.1/projects/".$pid."/";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        //var_dump($resp);


        $obj = json_decode($resp);

        $project = $obj->result;

        $pid = $project->id;
        $min_bg = $project->budget->minimum;
        $max_bg = $project->budget->maximum;
        $title = $project->title;
        $seo_url = $project->seo_url;

        $charges = $min_bg;

        $arr = array($charges, $title);

        return $arr;

        
    
    }


    public function fetch_elite_projects($pid) {
        $url = "https://www.freelancer.com/api/projects/0.1/projects/".$pid."/";
        $resp = $this->api_call($url);
        $obj = json_decode($resp);
        $project = $obj->result;
    
        $upgrades = [
            'NDA' => $project->upgrades->NDA,
            'ip_contract' => $project->upgrades->ip_contract,
            'featured' => $project->upgrades->featured,
            'sealed' => $project->upgrades->sealed,
            'urgent' => $project->upgrades->urgent,
            'qualified' => $project->upgrades->qualified,
            'assisted' => $project->upgrades->assisted,
            'active_prepaid_milestone' => $project->upgrades->active_prepaid_milestone,
            'success_bundle' => $project->upgrades->success_bundle,
            'non_compete' => $project->upgrades->non_compete,
            'project_management' => $project->upgrades->project_management,
            'pf_only' => $project->upgrades->pf_only,
            'recruiter' => $project->upgrades->recruiter,
            'listed' => $project->upgrades->listed,
            'extend' => $project->upgrades->extend,
            'unpaid_recruiter' => $project->upgrades->unpaid_recruiter,
        ];
    
        // Filter the upgrades array to keep only those with a value of 1
        $flags = array_filter($upgrades, function($value) {
             $value == 1;
        });


        //return the flag 
        return $flags;


        

        

    

    }
    

    //Create a function to store the fetched projects in the database
    public function storeProjects($projectId,$client_id,$status,$link,$max_bg,$min_bg,$type)
    {
        //check if the project is already stored in the database
        if (!$this->checkStoredProjects($projectId)) {
        $sql = "INSERT INTO external_projects(project_id, client_id,status,link,max_budget,min_budget,type) 
        VALUES ('$projectId','$client_id','$status', '$link','$max_bg','$min_bg','$type')";
        $result = $this->run_query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
      }
    }

    //write a function to check if the project is already stored in the database

    public function checkStoredProjects($projectId)
    {
        $sql = "SELECT * FROM external_projects WHERE project_id='$projectId' ORDER BY id DESC";
        $result = $this->run_query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function proposed_checkup($projectId)
    {

        $url = "https://www.freelancer.com/api/projects/0.1/bids/?bidders%5B%5D=45214417";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "content-type: application/json",
            "freelancer-oauth-v1:" . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //date_default_timezone_get("America/Los_Angeles");
        $resp = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            $obj = json_decode($resp);
            $bids = $obj->result->bids;
            foreach ($bids as $bid) {
                $bid = $bid->project_id;

                if ($bid == $projectId) {
                    return true;
                } else {
                    return false;
                }


            }
        }

    }

    public function displayProjectFeed($query)
    {
        // Fetch the projects
        $response = $this->fetch($query);

        // Parse the response as JSON
        $data = json_decode($response);

        // Check if there are any projects
        if (isset($data['result']['projects']) && !empty($data['result']['projects'])) {
            $projects = $data['result']['projects'];

            // Display the project feed
            echo '<div class="project-feed">';

            foreach ($projects as $project) {
                $pid = $project['id'];
                $title = $project['title'];
                $description = $project['preview_description'];
                $minBg = $project['budget']['minimum'];
                $maxBg = $project['budget']['maximum'];
                $projectLink = "https://www.freelancer.com/projects/" . $pid . ".html";


                $pid = $project->id;
                $title = $project->title;
                $description = $project->preview_description;

                $min_bg = $project->budget->minimum;

                $charges = $min_bg;


                // Check if the user has proposed on the project
                $proposed = $this->proposed($pid);
                if (!$proposed) {

                    echo '<div class="project-feed-item">';
                    echo '<h3><a href="' . $projectLink . '" target="_blank">' . $title . '</a></h3>';
                    echo '<p>' . $description . '</p>';
                    echo '<p>Budget: $' . $minBg . ' - $' . $maxBg . '</p>';
                    echo '<p>Status: ' . ($proposed ? 'Proposed' : 'New') . '</p>';
                    echo '<button class="bid-button" data-project-id="' . $pid . '">Place Bid</button>';
                    echo '</div>';
                }

                // Generate the project feed item HTML

            }

            echo '</div>'; // Close project-feed container
        } else {
            echo "No projects found.";
        }
    }



    public function createBid($pid, $charges,$bidder,$duration,$title)
    {

        $url = "https://www.freelancer.com/api/projects/0.1/bids/?compact=";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "content-type: application/json",
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '{
         "project_id": ' . $pid . ',
         "bidder_id": ' . $bidder . ',
         "amount": ' . $charges . ',
         "period": ' . $duration . ',
         "milestone_percentage": 100,
         "description":"Hi, I am a professional web developer and I can do this project  ' . $title . ', I have 5 years of experience in web development. I have done many projects like this. I can do this job for you. I can start right now. Please contact me. Thanks"
        }';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if (curl_errno($curl)) {

            echo 'Curl error: ' . curl_error($curl);
        } else {
            $resp = curl_exec($curl);
            return $resp;
        }
    
        
    }


    //Write a function to make single bid on a project

    public function bidOnProject($pid)
    {

        $url = "https://www.freelancer.com/api/projects/0.1/bids/?compact=";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "content-type: application/json",
            "freelancer-oauth-v1: " . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


        $charges=$this->project_details($pid)[0];
        $title=$this->project_details($pid)[1];

        $data = '{
         "project_id": ' . $pid . ',
         "bidder_id": ' . $this->bidder . ',
         "amount": ' . $charges . ',
         "period": ' . $this->duration . ',
         "milestone_percentage": 100,
         "description":"Hi, I am a professional web developer and I can do this project  ' . $title . ', I have 5 years of experience in web development. I have done many projects like this. I can do this job for you. I can start right now. Please contact me. Thanks"
        }';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if (curl_errno($curl)) {

            echo 'Curl error: ' . curl_error($curl);
        } else {
           $resp = curl_exec($curl);
           var_dump($resp);
        }
        
    }

    

    //Write a function to get the store projects from the database 

    public function makebid()
    {
        $sql = "SELECT * FROM external_projects";
        $result = mysqli_query($this->run_query, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $projects = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = $row;
            }
            foreach ($projects as $project) {
                $charges=$project['min_budget'];
                $title=$project['title'];
                $client_id=$project['client_id'];
                $pid=$project['project_id'];

                if (!($this->proposed($pid))) {
                    $res=$this->createBid($pid, $charges, $title, $this->bidder, $this->duration);
                    $result=json_decode($res,true);
                    $status=$result['status'];
                    $status_message=$result['message'];
                    $error_code=$result['error_code'];
                    $request_id=$result['request_id'];
                    $this->storeBidResult($pid,$client_id,$status,$status_message,$error_code,$request_id);
                }
            
            }
            
        } else {
            echo "0 results";
        }
    }

    //Write a function to store the result of the bidding in the database
    public function storeBidResult($projectId,$client_id,$status,$status_message,$error_code,$request_id)
    {
        
        $sql = "INSERT INTO external_projects_bidden(project_id,client_id,status,status_message,error_code,request_id) 
        VALUES ('$projectId', '$client_id','$status','$status_message','$error_code','$request_id')";
        $result = $this->run_query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    //Write a function to check if the project has been proposed

    public function proposed($projectId)
    {
        $sql = "SELECT * FROM external_projects WHERE project_id='$projectId' AND status='success'";
        $result = $this->run_query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }



    //Write a function to bid on the projects that are fetched from the APIs
    public function new_projects($query)
    {
        // Fetch the projects
        $response = $this->fetch_all($query);
        //$response = $this->fetch_all('');

        // Parse the response as JSON
        $data = json_decode($response, true);

        // Check if there are any projects
        if (isset($data['result']['projects']) && !empty($data['result']['projects'])) {
            $projects = $data['result']['projects'];

            // Count the number of projects
            $projectCount = 0;

            // Display the list of projects and check if proposed
        
            foreach ($projects as $project) {
                // Check if you have proposed on the project
            

                
                    $client_id = $project['owner_id'];
                    $pid = $project['id'];
                    $title = $project['title'];
                    $flag = json_encode($project['upgrades']);
                    $details=json_encode($projects);
                    $link = "https://www.freelancer.com/projects/" . $project['id'] . ".html";
                    $status="new";
                    $max_bg = $project['budget']['minimum'];
                    $min_bg = $project['budget']['minimum'];
                    $charges = $min_bg;
                    $type = $project['type'];
                    $this->storeProjects($pid,$client_id,$status,$link,$max_bg,$min_bg,$type);
                    

                
            }

            
        } 
    }



    //Write a function to check destination server status for making the APIs calls

    public function check_server_status()
    {
        $url = "https://www.freelancer.com/api/users/0.1/self/";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "content-type: application/json",
            "freelancer-oauth-v1:" . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //date_default_timezone_get("America/Los_Angeles");
        $resp = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
           var_dump($resp);
            /*
            $obj = json_decode($resp);
            $status = $obj->status;
            if ($status == "error") {
                echo "Server is down";
            } else {
                echo "Server is up";
            }
            */
        }
    }

    public function dst_server()
    {
        $sql = "SELECT * FROM external_projects_bidden";
        $result = $this->run_query($sql);
        $res=$result->fetch_assoc();
        if ($result->num_rows > 0) {
            return $res;
        } else {
            return false;
        }
    }
   


    //Check up the server

    public function server_state(){
        $res=$this->bidding_checkup("php");
        $res=json_decode($res,true);
        return $res['message'];
    }

    //List all the self projects
   


    public function my_projects(){

        $url = "https://www.freelancer.com/api/projects/0.1/self/?status=awarded&role=freelancer";
        $resp=$this->api_call($url);
        $resp=json_decode($resp);
        
        echo $resp['status'];

    }


    public function bidding_checkup($query)
    {
        $resp = $this->fetch($query);
        $obj = json_decode($resp);
        $pros = $obj->result->projects;
        foreach ($pros as $project) {
            $pid = $project->id;
            $min_bg = $project->budget->minimum;
            $title = $project->title;
            $charges = $min_bg;
            $this->createBid($pid, $charges, $title, $this->bidder, $this->duration);
        }
    }

    public function bidding($query)
    {
        $resp = $this->fetch($query);
        $obj = json_decode($resp);
        $pros = $obj->result->projects;
        foreach ($pros as $project) {
            $pid = $project->id;
            $min_bg = $project->budget->minimum;
            $title = $project->title;
            $charges = $min_bg;
            $this->createBid($pid, $charges, $title, $this->bidder, $this->duration);
        }
    }








}