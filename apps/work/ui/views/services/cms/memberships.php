<?php
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
include $path.'/work/controllers/AdminController.php';
include $path.'/work/ui/layouts/nav_admin.php';
$admin=new AdminController();

$admin->authCheck();


 
?>
<body class="d-flex flex-column bg-light">


<main class="d-flex flex-column justify-content-center position-relative mx-3 p-3">

  <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            
              
                <th>Name</th>
                <th>Email</th>
                <th>Plan</th>
                <th>Plan Started</th>
                <th>Plan Ends</th>
                <th>Status</th>
              
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $admin->memeberships();
            ?>
        
        </tbody>
      
    </table>
    
    </main>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
      </script>
</html>
