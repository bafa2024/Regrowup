<?php
include 'Controller.php';


class DiscoveryController extends Controller
{



    public $msg = "Hello There, It is easy, I can do it on time.  
  I have 7 years of experience in development(websites, web applications, mobile apps, desktop applications UI/UX), using PHP, WordPress, Java, 
  Python, JavaScript, ReactJs, Bootstrap, I can start now, please come to chat, to discuss more.";
    public $working_samples = "
  Working samples:
  https://github.com/abdulfakhri
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
    public $github = "https://github.com/abdulfakhri";
    public $QA = "
   Defect reject ratio
   Defect rejection ratio is the ratio of total rejection to total production
   Defect leakage ratio defect leakage is the ratio of total possibility of rejection occurrence to the total production.
   How to calculate= Defect rejection ratio:
   (No. of defects rejected/ total no. of defects raised) X 100
   Defect leakage ratio: (No. of defect missed/total defects of software) X 100";

    public $upwork_rss_link1 = 'https://www.upwork.com/ab/feed/jobs/rss?q=development';

    public $upwork_rss_link2 = '&sort=recency&job_type=hourly%2Cfixed
   &contractor_tier=2%2C3&budget=500-999%2C1000-4999%2C5000-%2C500-&verified_payment_only=1&
   hourly_rate=20-&paging=0%3B50&api_params=1&securityToken=fc51bb7e3fe243d888afe540022ed09924d54ef8a75174c1db7a0018b6c9f1ff5a909dd9a2a6b5dc4e3e3b3ea02652cf21e6be9a8ea5c709f79ef212754edef3
   &userUid=1022787933154082816&orgUid=1022787933158277121';

    public $freelancer_personal_token = "Q3hP36HlKV4GUgR30YL5EwkuEEBhiY";

    public $freelancer_api_call_url = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=";

    public $freelancer_api_call_url_with_token = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=&page=1&per_page=50&sort_by=date_created&sort_dir=desc&access_token=";



