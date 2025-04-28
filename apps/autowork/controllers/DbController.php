<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/pool/config/database.php';

class Db extends Database
{
  public $table;


  public function projects($table = "allprojects")  // Changed to 'projects'
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
              whole_project JSON NULL,
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






