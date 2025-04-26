<?php



trait Discovery
{

    public $msg = "Hello, It is easy, we can do it on time.  
   with 10+ years of experience in development we can start now, please come to chat, to discuss more.";
    public $working_samples = "
   Working samples:
   https://github.com/Regrowup
   https://ratemypoliticians.org
   http://apihub.cloud
   https://aidispatchsys.net
   https://regrowup.com
   https://stevecrm.regrowup.com
   https://lk.regrowup.xyz
   https://lockhub.app
   https://popupviews.tk";

    public $milestones = "
    Requirements Gathering & Technical Documentation Phase
    Analysis Phase,
    Diagraming  Phase,
    Module design Phase,
    Complete Design Phase,
    Writing Algorithms Phase,
    Writing Code phase,
    Implementation Phase,
    Unit Testing Phase,
    Integration Testing Phase,
    System Testing Phase,
    Installation Phase,
    ";
    public $frameworks = "
    Laravel
    ReactJS
    Django
    SpringBoot
    SpringMVC
    VueJS
    CodeIgniter";
    public $github = "https://github.com/Regrowup";
    public $QA = "
    Defect reject ratio
    Defect rejection ratio is the ratio of total rejection to total production
    Defect leakage ratio defect leakage is the ratio of total possibility of rejection occurrence to the total production.
    How to calculate= Defect rejection ratio:
    (No. of defects rejected/ total no. of defects raised) X 100
    Defect leakage ratio: (No. of defect missed/total defects of software) X 100";

    public $freelancer_personal_token = "vYIGz354Ag7m96L4A5zjaq9pQitBFf";

    public $freelancer_api_call_url = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=";

    public $freelancer_api_call_url_with_token = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=&page=1&per_page=50&sort_by=date_created&sort_dir=desc&access_token=";

    public $filter = "&limit=10&offset=0&job_status=all";

    public $bidder = "45214417";

    public $contract_type = "hourly";

    public $min_bg_fixed = "";

    public $min_bg_hourly = "20";

    public $limit = "10";
    public $duration = "5";

    public $upwork_rss_link1='https://www.upwork.com/ab/feed/jobs/rss?q=development';

    public $upwork_rss_link2= '&sort=recency&job_type=hourly%2Cfixed
    &contractor_tier=2%2C3&budget=500-999%2C1000-4999%2C5000-%2C500-&verified_payment_only=1&
    hourly_rate=20-&paging=0%3B50&api_params=1&securityToken=fc51bb7e3fe243d888afe540022ed09924d54ef8a75174c1db7a0018b6c9f1ff5a909dd9a2a6b5dc4e3e3b3ea02652cf21e6be9a8ea5c709f79ef212754edef3
    &userUid=1022787933154082816&orgUid=1022787933158277121';
    
    


    public function api_call($url, $method = 'GET', $data = null, $headers = [])
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    if ($method === 'POST') {
        curl_setopt($curl, CURLOPT_POST, true);
        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
    }

    $defaultHeaders = [
        "content-type: application/json",
        "freelancer-oauth-v1: " . $this->freelancer_personal_token,
    ];

