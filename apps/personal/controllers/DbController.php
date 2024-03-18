<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/pool/config/database.php';



class Db extends Database
{
  public $table;

 public function __construct()
    {
    parent::__construct();
    }


  public function tasks($table = "tasks")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        task TEXT,
        title TEXT,
        description TEXT,
        deadline VARCHAR(250),
        status VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }

  public function goals($table = "goals")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        goal TEXT,
        title TEXT,
        description TEXT,
        deadline VARCHAR(250),
        status VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }

  public function daily_routine($table = "daily_routine")
  {
    $this->deleteTable($table);
    $this->createTable(
      $table,
      '
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        task TEXT,
        title TEXT,
        description TEXT,
        status VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        '
    );
  }


 



}






