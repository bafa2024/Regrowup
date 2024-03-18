<?php
include 'Controller.php';
include 'Discovery.php';

class Bidding extends Controller
{
    use Discovery;



    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $serverStatus = $this->checkServerStatus();

        if ($serverStatus === "Server is up") {
            $this->checkApiCallAndBidding();
        } else {
            $this->notifyAdmin("Server is down");
            $this->troubleshootSystem();
        }
    }

    public function checkApiCallAndBidding()
    {
        $restricted = $this->checkApiRestriction();

        if ($restricted) {
            sleep(900); // Wait for 15 minutes
            $this->checkApiCallAndBidding();
        } else {
            $this->executeBidding();
        }
    }

    public function executeBidding()
    {
        $newProjects = $this->fetchNewProjects();
        $nonBiddedProjects = $this->filterNonBiddedProjects($newProjects);

        $eliteProjects = $this->filterEliteProjects($nonBiddedProjects);
        $nonEliteProjects = $this->filterNonEliteProjects($nonBiddedProjects);

        $this->storeProjectsInTables($eliteProjects, $nonEliteProjects);

        $this->bidOnNonEliteProjects();

        $this->displayEliteProjects();

        // Rest of the steps...
    }

    public function bidOnNonEliteProjects()
    {
        $nonEliteProjects = $this->fetchAllNonEliteProjects();

        foreach ($nonEliteProjects as $project) {
            $projectId = $project->id;
            $this->placeBidOnProject($projectId);
            $this->storeBiddedProjectAndResults($projectId);
        }
    }

    // Rest of the methods...

    public function notifyAdmin($message)
    {
        $to = "admin@example.com"; // Replace with admin's email
        $subject = "System Notification";
        $txt = $message;
        $headers = "From: System";

        mail($to, $subject, $txt, $headers);
    }

    public function api_call($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "content-type: application/json",
            "freelancer-oauth-v1:" . $this->freelancer_personal_token,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // date_default_timezone_get("America/Los_Angeles");
        $resp = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            return $resp;
        }
    }

    public function fetchNewProjects()
    {
        $query = "your_query"; // Replace with your query
        $url = "https://www.freelancer.com/api/projects/0.1/projects/active/?compact=&min_avg_price=".$this->min_bg_fixed."&limit=".$this->limit."&query=" . $query;

        $resp = $this->api_call($url);

        return $resp;
    }
}

?>
