<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/personal/controllers/TaskController.php';
$task = new Task();

$task->checkSessionAndRedirect();

//include the nav
include $path . '/apps/personal/ui/layouts/head.php';



?>
    <div class="container-fluid">
        <div class="row">

    

            <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">

                <table class="table table-striped table-sm shadow border-rounded">

                    <?php
                    //$task->list_tasks();

                    $title = $_GET['t'] ?? Null;
                    if ($title) {

                        $task->daily_tasks();

                    }else{

                        $task->daily_tasks();
                    }

                    ?>
                    
                </table>



                </div>


            </main>
        </div>
    </div>
<?php
//include the footer
include $path . '/apps/personal/ui/layouts/footer.php';
?>