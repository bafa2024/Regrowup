<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/pool/libs/controllers/Controller.php';
include 'Discovery.php';
/*

 Auto Bidding in Freelancer.com Complete Algorithm
 

    A:If the system is working fine:
    --------------------------------

       1-a-Check the API Call and Bidding

         1-a-1-If restricted run the check again after 15 minutes

       1-b-If not restricted:

         Step1-Fetch the new projects data from the API, and filter non-bidded projects
      
         Step2-Filter the projects to elite and non-elite projects

         Step3-Store the elite projects in the elite table & non-elite projects in the non-elite table

            Step3-a-Fetch all the non-elite projects from the non-elite table

            Step3-a-1-Bid on the non-elite projects

            Step3-a-2-Store the bidded projects in the bidded table & bidding results in the bidding table

          Step3-b-Fetch all the elite projects from the elite table

            Step3-b-1-Display the elite projects in home page

            Step3-b-2-Click on the elite projects to bid on them

            Step3-b-3-Store the bidded projects in the bidded table & bidding results in the bidding table

           
    B-If the system is not working and bids are not place 
    -----------------------------------------------------

       B-1-Notifiy the admin by sending an email

       B-2-Troubleshoot the system and find the problem

       B-3-Send the problem reason and notify the admin by sending an email

       B-4-If the problem is not solved, notify the admin by sending an email
*/
class Autowork extends Controller
{

  use Discovery;
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
  
  public function fetch($query)
  {

    $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&min_avg_price=" . $this->min_bg_fixed . "&limit=" . $this->limit . "&query=" . $query;

    $resp = $this->api_call($url);

    //var_dump($resp);

    return $resp;

  }

  public function project_details($pid)
  {

    $url = "https://www.freelancer.com/api/projects/0.1/projects/" . $pid . "/";

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

          $details = json_encode($projects);

          $link = "https://www.freelancer.com/projects/" . $project['id'] . ".html";
          $status = "new";
          $max_bg = $project['budget']['minimum'];
          $min_bg = $project['budget']['minimum'];



          $type = $project['type'];

          $this->storeProjects($pid, $client_id, $status, $link, $max_bg, $min_bg, $type);



        }
      }

      // Display the project count
      echo "Total projects: " . $pid . "<br>";
      echo "Total new projects: " . $title . "<br>";
      echo "Total new client: " . $client_id . "<br>";
      echo "Link: <a href=" . $link . " target='_blank'>View</a><br>";
    }
  }

  public function storeProjects($projectId, $client_id, $status, $link, $max_bg, $min_bg, $type)
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
        $details = json_encode($projects);
        $link = "https://www.freelancer.com/projects/" . $project['id'] . ".html";
        $status = "new";
        $max_bg = $project['budget']['minimum'];
        $min_bg = $project['budget']['minimum'];
        $charges = $min_bg;
        $type = $project['type'];
        $this->createBid($pid, $charges, $title, $this->bidder, $this->duration);

      }
    }
  }

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

  

  //Write a function to get the store projects from the database 

  public function makebid()
  {
    $sql = "SELECT * FROM external_projects";
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

        if (!($this->proposed($pid))) {
          $res = $this->createBid($pid, $charges, $title, $this->bidder, $this->duration);
          $result = json_decode($res, true);
          $status = $result['status'];
          $status_message = $result['message'];
          $error_code = $result['error_code'];
          $request_id = $result['request_id'];
          $this->storeBidResult($pid, $client_id, $status, $status_message, $error_code, $request_id);
        }

      }

    } else {
      echo "0 results";
    }
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
        $details = json_encode($projects);
        $link = "https://www.freelancer.com/projects/" . $project['id'] . ".html";
        $status = "new";
        $max_bg = $project['budget']['minimum'];
        $min_bg = $project['budget']['minimum'];
        $charges = $min_bg;
        $type = $project['type'];
        $this->storeProjects($pid, $client_id, $status, $link, $max_bg, $min_bg, $type);



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
    $res = $result->fetch_assoc();
    if ($result->num_rows > 0) {
      return $res;
    } else {
      return false;
    }
  }

  //Check up the server
  public function server_state()
  {
    $res = $this->bidding_checkup("php");
    $res = json_decode($res, true);
    return $res['message'];
  }

  //List all the self projects



  public function my_projects()
  {

    $url = "https://www.freelancer.com/api/projects/0.1/self/?status=awarded&role=freelancer";
    $resp = $this->api_call($url);
    $resp = json_decode($resp);

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