    public function fr_fetched_projects($que)
    {

        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=" . $que . "&limit=10&offset=0&job_status=all";
        //$url = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=".$que."";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Content-Type: application/json",
            "freelancer-oauth-v1: Q3hP36HlKV4GUgR30YL5EwkuEEBhiY",
        );
        $res = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            $obj = json_decode($res);
            $pros = $obj->result->projects;
            foreach ($pros as $project) {
                $ownerId = $project->owner_id;
                $time = date("Y-m-d");
                $pid = $project->id;
                $urgent = $project->urgent;
                $min_bg = $project->budget->minimum;
                $country = $project->currency->country;
                $featured = $project->featured;
                $urgent = $project->urgent;
                $min_bg = $project->budget->minimum;
                //$project_type = $project->project_type->enum;
                $max_bg = $project->budget->maximum;
                $country = $project->currency->country;
                $featured = $project->featured;
                $nda = $project->upgrades->NDA;
                $ip_contract = $project->upgrades->ip_contract;
                $featured = $project->upgrades->featured;
                $sealed = $project->upgrades->sealed;
                $urgent = $project->upgrades->urgent;
                $qualified = $project->upgrades->qualified;
                $assisted = $project->upgrades->assisted;
                $active_prepaid_milestone = $project->upgrades->active_prepaid_milestone;
                $success_bundle = $project->upgrades->success_bundle;
                $non_compete = $project->upgrades->non_compete;
                $project_management = $project->upgrades->project_management;
                $pf_only = $project->upgrades->pf_only;
                $recruiter = $project->upgrades->recruiter;
                $listed = $project->upgrades->listed;
                $extend = $project->upgrades->extend;
                $unpaid_recruiter = $project->upgrades->unpaid_recruiter;
                $projectlink = "https://www.freelancer.com/projects/" . $pid . ".html";

                // $country_check=filterProjectsByCountry($country);

                //if ($country_check==1) {
                //$budget_check=filterProjectsByBudget($min_bg);

                // if ($budget_check==1) {

                //filterEliteProjects($pid, $nda, $ip_contract, $pf_only, $ownerId, $time, $projectlink);

                /*
                $res=$this->fr_send_bid($pid, $min_bg, $ownerId, $time, $this->msg);
                if($res==1){
                echo "Bid sent successfully";
                }else{
                echo "Bid not sent, try again";
                }
                */



                echo $pid . "<br>";

                echo $featured . "<br>";
                echo $urgent . "<br>";
                echo $country . "<br>";
                echo $projectlink . "<br>";


                //   }
                //}
            }
        }
    }


    public function fr_send_bid($pid, $charges, $ownerId, $time, $msg)
    {
        $url = "https://www.freelancer.com/api/projects/0.1/bids/?compact=";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "content-type: application/json",
            "freelancer-oauth-v1: Q3hP36HlKV4GUgR30YL5EwkuEEBhiY",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = '{
    "project_id": ' . $pid . ',
    "bidder_id": 45214417,
    "amount": ' . $charges . ',
    "period": 2,
    "milestone_percentage": 100,
    "description":"' . $msg . '"
    }';
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        // Check if any error occurred
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            return $resp;
        }
        curl_close($curl);
    }




    public function upwork_projects($type)
    {
        $rss_link1 = 'https://www.upwork.com/ab/feed/jobs/rss?q=development&sort=recency&job_type=' . $type . '%2Cfixed&contractor_tier=2%2C3&budget=500-999%2C1000-4999%2C5000-%2C500-&verified_payment_only=1&hourly_rate=20-&paging=0%3B50&api_params=1&securityToken=fc51bb7e3fe243d888afe540022ed09924d54ef8a75174c1db7a0018b6c9f1ff5a909dd9a2a6b5dc4e3e3b3ea02652cf21e6be9a8ea5c709f79ef212754edef3&userUid=1022787933154082816&orgUid=1022787933158277121';

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
            

        
            
        }

    }

    public function freelancer_projects($que)
    {
        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?query=" . $que . "&limit=10&offset=0&job_status=all";
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Content-Type: application/json",
            "freelancer-oauth-v1: Q3hP36HlKV4GUgR30YL5EwkuEEBhiY",
        );
        $res = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            $obj = json_decode($res);
            $pros = $obj->result->projects;
            foreach ($pros as $project) {
                $ownerId = $project->owner_id;
                $time = date("Y-m-d");
                $pid = $project->id;
                $title= $project->title;
                $description = $project->preview_description;
                $urgent = $project->urgent;
                $min_bg = $project->budget->minimum;
                $country = $project->currency->country;
                $featured = $project->featured;
                $urgent = $project->urgent;
                $min_bg = $project->budget->minimum;
                //$project_type = $project->project_type->enum;
                $max_bg = $project->budget->maximum;
                $country = $project->currency->country;
                $featured = $project->featured;
                $nda = $project->upgrades->NDA;
                $ip_contract = $project->upgrades->ip_contract;
                $featured = $project->upgrades->featured;
                $sealed = $project->upgrades->sealed;
                $urgent = $project->upgrades->urgent;
                $qualified = $project->upgrades->qualified;
                $assisted = $project->upgrades->assisted;
                $active_prepaid_milestone = $project->upgrades->active_prepaid_milestone;
                $success_bundle = $project->upgrades->success_bundle;
                $non_compete = $project->upgrades->non_compete;
                $project_management = $project->upgrades->project_management;
                $pf_only = $project->upgrades->pf_only;
                $recruiter = $project->upgrades->recruiter;
                $listed = $project->upgrades->listed;
                $extend = $project->upgrades->extend;
                $unpaid_recruiter = $project->upgrades->unpaid_recruiter;
                $projectlink = "https://www.freelancer.com/projects/" . $pid . ".html";

                
                echo '<h4><a href="' . $projectlink . '" target="_blank" onmouseover="myFunction()">' . $title . "</a></h4>";
                echo "<p>" . $description . "</p>";

                


                //   }
                //}
            }
        }

    }



    public function freelancer_bids_history()
    {

        $url = "https://www.freelancer.com/api/projects/0.1/bids/?bidders%5B%5D=45214417";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "content-type: application/json",
            "freelancer-oauth-v1: P132y9b7cYEnReebsTXpLl7fuc0Vxs",
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
                echo ' <div class="col-sm-12 center_2_inner_main_1">
             <div class="center_2_inner_2">';
                echo "<article>" . "Bid Submit Time: " . date("Y-m-d h:i:s", $bid->submitdate) . "</article>";
                echo "<article>" . "Bid Id: " . $bid->id . "</article>";
                echo "<article>" . "Project Id: " . $bid->project_id . "</article>";
                echo "<article>" . "Project Owner ID: " . $bid->project_owner_id . "</article>";
                echo "Project Link: " . "https://www.freelancer.com/projects/" . $bid->project_id . ".html" . "<br />";
                echo "<a href='https://www.freelancer.com/projects/" . $bid->project_id . ".html' target='_blank'>Project Link</a>";
                echo "<hr>";
                echo '</div>';
                echo '</div>';

            }
        }
    }

    public function fr_filterProjectsByCountry($country)
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

    public function fr_filterProjectsByBudget($min_bg, $type)
    {
        if ($type == "fixed") {

            if ($min_bg < 750) {

                $res = 0;

            } elseif ($min_bg >= 750) {

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

    public function fr_saveProjects_toManualBid($pid, $ownerId, $time, $projectlink, $tag)
    {


        $sql_search = "SELECT * FROM project WHERE pid='$pid'";
        $result_search = $conn->query($sql_search);

        if ($result_search == null) {
            $sql = "INSERT INTO elite_projects(project_id,owner_id,project_time,project_link,tag)VALUES ('$pid','$ownerId','$time','$projectlink','$tag')";
            if (mysqli_query($conn, $sql)) {
                echo "For Biding Manually successfully Recorded" . "<br>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }


        mysqli_close($conn);
    }

    public function fr_saveProjects_forAnalyze($pid, $ownerId, $time, $projectlink, $tag)
    {



        $sql = "INSERT INTO elite_projects(project_id,owner_id,project_time,project_link,tag) VALUES('$pid','$ownerId','$time','$projectlink','$tag')";

        if (mysqli_query($conn, $sql)) {
            echo "For Biding Manually successfully Recorded" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);

    }
    public function fr_filterEliteProjects($pid, $nda, $ip_contract, $pf_only, $ownerId, $time, $projectlink)
    {

        if ($pf_only == true or $nda == true or $ip_contract == true) {
            $res = 1;
            $tag = 'PF , NDA , IP Contract';
            $arr_res = array($tag, $res);
            //saveProjects_toManualBid($pid, $ownerId, $time, $projectlink, $tag);
        } elseif ($nda == true) {

            $res = 1;
            $tag = 'NDA';
            $arr_res = array($tag, $res);
            //saveProjects_toManualBid($pid, $ownerId, $time, $projectlink,$tag);
        } elseif ($ip_contract == true) {

            $res = 1;
            $tag = 'Need IP Contract';
            $arr_res = array($tag, $res);
            //saveProjects_toManualBid($pid, $ownerId, $time, $projectlink,$tag);
        } elseif ($pf_only == true) {
            $res = 1;
            $tag = 'PF Only';
            $arr_res = array($tag, $res);
            //saveProjects_forAnalyze($pid, $ownerId, $time, $projectlink,$tag);
        }



    }

    public function fr_stored_projects()
    {
        $limit = $_GET['limit'];
        $today = date("Y-m-d");
        if ($limit != null) {
            $sql = "SELECT DISTINCT id,project_id,owner_id,project_time,date_reg,project_link FROM elite_projects WHERE project_time='$today' ORDER BY date_reg DESC LIMIT $limit";

        } elseif ($limit == "all") {
            $sql = "SELECT DISTINCT id,project_id,owner_id,project_time,date_reg,project_link FROM elite_projects WHERE project_time='$today' ORDER BY date_reg DESC ";

        } else {
            $sql = "SELECT DISTINCT id,project_id,owner_id,project_time,date_reg,project_link FROM elite_projects WHERE project_time='$today'  ORDER BY date_reg DESC LIMIT 5";
        }
        $result = mysqli_query($conn, $sql);

        echo '
<header>
<form method="get" action="">
    <lable>Select # of Projects</lable>
    <select name="limit">
        <option>#</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
        <option value="60">60</option>
        <option value="70">70</option>
        <option value="80">80</option>
        <option value="90">90</option>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="300">300</option>
        <option value="400">400</option>
        <option value="500">500</option>
        <option value="600">600</option>
        <option value="700">700</option>
        <option value="800">800</option>
        <option value="900">900</option>
        <option value="all">All</option>


    </select>
    <input type="submit" value="Submit">
</form>
</header>';


        while ($row = mysqli_fetch_array($result)) {

            $pid = $row['project_id'];

            echo '<h3><a class="" href="https://www.freelancer.com/projects/' . $row['project_id'] . '.html" target="_blank">Check The Project</h3></a>';
            echo '<h3>' . $row['project_link'] . '</h3>';
            echo '<h3>' . $row['date_reg'] . '</h3>';
            echo '<h3>' . $row['project_id'] . '</h3>';
            echo '<h3><a class="" href="https://www.freelancer.com/NDA/NDAcreator.php?project_id=' . $row['project_id'] . '&type=nda" target="_blank">Sign NDA</h3></a>';
            echo "<textarea class='form-control' id='myInput' rows='10' cols='100'>" . $msg . "</textarea>" . "<br>";
            echo "<button onclick='myFunction()'>Copy Proposal </button>" . "<br>";
            echo "<textarea id='myInput2' rows='' cols='100'>" . $github . "</textarea>" . "<br>";
            echo "<button onclick='copyGithubLink()'>Copy Github</button>" . "<br>";
            echo "<textarea id='myInput3' rows='7' cols='100'>" . $samples . "</textarea>" . "<br>";
            echo "<button onclick='copyGithubLink()'>Copy Github</button>" . "<br>";
            echo "<hr>";
        }

    }





}