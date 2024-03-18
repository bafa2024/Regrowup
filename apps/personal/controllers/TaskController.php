<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/pool/libs/controllers/Controller.php';

class Task extends Controller
{
  private $key = "!@##$%%^&7567$%5678&*()";

  public function __construct()
  {
    parent::__construct();
    $this->setUserTimezone();
  }

  // Include your existing styles and scripts here

  public function setUserTimezone()
  {
    // Get the user's current timestamp
    //$userTimestamp = $_SERVER['REQUEST_TIME'];

    // Get the user's current timezone
    //$userTimezone = date_default_timezone_get();

    // Set the user's timezone
    //date_default_timezone_set($userTimezone);

    // You can echo the user's timezone if needed
    //echo "User's Timezone: " . $userTimezone;


  }

  // Call the function to set the user's timezone


  // Rest of your PHP code goes here

  public function tasks()
  {
    $sql = "SELECT * FROM tasks ORDER BY id DESC";
    $stmt = $this->run_query($sql);
    $i = 0;
    while ($row = $stmt->fetch_array()) {
      $titles[] = $row;
      $title = $row["title"] ?? '' or NULL;
      $content = $row["description"] ?? '' or NULL;
      $deadline = $row["deadline"] ?? '' or NULL;
      // Decrypt the title from SHA256
      $title = $this->decrypt($title, $this->key);
      $content = $this->decrypt($content, $this->key);
      $deadline = $this->decrypt($deadline, $this->key);

      // split the date and time in the deadline variable
      $deadline = explode("T", $deadline);
      //$deadline = $deadline[0] . " " . date("g:i a", strtotime($deadline[1]));
      $deadline = $deadline[0] . " " . $deadline[1];
      //convert the time from 24hr to 12hr
      $status = $row["status"] ?? '' or NULL;

      if ($status == 1) {

        // Fetch the tasks as a todo list in a table format
        echo '
            <tr>
              <td>  
              <form method="post" action="/per_task" >
              <input type="hidden" name="id" value="' . $row["id"] . '">
              <button type="submit" class="btn btn-outline" name="undo">
                <i class="fa fa-edit"></i>
              </button>
            </form>
              </td>
              <td colspan="2"><b><s><a href="/?t=' . $row["id"] . '">' . $title . '</s></a></b></td>
              <td>' . $deadline . '</td>
              <td>
                <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row["id"] . '">
                  <i class="fa fa-edit"></i> 
                </button>
                </td>
                <td>
                <form method="post" action="/per_task" onsubmit="return confirm(\'Are you sure you want to delete this task?\');">
                  <input type="hidden" name="task_id" value="' . $row["id"] . '">
                  <button type="submit" class="btn btn-outline" name="delete">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            
            <!-- Edit Task Modal -->
            <div class="modal fade" id="exampleModal' . $row["id"] . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $row["id"] . '" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel' . $row["id"] . '">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="/per_task" method="POST">
                      <input type="hidden" name="id" value="' . $row["id"] . '">
                      <div class="mb-3">
                        <label for="title' . $row["id"] . '" class="col-form-label">Task:</label>
                        <input type="text" class="form-control" id="title' . $row["id"] . '" name="title" value="' . $title . '">
                      </div>
                      <div class="mb-3">
                        <label for="description' . $row["id"] . '" class="col-form-label">Details:</label>
                        <textarea class="form-control" id="description' . $row["id"] . '" name="description" rows="3">' . $content . '</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="deadline' . $row["id"] . '" class="col-form-label">Datetime:</label>
                        <input type="datetime-local" class="form-control" id="deadline' . $row["id"] . '" name="deadline" value="' . $deadline . '">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-dark" name="update" value="Submit">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          ';

      } else {
        echo '
              <tr>
                  <td>  
                <form method="post" action="/per_task" >
                <input type="hidden" name="id" value="' . $row["id"] . '">
                <button type="submit" class="btn btn-outline" name="done">
                  <i class="fa fa-edit"></i>
                </button>
              </form>
                </td>
                <td colspan="2"><b><a href="?t=' . $row["id"] . '">' . $title . '</a></b></td>
                <td>' . $deadline . '</td>
                <td>
                  <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row["id"] . '">
                    <i class="fa fa-edit"></i> 
                  </button>
                  </td>
                  <td>
                  <form method="post" action="/per_task" onsubmit="return confirm(\'Are you sure you want to delete this task?\');">
                    <input type="hidden" name="task_id" value="' . $row["id"] . '">
                    <button type="submit" class="btn btn-outline" name="delete">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              
              <!-- Edit Task Modal -->
              <div class="modal fade" id="exampleModal' . $row["id"] . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $row["id"] . '" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel' . $row["id"] . '">Edit Task</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/per_task" method="POST">
                        <input type="hidden" name="id" value="' . $row["id"] . '">
                        <div class="mb-3">
                          <label for="title' . $row["id"] . '" class="col-form-label">Task:</label>
                          <input type="text" class="form-control" id="title' . $row["id"] . '" name="title" value="' . $title . '">
                        </div>
                        <div class="mb-3">
                          <label for="description' . $row["id"] . '" class="col-form-label">Details:</label>
                          <textarea class="form-control" id="description' . $row["id"] . '" name="description" rows="3">' . $content . '</textarea>
                        </div>
                        <div class="mb-3">
                          <label for="deadline' . $row["id"] . '" class="col-form-label">Datetime:</label>
                          <input type="datetime-local" class="form-control" id="deadline' . $row["id"] . '" name="deadline" value="' . $deadline . '">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <input type="submit" class="btn btn-dark" name="update" value="Submit">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            ';
      }

    }

  }