    $headers = array_merge($defaultHeaders, $headers);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    // For debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Curl error: ' . curl_error($curl);
        return false;
    } else {
        return $resp;
    }
}



    public function fetch($query)
    {
        
        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&min_avg_price=".$this->min_bg_fixed."&limit=".$this->limit."&query=" . $query;
        
        $resp = $this->api_call($url);

        var_dump($resp);
        
        //return $resp;

    }

    public function fetch_all2($query, $limit)
    {
        // Initialize an empty array to store project details
        $all_project_details = [];
    
        // Construct API URL with query and limit parameters
        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&min_avg_price=" . $this->min_bg_fixed . "&limit=" . $limit . "&query=" . $query;
    
        // Perform the API call
        $resp = $this->api_call($url);
    
        // Parse the API response to a JSON object
        $obj = json_decode($resp);
    
        // Check for errors in API response
        if ($obj->status !== 'success' || !isset($obj->result->projects)) {
            return false; // or handle the error as you prefer
        }
    
        // Extract projects from the parsed object
        $pros = $obj->result->projects;
    
        // Loop through each project
        foreach ($pros as $project) {
             // Explicitly define each key-value pair as a variable
            $id = $project->id;
            $owner_id = $project->owner_id;
            $title = $project->title;
            $status = $project->status;
            $seo_url = $project->seo_url;
            $currency_id = $project->currency->id;
            $currency_code = $project->currency->code;
            $currency_sign = $project->currency->sign;
            $submitdate = $project->submitdate;
            $preview_description = $project->preview_description;
            $deleted = $project->deleted;
            $nonpublic = $project->nonpublic;
            $hidebids = $project->hidebids;
            $type = $project->type;
            $bidperiod = $project->bidperiod;
            $budget_minimum = $project->budget->minimum;
            $budget_maximum = $project->budget->maximum;
            $featured = $project->featured;
            $urgent = $project->urgent;
            $bid_count = $project->bid_stats->bid_count;
            $time_submitted = $project->time_submitted;
            $time_updated = $project->time_updated;
            $upgrades = $project->upgrades; // This is an object, you might want to convert it to a JSON string or handle it differently
            $language = $project->language;
            $hireme = $project->hireme;
            $frontend_project_status = $project->frontend_project_status;
            $location_country = $project->location->country; // This is an object, you might want to convert it to a JSON string or handle it differently
            $true_location_country = $project->true_location->country; // This is an object, you might want to convert it to a JSON string or handle it differently
            $local = $project->local;
            $negotiated = $project->negotiated;
            $time_free_bids_expire = $project->time_free_bids_expire;
            $pool_ids = $project->pool_ids; // This is an array, you might want to convert it to a JSON string or handle it differently
            $enterprise_ids = $project->enterprise_ids; // This is an array, you might want to convert it to a JSON string or handle it differently
            $is_escrow_project = $project->is_escrow_project;
            $is_seller_kyc_required = $project->is_seller_kyc_required;
            $is_buyer_kyc_required = $project->is_buyer_kyc_required;
            $enterprises = $project->enterprises; // This is an array, you might want to convert it to a JSON string or handle it differently
            $project_reject_reason = $project->project_reject_reason; // This is an object, you might want to convert it to a JSON string or handle it differently

            $project_details = array(
                'id' => $id,
                'owner_id' => $owner_id,
                'title' => $title,
                'status' => $status,
                'seo_url' => $seo_url,
                'currency_id' => $currency_id,
                'currency_code' => $currency_code,
                'currency_sign' => $currency_sign,
                'submitdate' => $submitdate,
                'preview_description' => $preview_description,
                'deleted' => $deleted,
                'nonpublic' => $nonpublic,
                'hidebids' => $hidebids,
                'type' => $type,
                'bidperiod' => $bidperiod,
                'budget_minimum' => $budget_minimum,
                'budget_maximum' => $budget_maximum,
                'featured' => $featured,
                'urgent' => $urgent,
                'bid_count' => $bid_count,
                'time_submitted' => $time_submitted,
                'time_updated' => $time_updated,
                'upgrades' => $upgrades,
                'language' => $language,
                'hireme' => $hireme,
                'frontend_project_status' => $frontend_project_status,
                'location_country' => $location_country,
                'true_location_country' => $true_location_country,
                'local' => $local,
                'negotiated' => $negotiated,
                'time_free_bids_expire' => $time_free_bids_expire,
                'pool_ids' => $pool_ids,
                'enterprise_ids' => $enterprise_ids,
                'is_escrow_project' => $is_escrow_project,
                'is_seller_kyc_required' => $is_seller_kyc_required,
                'is_buyer_kyc_required' => $is_buyer_kyc_required,
                'enterprises' => $enterprises,
                'project_reject_reason' => $project_reject_reason
            );
    
            // Add the project details to the array of all project details
            $all_project_details[] = $project_details;
        }
    
        print_r($all_project_details);

    }

    public function fetch_all($query, $limit)
{
    // Initialize an empty array to store project details
    $all_project_details = [];

    // Construct API URL with query and limit parameters
    $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&min_avg_price=" . $this->min_bg_fixed . "&limit=" . $limit . "&query=" . $query;

    // Perform the API call
    $resp = $this->api_call($url);

    // Parse the API response to a JSON object
    $obj = json_decode($resp);

    // Check for errors in API response
    if ($obj->status !== 'success' || !isset($obj->result->projects)) {
        return false; // or handle the error as you prefer
    }

    // Extract projects from the parsed object
    $pros = $obj->result->projects;

    // Loop through each project
    foreach ($pros as $project) {
        $id = $project->id;
            $owner_id = $project->owner_id;
            $title = $project->title;
            $status = $project->status;
            $seo_url = $project->seo_url;
            $currency_id = $project->currency->id;
            $currency_code = $project->currency->code;
            $currency_sign = $project->currency->sign;
            $submitdate = $project->submitdate;
            $preview_description = $project->preview_description;
            $deleted = $project->deleted;
            $nonpublic = $project->nonpublic;
            $hidebids = $project->hidebids;
            $type = $project->type;
            $bidperiod = $project->bidperiod;
            $budget_minimum = $project->budget->minimum;
            $budget_maximum = $project->budget->maximum;
            $featured = $project->featured;
            $urgent = $project->urgent;
            $bid_count = $project->bid_stats->bid_count;
            $time_submitted = $project->time_submitted;
            $time_updated = $project->time_updated;
            $upgrades = $project->upgrades; // This is an object, you might want to convert it to a JSON string or handle it differently
            $language = $project->language;
            $hireme = $project->hireme;
            $frontend_project_status = $project->frontend_project_status;
            $location_country = $project->location->country; // This is an object, you might want to convert it to a JSON string or handle it differently
            $true_location_country = $project->true_location->country; // This is an object, you might want to convert it to a JSON string or handle it differently
            $local = $project->local;
            $negotiated = $project->negotiated;
            $time_free_bids_expire = $project->time_free_bids_expire;
            $pool_ids = $project->pool_ids; // This is an array, you might want to convert it to a JSON string or handle it differently
            $enterprise_ids = $project->enterprise_ids; // This is an array, you might want to convert it to a JSON string or handle it differently
            $is_escrow_project = $project->is_escrow_project;
            $is_seller_kyc_required = $project->is_seller_kyc_required;
            $is_buyer_kyc_required = $project->is_buyer_kyc_required;
            $enterprises = $project->enterprises; // This is an array, you might want to convert it to a JSON string or handle it differently
            $project_reject_reason = $project->project_reject_reason; // This is an object, you might want to convert it to a JSON string or handle it differently


        // Handle upgrades sub-array
        $upgrades = array(
            'featured' => $project->upgrades->featured,
            'sealed' => $project->upgrades->sealed,
            'nonpublic' => $project->upgrades->nonpublic,
            'fulltime' => $project->upgrades->fulltime,
            'urgent' => $project->upgrades->urgent,
            'qualified' => $project->upgrades->qualified,
            'NDA' => $project->upgrades->NDA,
            'ip_contract' => $project->upgrades->ip_contract,
            'non_compete' => $project->upgrades->non_compete,
            'project_management' => $project->upgrades->project_management,
            'pf_only' => $project->upgrades->pf_only,
            'premium' => $project->upgrades->premium,
            'enterprise' => $project->upgrades->enterprise
        );

        $project_details = array(
            'id' => $id,
            'owner_id' => $owner_id,
            'title' => $title,
            'status' => $status,
            'seo_url' => $seo_url,
            'currency_id' => $currency_id,
            'currency_code' => $currency_code,
            'currency_sign' => $currency_sign,
            'submitdate' => $submitdate,
            'preview_description' => $preview_description,
            'deleted' => $deleted,
            'nonpublic' => $nonpublic,
            'hidebids' => $hidebids,
            'type' => $type,
            'bidperiod' => $bidperiod,
            'budget_minimum' => $budget_minimum,
            'budget_maximum' => $budget_maximum,
            'featured' => $featured,
            'urgent' => $urgent,
            'bid_count' => $bid_count,
            'time_submitted' => $time_submitted,
            'time_updated' => $time_updated,
            'upgrades' => $upgrades,
            'language' => $language,
            'hireme' => $hireme,
            'frontend_project_status' => $frontend_project_status,
            'location_country' => $location_country,
            'true_location_country' => $true_location_country,
            'local' => $local,
            'negotiated' => $negotiated,
            'time_free_bids_expire' => $time_free_bids_expire,
            'pool_ids' => $pool_ids,
            'enterprise_ids' => $enterprise_ids,
            'is_escrow_project' => $is_escrow_project,
            'is_seller_kyc_required' => $is_seller_kyc_required,
            'is_buyer_kyc_required' => $is_buyer_kyc_required,
            'enterprises' => $enterprises,
            'project_reject_reason' => $project_reject_reason
        );

        // Add the project details to the array of all project details
        $all_project_details[] = $project_details;
    }

    //print_r($all_project_details);
    //print_r($upgrades);

    
}

    



     public function notifiy_admin(){
            
            $to = "system@wheeleder.com";
            $subject = "System is not working fine, please check it out";
            $txt = "System is not working fine, please check it out";
            $headers = "From:System";

            mail($to,$subject,$txt,$headers);

     }



    public function filterCountry($country)
    {

        if ($country == "IN") {

            $res = 0;

        } elseif ($country == "PK") {

            $res = 0;

        } else {

            $res = 1;
        }

        return $res;

    }

    public function bids_history()
{
    $url = "https://www.freelancer.com/api/projects/0.1/bids/?bidders%5B%5D=".$this->bidder;
    $resp = $this->api_call($url);
    $obj = json_decode($resp);
    $bids = $obj->result->bids;

    // Start the table outside the loop
    echo '<table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Bid Submit Time</th>
                <th scope="col">Bid Id</th>
                <th scope="col">Project Id</th>
                <th scope="col">Project Owner ID</th>
                <th scope="col">Project Link</th>
            </tr>
        </thead>
        <tbody>';

    // Loop only creates rows
    foreach ($bids as $bid) {
        echo '<tr>
            <th scope="row">'.date("Y-m-d h:i:s", $bid->submitdate).'</th>
            <td>'.$bid->id.'</td>
            <td>'.$bid->project_id.'</td>
            <td>'.$bid->project_owner_id.'</td>
            <td><a href="https://www.freelancer.com/projects/'.$bid->project_id.'.html" target="_blank">Project Link</a></td>
        </tr>';
    }

    // Close the table after the loop
    echo '</tbody></table>';
}


    public function checkStoredProjects($projectId,$table)
    {
        $sql = "SELECT * FROM '.$table.' WHERE project_id='$projectId' ORDER BY id DESC";
        $result = $this->run_query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function ref_users($user_id)
    {
        $url = "https://www.freelancer.com/api/users/0.1/users/" . $user_id . "/";
        $resp = $this->api_call($url);
        $res = json_decode($resp);

        // Extracting user details
        $id=$res->result->id;
        $username=$res->result->username;
        $closed = $res->result->closed;
        $is_active = $res->result->is_active;
        $force_verify = $res->result->force_verify;
        $avatar = $res->result->avatar;
        $email = $res->result->email;
        $reputation = $res->result->reputation;
        $jobs = $res->result->jobs;
        $hourly_rate = $res->result->hourly_rate;
        $registration_date = $res->result->registration_date;
        $limited_account = $res->result->limited_account;
        $display_name = $res->result->display_name;
        $tagline = $res->result->tagline;
        $location_country = $res->result->location->country->name;
        $location_city = $res->result->location->city;
        $latitude = $res->result->location->latitude;
        $longitude = $res->result->location->longitude;
        $avatar_large = $res->result->avatar_large;
        $role = $res->result->role;
        $chosen_role = $res->result->chosen_role;
        $public_name = $res->result->public_name;
        $company = $res->result->company;
        //complete status fields
        $user_details = array(
            'closed' => $closed,
            'is_active' => $is_active,
            'force_verify' => $force_verify,
            'avatar' => $avatar,
            'email' => $email,
            'reputation' => $reputation,
            'jobs' => $jobs,
            'hourly_rate' => $hourly_rate,
            'registration_date' => $registration_date,
            'limited_account' => $limited_account,
            'display_name' => $display_name,
            'tagline' => $tagline,
            'location_country' => $location_country,
            'location_city' => $location_city,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'avatar_large' => $avatar_large,
            'role' => $role,
            'chosen_role' => $chosen_role,
            'public_name' => $public_name,
            'company' => $company
        );

        print_r($user_details);



    }

    



    public function ref_signup($first_name,$last_name,$role,$email,$ref,$password,$profile_status,$default_app){
    
        $sql="INSERT INTO users (first_name,last_name,role,email,referral_code,password,profile_status,default_app) 
        VALUES ('$first_name','$last_name','$role','$email','$ref','$password','$profile_status','$default_app')";
        $results=$this->run_query($sql);
        if($results){
            return true;
        }else{
            return false;
        }    
    }






    public function filterBudget($min_bg, $type)
    {
        if ($type == "fixed") {

            if ($min_bg < 250) {

                $res = 0;

            } elseif ($min_bg >= 250) {

                $res = 1;
            }

            return $res;

        } elseif ($type == "hourly") {

            if ($min_bg < 15) {

                $res = 0;

            } elseif ($min_bg >= 15) {

                $res = 1;
            }

            return $res;


        }
    }

    

    public function eliteProjects($upgrades)
    {
        /*
        $upgrades_featured = $project->upgrades->featured;
            $upgrades_sealed = $project->upgrades->sealed;
            $upgrades_nonpublic = $project->upgrades->nonpublic;
            $upgrades_fulltime = $project->upgrades->fulltime;
            $upgrades_urgent = $project->upgrades->urgent;
            $upgrades_qualified = $project->upgrades->qualified;
            $upgrades_ndas = $project->upgrades->NDA;
            $upgrades_ip_contract = $project->upgrades->ip_contract;
            $upgrades_noncompete = $project->upgrades->noncompete;
            $upgrades_project_management = $project->upgrades->project_management;
            $upgrades_pf_only = $project->upgrades->pf_only;
            $upgrades_premium = $project->upgrades->premium;
            $upgrades_enterprise = $project->upgrades->enterprise;
            $upgrades_recruiter = $project->upgrades->recruiter;
        
        if ($pf_only == true or $nda == true or $ip_contract == true) {
            $res = 1;
            $tag = 'PF , NDA , IP Contract';
            $arr_res = array($tag, $res);
            
        } elseif ($nda == true) {

            $res = 1;
            $tag = 'NDA';
            $arr_res = array($tag, $res);
            
        } elseif ($ip_contract == true) {

            $res = 1;
            $tag = 'Need IP Contract';
            $arr_res = array($tag, $res);
            
        } elseif ($pf_only == true) {
            $res = 1;
            $tag = 'PF Only';
            $arr_res = array($tag, $res);
            
        }

        return $arr_res;
        */

    }


    public function upwork_projects(){
    
        $rss_link1 = 'https://www.upwork.com/ab/feed/jobs/rss?sort=recency&subcategory2_uid=531770282584862733&contractor_tier=1%2C2%2C3&paging=0%3B10&api_params=1&q=&securityToken=fc51bb7e3fe243d888afe540022ed09924d54ef8a75174c1db7a0018b6c9f1ff5a909dd9a2a6b5dc4e3e3b3ea02652cf21e6be9a8ea5c709f79ef212754edef3&userUid=1022787933154082816&orgUid=1022787933158277121';
        $rss = simplexml_load_file($rss_link1);

        foreach ($rss->channel->item as $item) {

            $item->title;

            $ar_milestones = explode(",", $this->milestones);
            foreach ($ar_milestones as $mls) {
                $ml = $mls;
            }
            $joblink = $item->link;

            //$joblink=trim($joblink);
            $mm = strpbrk($joblink, "~");
            $m2 = strpbrk($mm, "?");
            $fm = chop($mm, $m2);
            
            echo '<h4><a href="' . $item->link . '" target="_blank" onmouseover="myFunction()">' . $item->title . "</a></h4>";
            echo "<p>" . $item->description . "</p>";
            echo '<textarea rows="10" cols="80">'.$this->msg.'</textarea>';
            echo '<textarea rows="10" cols="80">'.$this->working_samples.'</textarea>';
            echo '<textarea rows="10" cols="80">'.$this->milestones.'</textarea>';
            echo '<textarea rows="3" cols="80">'.$this->github.'</textarea>';
            echo '<textarea rows="10" cols="80">'.$this->frameworks.'</textarea>';
            echo '<textarea rows="10" cols="80">'.$this->QA.'</textarea>';
    
        }

    }



    



    




}