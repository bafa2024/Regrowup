<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/personal/controllers/TaskController.php';
$task = new Task();

$task->check_auth();

//include the nav
include $path . '/apps/personal/ui/layouts/nav.php';
?>
<!--  Modals-->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Add Tasks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form action="/per_task" method="POST">
                    <div class="mb-3">
                        <label for="title" class="col-form-label">Task:</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Details:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Task details here..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="datepicker" class="col-form-label">Datetime:</label>
                        <input type="datetime-local" class="form-control" id="deadline" name="deadline">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-dark " name="add_task" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="goalModal" tabindex="-1" aria-labelledby="goalModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goalModalLabel">Add Goals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form action="/per_task" method="POST">
                    <div class="mb-3">
                        <label for="title" class="col-form-label">Goal:</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Details:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Goal details here..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="datepicker" class="col-form-label">Datetime:</label>
                        <input type="datetime-local" class="form-control" id="deadline" name="deadline">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-dark " name="add_goal" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">

        <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">


                <ul class="nav flex-column">
                
                    <div class="toc">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?ty=tasks">
                                <span data-feather="home" class="align-text-bottom"></span><i class="fas fa-star"></i>
                                Tasks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?ty=goals">
                                <span data-feather="home" class="align-text-bottom"></span><i class="fas fa-star"></i>
                                Goals
                            </a>
                        </li>
                    </div>


                </ul>
            </div>


        </nav>

        <main class="col-md-7 ms-sm-auto col-lg-7 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
              <div class="tasks">
            
                <table class="table table-striped table-sm">
                    
 
                    <?php
                
                    $title = $_GET['ty']  ?? Null OR $title = $_GET['ty']  ?? '';

                    switch ($title) {
                        case 'tasks':
                            $task->tasks();
                            break;
                        case 'goals':
                            $task->goals();
                            break;
                        default:
                            $task->goals();
                            break;
                    }

                    ?>
                

                </table>

            </div>

            </div>


        </main>
        <div class="col-md-3 ">

            <?php
            $tid = $_GET['t'] ?? Null OR $_GET['t'] ?? '';
            $gid= $_GET['g'] ?? Null OR $_GET['g'] ?? '';
            if ($tid) {

                $task->tasks_details($tid);

            }elseif($gid){
                $task->goals_details($gid);
            }
            ?>
        </div>
    </div>
</div>
<script>
    
            // Fetch the notification message from the server
            /*
            fetch('/per_task?nf=true'){
                .then(response => response.text())
                .then(message => {
                    // Call a function to show the notification
                    showNotification(message);
                })
                .catch(error => {
                    console.error('Error fetching notification:', error);
                });
            }
                
        

        // Function to show a notification
        function showNotification(message) {
            // Create a notification element
            const notification = document.createElement('div');
            notification.className = 'notification'; // Apply your existing notification styles
            notification.textContent = message;

            // Add the notification to the page
            document.body.appendChild(notification);

            // Remove the notification after a certain duration (e.g., 5 seconds)
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 5000); // 5000 milliseconds = 5 seconds
        }
        */
    </script>

<?php
//include the footer
include $path . '/apps/personal/ui/layouts/footer.php';
?>