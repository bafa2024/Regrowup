<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/work/controllers/ContractController.php';

$contract = new ContractController();

$contract->authCheck();

$ct=$contract->url_var("ct");
$client=$contract->url_var("cl");
$ml=$contract->url_var("ml");



$details=$contract->project($ct);
$title=$details['title'];
$description=$details['description'];
$budget=$details['price'];

include $path . '/apps/work/ui/layouts/nav.php';

$role = $_SESSION['role'];

$uid=$_SESSION['id'];



if($role=="Client" || $role=="client"){

?>
<section class="d-block py-50">

<div class="container">
<div class="row  gy-1 pb-1">
<div class="col-12">
    <div class="d-block bg-white p-1  bg-white ">
            
        <h2 class="align-left"><?php echo $title;?></h2> 
            
    </div>
            
    </div>

</div>

<div class="row gy-1 pb-1">
 <ul class="nav nav-tabs" id="myTab" role="tablist">
 <li class="nav-item" role="presentation">
<button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="true">Details </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids-tab-pane" type="button" role="tab" aria-controls="bids-tab-pane" aria-selected="false">Application </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="files-tab" data-bs-toggle="tab" data-bs-target="#files-tab-pane" type="button" role="tab" aria-controls="files-tab-pane" aria-selected="false">Files </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link " id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks-tab-pane" type="button" role="tab" aria-controls="tasks-tab-pane" aria-selected="false">Tasks </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments-tab-pane" type="button" role="tab" aria-controls="payments-tab-pane" aria-selected="false">Payments</button>
</li>






</ul>

<div class="tab-content" id="myTabContent">


<div class="tab-pane p-3 fade show" id="tasks-tab-pane" role="tabpanel" aria-labelledby="tasks-tab" tabindex="0">

<div class="row">
<div class="col-4 border p-3 shadow">

<h6 class="align-center">Milestones</h6>
<hr>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#milestoneModal" data-bs-whatever="@mdo">+ Milestone</button>
<!--Create dropdown for milestones-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contractModal" data-bs-whatever="@mdo">Actions</button>

     
<hr>
<?php

  $contract->milestones($ct);


?>

</div>

<div class="col-8 border p-3 shadow">
  <div class="row">
  <div class="col-6">

  <h7 class="">Tasks</h7> |
  <button type="button" class="btn btn-sm rounded border" data-bs-toggle="modal" data-bs-target="#taskModal" data-bs-whatever="<?php echo $ml; ?>">+Add</button>

</div>

<hr>

<?php
//Check if milestone is selected


  $contract->tasks($ml,$ct);


?>

</div>

</div>









</div>
</div>


<div class="tab-pane fade show" id="files-tab-pane" role="tabpanel" aria-labelledby="files-tab" tabindex="0">
Files

<?php
?>
</div>

<div class="tab-pane fade show" id="payments-tab-pane" role="tabpanel" aria-labelledby="payments-tab" tabindex="0">


<div class="row">
<div class="col-4 border p-3 shadow">

<h6 class="align-left">Payments</h6>
<hr>
<?php
$contract->payments($ct);
?>



</div>

<div class="col-8 border p-3 shadow">
  <div class="row">
  <div class="col-8">

  <h7 class="">Milestone Payments</h7> |
  <button type="button" class="btn btn-sm rounded border" data-bs-toggle="modal" data-bs-target="#milestoneModal" data-bs-whatever="<?php echo $ml; ?>">Request Milestone</button>

</div>

<hr>

<?php
$contract->list_milestones_client($ct);
?>

</div>

</div>









</div>
</div>




<div class="tab-pane fade show active" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
Project Details
<div class="row">
<div class="col-12">
<div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 ">
<h6 class="align-center"><?php echo $title;     ?></h6>
</div>
</div>

<div class="col-12">
<div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 ">
<h6 class="align-right"><?php echo $budget;     ?></h6>
</div>
</div>
<div class="col-12">
<div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 ">
<h6 class="align-center"><?php echo $description;     ?></h6>
</div>  
</div>


</div>





</div>

<div class="tab-pane fade show " id="bids-tab-pane" role="tabpanel" aria-labelledby="bids-tab" tabindex="0">
Contract Applications

<?php

$contract->contract_applications($_SESSION['id']);

?>

</div>

</div>

</div>

</div>

</div>
</section>



<?php

}elseif($role=="Freelancer" || $role=="freelancer"){

?>
<section class="d-block py-50">

<div class="container">
<div class="row  gy-1 pb-1">
<div class="col-12">
    <div class="d-block bg-white p-1  bg-white ">
            
        <h2 class="align-left"><?php echo $title;?></h2> 
            
    </div>
            
    </div>

</div>

<div class="row gy-1 pb-1">
 <ul class="nav nav-tabs" id="myTab" role="tablist">
 <li class="nav-item" role="presentation">
<button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="true">Details </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids-tab-pane" type="button" role="tab" aria-controls="bids-tab-pane" aria-selected="false">Application </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="files-tab" data-bs-toggle="tab" data-bs-target="#files-tab-pane" type="button" role="tab" aria-controls="files-tab-pane" aria-selected="false">Files </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link " id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks-tab-pane" type="button" role="tab" aria-controls="tasks-tab-pane" aria-selected="false">Tasks </button>
</li>
<li class="nav-item" role="presentation">
<button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments-tab-pane" type="button" role="tab" aria-controls="payments-tab-pane" aria-selected="false">Payments</button>
</li>






</ul>

<div class="tab-content" id="myTabContent">


<div class="tab-pane p-3 fade show" id="tasks-tab-pane" role="tabpanel" aria-labelledby="tasks-tab" tabindex="0">

<div class="row">
<div class="col-4 border p-3 shadow">

<h6 class="align-center">Milestones</h6>
<hr>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#milestoneModal" data-bs-whatever="@mdo">+ Milestone</button>
<!--Create dropdown for milestones-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contractModal" data-bs-whatever="@mdo">Actions</button>

     
<hr>
<?php
$contract->milestones($ct);
?>

</div>

<div class="col-8 border p-3 shadow">
  <div class="row">
  <div class="col-6">

  <h7 class="">Tasks</h7> |
  <button type="button" class="btn btn-sm rounded border" data-bs-toggle="modal" data-bs-target="#taskModal" data-bs-whatever="<?php echo $ml; ?>">+Add</button>

</div>

<hr>

<?php
$contract->tasks($ml,$ct);
?>

</div>

</div>









</div>
</div>

<div class="tab-pane fade show" id="files-tab-pane" role="tabpanel" aria-labelledby="files-tab" tabindex="0">
Files

<?php
?>
</div>

<div class="tab-pane fade show" id="payments-tab-pane" role="tabpanel" aria-labelledby="payments-tab" tabindex="0">


<div class="row">
<div class="col-4 border p-3 shadow">

<h6 class="align-left">Payments</h6>
<hr>
<?php
$contract->payments($ct);
?>



</div>

<div class="col-8 border p-3 shadow">
  <div class="row">
  <div class="col-8">

  <h7 class="">Milestone Payments</h7> |
  <button type="button" class="btn btn-sm rounded border" data-bs-toggle="modal" data-bs-target="#milestoneModal" data-bs-whatever="<?php echo $ml; ?>">Request Milestone</button>

</div>

<hr>

<?php
$contract->list_milestones($ct);
?>

</div>

</div>









</div>
</div>

<div class="tab-pane fade show active" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
Project Details
<div class="row">
<div class="col-12">
<div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 ">
<h6 class="align-center"><?php echo $title;     ?></h6>
</div>
</div>

<div class="col-12">
<div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 ">
<h6 class="align-right"><?php echo $budget;     ?></h6>
</div>
</div>
<div class="col-12">
<div class="d-block bg-white p-1 p-md-2 bg-white rounded-3 ">
<h6 class="align-center"><?php echo $description;     ?></h6>
</div>  
</div>


</div>





</div>

<div class="tab-pane fade show " id="bids-tab-pane" role="tabpanel" aria-labelledby="bids-tab" tabindex="0">
Contract Applications

<?php

$contract->contract_applications($_SESSION['id']);

?>

</div>

</div>

</div>

</div>

</div>
</section>




<script>
  var myDropdown = document.getElementById('myDropdown')
myDropdown.addEventListener('show.bs.dropdown', function () {
  // do something...
})

  var taskEditModal = document.getElementById('taskEditModal')
  taskModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var task = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = taskModal.querySelector('.modal-title')
  var modalBodyInput = taskModal.querySelector('.modal-body input')

  modalTitle.textContent = 'New message to ' + task
  modalBodyInput.value = task
})

  </script>
