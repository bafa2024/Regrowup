<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/work/controllers/ContractController.php';

$contract = new ContractController();

$contract->authCheck();

$task=$_GET['ts'];

include $path . '/work/ui/layouts/nav.php';

$role = $_SESSION['role'];

$uid=$_SESSION['id'];



if($role=="Client" || $role=="client"){

?>
<section class="d-block py-50">

<div class="container">

<div class="row">
  <?php
  $contract->tasks_action($task);
  ?>
</div>


</div>
</section>
<?php

}elseif($role=="Freelancer" || $role=="freelancer"){

?>
<section class="d-block py-50">

<div class="container">

<div class="row">
  <?php
  $contract->tasks_action($task);
  ?>
</div>


</div>
</section>


            





<?php
}
include $path . '/work/ui/layouts/footer.php';
?>