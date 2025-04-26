<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/pool/config/database.php';

class Db extends Database
{
  public $table;



  public function createFilesTable($table = "files")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
          id INT AUTO_INCREMENT PRIMARY KEY,
          file_path TEXT,
          key_id VARCHAR(50),
          user_id INT,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        
          '
    );
  }

  public function createDisputesTable($table = "disputes")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
            id INT AUTO_INCREMENT PRIMARY KEY,
            contract_id INT,
            client_id INT,
            pro_id INT,
            ticket_id INT,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          '
    );
  }

  public function charges_table($table = "payments")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
          id INT AUTO_INCREMENT PRIMARY KEY,
          amount DECIMAL(10,2) NOT NULL,
          agent_fee DECIMAL(10,2) NOT NULL,
          customer_fee DECIMAL(10,2) NOT NULL,
          payment_type VARCHAR(255) NOT NULL,
          payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          '
    );
  }

  public function createWorkTrackerTable($table = "work_log")
  {


    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
          id INT AUTO_INCREMENT PRIMARY KEY,
          date DATE,
          hours_worked FLOAT,
          description TEXT,
          pro_id INT,
          FOREIGN KEY (pro_id) REFERENCES professionals(id)
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );

  }


  public function profiles_table($table = "company_profiles")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
company_name VARCHAR(255) NULL,
logo TEXT NULL,
website VARCHAR(255) NULL,
number_employee VARCHAR(255) NULL,
description TEXT NULL,
tagline TEXT NULL,
industry VARCHAR(255) NULL,
company_phone VARCHAR(255) NULL,
company_email VARCHAR(255) NULL,
company_address VARCHAR(255) NULL,
vat_id VARCHAR(255) NULL,
gst_id VARCHAR(255) NULL,
pst_id VARCHAR(255) NULL,
currency VARCHAR(255) NULL,
time_zone VARCHAR(255) NULL,
country VARCHAR(255) NULL,
payment_method_id int(11) NULL,
billing_address TEXT NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  public function notification_table($table = "notifications")
  {


    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
email_noti VARCHAR(255) NULL,
sms_noti VARCHAR(255) NULL,
noti_posts VARCHAR(255) NULL,
noti_jobs VARCHAR(255) NULL,
noti_blogs VARCHAR(255) NULL,

date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  public function jobs_table($table = "jobs")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  user_id INT(6) NULL,
  job_title VARCHAR(255) NULL,
  company VARCHAR(255) NULL,
  industry VARCHAR(255) NULL,
  subindustry VARCHAR(255) NULL,
  location VARCHAR(255) NULL,
  contract_type VARCHAR(255) NULL,
  salary VARCHAR(255) NULL,
  level VARCHAR(255) NULL,
  person_specifications TEXT NULL,
  skill_requirements TEXT NULL,
  qualifications_requirements TEXT NULL,
  experience_requirements TEXT NULL,
  job_description TEXT NULL,
  job_file TEXT NULL,
  job_status VARCHAR(255) NULL,
  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  public function saved_jobs_table($table = "saved_jobs")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  user_id INT(6) NULL,
  client_id INT(6) NULL,
  job_id INT(6) NULL,
  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  public function job_applications_table($table = "job_applications")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        user_id INT(6) NOT NULL,
        client_id INT(6) NOT NULL,
        job_id INT(6) NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        contact_email VARCHAR(255) NOT NULL,
        contact_phone VARCHAR(255),
        resume TEXT,
        person_specifications TEXT,
        skill_requirements TEXT,
        qualifications_requirements TEXT,
        experience_requirements TEXT,
        date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
    );
  }


  public function manage_jobs_table($table = "manage_jobs")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
job_id INT(6) NULL,
role VARCHAR(255) NULL,
job_status VARCHAR(255) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }



  public function local_service_table($table = "local_services")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
          user_id INT(6) NULL,
          title VARCHAR(255) NULL,
          location VARCHAR(255) NULL,
          availability JSON NULL DEFAULT NULL,
          service_option_name JSON NULL DEFAULT NULL,
          service_option_price JSON NULL DEFAULT NULL,
          description TEXT NULL,
          service_file TEXT NULL,
          service_status VARCHAR(255) NULL,
          date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          '
    );
  }

  public function resumes_table($table = "resumes")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
