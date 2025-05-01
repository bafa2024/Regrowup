<?php
//session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/apps/autowork/controllers/Autowork.php';

$at = new Autowork();

$bid->checkSessionAndRedirect();

//include $path.'/apps/work/ui/layouts/nav.php';

//$role = $_SESSION['role'];
?>

<div id="popup" class="popup-hidden">
  <span id="popup-message"></span>
</div>
<style>
  .popup-hidden {
  display: none;
  /* other styles */
  }

.popup-visible {
  display: block;
  position: fixed;
  bottom: 10%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  z-index: 1;
  text-align: center;
  border-radius: 4px;
}

.loading-splash {
    display: none;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
    z-index: 9999;
}

.loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}


  </style>
<div class="container-fluid d-flex">
<div id="loadingSplash" class="loading-splash">
    <div class="loader"></div>
</div>


  <?php
  $at->fetch_elite_projects();


include $path.'/apps/work/ui/layouts/footer.php';
?>