  public function goals()
  {
    $sql = "SELECT * FROM goals ORDER BY id DESC";
    $stmt = $this->run_query($sql);
    $i = 0;
    while ($row = $stmt->fetch_array()) {
      $titles[] = $row;
      $title = $row["title"] ?? '' or NULL;
      $content = $row["description"] ?? '' or NULL;
      $deadline = $row["deadline"] ?? '' or NULL;
      // Decrypt the title from SHA256
      $title = $this->decrypt($title, $this->key);
      $content = $this->decrypt($content, $this->key);
      $deadline = $this->decrypt($deadline, $this->key);

      // split the date and time in the deadline variable
      $deadline = explode("T", $deadline);
      //$deadline = $deadline[0] . " " . date("g:i a", strtotime($deadline[1]));
      $deadline = $deadline[0] . " " . $deadline[1];
      //convert the time from 24hr to 12hr
      $status = $row["status"] ?? '' or NULL;

      if ($status == 1) {

        // Fetch the tasks as a todo list in a table format
        echo '
            <tr>
              <td>  
              <form method="post" action="/per_task" >
              <input type="hidden" name="id" value="' . $row["id"] . '">
              <button type="submit" class="btn btn-outline" name="undo">
                <i class="fa fa-edit"></i>
              </button>
            </form>
              </td>
              <td colspan="2"><b><s><a href="/?g=' . $row["id"] . '">' . $title . '</s></a></b></td>
              <td>' . $deadline . '</td>
              <td>
                <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row["id"] . '">
                  <i class="fa fa-edit"></i> 
                </button>
                </td>
                <td>
                <form method="post" action="/per_task" onsubmit="return confirm(\'Are you sure you want to delete this task?\');">
                  <input type="hidden" name="goal_id" value="' . $row["id"] . '">
                  <button type="submit" class="btn btn-outline" name="delete_goal">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            
            <!-- Edit Task Modal -->
            <div class="modal fade" id="exampleModal' . $row["id"] . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $row["id"] . '" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel' . $row["id"] . '">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="/per_task" method="POST">
                      <input type="hidden" name="id" value="' . $row["id"] . '">
                      <div class="mb-3">
                        <label for="title' . $row["id"] . '" class="col-form-label">Task:</label>
                        <input type="text" class="form-control" id="title' . $row["id"] . '" name="title" value="' . $title . '">
                      </div>
                      <div class="mb-3">
                        <label for="description' . $row["id"] . '" class="col-form-label">Details:</label>
                        <textarea class="form-control" id="description' . $row["id"] . '" name="description" rows="3">' . $content . '</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="deadline' . $row["id"] . '" class="col-form-label">Datetime:</label>
                        <input type="datetime-local" class="form-control" id="deadline' . $row["id"] . '" name="deadline" value="' . $deadline . '">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-dark" name="update_goal" value="Submit">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          ';
      } else {
        echo '
              <tr>
                  <td>  
                <form method="post" action="/per_task" >
                <input type="hidden" name="id" value="' . $row["id"] . '">
                <button type="submit" class="btn btn-outline" name="goal_done">
                  <i class="fa fa-edit"></i>
                </button>
              </form>
                </td>
                <td colspan="2"><b><a href="?g=' . $row["id"] . '">' . $title . '</a></b></td>
                <td>' . $deadline . '</td>
                <td>
                  <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row["id"] . '">
                    <i class="fa fa-edit"></i> 
                  </button>
                  </td>
                  <td>
                  <form method="post" action="/per_task" onsubmit="return confirm(\'Are you sure you want to delete this task?\');">
                  <input type="hidden" name="goal_id" value="' . $row["id"] . '">
                  <button type="submit" class="btn btn-outline" name="delete_goal">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              
              <!-- Edit Task Modal -->
              <div class="modal fade" id="exampleModal' . $row["id"] . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $row["id"] . '" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel' . $row["id"] . '">Edit Task</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/per_task" method="POST">
                        <input type="hidden" name="id" value="' . $row["id"] . '">
                        <div class="mb-3">
                          <label for="title' . $row["id"] . '" class="col-form-label">Task:</label>
                          <input type="text" class="form-control" id="title' . $row["id"] . '" name="title" value="' . $title . '">
                        </div>
                        <div class="mb-3">
                          <label for="description' . $row["id"] . '" class="col-form-label">Details:</label>
                          <textarea class="form-control" id="description' . $row["id"] . '" name="description" rows="3">' . $content . '</textarea>
                        </div>
                        <div class="mb-3">
                          <label for="deadline' . $row["id"] . '" class="col-form-label">Datetime:</label>
                          <input type="datetime-local" class="form-control" id="deadline' . $row["id"] . '" name="deadline" value="' . $deadline . '">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <input type="submit" class="btn btn-dark" name="update_goal" value="Submit">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            ';
      }

    }

  }

