<?php
include 'Controller.php';

class AffiliateController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
  
    public function createAffiliateLink($link, $referrerId, $referringCode)
    {
        // Add logic to create the affiliate link in the database
        // You can access the $link, $referrerId, and $referringCode variables here
        // and store them in the affiliate_links table
        
        // Set the referral status to 0
        $referralStatus = 0;
        
        // Example query using $this->run_query->query()
        $query = "INSERT INTO affiliate_links (link, referring_code, referrer_id, referral_status) VALUES ('$link', '$referringCode', $referrerId, $referralStatus)";
        $this->run_query->query($query);
        
        // You can perform additional actions, such as error handling or validation, as needed
        
        // Return the ID of the inserted row if desired
        $insertedId = $this->run_query->insert_id;
        return $insertedId;
    }
    
  
    public function getReferringCodeAndId()
    {
        // Add logic to retrieve the referring code and referring ID from the database
        // You can customize the query and table name based on your schema
        
        $query = "SELECT referring_code, referrer_id FROM affiliate_links";
        $result = $this->run_query->query($query);
        
        // Process the query result and return the referring code and referring ID as needed
        $referringCode = array();
        $referrerId = array();
        
        while ($row = $result->fetch_assoc()) {
            $referringCode[] = $row['referring_code'];
            $referrerId[] = $row['referrer_id'];
        }
        
        // Return the referring code and referring ID as an associative array
        return array(
            'referring_code' => $referringCode,
            'referrer_id' => $referrerId
        );
    }
}
