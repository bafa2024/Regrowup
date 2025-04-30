<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/pool/libs/controllers/Controller.php';
include 'Discovery.php';

class Autowork extends Controller{
    use Discovery;

    public function get_projects_data(){

        // List of queries to search for
       $queries = [
     // Programming Languages and Frameworks
     "PHP", "Javascript", "Reactjs", "Vuejs", "Python", "Java", "Nodejs", "Expressjs", "Django", "Flask",
     "Nextjs", "Nuxtjs", "Spring", "Springboot", "Springmvc", "Graphql", "Restfulapi", "Restapi",
     "Kotlin", "Swift", "C#", "C++", "ASP.NET", "Laravel", "Symfony", "CodeIgniter",
     "GoLang", "Ruby on Rails", "Perl",
 
     // Mobile App Development
     "Android", "iOS", "Flutter", "React Native", "SwiftUI", "Objective-C", "Xamarin",
 
     // Cloud and DevOps
     "AWS", "Azure", "Google Cloud", "Firebase", "Docker", "Kubernetes", "CI/CD Pipelines", "Serverless",
 
     // Artificial Intelligence and Data Science
     "ChatGPT", "OpenAI", "Machine Learning", "Deep Learning", "NLP", "Tensorflow", "Pytorch", "Data Analysis",
 
     // Blockchain and Web3
     "Blockchain", "Ethereum", "Smart Contracts", "Solidity", "NFT Development", "Web3.js",
 
     // UI/UX and Frontend Technologies
     "TailwindCSS", "Bootstrap", "SASS", "Figma", "Adobe XD", "UI/UX Design",
 
     // Digital Marketing
     "Digital Marketing", "Social Media Marketing", "Facebook Marketing", "Instagram Marketing",
     "SEO", "SEM", "Content Marketing", "Email Marketing", "Affiliate Marketing",
     "YouTube Marketing", "LinkedIn Marketing", "Pinterest Marketing",
 
     // Content Creation
     "Blog Writing", "Copywriting", "Technical Writing", "Video Editing", "Podcast Editing", "Graphics Design",
 
     // E-commerce
     "Shopify Development", "WooCommerce", "Magento", "BigCommerce",
 
     // Cybersecurity
     "Penetration Testing", "Vulnerability Assessment", "Security Audits",
     "Security Consulting", "Application Security", "Cloud Security", "Network Security",
     "Security Operations Center (SOC)", "Threat Intelligence", "Endpoint Protection",
     "Identity and Access Management (IAM)", "Data Loss Prevention (DLP)",
     "SIEM (Security Information and Event Management)", "Compliance Audits (GDPR, HIPAA, PCI DSS)",
     "Phishing Protection", "Ransomware Protection", "Incident Response", "Risk Assessment",
     "Zero Trust Architecture", "Firewall Management", "Intrusion Detection and Prevention Systems (IDS/IPS)"
     ];
 
         // Loop over each query
         foreach ($queries as $query) {
           if($this->fetch_new_projects($query)){
             echo "New Projects Stored";
           }
         }
     }

     public function bid_on_projects()
     {
         $sql = "SELECT * FROM allprojects ORDER BY id DESC";
         $result = $this->run_query($sql);
 
         while ($result && $res = mysqli_fetch_array($result)) {
             //check if the project is already bidded by calling proposed_checkup function
         $pid = $res['project_id'];
         $client_id = $res['client_id'];
         $min_bg = $res['min_budget'];
         $max_bg = $res['max_budget'];
         $title = $res['title'];
         $link = $res['link'];
         $type = $res['type'];
         $wproject = $res['whole_project'];
         $status = $res['status'];
 
         $bidded=$this->proposed_checkup($pid);
         if ($bidded) {
             echo "Hey, you already bidded on this project: ".$pid."<br>";
         } else {
             echo "No, this is a new project: ".$pid."<br>";
            $bd=$this->bidOnProject($pid);
            if($bd==true){
             echo "Bid placed successfully on project: ".$pid."<br>";
               }else{
                 echo "Bid failed on project: ".$pid."<br>";
               }
 
             //$this->storeBidResult($pid, $client_id, $status, $link, $max_bg, $min_bg, $type, $wproject);
         }
 
         }
     
     }

