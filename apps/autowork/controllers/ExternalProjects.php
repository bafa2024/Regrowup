<?php

$path=$_SERVER['DOCUMENT_ROOT'];
//include $path.'/pool/libs/controllers/Controller.php';
include 'Discovery.php';



class Bidding  
{

    use Discovery;
    
    
    public function __construct()
    {
      //  parent::__construct();
    }

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
        "description": "Hi, I am a professional web developer and I can do this project ' . $title . ', I have 5 years of experience in web development. I have done many projects like this. I can do this job for you. I can start right now. Please contact me. Thanks"
         }';

        $resp = $this->api_call($url, 'POST', $data);

        if ($resp) {
            return true;
        } else {
            return false;
        }
    }

    

    // Function to fetch and display projects based on the provided query and limit

    public function feeder_home($query, $limit)
    {
        // Construct API URL with query and limit parameters
        //$url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&min_avg_price=" . $this->min_bg_fixed . "&limit=" . $limit . "&query=" . $query;

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

                // Use proposed_checkup to check if already bidded; if true, skip this project

                // Get various attributes of the project
                $min_bg = $project->budget->minimum;
                $max_bg = $project->budget->maximum;
                $title = $project->title;
                $project_type = $project->type;
                $seo_url = $project->seo_url;
                $country = $project->currency->country;
                $currency = $project->currency->code;
                //by using below parameters we need to filter the upgrade tags if its true then we need to skip the project


                $status = $project->status;
                $description = $project->preview_description;

                if (!$this->filterCountry($country)) {
                    continue;
                }

                //filtering the project budget

                if (!$this->filterBudget($min_bg, $project_type)) {
                    continue;
                }
                // Construct the URL for the project
                $url = "https://www.freelancer.com/projects/" . $pid;

                // Construct the URL for placing a bid
                $p_url = "/mbid?task=mbid&p=" . $pid;

                // Construct the URL for placing a multi-bid
                $multi_bid = "/mbid?task=manybid";

                // HTML template to display project info
                echo '
        <div class="card shadow" style="width: 80%;">
            <div class="card-body">
                <h5 class="card-title">' . $title . '</h5>
                <h7 class="card-title">' . $seo_url . '</h7>
                <p class="card-text">' . $description . '</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Min Budget: ' . $min_bg . ' ' . $currency . '</li>
                <li class="list-group-item">Country: ' . $country . '</li>
                <li class="list-group-item">Project Type: ' . $project_type . '</li>
                <li class="list-group-item">Status: ' . $status . '</li>
                <li class="list-group-item">Max Budget: ' . $max_bg . ' ' . $currency . '</li> 
            </ul>
            <div class="card-body">
                <a href="' . $url . '" class="card-link" target="_blank">Project URL</a>
                <button onclick="makeSingleBid(\'' . $pid . '\')">Bid</button>
                <button onclick="confirmAndMakeManyBids()">MultiBid</button>
            </div>
        </div>';
            }

        } else {
            echo "External System is Down, Please try after sometime";
        }



    }


    //List the Elite Projects
    public function list_elites($query, $limit)
    {
        // Construct API URL with query and limit parameters
         $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&limit=" . $limit . "&query=" . $query;
        //$url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&limit=";
        // Perform the API call
        $resp = $this->api_call($url);

        // Parse the API response to a JSON object
        $obj = json_decode($resp);

        // Extract projects from the parsed object
        $pros = $obj->result->projects;

        //check if the pros is not null , else display a message system is paused
        if ($pros != null) {
            // Loop through each project
            foreach ($pros as $project) {
                // Get the project ID
                $pid = $project->id;
                $min_bg = $project->budget->minimum;
                $max_bg = $project->budget->maximum;
                $title = $project->title;
                $project_type = $project->type;
                $country = $project->currency->country;
                $currency = $project->currency->code;
                //by using below parameters we need to filter the upgrade tags if its true then we need to skip the project

                $elite = $this->elites($pid);

                $status = $project->status;
                $description = $project->preview_description;

                 if(!$this->filterCountry($country)){
                   continue;
                 }
                if(!$this->filterBudget($min_bg,$project_type)){
                    continue;
                }

                $purl = "https://www.freelancer.com/projects/" . $pid;

                // Construct the URL for placing a bid
                $p_url = "/mbid?task=mbid&p=" . $pid;

                // Construct the URL for placing a multi-bid
                $multi_bid = "/mbid?task=manybid";
            
                
                if ($elite != 'Normal') {
                    echo '
       <div class="card shadow" style="width: 80%;">
           <div class="card-body">
               <h5 class="card-title">' . $title . '</h5>
               <p class="card-text">' . $description . '</p>
           </div>
           <ul class="list-group list-group-flush">
               <li class="list-group-item">Min Budget: ' . $min_bg . ' ' . $currency . '</li>
               <li class="list-group-item">Country: ' . $country . '</li>
               <li class="list-group-item">Project Type: ' . $project_type . '</li>
               <li class="list-group-item">Status: ' . $status . '</li>
               <li class="list-group-item">Max Budget: ' . $max_bg . ' ' . $currency . '</li>
               <li class="list-group-item">Elite: ' . $elite . '</li>
           </ul>
           <div class="card-body">
               <a href="' . $purl . '" class="card-link" target="_blank">Project URL</a>
               <button onclick="makeSingleBid(\'' . $pid . '\')">Bid</button>
               <button onclick="confirmAndMakeManyBids()">MultiBid</button>

           </div>
       </div>';
                }

                // HTML template to display project info



            }

        } else {
            echo "External System is Down, Please try after sometime";
        }



    }



    // Function to check if a bid has been proposed for the given project
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
            }
        }
        // If no bid for the given project is found, return false
        return false;
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
    

    public function multibids($limit = 10){

        // List of queries to search for
        $queries = ["Php", "Javascript", "Reactjs","Vuejs","Python","chatgpt","AWS","Java","Django","Flask",
        "Nodejs","Expressjs","Android","Ios","Flutter","ReactNative","Nextjs","Nuxtjs","Spring","Springboot",
        "Springmvc","Restfulapi","Restapi","Graphql"];
       
         //$queries = ["Digital Marketing","Social Media Marketing","Facebook Marketing","Instagram Marketing"];

        // Loop over each query
        foreach ($queries as $query) {
    
            // Build the URL for the API call
            $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=" . $query . "&limit=" . $limit;
    
            // Make the API call
            $resp = $this->api_call($url);
            
            // Check for API call failure
            if (!$resp) {
                echo "API call failed for query: $query";
                continue; // Skip to the next query
            }
    
            // Parse the API response
            $obj = json_decode($resp);
            $pros = $obj->result->projects;
    
            // Loop over each project and make a bid
            foreach ($pros as $project) {
                $pid = $project->id;
                $min_bg = $project->budget->minimum;

                $project_type = $project->type;

                $country = $project->currency->country;

                if(!$this->filterCountry($country)){
                    continue;
                }
        
                  //filtering the project budget
        
                if(!$this->filterBudget($min_bg,$project_type)){
                    continue;
                }

                if (!$this->bidOnProject($pid)) {
                    echo "Bid failed for project ID: $pid";
                }
            }
        }
    }
    


}