first_name VARCHAR(255) NULL,
last_name VARCHAR(255) NULL,
dob VARCHAR(255) NULL,
address TEXT NULL,
bio TEXT NULL,
skills TEXT NULL,
qualifications TEXT NULL,
experience TEXT NULL,
photo TEXT NULL,
status VARCHAR(255) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  public function courses_table($table = "courses")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
picture TEXT NULL,
title VARCHAR(255) NULL,
discipline VARCHAR(255) NULL,
level VARCHAR(255) NULL,
description TEXT NULL,
rating VARCHAR(255) NULL,
link TEXT NULL,
price VARCHAR(255) NULL,
country VARCHAR(255) NULL,
file TEXT NULL,
status VARCHAR(255) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  public function contracts_application_table($table = "contracts_applications")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
applicant_id INT(6) NULL,
client_id INT(6) NULL,
contract_id INT(6) NULL,
duration VARCHAR(255) NULL,
availability VARCHAR(255) NULL,
charges VARCHAR(255) NULL,
milestones VARCHAR(255) NULL,
milestone_status VARCHAR(255) NULL,
milestone_amount VARCHAR(255) NULL,
status VARCHAR(255) NULL,
description VARCHAR(255) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }



  public function contract_table($table = "contracts")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
title VARCHAR(255) NULL,
duration VARCHAR(255) NULL,
availability JSON NULL,
price VARCHAR(255) NULL,
skills VARCHAR(255) NULL,
description LONGTEXT NULL,
currency VARCHAR(255) NULL,
type VARCHAR(255) NULL,
status VARCHAR(255) NULL,
final_status VARCHAR(255) NULL,
awarded_to VARCHAR(255) NULL,
week_hours VARCHAR(255) NULL,
fr_status VARCHAR(255) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  public function gigs_table($table = "gigs")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
gigtitle TEXT NULL,
category VARCHAR(255) NULL,
subcategory VARCHAR(255) NULL,
location VARCHAR(255) NULL,
basicpackage VARCHAR(255) NULL,
standardpackage VARCHAR(255) NULL,
premiumpackage VARCHAR(255) NULL,
basicdescribe VARCHAR(255) NULL,
standardescribe VARCHAR(255) NULL,
premiumdescribe VARCHAR(255) NULL,
basic_delieverytime VARCHAR(255) NULL,
standard_delieverytime VARCHAR(255) NULL,
premium_delieverytime VARCHAR(255) NULL,
basic_revisions VARCHAR(255) NULL,
standard_revisions VARCHAR(255) NULL,
premium_revisions VARCHAR(255) NULL,
basicdouble VARCHAR(255) NULL,
standarddouble VARCHAR(255) NULL,
premiumdouble VARCHAR(255) NULL,
basichigh VARCHAR(255) NULL,
standardhigh VARCHAR(255) NULL,
premiumhigh VARCHAR(255) NULL,
basic_price VARCHAR(255) NULL,
standard_price VARCHAR(255) NULL,
premium_price VARCHAR(255) NULL,
step2_description TEXT NULL,
questions TEXT NULL,
answers TEXT NULL,
requirement TEXT NULL,
gigimages TEXT NULL,
gigsvideo TEXT NULL,
gig_status VARCHAR(255) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }


  public function storage_table($table = "storage")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
title TEXT NULL,
file_name varchar(255) NULL,
file_mime varchar(255) NULL,
file_data longblob NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }


  public function chatroom_table($table = "chatroom")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      'id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       token int(11) NULL, 
       sender int(11) NULL,
       destination int(11) NULL,
       status int(11) NULL,
       date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  // Create chat table here where token and chatroom_id are add as columns
  public function chat_table($table = "chats")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      'id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       sender int(11) NULL,
       destination int(11) NULL,
       token int(11) NULL,
       message text NULL,
       status int(11) NULL,
       date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }


  public function financial_profile($table = "financial_profile")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
account_type VARCHAR(255) NULL,
email VARCHAR(255) NULL,
stripe_connect_id VARCHAR(255) NULL,
stripe_customer_id VARCHAR(255) NULL,
stripe_card_id VARCHAR(255) NULL,
card_token VARCHAR(255) NULL,
currency VARCHAR(255) NULL,
bank_token VARCHAR(255) NULL,
stripe_source_id VARCHAR(255) NULL,
stripe_bank_account_id VARCHAR(255) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );

  }


  public function logs_table($table = "users_logs")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) UNSIGNED NOT NULL,