  //creating tasks notifications and monitoring
  /**
   * fetch all the tasks
   * get the date and time of the task
   * compare the date and time with the current date and time
   * if the date and time is equal to the current date and time, send a notification
   * if the date and time is less than the current date and time, send a notification as upcoming task
   */
  public function tasks_notifications()
  {

    $current_datetime = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM tasks ORDER BY id DESC";
    $stmt = $this->run_query($sql);

    $res = $stmt->fetch_array();
    $title = $res["title"] ?? '' or NULL;
    $content = $res["description"] ?? '' or NULL;
    $deadline = $res["deadline"] ?? '' or NULL;
    $status = $res["status"] ?? '' or NULL;

    //decrypt the title, content, and deadline
    $title = $this->decrypt($title, $this->key);
    $content = $this->decrypt($content, $this->key);
    $deadline = $this->decrypt($deadline, $this->key);

    // split the date and time in the deadline variable
    $deadline = explode("T", $deadline);
    $date = $deadline[0];
    //sort the time to local time
    $time = date("g:i a", strtotime($deadline[1]));

    $current_time = date("g:i a");
    $current_date = date("Y-m-d");

    //get the user local time zone
    date_default_timezone_set('USA/Los_Angeles');

    //compare the date and time with the current date and time
    echo "Current Date:" . $date . ": " . $current_date;
    echo "<br>";
    echo $time . ": " . $current_time;
    /*
    if($date==$current_date && $time==$current_time){
    
      echo '<script>alert("'.$title.'")</script>';
    }
    */

    //$this->setUserTimezone();



  }

  public function check_auth()
  {
    // Check if the session is not set
    if (!isset($_SESSION['user_id'])) {
      // Store the current page URL in a session variable
      $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

      // Redirect the user to the login page or any other desired page
      header('Location: /login?dp=1'); // Replace "login.php" with the desired URL
      exit;
    }
  }

  public function tasks_details($tid)
  {

    $sql = "SELECT * FROM tasks WHERE id='$tid'";
    $stmt = $this->run_query($sql);
    $i = 0;
    while ($row = $stmt->fetch_array()) {
      $titles[] = $row;
      $title = $row["title"] ?? '' or NULL;
      $content = $row["description"] ?? '' or NULL;
      $deadline = $row["deadline"] ?? '' or NULL;
      // Decrypt the title from SHA256
      $title = $this->decrypt($title, $this->key);
      $content = $this->decrypt($content, $this->key);
      $deadline = $this->decrypt($deadline, $this->key);

      // split the date and time in the deadline variable
      $deadline = explode("T", $deadline);
      //  $deadline = $deadline[0] . " " . date("g:i a", strtotime($deadline[1]));
      $deadline = $deadline[0] . " " . $deadline[1];
      //convert the time from 24hr to 12hr
      $status = $row["status"] ?? '' or NULL;

      echo '
        <div class="tdetails " style="width: 390px;">
        
        <h6 class="d-flex align-items-center fs-8 flex-shrink-0 p-3 link-body-emphasis text-decoration border-bottom">
            

            ' . $title . '
        </h6>
        <div class="list-group list-group-flush border-bottom scrollarea">
        <textarea class="form-control" id="description' . $row["id"] . '" name="description" rows="8">' . $content . '</textarea>
          
          <div class="list-group-item d-flex align-items-center p-3">
          
            <a href="/personal">X</a>
            </div>
          
        </div>
    </div>
            ';


    }

  }