     /*=====================================================================================================*/

   
     public function makebid_normal()
    {
      $sql = "SELECT * FROM allprojects";
      $result = mysqli_query($this->db, $sql);
  
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $projects = array();
        while ($row = mysqli_fetch_assoc($result)) {
          $projects[] = $row;
        }
        foreach ($projects as $project) {
          $charges = $project['min_budget'];
          $title = $project['title'];
          $client_id = $project['client_id'];
          $pid = $project['project_id'];
            $res = $this->bidOnProject($pid);
            $result = json_decode($res, true);
            $status = $result['status'];
            $status_message = $result['message'];
            $error_code = $result['error_code'];
            $request_id = $result['request_id'];
            $this->storeBidResult($pid, $client_id, $status, $status_message, $error_code, $request_id);
        }
  
      } else {
        echo "0 results";
      }
    }

    //1-a-Check the API Call and Bidding
    public function api_checkup($query)
    {
        $limit=null;
        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&limit=" . $limit . "&query=" . $query;
        // Perform the API call
        $resp = $this->api_call($url);
        // Parse the API response to a JSON object
        $obj = json_decode($resp);
        $status = $obj->status;
        //check if the pros is not null , else display a message system is paused
        if ($status == "success") {    
            return true;
        } else {
            return false;
        }

    }

    //1-a-1-a function to sleep for a while (15 mins)
    public function sleep($time)
    {
        sleep($time);
    }
    /*
    1-b-If not restricted:
         Step1-Fetch the new projects data from the API
    */
    public function fetch_new_projects($query)
    {
        $limit=null;

        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&limit=" . $limit . "&query=" . $query;
        // Perform the API call
        $resp = $this->api_call($url);
        // Parse the API response to a JSON object
        $obj = json_decode($resp);
        $status = $obj->status;
        //check if the pros is not null , else display a message system is paused
        if ($status == "success") {
                // Extract projects from the parsed object
                $pros = $obj->result->projects;
                // Loop through each project
                foreach ($pros as $project) {
                    // Get the project ID
                    $pid = $project->id;
                    $client_id = $project->owner_id;
                    $min_bg = $project->budget->minimum;
                    $max_bg = $project->budget->maximum;
                    $title = $project->title;
                    
                    $seo_url = $project->seo_url;
                    $country = $project->currency->country;
                    $currency = $project->currency->code;
                    $description = $project->preview_description;
                    $link="https://www.freelancer.com/projects/".$pid;
                    $type = $project->type;
                    $wproject= $resp;

                   //$this->storeProjects($pid, $client_id, $status, $link, $max_bg, $min_bg, $type,$wproject);
                   $tag = $this->elites($pid);
                   if($tag=='Normal'){
                       $this->storeProjects($pid, $client_id, $status, $link, $max_bg, $min_bg, $type);
                       echo "Not Elite";
                   }else{
                       echo "Elite";
                       //Store the elite projects in the elite table
                       $this->storeEliteProjects($pid, $client_id, $status, $link, $max_bg, $min_bg, $type, $tag);
                   }

                    
                  
                   /*
                   if(!$this->proposed_checkup($pid)){
                    continue;
                    }
                    if (!$this->filterCountry($country)) {
                        continue;
                    }
    
                    //filtering the project budget
                    if (!$this->filterBudget($min_bg, $type)) {
                        continue;
                    }
                   */
                 // echo $pid."<br>";
    
                    
                }
    
        }else{
            echo "The system is paused, please try again later";
        } 
    }

    //Filter non-bidded projects
    public function proposed_checkup($projectId)
    {
        // API URL to check for bids
        $url = "https://www.freelancer.com/api/projects/0.1/bids/?bidders%5B%5D=45214417";

        // Perform the API call
        $resp = $this->api_call($url);

        // Parse the API response to JSON
        $obj = json_decode($resp);

        // Extract bids from the parsed object
        $bids = $obj->result->bids;

        // Loop through each bid
        foreach ($bids as $bid) {
            // Get project ID of the bid
            $bid_project_id = $bid->project_id;

            // If a bid for the given project is found, return true
            if ($bid_project_id == $projectId) {
                return true;
            }else{
                return false;
            }
        }
        // If no bid for the given project is found, return false
        
    }

    //Step2-Filter the projects to elite and non-elite projects
    public function elites($pid)
    {
  
      $url = "https://www.freelancer.com/api/projects/0.1/projects/" . $pid . "/";
      $resp = $this->api_call($url);
      $obj = json_decode($resp);
      $project = $obj->result;
      //check if the project is null
            $pid = $project->id;
            $upgrades = [
              'Featured' => $project->upgrades->featured,
              'Sealed' => $project->upgrades->sealed,
              'Non Public' => $project->upgrades->nonpublic,
              'Full Time' => $project->upgrades->fulltime,
              'Urgent' => $project->upgrades->urgent,
              'Qualified' => $project->upgrades->qualified,
              'NDA' => $project->upgrades->NDA,
              'Assisted' => $project->upgrades->assisted,
              'Active Prepaid Milestone' => $project->upgrades->active_prepaid_milestone,
              'IP Contract' => $project->upgrades->ip_contract,
              'Success Bundle' => $project->upgrades->success_bundle,
              'Non Compete' => $project->upgrades->non_compete,
              'Project Management' => $project->upgrades->project_management,
              'PF Only' => $project->upgrades->pf_only,
              'Recruiter' => $project->upgrades->recruiter,
              'Listed' => $project->upgrades->listed,
              'Extend' => $project->upgrades->extend,
              'Unpaid Recruiter' => $project->upgrades->unpaid_recruiter,
              'Premium' => $project->upgrades->premium,
              'Enterprise' => $project->upgrades->enterprise
          ];
          // Filter out the upgrades with true values
          $activeUpgrades = array_filter($upgrades, function($value) {
              return $value === true;  // Explicitly check for true values
          });
          if (!empty($activeUpgrades)) {
              $keys = array_keys($activeUpgrades);
              //$tag = 'Full Elite ' . implode(', ', $keys) . '';
              $tag = '' . implode(', ', $keys) . '';
              //return true; 
          } else {
              $tag = 'Normal';
              //return false;
          }
          
          return $tag;
    }
    /*
    Step3-Store the elite projects in the elite table & non-elite projects in the non-elite table
    */
    public function storeEliteProjects($projectId, $client_id, $status, $link, $max_bg, $min_bg, $type, $tag)
    {
        //check if the project is already stored in the database
        if (!$this->checkStoredProjects($projectId, 'external_elite_projects')) {
            $sql = "INSERT INTO external_elite_projects(project_id, client_id,status,link,max_budget,min_budget,type,tag) 
                    VALUES ('$projectId','$client_id','$status', '$link','$max_bg','$min_bg','$type','$tag')";
            $result = $this->run_query($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }
    /*
    Step3-Store the non-elite projects in the non-elite table
    */
    public function storeProjects($projectId, $client_id, $status, $link, $max_bg, $min_bg, $type,$wproject)
    {
        //check if the project is already stored in the database
        if (!$this->checkStoredProjects($projectId, 'allprojects')) {
        $status = $this->connectDb()->real_escape_string($status);
        $link = $this->connectDb()->real_escape_string($link);
         $max_bg = $this->connectDb()->real_escape_string($max_bg);
        $min_bg = $this->connectDb()->real_escape_string($min_bg);
        $type = $this->connectDb()->real_escape_string($type);
        $wproject = $this->connectDb()->real_escape_string($wproject);

            $sql = "INSERT INTO allprojects(project_id, client_id,status,link,max_budget,min_budget,type,whole_project) 
                    VALUES ('$projectId','$client_id','$status', '$link','$max_bg','$min_bg','$type','$wproject')";
            $result = $this->run_query($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function checkStoredProjects($projectId,$table)
    {
        $sql = "SELECT * FROM ".$table." WHERE project_id='$projectId' ORDER BY id DESC";
        $result = $this->run_query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function bid_checkup(){
        $sql = "SELECT * FROM allprojects ORDER BY id DESC";
        $result = $this->run_query($sql);
        $res=$this->mysqli_rows($result);
        //check if the project is already stored in the database
        if ($res) {
            // $status=$result['status'];
            // $this->bidding_result($projectId, $status);
            echo "Hey, you already bidded on this project: ".$pid."<br>";
        } else {
          // $this->storenewProjects($wpproject);
          echo "No, this is a new project: ".$pid."<br>";
        }

      
    }

    //write a function to get all the project details from the database allprojects and then bid on it

   

    //write a function to get all the project details from the database newprojects and then bid on it
    public function get_new_projects()
    {
        $sql = "SELECT * FROM new_projects ORDER BY id DESC";
        $result = $this->run_query($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    
    

    /*
      Step3-a-Fetch all the non-elite projects from the non-elite table

            Step3-a-1-Bid on the non-elite projects

            Step3-a-2-Store the bidded projects in the bidded table & bidding results in the bidding table
    */
  

   
    
    

    //Bidding On Projects
    public function bidOnProject($pid)
    {
        $url = "https://www.freelancer.com/api/projects/0.1/bids/?compact=";
        $charges = $this->project_details($pid)[0];
        $title = $this->project_details($pid)[1];

        $data = '{
        "project_id": ' . $pid . ',
        "bidder_id": ' . $this->bidder . ',
        "amount": ' . $charges . ',
        "period": ' . $this->duration . ',
        "milestone_percentage": 100,
        "description": "Hello,  I checked ' . $title . ' is a good project to work on, with 10+ years of experience in development we are ready to start and deliver it on time, we can disucess the details in chat. Thanks"
         }';

        $resp = $this->api_call($url, 'POST', $data);

        if ($resp) {
           // $this->bidding_result($pid,'success');
            return true;
            

        } else {
           // $this->bidding_result($pid,'bid failed');
            return false;
        }
    }

    public function project_details($pid)
    {
  
      $url = "https://www.freelancer.com/api/projects/0.1/projects/" . $pid . "/";
  
      $resp = $this->api_call($url);
  
      $obj = json_decode($resp);
      $project = $obj->result;
      $pid = $project->id;
      $min_bg = $project->budget->minimum;
      $title = $project->title;
      $charges = $min_bg;
      $arr = array($charges, $title);
  
      return $arr;

    }
    
    //Write a function to store the result of the bidding in the database
    public function storeBidResult($projectId, $client_id, $status, $status_message, $error_code, $request_id)
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

    public function bidding_result($projectId, $status)
    {
        $sql = "INSERT INTO external_projects_bidden(project_id,status,) 
                VALUES ('$projectId','$status')";
        $result = $this->run_query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }
    /*
    Step3-b-Fetch all the elite projects from the elite table

    Step3-b-1-Display the elite projects in home page

    Step3-b-2-Click on the elite projects to bid on them

    Step3-b-3-Store the bidded projects in the bidded table & bidding results in the bidding table
    */

    //Fetch all the elite projects from the elite table

    public function fetch_elite_projects()
    {
      $sql = "SELECT * FROM external_elite_projects";
      $result = mysqli_query($this->db, $sql);
  
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $projects = array();
        while ($row = mysqli_fetch_assoc($result)) {
          $projects[] = $row;
        }
        foreach ($projects as $project) {
            $min_bg = $project['min_budget'];
            $max_budget = $project['max_budget'];
            $title = $project['title'];
            $tag=$project['tag'];
            $type=$project['type'];
            $description = $project['details'];
            $client_id = $project['client_id'];
            $pid = $project['project_id'];
            
            $purl = "https://www.freelancer.com/projects/" . $pid;

              if ($tag == 'NDA') {
                echo '
     <div class="card shadow" style="width: 80%;">
       <div class="card-body">
           <h5 class="card-title">' . $title . '</h5>
           <p class="card-text">' . $description . '</p>
       </div>
       <ul class="list-group list-group-flush">
           <li class="list-group-item">Min Budget: ' . $min_bg . ' </li>
           <li class="list-group-item">Project Type: ' . $type . '</li>
           <li class="list-group-item">Elite: ' . $tag. '</li>
       </ul>
       <div class="card-body">
           <a href="' . $purl . '" class="card-link" target="_blank">Project URL</a>
           <button onclick="makeSingleBid(\'' . $pid . '\')">Bid</button>
       </div>
   </div>';
          }
        }

      } else {
        echo "0 results";
      }
    }

    /*
      B-If the system is not working and bids are not place 
    -----------------------------------------------------

       B-1-Notifiy the admin by sending an email

       B-2-Troubleshoot the system and find the problem

       B-3-Send the problem reason and notify the admin by sending an email

       B-4-If the problem is not solved, notify the admin by sending an email
    */

    //Send an email to the admin

    public function notifyAdmin($email,$message="The system is not working")
    {
        $to = "'.$email.'"; // Replace with admin's email
        $subject = "System Notification";
        $txt = $message;
        $headers = "From: System";
        mail($to, $subject, $txt, $headers);
    }
 

   






}