<?php
}
?>
<div class="modal fade" id="taskEditModal" tabindex="-1" aria-labelledby="taskEditModalLabel" aria-hidden="true">
  <?php
  $contract->tasks_action($id);
  ?>
</div>
          


<div class="modal fade" id="milestoneModal" tabindex="-1" aria-labelledby="tasklistModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Milestone</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/api/contractAPI.php">
           <input type="hidden" name="contract" value="<?php echo $ct; ?>">
           <input type="hidden" name="client" value="<?php echo $client; ?>">
          <div class="mb-3">
            <label for="name" class="col-form-label">Name</label>
            <input type="text"  name="name" class="form-control" id="name">
          </div>
          <div class="mb-3">
            <label for="ml_payment" class="col-form-label">Milestone($)</label>
            <input type="text"  name="ml_payment" class="form-control" id="ml_payment">
          </div>
          <div class="mb-3">
          
            <label for="due_date" class="col-form-label">Due Date:</label>
            <input type="date" class="form-control" id="due_date" name="due_date">
          </div>
          <div class="mb-3">
            <label for="description" class="col-form-label">Description</label>
            <textarea class="form-control" name="description"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"  name="create_milestone">Create </button>
      </div>
        </form>
      </div>
    
    </div>
  </div>
</div>


<div class="modal fade" id="contractModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <?php
  $contract->get_contract($ct);
  ?>
</div>




<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create a Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/api/contractAPI.php">
          <div class="mb-3">
      
            <label for="recipient-name" class="col-form-label">Task Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="mb-3">
          <input type="hidden" name="contract" value="<?php echo $ct; ?>">
            <input type="hidden" name="client" value="<?php echo $client; ?>">
            <input type="hidden" name="milestone" value="<?php echo $ml; ?>">

            <label for="recipient-name" class="col-form-label">Due Date:</label>
            <input type="date" class="form-control" id="due_date" name="due_date">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Details:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        <button type="submit" class="btn btn-primary"  name="create_task">Create </button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


<?php
include $path . '/apps/work/ui/layouts/footer.php';
?>