  public function goals_details($tid)
  {

    $sql = "SELECT * FROM goals WHERE id='$tid'";
    $stmt = $this->run_query($sql);
    $i = 0;
    while ($row = $stmt->fetch_array()) {
      $titles[] = $row;
      $title = $row["title"] ?? '' or NULL;
      $content = $row["description"] ?? '' or NULL;
      $deadline = $row["deadline"] ?? '' or NULL;
      // Decrypt the title from SHA256
      $title = $this->decrypt($title, $this->key);
      $content = $this->decrypt($content, $this->key);
      $deadline = $this->decrypt($deadline, $this->key);

      // split the date and time in the deadline variable
      $deadline = explode("T", $deadline);
      //  $deadline = $deadline[0] . " " . date("g:i a", strtotime($deadline[1]));
      $deadline = $deadline[0] . " " . $deadline[1];
      //convert the time from 24hr to 12hr
      $status = $row["status"] ?? '' or NULL;

      echo '
        <div class="tdetails " style="width: 390px;">
        
        <h6 class="d-flex align-items-center fs-8 flex-shrink-0 p-3 link-body-emphasis text-decoration border-bottom">
  
            ' . $title . '
        </h6>
        <div class="list-group list-group-flush border-bottom scrollarea">
        <textarea class="form-control" id="description' . $row["id"] . '" name="description" rows="8">' . $content . '</textarea>
          
          <div class="list-group-item d-flex align-items-center p-3">
          
            <a href="/personal">X</a>
            </div>
          
        </div>
    </div>
            ';


    }

  }

  //write the insert function with prepared statement, pdo
  public function insert($title, $content, $deadline)
  {
    //$content = $this->connectDb()->real_escape_string($content);
    //$content = $this->connectDb()->real_escape_string($content);
    $title = $this->connectDb()->real_escape_string($title);

    //convert deadline into local time
    //$deadline = date("Y-m-d H:i:s", strtotime($deadline));


    //encrypt 
    $content = $this->encrypt($content, $this->key);
    $title = $this->encrypt($title, $this->key);

    $deadline = $this->encrypt($deadline, $this->key);

    // Insert note into database, for demonstration assuming there is a table 'notes'
    $sql = "INSERT INTO tasks (title,description,deadline) VALUES ('$title', '$content','$deadline')";
    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  //insert goals
  public function insert_goals($title, $content, $deadline)
  {
    //$content = $this->connectDb()->real_escape_string($content);
    //$content = $this->connectDb()->real_escape_string($content);
    $title = $this->connectDb()->real_escape_string($title);

    //convert deadline into local time
    //$deadline = date("Y-m-d H:i:s", strtotime($deadline));


    //encrypt 
    $content = $this->encrypt($content, $this->key);
    $title = $this->encrypt($title, $this->key);

    $deadline = $this->encrypt($deadline, $this->key);

    // Insert note into database, for demonstration assuming there is a table 'notes'
    $sql = "INSERT INTO goals (title,description,deadline) VALUES ('$title', '$content','$deadline')";
    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  public function update($id, $title, $content, $deadline)
  {
    $title = $this->connectDb()->real_escape_string($title);
    $content = $this->connectDb()->real_escape_string($content);

    // Encrypt the title, content, and deadline
    $title = $this->encrypt($title, $this->key);
    $content = $this->encrypt($content, $this->key);
    $deadline = $this->encrypt($deadline, $this->key);

    // Update the task in the 'tasks' table
    $sql = "UPDATE tasks SET title='$title', description='$content', deadline='$deadline' WHERE id='$id'";

    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  public function update_goal($id, $title, $content, $deadline)
  {
    $title = $this->connectDb()->real_escape_string($title);
    $content = $this->connectDb()->real_escape_string($content);

    // Encrypt the title, content, and deadline
    $title = $this->encrypt($title, $this->key);
    $content = $this->encrypt($content, $this->key);
    $deadline = $this->encrypt($deadline, $this->key);

    // Update the task in the 'tasks' table
    $sql = "UPDATE goals SET title='$title', description='$content', deadline='$deadline' WHERE id='$id'";

    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  public function update_status($id)
  {
    // Update the status of the task to done
    $sql = "UPDATE tasks SET status='1' WHERE id='$id'";
    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  public function update_goal_status($id)
  {
    // Update the status of the task to done
    $sql = "UPDATE goals SET status='1' WHERE id='$id'";
    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  public function update_status_undo($id)
  {
    // Update the status of the task to done
    $sql = "UPDATE tasks SET status='' WHERE id='$id'";
    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  public function delete($id)
  {
    // Delete note from the database
    $sql = "DELETE FROM tasks WHERE id = '$id'";
    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }

  //delete goals
  public function delete_goal($id)
  {
    // Delete note from the database
    $sql = "DELETE FROM goals WHERE id = '$id'";
    $stmt = $this->run_query($sql);
    if ($stmt) {
      return true;
    } else {
      return false;
    }
  }


}