last_login datetime NULL ,
last_login_ip VARCHAR(255) NULL,
last_login_device VARCHAR(255) NULL,
last_logout datetime NULL ,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );




  }

  public function payment_methods($table = "payment_methods")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) UNSIGNED NULL,
billing_address TEXT NULL,
currency VARCHAR(255) NULL,
banking_details JSON NULL,
card_details JSON NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );

  }

  //Create a deposit table
  public function deposit_table($table = "deposits")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) UNSIGNED NULL,
amount VARCHAR(255) NULL,
deposit_status TEXT NULL,
billing_address TEXT NULL,
currency VARCHAR(255) NULL,
card_no VARCHAR(255) NULL,
card_name VARCHAR(255) NULL,
card_expiry_month INT(20) NULL,
card_expiry_year INT(20) NULL,
card_cvv INT(20) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );

  }


  public function earnings_table($table = "earnings")
  {

    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) UNSIGNED NULL,
project_id INT(6) UNSIGNED NULL,
user_balance VARCHAR(255) NULL,
balance_due VARCHAR(255) NULL,
amount VARCHAR(255) NULL,
project_duration VARCHAR(255) NULL,
project_delivery_date VARCHAR(255) NULL,
amount_paid VARCHAR(255) NULL,
amount_due VARCHAR(255) NULL,
currency VARCHAR(255) NULL,
payout_status VARCHAR(255) NULL,
payout_amount VARCHAR(255) NULL,
payout_date VARCHAR(255) NULL,
amount_after_fee VARCHAR(255) NULL,
fee VARCHAR(255) NULL,
payment_deadline VARCHAR(255) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );



  }

  public function project_milestones_table($table = "milestones")
  {
    $this->deleteTable($table);
    $this->createTable($table, '
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    contract INT(60) UNSIGNED NULL,
    client INT(60) UNSIGNED NULL,
    freelancer INT(60) UNSIGNED NULL,
    name VARCHAR(250) NULL,
    description TEXT NULL,
    ml_payment decimal(10,2) NULL,
    ml_payment_inprogress varchar(250) NULL,
    ml_payment_released varchar(250) NULL,
    release_request INT(6) NULL,
    release_status INT(6) NULL,
    status INT(6) NULL,
    due_date VARCHAR(250) NULL,
    tasks INT(6) NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

  }

  public function project_tasks_table($table = "tasks")
  {
    $this->deleteTable($table);
    $this->createTable($table, '
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    contract INT(60) UNSIGNED NULL,
    client INT(60) UNSIGNED NULL,
    freelancer INT(60) UNSIGNED NULL,
    milestone VARCHAR(250) NULL,
    description TEXT NULL,
    name VARCHAR(250) NULL,
    due_date VARCHAR(250) NULL,
    status INT(6) NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

  }

  public function membership_plans_table($table = "membership_plans")
  {
    $this->deleteTable($table);
    $this->createTable($table, '
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    owner_id INT(60) UNSIGNED NULL,
    pid INT(60) UNSIGNED NULL,
    selected_team_id VARCHAR(255) NULL,
    applicant_id INT(60) UNSIGNED NULL,
    blockchain TEXT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

  }

  public function subscription_plans_table($table = "plans")
  {
    $this->deleteTable($table);
    $this->createTable($table, '
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(255) NULL,
    price FLOAT(10,2) NULL,
    pinterval ENUM("week","month","year") NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

  }

  public function user_subscriptions_table($table = "user_subscriptions")
  {
    $this->deleteTable($table);
    $this->createTable($table, '
    id INT(60) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT(60) NULL,
    plan_id INT(60) NULL,
    payment_method VARCHAR(255) NULL,
    stripe_subscription_id VARCHAR(255) NULL,
    stripe_customer_id VARCHAR(255) NULL,
    stripe_payment_intent_id VARCHAR(255) NULL,
    paid_amount VARCHAR(255) NULL,
    paid_amount_currency VARCHAR(255) NULL,
    plan_interval VARCHAR(255) NULL,
    plan_interval_count VARCHAR(255) NULL,
    customer_name VARCHAR(255) NULL,
    customer_email VARCHAR(255) NULL,
    created VARCHAR(255) NULL,
    plan_period_start VARCHAR(255) NULL,
    plan_period_end VARCHAR(255) NULL,
    status VARCHAR(255) NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

  }

  public function reviews_table($table = "reviews")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
reviewer_id INT(6) NULL,
reviewee_id INT(6) NULL,
review TEXT NULL,
date_time DATETIME NULL,
rating INT(6) NULL,
contract_id INT(6) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  //Create balance table
  public function balance_table($table = "balance")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) NULL,
initial_balance FLOAT(10,2) NULL,
current_balance FLOAT(10,2) NULL,
currency VARCHAR(255) NULL,
owing FLOAT(10,2) NULL,
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );
  }

  public function createAffiliateLinksTable($table = "affiliate_links")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
          id INT AUTO_INCREMENT PRIMARY KEY,
          link TEXT,
          referring_code VARCHAR(50),
          referrer_id INT,
          referral_status VARCHAR(20),
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          '
    );
  }


  public function createGigPurchaseTable($table = "gig_purchase")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        gig_id INT,
        freelancer_id INT,
        client_id INT,
        price FLOAT(10,2),
        order_date DATETIME,
        payment_method VARCHAR(50),
        status VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }

  public function external_projects($table = "external_projects")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        project_id INT NULL,
        freelancer_id INT NULL,
        client_id INT NULL,
        flag JSON NULL,
        status VARCHAR(20) NULL,
        title TEXT NULL,
        bidding_interval VARCHAR(20) NULL,
        max_budget VARCHAR(20) NULL,
        min_budget VARCHAR(20) NULL,
        type VARCHAR(20) NULL,
        details TEXT NULL,
        link TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }

  public function external_elite_projects($table = "external_elite_projects")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        project_id INT NULL,
        freelancer_id INT NULL,
        client_id INT NULL,
        flag JSON NULL,
        status VARCHAR(20) NULL,
        title TEXT NULL,
        bidding_interval VARCHAR(20) NULL,
        max_budget VARCHAR(20) NULL,
        min_budget VARCHAR(20) NULL,
        type VARCHAR(20) NULL,
        details TEXT NULL,
        link TEXT NULL,
        tag TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }


  public function external_projects_bidden($table = "external_projects_bidden")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        project_id INT NULL,
        client_id INT NULL,
        status TEXT NULL,
        status_message TEXT NULL,
        error_code TEXT NULL,
        request_id TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }

  public function auto_bid($table = "auto_bids")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) null,
        status VARCHAR(20) NULL,
        interval_ VARCHAR(20) NULL,
        current_status VARCHAR(20) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }


  public function external_projects_bids($table = "external_projects_bids")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        project_id INT,
        freelancer_id INT,
        client_id INT,
        price FLOAT(10,2),
        flag VARCHAR(50),
        bid_status VARCHAR(20),
        bid_result VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }

  public function createFinancialDataTable($table = "financial_data")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
          id INT AUTO_INCREMENT PRIMARY KEY,
          current_expenditures DECIMAL(10, 2),
          operational_cost VARCHAR(50),
          short_term_investments DECIMAL(10, 2),
          mid_term_investments DECIMAL(10, 2),
          long_term_investments DECIMAL(10, 2),
          debts DECIMAL(10, 2),
          revenue DECIMAL(10, 2),
          date DATE,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      '
    );
  }

  public function website_traffic($table = "website_traffic")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip_address VARCHAR(50),
        user_agent TEXT,
        page_url TEXT,
        country VARCHAR(50),
        city VARCHAR(50),
        latitude VARCHAR(50),
        longitude VARCHAR(50),
        timezone VARCHAR(50),
        referrer TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }


  // Function to create the cities table
  public function create_cities_table($table = "cities")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    city_name VARCHAR(255) NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
    );

    // Call the fill_cities_table function to populate the table
    $this->fill_cities_table($table);
  }

  // Function to fill the cities table
  public function fill_cities_table($table)
  {
    // Initialize cURL
    $ch = curl_init();

    // API Endpoint for fetching cities
    $api_url = 'http://geodb-free-service.wirefreethought.com/v1/geo/cities?limit=1000'; // Replace with the actual API endpoint
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request and decode the response
    $response = curl_exec($ch);
    $response_data = json_decode($response, true);

    // Close the cURL resource
    curl_close($ch);

    // Use your connectDb method to get the database connection
    $conn = $this->connectDb();

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if (!empty($response_data['data'])) {
      foreach ($response_data['data'] as $city) {
        $city_name = $city['city'];

        // SQL to insert city
        $sql = "INSERT INTO $table (city_name) VALUES ('" . mysqli_real_escape_string($conn, $city_name) . "')";

        if ($conn->query($sql) === FALSE) {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
    }

    // Close connection
    $conn->close();
  }


}






