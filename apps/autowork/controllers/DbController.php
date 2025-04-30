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

  public function new_projects($table = "newprojects")  // Changed to 'projects'
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




}






